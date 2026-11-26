<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Private folder next to the website folder (not reachable from the internet)
$privateDir = dirname(__DIR__) . '/private';

require $privateDir . '/PHPMailer/src/Exception.php';
require $privateDir . '/PHPMailer/src/PHPMailer.php';
require $privateDir . '/PHPMailer/src/SMTP.php';
$config = require $privateDir . '/contact-config.php';

/**
 * Send the visitor to another page and stop the script.
 */
function redirectTo(string $path): void
{
    header('Location: ' . $path, true, 303);
    exit;
}

// Only accept form submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/');
}

// Language: only allow the languages of the site
$allowedLanguages = ['de', 'nl', 'en'];
$lang = (string) ($_POST['lang'] ?? 'de');
if (!in_array($lang, $allowedLanguages, true)) {
    $lang = 'de';
}

// Honeypot: if filled in, it is a bot. Pretend everything went fine.
if (!empty($_POST['website'])) {
    redirectTo("/$lang/thanks/");
}

// Read and clean the input
$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

// Prevent line breaks in the name (protects the mail headers)
$name = str_replace(["\r", "\n"], ' ', $name);

// Validate: all fields filled in, valid email, reasonable length
$isValid =
    $name !== '' &&
    $message !== '' &&
    filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
    mb_strlen($name) <= 100 &&
    mb_strlen($message) <= 5000;

if (!$isValid) {
    redirectTo("/$lang/contact/?error=1");
}

// Send the mail via the Strato mail server
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_user'];
    $mail->Password = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $config['smtp_port'];
    $mail->CharSet = 'UTF-8';

    // Sender must be the Strato mailbox; replies go to the visitor
    $mail->setFrom($config['smtp_user'], 'Website Anja Boin');
    $mail->addAddress($config['mail_to']);
    $mail->addReplyTo($email, $name);

    $mail->Subject = 'Neue Nachricht über die Website von ' . $name;
    $mail->Body =
        "Name: $name\n" .
        "E-Mail: $email\n" .
        "Sprache: $lang\n\n" .
        "Nachricht:\n$message\n";

    $mail->send();
    redirectTo("/$lang/thanks/");
} catch (Exception $e) {
    // Write the technical error to the server log, show the visitor a friendly message
    error_log('Contact form error: ' . $mail->ErrorInfo);
    redirectTo("/$lang/contact/?error=1");
}

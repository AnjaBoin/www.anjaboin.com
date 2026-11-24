# Stappenplan website – Anja Boin

Notities om mijn Astro-site op te zetten. Werkt zowel op de stage-pc als thuis.
Code (namen en commentaar) altijd in het Engels.

---

## Opstarten (elke keer)

- Terminal in VS Code: gebruik **Command Prompt**, niet PowerShell
  (PowerShell blokkeert npm-scripts op de stage-pc).
  Standaard instellen: `Ctrl+Shift+P` → *Terminal: Select Default Profile* → Command Prompt.
- Testversie starten: `npm run dev` → open http://localhost:4321
- Laten draaien zolang ik werk; stoppen met `Ctrl+C`.
- Voor andere opdrachten: tweede terminal openen met het **+**.
- Altijd opslaan met `Ctrl+S` (witte stip op het tabblad = niet opgeslagen).

## Thuis voor het eerst

1. Node.js, VS Code en Git installeren.
2. `git clone <url-van-mijn-repository>`
3. In de projectmap: `npm install` (haalt `node_modules` terug)
4. `npm run dev`

## Na elke werksessie

```
git add .
git commit -m "Short description of what I did"
git push
```

Thuis of op de stage verder werken: eerst `git pull`.

---

## Stand van zaken (24 november 2026, middag)

Klaar:
- Astro-project, op GitHub (privé repository), Engelse README
- Drie talen: `/de/`, `/nl/`, `/en/` (Duits = standaard), alle pagina's vertaald
- Vertaalbestand `src/i18n/ui.js` met functie `t(lang, key)`
- `BaseLayout` met taal uit `Astro.currentLocale`
- `Header`: naam links, menu in het midden, taalkeuze DE · NL · EN rechts;
  donker bovenaan, licht na het scrollen (script met klasse `scrolled`)
- Menu: Startseite, Über mich, Blog, Lebenslauf, Kontakt
- `Footer` met vertaalde tekst en automatisch jaartal
- Kleuren, lettertypes en de knop (`.button`, `.button-light`) in `global.css`
- Homepage: donker blok met tekst + foto, drie nieuwste artikelen als kaarten, uitnodiging tot contact
- Über-mich-pagina met grote foto, label, titel en inleiding
- Blog in drie talen:
  - collectie in `src/content.config.ts`, artikelen in `src/content/blog/<taal>/`
  - overzicht `blog/index.astro` en artikelpagina `blog/[slug].astro`
  - `BlogLayout` met drie kolommen (nieuwste artikelen | artikel | over mij)
  - Engelse bestandsnamen, in elke taal hetzelfde
  - melding als er in een taal nog geen artikelen zijn
- Contactformulier (HTML + CSS, `action="/contact.php"`) en bedankpagina's

Volgende stappen:
1. Lebenslauf (eventueel als eerste, eenvoudige tijdlijn)
2. Datenschutzerklärung en Impressum
3. Online zetten bij Strato + PHP-script voor het contactformulier
4. Taalkeuze op artikelpagina's: als er geen vertaling is, naar het blogoverzicht van die taal
5. Hamburgermenu op de telefoon

---

## Hoe het werkt (naslag)

**Een .astro-bestand**
1. Bovenaan, tussen twee regels `---`: script-gedeelte (imports, logica).
   Draait tijdens het bouwen, niet in de browser.
2. Daaronder: HTML.
3. Optioneel: `<style>` (geldt alleen voor deze component) en `<script>`
   (draait wél in de browser).

**Mappen**
- `src/pages/` – elk bestand wordt een pagina. `de/about.astro` → `/de/about/`.
  Een `index.astro` in een map wordt de pagina van die map (`de/blog/index.astro` → `/de/blog/`).
- `src/layouts/` – opbouw die op elke pagina terugkomt
- `src/components/` – losse onderdelen (Header, Footer)
- `src/styles/global.css` – kleuren, lettertypes, alles wat overal geldt
- `src/i18n/ui.js` – vaste korte teksten per taal
- `public/` – bestanden die ongewijzigd online gaan (foto's in `public/images/`)

**Paden bij imports**
- Vanuit `src/pages/de/`: `../../layouts/BaseLayout.astro`
- Vanuit `src/pages/de/blog/`: `../../../layouts/BaseLayout.astro`

**Teksten**
- Kort en op meerdere pagina's (menu, knoppen, footer) → `ui.js`
- Echte inhoud van een pagina → op de pagina zelf, per taal

**Componenten**
- Altijd met hoofdletter: `<Header />` (met kleine letter is het gewone HTML).
- Zelfsluitend met `/>` als je er niets tussen zet.
- Ongebruikte imports weghalen (melding "declared but never used").

**Een blogartikel schrijven**
1. Nieuw bestand in `src/content/blog/de/`, bijv. `my-new-article.md`
   (kleine letters, koppeltekens, Engelse naam).
2. Bovenaan de frontmatter:
   ```md
   ---
   title: "Titel"
   description: "Korte beschrijving"
   pubDate: 2026-11-24
   image: "/images/foto.jpg"
   imageAlt: "Wat er op de foto staat"
   ---
   ```
3. Daaronder de tekst. Lege regel = nieuwe alinea, `## ` = tussenkop,
   `**vet**`, `*cursief*`.
4. Vertaling? Zelfde bestandsnaam in `nl/` of `en/`. Niet elk artikel hoeft vertaald.

**Nieuwe pagina in alle talen**
1. Duitse versie maken en testen.
2. Kopiëren naar `nl` en `en`.
3. Met `Ctrl+H` `/de/` vervangen door `/nl/` of `/en/` (alleen in de kopie).
4. Teksten vertalen; `const lang`, datumnotatie (`de-DE`, `nl-NL`, `en-GB`)
   en verborgen velden (`value="de"`) aanpassen.

**Layouts in elkaar**
- `BlogLayout` gebruikt zelf `BaseLayout`.
- `[slug].astro` vult de `<slot />` van `BlogLayout`,
  zoals gewone pagina's de `<slot />` van `BaseLayout` vullen.

**Klassen combineren**
- `class="button button-light"`: alles van `.button`, plus de lichte kleuren.

---

## Ontwerprichting

Inspiratie: **Austin Kleon** (structuur, overzicht) + **Brené Brown** (beeld, persoonlijke uitstraling).

**Twee layouts:**

1. `BaseLayout` (stijl Brené Brown) – voor Home, Über mich, later Coaching
   - Menubalk bovenaan
   - Grote foto met tekst over mezelf bovenaan de pagina
2. `BlogLayout` (stijl Austin Kleon) – voor de blogartikelen
   - Links: foto's + titels van de laatste 5 artikelen
     (automatisch: `getCollection` → sorteren op datum → eerste 5)
   - Midden: het artikel
   - Rechts: vaste info (korte tekst + foto van mij, later mijn boek)
   - Op de telefoon: kolommen onder elkaar (artikel eerst)
   - Elk artikel bovenin het Markdown-bestand: titel, datum, foto

Algemeen:
- Rustige opbouw, maximaal zes menu-items (later nog Coaching).
- Leeskolom: klasse `content` (max. 42rem); inleiding iets breder.
- Warme kleuren: crème achtergrond, donkerbruine tekst, terracotta accent.
- Lettertypes: Montserrat (tekst, gratis alternatief voor Gotham), Georgia (titels).
  Geen lettertypes van verzamelsites zonder licentie gebruiken.
- Idee voor later: fotoraster waarbij tekst verschijnt bij hover; elke foto = een periode uit mijn leven.

---

## Contactformulier via Strato (bij het online zetten)

Besluit: berichten via een eigen PHP-script op Strato, niet via Formspree.
Gegevens blijven in Duitsland, geen extra dienst ertussen.

**Nu al klaar (Astro):**
- `de/contact.astro` met formulier, `action="/contact.php"`, `method="POST"`
- Verborgen veld `lang` (zodat het script naar de juiste taal terugstuurt)
- Honeypot-veld `website` tegen spambots
- Bedankpagina's: `de/thanks.astro`, `nl/thanks.astro`, `en/thanks.astro`
- Lokaal versturen geeft een foutpagina: dat klopt, de dev-server draait geen PHP.

**Nog te doen bij het online zetten:**
1. In Strato een e-mailadres op mijn domein aanmaken (bijv. `kontakt@...`).
2. PHPMailer downloaden (alleen de map `src`) en op de webruimte zetten.
3. Script `public/contact.php` schrijven:
   - alleen POST accepteren
   - honeypot gevuld → stoppen
   - invoer controleren (naam, geldig e-mailadres, bericht niet leeg)
   - versturen via `smtp.strato.de` met inloggen (gebruikersnaam = volledig e-mailadres)
   - doorsturen naar `/{lang}/thanks/`
4. Wachtwoord in een apart bestand (bijv. `contact-config.php`):
   - **nooit op GitHub** → in `.gitignore` zetten
   - los via SFTP uploaden, liefst buiten de map die online bereikbaar is
5. Testen op de echte site.
6. In de Datenschutzerklärung vermelden hoe het contactformulier werkt.

---

## Keuze en planning

Besluit: de site bouw ik zelf met Astro. Meeste voldoening, meeste ervaring,
en als toekomstig docent wil ik het zelf kunnen, niet alles via tools.

- **Versie 1 (stage):** Home, Über mich, Blog, Lebenslauf, Kontakt. Eenvoudig, rustig, af.
  → Alleen de Lebenslauf en het online zetten ontbreken nog.
- **Versie 2:** interactieve tijdlijn van mijn levensverhaal.
- **Versie 3:** reacties op blogposts (PHP + database bij Strato, met goedkeuring),
  daarna coaching en afspraken (Cal.com).
- **Later:** aparte IT-site op mijn tweede domein.

Steeds één ding tegelijk. Wat online staat, is af.

## Later

- Online zetten bij Strato: `npm run build` → inhoud van `dist/` via SFTP (FileZilla) uploaden.
- Strato-wachtwoord niet opslaan op de stage-pc.
- Map `secret` en wachtwoordbestanden altijd in `.gitignore`.
- Astro-werkbalk onderaan uitzetten: `npx astro preferences disable devToolbar`.
- Op het blogoverzicht links later iets anders tonen dan de nieuwste artikelen (bijv. onderwerpen).
- Aparte portretfoto voor het ronde fotootje in de blog.
- C#-idee (vanaf januari): eigen beheertool voor blogposts.
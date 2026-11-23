# Stappenplan website – het geraamte

Notities om mijn Astro-site op te zetten. Werkt zowel op de stage-pc als thuis.

---

## Opstarten (elke keer)

- Terminal in VS Code: gebruik **Command Prompt**, niet PowerShell
  (PowerShell blokkeert npm-scripts op de stage-pc).
  Standaard instellen: `Ctrl+Shift+P` → *Terminal: Select Default Profile* → Command Prompt.
- Testversie starten: `npm run dev` → open http://localhost:4321
- Stoppen: `Ctrl+C`
- Voor andere opdrachten: tweede terminal openen met het **+**.

## Thuis voor het eerst

1. Node.js, VS Code en Git installeren.
2. `git clone <url-van-mijn-repository>`
3. In de projectmap: `npm install` (haalt `node_modules` terug)
4. `npm run dev`

---

## Stap 3 – Hoe een .astro-bestand werkt

Elk `.astro`-bestand heeft twee delen:

1. **Bovenaan, tussen twee regels `---`**: het script-gedeelte.
   Imports en logica. Draait alleen tijdens het bouwen, niet in de browser.
2. **Daaronder**: gewone HTML.

Lijkt op Angular, maar logica en template staan in één bestand.

Belangrijk:
- Elk bestand in `src/pages/` wordt automatisch een pagina.
  `index.astro` → `/`, `over-mij.astro` → `/over-mij`
- `public/` → bestanden die ongewijzigd online gaan (afbeeldingen, favicon, lettertypes).

Zelf aanmaken in `src/`:
- `layouts/` – opbouw die op elke pagina terugkomt
- `components/` – losse onderdelen (header, footer)
- `styles/` – CSS

## Stap 4 – BaseLayout

Bestand: `src/layouts/BaseLayout.astro` (het "briefpapier" voor alle pagina's)

Erin:
- Volledige HTML-structuur: `<html>`, `<head>` (meta charset, viewport, `<title>`), `<body>`
- In de body: header → `<main>` → footer
- Binnen `<main>`: **`<slot />`** → hier komt de inhoud van elke pagina

Titel per pagina:
- Meegeven als **prop**
- In het script-gedeelte ophalen via `Astro.props`
- In `<title>` gebruiken met accolades `{ }` (zoals interpolatie in Angular)

## Stap 5 – Header en footer als componenten

- `src/components/Header.astro` – naam/logo + `<nav>` met links naar `/` en `/over-mij`
- `src/components/Footer.astro` – voorlopig copyrightregel
  (later: privacyverklaring, contactgegevens)

In de layout:
- Importeren in het script-gedeelte
- Gebruiken als tags: `<Header />` en `<Footer />`

## Stap 6 – Pagina's die de layout gebruiken

- `src/pages/index.astro`: BaseLayout importeren, inhoud **tussen** de openings-
  en sluittag van de layout zetten, `title` meegeven.
- `src/pages/over-mij.astro`: op dezelfde manier.

Test:
- Heen en weer klikken via het menu.
- Iets in de footer veranderen → moet op beide pagina's tegelijk zichtbaar zijn.

## Stap 7 – Naar GitHub

Eenmalig:
1. Op GitHub een nieuwe, **lege** repository aanmaken (zonder README).
2. In de terminal:
   ```
   git add .
   git commit -m "Eerste opzet website"
   git remote add origin <url-van-de-repository>
   git push -u origin main
   ```
   (Heet de branch `master`? Dan `master` in plaats van `main`.)

Daarna, na elke werksessie:
```
git add .
git commit -m "Korte beschrijving van wat ik gedaan heb"
git push
```

Thuis verder werken: `git pull` voordat ik begin.

---

## Meertaligheid (Duits, Nederlands, Engels)

Standaardtaal: **Duits**. Eerst Duits helemaal af, daarna vertalen.

- `astro.config.mjs`: i18n instellen → `locales`: `de`, `nl`, `en`; `defaultLocale`: `de`;
  `prefixDefaultLocale` aan (alle talen krijgen een voorvoegsel).
  Docs: zoek "Internationalization (i18n) Routing" op docs.astro.build.
- Pagina's per taal: `src/pages/de/`, `src/pages/nl/`, `src/pages/en/`
  → URL's `/de/`, `/nl/`, `/en/`. De hoofdpagina `/` stuurt door naar `/de/`.
- Dezelfde bestandsnamen in elke taalmap (bijv. `about.astro`).
- Vaste teksten (menu, knoppen, footer) in één vertaalbestand, bijv. `src/i18n/ui.ts`:
  één object per taal, sleutels zoals `nav.home`.
- Huidige taal opvragen: `Astro.currentLocale`.
- Taalkeuze in de header; hulpfuncties in `astro:i18n`.
- In de BaseLayout: `<html lang="...">` op de juiste taal zetten.
- Blogposts later per taal: `src/content/blog/de/`, `.../nl/`, `.../en/`.
  Niet elke post hoeft in alle talen.

## Keuze en planning

Besluit: de Anja-site bouw ik zelf met Astro. Meeste voldoening, meeste ervaring,
en als toekomstig docent wil ik het zelf kunnen, niet alles via tools.

- **Versie 1 (stage):** Home, Over mij, Blog (Markdown), Contact. Eenvoudig, rustig, af.
- **Versie 2:** interactieve tijdlijn van mijn levensverhaal.
- **Versie 3:** reacties op blogposts (PHP + database bij Strato, met goedkeuring),
  daarna coaching en afspraken (Cal.com).
- **Later:** aparte IT-site op mijn tweede domein, met CV en projecten.

Steeds één ding tegelijk. Wat online staat, is af.

## Later

- Online zetten bij Strato: `npm run build` → inhoud van `dist/` via SFTP (FileZilla) uploaden.
- Strato-wachtwoord niet opslaan op de stage-pc.
- Contactformulier: zelf in PHP (Strato ondersteunt PHP) of via Formspree.
- Afspraken voor coaching: Cal.com insluiten.
- C#-idee (vanaf januari): eigen beheertool voor blogposts.

# Anja Boin – Personal Website

My personal website, built from scratch with [Astro](https://astro.build).
A place to share my story, write articles and, later on, offer coaching.

The site is available in three languages: **German** (default), **Dutch** and **English**.

---

## Features

- **Multilingual** – all pages in German, Dutch and English (`/de/`, `/nl/`, `/en/`),
  with a language switcher in the header that links to the same page in the other language
- **Sticky header** – dark at the top of the page, switches to a light version when scrolling
- **Homepage** – introduction with photo, the three latest blog posts and an invitation to get in touch
- **About page** – large photo, introduction and personal story
- **Blog** – articles written in Markdown, in a three-column layout:
  latest articles | article | about me
- **Contact form** – sends messages via a PHP script on the web host (in progress)
- **Responsive** – layouts adapt to tablets and phones
- **Accessible** – semantic HTML, labels, `aria-current` for the active page,
  respects `prefers-reduced-motion`
- **Privacy-friendly** – fonts are self-hosted, no external services for tracking

## Tech stack

| Area | Technology |
|---|---|
| Framework | Astro |
| Languages | HTML, CSS, JavaScript, TypeScript (config), Markdown |
| Content | Astro content collections |
| Fonts | Montserrat (self-hosted via Fontsource), Georgia |
| Hosting | Strato web hosting |
| Contact form | PHP (planned) |

## Project structure

```text
/
├── public/
│   └── images/              # Photos
├── src/
│   ├── components/
│   │   ├── Header.astro     # Name, menu, language switcher
│   │   └── Footer.astro
│   ├── content/
│   │   └── blog/
│   │       ├── de/          # German articles (.md)
│   │       ├── nl/          # Dutch articles (.md)
│   │       └── en/          # English articles (.md)
│   ├── i18n/
│   │   └── ui.js            # Short UI texts per language + t() function
│   ├── layouts/
│   │   ├── BaseLayout.astro # Basic page structure
│   │   └── BlogLayout.astro # Three-column layout for the blog
│   ├── pages/
│   │   ├── index.astro      # Redirects to /de/
│   │   ├── de/              # German pages
│   │   ├── nl/              # Dutch pages
│   │   └── en/              # English pages
│   ├── styles/
│   │   └── global.css       # Colours, fonts, shared styles
│   └── content.config.ts    # Blog collection and schema
├── astro.config.mjs         # Astro settings, including i18n
└── package.json
```

Each language folder in `src/pages/` contains the same pages:
`index`, `about`, `blog/`, `cv`, `contact` and `thanks`.

## Getting started

Requirements: [Node.js](https://nodejs.org) and Git.

```sh
git clone <repository-url>
cd <project-folder>
npm install
npm run dev
```

The site then runs at `http://localhost:4321`.

## Commands

| Command | Action |
|---|---|
| `npm install` | Installs dependencies |
| `npm run dev` | Starts the local dev server at `localhost:4321` |
| `npm run build` | Builds the site to `./dist/` |
| `npm run preview` | Previews the build locally |

## Writing a blog post

1. Create a Markdown file in `src/content/blog/<language>/`, for example
   `src/content/blog/de/my-new-article.md`.
2. Add the frontmatter at the top:

   ```md
   ---
   title: "Title of the article"
   description: "Short description for the overview."
   pubDate: 2026-11-24
   image: "/images/my-photo.jpg"
   imageAlt: "Description of the photo"
   ---
   ```

3. Write the article below the frontmatter.

The post appears automatically in the overview and in the list of latest articles.
Translations use the **same English file name** in each language folder, so the
language switcher can link between them.

## Multilingual setup

- Routing is configured in `astro.config.mjs` with `prefixDefaultLocale: true`,
  so every language has its own prefix.
- The current language is read with `Astro.currentLocale`.
- Short, recurring texts (menu, footer, buttons) live in `src/i18n/ui.js`.
- Page content is written directly in each language's page.

## Deployment

The site is built with `npm run build` and the contents of `dist/` are uploaded
to Strato web hosting via SFTP.

The contact form will use a PHP script on Strato that sends mail through the
Strato SMTP server. Credentials are kept in a separate configuration file
that is **not** part of this repository.

## Roadmap

- [x] Basic structure, layouts and components
- [x] Three languages with language switcher
- [x] Homepage, about page, blog, contact page
- [ ] CV page
- [ ] PHP script for the contact form
- [ ] Privacy policy (Datenschutzerklärung) and legal notice (Impressum)
- [ ] First deployment to Strato
- [ ] Interactive timeline of my life story
- [ ] Comments on blog posts
- [ ] Coaching page with appointment booking

## About

Built by Anja Boin as part of my retraining as an application developer
(Fachinformatikerin für Anwendungsentwicklung).

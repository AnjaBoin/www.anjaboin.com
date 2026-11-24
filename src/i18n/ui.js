export const ui = {
  de: {
    'nav.label': 'Hauptmenü',
    'lang.label': 'Sprache wählen',
    'nav.home': 'Startseite',
    'nav.about': 'Über mich',
    'nav.blog': 'Blog',
    'nav.cv': 'Lebenslauf',
    'nav.contact': 'Kontakt',
    'footer.rights': 'Alle Rechte vorbehalten.',
  },
  nl: {
    'nav.label': 'Hoofdmenu',
    'lang.label': 'Taal kiezen',
    'nav.home': 'Home',
    'nav.about': 'Over mij',
    'nav.blog': 'Blog',
    'nav.cv': 'CV',
    'nav.contact': 'Contact',
    'footer.rights': 'Alle rechten voorbehouden.',
  },
  en: {
    'nav.label': 'Main menu',
    'lang.label': 'Choose language',
    'nav.home': 'Home',
    'nav.about': 'About me',
    'nav.blog': 'Blog',
    'nav.cv': 'CV',
    'nav.contact': 'Contact',
    'footer.rights': 'All rights reserved.',
  },
};

export function t(lang, key) {
  return ui[lang]?.[key] ?? ui.de[key];
}
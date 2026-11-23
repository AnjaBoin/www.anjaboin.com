export const ui = {
  de: {
    'nav.label': 'Hauptmenü',
    'lang.label': 'Sprache wählen',
    'nav.home': 'Startseite',
    'nav.about': 'Über mich',
    'footer.rights': 'Alle Rechte vorbehalten.',
  },
  nl: {
    'nav.label': 'Hoofdmenu',
    'lang.label': 'Taal kiezen',
    'nav.home': 'Home',
    'nav.about': 'Over mij',
    'footer.rights': 'Alle rechten voorbehouden.',
  },
  en: {
    'nav.label': 'Main menu',
    'lang.label': 'Choose language',
    'nav.home': 'Home',
    'nav.about': 'About me',
    'footer.rights': 'All rights reserved.',
  },
};

export function t(lang, key) {
  return ui[lang]?.[key] ?? ui.de[key];
}
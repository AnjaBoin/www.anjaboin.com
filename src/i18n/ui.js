export const ui = {
  de: {
    'nav.label': 'Hauptmenü',
    'nav.home': 'Startseite',
    'nav.about': 'Über mich',
  },
  nl: {
    'nav.label': 'Hoofdmenu',
    'nav.home': 'Home',
    'nav.about': 'Over mij',
  },
  en: {
    'nav.label': 'Main menu',
    'nav.home': 'Home',
    'nav.about': 'About me',
  },
};

export function t(lang, key) {
  return ui[lang]?.[key] ?? ui.de[key];
}
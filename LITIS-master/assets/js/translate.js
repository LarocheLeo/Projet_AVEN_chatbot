i18next
  .use(i18nextHttpBackend)
  .use(i18nextBrowserLanguageDetector)
  .init({
    fallbackLng: 'fr',  // Langue de secours par défaut est le français
    debug: true,
    backend: {
      loadPath: 'locales/{{lng}}/translation.json'  // Chemin vers les fichiers de traduction
    }
  }, function(err, t) {
    if (err) {
      console.error(err);
    } else {
      // Vérifiez et forcez la langue par défaut sur 'fr'
      const defaultLang = 'fr'; // Utilisez 'fr' par défaut
      i18next.changeLanguage(defaultLang, function(err, t) {
        if (err) {
          console.error('something went wrong loading', err);
        } else {
          updateContent();  // Met à jour le contenu une fois que la langue est définie
        }
      });
    }
  });

document.querySelectorAll('.dropdown-content a').forEach(function(element) {
  element.addEventListener('click', function(event) {
    event.preventDefault();
    const selectedLang = this.getAttribute('data-lang');
    document.getElementById('selected-lang').textContent = selectedLang.toUpperCase();
    localStorage.setItem('selectedLanguage', selectedLang); // Enregistrer la langue choisie dans le local storage
    i18next.changeLanguage(selectedLang, function(err, t) {
      if (err) {
        console.error('something went wrong loading', err);
      } else {
        updateContent();  // Met à jour le contenu après le changement de langue
      }
    });
  });
});

function updateContent() {
  document.querySelectorAll('[data-i18n]').forEach(function(element) {
    const key = element.getAttribute('data-i18n');
    const translatedValue = i18next.t(key);
    if (element.tagName === 'IMG') {
      console.log(`Setting image src for key: ${key} to ${translatedValue}`);
      element.src = translatedValue;
    } else {
      element.innerHTML = translatedValue;
    }
  });
}

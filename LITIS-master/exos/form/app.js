document.getElementById('checkBtn').addEventListener('click', function() {
    var nom = document.getElementById('nom').value.trim();
    var prenom = document.getElementById('prenom').value.trim();
    var email = document.getElementById('email').value.trim();
    var telephone = document.getElementById('telephone').value.trim();
    var dateNaissanceInput = document.getElementById('dateNaissance').value.trim().replace(/-/g, "/"); // Remplacer les "-" par "/"
    var dateNaissance = formatDate(dateNaissanceInput); // Formater la date de naissance
    var adresse = document.getElementById('adresse').value.trim();
    var codePostal = document.getElementById('codePostal').value.trim();
    var ville = document.getElementById('ville').value.trim();

    console.log("Nom saisi:", nom);
    console.log("Prénom saisi:", prenom);
    console.log("Email saisi:", email);
    console.log("Téléphone saisi:", telephone);
    console.log("Date de Naissance saisie:", dateNaissance);
    console.log("Adresse saisie:", adresse);
    console.log("Code Postal saisi:", codePostal);
    console.log("Ville saisie:", ville);

    var reponses = ["Dumont", "Dylan", "dylan.dumont@gmail.com", "06 12 34 56 78", "09/04/2024", "Rue de la Paix", "75001", "Paris"];

    console.log("Réponses attendues:", reponses);

    var erreurs = [];

    if (nom !== reponses[0]) {
        erreurs.push("Nom");
    }

    if (prenom !== reponses[1]) {
        erreurs.push("Prénom");
    }

    if (email !== reponses[2]) {
        erreurs.push("Adresse e-mail");
    }

    if (telephone !== reponses[3]) {
        erreurs.push("Téléphone");
    }

    if (dateNaissance !== reponses[4]) {
        erreurs.push("Date de Naissance");
    }

    if (adresse !== reponses[5]) {
        erreurs.push("Adresse");
    }

    if (codePostal !== reponses[6]) {
        erreurs.push("Code Postal");
    }

    if (ville !== reponses[7]) {
        erreurs.push("Ville");
    }

    if (erreurs.length === 0) {
        alert('Bravo ! Vous avez bien rempli le formulaire.');
    } else {
        alert('Veuillez vérifier les champs suivants : ' + erreurs.join(", "));
    }
});

function formatDate(date) {
    var parts = date.split('/');
    return parts[2] + '/' + parts[1] + '/' + parts[0];
}

const quizContainer = document.getElementById('quiz');
const resultsContainer = document.getElementById('results');
const submitButton = document.getElementById('submit');
const nextButton = document.getElementById('next');
const questionCounter = document.getElementById('question-counter');
const scoreContainer = document.getElementById('score');

const myQuestions = [
    {
        question: "Qu'est-ce qu'un \"portail administratif en ligne\" ?",
        answers: {
            a: "Une plateforme pour commander des repas en ligne.",
            b: "Un site web où l'on peut effectuer des démarches administratives telles que déclarer ses impôts ou demander un acte de naissance.",
            c: "Un réseau social pour les fonctionnaires.",
            d: "Une application pour jouer à des jeux de société en ligne."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un \"numéro fiscal\" ?",
        answers: {
            a: "Un code secret pour accéder à un jeu vidéo en ligne.",
            b: "Un numéro attribué à chaque citoyen pour ses démarches fiscales.",
            c: "Un numéro de téléphone pour contacter le service client d'une entreprise.",
            d: "Un numéro pour commander des produits en ligne."
        },
        correctAnswer: "b"
    },
    {
        question: "À quoi sert un \"espace personnel\" sur un site administratif en ligne ?",
        answers: {
            a: "À partager des photos de vacances avec ses amis.",
            b: "À accéder à ses informations personnelles et à effectuer des démarches administratives de manière sécurisée.",
            c: "À acheter des billets de train en ligne.",
            d: "À jouer à des jeux en ligne."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'une \"déclaration en ligne\" ?",
        answers: {
            a: "Une déclaration d'amour sur les réseaux sociaux.",
            b: "Une déclaration de revenus ou de situation effectuée sur un site web officiel.",
            c: "Une déclaration pour participer à un concours en ligne.",
            d: "Une déclaration pour annuler une réservation en ligne."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un \"document numérique\" ?",
        answers: {
            a: "Un document imprimé.",
            b: "Un document stocké sous forme électronique, accessible en ligne.",
            c: "Un document pour commander des produits en ligne.",
            d: "Un document pour réserver des billets de concert en ligne."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un \"justificatif de domicile\" ?",
        answers: {
            a: "Un document prouvant qu'une personne est domiciliée à une adresse spécifique.",
            b: "Un justificatif de revenus.",
            c: "Un document pour réserver un hôtel en ligne.",
            d: "Un certificat médical."
        },
        correctAnswer: "a"
    },
    {
        question: "À quoi sert un formulaire en ligne sur un site administratif ?",
        answers: {
            a: "À commander des articles de papeterie en ligne.",
            b: "À remplir des informations nécessaires pour effectuer une démarche administrative.",
            c: "À participer à des sondages en ligne.",
            d: "À créer un blog personnel."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un \"avis d'imposition\" ?",
        answers: {
            a: "Un avis pour annoncer une réunion en ligne.",
            b: "Un document indiquant le montant des impôts à payer ou le montant du remboursement d'impôts.",
            c: "Un avis pour confirmer une réservation en ligne.",
            d: "Un avis pour annoncer une naissance."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un \"identifiant\" dans le contexte de l'administration en ligne ?",
        answers: {
            a: "Un code secret pour accéder à un jeu vidéo en ligne.",
            b: "Un numéro unique permettant d'identifier un utilisateur sur un site web administratif.",
            c: "Un numéro de téléphone pour contacter le service client d'une entreprise.",
            d: "Un code-barres sur un produit acheté en ligne."
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'une \"attestation en ligne\" ?",
        answers: {
            a: "Une attestation pour prouver une compétence dans un domaine spécifique.",
            b: "Une attestation pour confirmer une réservation en ligne.",
            c: "Un document pour participer à un événement en ligne.",
            d: "Une attestation pour annoncer un changement d'adresse."
        },
        correctAnswer: "a"
    }
];



let currentQuestionIndex = 0;
let numCorrect = 0;

function showQuestion() {
    const currentQuestion = myQuestions[currentQuestionIndex];
    const answers = [];

    for (let letter in currentQuestion.answers) {
        answers.push(
            `<label>
                <input type="radio" name="question" value="${letter}">
                <span></span>
                ${letter} :
                ${currentQuestion.answers[letter]}
            </label>`
        );
    }

    quizContainer.innerHTML = `
        <div class="question"> ${currentQuestion.question} </div>
        <div class="answers"> ${answers.join('')} </div>
    `;

    // Mise à jour du compteur et du score
    questionCounter.textContent = `Question ${currentQuestionIndex + 1} sur ${myQuestions.length}`;
    scoreContainer.textContent = `Score: ${numCorrect}/${currentQuestionIndex}`;

    submitButton.style.display = 'block';
    nextButton.style.display = 'none';
}

function checkAnswer() {
    const answerContainers = quizContainer.querySelectorAll('.answers label');
    const selector = `input[name=question]:checked`;
    const userAnswer = (quizContainer.querySelector(selector) || {}).value;

    // Vérifie si l'utilisateur répond correctement ou non
    if (userAnswer === myQuestions[currentQuestionIndex].correctAnswer) {
        numCorrect++;
        const correctAnswerElement = quizContainer.querySelector(`input[value=${userAnswer}]`).parentElement;
        correctAnswerElement.classList.add('correct');
    } else {
        // Met en rouge si la réponse est incorrect
        if (userAnswer) {
            const incorrectAnswerElement = quizContainer.querySelector(`input[value=${userAnswer}]`).parentElement;
            incorrectAnswerElement.classList.add('incorrect');
        }
        // Met en vert si la réponse est correct
        const correctAnswerElement = quizContainer.querySelector(`input[value=${myQuestions[currentQuestionIndex].correctAnswer}]`).parentElement;
        correctAnswerElement.classList.add('correct');
    }

    // Mise à jour du score
    scoreContainer.textContent = `Score: ${numCorrect}/${currentQuestionIndex + 1}`;

    // Changement de bouton
    submitButton.style.display = 'none';
    nextButton.style.display = 'block';
}

function showNextQuestion() {
    currentQuestionIndex++;

    if (currentQuestionIndex < myQuestions.length) {
        showQuestion();
    } else {
        showResults();
    }
}

function showResults() {
    var audio = document.getElementById('myAudio');
    audio.play();


    quizContainer.innerHTML = '';
    resultsContainer.innerHTML = `Vous avez ${numCorrect} bonnes réponses sur ${myQuestions.length}.`;

    // Ajout de la class 'appear' pour tous les SVG avec la class 'layer'
    const layers = document.querySelectorAll('.layer');
    layers.forEach(layer => {
        layer.classList.add('appear');
    });

    // Change le bouton suivant en bouton recommencer
    nextButton.textContent = 'Recommencer';
    nextButton.removeEventListener('click', showNextQuestion);
    nextButton.addEventListener('click', restartQuiz);
    nextButton.style.display = 'block';
}

function restartQuiz() {
    // Enleve la class 'appear'
    const layers = document.querySelectorAll('.layer');
    layers.forEach(layer => {
        layer.classList.remove('appear');
    });

    currentQuestionIndex = 0;
    numCorrect = 0;
    showQuestion();
    resultsContainer.innerHTML = '';
    nextButton.style.display = 'none';
    nextButton.textContent = 'Continuer';
    nextButton.removeEventListener('click', restartQuiz);
    nextButton.addEventListener('click', showNextQuestion);
}

showQuestion();

submitButton.addEventListener('click', checkAnswer);
nextButton.addEventListener('click', showNextQuestion);

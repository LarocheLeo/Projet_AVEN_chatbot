const quizContainer = document.getElementById('quiz');
const resultsContainer = document.getElementById('results');
const submitButton = document.getElementById('submit');
const nextButton = document.getElementById('next');
const questionCounter = document.getElementById('question-counter');
const scoreContainer = document.getElementById('score');

const myQuestions = [
    {
        question: "Qu'est-ce qu'un mot de passe sécurisé ?",
        answers: {
            a: "Un mot de passe court et simple à retenir",
            b: "Un mot de passe composé de chiffres et de lettres sans caractères spéciaux",
            c: "Un mot de passe unique pour chaque compte, complexe et difficile à deviner",
            d: "Un mot de passe partagé avec des amis proches"
        },
        correctAnswer: "c"
    },
    {
        question: "Pourquoi est-il important de maintenir ses logiciels à jour ?",
        answers: {
            a: "Pour bénéficier des nouvelles fonctionnalités",
            b: "Pour garantir une meilleure performance de l'ordinateur",
            c: "Pour corriger les failles de sécurité connues et éviter les attaques informatiques",
            d: "Pour éviter les mises à jour indésirables"
        },
        correctAnswer: "c"
    },
    {
        question: "Qu'est-ce qu'un pare-feu ?",
        answers: {
            a: "Un dispositif pour empêcher les incendies dans un bâtiment",
            b: "Un logiciel ou un matériel qui protège un réseau informatique en filtrant les données entrantes et sortantes",
            c: "Un outil pour surveiller les activités des utilisateurs sur Internet",
            d: "Un système pour empêcher les pannes de courant électrique"
        },
        correctAnswer: "b"
    },
    {
        question: "Quel est l'objectif principal d'un antivirus ?",
        answers: {
            a: "Améliorer les performances de l'ordinateur en supprimant les fichiers inutiles",
            b: "Protéger l'ordinateur contre les virus, les logiciels malveillants et les menaces en ligne",
            c: "Surveiller les activités en ligne des utilisateurs",
            d: "Scanner les réseaux Wi-Fi pour détecter les intrusions"
        },
        correctAnswer: "b"
    },
    {
        question: "Quelle est la meilleure façon de protéger ses données lors de l'utilisation de réseaux Wi-Fi publics ?",
        answers: {
            a: "Utiliser un VPN (réseau privé virtuel)",
            b: "Partager ses identifiants de connexion avec d'autres utilisateurs",
            c: "Désactiver complètement le Wi-Fi public",
            d: "Utiliser des mots de passe simples pour se connecter"
        },
        correctAnswer: "a"
    },
    {
        question: "Qu'est-ce qu'un logiciel malveillant (malware) ?",
        answers: {
            a: "Un logiciel conçu pour améliorer les performances de l'ordinateur",
            b: "Un logiciel destiné à protéger l'ordinateur contre les attaques informatiques",
            c: "Un logiciel conçu pour endommager ou perturber un système informatique",
            d: "Un logiciel gratuit disponible en ligne"
        },
        correctAnswer: "c"
    },
    {
        question: "Quel est le risque de partager des informations personnelles sur les réseaux sociaux ?",
        answers: {
            a: "Aucun risque, car les réseaux sociaux sont sécurisés",
            b: "Un risque de vol d'identité ou de cyberharcèlement",
            c: "Une meilleure protection de la vie privée",
            d: "Une augmentation de la popularité en ligne"
        },
        correctAnswer: "b"
    },
    {
        question: "Que devez-vous faire si vous recevez un e-mail suspect ?",
        answers: {
            a: "Répondre en fournissant les informations demandées",
            b: "Ignorer l'e-mail",
            c: "Cliquer sur les liens dans l'e-mail pour vérifier l'authenticité",
            d: "Signaler l'e-mail comme spam ou phishing"
        },
        correctAnswer: "d"
    },
    {
        question: "Pourquoi est-il important de verrouiller votre smartphone avec un code PIN ou un mot de passe ?",
        answers: {
            a: "Pour empêcher les autres d'accéder à vos données personnelles en cas de perte ou de vol",
            b: "Pour améliorer les performances du smartphone",
            c: "Pour prolonger la durée de vie de la batterie",
            d: "Pour rendre le smartphone plus esthétique"
        },
        correctAnswer: "a"
    },
    {
        question: "Qu'est-ce que le spam ?",
        answers: {
            a: "Un type de viande en conserve",
            b: "Des messages non sollicités et souvent indésirables envoyés par e-mail",
            c: "Une méthode de cuisson utilisée pour les plats asiatiques",
            d: "Une technique de marketing légitime"
        },
        correctAnswer: "b"
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

    questionCounter.textContent = `Question ${currentQuestionIndex + 1} sur ${myQuestions.length}`;
    scoreContainer.textContent = `Score: ${numCorrect}/${currentQuestionIndex}`;

    submitButton.style.display = 'block';
    nextButton.style.display = 'none';
}

function checkAnswer() {
    const answerContainers = quizContainer.querySelectorAll('.answers label');
    const selector = `input[name=question]:checked`;
    const userAnswer = (quizContainer.querySelector(selector) || {}).value;

    if (userAnswer === myQuestions[currentQuestionIndex].correctAnswer) {
        numCorrect++;
        const correctAnswerElement = quizContainer.querySelector(`input[value=${userAnswer}]`).parentElement;
        correctAnswerElement.classList.add('correct');
    } else {
        if (userAnswer) {
            const incorrectAnswerElement = quizContainer.querySelector(`input[value=${userAnswer}]`).parentElement;
            incorrectAnswerElement.classList.add('incorrect');
        }
        const correctAnswerElement = quizContainer.querySelector(`input[value=${myQuestions[currentQuestionIndex].correctAnswer}]`).parentElement;
        correctAnswerElement.classList.add('correct');
    }

    scoreContainer.textContent = `Score: ${numCorrect}/${currentQuestionIndex + 1}`;

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

    const layers = document.querySelectorAll('.layer');
    layers.forEach(layer => {
        layer.classList.add('appear');
    });

    nextButton.textContent = 'Recommencer';
    nextButton.removeEventListener('click', showNextQuestion);
    nextButton.addEventListener('click', restartQuiz);
    nextButton.style.display = 'block';
}

function restartQuiz() {
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

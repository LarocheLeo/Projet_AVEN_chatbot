const quizContainer = document.getElementById('quiz');
const resultsContainer = document.getElementById('results');
const submitButton = document.getElementById('submit');
const nextButton = document.getElementById('next');
const questionCounter = document.getElementById('question-counter');
const scoreContainer = document.getElementById('score');

const myQuestions = [
    {
        question: "Quel est l'effet de la lumière bleue des écrans sur le sommeil ?",
        answers: {
            a: "Elle améliore la qualité du sommeil",
            b: "Elle n'a aucun effet sur le sommeil",
            c: "Elle perturbe le sommeil",
            d: "Elle réduit le besoin de sommeil"
        },
        correctAnswer: "c"
    },
    {
        question: "Quel est l'effet de la posture prolongée devant un ordinateur sur la santé ?",
        answers: {
            a: "Elle renforce les muscles du dos",
            b: "Elle provoque des douleurs lombaires et des problèmes de dos",
            c: "Elle améliore la posture",
            d: "Elle diminue le risque de blessures"
        },
        correctAnswer: "b"
    },
    {
        question: "Qui est responsable de la politique de santé publique dans un pays ?",
        answers: {
            a: "Le Ministère de l'Éducation",
            b: "Le Ministère de la Défence",
            c: "Le Ministère de la Santé",
            d: "Le Ministère de la Culture"
        },
        correctAnswer: "c"
    },
    {
        question: "Qui élabore les remboursements des soins médicaux en France ?",
        answers: {
            a: "L'Assurance Maladie",
            a: "Les médecins généralistes",
            c: "Les pharmaciens",
            d: "Les laboratoires pharmaceutiques"
        },
        correctAnswer: "a"
    },
    {
        question: "Qu'est-ce que Doctolib ?",
        answers: {
            a: "Un réseau social pour les professionnels de santé",
            b: "Une plateforme de réservation de rendez-vous medicaux en ligne",
            c: "Un service de livraison de médicaments à domicile",
            d: "Un système de gestion des dossiers médicaux électroniques"
        },
        correctAnswer: "b"
    },
    {
        question: "Quels types de rendez-vous peuvent être pris via Doctolib ?",
        answers: {
            a: "Uniquement les rendez-vous médicaux d'urgence",
            b: "Tous les types de rendez-vous médicaux",
            c: "Uniquement les rendez-vous médicaux pour les patiens déjà suivis",
            d: "Uniquement les rendez-vous pour des analyses médicaux en laboratoire"
        },
        correctAnswer: "b"
    },
    {
        question: "Comment s'assurer de la légalité et de la sécurité d'un site proposant la vente de médicaments en ligne ?",
        answers: {
            a: "En vérifiant que le site a une interface attrayante",
            b: "En vérifiant que le site affiche le logo de l'Ordre des Pharmaciens",
            c: "En vérifiant que le site propose des prix très bas",
            d: "En vérifiant que le site demande une ordonnace médicale"
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce que la télémédecine ?",
        answers: {
            a: "Un site web pour rechercher des recettes de cuisine saine",
            b: "Un service de consultations médicales à distance via Internet ou téléphone",
            c: "Un réseau social pour les professionnels de santé",
            d: "Un système de surveillance des épidémies en ligne"
        },
        correctAnswer: "b"
    },
    {
        question: "Quels sont les risques liés à l'achat de médicaments en ligne sans ordonnace ?",
        answers: {
            a: "Les médicaments peuvent être contrefaits ou de mauvaise qualité",
            b: "Les médicaments peuvent ne pas être adaptés au traitement",
            c: "Les médicaments peuvent interagir avec d'autres médicaments",
            d: "Toutes les réponses ci-dessus"
        },
        correctAnswer: "d"
    },
    {
        question: "Quelles est la meilleure façon d'utiliser les ressources en lignes pour rechercher des informations médicales",
        answers: {
            a: "En se fiant unniquement à un seul site web",
            b: "En consultant un professionnel de santé pour obtenir des conseils personnalisés",
            c: "En évitant d'utilser Internet pour des questions médicales",
            d: "En utilisant plusieurs sources fiables et en vérifiant les informations avec un professionnel de santé si nécéssaire"
        },
        correctAnswer: "d"
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

const quizContainer = document.getElementById('quiz');
const resultsContainer = document.getElementById('results');
const submitButton = document.getElementById('submit');
const nextButton = document.getElementById('next');
const questionCounter = document.getElementById('question-counter');
const scoreContainer = document.getElementById('score');

const myQuestions = [
    {
        question: "Qu'est-ce que l'ENT ?",
        answers: {
            a: "Une association d'étudiants nationale",
            b: "Un outil de traitement de texte en ligne",
            c: "Un Environnement Numérique de Travail",
            d: "Un système de réservation de billets de train en ligne"
        },
        correctAnswer: "c"
    },
    {
        question: "Parmi ces réponses, quel site ne permet pas de réviser ?",
        answers: {
            a: "Lumni.fr",
            b: "Parcoursup",
            c: "Les fondamentaux",
            d: "L'odyssée"
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un 'quiz' dans un contexte éducatif en ligne ?",
        answers: {
            a: "Un test de personnalité",
            b: "Une compétition de jeux vidéo",
            c: "Un format de question-réponse utilisé pour évaluer les connaissances des étudiants",
            d: "Un réseau social pour les étudiants"
        },
        correctAnswer: "c"
    },
    {
        question: "Qu'est-ce qu'un webinaire ?",
        answers: {
            a: "Un cours en ligne interactif",
            b: "Un document imprimé",
            c: "Une vidéo de chat en ligne",
            d: "Un logiciel de retouche photo"
        },
        correctAnswer: "a"
    },
    {
        question: "Qu'est-ce qu'un 'diaporama' dans un cours en ligne ?",
        answers: {
            a: "Un outil pour écrire des lettres",
            b: "Une présentation visuelle utilisée pour partager des informations, souvent composée de diapositives contenant du texte, des images et des vidéos",
            c: "Un type de jeu vidéo",
            d: "Un format de livre électronique"
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un 'portfolio en ligne' dans un contexte éducatif ?",
        answers: {
            a: "Un document imprimé contenant des photos de famille",
            b: "Un site web ou une plateforme où les étudiants peuvent présenter et partager leurs travaux, projets et réalisations",
            c: "Un réseau social pour les artistes",
            d: "Un journal intime en ligne"
        },
        correctAnswer: "b"
    },
    {
        question: "À quoi sert Parcoursup ?",
        answers: {
            a: "À planifier des voyages autour du monde.",
            b: "À trouver des recettes de cuisine en ligne.",
            c: "À faciliter l'orientation et l'inscription des étudiants dans l'enseignement supérieur.",
            d: "À organiser des événements sportifs universitaires."
        },
        correctAnswer: "c"
    },
    {
        question: "Parmi ces logiciels, lequel n’est pas un logiciel de traitement de texte ?",
        answers: {
            a: "Microsoft Word",
            b: "Google Doc",
            c: "Microsoft Excel",
            d: "LibreOffice Writer"
        },
        correctAnswer: "c"
    },
    {
        question: "À quoi sert Pronote ?",
        answers: {
            a: "À suivre les actualités politiques.",
            b: "À réserver des billets de cinéma en ligne.",
            c: "À commander des repas en ligne.",
            d: "À consulter les notes, les emplois du temps et les informations scolaires."
        },
        correctAnswer: "d"
    },
    {
        question: "Qu'est-ce qu'un 'tuteur en ligne' ?",
        answers: {
            a: "Un personnage de jeu vidéo.",
            b: "Un enseignant ou un professionnel qui guide et soutient les étudiants dans leur apprentissage en ligne.",
            c: "Un service de traduction automatique en ligne.",
            d: "Une application pour faire du sport à la maison."
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

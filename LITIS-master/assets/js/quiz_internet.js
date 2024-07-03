const quizContainer = document.getElementById('quiz');
const resultsContainer = document.getElementById('results');
const submitButton = document.getElementById('submit');
const nextButton = document.getElementById('next');
const questionCounter = document.getElementById('question-counter');
const scoreContainer = document.getElementById('score');

const myQuestions = [
    {
        question: "Que représente le terme 'Wi-Fi'?",
        answers: {
            a: "Une marque d'ordinateurs",
            b: "Une connexion sans fil à Internet",
            c: "Un type de câble",
            d: "Une messagerie"
        },
        correctAnswer: "b"
    },
    {
        question: "Quel symbole est utilisé pour une adresse e-mail ?",
        answers: {
            a: "#",
            b: "$",
            c: "@",
            d: "*"
        },
        correctAnswer: "c"
    },
    {
        question: "À quoi sert le stockage dans un ordinateur ?",
        answers: {
            a: "À faire des calculs",
            b: "À afficher des images",
            c: "À stocker des données et des fichiers",
            d: "À imprimer des documents"
        },
        correctAnswer: "c"
    },
    {
        question: "Que permet de faire une souris d'ordinateur ?",
        answers: {
            a: "Écouter de la musique",
            b: "Contrôler le curseur à l'écran",
            c: "Imprimer des documents",
            d: "Se connecter à Internet"
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un cookie en termes informatiques ?",
        answers: {
            a: "Un petit fichier stocké par le navigateur web",
            b: "Un virus informatique",
            c: "Un type de programme d'édition",
            d: "Un jeu vidéo"
        },
        correctAnswer: "a"
    },
    {
        question: "Que fait un moteur de recherche ?",
        answers: {
            a: "Il gère les connexions Wi-Fi",
            b: "Il recherche des informations sur Internet",
            c: "Il envoie des e-mails",
            d: "Il démarre votre ordinateur"
        },
        correctAnswer: "b"
    },
    {
        question: "Parmi ces logiciels, lequel n'est pas un moteur de recherche ?",
        answers: {
            a: "Google",
            b: "Firefox",
            c: "Yahoo",
            d: "Windows"
        },
        correctAnswer: "d"
    },
    {
        question: "Qu'est-ce que le terme 'email' signifie ?",
        answers: {
            a: "Electronic Mail",
            b: "Electronic Message",
            c: "Express Mail",
            d: "Efficient Mail"
        },
        correctAnswer: "a"
    },
    {
        question: "Quelle est la fonction du 'copier-coller' sur un ordinateur ?",
        answers: {
            a: "Il supprime du texte",
            b: "Il déplace du texte",
            c: "Il duplique du texte",
            d: "Il imprime du texte"
        },
        correctAnswer: "c"
    },
    {
        question: "Qu'est-ce qu'un 'emoji' ?",
        answers: {
            a: "Un type de logiciel de retouche photo",
            b: "Un petit symbole utilisé pour exprimer une émotion ",
            c: "Un format de fichier audio",
            d: "Un navigateur web populaire"
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

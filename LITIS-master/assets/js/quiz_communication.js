const quizContainer = document.getElementById('quiz');
const resultsContainer = document.getElementById('results');
const submitButton = document.getElementById('submit');
const nextButton = document.getElementById('next');
const questionCounter = document.getElementById('question-counter');
const scoreContainer = document.getElementById('score');

const myQuestions = [
    {
        question: "Qu'est-ce que le chat en ligne ?",
        answers: {
            a: "Une méthode de communication utilisant des signaux sonores",
            b: "Un service de messagerie électronique",
            c: "Une plateforme pour discuter en temps réel avec d'autres utilisateurs via Internet",
            d: "Un jeu vidéo en ligne"
        },
        correctAnswer: "c"
    },
    {
        question: "Quelle est la fonction principale des réseaux sociaux ?",
        answers: {
            a: "Partager des photos de vacances",
            b: "Communiquer avec des amis et des connaissances",
            c: "Acheter des produits en ligne",
            d: "Regarder des vidéos de chats mignons"
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un blog ?",
        answers: {
            a: "Un outil de navigation sur Internet",
            b: "Un réseau social pour les professionnels",
            c: "Un site web personnel où l'auteur partage des articles, des photos et des vidéos",
            d: "Une application de gestion de tâches en ligne"
        },
        correctAnswer: "c"
    },
    {
        question: "Qu'est-ce que le courrier électronique ?",
        answers: {
            a: "Une méthode de livraison de lettres papier",
            b: "Une plateforme pour regarder des films en ligne",
            c: "Un service de messagerie électronique permettant d'envoyer des messages texte et des fichiers par Internet",
            d: "Un réseau social pour les professionnels"
        },
        correctAnswer: "c"
    },
    {
        question: "Qu'est-ce qu'un forum en ligne ?",
        answers: {
            a: "Un site web pour acheter des produits d'occasion",
            b: "Une plateforme pour regarder des vidéos de cuisine",
            c: "Un espace de discussion sur Internet où les utilisateurs peuvent échanger des idées et des informations sur des sujets spécifiques",
            d: "Un réseau social pour les voyageurs"
        },
        correctAnswer: "c"
    },
    {
        question: "Que signifie l'acronyme 'SMS' ?",
        answers: {
            a: "Service de Messagerie Sécurisé",
            b: "Service de Messagerie Simple",
            c: "Service de Messages Secrets",
            d: "Service de Messagerie Courte (Short Message Service)"
        },
        correctAnswer: "d"
    },
    {
        question: "Qu'est-ce qu'une vidéoconférence ?",
        answers: {
            a: "Un appel téléphonique",
            b: "Une réunion en personne",
            c: "Une conversation vidéo en direct avec plusieurs personnes à distance via Internet",
            d: "Un cours en ligne"
        },
        correctAnswer: "c"
    },
    {
        question: "Qu'est-ce qu'un e-book ?",
        answers: {
            a: "Un livre audio",
            b: "Un livre numérique disponible en ligne au format électronique",
            c: "Un logiciel de traitement de texte",
            d: "Un appareil photo numérique"
        },
        correctAnswer: "b"
    },
    {
        question: "Qu'est-ce qu'un podcast ?",
        answers: {
            a: "Un programme de télévision en direct",
            b: "Un fichier audio numérique disponible en ligne pour écoute ou téléchargement",
            c: "Un jeu en ligne populaire",
            d: "Une méthode de communication utilisant des signaux lumineux"
        },
        correctAnswer: "b"
    },
    {
        question: "Que signifie l'acronyme 'FAQ' ?",
        answers: {
            a: "Questions Fréquemment Actualisées",
            b: "Foire Aux Questions",
            c: "Fichier d'Aide Quickstart",
            d: "Formulaire d'Accès Rapide"
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

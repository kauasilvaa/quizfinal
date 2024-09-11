// Banco de dados com perguntas e respostas
const quizData = [
    {
        question: "O que é?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "c"
    },
    {
        question: "O que é?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "c"
    },
    {
        question: "O que é ?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "a"
    },
    {
        question: "O que é ?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "c"
    },
    {
        question: "O que é ?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "d"
    },
    {
        question: "O que é ?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "c"
    },
    {
        question: "O que é ?",
        a: "resposta",
        b: "resposta",
        c: "resposta",
        d: "resposta",
        correct: "a"
    }
];

const quiz = document.getElementById('quiz');
const submitBtn = document.getElementById('submit');
const resultsEl = document.getElementById('results');
let currentQuiz = 0;
let score = 0;
let userAnswers = []; // Array para armazenar as respostas do usuário

// Função para carregar as perguntas
function loadQuiz() {
    const currentQuizData = quizData[currentQuiz];
    
    quiz.innerHTML = `
        <div class="question">${currentQuizData.question}</div>
        <label><input type="radio" name="answer" value="a"> ${currentQuizData.a}</label><br>
        <label><input type="radio" name="answer" value="b"> ${currentQuizData.b}</label><br>
        <label><input type="radio" name="answer" value="c"> ${currentQuizData.c}</label><br>
        <label><input type="radio" name="answer" value="d"> ${currentQuizData.d}</label>
    `;
}

// Função para obter a resposta selecionada
function getSelected() {
    const answers = document.getElementsByName('answer');
    let selectedAnswer;
    answers.forEach(answer => {
        if (answer.checked) {
            selectedAnswer = answer.value;
        }
    });
    return selectedAnswer;
}

// Função para processar as respostas ao final do quiz
function processResults() {
    quiz.innerHTML = "";
    resultsEl.innerHTML = `
        <h2>Você respondeu corretamente ${score} de ${quizData.length} perguntas.</h2>
        <ul id="answers-summary"></ul>
        <button id="reiniciar"></button>
    `;
    
    const answersSummary = document.getElementById('answers-summary');

    quizData.forEach((data, index) => {
        const userAnswer = userAnswers[index];
        const isCorrect = userAnswer === data.correct;
        const answerText = `
            <li>
                <strong>Pergunta ${index + 1}:</strong> ${data.question}<br>
                <strong>Resposta sua:</strong> <span class="${isCorrect ? 'correct' : 'incorrect'}">${data[userAnswer]}</span>
            </li>
        `;
        answersSummary.innerHTML += answerText;
    });

    // Adiciona evento ao botão de recomeçar
    const restartBtn = document.getElementById('restart');
    restartBtn.addEventListener('click', restartQuiz);
}

// Função para reiniciar o quiz
function restartQuiz() {
    currentQuiz = 0;
    score = 0;
    userAnswers = []; // Limpa as respostas do usuário
    resultsEl.innerHTML = "";
    submitBtn.style.display = 'block'; // Mostra o botão de enviar novamente
    loadQuiz();
}

submitBtn.addEventListener('click', () => {
    const selectedAnswer = getSelected();
    
    if (selectedAnswer) {
        userAnswers.push(selectedAnswer); // Armazena a resposta do usuário
        
        if (selectedAnswer === quizData[currentQuiz].correct) {
            score++;
        }
        currentQuiz++;
        if (currentQuiz < quizData.length) {
            loadQuiz();
        } else {
            processResults();
            submitBtn.style.display = 'none'; // Esconde o botão de enviar quando o quiz termina
        }
    }
});
// Função para processar as respostas ao final do quiz
function processResults() {
    quiz.innerHTML = "";
    
    // Calcula a nota em porcentagem
    const percentage = Math.round((score / quizData.length) * 100);
    
    resultsEl.innerHTML = `
        <h2>Você acertou ${score} de ${quizData.length} perguntas.</h2>
        <h3>Sua nota: ${percentage}%</h3>
        <ul id="answers-summary"></ul>
        <button id="restart">Refazer</button>
    `;
    
    const answersSummary = document.getElementById('answers-summary');

    quizData.forEach((data, index) => {
        const userAnswer = userAnswers[index];
        const isCorrect = userAnswer === data.correct;
        const answerText = `
            <li>
                <strong>Pergunta ${index + 1}:</strong> ${data.question}<br>
                <strong>Resposta sua:</strong> <span class="${isCorrect ? 'correct' : 'incorrect'}">${data[userAnswer]}</span>
            </li>
        `;
        answersSummary.innerHTML += answerText;
    });

    // Adiciona evento ao botão de recomeçar
    const restartBtn = document.getElementById('restart');
    restartBtn.addEventListener('click', restartQuiz);
}

// Carregar o primeiro quiz
loadQuiz();



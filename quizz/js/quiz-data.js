// Banco de dados com perguntas e respostas atualizadas
const quizData = [
    {
        question: "Qual é o planeta mais próximo do Sol?",
        a: "Terra",
        b: "Vênus",
        c: "Mercúrio",
        d: "Marte",
        correct: "c"
    },
    {
        question: "Quem pintou a Mona Lisa?",
        a: "Pablo Picasso",
        b: "Leonardo da Vinci",
        c: "Vincent van Gogh",
        d: "Claude Monet",
        correct: "b"
    },
    {
        question: "Qual é o maior oceano do mundo?",
        a: "Oceano Atlântico",
        b: "Oceano Índico",
        c: "Oceano Ártico",
        d: "Oceano Pacífico",
        correct: "d"
    },
    {
        question: "Em que ano o homem pisou na Lua pela primeira vez?",
        a: "1959",
        b: "1969",
        c: "1979",
        d: "1989",
        correct: "b"
    },
    {
        question: "Qual país é conhecido como a Terra do Sol Nascente?",
        a: "China",
        b: "Coreia do Sul",
        c: "Japão",
        d: "Tailândia",
        correct: "c"
    },
    {
        question: "Qual é o animal terrestre mais rápido do mundo?",
        a: "Leopardo",
        b: "Tigre",
        c: "Guepardo",
        d: "Leão",
        correct: "c"
    },
    {
        question: "Qual é o elemento químico representado pela letra 'O'?",
        a: "Ouro",
        b: "Oxigênio",
        c: "Ósmio",
        d: "Óxido",
        correct: "b"
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
    let selectedAnswer = null;
    
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
    
    // Calcula a nota em porcentagem
    const percentage = Math.round((score / quizData.length) * 100);
    
    resultsEl.innerHTML = `
        <h2>Você acertou ${score} de ${quizData.length} perguntas.</h2>
        <h3>Sua nota: ${percentage}%</h3>
        <ul id="answers-summary"></ul>
        <button id="restart">Recomeçar</button>
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
    } else {
        alert("Por favor, selecione uma resposta antes de continuar!");
    }
});

// Carregar o primeiro quiz
loadQuiz();

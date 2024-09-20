// Banco de dados com perguntas e respostas atualizadas
const quizData = [
    {
        question: "(ITA) Assinale a opção relativa aos números de oxidação CORRETOS do átomo de cloro nos compostos KCIO3, Ca(CIO)2, Mg(CO3)2 e Ba(CIO4)2, respectivamente? (DIFÍCIL)",
        a: "-1,-1,-1e-1",
        b: "+3, +2, +4 e +6",
        c: "+3, +1, +5, +7",
        d: "+3, +1, +5, +0",
        correct: "c",
        conclusion: "O cloro possui diferentes números de oxidação nos compostos citados: +5 em KClO3, +1 em Ca(ClO)2, +7 em Ba(ClO4)2. Esses números indicam os diferentes estados de oxidação que o cloro pode assumir."
    },
    {
        question: "(FUNREI) Com relação à reação Zn + HgSO→ ZnSO4 + Hg, qual é a afirmativa INCORRETA? (MÉDIO)",
        a: "A reação é do tipo oxirredução",
        b: "O mercúrio se oxidou pela ação do zinco",
        c: "O número de oxidação do enxofre não variou",
        d: "O zinco foi o agente redutor",
        correct: "b",
        conclusion: "O mercúrio foi reduzido, não oxidado. O zinco atuou como agente redutor, liberando elétrons e aumentando seu número de oxidação."
    },
    {
        question: "Qual é o maior oceano do mundo?",
        a: "Oceano Atlântico",
        b: "Oceano Índico",
        c: "Oceano Ártico",
        d: "Oceano Pacífico",
        correct: "d",
        conclusion: "O Oceano Pacífico é o maior oceano do mundo, cobrindo aproximadamente 63 milhões de milhas quadradas."
    },
    {
        question: "Em que ano o homem pisou na Lua pela primeira vez?",
        a: "1959",
        b: "1969",
        c: "1979",
        d: "1989",
        correct: "b",
        conclusion: "Neil Armstrong pisou na Lua pela primeira vez em 1969, durante a missão Apollo 11, tornando-se o primeiro humano a caminhar em outro corpo celeste."
    },
    {
        question: "Qual país é conhecido como a Terra do Sol Nascente?",
        a: "China",
        b: "Coreia do Sul",
        c: "Japão",
        d: "Tailândia",
        correct: "c",
        conclusion: "O Japão é conhecido como a 'Terra do Sol Nascente' por sua localização a leste do continente asiático, onde o sol nasce primeiro."
    },
    {
        question: "Qual é o animal terrestre mais rápido do mundo?",
        a: "Leopardo",
        b: "Tigre",
        c: "Guepardo",
        d: "Leão",
        correct: "c",
        conclusion: "O guepardo é o animal terrestre mais rápido do mundo, podendo atingir velocidades de até 112 km/h em curtas distâncias."
    },
    {
        question: "Qual é o elemento químico representado pela letra 'O'?",
        a: "Ouro",
        b: "Oxigênio",
        c: "Ósmio",
        d: "Óxido",
        correct: "b",
        conclusion: "O símbolo 'O' representa o oxigênio, um elemento essencial para a respiração e a combustão."
    }
];

const quiz = document.getElementById('quiz');
const submitBtn = document.getElementById('submit');
const resultsEl = document.getElementById('results');
let currentQuiz = 0;
let score = 0;
let userAnswers = [];

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
                <strong>Resposta sua:</strong> <span class="${isCorrect ? 'correct' : 'incorrect'}">${data[userAnswer]}</span><br>
                <strong>Conclusão:</strong> ${data.conclusion}
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
    userAnswers = [];
    resultsEl.innerHTML = "";
    submitBtn.style.display = 'block';
    loadQuiz();
}

submitBtn.addEventListener('click', () => {
    const selectedAnswer = getSelected();
    
    if (selectedAnswer) {
        userAnswers.push(selectedAnswer); 
        
        if (selectedAnswer === quizData[currentQuiz].correct) {
            score++;
        }
        currentQuiz++;
        if (currentQuiz < quizData.length) {
            loadQuiz();
        } else {
            processResults();
            submitBtn.style.display = 'none'; 
        }
    } else {
        alert("Por favor, selecione uma resposta antes de continuar!");
    }
});

// Carregar o primeiro quiz
loadQuiz();
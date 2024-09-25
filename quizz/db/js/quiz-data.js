const quiz = document.getElementById('quiz');
const submitBtn = document.getElementById('submit');
const resultsEl = document.getElementById('results');
let currentQuiz = 0;
let score = 0;
let userAnswers = [];
let quizData = [];

// Função para carregar as perguntas do servidor
function loadQuizData() {
    fetch('quizfinal/quizfinal/quizz/adm/getQuestions.php') // Requisição para o PHP que retorna as perguntas do banco
        .then(response => response.json()) // Converte a resposta em JSON
        .then(data => {
            quizData = data; // Armazena os dados das perguntas
            loadQuiz(); // Carrega a primeira pergunta
        })
        .catch(error => {
            console.error('Erro ao carregar as perguntas:', error);
        });
}

// Função para carregar uma pergunta
function loadQuiz() {
    if (quizData.length === 0) {
        quiz.innerHTML = "<p>Não há perguntas cadastradas no momento.</p>";
        return;
    }

    const currentQuizData = quizData[currentQuiz];
    
    quiz.innerHTML = `
        <div class="question">${currentQuizData.titulo_pergunta}</div>
        <label><input type="radio" name="answer" value="a"> ${currentQuizData.opcao1}</label><br>
        <label><input type="radio" name="answer" value="b"> ${currentQuizData.opcao2}</label><br>
        <label><input type="radio" name="answer" value="c"> ${currentQuizData.opcao3}</label><br>
        <label><input type="radio" name="answer" value="d"> ${currentQuizData.opcao4}</label>
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
                <strong>Pergunta ${index + 1}:</strong> ${data.titulo_pergunta}<br>
                <strong>Resposta sua:</strong> <span class="${isCorrect ? 'correct' : 'incorrect'}">${data[`opcao${userAnswer}`]}</span><br>
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

// Carregar as perguntas do servidor ao iniciar
loadQuizData();

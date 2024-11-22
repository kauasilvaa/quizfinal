const quiz = document.getElementById('quiz');
const submitBtn = document.getElementById('submit');
const resultsEl = document.getElementById('results');
let currentQuiz = 0;
let score = 0;
let userAnswers = [];
let quizData = [];

// Função para carregar as perguntas do servidor
function loadQuizData() {
    fetch('http://localhost/quizfinal/quizfinal/quizz/adm/getQuestions.php')
        .then(response => response.json())
        .then(data => {
            quizData = data; // Armazena os dados das perguntas
            if (quizData.length === 0) {
                quiz.innerHTML = "<p>Não há perguntas cadastradas no momento.</p>";
                submitBtn.style.display = 'none'; // Esconde o botão se não houver perguntas
            } else {
                loadQuiz(); // Carrega a primeira pergunta
            }
        })
        .catch(error => {
            console.error('Erro ao carregar as perguntas:', error);
            quiz.innerHTML = "<p>Erro ao carregar perguntas. Tente novamente mais tarde.</p>";
        });
}

// Função para carregar uma pergunta
function loadQuiz() {
    const currentQuizData = quizData[currentQuiz];
    
    quiz.innerHTML = `
        <div class="question">${currentQuizData.titulo_pergunta}</div>
        <label><input type="radio" name="answer" value="1"> ${currentQuizData.opcao1}</label><br>
        <label><input type="radio" name="answer" value="2"> ${currentQuizData.opcao2}</label><br>
        <label><input type="radio" name="answer" value="3"> ${currentQuizData.opcao3}</label><br>
        <label><input type="radio" name="answer" value="4"> ${currentQuizData.opcao4}</label>
    `;
}

// Função para processar os resultados
function processResults() {
    const percentage = Math.round((score / quizData.length) * 100);

    // Exibir o resultado geral
    resultsEl.innerHTML = `
        <h2>Você acertou ${score} de ${quizData.length} perguntas.</h2>
        <h3>Sua nota: ${percentage}%</h3>
        <ul id="answers-summary"></ul>
    `;

    const answersSummary = document.getElementById('answers-summary');

    quizData.forEach((data, index) => {
        const userAnswer = userAnswers[index];
        const correctAnswer = data.resposta_correta;
        const isCorrect = userAnswer === correctAnswer;

        // Exibir a conclusão (justificativa) da resposta correta
        const justificativa = data.conclusao ? data.conclusao : "Nenhuma justificativa disponível.";

        // Adicionar o resumo da pergunta, resposta do usuário, resposta correta e justificativa
        answersSummary.innerHTML += `
            <li>
                <strong>Pergunta ${index + 1}:</strong> ${data.titulo_pergunta}<br>
                <strong>Sua resposta:</strong> <span class="${isCorrect ? 'correct' : 'incorrect'}">${data['opcao' + userAnswer]}</span><br>
                <strong>Resposta correta:</strong> ${data['opcao' + correctAnswer]}<br>
                <strong>Justificativa:</strong> ${justificativa}<br> <!-- Exibe a justificativa da resposta correta -->
            </li>
        `;
    });

    // Adicionar o botão para reiniciar o quiz
    resultsEl.innerHTML += `<button id="restart">Recomeçar</button>`;

    // Adicionar o evento para reiniciar o quiz
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

// Evento ao clicar no botão "Enviar Respostas"
submitBtn.addEventListener('click', () => {
    const selectedAnswer = getSelected();

    if (!selectedAnswer) {
        alert("Por favor, selecione uma resposta.");
        return;
    }

    userAnswers.push(selectedAnswer);

    if (selectedAnswer === quizData[currentQuiz].resposta_correta) {
        score++;
    }

    currentQuiz++;

    if (currentQuiz < quizData.length) {
        loadQuiz(); // Carregar a próxima pergunta
    } else {
        processResults(); // Processar resultados no final
        submitBtn.style.display = 'none'; // Esconder o botão ao final
    }
});

// Carregar as perguntas ao iniciar
loadQuizData();

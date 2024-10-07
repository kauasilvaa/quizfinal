<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Bem-Vindo ao Quiz</title>
</head>
<body>
<div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img src="quizz/img/logo.jfif" class="logo">
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="../quizfinal/index.php" class="link active">Home</a></li>
                <li><a href="termos.php" class="link active">Termos & Condições</a></li>
                <li><a href="sobre.php" class="link active">Sobre Nós</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="window.location.href='login.php'">Login</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

    <div class="background">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="quiz-container">
                <h1>SimulaQuest</h1>
                <h2 class="top">Selecione sua matéria</h2>

                <!-- Botão Filtro -->
                <div class="filter-container mb-4">
                    <button class="btn btn-primary filter-button" type="button">
                        <span class="filter-text">Selecione uma Matéria</span>
                        <span class="filter-icon">&#9662;</span>
                    </button>
                    <div class="filter-menu">
                        <a class="filter-item" href="#" onclick="selectSubject('Matemática')">Matemática</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Português')">Português</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Física')">Física</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Biologia')">Biologia</a>
                        <a class="filter-item" href="#" onclick="selectSubject('História')">História</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Geografia')">Geografia</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Filosofia')">Filosofia</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Artes')">Artes</a>
                        <a class="filter-item" href="#" onclick="selectSubject('Sociologia')">Sociologia</a>
                    </div>
                </div>

                <!-- Seleção de número de questões -->
                <div id="questionSelectContainer" class="question-select" style="display:none;">
                    <h4 id="selectedSubject"></h4>
                    <label for="questionNumber">Número de questões:</label>
                    <select id="questionNumber" class="form-select" style="width: auto;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button class="btn btn-success mt-3" id="startQuizBtn" onclick="startQuiz()">Iniciar Quiz</button>
                </div>

                <!-- Botão de Realizar Simulado -->
                <a id="realizarSimuladoBtn" class="btn btn-level" href="quizz/html/perguntas.html">Realizar Simulado</a>

            </div>
        </div>
    </div>
</div>

<script>
    let selectedSubject = "";

    // Função para selecionar a matéria
    function selectSubject(subject) {
        selectedSubject = subject;
        document.getElementById('questionSelectContainer').style.display = 'block';
        document.getElementById('selectedSubject').innerText = 'Matéria Selecionada: ' + subject;

        // Esconder o botão de "Realizar Simulado"
        document.getElementById('realizarSimuladoBtn').style.display = 'none';
    }

    // Função para iniciar o quiz e enviar as escolhas para a nova página
    function startQuiz() {
        var numQuestions = document.getElementById('questionNumber').value;
        window.location.href = "quiz.php?subject=" + encodeURIComponent(selectedSubject) + "&numQuestions=" + numQuestions;
    }
</script>
</body>
</html>

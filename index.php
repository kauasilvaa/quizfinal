<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Bem-Vindo ao Quiz</title>
    <style>
        .filter-container {
            position: relative;
            display: inline-block;
        }
        .filter-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .filter-item {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            cursor: pointer;
        }
        .filter-item:hover {
            background-color: #f1f1f1;
        }
        .filter-container:hover .filter-menu {
            display: block;
        }
        .question-select {
            margin-top: 15px;
        }
    </style>
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
                        <a class="filter-item" href="#" onclick="showQuestionSelect('Matemática')">Matemática</a>
                        <a class="filter-item" href="#" onclick="showQuestionSelect('Português')">Português</a>
                        <a class="filter-item" href="#" onclick="showQuestionSelect('Física')">Física</a>
                        <a class="filter-item" href="#" onclick="showQuestionSelect('Biologia')">Biologia</a>
                        <a class="filter-item" href="#" onclick="showQuestionSelect('História')">História</a>
                        <a class="filter-item" href="#" onclick="showQuestionSelect('Geografia')">Geografia</a>
                        <a class="filter-item" href="#" onclick="showQuestionSelect('Sociologia')">Sociologia</a>
                    </div>
                </div>

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
                    <a class="btn btn-success mt-3" href="#" id="startQuizBtn">Iniciar Simulado</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showQuestionSelect(subject) {
        document.getElementById('questionSelectContainer').style.display = 'block';
        document.getElementById('selectedSubject').innerText = 'Matéria Selecionada: ' + subject;
        
        // Atualiza o link do botão para incluir a matéria e o número de questões
        document.getElementById('startQuizBtn').onclick = function() {
            var numQuestions = document.getElementById('questionNumber').value;
            window.location.href = 'quizz/html/perguntas.html?materia=' + subject + '&numQuestoes=' + numQuestions;
        }
    }
</script>
</body>
</html>

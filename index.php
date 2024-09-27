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
                        <a class="filter-item" href="#">Matemática</a>
                        <a class="filter-item" href="#">Português</a>
                        <a class="filter-item" href="#">Física</a>
                        <a class="filter-item" href="#">Biologia</a>
                        <a class="filter-item" href="#">História</a>
                        <a class="filter-item" href="#">Geografia</a>
                        <a class="filter-item" href="#">Filosofia</a>
                        <a class="filter-item" href="#">Sociologia</a>
                    </div>
                </div>

                <a class="btn btn-level" href="quizz/html/perguntas.html">Realizar Simulado</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

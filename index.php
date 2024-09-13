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
    <div class="background">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="quiz-container">
                <h1>Quiz</h1>
                <h2 class="top">Escolha seu nível</h2>

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

                <a class="btn btn-level" href="quizz/html/perguntas.html">Fácil</a>
                <a class="btn btn-level" href="quizz/html/perguntas.html">Médio</a>
                <a class="btn btn-level" href="quizz/html/perguntas.html">Difícil</a>
                

              
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Conexão com o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=quiz', 'root', ''); // Use as credenciais corretas aqui

// Verifique se o ID da atividade foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID da atividade não fornecido.");
}

// Obtenha o ID da atividade a partir da URL
$id_atividade = $_GET['id'];

// Consultar os detalhes da atividade
$sql = "SELECT * FROM atividade WHERE id_atividade = :id_atividade";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_atividade', $id_atividade);
$stmt->execute();
$atividade = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifique se a atividade foi encontrada
if (!$atividade) {
    die("Atividade não encontrada.");
}

// Consultar a matéria diretamente da tabela de atividade
$materia = $atividade['materia']; 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos gerais */
        body {
            background: linear-gradient(to bottom right, #f0f0f0, #ffffff); /* Gradiente suave */
            font-family: Arial, sans-serif;
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png'); /* Imagem de fundo sutil */
            background-size: cover; /* Garante que a imagem de fundo cubra toda a tela */
            background-attachment: fixed; /* A imagem de fundo não se move ao rolar a página */
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px 40px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-top: 40px;
        }

        h1 {
            font-size: 2.4em;
            color: #3b5998;
            text-align: center;
            margin-bottom: 30px;
        }

        .details-info {
            margin-bottom: 20px;
        }

        .btn-back {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3b5998;
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #8b9dc3;
            color: #3b5998;
        }
    </style>    
         
    <title>Detalhes da Atividade</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Detalhes da Atividade</h1>

        <!-- Exibição das informações principais -->
        <div class="details-info">
            <p><strong>Matéria:</strong> <?php echo htmlspecialchars($materia); ?></p>
            <p><strong>Quiz ID:</strong> <?php echo htmlspecialchars($atividade['id_quiz']); ?></p>
            <p><strong>Pontuação:</strong> <?php echo htmlspecialchars($atividade['pontuacao']); ?></p>
            <p><strong>Total de Perguntas:</strong> <?php echo htmlspecialchars($atividade['total_perguntas']); ?></p>
            <p><strong>Data de Realização:</strong> <?php echo htmlspecialchars($atividade['data_realizacao']); ?></p>
        </div>

        <h3>Resumo do Desempenho</h3>
        <p><strong>Avaliação de Desempenho:</strong> <?php echo ($atividade['pontuacao'] / $atividade['total_perguntas']) * 100; ?>%</p>

        <div class="text-center mt-5">
            <a href="atividaderealizada.php" class="btn-back">← Voltar para Atividades Realizadas</a>
        </div>
    </div>
</body>
</html>

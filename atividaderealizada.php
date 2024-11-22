<?php
// Conexão com o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=quiz', 'root', ''); // Use as credenciais corretas aqui

// Consultar as atividades realizadas
$sql = "SELECT * FROM atividade ORDER BY data_realizacao DESC";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute();
    $atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se há atividades
    if ($atividades) {
        // Exibe atividades
    } else {
        echo "<p>Não há atividades realizadas.</p>";
    }
} catch (PDOException $e) {
    echo "Erro ao executar a consulta: " . $e->getMessage();
}
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
            background: linear-gradient(to bottom right, #e0e0e0, #ffffff); /* Gradiente suave */
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

        .activity-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid #3b5998;
        }

        .activity-item h5 {
            color: #333;
            font-weight: bold;
        }

        .btn-details {
            display: inline-block;
            padding: 8px 16px;
            background-color: #3b5998;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-details:hover {
            background-color: #8b9dc3;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
    <title>Atividades Realizadas</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Atividades Realizadas</h1>

        <?php if (isset($atividades) && $atividades): ?>
            <?php foreach ($atividades as $atividade): ?>
                <div class="activity-item">
                    <h5>Matéria: <?php echo htmlspecialchars($atividade['materia'] ?: 'Não especificado'); ?></h5>
                    <p><strong>Pontuação:</strong> <?php echo htmlspecialchars($atividade['pontuacao']); ?></p>
                    <p><strong>Data de Realização:</strong> <?php echo htmlspecialchars($atividade['data_realizacao']); ?></p>
                    <a href="detalhesatividade.php?id=<?php echo $atividade['id_atividade']; ?>" class="btn-details">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Não há atividades realizadas.</p>
        <?php endif; ?>

        <!-- Botão de Voltar -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn-back">← Voltar</a>
        </div>
    </div>
</body>
</html>

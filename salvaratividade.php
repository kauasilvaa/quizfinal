<?php
// Conexão com o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=quiz', 'root', ''); // Use as credenciais corretas aqui

// Exemplo de dados recebidos via POST ou AJAX
session_start();

// Verifique se a variável de sessão 'id_usuario' está definida
if (!isset($_SESSION['id_usuario'])) {
    die('Usuário não está logado.');
}

$id_usuario = $_SESSION['id_usuario']; // O ID do usuário logado

// Pontuação e total de perguntas
$pontuacao = $_POST['pontuacao']; // A pontuação final que o usuário alcançou
$total_perguntas = $_POST['total_perguntas']; // O número total de perguntas do quiz

// Respostas enviadas pelo usuário (geralmente, um array de respostas do tipo [id_pergunta => resposta_usuario])
$respostas = $_POST['respostas']; // Um array JSON contendo as respostas do usuário
$respostas_json = json_encode($respostas);

// ID do quiz realizado
$id_quiz = $_POST['id_quiz']; // O ID do quiz (deve ser enviado com os dados)

// Adicionar a variável 'materia' (supondo que seja passada no POST)
$materia = $_POST['materia']; // Captura a matéria do quiz, enviada no POST

try {
    // Inserção de dados na tabela atividade, incluindo a matéria
    $sql = "INSERT INTO atividade (id_usuario, data_realizacao, pontuacao, respostas, id_quiz, total_perguntas, materia)
            VALUES (:id_usuario, CURRENT_TIMESTAMP, :pontuacao, :respostas, :id_quiz, :total_perguntas, :materia)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':pontuacao', $pontuacao);
    $stmt->bindParam(':total_perguntas', $total_perguntas);
    $stmt->bindParam(':respostas', $respostas_json);
    $stmt->bindParam(':id_quiz', $id_quiz);
    $stmt->bindParam(':materia', $materia); // Bind da matéria
    $stmt->execute();

    echo "Atividade salva com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao salvar atividade: " . $e->getMessage();
}
?>

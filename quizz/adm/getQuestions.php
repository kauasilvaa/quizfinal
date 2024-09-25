<?php
require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';

// Busca as perguntas no banco de dados
$stmt = $pdo->prepare("SELECT * FROM perguntas");
if ($stmt->execute()) {
    $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Verifica se há perguntas e retorna em JSON
    header('Content-Type: application/json');
    echo json_encode($perguntas);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Não foi possível buscar as perguntas.']);
}
?>

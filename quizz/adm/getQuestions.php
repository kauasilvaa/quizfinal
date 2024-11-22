<?php
// Carrega as configurações de conexão ao banco de dados
require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';

try {
    // Prepara a query para buscar as perguntas, incluindo a coluna 'conclusao'
    $stmt = $pdo->prepare("SELECT titulo_pergunta, opcao1, opcao2, opcao3, opcao4, resposta_correta, conclusao FROM perguntas");

    // Executa a query
    if ($stmt->execute()) {
        $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Define o cabeçalho para JSON
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: 0');

        // Verifica se há perguntas e retorna em JSON
        if (!empty($perguntas)) {
            echo json_encode($perguntas);
        } else {
            echo json_encode(['error' => 'Nenhuma pergunta encontrada.']);
        }
    } else {
        // Retorna uma mensagem de erro em caso de falha na execução da query
        throw new Exception('Falha ao executar a consulta no banco de dados.');
    }
} catch (Exception $e) {
    // Em caso de exceção, retorna uma mensagem de erro
    header('Content-Type: application/json');
    http_response_code(500); // Código de status HTTP para erro interno no servidor
    echo json_encode(['error' => $e->getMessage()]);
}

<?php
session_start();

// Verifica se o usuário é administrador
if ($_SESSION['nivel_acesso'] != 1) {
    header('Location: login.php');
    exit();
}

// Verifica se o ID do usuário foi passado via URL
if (isset($_GET['id'])) {
    // Conexão com o banco de dados
    require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';

    // ID do usuário a ser deletado
    $id_usuario = intval($_GET['id']);

    // Consulta de exclusão
    $sql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    // Executa a exclusão e verifica o resultado
    if ($stmt->execute()) {
        $_SESSION['message'] = "Usuário deletado com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao deletar usuário.";
    }
}

// Redireciona para a página de gerenciamento de usuários
header('Location: manage_users.php');
exit();
?>
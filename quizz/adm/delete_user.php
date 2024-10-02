<?php
session_start();

// Verifica se o usuário é administrador
if ($_SESSION['nivel_acesso'] != 1) {
    header('Location: login.php');
    exit();
}

 // ID do usuário a ser deletado
 $id_usuario =$_GET['id_usuario'];

 if (!$id_usuario) {
    header('Location: manage_users.php');
    exit();
} else {

// Verifica se o ID do usuário foi passado via URL
    // Conexão com o banco de dados
    require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';

   

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
    header('Location: manage_users.php');
    exit();
}



?>
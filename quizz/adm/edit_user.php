<?php
session_start();

if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';

$id_usuario = $_GET['id_usuario'] ?? null;

if (!$id_usuario) {
    header('Location: manage_users.php');
    exit();
}

// Busca o usuário atual
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nivel_acesso = $_POST['nivel_acesso'];

    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, nivel_acesso = ? WHERE id_usuario = ?");
    $stmt->execute([$nome, $email, $nivel_acesso, $id_usuario]);

    header('Location: manage_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $user['nome']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label for="nivel_acesso">Nível de Acesso:</label>
        <select id="nivel_acesso" name="nivel_acesso" required>
            <option value="1" <?php echo $user['nivel_acesso'] == 1 ? 'selected' : ''; ?>>Administrador</option>
            <option value="0" <?php echo $user['nivel_acesso'] == 0 ? 'selected' : ''; ?>>Usuário Comum</option>
        </select><br>

        <button type="submit">Salvar</button>
    </form>
    <a href="manage_users.php">Voltar</a>
</body>
</html>
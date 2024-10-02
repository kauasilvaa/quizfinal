<?php
session_start();

// Verifica se o usuário está logado e se tem nível de acesso 1 (Administrador)
if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] != 1) {
    header('Location: login.php'); // Redireciona para a página de login se não for admin
    exit();
}

require_once 'C:\xampp\htdocs\quizfinal\quizfinal\quizz\db\config.php';
require_once 'C:\xampp\htdocs\quizfinal\quizfinal\quizz\MVC\Controller\UserController';

// Carrega a lógica de controle dos usuários
$usersController = new UserController($pdo);

// Exemplo de lógica para obter a lista de usuários do banco de dados
$users = $usersController->listUsers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="admin-wrapper">
        <nav class="admin-nav">
            <div class="nav-logo">
                <img src="../img/logo.jfif" class="logo">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="nav-menu">
                <ul>
                    <li><a href="admin_dashboard.php" class="link active">Dashboard</a></li>
                    <li><a href="../adm/cadastroperguntas.php" class="link">Cadastro Perguntas</a></li>
                    <li><a href="reports.php" class="link">Relatórios</a></li>
                    <li><a href="settings.php" class="link">Configurações</a></li>
                </ul>
            </div>
            <div class="nav-logout">
                <a href="logout.php" class="btn">Sair</a>
            </div>
        </nav>

        <div class="content">
            <header>
                <h2>Bem-vindo, Administrador!</h2>
                <p>Aqui você pode gerenciar usuários e visualizar informações importantes.</p>
            </header>

            <section class="user-management">
                <h3>Lista de Usuários</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nome de Usuário</th>
                            <th>Email</th>
                            <th>Nível de Acesso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id_usuario']; ?></td>
                                <td><?php echo $user['nome']; ?></td>
                                <td><?php echo $user['nomedeusuario']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['nivel_acesso'] == 1 ? 'Administrador' : 'Usuário Comum'; ?></td>
                                <td>
                                    <a href="edit_user.php?id_usuario=<?php echo $user['id_usuario']; ?>" class="btn">Editar</a>
                                    <a href="delete_user.php?id_usuario=<?php echo $user['id_usuario']; ?>" class="btn">Deletar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <section class="reports">
                <h3>Relatórios Recentes</h3>
                <p>Verifique os relatórios de atividades recentes e análises detalhadas.</p>
                <!-- Exemplo de link para página de relatórios -->
                <a href="reports.php" class="btn">Visualizar Relatórios</a>
            </section>

        </div>
    </div>
</body>

</html>
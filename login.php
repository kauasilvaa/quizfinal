<?php
session_start();
require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';
require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/MVC/Controller/UserController';

$usersController = new UserController($pdo);

// Processo de cadastro
if (
    isset($_POST['nome']) &&
    isset($_POST['nomedeusuario']) &&
    isset($_POST['email']) &&
    isset($_POST['senha'])
) {
    $usersController->createUser(
        $_POST['nome'], 
        $_POST['nomedeusuario'], 
        $_POST['email'], 
        $_POST['senha']
    );

    $_SESSION['message'] = 'Cadastro realizado com sucesso!';
    header('Location: login.php');
    exit();
}
// Processo de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Entrar'])) {
    $resultado = $usersController->fazerlogin($_POST['nomedeusuario'], $_POST['senha']);
    
    if ($resultado) {
        $_SESSION['id_usuario'] = $resultado['id_usuario']; // Salva o ID do usuário na sessãoo
        $_SESSION['nome'] = $resultado['nome']; // Salva o nome do usuário
        $_SESSION['nivel_acesso'] = $resultado['nivel_acesso']; // Salva o nível de acesso na sessão
        
        // Redireciona com base no nível de acesso
        if ($_SESSION['nivel_acesso'] == 1) {
            header('Location: quizz/adm/admin_dashboard.php'); // Página de administrador
        } else {
            header('Location: index.php'); // Página de usuário comum
        }
        exit(); // Finaliza a execução
    } else {
        $_SESSION['message'] = 'Login falhou. Usuário ou senha inválidos.';
        header('Location: login.php');
        exit(); // Finaliza a execução
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="quizz/css/login.css">
    <title>Ludiflex | Login & Registration</title>
</head>

<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <img src="quizz/img/logo.jfif" class="logo">
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="#" class="link active">Home</a></li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Entrar</button>
                <button class="btn" id="registerBtn" onclick="register()">Cadastrar</button>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <!----------------------------- Form box ----------------------------------->
        <div class="form-box">

            <!------------------- login form --------------------------->
            <div class="login-container" id="login">
                <form method="post">
                    <div class="top">
                        <span>Não tem uma conta? <a href="#" onclick="register()">Faça Aqui</a></span>
                        <header>Login</header>
                    </div>
                    <div class="input-box">
                        <input type="text" name="nomedeusuario" class="input-field" placeholder="NomeDeUsuario" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="senha" class="input-field" placeholder="Senha" required>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <input type="hidden" name="Entrar" value="1">
                    <div class="input-box">
                        <input type="submit" name="Entrar" class="submit" value="Entrar">
                    </div>
                </form>
            </div>

            <!------------------- registration form --------------------------->
            <form method="post" class="register-container" id="register">
                <div class="top">
                    <span>Tem uma Conta? <a href="#" onclick="login()">Login</a></span>
                    <header>Cadastrar</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" name="nome" placeholder="Nome" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="nomedeusuario" placeholder="Nome De Usuário" required>
                        <i class="bx bx-envelope"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" name="email" placeholder="Email" required>
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="senha" placeholder="Senha" required>
                    <i class="bx bx-lock-alt"></i>
                </div>

                <!-- Campo para selecionar o nível de acesso -->
                <div class="input-box">
        
                    </select>
        
                </div>

                <div class="input-box">
                    <input type="submit" class="submit" value="Registrar">
                </div>
            </form>
            <div class="two-col"></div>

        </div>
    </div>

    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");

            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>

    <script>
        var a = document.getElementById("loginBtn");
        var b = document.getElementById("registerBtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function login() {
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }

        function register() {
            x.style.left = "-510px";
            y.style.right = "5px";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>

</body>

</html>

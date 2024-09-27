<?php
session_start();

// Verifica se o usuário está logado e tem nível de acesso 1 (Administrador)
if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'C:/xampp/htdocs/quizfinal/quizfinal/quizz/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo_pergunta = $_POST['titulo_pergunta'];
    $opcao1 = $_POST['opcao1'];
    $opcao2 = $_POST['opcao2'];
    $opcao3 = $_POST['opcao3'];
    $opcao4 = $_POST['opcao4'];
    $resposta_correta = $_POST['resposta_correta'];
    $conclusao = $_POST['conclusao'];

    if (!empty($titulo_pergunta) && !empty($opcao1) && !empty($opcao2) && !empty($opcao3) && !empty($opcao4) && !empty($resposta_correta) && !empty($conclusao)) {
        // Insere os dados no banco de dados
        $stmt = $pdo->prepare("INSERT INTO perguntas (titulo_pergunta, opcao1, opcao2, opcao3, opcao4, resposta_correta, conclusao) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$titulo_pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta_correta, $conclusao]);
        $mensagem = "Pergunta cadastrada com sucesso!";
    } else {
        $mensagem = "Preencha todos os campos!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pergunta</title>
    <link rel="stylesheet" href="../css/cadastroperguntas.css">
</head>

<body>
    <div class="container">
        <div class="form-wrapper">
            <h2>Cadastrar Nova Pergunta</h2>
            <?php if (isset($mensagem)) {
                echo "<p class='mensagem'>$mensagem</p>";
            } ?>
            <form action="" method="POST">
                <label for="titulo_pergunta">Título da Pergunta</label>
                <input type="text" name="titulo_pergunta" id="titulo_pergunta" placeholder="Digite a pergunta" required>

                <label for="opcao1">Opção 1</label>
                <input type="text" name="opcao1" id="opcao1" placeholder="Digite a primeira opção" required>

                <label for="opcao2">Opção 2</label>
                <input type="text" name="opcao2" id="opcao2" placeholder="Digite a segunda opção" required>

                <label for="opcao3">Opção 3</label>
                <input type="text" name="opcao3" id="opcao3" placeholder="Digite a terceira opção" required>

                <label for="opcao4">Opção 4</label>
                <input type="text" name="opcao4" id="opcao4" placeholder="Digite a quarta opção" required>

                <label for="resposta_correta">Resposta Correta</label>
                <select name="resposta_correta" id="resposta_correta" required>
                    <option value="1">Opção 1</option>
                    <option value="2">Opção 2</option>
                    <option value="3">Opção 3</option>
                    <option value="4">Opção 4</option>
                </select>

                <label for="conclusao">Conclusão</label>
                <textarea name="conclusao" id="conclusao" placeholder="Digite a conclusão da pergunta" required></textarea>

                <button type="submit">Cadastrar Pergunta</button>
                <button onclick="window.history.back();" style="padding: 10px 20px; background-color: #e0e7ea; border: 1px solid #ccc; border-radius: 5px; color: black; cursor: pointer;">Voltar</button>
            </form>
        </div>
    </div>
</body>

</html>

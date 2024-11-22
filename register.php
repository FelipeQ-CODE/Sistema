<?php
require 'db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Prepara e executa a consulta para inserir o usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    // Verifica se a execução foi bem-sucedida
    if ($stmt->execute([$username, $email, $password])) {
        // Redireciona para o dashboard após o sucesso do registro
        header("Location: dashboard.php");
        exit();
    } else {
        // Exibe mensagem de erro caso o registro falhe
        $error = "Erro ao registrar o usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="/images/cabeleira.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 400px;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: column; /* Coloca os elementos na vertical */
            align-items: center;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .toggle-link {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #007BFF;
            cursor: pointer;
        }
        .logo-container img {
            max-width: 80%; /* Limita a largura da imagem */
            height: auto;
            margin-bottom: 20px; /* Adiciona espaçamento abaixo da imagem */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo acima do formulário -->
        <div class="logo-container" style="text-align: center; margin-top: 20px;">
            <img src="https://www.projeto.comerciodosite.com.br/images/cabeleira.png" alt="Logo do Comércio do Site">
        </div>

        <h1>Registro</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Formulário de Registro -->
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Nome de Usuário</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Registrar</button>
        </form>

        <span class="toggle-link" onclick="window.location.href='login.php'">Já tem uma conta? Faça login aqui</span>
    </div>
</body>
</html>

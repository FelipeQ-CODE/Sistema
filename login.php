<?php
session_start();
require 'db/config.php';  // Verifique se esse arquivo está correto e o banco está acessível

$error = ''; // Variável para mensagens de erro

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Busca o usuário no banco de dados
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e se a senha está correta
        if ($user && password_verify($password, $user['password'])) {
            // Inicia a sessão e armazena o ID do usuário
            $_SESSION['user_id'] = $user['id'];

            // Redireciona para o dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Caso a autenticação falhe, exibe uma mensagem de erro
            $error = "Credenciais inválidas!";
        }
    } catch (PDOException $e) {
        // Caso ocorra erro na consulta ao banco de dados
        $error = "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - Login</title>
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
            <img src="https://www.projeto.comerciodosite.com.br/images/cabeleira.png" alt="Hair">
        </div>

        <h1>Login</h1>
        
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Formulário de Login -->
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>

        <span class="toggle-link" onclick="window.location.href='register.php'">Ainda não tem conta? Registre-se aqui</span>
    </div>
</body>
</html>

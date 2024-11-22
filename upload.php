<?php
session_start();
require 'includes/auth.php';

checkAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $message = "Arquivo enviado com sucesso!";
    } else {
        $message = "Erro ao enviar arquivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivos - Sistema Hair</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/cabeleira.png">
    <style>
        /* Estilo global */
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            background: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        /* Menu lateral */
        .sidebar {
            width: 250px;
            background-color: #000;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar .menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar .menu a:hover {
            background-color: #333;
        }

        .sidebar .menu a i {
            margin-right: 10px;
        }

        .sidebar .logout-btn {
            margin-top: auto;
            padding: 15px 20px;
            background-color: #d9534f;
            color: white;
            text-align: center;
            cursor: pointer;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar .logout-btn:hover {
            background-color: #c9302c;
        }

        /* Botão de toggle */
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background-color: transparent;
            color: #000;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 24px;
        }

        .toggle-btn:hover {
            color: #555;
        }

        /* Conteúdo principal */
        .content {
            flex: 1;
            padding: 30px;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }

        .header {
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        /* Estilo do formulário */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        form input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #45a049;
        }

        /* Mensagem de sucesso/erro */
        .message {
            text-align: center;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .message.success {
            color: #4CAF50;
        }

        .message.error {
            color: #d9534f;
        }
    </style>
</head>
<body>
    <!-- Botão de Toggle -->
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- Menu Lateral -->
    <div class="sidebar">
        <div class="logo">Menu</div>
        <div class="menu">
            <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="add_lead.php"><i class="fas fa-plus"></i> Adicionar Lead</a>
            <a href="leads.php"><i class="fas fa-users"></i> Ver Leads</a>
            <a href="report.php"><i class="fas fa-chart-bar"></i> Relatórios</a>
            <a href="upload.php"><i class="fas fa-upload"></i> Uploads</a>
        </div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </div>

    <!-- Conteúdo Principal -->
    <div class="content">
        <div class="header">
            <h1>Upload de Arquivos</h1>
        </div>

        <?php if (isset($message)): ?>
            <div class="message <?= strpos($message, 'sucesso') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        const sidebar = document.querySelector('.sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
        }
    </script>
</body>
</html>

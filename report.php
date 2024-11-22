<?php
session_start();
require 'includes/auth.php';
require 'db/config.php';

checkAuth();

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM leads WHERE user_id = ?");
$stmt->execute([$user_id]);
$total_leads = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Sistema Hair</title>
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
            display: none;
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

        .sidebar.open {
            display: flex;
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

        .chart-container {
            width: 80%;
            margin-top: 20px;
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
            <h1>Relatórios</h1>
        </div>

        <div class="chart-container">
            <canvas id="reportChart"></canvas>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
        }

        // Configuração do gráfico
        const ctx = document.getElementById('reportChart').getContext('2d');
        const reportChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total de Leads'],
                datasets: [{
                    label: 'Leads',
                    data: [<?= $total_leads; ?>],
                    backgroundColor: ['#4CAF50']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema Hair</title>
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
            background-color: #000; /* Fundo preto */
            color: white;
            display: flex; /* Sempre visível em desktops */
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%; /* Ocupar toda a altura */
            position: fixed; /* Fixa na coluna */
            left: 0;
            top: 0;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
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
            background-color: #333; /* Cinza escuro no hover */
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

        /* Botão de toggle (só visível em dispositivos móveis) */
        .toggle-btn {
            display: none;
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
            margin-left: 250px; /* Deixa espaço para a sidebar */
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

        /* Gráfico */
        .chart-container {
            width: 100%;
            margin-top: 20px;
            height: 400px; /* Altura padrão para mobile e tablets */
        }

        /* Estilo responsivo para dispositivos móveis */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px; /* Sidebar menor em telas pequenas */
            }

            .content {
                margin-left: 0; /* Remove o espaço da sidebar */
                padding: 20px;
            }

            .chart-container {
                margin: 0 auto; /* Centraliza o gráfico */
                width: 100%; /* Gráfico ocupa 100% da largura */
                height: 300px; /* Altura reduzida no mobile */
            }

            .toggle-btn {
                display: block; /* Exibe o botão para alternar a sidebar */
            }

            .sidebar {
                display: none; /* Sidebar oculta por padrão */
                position: absolute; /* Fixa à esquerda */
            }

            .sidebar.open {
                display: block; /* Exibe quando a classe "open" for adicionada */
            }

            .content {
                margin-left: 0; /* Remove o espaço lateral quando a sidebar estiver oculta */
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 150px; /* Sidebar ainda menor para telas pequenas */
            }

            .toggle-btn {
                top: 10px;
                left: 10px;
                font-size: 20px;
                color: #FFFF;
            }

            .header h1 {
                font-size: 18px; /* Texto menor para caber na tela */
            }
        }
    </style>
</head>
<body>
    <!-- Botão de Toggle (para dispositivos móveis) -->
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
            <h1>Bem-vindo, <?= htmlspecialchars($user['username'] ?? 'Usuário'); ?>!</h1>
        </div>

        <!-- Gráfico -->
        <div class="chart-container">
            <canvas id="leadChart"></canvas>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.toggle-btn');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
        }

        // Configuração do gráfico
        const ctx = document.getElementById('leadChart').getContext('2d');
        const leadChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lead 1', 'Lead 2', 'Lead 3', 'Lead 4'], // Labels de exemplo
                datasets: [{
                    label: 'Leads Registrados',
                    data: [12, 19, 3, 5], // Dados de exemplo
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Torna o gráfico responsivo
                maintainAspectRatio: false, // Permite ajustar a proporção
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

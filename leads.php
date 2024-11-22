<?php
// Dados simulados para exibição dos leads
$leads = [
    ['id' => 1, 'name' => 'João Silva', 'email' => 'joao@example.com', 'phone' => '11987654321', 'notes' => 'Interessado em planos mensais'],
    ['id' => 2, 'name' => 'Maria Oliveira', 'email' => 'maria@example.com', 'phone' => '21987654321', 'notes' => 'Precisa de mais informações'],
    ['id' => 3, 'name' => 'Carlos Pereira', 'email' => 'carlos@example.com', 'phone' => '31987654321', 'notes' => 'Agendou reunião'],
];

// Função para exportar dados para CSV
function exportCSV($leads) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=leads.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Nome', 'Email', 'Telefone', 'Notas']);
    foreach ($leads as $lead) {
        fputcsv($output, $lead);
    }
    fclose($output);
    exit;
}

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    exportCSV($leads);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Cadastrados</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/cabeleira.png">
    <style>
        /* Estilos compartilhados */
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            background: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #000;
            color: white;
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
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

        .content {
            flex: 1;
            padding: 30px;
            margin-left: 250px;
        }

        .table-container {
            background: white;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn-container a {
            text-decoration: none;
            background: #007BFF;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-container a:hover {
            background: #0056b3;
        }

        .export-btns a {
            background-color: #4CAF50;
            color: white;
        }

        .export-btns a:hover {
            background-color: #45a049;
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
        <h1>Leads Cadastrados</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Notas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?= htmlspecialchars($lead['id']); ?></td>
                            <td><?= htmlspecialchars($lead['name']); ?></td>
                            <td><?= htmlspecialchars($lead['email']); ?></td>
                            <td><?= htmlspecialchars($lead['phone']); ?></td>
                            <td><?= htmlspecialchars($lead['notes']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="btn-container">
            <a href="add_lead.php">Adicionar Novo Lead</a>
            <div class="export-btns">
                <a href="?export=csv">Exportar para CSV</a>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('open');
        }
    </script>
</body>
</html>

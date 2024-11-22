<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Sistema</title>
    <link href="assets/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/cabeleira.png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            overflow: hidden;
        }

        .container {
            text-align: center;
            max-width: 800px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .logo {
            width: 180px;
            margin-bottom: 30px;
            animation: bounce 1.5s ease-in-out infinite alternate;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0); }
        }

        h1 {
            font-size: 30px;
            color: #007BFF;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .feature {
            background-color: #f2f4f7;
            border-radius: 8px;
            padding: 20px;
            margin: 0 15px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .feature h3 {
            font-size: 22px;
            color: #007BFF;
            margin-bottom: 10px;
        }

        .feature p {
            color: #777;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        footer {
            position: absolute;
            bottom: 10px;
            color: #777;
            font-size: 14px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="images/cabeleira.png" alt="Logo Hair" class="logo">
        <h1>Bem-vindo ao Sistema de cadastros Hair</h1>
        <p>O nosso sistema oferece ferramentas práticas e poderosas para você cadastrar seus leads e exportar!</p>

        <div class="features">
            <div class="feature">
                <h3>Fácil Exportação</h3>
                <p>Permita que seus leads seja exportado de forma fácil e prática em csv.</p>
            </div>
            <div class="feature">
                <h3>Gestão de Clientes</h3>
                <p>Organize todos os seus clientes e mantenha o histórico dos seus leads.</p>
            </div>
            <div class="feature">
                <h3>Controle com Gráficos</h3>
                <p>Gerencie seus leads e acompanhe com um gráfico interativo.</p>
            </div>
        </div>

        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn">Registro</a>
    </div>

    <footer>
        <p>&copy; 2024 Sistema Hair - Todos os direitos reservados.</p>
    </footer>
</body>
</html>

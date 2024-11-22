# Sistema de Cadastro em PHP

Este projeto é um sistema simples de cadastro de leads, desenvolvido em PHP com integração a um banco de dados MySQL. O sistema permite que os usuários cadastrem leads e visualizem as informações de forma organizada, com funcionalidades adicionais de visualização de relatórios e uploads de arquivos.

## Funcionalidades

- **Cadastro de Leads**: Os usuários podem adicionar novos leads através de um formulário simples.
- **Visualização de Leads**: Exibe uma lista de todos os leads cadastrados.
- **Relatórios**: Geração de relatórios gráficos sobre o número de leads registrados.
- **Uploads de Arquivos**: Permite que os usuários façam o upload de arquivos associados aos leads.

## Tecnologias Utilizadas

- **PHP**: Para a lógica do backend.
- **MySQL**: Para o armazenamento dos dados.
- **HTML/CSS**: Para a estruturação e estilização das páginas.
- **JavaScript**: Para interação e gráficos no front-end.
- **Chart.js**: Biblioteca para gerar gráficos de relatórios.
- **XAMPP**: Ambiente de desenvolvimento para rodar o servidor PHP localmente.

## Pré-Requisitos

Antes de rodar o projeto, você precisa ter o seguinte instalado em sua máquina:

- [XAMPP](https://www.apachefriends.org/index.html) ou outro servidor local (Apache + MySQL)
- PHP 7.4 ou superior
- MySQL

## Configuração do Banco de Dados

1. **Criação do Banco de Dados**: 
   No phpMyAdmin ou no seu cliente de banco de dados favorito, crie um banco de dados chamado `test` (ou qualquer outro nome que você preferir).
   
   Execute o seguinte script SQL para criar as tabelas:

   ```sql
   CREATE TABLE `users` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `username` varchar(255) NOT NULL,
     `password` varchar(255) NOT NULL,
     `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
     PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

   CREATE TABLE `files` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `user_id` int(11) NOT NULL,
     `filename` varchar(255) NOT NULL,
     `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
     PRIMARY KEY (`id`),
     KEY `user_id` (`user_id`),
     CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Deixe vazio se você estiver usando o XAMPP sem senha
define('DB_DATABASE', 'test');


/sistema-cadastro-php
/sistema-cadastro-php
│
├── /assets                # Arquivos estáticos (CSS, JS, imagens)
│   ├── /css
│   │   ├── style.css      # Arquivo principal de estilos
│   │   └── bootstrap.css  # Estilos do Bootstrap (caso utilize)
│   ├── /js
│   │   ├── script.js      # Scripts principais de interação
│   │   └── jquery.min.js  # Dependência jQuery (caso utilize)
│   └── /images
│       └── cabelera.png       # Imagem de logo ou outros recursos
│
├── /uploads               # Arquivos enviados (uploads)
│   └── (diretório vazio)  # Aqui serão armazenados os arquivos enviados pelos usuários
│
├── /includes              # Arquivos de inclusão (conexões, funções)
│   ├── db.php             # Configuração de conexão com o banco de dados
│   ├── functions.php      # Funções utilitárias do sistema (ex: sanitização de dados)
│   └── auth.php           # Funções de autenticação de usuários
│
├── /pages                 # Páginas principais do sistema (cadastro, visualização, etc)
│   ├── index.php          # Página inicial (login ou redirecionamento)
│   ├── dashboard.php      # Página de visualização do painel
│   ├── add_lead.php       # Página para adicionar um novo lead
│   ├── leads.php          # Página para listar os leads cadastrados
│   ├── report.php         # Página para gerar e exibir gráficos de relatórios
│   ├── upload.php         # Página para fazer o upload de arquivos
│   └── login.php          # Página de login
│
├── db.php                 # Configuração de conexão ao banco de dados
├── index.php              # Página principal do sistema (login ou redirecionamento)
└── README.md              # Documentação do projeto


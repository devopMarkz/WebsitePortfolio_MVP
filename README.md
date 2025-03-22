# 📌 Website de Portfólio Digital

Este é um **MVP** de um site que permite que os usuários criem, editem e compartilhem seus portfólios digitais.

## 🚀 Tecnologias Utilizadas
- **Frontend:** HTML, CSS, JavaScript puro
- **Backend:** PHP
- **Banco de Dados:** MySQL (rodando no Docker, porta 3307)
- **Servidor:** Apache (via XAMPP)

## 📌 Funcionalidades
✅ **Registro e Login de Usuários**  
✅ **Criação de Portfólios** (com upload de imagem)  
✅ **Edição e Exclusão de Portfólios**  
✅ **Visualização de Portfólios**  
✅ **Compartilhamento via Link**  

## 📂 Estrutura do Projeto
```
/portfolio-website
 ├── /assets
 │   ├── /css
 │   │   └── style.css
 │   ├── /js
 │   │   └── main.js
 │   ├── /img
 ├── /backend
 │   ├── config.php
 │   ├── auth.php
 │   ├── register.php
 │   ├── login.php
 │   ├── logout.php
 │   ├── save_portfolio.php
 │   ├── edit_portfolio.php
 │   ├── delete_portfolio.php
 │   ├── get_portfolios.php
 ├── /users
 │   ├── index.php
 ├── index.html
 ├── login.html
 ├── register.html
 ├── portfolio.html
 ├── README.md
 ```


## 💻 Como Rodar o Projeto
1. Instale o **XAMPP** e inicie o **Apache** e **MySQL**.

2. No **phpMyAdmin**, crie um banco de dados chamado **`portfolio_db`** e execute este SQL:
   ```sql
   CREATE DATABASE portfolio_db;

   USE portfolio_db;

   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE portfolios (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       name VARCHAR(100) NOT NULL,
       description TEXT NOT NULL,
       image VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );

3. Coloque os arquivos em C:/xampp/htdocs/portfolio-website/.

4. Acesse no navegador:

http://localhost/portfolio-website/ → Página Inicial

http://localhost/portfolio-website/login.html → Login

http://localhost/portfolio-website/users/index.php → Painel do Usuário

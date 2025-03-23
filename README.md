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
 │   │   ├── style.css
 │   │   ├── index.css
 │   │   ├── users.css
 │   │   ├── portfolio.css
 │   │   ├── profile.css
 │   │   ├── edit_profile.css
 │   │   ├── create_portfolio.css
 │   │   ├── login.css
 │   │   ├── register.css
 │   │   ├── navbar.css
 │   ├── /js
 │   │   ├── main.js
 │   │   ├── animations.js
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
 │   ├── get_portfolio.php
 │   ├── add_comment.php
 │   ├── get_comments.php
 │   ├── update_profile.php
 ├── /users
 │   ├── index.php
 │   ├── create_portfolio.php
 ├── /includes
 │   ├── navbar.php
 ├── index.html
 ├── login.html
 ├── register.html
 ├── portfolio.php
 ├── profile.php
 ├── edit_profile.php
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
       profile_pic VARCHAR(255) DEFAULT 'default.png',
       bio TEXT DEFAULT '',
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

   CREATE TABLE comments (
       id INT AUTO_INCREMENT PRIMARY KEY,
       portfolio_id INT NOT NULL,
       user_id INT NOT NULL,
       comment TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );
   

3. Coloque os arquivos em C:/xampp/htdocs/portfolio-website/.

4. Acesse no navegador:

   - [Página Inicial](http://localhost/portfolio-website/)
   - [Login](http://localhost/portfolio-website/login.html)
   - [Cadastro](http://localhost/portfolio-website/register.html)
   - [Painel do Usuário (Dashboard)](http://localhost/portfolio-website/users/index.php)
   - [Criar Novo Portfólio](http://localhost/portfolio-website/users/create_portfolio.php)
   - [Perfil do Usuário](http://localhost/portfolio-website/profile.php)
   - [Editar Perfil](http://localhost/portfolio-website/edit_profile.php)
   - [Visualizar Portfólio](http://localhost/portfolio-website/portfolio.php?id=1) *(Substituir `id=1` pelo ID real do portfólio)*
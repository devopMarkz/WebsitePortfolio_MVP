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
✅ **Visualização de Perfil Pessoal**  
✅ **Edição de Perfil Pessoal**    

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

### 🛠 1. Pré-requisitos
Antes de iniciar, certifique-se de ter os seguintes programas instalados:

- **[XAMPP](https://www.apachefriends.org/pt_br/index.html)** (para rodar Apache e PHP)  
  Ao baixar o XAMPP, abra o aplicativo e **clique em "Start" no módulo Apache** para iniciar o servidor local.
- **[Docker](https://www.docker.com/get-started)** (para rodar o banco MySQL)
- **Um SGBD de sua preferência** (ex: **MySQL Workbench**, **DBeaver**, **HeidiSQL**, etc.)

### 🐳 2. Configurando o MySQL no Docker
Se ainda não possui um contêiner MySQL rodando, siga os passos abaixo:

1. **Baixar e rodar um contêiner MySQL**:
   ```sh
   docker run --name mysql-portfolio -e MYSQL_ROOT_PASSWORD=123 -e MYSQL_DATABASE=portfolio_db -p 3307:3306 -d mysql:latest
   ```

2. **Verificar se o contêiner está rodando**:
   ```sh
   docker ps
   ```

### 🛠 3. Configurar o Projeto no XAMPP

1. **Baixe ou clone o projeto** no diretório do XAMPP:
   ```sh
   cd C:/xampp/htdocs
   git clone https://github.com/devopMarkz/WebsitePortfolio_MVP.git
   ```

2. **Configurar o arquivo `backend/config.php`**  
   ```php
   <?php
   $host = "127.0.0.1";
   $dbname = "portfolio_db";
   $username = "root";
   $password = "123";
   $port = "3307"; // Porta do Docker

   try {
       $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
       die("Erro na conexão: " . $e->getMessage());
   }
   ?>
   ```

### 🗄 4. Criando o Banco de Dados e Tabelas

1. **Abra seu SGBD preferido** (ex: MySQL Workbench, DBeaver, HeidiSQL).  
2. **Conecte-se ao banco de dados MySQL no Docker** com os seguintes dados:
   - **Host:** `127.0.0.1`
   - **Porta:** `3307`
   - **Usuário:** `root`
   - **Senha:** `123`
   - **Banco de dados:** `portfolio_db`  

3. **Execute os comandos SQL abaixo** para criar as tabelas:
   ```sql
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
   ```

### 🔥 5. Executando o Projeto
1. **Inicie o Apache pelo XAMPP**.
2. **Acesse o site no navegador**:
   - [Página Inicial](http://localhost/portfolio-website/)
   - [Login](http://localhost/portfolio-website/login.html)
   - [Registro](http://localhost/portfolio-website/register.html)
   - [Painel do Usuário (Dashboard)](http://localhost/portfolio-website/users/index.php)
   - [Criar Novo Portfólio](http://localhost/portfolio-website/users/create_portfolio.php)
   - [Perfil do Usuário](http://localhost/portfolio-website/profile.php)
   - [Editar Perfil](http://localhost/portfolio-website/edit_profile.php)
   - [Visualizar Portfólio](http://localhost/portfolio-website/portfolio.php?id=1) *(Substituir `id=1` pelo ID real do portfólio)*

Agora o **Website de Portfólio Digital** está pronto para uso! 🚀🔥

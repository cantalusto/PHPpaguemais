🏥 Sistema de Farmácia - Pague Mais

Este projeto é um sistema simples de gerenciamento para uma farmácia, desenvolvido em PHP com PDO e estilizado com Bootstrap 5. Ele permite realizar:

- Login e logout
- Cadastro, edição e exclusão de usuários
- Cadastro, edição e exclusão de produtos
- Responsividade via Bootstrap

---

👥 Integrantes do Grupo

- Lucas Cantarelli Lustosa
- Danilo Mendes
- Thiago Duarte

---

🧰 Tecnologias Utilizadas

- PHP (PDO)
- Bootstrap 5
- HTML5 / CSS3
- MySQL (phpMyAdmin)
- Servidor local (XAMPP, WAMP ou CHAMP)

---

⚙️ Como Preparar o Ambiente

1. Baixe e instale um servidor local:

Recomendado: CHAMP, XAMPP ou WAMP

2. Coloque os arquivos no diretório do servidor:

- Extraia os arquivos ZIP do projeto
- Coloque a pasta do sistema em:

  C:/xampp/htdocs/farmacia
  ou
  C:/champ/htdocs/farmacia

3. Importe o banco de dados:

- Acesse o phpMyAdmin pelo navegador: http://localhost/phpmyadmin
- Crie um banco com o nome: farmacia
- Importe o arquivo farmacia.sql que está na raiz do projeto

4. Configure o arquivo de conexão:

O arquivo includes/config.php já vem configurado para:

  $pdo = new PDO("mysql:host=localhost;dbname=farmacia", "root", "");

Se você tiver senha no MySQL, adicione no campo "root", "SENHA_AQUI"

5. Acesse o sistema:

Abra no navegador: http://localhost/farmacia/login.php

---

📝 Notas Finais

- O projeto usa Bootstrap via CDN para maior praticidade.
- Caso deseje usar Bootstrap offline, inclua os arquivos bootstrap.min.css e bootstrap.bundle.min.js nas pastas /css e /js.
- O sistema foi criado com fins didáticos para a disciplina de Programação Web.

📌 Qualquer dúvida, entre em contato com um dos integrantes do grupo.
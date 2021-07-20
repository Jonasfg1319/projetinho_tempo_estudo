
# projetinho_tempo_estudo

Um projeto pessoal para controlar o tempo de estudo diário

# Como funciona?

Na tela inicial o usuário tem a opção de fazer login ou se cadastrar. Para autenticação e novos registros foi usado bcrypt

![tempoestudo1](https://user-images.githubusercontent.com/24599447/126216053-cb63b360-06c0-4e6b-a972-e06acb8913aa.png)

Já logado, o usuário tem em seu perfil os dados de todas as horas estudadas desde seu cadastro e em seu feed

![ap2](https://user-images.githubusercontent.com/24599447/126224331-35056622-1d89-483d-860c-c042d248fcda.png)


Ele tem a opção de começar a estudar, na página de estudos ele tem um cronometro para iniciar. Após terminar o tempo de estudo, terá um bloco para fazer anotações.

![ap3](https://user-images.githubusercontent.com/24599447/126224849-1a529137-183d-493d-948f-2cac2c722767.png)


Clicando em salvar, seu registro e data será salvo no sistema. Voltando para a página inicial, ele poderá conferir suas horas de estudo atualizadas 

![ap4](https://user-images.githubusercontent.com/24599447/126225283-c8b23b40-4a81-4005-ac9c-bcb6e65fba05.png)

# Tecnologias usadas

- Php 7
- HTML 
- CSS
- Bootstrap
- Javascript
- MYSQL

# Scripts

Foi usado o padrão MVC para construir esse projeto

Pasta public

Contém o arquivo Index.php que apenas direciona para o script Route.php dentro da pasta app. Há também as pastas css e js, onde temos os arquivos de front-end da nossa aplicação, midias e scripts para rodar no navegador.

- Pasta App

Route.php

Inicia as rotas da nossa aplicação, direcionando para os controllers de acordo com a url da página.

Connection.php

Faz a conexão com o banco de dados mysql usando PDO.

- Pasta App/Controllers

Aqui temos os controladores da nossa aplicação, o arquivo IndexController controla a parte pública enquanto o arquivo AppController controla a parte onde apenas usuários autenticados tem acesso.

- Pasta App/Models

Aqui temos nossas classes de manipulação das tabelas do banco de dados, cada model representa uma tabela. A função de cada model é fornecer as operações de banco de dados naquela determinada tabela. 

O model Usuário contém os metódos de inserir(insert) e autenticar(authenticate) um usuário.

O model Registro contém os metódo de inserir um novo registro de estudo.

O model Senha faz a tratativa usando bcrypt da senha cadastrada e verifica se a senha digitada no campo senha do login tem o mesmo hash da senha cadastrada no banco de dadoa.

O model Teste soma as horas estudadas no momento da finalização do estudo ás horas que já foram estudadas anteriormente, retornando assim o tempo total de horas estudadas desde a criação da conta do usuário.

- Pasta App/Views

Contém os arquivoss html com a parte visual da nossa aplicação.

- Pastas e arquivos contidos no diretório principal do projeto.

Correspondem aos arquivos do gerenciador de pacotes composer, gerenciador que auxiliou no desenvolvimento da aplicação.

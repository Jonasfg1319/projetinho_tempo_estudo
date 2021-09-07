
# projetinho_tempo_estudo

Um projeto pessoal para controlar o tempo de estudo diário

# Como funciona?

Na tela inicial o usuário tem a opção de fazer login ou se cadastrar. Para autenticação e novos registros foi usado bcrypt

![tempoestudo1](https://user-images.githubusercontent.com/24599447/126216053-cb63b360-06c0-4e6b-a972-e06acb8913aa.png)

Já logado, o usuário tem em seu perfil os dados de todas as horas estudadas desde seu cadastro e em seu feed

![ap2](https://user-images.githubusercontent.com/24599447/126224331-35056622-1d89-483d-860c-c042d248fcda.png)


Ele tem a opção de começar a estudar, na página de estudos ele tem um cronometro para iniciar. Após terminar o tempo de estudo, terá um bloco para fazer anotações.

![ap3](https://user-images.githubusercontent.com/24599447/126224849-1a529137-183d-493d-948f-2cac2c722767.png)


Clicando em salvar, seu registro e data será salvo no sistema. Voltando para a página inicial, você poderá conferir suas horas de estudo atualizadas. O app é publico, então você pode ver os registros de todos os usuários na timeline.

![ap4](https://user-images.githubusercontent.com/24599447/126225283-c8b23b40-4a81-4005-ac9c-bcb6e65fba05.png)


# Como rodar?

É necessário ter instalado na sua máquina 

```
Php 7 ou superior
composer
```

Após baixar a pasta do projeto, é necessário setar o banco de dados da sua maquina local no arquivo Connection.php que está localizado no diretório app

Neste projeto, foi usado o banco de dados Mysql

```
<?php 

namespace App;

abstract class Connection{

	public function getConnection(){

		try{

			$conn = new \PDO(
				"mysql:host=SEU_HOST;dbname=NOME_DE_SEU_BANCO_DADOS;charset=utf8",
				"SEU_USUARIO",
				"SUA_SENHA_DE_USUARIO" 
			);

			return $conn;

		}catch(\PDOException $e){
           echo "Erro: ". $e->getMessage();
		}
	}
}
```

É necessário criar as tabelas correspondentes aos models da aplicação como Registro e Usuario

Neste projeto não está sendo usado migrations, então, rode no seu banco de dados as querys a seguir:

```
create table usuarios(
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome varchar(250) NOT NULL,
  email varchar(250) NOT NULL,
  senha varchar(250) NOT NULL,
);


create table registros(
   id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
   id_usuario int NOT NULL,
   horas_atuais varchar(250) NOT NULL,
   data timestamp NOT NULL,
   horas_totais int NOT NULL,
   minutos_totais int NOT NULL,
   segundos_totais int NOT NULL,
   CONSTRAINT FOREIGN KEY (id_usuario) RERERENCES usuarios(id)
);

CREATE TABLE notas(
    id int not null PRIMARY KEY, 
    id_usuario int not null,
    id_registro int not null,
    titulo varchar(250) not null,
    conteudo text not null,
    CONSTRAINT FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT FOREIGN KEY (id_registro) REFERENCES registros(id)
)

```

feito isso, abra o terminal e navegue até a pasta public do projeto.

Rode 

```
php -S localhost:8080
```


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

Enquanto os controllers IndexController e AppController cuidam das operações de acordo com a visibilidade da aplicação, o controller Abstraction serve apenas para renderizar a view direcionada pelos outros controladores.

A classe Senha faz a tratativa usando bcrypt da senha cadastrada e verifica se a senha digitada no campo senha do login tem o mesmo hash da senha cadastrada no banco de dadoa.

A classe Tempo soma as horas estudadas no momento da finalização do estudo ás horas que já foram estudadas anteriormente, retornando assim o tempo total de horas estudadas desde a criação da conta do usuário.


- Pasta App/Models

Aqui temos nossas classes de manipulação das tabelas do banco de dados, cada model representa uma tabela. A função de cada model é fornecer as operações de banco de dados naquela determinada tabela. 

O model Usuário contém os metódos de inserir(insert) e autenticar(authenticate) um usuário.

O model Registro contém o metódo de inserir um novo registro de estudo.

- Pasta App/Views

Contém os arquivoss html com a parte visual da nossa aplicação.

- Pastas e arquivos contidos no diretório principal do projeto.

Correspondem aos arquivos do gerenciador de pacotes composer, gerenciador que auxiliou no desenvolvimento da aplicação.

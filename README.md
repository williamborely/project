# PROJETO TESTE - CRUD DE GRUPOS DE MUNICIPIOS

## Instruções Iniciais

O projeto foi construido de forma simples utilizando PHP em um único arquivo .php
dessa forma o projeto ficaria mais leve para envio e também dinâmico.

Todas as requisições estão documentadas para informar o que e quando ela executa.

Para iniciar o teste basta inserir a pasta envia dentro de um servidor que interprete PHP como XAMPP, WAMPP, Apache em geral etc...


## Instruções do Banco de dados

O banco de dados foi construido para leitura de forma simples e padrão localhost.

Foram definidas algumas variáveis para receber informações do banco de dados e assim fazer a conexão PDO.

<pre>
define('HOST', 'localhost');  //Host Local
define('DBNAME', 'economapas'); // Nome do banco
define('CHARSET', 'utf8'); // Tipagem do texto
define('USER', 'root'); // Usuário default
define('PASSWORD', ''); // Password default (Vazio)
</pre>

Foi enviado junto aos arquivos o .sql com o banco configurado de acordo com os requisitos, contendo, dois usuários (Joao e Maria) com suas respectivas senhas (Também fornecidas no desafio). Contendo também mais duas tabelas, uma de estados (Municipios e Distritos) e uma outra para os grupos que seram criados pelo usuário.


## Para Utilização

Para utilizar basta acessar localhost/economapas e efetuar login, de cara terá o formulário para criar um novo grupo e logo abaixo uma listagem de grupos criado pelo usuário que está logado.

Facilmente alteravel caso seja necessário ver todos os grupos e não só os que o usuário criou.

Na tabela de grupos, cada um tem suas ações de EDITAR e EXCLUIR... onde é possivel navegar para fazer updates ou correções no grupo ou deletar ele se for necessário.

No codigo presente está sendo DELETADO de fato, apesar de que acredito melhor apesar desativar a visualização do usuáio para manter as informações dentro do banco...sem que se perca alguma informação..Processo de facil criação, basta trabalharmos com datas, adicionando colunas de data de adição, edição e exclusão... sendo assim a data de exclusão estando preenchida informa que aquele item foi deletado pelo usuário e nas querys os itens que tem data de exclusão não serão exibidos.
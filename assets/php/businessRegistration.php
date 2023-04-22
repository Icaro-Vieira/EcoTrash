<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'Ec@305três*');
define('DB_NAME', 'ecotrash');

$banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);

//Inoformações da PJ
$nome = $_POST['nome-empresa']; 
$documento = $_POST['cnpj']; 
$email = $_POST['email']; 
$telefone = $_POST['telefone']; 
$segmento = $_POST['segmento-empresa']; 
$senha = $_POST['senha']; 

//Informações do endereço
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$cep = $_POST['cep'];

//Criando uma consulta que retorna a quantidade de linhas da tabela "endereco" e definindo o id do endereço a ser inserido
$consultaEndereco = $banco->query("SELECT COUNT(*) FROM endereco");
$numRegistrosEndereco = $consultaEndereco->fetchColumn();

$idEndereco = $numRegistrosEndereco + 1;

//Criando uma array para o endereço
$novoEndereco = array($idEndereco, $logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep);

//Inserir endereço
$inserirEndereco = $banco->prepare("INSERT INTO endereco (ID, LOGRADOURO, NUMERO, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, CEP) VALUES (?,?,?,?,?,?,?,?);");

$inserirEndereco->execute($novoEndereco);

//Criando uma consulta que retorna a quantidade de linhas da tabela "cadastro" e definindo o id do cadastro
$consultaCadastro = $banco->query("SELECT COUNT(*) FROM cadastro");
$numRegistrosCadastro = $consultaCadastro->fetchColumn();

$idCadastro = $numRegistrosCadastro + 1;

//Criando uma array para a Pessoa Juridica
$novoCadastroPJ = array($idCadastro, $nome, NULL, $documento, $email, $telefone, $segmento, $senha, $idEndereco, 'PJ');

//Inserir endereço
$inserirCadastro = $banco->prepare("INSERT INTO cadastro (ID, NOME, DATA_NASCIMENTO, DOCUMENTO, EMAIL, TELEFONE, SEGMENTO, SENHA, ID_ENDERECO, TIPO_CADASTRO) VALUES (?,?,?,?,?,?,?,?,?,?);");

$inserirCadastro->execute($novoCadastroPJ);

?>
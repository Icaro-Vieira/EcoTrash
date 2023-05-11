<?php

    require_once("../model/CadastroDAO.php");

    $documento = $_POST['usuario'];
    $senha = $_POST['senha'];

    $cadastroDAO = new CadastroDAO();

    $login = $cadastroDAO->login($documento, $senha);

    if($login){
        header("Location: http://localhost/PA/EcoTrash/index.html");
    }
    else{
        header("Location: http://localhost/PA/EcoTrash/emailousenhaerrados.html"); //Aviso na tela
    }

?>

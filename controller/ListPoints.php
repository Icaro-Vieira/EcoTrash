<?php

    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");

    //Informação do usuário que realizou o cadastro
    session_start();
    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario->get_id();
    
    $pontosDeColetaDAO = new CollectionPointsDAO();

    $listaCadastrosPontos = $pontosDeColetaDAO->listaCadastrosPontos($idUsuario);
    $listaCadastrosPontosExibir = "";

    foreach($listaCadastrosPontos as $ponto){
        $listaCadastrosPontosExibir .= $ponto->get_id() . $ponto->get_descricao() . $ponto->get_cep();
    }

    session_start();
    if($listaCadastrosPontosExibir == ""){
        $_SESSION["listaCadastrosPontos"] = "Não há pontos cadastrados!";
    } else{
        $_SESSION["listaCadastrosPontos"] = $listaCadastrosPontosExibir;
    }

    header("Location: ../view/businessProfile.php");

?>
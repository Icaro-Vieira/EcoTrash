<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/AddressDAO.php");
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
        $listaCadastrosPontosExibir .= $ponto->get_id() . " " . $ponto->get_descricao() . " " . $ponto->get_cep() . " <br>";
    }

    if($listaCadastrosPontosExibir != ""){
        $_SESSION["listaCadastrosPontos"] = $listaCadastrosPontosExibir;
    }

    header("Location: ../view/businessProfile.php");

?>
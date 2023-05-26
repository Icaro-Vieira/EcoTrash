<?php

    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");
    
    $solicitacaoPontosDAO = new PointRequestDAO();

    $listaSolicitacoes = $solicitacaoPontosDAO->listaSolicitacoes();
    $listaSolicitacoesExibir = "";

    foreach($listaSolicitacoes as $ponto){
        $listaSolicitacoesExibir .= $ponto->get_id() . $ponto->get_descricao() . $ponto->get_cep();
    }

    session_start();
    if($listaSolicitacoesExibir != ""){
        $_SESSION["listaSolicitacoes"] = $listaSolicitacoesExibir;
    }

    header("Location: ../view/admProfile.php");

?>
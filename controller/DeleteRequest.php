<?php

    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");

    //Id da solicitação
    $idSolicitacao = $_POST['idSolicitacao']; 

    $solicitacaoDAO = new PointRequestDAO();

    $solicitacao = $solicitacaoDAO->consultarSolicitacao($idSolicitacao);

    //Irá verificar se a solicitacao existe
    if (!$solicitacao) {
        
        session_start();
        
        $_SESSION["erroCadastrarPonto"] = $idSolicitacao;

        header("Location: ../view/admProfile.php");
    }

    if($solicitacaoDAO->excluir_solicitacao($idSolicitacao)){

        header("Location: ../view/RequestList.php");
    }
    else{
        echo "Não foi possível realizar a exclusão da solicitação.";
    }

?>

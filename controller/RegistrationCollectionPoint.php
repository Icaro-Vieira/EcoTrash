<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/AddressDAO.php");
    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");

    //Id da solicitação
    $idSolicitacao = $_POST['idSolicitacao']; 

    $pontosDeColetaDAO = new CollectionPointsDAO();
    $solicitacaoDAO = new PointRequestDAO();

    $solicitacao = $solicitacaoDAO->consultarSolicitacao($idSolicitacao);

    //Irá verificar se a solicitacao existe
    if (!$solicitacao) {
        
        session_start();
        
        $_SESSION["erroCadastrarPonto"] = $idSolicitacao;
    }
    else {
        if($pontosDeColetaDAO->cadastrar($solicitacao)){
            // Ponto bem sucedido.

            if($solicitacaoDAO->excluir_solicitacao($idSolicitacao)){

                session_start();
            
                $_SESSION["cadastrado"] = "Cadastro de ponto realizado com sucesso!";

                header("Location: ../view/admProfile.php");
            }
            else{
                echo "Ocorreu um erro inesperado na exclusão da solicitação.";
            }
            exit();
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro.";
        }
    }

    header("Location: ../view/admProfile.php");
?>

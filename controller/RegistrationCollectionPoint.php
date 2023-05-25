<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/AddressDAO.php");
    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");

    //Informações do ponto de coleta
    $descricao = $_POST['nomePontoSc']; 
    $cep = $_POST['cepSc']; 
    $logradouro = $_POST['logradouroPontoSc']; 
    $bairro = $_POST['bairroPontoSc']; 
    $numero = $_POST['numeroPontoSc']; 
    $tipoMateriais = "";

    if(isset($_POST['bateriasEpilhas'])){
        $tipoMateriais .= "Baterias e pilhas";
    }

    if(isset($_POST['celulares'])){
        $tipoMateriais .= "Celulares";
    }

    if(isset($_POST['cameras'])){
        $tipoMateriais .= "Cameras";
    }

    if(isset($_POST['impressoras'])){
        $tipoMateriais .= "Impressoras";
    }

    if(isset($_POST['eletrodomestico'])){
        $tipoMateriais .= "Eletrodomestico";
    }

    //Informação do usuário que realizou o cadastro
    session_start();
    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario->get_id();

    $pontosDeColetaDAO = new CollectionPointsDAO();

    //Irá verificar se o Ponto já está cadastrado
    if ($pontosDeColetaDAO->verificarPonto($cep, $numero) > 0) {
        // Ponto já cadastrado, retorna página de erro
        
        session_start();
        
        $_SESSION["erroPonto"] = $descricao;
    } 
    else {

        $pontoDeColeta = new CollectionPoints($descricao, $cep, $logradouro, $bairro, $numero, $tipoMateriais, $idUsuario);

        if($pontosDeColetaDAO->cadastrar($pontoDeColeta)){
            // Ponto bem sucedido.
            session_start();
        
            $_SESSION["cadastrado"] = "Solicitação para cadastro realizada com sucesso!";

            header("Location: ../view/registerPoints.php");
            exit();
        }
        else{
            echo "Ocorreu um erro inesperado na solicitação.";
        }
    }

    header("Location: ../view/registerPoints.php");
?>

<?php

  require_once("../model/PersonalUser.php");
  require_once("../model/BusinessUser.php");
  require_once("../model/UserDAO.php");
  require_once("../model/Address.php");
  require_once("../model/AddressDAO.php");


  session_start();

  $logado = isset($_SESSION['usuario']);
  $atualizado = isset($_SESSION['atualizado']);

  if(!$logado){
    
    header("Location: login.php");
    exit();
  }
  else{

    if($atualizado){
      echo '<script> alert("Perfil atualizado com sucesso!"); </script>';
    }

    $usuario = $_SESSION['usuario'];
    $endereco = $_SESSION['endereco'];
  }

  unset($_SESSION['atualizado']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/profile.css" />
    <title>EcoTrash - Meu Perfil</title>
</head>

<body id="register">
    <nav class="navigation">
        <ul>
            <li><a class="back-button" href="index.php"><img src="img/arow-back.svg" alt="">Voltar</a></li>
            <li><a href="index.php"><img src="img/horizontal-white-logo.svg" alt=""></a></li>
        </ul>
    </nav>
    <div class="bg-nav"></div>
    <div class="profile-divisor">
        <article class="info-user">
            <img src="img/icon-business.svg" alt="">
            <h1>
                <?php 
                    echo $usuario->get_nome(); 
                ?>
            </h1>
            <p>
                <?php 
                    echo $usuario->get_documento(); 
                ?>
            </p>            
            <a class="a-button-del button-del" href="#" onclick="showConfirmationAlert()">
                Deletar conta
            </a>
        </article>
    
        <article class="form-user-bg">
            <form action="../controller/RegistrationCollectionPoint.php" method="POST">
                <div class="top-buttons-profile">
                    <a href="businessProfile.php" class="edit-button border-bottom">Pontos Cadastrados</a>
                    <a href="requestRegister.php" class="edit-button active">Cadastrar Pontos</a>
                </div>
                <header class="">
                    <h1>Preencha os dados abaixo atentamente.</h1>
                </header>
                <article class="form-column">
                    <label for="">
                        <input type="text" name="nomePontoSc" id="nomePontoSc" placeholder="Nome do ponto" required>
                    </label>
    
                    <label for="">
                        <input type="text" name="cepSc" id="cepSc" placeholder="CEP" autocomplete="off" maxlength="9" required>
                    </label>
                    
                    <label for="">
                        <input type="text" name="logradouroPontoSc" id="logradouroPontoSc" placeholder="Logradouro" required>
                    </label>
                    
                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="bairroPontoSc" id="bairroPontoSc" class="medium-input" placeholder="Bairro" required>
                        </label>
    
                        <label for="">
                            <input type="number" name="numeroPontoSc" class="little-input" placeholder="Número" maxlength="15" min="0" autocomplete="off" required>
                        </label>
                    </article>
                    <article class="request-register-options">
                        <article class="options-collect">
                            <h2>Selecione os materiais que este ponto coleta:</h2>
                            <div class="options-collect-box">
                                <div>
                                    <label for="Bateriasepilhas">
                                        <input type="checkbox" name="bateriasEpilhas" id="bateriasEpilhas" value="lixo">
                                        Baterias e pilhas
                                    </label>
                                    
                                    <label for="celulares">
                                        <input type="checkbox" name="celulares" id="celulares" value="lixo">
                                        Celulares, smartphones e tables
                                    </label>

                                    <label for="cameras">
                                        <input type="checkbox" name="cameras" id="cameras" value="lixo">
                                        Cameras digitais e filmadoras
                                    </label>
                                </div>

                                <div>
                                    <label for="impressoras">
                                        <input type="checkbox" id="impressoras" id="impressoras" value="lixo">
                                        Impressoras e Scanners
                                    </label>

                                    <label for="eletrodomestico">
                                        <input type="checkbox" name="eletrodomestico" id="eletrodomestico" value="lixo">
                                        Eletrodomésticos
                                    </label>
                                </div>
                            </div>
                        </article>
    
                    </article>
                    <div class="center-terms-submit">
                        <input type="submit" value="Adicionar Ponto">
                    </div>
                </article>
            </form>
        </article>
    </div>

    <script type="module" src="assets/js/script.js"></script>
    <script src="assets/js/modules/api-cep-ponto-sc.js"></script>

    <script>
        function showConfirmationAlert() {
            // Exibir o alerta de confirmação
            var confirmation = prompt('Digite "DELETAR MINHA CONTA" para confirmar:');

            if (confirmation === 'DELETAR MINHA CONTA') {
                // Chamar a função DeleteUser.php ou redirecionar
                window.location.href = '../controller/DeleteUser.php';
            } else {
                // Valor incorreto, exibir mensagem de erro
                alert('Digite corretamente: "DELETAR MINHA CONTA", caso queira deletar sua conta!');
            }
        }
    </script>
</body>
</html>
<?php

  require_once("../model/PersonalUser.php");
  require_once("../model/BusinessUser.php");
  require_once("../model/UserDAO.php");
  require_once("../model/Address.php");
  require_once("../model/AddressDAO.php");


  session_start();

  $logado = isset($_SESSION['usuario']);

  if (!$logado) {

    header("Location: login.php");
    exit();
  } else {
    $usuario = $_SESSION['usuario'];
  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/profile.css" />
  <title>EcoTrash - Perfil ADM</title>
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
    </article>

    <article class="form-business-bg">
        <table class="table-info">
          <tr>
            <th>Nome</th>
            <th>Logradouro</th>
            <th>CEP</th>
            <th>Editar</th>
          </tr>
            <td><?php echo "<p>{$_SESSION['listaSolicitacoes']}</p>"; ?></td>
        <form action="../controller/RegistrationCollectionPoint.php" method="POST"> 
            <label for="">
                <input type="text" name="idSolicitacao" id="idSolicitacao" placeholder="Insira o ID da solicitação para aprova-la: " required>
            </label>
            <button class="trash-button"><img src="img/trash-icon.svg"></button> 
        </form>
        <form action="../controller/deleteRquest.php" method="POST"> 
            <label for="">
                <input type="text" name="idSolicitacao" id="idSolicitacao" placeholder="Insira o ID da solicitação para reprova-la: " required>
            </label>
            <button class="trash-button"><img src="img/trash-icon.svg"></button> 
        </form>
        </table>
    </article>
  </div>
</body>

</html>
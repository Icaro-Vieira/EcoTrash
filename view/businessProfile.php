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
  <title>EcoTrash - Perfil Empresa</title>
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

    <article class="form-business-bg">
      <form action="../controller/ToEditUser.php" method="POST">
        <div class="top-buttons-profile">
          <a href="businessProfile.php" class="edit-button active">Pontos Cadastrados</a>
          <a href="registerPoints.php" class="edit-button border-bottom">Cadastrar Pontos</a>
        </div>

        <table class="table-info">
          <tr>
            <th>Nome</th>
            <th>Logradouro</th>
            <th>CEP</th>
            <th>Editar</th>
          </tr>
          <tr>
            <td><?php echo $ponto->get_descricao(); ?></td>
            <td><?php echo $ponto->get_logradouro(); ?></td>
            <td><?php echo $ponto->get_cep(); ?></td>
            <td> <button class="trash-button"><img src="img/trash-icon.svg"></button> </td>
          </tr>
          <tr>
            <td>Magazzini Alimentari Riuniti</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
            <td> <button class="trash-button"><img src="img/trash-icon.svg"></button> </td>
          </tr>
        </table>
      </form>
    </article>
  </div>

  <script type="module" src="assets/js/script.js"></script>
  <script src="assets/js/modules/api-cep.js"></script>
  
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
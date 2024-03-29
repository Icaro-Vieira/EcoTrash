<?php

  session_start();

  $erro = isset($_SESSION['error']);

  $cadastrado = isset($_SESSION['cadastrado']);

  if ($cadastrado) {
    echo '<script> alert("Cadastro realizado com sucesso!"); </script>';
  }

  session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/login.css">
  <title>Login</title>
</head>

<body id="register">
  <nav class="navigation">
      <ul>
        <li><a class="back-button" href="index.php"><img src="img/arow-back.svg" alt="">Voltar</a></li>
      </ul>
  </nav>
  <article class="header-writings">
      <h1>Login</h1>
      <p>Faça seu login ou crie sua conta.</p>
  </article>
  <main>
      <article class="card-login">

        <img src="img/icon-logo-button.svg" alt="Um circulo com o simbolo de um botão power com duas folhas em cima dele">
        <h1><span class="color-eco">Eco</span><span class="color-trash">Trash</span></h1>

          <form action="../controller/Login.php" method="POST">
            <article class="form-column">
              <label for="">
                <input type="text" name="usuario" id="usuario" placeholder="CNPJ ou CPF" maxlength="17" autocomplete="off" required>
              </label>
              
              <!-- ADD EYE TO SEE PASSWORD and CONFIRM PASSWORD -->
              <label for="" class="icon-pass">
                <input type="password" name="senha" id="senha" placeholder="Senha" maxlength="8" autocomplete="off" required autocomplete="off">
                <img class="imagem-icon" src="img/eye-visibility-off.svg" alt="mostrar senha">
              </label>
              
              <input type="submit" value="Login">

              <div class="create-account">
                <p>Não tem uma conta? <span><a href="chooseRegistration.html">Criar Conta</a></span></p>
              </div>
            </article>
          </form>

          <?php
            //Verificando se ocorreu erro no usuário ou senha.
            if ($erro) {
              echo '<p class="erro">Usuário ou Senha incorreto, tente novamente!</p>';
            }
          ?>
        
      </article>
  </main>
  <!-- NÃO REMOVER ESSA PARTE! -->
  <footer class="footer-bg">
      <div class="footer container">
          <p class="footer-copy">⠀⠀⠀⠀⠀⠀</p>
      </div>
  </footer>


  <script src="assets/js/modules/login-cpf-cnpj-mask.js"></script>
  <script src="assets/js/modules/eye-button-login.js"></script>
  <!-- <script type="module" src="assets/js/script.js"></script> -->
</body>


</html>
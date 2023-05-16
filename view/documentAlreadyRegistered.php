<?php
  session_start();

  $erro = isset($_SESSION['documento']);

  if (!$erro) {
    header("Location: index.php");
    exit();
  }
  else{
    $documento = $_SESSION['documento'];
  }

  session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/alreadyRegistered.css" />
    <title>Documento já cadastrado.</title>
  </head>

  <body>
    <nav class="navigation">
      <ul>
        <li><img src="img/horizontal-white-logo.svg" alt=""></li>
      </ul>
    </nav>

    <main class="container">
        <div>
            <h1>
                Documento já está em uso.
            </h1>
            <p>
                Você indicou que é um novo usuário, mas já existe uma conta com o CNPJ/ CPF <?php echo $documento; ?>.

              <a href="login.php" class="button">
                <button>
                  Entrar
                </button>
              </a>

              <a href="chooseRegistration.html" class="button">
                <button>
                  Cadastrar
                </button>
              </a>
            </p>
        </div>
    </main>

    <!-- NÃO REMOVER ESSA PARTE! -->
    <footer class="footer"></footer>
  </body>
</html>
<?php

  session_start();

  $erroDocumento = isset($_SESSION['erroDocumento']);
  $erroEmail = isset($_SESSION['erroEmail']);

  if($erroDocumento){
    $documento = $_SESSION['erroDocumento'];

    echo '<script> alert("Já existe uma conta com o CNPJ ' .  $documento . ', tente novamente!"); </script>';
    session_destroy();
  }
  elseif($erroEmail){
    $email = $_SESSION['erroEmail'];

    echo '<script> alert("Já existe uma conta com o endereço de e-mail ' .  $email . ', tente novamente!"); </script>';
    session_destroy();
  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/form-business-style.css">
    <title>Cadastro de Empresa</title>
</head>

<body id="register">
    <nav class="navigation">
        <ul>
            <li><a class="back-button" href="chooseRegistration.html"><img src="img/arow-back.svg" alt="">Voltar</a></li>
            <li><a href="index.php"><img src="img/horizontal-white-logo.svg" alt=""></a></li>
        </ul>
    </nav>
    <article class="header-writings">
        <h1>Faça o cadastro da sua empresa.</h1>
        <p>Para cadastrar um endereço de ponto de coleta de resíduos eletrônicos, preencha os campos abaixo
            corretamente.</p>
    </article>
    <main>
        <article class="form-bg">
            <form action="../controller/BusinessRegistration.php" method="POST">
                <article class="form-column">
                    <label for="">
                        <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" maxlength="18" autocomplete="off"
                            required>
                    </label>

                    <label for="">
                        <input type="text" name="nome-empresa" id="nome-empresa" placeholder="Nome da Empresa" required>
                    </label>

                    <label for="">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </label>

                    <label for="">
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
                    </label>

                    <label for="">
                        <input type="text" name="cep" id="cep" placeholder="CEP" required>
                    </label>

                    <label for="">
                        <input type="text" name="segmento-empresa" id="segmento-empresa"
                            placeholder="Segmento da empresa" required>
                    </label>

                    <label for="">
                        <input type="text" name="complemento" id="complemento" placeholder="Complemento">
                    </label>

                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="logradouro" id="logradouro" class="medium-input"
                                placeholder="Logradouro" required>
                        </label>

                        <label for="">
                            <input type="number" name="numero" id="numero" class="little-input" placeholder="Número"
                                required>
                        </label>
                    </article>

                    <label for="">
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro">
                    </label>

                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="cidade" id="cidade" class="medium-input" placeholder="Cidade">
                        </label>

                        <label for="">
                            <input type="text" name="estado" id="estado" class="little-input" placeholder="Estado">
                        </label>
                    </article>

                    <!-- ADD EYE TO SEE PASSWORD and CONFIRM PASSWORD -->
                    <label for="" class="icon-pass">
                        <input type="password" name="senha" id="senha" placeholder="Senha" maxlength="8" required>
                        <img class="imagem-icon" src="img/eye-visibility-off.svg" alt="mostrar senha">
                    </label>

                    <label for="" class="icon-pass">
                        <input type="password" name="confirmar-senha" id="confirmar-senha" placeholder="Confirmar Senha" maxlength="8" required>
                        <img class="imagem-icon2" src="img/eye-visibility-off.svg" alt="mostrar senha">
                    </label>

                    <article class="center-terms-submit">
                        <article class="terms-of-use">
                            <input type="checkbox" name="termos-aceito" id="" required>
                            <label for="">Declaro que li e aceito os <span><a href="termsofUse.html"
                                        target="_blank">termos de uso</a></span></label>
                        </article>
                        <input type="submit" value="Cadastrar">
                    </article>
                </article>
            </form>
        </article>
    </main>
    <!-- NÃO REMOVER ESSA PARTE! -->
    <footer class="footer-bg">
        <div class="footer container">
            <p class="footer-copy">⠀⠀⠀⠀⠀⠀</p>
        </div>
    </footer>

    <script type="module" src="assets/js/script.js"></script>
    <script src="assets/js/modules/eye-button.js"></script>
    <script src="assets/js/modules/api-cnpj.js"></script>
</body>

</html>
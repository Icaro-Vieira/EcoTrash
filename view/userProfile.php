<?php

require_once("../model/PersonalUser.php");
require_once("../model/BusinessUser.php");
require_once("../model/UserDAO.php");

session_start();

$logado = isset($_SESSION['usuario']);
$atualizado = isset($_SESSION['atualizado']);

if (!$logado) {

    header("Location: login.php");
    exit();
} else {

    if ($atualizado) {
        echo '<script> alert("Perfil atualizado com sucesso!"); </script>';
    }

    $usuario = $_SESSION['usuario'];
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

<body>
    <nav class="navigation">
        <ul>
            <li><a href="index.php"><img src="img/arow-back.svg" alt="">Voltar</a></li>
            <li><img src="img/horizontal-white-logo.svg" alt=""></li>
        </ul>
    </nav>

    <div>
        <p>Olá bem vindo ao seu perfil do EcoTrash, <?php echo $usuario->get_nome() . " " . $usuario->get_sobrenome(); ?></p>
    </div>

    <article class="form-bg">
        <form action="../controller/ToEditUser.php" method="POST">
            <article class="form-column">
                <label for="">
                    <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo $usuario->get_nome(); ?>" required>
                </label>

                <label for="">
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required>
                </label>

                <label for="">
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                </label>

                <label for="">
                    <input type="text" name="cep" id="cep" placeholder="CEP" autocomplete="off" maxlength="9" required>
                </label>

                <label for="">
                    <input type="tel" name="telefone" id="telefone" placeholder="Telefone" required>
                </label>

                <label for="">
                    <input type="text" name="complemento" placeholder="Complemento">
                </label>

                <article class="two-inputs">
                    <label for="">
                        <input type="text" name="logradouro" id="logradouro" class="medium-input" placeholder="Logradouro" required>
                    </label>

                    <label for="">
                        <input type="number" name="numero" class="little-input" placeholder="Número" maxlength="15" min="0" autocomplete="off" required>
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

                <input type="submit" value="Editar">
                <a href="../controller/DeleteUser.php">
                    <button class="button">
                        Deletar
                    </button>
                </a>
            </article>
        </form>
    </article>
    <footer class="footer-bg">
        <div class="footer container">
            <p class="footer-copy">⠀⠀⠀⠀⠀⠀</p>
        </div>
    </footer>

    <script type="module" src="assets/js/script.js"></script>
    <script src="assets/js/modules/eye-button.js"></script>
    <script src="assets/js/modules/api-cep.js"></script>
    <script src="assets/js/modules/input-mask.js"></script>
</body>
<!-- 
<body id="register">

    <article class="header-writings">
        <h1>Faça o seu cadastro.</h1>
        <p>Para cadastrar um endereço de ponto de coleta de resíduos eletrônicos e/ ou gerar rotas até o mesmo
            preencha os campos abaixo corretamente.</p>
    </article>
    <main>
        <article class="form-bg">
            <form action="../controller/UserRegistration.php" method="POST">
                <article class="form-column">
                    <label for="">
                        <input type="text" name="nome" id="nome" placeholder="Nome" required>
                    </label>

                    <label for="">
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required>
                    </label>

                    <label for="">
                        <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                    </label>

                    <label for="">
                        <input type="text" name="cpf" id="cpf" placeholder="CPF" autocomplete="off" maxlength="14" required>
                    </label>

                    <label for="">
                        <input type="text" name="cep" id="cep" placeholder="CEP" autocomplete="off" maxlength="9" required>
                    </label>

                    <label for="">
                        <input type="tel" name="telefone" id="telefone" placeholder="Telefone" required>
                    </label>

                    <label for="">
                        <input type="text" name="complemento" placeholder="Complemento">
                    </label>

                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="logradouro" id="logradouro" class="medium-input" placeholder="Logradouro" required>
                        </label>

                        <label for="">
                            <input type="number" name="numero" class="little-input" placeholder="Número" maxlength="15" min="0" autocomplete="off" required>
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
                            <label for="">Declaro que li e aceito os <span><a href="termsofUse.html" target="_blank">termos de uso</a></span></label>
                        </article>
                        <input type="submit" value="Cadastrar">
                    </article>
                </article>
            </form>
        </article>
    </main>
    
    <footer class="footer-bg">
        <div class="footer container">
            <p class="footer-copy">⠀⠀⠀⠀⠀⠀</p>
        </div>
    </footer>

    <script type="module" src="assets/js/script.js"></script>
    <script src="assets/js/modules/eye-button.js"></script>
    <script src="assets/js/modules/api-cep.js"></script>
    <script src="assets/js/modules/input-mask.js"></script>
</body> -->


</html>
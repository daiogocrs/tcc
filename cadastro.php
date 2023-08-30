<?php
$error_message = '';

if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $nivel_acesso = $_POST['nivel_acesso'];

    $email_check_query = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email='$email'");
    $email_exists = mysqli_num_rows($email_check_query);

    if ($email_exists > 0) {
        $error_message = "E-mail já está cadastrado.";
    } else {
        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,senha,email,cidade,bairro,rua,nivel_acesso) 
            VALUES ('$nome','$senha','$email','$cidade','$bairro','$rua','$nivel_acesso')");
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="fotos/cantinalogo.png">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Tela de Cadastro</title>
</head>
<body>
    <header>
        <a href="home.php"><img src="fotos/cantinalogo.png" alt="logo cantina Federal"></a>
        <nav>
            <ul>
                <li><a href="home.php">Voltar</a></li>
            </ul>
        </nav>
    </header>
    <div class="form-wrap">
        <div class="tabs">
            <h3 class="signup-tab"><a>Cadastre-se</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
            <form class="form_cadastro" action="cadastro.php" method="POST">
                    <?php if (!empty($error_message)) : ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <input type="text" class="input" id="user_nome" autocomplete="off" placeholder="Nome" name="nome" required>
                    <input type="email" class="input" id="user_email" autocomplete="off" placeholder="Email" name="email" required>
                    <input type="text" class="input" id="user_cidade" autocomplete="off" placeholder="Cidade" name="cidade" required>
                    <input type="text" class="input" id="user_bairro" autocomplete="off" placeholder="Bairro" name="bairro" required>
                    <input type="text" class="input" id="user_rua" autocomplete="off" placeholder="Rua" name="rua" required>
                    <input type="password" class="input" id="user_senha" autocomplete="off" placeholder="Senha" name="senha" required>
                    <input type="hidden" class="input" id="user_nivel_acesso" autocomplete="on" name="nivel_acesso" value="usuario" required>
                    <input type="submit" class="button" name="submit" id="submit" value="Cadastrar">
                </form>
                <div class="help-text">
                    <p>Já possui uma conta?</p>
                    <p><a href="login.php">Entre aqui</a></p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/bibliotecas.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Tela de login</title>
</head>

<body>

    <header>
        <a href="home.php"><img src="fotos/cantinalogo.png" alt="logo cantina Federal"></a>
        <nav>
            <ul>
                <li><a href="home.php" class="voltarbotao">Voltar</a></li>
            <ul>
        </nav>
    </header>
    <div class="form-wrap">
        <div class="tabs">
            <h3 class="signup-tab"><a>Logar</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
                <form class="form_cadastro" action="testLogin.php" method="POST">
                    <input type="email" class="input" id="user_email" autocomplete="off" placeholder="Email" name="email" required>
                    <input type="password" class="input" id="user_senha" autocomplete="off" placeholder="Senha" name="senha" required>
                    <span class="password-toggle" id="password_toggle" onclick="togglePasswordVisibility()" style="position: absolute; margin-top: -50px; margin-left: 240px; cursor: pointer; user-select: none;">👁</span>
                    <input type="submit" class="button" name="submit" value="Entrar">
                </form>
                <div class="help-text">
                    <p>Não possui uma conta ainda?</p>
                    <p><a href="cadastro.php">Cadastrar</a></p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/bibliotecas.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</body>

</html>
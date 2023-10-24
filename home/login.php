<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="../fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Cantina Federal</title>
</head>

<body>

    <header class="header-animation">
        <div class="navigation-wrap bg start-header start-style">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light">

                            <a class="navbar-brand" href="../index.php"><img src="../fotos/cantinalogo2.png" alt=""></a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="../index.php">Home</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="cardapio.php">Cardápio</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="marmitas.php">Delivery</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                        <a class="nav-link" href="login.php">Entrar</a>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="form-wrap">
        <div class="tabs">
            <h3 class="signup-tab"><a>Logar</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
                <form class="form_cadastro" action="../testLogin.php" method="POST">
                    <input type="email" class="input" id="user_email" autocomplete="off" placeholder="Email"
                        name="email" required>
                    <div class="password-container">
                        <input type="password" class="input" id="user_senha" autocomplete="off" placeholder="Senha"
                            name="senha" required>
                        <span class="password-toggle" id="password_toggle"
                            onclick="togglePasswordVisibility()">👁</span>
                    </div>
                    <input type="submit" class="button" name="submit" value="Entrar">
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/login.js"></script>
    <script type="text/javascript" src="../js/header.js"></script>
</body>

</html>
<?php
session_start();

include('../config.php');

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['nivel_acesso']) == 'adm'))
{
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: ../home/login.php');
}

$mensagemCadastro = '';

if (isset($_POST['submit'])) {

    function limparDados($conexao, $dados)
    {
        $dados = trim($dados);
        $dados = mysqli_real_escape_string($conexao, $dados);
        return $dados;
    }

    $nome = limparDados($conexao, $_POST['nome']);
    $preco = limparDados($conexao, $_POST['preco']);
    $categoria = limparDados($conexao, $_POST['categoria']);

    $verificarExistencia = mysqli_query($conexao, "SELECT * FROM produtos WHERE nome = '$nome'");
    if (mysqli_num_rows($verificarExistencia) > 0) {
        $mensagemCadastro = 'Produto já cadastrado.';
    } else {

        $result = mysqli_query($conexao, "INSERT INTO produtos(nome, preco, categoria) 
            VALUES ('$nome', '$preco', '$categoria')");

        if ($result) {
            $mensagemCadastro = 'Produto cadastrado!';
        } else {
            $mensagemCadastro = 'Erro ao cadastrar o produto.';
        }
    }

    mysqli_close($conexao);
}
?>

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
    <title>Tela de Cadastro de Produtos</title>
</head>

<body>
    <header class="header-animation">
        <div class="navigation-wrap bg start-header start-style">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light">

                            <a class="navbar-brand" href="homeadm.php"><img src="../fotos/cantinalogo2.png" alt=""></a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="homeadm.php">Home</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="cardapioadm.php">Cardápio</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="marmitasadm.php">Delivery</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                        <a class="nav-link" href="produtos.php">Produtos</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Conta</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="../sair.php">Sair</a>
                                        </div>
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
            <h3 class="signup-tab"><a>Cadastre seu Produto</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
                <?php
                if ($mensagemCadastro) {
                    if ($mensagemCadastro === 'Produto já cadastrado.') {
                        echo '<p style="color: red; text-align: center; font-size: 20px; padding-bottom: 15px;">' . $mensagemCadastro . '</p>';
                        echo '<form action="cadastroprodutos.php" method="GET"><input type="submit" class="button" value="Cadastrar Novo Produto"></form>';
                    } else {
                        echo '<p style="color: green; text-align: center; font-size: 20px; padding-bottom: 15px;">' . $mensagemCadastro . '</p>';
                        echo '<form action="cadastroprodutos.php" method="GET"><input type="submit" class="button" value="Cadastrar Novo Produto"></form>';
                    }
                } else {
                    ?>
                    <form class="form_cadastro" action="cadastroprodutos.php" method="POST">
                        <input type="text" class="input" id="user_nome" autocomplete="off" placeholder="Nome" name="nome"
                            required>
                        <input type="text" class="input" id="user_preco" autocomplete="off" placeholder="Preço" name="preco"
                            required>
                        <select id="user_categoria" class="input" name="categoria" required>
                            <option value="" disabled selected>Selecione a categoria</option>
                            <option value="salgados">Salgados</option>
                            <option value="doces">Doces</option>
                            <option value="bebidas">Bebidas</option>
                            <option value="sorvetes">Sorvetes</option>
                        </select>
                        <input type="submit" class="button" name="submit" id="submit" value="Cadastrar">
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/header.js"></script>
</body>

</html>
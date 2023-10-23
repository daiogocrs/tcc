<?php
$mensagemPedido = '';

if (isset($_POST['submit_pedido'])) {
    include('../config.php');

    function limparDados($conexao, $dados)
    {
        $dados = trim($dados);
        $dados = mysqli_real_escape_string($conexao, $dados);
        return $dados;
    }

    $tamanho = limparDados($conexao, $_POST['tamanho']);
    $comidas = isset($_POST['comida']) ? implode(', ', array_map([$conexao, 'real_escape_string'], $_POST['comida'])) : '';
    $forma_pagamento = limparDados($conexao, $_POST['forma_pagamento']);

    $cidade = limparDados($conexao, $_POST['cidade']);
    $bairro = limparDados($conexao, $_POST['bairro']);
    $rua = limparDados($conexao, $_POST['rua']);
    $numero = limparDados($conexao, $_POST['numero']);
    $complemento = limparDados($conexao, $_POST['complemento']);

    $precoMarmita = 0;
    if ($tamanho === "pequena") {
        $precoMarmita = 15.00;
    } elseif ($tamanho === "media") {
        $precoMarmita = 18.00;
    } elseif ($tamanho === "grande") {
        $precoMarmita = 22.00;
    }

    $queryInserirPedido = "INSERT INTO pedidos (tamanho, comidas, preco, forma_pagamento, cidade, bairro, rua, numero, complemento, data_hora_pedido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmtInserirPedido = mysqli_prepare($conexao, $queryInserirPedido);
    mysqli_stmt_bind_param($stmtInserirPedido, 'ssdssssss', $tamanho, $comidas, $precoMarmita, $forma_pagamento, $cidade, $bairro, $rua, $numero, $complemento);

    if (mysqli_stmt_execute($stmtInserirPedido)) {
        $mensagemPedido = 'Seu pedido foi feito!';
    } else {
        $mensagemPedido = 'Erro ao inserir pedido: ' . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmtInserirPedido);
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
    <link rel="stylesheet" type="text/css" href="../css/marmitas.css">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Tela de Pedido de Marmitas</title>
    <style></style>
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
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                        <a class="nav-link" href="marmitas.php">Delivery</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
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
            <h3 class="signup-tab"><a>Faça seu Pedido</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
                <form action="marmitas.php" method="POST">
                    <div class="options">
                        <button class="button" id="btn-marmitas" type="button">Marmitas</button>
                        <button class="button" id="btn-lanches" type="button">Lanches</button>
                        <button class="button" id="btn-bebidas" type="button">Bebidas</button>
                    </div>
                    <div id="marmitas-container" style="display: none;">
                        <div class="marmitas-options">
                            <label class="marmita-option">
                                <input type="radio" name="tamanho" value="pequena" id="tamanho-pequena">
                                <div class="marmita-content">
                                    <span class="marmita-title">Marmita Pequena</span>
                                    <span class="marmita-price">R$15</span>
                                </div>
                            </label>
                            <label class="marmita-option">
                                <input type="radio" name="tamanho" value="media" id="tamanho-media">
                                <div class="marmita-content">
                                    <span class="marmita-title">Marmita Média</span>
                                    <span class="marmita-price">R$20</span>
                                </div>
                            </label>
                            <label class="marmita-option">
                                <input type="radio" name="tamanho" value="grande" id="tamanho-grande">
                                <div class="marmita-content">
                                    <span class="marmita-title">Marmita Grande</span>
                                    <span class="marmita-price">R$25</span>
                                </div>
                            </label>
                            <button class="button" id="btn-voltar-marmitas" type="button">Voltar</button>
                        </div>
                    </div>
                    <div id="lanches-container" style="display: none;">
                        <label>Lanches:</label><br>
                        <button id="salgados" class="button" type="button">Salgados</button>
                        <button id="doces" class="button" type="button">Doces</button>
                        <button class="button" id="btn-voltar-lanches" type="button">Voltar</button>
                        <button id="btn-proximo" class="button" type="button">Próximo</button>
                    </div>
                    <div id="bebidas-container" style="display: none;">
                        <label>Escolha sua bebida:</label><br>
                        <input type="checkbox" class="input" name="bebidas[]" value="pepsi"> Pepsi <br>
                        <input type="checkbox" class="input" name="bebidas[]" value="cocacola"> Coca-Cola <br>
                        <button class="button" id="btn-voltar-bebidas" type="button">Voltar</button>
                        <button id="btn-proximo" class="button" type="button">Próximo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/header.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnMarmitas = document.getElementById('btn-marmitas');
            const btnLanches = document.getElementById('btn-lanches');
            const btnBebidas = document.getElementById('btn-bebidas');
            const btnVoltarMarmitas = document.getElementById('btn-voltar-marmitas');
            const btnVoltarLanches = document.getElementById('btn-voltar-lanches');
            const btnVoltarBebidas = document.getElementById('btn-voltar-bebidas');
            const marmitasContainer = document.getElementById('marmitas-container');
            const lanchesContainer = document.getElementById('lanches-container');
            const bebidasContainer = document.getElementById('bebidas-container');

            btnMarmitas.addEventListener('click', () => {
                marmitasContainer.style.display = 'block';
                lanchesContainer.style.display = 'none';
                bebidasContainer.style.display = 'none';
                btnMarmitas.style.display = 'none';
                btnLanches.style.display = 'none';
                btnBebidas.style.display = 'none';
            });

            btnLanches.addEventListener('click', () => {
                marmitasContainer.style.display = 'none';
                lanchesContainer.style.display = 'block';
                bebidasContainer.style.display = 'none';
                btnMarmitas.style.display = 'none';
                btnLanches.style.display = 'none';
                btnBebidas.style.display = 'none';
            });

            btnBebidas.addEventListener('click', () => {
                marmitasContainer.style.display = 'none';
                lanchesContainer.style.display = 'none';
                bebidasContainer.style.display = 'block';
                btnMarmitas.style.display = 'none';
                btnLanches.style.display = 'none';
                btnBebidas.style.display = 'none';
            });

            btnVoltarMarmitas.addEventListener('click', () => {
                marmitasContainer.style.display = 'none';
                lanchesContainer.style.display = 'none';
                bebidasContainer.style.display = 'none';
                btnMarmitas.style.display = 'block';
                btnLanches.style.display = 'block';
                btnBebidas.style.display = 'block';
            });

            btnVoltarLanches.addEventListener('click', () => {
                marmitasContainer.style.display = 'none';
                lanchesContainer.style.display = 'none';
                bebidasContainer.style.display = 'none';
                btnMarmitas.style.display = 'block';
                btnLanches.style.display = 'block';
                btnBebidas.style.display = 'block';
            });

            btnVoltarBebidas.addEventListener('click', () => {
                marmitasContainer.style.display = 'none';
                lanchesContainer.style.display = 'none';
                bebidasContainer.style.display = 'none';
                btnMarmitas.style.display = 'block';
                btnLanches.style.display = 'block';
                btnBebidas.style.display = 'block';
            });
        });
    </script>
</body>

</html>
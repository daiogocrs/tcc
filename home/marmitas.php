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
    <style>

    </style>
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
                        <label class="option">
                            <input type="radio" name="marmitas" id="marmitas">
                            <div class="option-content">
                                <span class="option-title">Marmitas</span>
                            </div>
                        </label>
                        <label class="option">
                            <input type="radio" name="lanches" id="lanches">
                            <div class="option-content">
                                <span class="option-title">Lanches</span>
                            </div>
                        </label>
                        <label class="option">
                            <input type="radio" name="bebidas" id="bebidas">
                            <div class="option-content">
                                <span class="option-title">Bebidas</span>
                            </div>
                        </label>
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
                            <button id="btn-voltar-tamanhos" class="button">Voltar</button>
                        </div>
                    </div>
                    <div class="comidas-options" style="display: none;">
                        <label>Escolha suas comidas:</label><br>
                        <input type="checkbox" class="input" name="comida[]" value="arroz"> Arroz <br>
                        <input type="checkbox" class="input" name="comida[]" value="arroz temperado"> Arroz Temperado
                        <br>
                        <input type="checkbox" class="input" name="comida[]" value="macarrao"> Macarrão <br>
                        <input type="checkbox" class="input" name="comida[]" value="tomate"> Tomate <br>
                        <input type="checkbox" class="input" name="comida[]" value="alface"> Alface <br>
                        <input type="checkbox" class="input" name="comida[]" value="pepino"> Pepino <br>
                        <input type="checkbox" class="input" name="comida[]" value="batata frita"> Batata Frita <br>
                        <input type="checkbox" class="input" name="comida[]" value="maionese"> Maionese <br>
                        <input type="checkbox" class="input" name="comida[]" value="batata palha"> Batata Palha <br>
                        <input type="checkbox" class="input" name="comida[]" value="farofa"> Farofa <br>
                        <select class="input" id="user_tamanho" autocomplete="off" name="comida[]">
                            <option value="" disabled selected>Selecione a Carne</option>
                            <option value="nenhuma">Nenhuma</option>
                            <option value="frango">Frango</option>
                            <option value="salsichao">Salsichao</option>
                            <option value="porco">Porco</option>
                        </select>
                        <button id="btn-voltar" class="button">Voltar</button>
                        <button id="btn-finalizar" class="button">Finalizar</button>
                    </div>
                    <div class="localizacao-form" style="display: none;">
                        <label>Localização:</label>
                        <input type="text" class="input" id="cidade" name="cidade" placeholder="Cidade" required>
                        <input type="text" class="input" id="bairro" name="bairro" placeholder="Bairro" required>
                        <input type="text" class="input" id="rua" name="rua" placeholder="Rua" required>
                        <input type="text" class="input" id="numero" name="numero" placeholder="Número" required>
                        <input type="text" class="input" id="complemento" name="complemento" placeholder="Complemento">

                        <label>Forma de Pagamento:</label>
                        <select class="input" id="forma_pagamento" name="forma_pagamento" required>
                            <option value="" disabled selected>Selecione a forma de pagamento</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="cartao">Cartão de Crédito</option>
                            <option value="pix">PIX</option>
                        </select>
                        <button id="btn-voltar" class="button">Voltar</button>
                        <input type="submit" class="button" name="submit_pedido" value="Enviar Pedido">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/header.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tamanhoOptions = document.querySelectorAll('input[name="tamanho"]');
            const comidasOptions = document.querySelector('.comidas-options');
            const localizacaoForm = document.querySelector('.localizacao-form');
            const finalizarButton = document.getElementById('btn-finalizar');
            const voltarTamanhosButton = document.getElementById('btn-voltar-tamanhos');
            const voltarButton = document.getElementById('btn-voltar');
            const marmitasButton = document.querySelector('input[name="marmitas"]');
            const marmitasContainer = document.getElementById('marmitas-container');
            const optionsContainer = document.querySelector('.options');
            let tamanhoSelecionado = null;

            function ocultarOpcoesPrincipais() {
                optionsContainer.style.display = 'none';
            }

            marmitasButton.addEventListener("change", () => {
                if (marmitasButton.checked) {
                    marmitasContainer.style.display = 'block';
                    ocultarOpcoesPrincipais();
                }
            });

            tamanhoOptions.forEach((option) => {
                option.addEventListener("change", () => {
                    if (option.checked) {
                        tamanhoSelecionado = option.value;
                        document.querySelector('.marmitas-options').style.display = 'none';
                        comidasOptions.style.display = 'block';
                        voltarTamanhosButton.style.display = 'block';
                    }
                });
            });

            finalizarButton.addEventListener('click', (event) => {
                event.preventDefault();
                comidasOptions.style.display = 'none';
                localizacaoForm.style.display = 'block';
            });

            voltarTamanhosButton.addEventListener('click', (event) => {
                event.preventDefault();
                comidasOptions.style.display = 'none';
                localizacaoForm.style.display = 'none';
                optionsContainer.style.display = 'block';
                voltarTamanhosButton.style.display = 'none';

                tamanhoOptions.forEach((option) => {
                    option.checked = false;
                });

                tamanhoSelecionado = null;
            });

            voltarButton.addEventListener('click', (event) => {
                event.preventDefault();
                comidasOptions.style.display = 'none';
                localizacaoForm.style.display = 'none';
                optionsContainer.style.display = 'block'; 
                voltarTamanhosButton.style.display = 'none';
                marmitasContainer.style.display = 'none'; 

                tamanhoOptions.forEach((option) => {
                    option.checked = false;
                });

                tamanhoSelecionado = null;
            });
        });

    </script>

</body>

</html>
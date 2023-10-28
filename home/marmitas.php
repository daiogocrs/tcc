<?php
$mensagemPedido = '';

$diaSemana = '';
$comidas = '';
$sobremesa = '';

if (isset($_POST['submit_pedido'])) {
    include('../config.php');

    function limparDados($conexao, $dados)
    {
        $dados = trim($dados);
        $dados = mysqli_real_escape_string($conexao, $dados);
        return $dados;
    }

    $tamanho = limparDados($conexao, $_POST['tamanho']);
    $forma_pagamento = limparDados($conexao, $_POST['forma_pagamento']);
    $retirar_algo = isset($_POST['retirar_algo']) ? limparDados($conexao, $_POST['retirar_algo']) : '';

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

    $bebidasSelecionadas = isset($_POST['bebidas']) ? $_POST['bebidas'] : [];
    $bebidasTexto = implode(', ', $bebidasSelecionadas);

    $queryInserirPedido = "INSERT INTO pedidos (tamanho, retirar_algo, preco, forma_pagamento, cidade, bairro, rua, numero, complemento, bebidas, data_hora_pedido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmtInserirPedido = mysqli_prepare($conexao, $queryInserirPedido);
    mysqli_stmt_bind_param($stmtInserirPedido, 'ssdsssssss', $tamanho, $retirar_algo, $precoMarmita, $forma_pagamento, $cidade, $bairro, $rua, $numero, $complemento, $bebidasTexto);

    if (mysqli_stmt_execute($stmtInserirPedido)) {
        $mensagemPedido = 'Seu pedido foi feito!';
    } else {
        $mensagemPedido = 'Erro ao inserir pedido: ' . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmtInserirPedido);
    mysqli_close($conexao);
}

$diaSemana = date('l');

$traducaoDias = array(
    'Monday' => 'segunda',
    'Tuesday' => 'terça',
    'Wednesday' => 'quarta',
    'Thursday' => 'quinta',
    'Friday' => 'sexta',
    'Saturday' => 'sabado',
    'Sunday' => 'domingo'
);

if (array_key_exists($diaSemana, $traducaoDias)) {
    $diaSemana = $traducaoDias[$diaSemana];
} else {
    $diaSemana = 'Dia desconhecido';
}

include('../config.php');
$queryCardapio = "SELECT comidas, sobremesa FROM cardapio WHERE dia_semana = ?";
$stmt = mysqli_prepare($conexao, $queryCardapio);
mysqli_stmt_bind_param($stmt, 's', $diaSemana);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $comidas, $sobremesa);

if (mysqli_stmt_fetch($stmt)) {
} else {
    $comidas = 'Cardápio não disponível';
    $sobremesa = 'Sobremesa não disponível';
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="../fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/marmitas.css">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Cantina Federal</title>
    <style>
       @import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300);

        .marmitas-container {
            display: flex;
            justify-content: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .marmita-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .marmita-option {
            text-align: center;
            border: 1px solid #ccc;
            padding: 70px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            display: inline-block;
            margin: 10px;
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-size: cover;
            background-position: center;
            width: 30%;
        }

        @media (max-width: 768px) {
            .marmita-option {
                width: 93%;
            }
        }

        .marmita-option:hover {
            background-color: #f0f0f0;
        }

        .marmita-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            color: #fff;
            text-shadow: 2px 2px 4px #000;
        }

        .marmita-price {
            font-size: 16px;
            color: #fff;
            text-shadow: 2px 2px 4px #000;
        }

        .marmita-pequena {
            background-image: url('../fotos/marmitapequena.png');
        }

        .marmita-media {
            background-image: url('../fotos/marmita.png');
        }

        .marmita-grande {
            background-image: url('../fotos/marmita.png');
        }

        .marmita-option input[type="radio"] {
            display: none;
        }

        .marmita-option label {
            display: block;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
        }

        .marmita-option input[type="radio"]:checked+label {
            background-color: #f0f0f0;
        }
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
                    <div class="marmitas-container">
                        <div class="marmitas-options">
                            <label class="marmita-option marmita-pequena">
                                <input type="radio" name="tamanho" value="pequena" id="tamanho-pequena">
                                <div class="marmita-content">
                                    <span class="marmita-title">Marmita Pequena</span>
                                    <span class="marmita-price">R$15,00</span>
                                </div>
                            </label>
                            <label class="marmita-option marmita-media">
                                <input type="radio" name="tamanho" value="media" id="tamanho-media">
                                <div class="marmita-content">
                                    <span class="marmita-title">Marmita Média</span>
                                    <span class="marmita-price">R$18,00</span>
                                </div>
                            </label>
                            <label class="marmita-option marmita-grande">
                                <input type="radio" name="tamanho" value="grande" id="tamanho-grande">
                                <div class="marmita-content">
                                    <span class="marmita-title">Marmita Grande</span>
                                    <span class="marmita-price">R$22,00</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="comidas-options" style="display: none;">
                        <label>Comidas:</label><br>
                        <?php echo $comidas; ?>
                        <label>Deseja retirar algo:</label><br>
                        <input type="text" class="input" id="retirar_algo" name="retirar_algo"
                            placeholder="Fale o que deseja retirar aqui" required><br>
                        <label>Sobremesa:</label><br>
                        <?php echo $sobremesa; ?><br>
                        <label>Bebidas:</label><br>
                        <input type="checkbox" class="input" name="bebidas[]" value="pepsi"> Pepsi <br>
                        <input type="checkbox" class="input" name="bebidas[]" value="cocacola"> Coca-cola <br>
                        <input type="checkbox" class="input" name="bebidas[]" value="guarana"> Guaraná <br>
                        <button id="btn-voltar-comidas" class="button">Voltar</button>
                        <button id="btn-proximo-comidas" class="button">Próximo</button>
                    </div>
                    <div class="localizacao-form" style="display: none;">
                        <label>Localização:</label>
                        <input type="text" class="input" id="cidade" name="cidade" placeholder="Cidade" required>
                        <input type="text" class="input" id="bairro" name="bairro" placeholder="Bairro" required>
                        <input type="text" class="input" id="rua" name="rua" placeholder="Rua" required>
                        <input type="number" class="input" id="numero" name="numero" placeholder="Número" required>
                        <input type="text" class="input" id="complemento" name="complemento" placeholder="Complemento">
                        <label>Forma de Pagamento:</label>
                        <select class="input" id="forma_pagamento" name="forma_pagamento" required>
                            <option value="" disabled selected>Selecione a forma de pagamento</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="cartao">Cartão de Crédito</option>
                            <option value="pix">PIX</option>
                        </select>
                        <button id="btn-voltar-comidas" class="button">Voltar</button>
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
            const btnVoltarComidas = document.getElementById('btn-voltar-comidas');
            const btnProximoComidas = document.getElementById('btn-proximo-comidas');
            const btnVoltarLocalizacao = document.getElementById('btn-voltar-localizacao');
            const btnFinalizar = document.getElementById('btn-finalizar');

            let tamanhoSelecionado = null;

            tamanhoOptions.forEach((option) => {
                option.addEventListener("change", () => {
                    if (option.checked) {
                        tamanhoSelecionado = option.value;
                        document.querySelector('.marmitas-options').style.display = 'none';
                        comidasOptions.style.display = 'block';
                        btnVoltarComidas.style.display = 'block';
                    }
                });
            });

            btnProximoComidas.addEventListener('click', (event) => {
                event.preventDefault();
                comidasOptions.style.display = 'none';
                localizacaoForm.style.display = 'block';
                btnVoltarComidas.style.display = 'none';
                btnVoltarLocalizacao.style.display = 'block';
            });

            btnVoltarComidas.addEventListener('click', (event) => {
                event.preventDefault();
                comidasOptions.style.display = 'none';
                document.querySelector('.marmitas-options').style.display = 'block';
                btnVoltarComidas.style.display = 'none';

                tamanhoOptions.forEach((option) => {
                    option.checked = false;
                });

                tamanhoSelecionado = null;
            });

            btnVoltarLocalizacao.addEventListener('click', (event) => {
                event.preventDefault();
                localizacaoForm.style.display = 'none';
                comidasOptions.style.display = 'block';
                btnVoltarLocalizacao.style.display = 'none';
                btnVoltarComidas.style.display = 'block';
            });

            btnFinalizar.addEventListener('click', (event) => {
                event.preventDefault();
                alert('Pedido finalizado!');
            });
        });
    </script>

</body>

</html>
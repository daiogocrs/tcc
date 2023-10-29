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

        div .form-wrap * {
            margin: 0;
            padding: 0;
        }

        .form-wrap a {
            color: #666;
            text-decoration: none;
        }

        .form-wrap a:hover {
            color: #4FDA8C;
        }

        input {
            font: 16px/26px "Raleway", sans-serif;
        }

        .form-wrap {
            background-color: #f1f2f2;
            color: #666;
            font: 16px/26px "Raleway", sans-serif;
        }

        .form-wrap {
            -moz-box-shadow: 0px 1px 8px #BEBEBE;
            -webkit-box-shadow: 0px 1px 8px #BEBEBE;
            background-color: #fff;
            box-shadow: 0px 1px 8px #BEBEBE;
            margin: 8em auto;
            width: 50%;
        }

        .form-wrap .tabs {
            overflow: hidden;
        }

        .form-wrap .tabs h3 a {
            background-color: #e6e7e8;
            color: #666;
            display: block;
            font-weight: 400;
            padding: 0.5em 0;
            text-align: center;
        }

        .form-wrap .tabs-content {
            padding: 1.5em;
        }

        .form-wrap .tabs-content .active {
            display: block !important;
        }

        .form-wrap form .input#user_tamanho {
            -moz-box-sizing: border-box;
            border: 1px solid #CFCFCF;
            box-sizing: border-box;
            color: inherit;
            display: inline-block;
            font-family: inherit;
            width: 100%;
        }

        .form-wrap form .input {
            margin: 0 0 .8em 0;
            outline: 0;
            padding-right: 2em;
            padding: .8em 0 10px .8em;
        }

        .form-wrap form .button {
            background-color: #801300;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: .8em 0 10px .8em;
            text-transform: uppercase;
            width: 100%;
        }

        .form-wrap form .button:hover {
            background-color: #4FDA8C;
        }

        .form-wrap form label[for] {
            cursor: pointer;
            padding-left: 20px;
            position: relative;
        }

        .form-wrap form label[for]:before {
            border: 1px solid #CFCFCF;
            content: '';
            height: 17px;
            left: -14px;
            position: absolute;
            top: 0px;
            width: 17px;
        }

        .form-wrap form label[for]:after {
            -moz-transform: rotate(-45deg);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
            background-color: transparent;
            border-right: none;
            border-top: none;
            border: 3px solid #28A55F;
            content: '';
            filter: alpha(opacity=0);
            height: 5px;
            left: -10px;
            opacity: 0;
            position: absolute;
            top: 4px;
            transform: rotate(-45deg);
            width: 9px;
        }

        .form-wrap .help-text {
            margin-top: .6em;
        }

        .form-wrap .help-text p {
            font-size: 14px;
            text-align: center;
        }

        .form-wrap nav ul {
            list-style-type: none;
            margin: 0 2% auto 0;
            max-width: 100%;
            padding-left: 0;
            text-align: right;
        }

        .form-wrap nav ul li {
            display: inline-block;
            line-height: 60px;
            margin-left: 10px;
        }

        .form-wrap nav ul li a {
            color: black;
            font-size: large;
            text-decoration: none;
        }

        .marmitas-container {
            display: flex;
            justify-content: center;
            max-width: 100%;
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
            width: auto;
            height: auto;
        }

        .marmita-option:hover {
            background-color: #f0f0f0;
        }

        .marmita-pequena {
            background-image: url('../fotos/marmitapequena.png');
        }

        .marmita-media {
            background-image: url('../fotos/marmitamedia.png');
        }

        .marmita-grande {
            background-image: url('../fotos/marmitagrande.png');
        }

        .marmita-option label {
            display: block;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
        }

        .marmita-option input[type="radio"] {
            display: none;
        }

        .marmita-option input[type="radio"]:checked+label {
            background-color: #f0f0f0;
        }

        @media (max-width: 768px) {
            .form-wrap {
                width: 95%;
                height: auto;
            }

            .marmita-option {
                width: 93%;
                height: 60%;
            }
        }

        .comidas-options {
            display: none;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        .comidas-content {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .input#retirar_algo {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .label-bebidas {
            font-weight: bold;
            margin-top: 15px;
        }

        .bebidas-options {
            margin-top: 10px;
        }

        .bebidas-options label {
            display: block;
            margin-top: 5px;
        }

        .button {
            background-color: #801300;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            text-transform: uppercase;
            width: 100%;
            border-radius: 5px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #4FDA8C;
        }

        #btn-voltar-comidas,
        #btn-voltar-localizacao {
            background-color: #ccc;
        }

        #btn-voltar-comidas:hover,
        #btn-voltar-localizacao:hover {
            background-color: #999;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        .help-text {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }

        .localizacao-form {
            display: none;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        .localizacao-form label {
            font-weight: bold;
            margin-top: 10px;
        }

        .localizacao-form .input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .localizacao-form .button {
            background-color: #801300;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            text-transform: uppercase;
            width: 100%;
            border-radius: 5px;
            margin-top: 20px;
        }

        .localizacao-form .button:hover {
            background-color: #4FDA8C;
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
                    <div class="marmitas-container custom-style">
                        <div class="marmitas-options">
                            <label class="marmita-option marmita-pequena">
                                <input type="radio" name="tamanho" value="pequena" id="tamanho-pequena">
                            </label>
                            <label class="marmita-option marmita-media">
                                <input type="radio" name="tamanho" value="media" id="tamanho-media">
                            </label>
                            <label class="marmita-option marmita-grande">
                                <input type="radio" name="tamanho" value="grande" id="tamanho-grande">
                        </div>
                    </div>
                    <div class="comidas-options" style="display: none;">
                        <label>Cardápio do dia:</label><br>
                        <div class="comidas-content">
                            <?php echo $comidas; ?>
                        </div>
                        <label>Deseja retirar algo:</label><br>
                        <input type="text" class="input" id="retirar_algo" name="retirar_algo"
                            placeholder="Fale o que deseja retirar aqui" required><br>
                        <label>Sobremesa:</label><br>
                        <div class="comidas-content">
                            <?php echo $sobremesa; ?><br>
                        </div>
                        <label>Bebidas:</label>
                        <div class="bebidas-content">
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="pepsi-250"> Pepsi 250ml
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="pepsi-600"> Pepsi 600ml
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="pepsi-2L"> Pepsi 2L
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="cocacola-250"> Coca-cola
                                250ml
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="cocacola-600"> Coca-cola
                                600ml
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="cocacola-2L"> Coca-cola 2L
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="guarana-250"> Guaraná 250ml
                            </label><br>
                            <label>
                                <input type="checkbox" class "input" name="bebidas[]" value="guarana-600"> Guaraná 600ml
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="guarana-2L"> Guaraná 2L
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="cerveja-350"> Cerveja 350ml
                            </label><br>
                            <label>
                                <input type="checkbox" class="input" name="bebidas[]" value="cerveja-600"> Cerveja 600ml
                            </label>
                        </div>
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
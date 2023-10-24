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
    $bebida = limparDados($conexao, $_POST['bebida']); 
    $forma_pagamento = limparDados($conexao, $_POST['forma_pagamento']);

    // Obtém o dia da semana atual
    $diaSemana = strtolower(date('l'));

    // Consulta SQL para obter o cardápio do dia
    $queryCardapio = "SELECT comidas, sobremesa FROM cardapio WHERE dia_semana = '$diaSemana'";
    $resultadoCardapio = mysqli_query($conexao, $queryCardapio);

    if ($resultadoCardapio && mysqli_num_rows($resultadoCardapio) > 0) {
        $row = mysqli_fetch_assoc($resultadoCardapio);
        $comidas = explode(', ', $row['comidas']);
        $sobremesa = $row['sobremesa'];
    } else {
        // Se não houver um cardápio correspondente, você pode definir um valor padrão ou mostrar uma mensagem de erro.
        // Por exemplo:
        $comidas = array();
        $sobremesa = 'Não disponível';
    }

    $cidade = limparDados($conexao, $_POST['cidade']);
    $bairro = limparDados($conexao, $_POST['bairro']);
    $rua = limparDados($conexao, $_POST['rua']);
    $numero = limparDados($conexao, $_POST['numero']);
    $complemento = limparDados($conexao, $_POST['complemento']);

    $precoMarmita = 0;
    if ($tamanho === "pequena") {
        $precoMarmita = 15.00;
    } elseif ($tamanho === "media") {
        $precoMarmita = 20.00;
    } elseif ($tamanho === "grande") {
        $precoMarmita = 25.00;
    }

    $queryInserirPedido = "INSERT INTO pedidos (tamanho, comidas, bebidas, preco, forma_pagamento, cidade, bairro, rua, numero, complemento, data_hora_pedido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmtInserirPedido = mysqli_prepare($conexao, $queryInserirPedido);
    mysqli_stmt_bind_param($stmtInserirPedido, 'sssdssssss', $tamanho, implode(', ', array_map('mysqli_real_escape_string', $comidas)), $bebida, $precoMarmita, $forma_pagamento, $cidade, $bairro, $rua, $numero, $complemento);

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
        .marmita-option {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            display: inline-block;
            width: 30%;
            margin: 10px;
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .marmita-option:hover {
            background-color: #f0f0f0;
        }

        .marmita-title {
            font-size: 18px;
            font-weight: bold;
        }

        .marmita-price {
            font-size: 16px;
            color: #801300;
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
                    </div>
                    <div class="comidas-options" style="display: none;">
                        <label>Comidas do Dia:</label><br>
                        <?php
                        if (isset($comidas) && is_array($comidas)) {
                            foreach ($comidas as $comida) {
                                echo '<input type="checkbox" class="input" name="comida[]" value="' . htmlspecialchars($comida) . '"> ' . htmlspecialchars($comida) . '<br>';
                            }
                        } else {
                            echo '<p>Não há comidas disponíveis para hoje.</p>';
                        }
                        ?>
                    </div>
                    <div class="sobremesa-options" style="display: none;">
                        <label>Sobremesa do Dia:</label><br>
                        <p>
                            <?= htmlspecialchars($sobremesa) ?>
                        </p>
                    </div>
                    <div class="bebidas-options" style="display: none;">
                        <label>Escolha sua bebida:</label><br>
                        <select class="input" name="bebida">
                            <option value="agua">Água</option>
                            <option value="refrigerante">Refrigerante</option>
                            <option value="suco">Suco</option>
                            <option value="cerveja">Cerveja</option>
                        </select>
                        <button id="btn-voltar-comida" class="button">Voltar</button>
                        <button id="btn-proximo-bebida" class="button">Próximo</button>
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
                            <option value="credito">Cartão de Crédito</option>
                            <option value="debito">Cartão de Débito</option>
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
            const bebidasOptions = document.querySelector('.bebidas-options');
            const localizacaoForm = document.querySelector('.localizacao-form');
            const proximoButton = document.getElementById('btn-proximo');
            const voltarButton = document.getElementById('btn-voltar');
            const proximoBebidaButton = document.getElementById('btn-proximo-bebida');
            const voltarComidaButton = document.getElementById('btn-voltar-comida');
            const voltarBebidaButton = document.getElementById('btn-voltar-bebida');
            let tamanhoSelecionado = null;

            tamanhoOptions.forEach((option) => {
                option.addEventListener("change", () => {
                    if (option.checked) {
                        tamanhoSelecionado = option.value;
                        document.querySelector('.marmitas-options').style.display = 'none';
                        comidasOptions.style.display = 'block';
                        voltarButton.style.display = 'block';
                    }
                });
            });

            proximoButton.addEventListener('click', (event) => {
                event.preventDefault();
                comidasOptions.style.display = 'none';
                bebidasOptions.style.display = 'block';
                voltarComidaButton.style.display = 'block';
            });

            voltarComidaButton.addEventListener('click', (event) => {
                event.preventDefault();
                bebidasOptions.style.display = 'none';
                comidasOptions.style.display = 'block';
                voltarComidaButton.style.display = 'none';
            });

            proximoBebidaButton.addEventListener('click', (event) => {
                event.preventDefault();
                bebidasOptions.style.display = 'none';
                localizacaoForm.style.display = 'block';
                voltarBebidaButton.style.display = 'block';
            });

            voltarBebidaButton.addEventListener('click', (event) => {
                event.preventDefault();
                localizacaoForm.style.display = 'none';
                bebidasOptions.style.display = 'block';
                voltarBebidaButton.style.display = 'none';
            });
        });

    </script>

</body>

</html>
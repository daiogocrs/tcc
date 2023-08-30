<?php
$mensagemPedido = '';

if (isset($_POST['submit'])) {
    include_once('config.php');
    
    function limparDados($conexao, $dados) {
        $dados = trim($dados);
        $dados = mysqli_real_escape_string($conexao, $dados);
        return $dados;
    }
    
    $tamanho = limparDados($conexao, $_POST['tamanho']);
    $comidas = isset($_POST['comida']) ? implode(', ', array_map([$conexao, 'real_escape_string'], $_POST['comida'])) : '';
    $saladas = isset($_POST['salada']) ? implode(', ', array_map([$conexao, 'real_escape_string'], $_POST['salada'])) : '';
    $outros = isset($_POST['outros']) ? implode(', ', array_map([$conexao, 'real_escape_string'], $_POST['outros'])) : '';
    $carne = limparDados($conexao, $_POST['carne']);
    
    $query = "INSERT INTO pedidos (tamanho, carne, comidas, saladas, outros) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $tamanho, $carne, $comidas, $saladas, $outros);
    
    if (mysqli_stmt_execute($stmt)) {
        $mensagemPedido = 'Seu pedido foi feito!';
    } else {
        $mensagemPedido = 'Erro ao inserir pedido: ' . mysqli_error($conexao);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="fotos/cantinalogo.png">
    <link rel="stylesheet" type="text/css" href="css/marmitas.css">
    <title>Tela de Pedido de Marmitas</title>
</head>
<body>
    <header>
        <a href="homelogado.php"><img src="fotos/cantinalogo2.png" alt="logo cantina Federal"></a>
        <nav>
            <ul>
                <li><a href="homelogado.php">Voltar</a></li>
            </ul>
        </nav>
    </header>
    <div class="form-wrap">
        <div class="tabs">
            <h3 class="signup-tab"><a>Faça seu Pedido</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
            <?php
                if ($mensagemPedido) {
                    echo '<p style="color: green; text-align: center; font-size: 20px; padding-bottom: 15px;">' . $mensagemPedido . '</p>';
                    if ($mensagemPedido === 'Seu pedido foi feito!') {
                        echo '<form action="marmitas.php" method="GET"><input type="submit" class="button" value="Fazer Novo Pedido"></form>';
                    }
                } else {
                    ?>
                    <form class="form_cadastro" action="marmitas.php" method="POST">
                        <label>Faça seu prato:</label><br>
                        <input type="checkbox" class="input" name="comida[]" value="arroz"> Arroz <br>
                        <input type="checkbox" class="input" name="comida[]" value="arroz temperado"> Arroz Temperado <br>
                        <input type="checkbox" class="input" name="comida[]" value="macarrao"> Macarrão <br>

                        <label>Salada:</label><br>
                        <input type="checkbox" class="input" name="salada[]" value="tomate"> Tomate <br>
                        <input type="checkbox" class="input" name="salada[]" value="alface"> Alface <br>
                        <input type="checkbox" class="input" name="salada[]" value="pepino"> Pepino <br>

                        <label>Outros:</label><br>
                        <input type="checkbox" class="input" name="outros[]" value="batata frita"> Batata Frita <br>
                        <input type="checkbox" class="input" name="outros[]" value="maionese"> Maionese <br>
                        <input type="checkbox" class="input" name="outros[]" value="batata palha"> Batata Palha <br>
                        <input type="checkbox" class="input" name="outros[]" value="farofa"> Farofa <br>

                        <label>Carne:</label><br>
                        <select class="input" id="user_tamanho" autocomplete="off" name="carne" required>
                            <option value="" disabled selected>Selecione a Carne</option>
                            <option value="nenhuma">Nenhuma</option>
                            <option value="frango">Frango</option>
                            <option value="salsichao">Salsichao</option>
                            <option value="porco">Porco</option>
                        </select>

                        <label>Tamanho da marmita:</label><br>
                        <select class="input" id="user_tamanho" autocomplete="off" name="tamanho" required>
                            <option value="" disabled selected>Selecione o tamanho</option>
                            <option value="pequena">Pequena</option>
                            <option value="media">Média</option>
                            <option value="grande">Grande</option>
                        </select>
                        <input type="submit" class="button" name="submit" id="submit" value="Enviar Pedido">
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/bibliotecas.js"></script>
    
</body>
</html>


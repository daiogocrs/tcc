<?php
session_start();

$mensagemCadastro = '';

if (isset($_POST['submit'])) {
    include_once('config.php');
    
    function limparDados($conexao, $dados) {
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
    <link rel="Website Icon" type="png" href="fotos/cantinalogo.png">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Tela de Cadastro de Produtos</title>
</head>
<body>
    <header>
        <a href="homeadm.php"><img src="fotos/cantinalogo.png" alt="logo cantina Federal"></a>
        <nav>
            <ul>
                <li><a href="produtos.php">Voltar</a></li>
            </ul>
        </nav>
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
                        echo '<p style="color: lightgreen; text-align: center; font-size: 20px; padding-bottom: 15px;">' . $mensagemCadastro . '</p>';
                        echo '<form action="cadastroprodutos.php" method="GET"><input type="submit" class="button" value="Cadastrar Novo Produto"></form>';
                    }
                } else {
                    ?>
                    <form class="form_cadastro" action="cadastroprodutos.php" method="POST">
                        <input type="text" class="input" id="user_nome" autocomplete="off" placeholder="Nome" name="nome" required>
                        <input type="text" class="input" id="user_preco" autocomplete="off" placeholder="Preço" name="preco" required>
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
    <script type="text/javascript" src="js/bibliotecas.js"></script>
</body>
</html>

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

    $result = mysqli_query($conexao, "INSERT INTO produtos(nome, preco, categoria) 
        VALUES ('$nome', '$preco', '$categoria')");

    if ($result) {
        $mensagemCadastro = 'Produto cadastrado!';
    } else {
        $mensagemCadastro = 'Erro ao cadastrar o produto.';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Tela de Cadastro de Produtos</title>
</head>
<body>
    <header>
        <a href="homeadm.php"><img src="fotos/cantinalogo2.png" alt="logo cantina Federal"></a>
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
                    echo '<p style="color: green; text-align: center; font-size: 20px; padding-bottom: 15px;">' . $mensagemCadastro . '</p>';
                    if ($mensagemCadastro === 'Produto cadastrado!') {
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
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

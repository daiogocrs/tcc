<?php
include_once('config.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM produtos WHERE id=$id";
    $result = $conexao->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $nome = $user_data['nome'];
            $preco = $user_data['preco'];
            $categoria = $user_data['categoria'];
        }
    } else {
        header('Location: sistemaprodutos.php');
    }
} else {
    header('Location: sistemaprodutos.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Editar Cadastro de Produto</title>
</head>

<body>
    <a href="sistemaprodutos.php">Voltar</a>
    <div class="box">
        <form action="saveEditprodutos.php" method="POST">
            <fieldset>
                <legend><b>Editar Cliente</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value=<?php echo $nome; ?> required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="preco" id="preco" class="inputUser" value=<?php echo $preco; ?> required>
                    <label for="preco" class="labelInput">Preço</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="categoria" id="categoria" class="inputUser" value=<?php echo $categoria; ?>
                        required>
                    <label for="categoria" class="labelInput">Categoria</label>
                </div>
                <br><br>
                <input type="hidden" name="id" value=<?php echo $id; ?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>
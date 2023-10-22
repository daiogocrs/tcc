<?php
session_start();

include('../config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['nivel_acesso']) == 'adm')) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: ../home/login.php');
}

if (!empty($_GET['id_produtos'])) {
    $id_produtos = $_GET['id_produtos'];
    $sqlSelect = "SELECT * FROM produtos WHERE id_produtos=$id_produtos";
    $result = $conexao->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $nome = $user_data['nome'];
            $preco = $user_data['preco'];
            $categoria = $user_data['categoria'];
        }
    } else {
        header('Location: homeadm.php');
    }
} else {
    header('Location: homeadm.php');
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
    <link rel="stylesheet" type="text/css" href="css/editprodutos.css">
    <script type="text/javascript" src="js/bibliotecas.js"></script>
    <title>Editar Cadastro de Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        a {
            text-decoration: none;
            color: #fff;
            margin: 10px;
            font-size: 18px;
            background-color: #801300;
            padding: 10px 20px;
            border-radius: 5px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        a:hover {
            color: #fff;
            text-decoration: none;
            background-color: #573b00;
        }

        .box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        form {
            text-align: center;
        }

        fieldset {
            border: 2px solid #801300;
            border-radius: 10px;
            padding: 20px;
            margin: 0;
        }

        legend {
            font-size: 24px;
            font-weight: bold;
        }

        .inputUser {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .inputBox {
            position: relative;
        }

        .labelInput {
            position: absolute;
            top: -15px;
            left: 0;
            pointer-events: none;
            padding: 10px;
            transition: 0.2s;
            font-size: 18px;
        }

        .inputUser:focus+.labelInput,
        .inputUser:valid+.labelInput {
            transform: translate(0, -24px);
            font-size: 14px;
        }

        .input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #submit {
            background-color: #801300;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #submit:hover {
            background-color: #573b00;
        }
    </style>

</head>

<body>
    <a href="homeadm.php">Voltar</a>
    <div class="box">
        <form action="saveEditprodutos.php" method="POST">
            <fieldset>
                <legend><b>Editar Produto</b></legend>
                <br>
                <div class="inputBox" style="margin-top: 25px;">
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
                    <select id="user_categoria" class="input" name="categoria" required>
                        <option value="" disabled selected>Selecione a categoria</option>
                        <option value="salgados">Salgados</option>
                        <option value="doces">Doces</option>
                        <option value="bebidas">Bebidas</option>
                        <option value="sorvetes">Sorvetes</option>
                    </select>
                </div>
                <br><br>
                <input type="hidden" name="id_produtos" value=<?php echo $id_produtos; ?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>
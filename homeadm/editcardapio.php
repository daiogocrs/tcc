<?php
session_start();

include('../config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['nivel_acesso']) == 'adm')) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: ../home/login.php');
}

if (!empty($_GET['id_cardapio'])) {
    $id_cardapio = $_GET['id_cardapio'];
    $sqlSelect = "SELECT * FROM cardapio WHERE id_cardapio=$id_cardapio";
    $result = $conexao->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $comidas = $user_data['comidas'];
            $sobremesa = $user_data['sobremesa'];
            $dia_semana = $user_data['dia_semana'];
        }
    } else {
        header('Location: cardapioadm.php');
    }
} else {
    header('Location: cardapioadm.php');
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
    <link rel="stylesheet" type="text/css" href="../css/editcardapio.css">
</head>

<body>
    <a href="cardapioadm.php">Voltar</a>
    <div class="box">
        <form action="saveEditcardapio.php" method="POST">
            <fieldset>
                <legend><b>Editar Produto</b></legend>
                <br>
                <div class="inputBox" style="margin-top: 25px;">
                    <label for="dia_semana" class="labelInput">Dia da Semana</label>
                    <select class="inputSelect" id="dia_semana" name="dia_semana" required>
                        <option value="segunda">Segunda-feira</option>
                        <option value="terça">Terça-feira</option>
                        <option value="quarta">Quarta-feira</option>
                        <option value="quinta">Quinta-feira</option>
                        <option value="sexta">Sexta-feira</option>
                    </select>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="comidas" id="comidas" class="inputUser" value=<?php echo $comidas; ?>
                        required>
                    <label for="comidas" class="labelInput">Comidas</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="sobremesa" id="sobremesa" class="inputUser" value=<?php echo $sobremesa; ?>
                        required>
                    <label for="sobremesa" class="labelInput">Sobremesa</label>
                </div>
                <br><br>
                <input type="hidden" name="id_cardapio" value=<?php echo $id_cardapio; ?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>

<?php
session_start();

include('../config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['nivel_acesso']) == 'adm')) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: ../home/login.php');
}
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT id_pedidos, tamanho, comidas, preco, DATE_FORMAT(data_hora_pedido, '%d/%m/%Y %H:%i:%s') as data_hora_pedido, forma_pagamento, cidade, bairro, rua, numero, complemento FROM pedidos WHERE id_pedidos LIKE '%$data%' or tamanho LIKE '%$data%' ORDER BY id_pedidos DESC";
} else {
    $sql = "SELECT id_pedidos, tamanho, comidas, preco, DATE_FORMAT(data_hora_pedido, '%d/%m/%Y %H:%i:%s') as data_hora_pedido, forma_pagamento, cidade, bairro, rua, numero, complemento FROM pedidos ORDER BY id_pedidos DESC";
}
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="../fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/homeadm.css">
    <title>Cantina Federal</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../fotos/cantinalogo.png" alt="">
            </div>

            <span class="logo_name">Cantina</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="homeadm.php">
                        <i class="uil uil-shopping-bag"></i>
                        <span class="link-name">Produtos</span>
                    </a></li>
                <li><a href="marmitasadm.php">
                        <i class="uil uil-truck"></i>
                        <span class="link-name">Delivery</span>
                    </a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="../sair.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="dash-content">
            <div class="overview">
                    <div class="title">
                        <i class="uil uil-truck"></i>
                        <span class="text">Delivery</span>
                    </div>

                <h2>Pedidos</h2>
                <div class="m-5">
        <table class="table table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data e Hora do Pedido</th>
                    <th scope="col">Tamanho</th>
                    <th scope="col">Comidas</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Número</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Forma de Pagamento</th>
                    <th scope="col">Preço</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id_pedidos'] . "</td>";
                    echo "<td>" . $user_data['data_hora_pedido'] . "</td>";
                    echo "<td>" . $user_data['tamanho'] . "</td>";
                    echo "<td>" . $user_data['comidas'] . "</td>";
                    echo "<td>" . $user_data['cidade'] . "</td>";
                    echo "<td>" . $user_data['bairro'] . "</td>";
                    echo "<td>" . $user_data['rua'] . "</td>";
                    echo "<td>" . $user_data['numero'] . "</td>";
                    echo "<td>" . $user_data['complemento'] . "</td>";
                    echo "<td>" . $user_data['forma_pagamento'] . "</td>";
                    echo "<td>" . 'R$' . $user_data['preco'] . "</td>";
                    echo "<td>
                        <a class='btn btn-sm btn-danger' href='deletepedidos.php?id_pedidos=$user_data[id_pedidos]' title='Deletar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </section>
    <script type="text/javascript" src="../js/homeadm.js"></script>
</body>

</html>
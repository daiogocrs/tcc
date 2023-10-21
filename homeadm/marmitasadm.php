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
    $sql = "SELECT id_pedidos, tamanho, comidas, preco, DATE_FORMAT(data_hora_pedido, '%d/%m/%Y %H:%i:%s') as data_hora_pedido FROM pedidos WHERE id_pedidos LIKE '%$data%' or tamanho LIKE '%$data%' ORDER BY id_pedidos DESC";
} else {
    $sql = "SELECT id_pedidos, tamanho, comidas, preco, DATE_FORMAT(data_hora_pedido, '%d/%m/%Y %H:%i:%s') as data_hora_pedido FROM pedidos ORDER BY id_pedidos DESC";
}
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="../fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Pedidos de Marmitas</title>
    <style>
        body {
            background-color: #801300;
            color: white;
            text-align: center;
        }
        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }
        .box-search {
            display: flex;
            gap: .1%;
            justify-content: center;
        }
        .navbar-bg {
            background-color: #6e1100;
        }
        .navbar-brand {
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-bg">
        <div class="container-fluid">
            <a class="navbar-brand">Marmitas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="homeadm.php" class="btn btn-danger me-5">Voltar</a>
        </div>
    </nav>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data e Hora do Pedido</th>
                    <th scope="col">Tamanho</th>
                    <th scope="col">Comidas</th>
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
</body>
</html>

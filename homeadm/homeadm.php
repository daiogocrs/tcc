<?php
session_start();
include('../config.php');
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['nivel_acesso']) == 'adm')) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: ../home/login.php');
}

$email = $_SESSION['email'];
$sql = "SELECT nome FROM usuarios WHERE email = '$email'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $logado = $row['nome'];
}

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM usuarios WHERE id_usuarios LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id_usuarios DESC";
} else {
    $sql = "SELECT * FROM usuarios ORDER BY id_usuarios DESC";
}

if (isset($_POST['submit'])) {
    function limparDados($conexao, $dados)
    {
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
}

$sql = "SELECT id_produtos, nome, preco, categoria FROM produtos";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="../fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Cantina Federal</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --primary-color: #801300;
            --panel-color: #FFF;
            --text-color: #000;
            --black-light-color: #707070;
            --border-color: #e6e5e5;
            --toggle-color: #DDD;
            --box1-color: #4DA3FF;
            --box2-color: #FFE6AC;
            --box3-color: #E7D1FC;
            --title-icon-color: #fff;
            --tran-05: all 0.5s ease;
            --tran-03: all 0.3s ease;
            --tran-03: all 0.2s ease;
        }

        body {
            min-height: 100vh;
            background-color: var(--primary-color);
            overflow-x: auto;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0b3cc1;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding: 10px 14px;
            background-color: var(--panel-color);
            border-right: 1px solid var(--border-color);
            transition: var(--tran-05);
        }

        nav.close {
            width: 73px;
        }

        nav .logo-name {
            display: flex;
            align-items: center;
        }

        nav .logo-image {
            display: flex;
            justify-content: center;
            min-width: 45px;
        }

        nav .logo-image img {
            width: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        nav .logo-name .logo_name {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-color);
            margin-left: 14px;
            transition: var(--tran-05);
        }

        nav.close .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav .menu-items {
            margin-top: 40px;
            height: calc(100% - 90px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .menu-items li {
            list-style: none;
        }

        .menu-items li a {
            display: flex;
            align-items: center;
            height: 50px;
            text-decoration: none;
            position: relative;
        }

        .nav-links li a:hover:before {
            content: "";
            position: absolute;
            left: -7px;
            height: 5px;
            width: 5px;
            border-radius: 50%;
            background-color: var(--primary-color);
        }

        .menu-items li a i {
            font-size: 24px;
            min-width: 45px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--black-light-color);
        }

        .menu-items li a .link-name {
            font-size: 18px;
            font-weight: 400;
            color: var(--black-light-color);
            transition: var(--tran-05);
        }

        nav.close li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        .nav-links li a:hover i,
        .nav-links li a:hover .link-name {
            color: var(--primary-color);
        }

        .menu-items .logout-mode {
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
        }

        .menu-items .mode {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .menu-items .mode-toggle {
            position: absolute;
            right: 14px;
            height: 50px;
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .mode-toggle .switch {
            position: relative;
            display: inline-block;
            height: 22px;
            width: 40px;
            border-radius: 25px;
            background-color: var(--toggle-color);
        }

        .switch:before {
            content: "";
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            height: 15px;
            width: 15px;
            background-color: var(--panel-color);
            border-radius: 50%;
            transition: var(--tran-03);
        }

        .dashboard {
            position: relative;
            left: 250px;
            background-color: var(--panel-color);
            min-height: 100vh;
            width: calc(100% - 250px);
            padding: 10px 14px;
            transition: var(--tran-05);
        }

        nav.close~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        .dashboard .top {
            position: fixed;
            top: 0;
            left: 250px;
            display: flex;
            width: calc(100% - 250px);
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            background-color: var(--panel-color);
            transition: var(--tran-05);
            z-index: 10;
        }

        nav.close~.dashboard .top {
            left: 73px;
            width: calc(100% - 73px);
        }

        .dashboard .top .sidebar-toggle {
            font-size: 26px;
            color: var(--text-color);
            cursor: pointer;
        }

        .dashboard .top .search-box {
            position: relative;
            height: 45px;
            max-width: 600px;
            width: 100%;
            margin: 0 30px;
        }

        .top .search-box input {
            position: absolute;
            border: 1px solid var(--border-color);
            background-color: var(--panel-color);
            padding: 0 25px 0 50px;
            border-radius: 5px;
            height: 100%;
            width: 100%;
            color: var(--text-color);
            font-size: 15px;
            font-weight: 400;
            outline: none;
        }

        .top .search-box i {
            position: absolute;
            left: 15px;
            font-size: 22px;
            z-index: 10;
            top: 50%;
            transform: translateY(-50%);
            color: var(--black-light-color);
        }

        .top img {
            width: 40px;
            border-radius: 50%;
        }

        .dashboard .dash-content {
            padding-top: 50px;
        }

        .dash-content .title {
            display: flex;
            align-items: center;
            margin: 60px 0 30px 0;
        }

        .dash-content .title i {
            position: relative;
            height: 35px;
            width: 35px;
            background-color: var(--primary-color);
            border-radius: 6px;
            color: var(--title-icon-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .dash-content .title .text {
            font-size: 24px;
            font-weight: 500;
            color: var(--text-color);
            margin-left: 10px;
        }

        .dash-content .boxes {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .dash-content .boxes .box {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 12px;
            width: calc(100% / 3 - 15px);
            padding: 15px 20px;
            background-color: var(--box1-color);
            transition: var(--tran-05);
        }

        .boxes .box i {
            font-size: 35px;
            color: var(--text-color);
        }

        .boxes .box .text {
            white-space: nowrap;
            font-size: 18px;
            font-weight: 500;
            color: var(--text-color);
        }

        .boxes .box .number {
            font-size: 40px;
            font-weight: 500;
            color: var(--text-color);
        }

        .boxes .box.box2 {
            background-color: var(--box2-color);
        }

        .boxes .box.box3 {
            background-color: var(--box3-color);
        }

        .dash-content .activity .activity-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .activity .activity-data {
            display: flex;
        }

        .activity-data .data {
            display: flex;
            flex-direction: column;
            margin: 0 15px;
        }

        .activity-data .data-title {
            font-size: 20px;
            font-weight: 500;
            color: var(--text-color);
        }

        .activity-data .data .data-list {
            font-size: 18px;
            font-weight: 400;
            margin-top: 20px;
            white-space: nowrap;
            color: var(--text-color);
        }

        @media (max-width: 1000px) {
            nav {
                width: 73px;
            }

            nav.close {
                width: 250px;
            }

            nav .logo_name {
                opacity: 0;
                pointer-events: none;
            }

            nav.close .logo_name {
                opacity: 1;
                pointer-events: auto;
            }

            nav li a .link-name {
                opacity: 0;
                pointer-events: none;
            }

            nav.close li a .link-name {
                opacity: 1;
                pointer-events: auto;
            }

            nav~.dashboard {
                left: 73px;
                width: calc(100% - 73px);
            }

            nav.close~.dashboard {
                left: 250px;
                width: calc(100% - 250px);
            }

            nav~.dashboard .top {
                left: 73px;
                width: calc(100% - 73px);
            }

            nav.close~.dashboard .top {
                left: 250px;
                width: calc(100% - 250px);
            }

            .activity .activity-data {
                overflow-X: scroll;
            }
        }

        @media (max-width: 1000px) {
            table {
                overflow-x: auto;
            }
        }

        @media (max-width: 780px) {
            .dash-content .boxes .box {
                width: calc(100% / 2 - 15px);
                margin-top: 15px;
            }
        }

        @media (max-width: 560px) {
            .dash-content .boxes .box {
                width: 100%;
            }
        }

        @media (max-width: 400px) {
            nav {
                width: 0px;
            }

            nav.close {
                width: 73px;
            }

            nav .logo_name {
                opacity: 0;
                pointer-events: none;
            }

            nav.close .logo_name {
                opacity: 0;
                pointer-events: none;
            }

            nav li a .link-name {
                opacity: 0;
                pointer-events: none;
            }

            nav.close li a .link-name {
                opacity: 0;
                pointer-events: none;
            }

            nav~.dashboard {
                left: 0;
                width: 100%;
            }

            nav.close~.dashboard {
                left: 73px;
                width: calc(100% - 73px);
            }

            nav~.dashboard .top {
                left: 0;
                width: 100%;
            }

            nav.close~.dashboard .top {
                left: 0;
                width: 100%;
            }
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .custom-modal {
            max-width: 90%;
            margin: 0 auto;
        }

        .modal-dialog {
            max-width: 90%;
        }

        .modal-content {
            border: none;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }
    </style>
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
                    </a>
                </li>
                <li><a href="marmitasadm.php">
                        <i class="uil uil-truck"></i>
                        <span class="link-name">Delivery</span>
                    </a>
                </li>
                <li><a href="cardapioadm.php">
                        <i class="uil uil-book"></i>
                        <span class="link-name">Cardápio</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../sair.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Sair</span>
                    </a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        <div class="dash-content">
            <div class="overview">
                <a href="#" id="openProductModal" style="text-decoration: none;">
                    <div class="title">
                        <i class="uil uil-plus"></i>
                        <span class="text">Novos Produtos</span>
                    </div>
                </a>
                <h2>Produtos Disponíveis</h2>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user_data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $user_data['nome'] . "</td>";
                                echo "<td>" . $user_data['preco'] . "</td>";
                                echo "<td>" . $user_data['categoria'] . "</td>";
                                echo "<td>
                                <a class='btn btn-sm btn-primary' href='javascript:void(0);' onclick=\"openEditModal('{$user_data['id_produtos']}', '{$user_data['nome']}', '{$user_data['preco']}', '{$user_data['categoria']}')\" title='Editar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.650l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106.106a.5.5 0 0 1 0 .708l-10-10-.106.106a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0 .708l10-10 .106-.106a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3zM3 13.5a.5.5 0 0 1 .5-.5H4V12a.5.5 0 0 1 .5-.5H5a.5.5 0 0 1 .5.5V12h.5a.5.5 0 0 1 .5.5V13a.5.5 0 0 1-.5.5H5V14a.5.5 0 0 1-.5.5H4a.5.5 0 0 1-.5-.5V13H3a.5.5 0 0 1-.5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </a>
                                <a class='btn btn-sm btn-danger' href='deleteprodutos.php?id_produtos=$user_data[id_produtos]' title='Deletar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </a>
                            </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="modal fade custom-modal" id="productModal" tabindex="-1" role="dialog"
            aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Novos Produtos</h5>
                        <button type="button" class="close" id="closeModal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form_cadastro" action="homeadm.php" method="POST">
                            <input type="text" class="form-control" id="user_nome" autocomplete="off" placeholder="Nome"
                                name="nome" required>
                            <br>
                            <input type="text" class="form-control" id="user_preco" autocomplete="off"
                                placeholder="Preço" name="preco" required>
                            <br>
                            <select id="user_categoria" class="form-control" name="categoria" required>
                                <option value="" disabled selected>Selecione a categoria</option>
                                <option value="salgados">Salgados</option>
                                <option value="doces">Doces</option>
                                <option value="bebidas">Bebidas</option>
                                <option value="sorvetes">Sorvetes</option>
                            </select>
                            <br>
                            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Cadastrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade custom-modal" id="editProductModal" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                        <button type="button" class="close" id="closeEditModal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="saveEditprodutos.php" method="POST">
                            <input type="hidden" name="id_produtos" id="editProductID" value="">
                            <div class="form-group">
                                <label for="editProductName">Nome:</label>
                                <input type="text" class="form-control" id="editProductName" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="editProductPrice">Preço:</label>
                                <input type="text" class="form-control" id="editProductPrice" name="preco" required>
                            </div>
                            <div class="form-group">
                                <label for="editProductCategory">Categoria:</label>
                                <select class="form-control" id="editProductCategory" name="categoria" required>
                                    <option value="salgados">Salgados</option>
                                    <option value="doces">Doces</option>
                                    <option value="bebidas">Bebidas</option>
                                    <option value="sorvetes">Sorvetes</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/homeadm.js"></script>

    <script>
        document.getElementById("openProductModal").addEventListener("click", function () {
            $('#productModal').modal('show');
        });

        function openEditModal(id, name, price, category) {
            document.getElementById("editProductID").value = id;
            document.getElementById("editProductName").value = name;
            document.getElementById("editProductPrice").value = price;
            document.getElementById("editProductCategory").value = category;
            $('#editProductModal').modal('show');
        }

        document.getElementById("closeEditModal").addEventListener("click", function () {
            $('#editProductModal').modal('hide');
        });

        document.getElementById("closeModal").addEventListener("click", function () {
            $('#productModal').modal('hide');
        });
    </script>

</body>

</html>
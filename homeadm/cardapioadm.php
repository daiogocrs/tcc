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

if (isset($_POST['submit'])) {
    function limparDados($conexao, $dados)
    {
        $dados = trim($dados);
        $dados = mysqli_real_escape_string($conexao, $dados);
        return $dados;
    }

    $comidas = limparDados($conexao, ucfirst($_POST['comidas']));
    $sobremesa = limparDados($conexao, ucfirst($_POST['sobremesa']));
    $dia_semana = limparDados($conexao, $_POST['dia_semana']);

    $existingCardapio = mysqli_query($conexao, "SELECT id_cardapio FROM cardapio WHERE dia_semana = '$dia_semana'");
    if (mysqli_num_rows($existingCardapio) > 0) {
        $mensagemCadastro = 'Já existe um cardápio cadastrado para o dia da semana selecionado.';
    } else {
        $result = mysqli_query($conexao, "INSERT INTO cardapio(comidas, sobremesa, dia_semana) 
            VALUES ('$comidas', '$sobremesa', '$dia_semana')");

        if ($result) {
            $mensagemCadastro = 'Cardápio cadastrado!';
        } else {
            $mensagemCadastro = 'Erro ao cadastrar o cardápio.';
        }
    }
}

$sql = "SELECT id_cardapio, comidas, sobremesa, dia_semana FROM cardapio";
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/produtosadm.css">
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
            <li>
                    <a href="marmitasadm.php">
                        <i class="uil uil-truck"></i>
                        <span class="link-name">Delivery</span>
                    </a>
                </li>
                <li>
                    <a href="produtosadm.php">
                        <i class="uil uil-shopping-bag"></i>
                        <span class="link-name">Produtos</span>
                    </a>
                </li>
                <li>
                    <a href="cardapioadm.php">
                        <i class="uil uil-book"></i>
                        <span class="link-name">Marmita Cardápio</span>
                    </a>
                </li>
                <li>
                    <a href="tamanho.php">
                        <i class="uil uil-dollar-alt"></i>
                        <span class="link-name">Marmita Preço</span>
                    </a>
                </li>
            </ul>
            <ul class="logout-mode">
                <li>
                    <a href="../sair.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Sair</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        <div class="dash-content">
            <div class="overview">
                <a href="#" id="openCardapioModal" style="text-decoration: none;">
                    <div class="title">
                        <i class="uil uil-plus"></i>
                        <span class="text">Novo Cardápio</span>
                    </div>
                </a>
                <h2>Cardápio Disponível</h2>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Comidas</th>
                                <th>Sobremesa</th>
                                <th>Dia da Semana</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($cardapio_data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $cardapio_data['comidas'] . "</td>";
                                echo "<td>" . $cardapio_data['sobremesa'] . "</td>";
                                echo "<td>" . $cardapio_data['dia_semana'] . "</td>";
                                echo "<td> 
                                <a class='btn btn-sm btn-primary' href='javascript:void(0);' onclick=\"openEditCardapioModal('{$cardapio_data['id_cardapio']}', '{$cardapio_data['comidas']}', '{$cardapio_data['sobremesa']}', '{$cardapio_data['dia_semana']}')\" title='Editar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.650l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106.106a.5.5 0 0 1 0 .708l-10-10-.106.106a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0 .708l10-10 .106-.106a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3zM3 13.5a.5.5 0 0 1 .5-.5H4V12a.5.5 0 0 1 .5-.5H5a.5.5 0 0 1 .5.5V12h.5a.5.5 0 0 1 .5.5V13a.5.5 0 0 1-.5.5H5V14a.5.5 0 0 1-.5.5H4a.5.5 0 0 1-.5-.5V13H3a.5.5 0 0 1-.5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </a>           
                                <a class='btn btn-sm btn-danger' href='deletecardapio.php?id_cardapio=$cardapio_data[id_cardapio]' title='Deletar'>
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

    <div class="modal fade custom-modal" id="cardapioModal" tabindex="-1" role="dialog"
        aria-labelledby="cardapioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cardapioModalLabel">Novo Cardápio</h5>
                    <button type="button" class="close" id="closeCardapioModal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form_cadastro" action="cardapioadm.php" method="POST">
                        <select class="form-control" id="dia_semana" name="dia_semana" required>
                            <option value="" disabled selected>Selecione o dia da semana</option>
                            <option value="segunda">Segunda-feira</option>
                            <option value="terça">Terça-feira</option>
                            <option value="quarta">Quarta-feira</option>
                            <option value="quinta">Quinta-feira</option>
                            <option value="sexta">Sexta-feira</option>
                        </select>
                        <br>
                        <input class="form-control" id="cardapio_comidas" name="comidas" placeholder="Comidas" required>
                        <br>
                        <input type="text" class="form-control" id="cardapio_sobremesa" name="sobremesa"
                            placeholder="Sobremesa">
                        <br>
                        <input type="submit" class="btn btn-primary" name="submit" id="submitCardapio"
                            value="Cadastrar Cardápio">
                        <?php
                        if (isset($mensagemCadastro) && !empty($mensagemCadastro)) {
                            if (strpos($mensagemCadastro, 'Já existe um cardápio cadastrado') !== false) {
                                echo '<p style="color: red; font-weight: bold;">' . $mensagemCadastro . '</p>';
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="editCardapioModal" tabindex="-1" role="dialog"
        aria-labelledby="editCardapioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCardapioModalLabel">Editar Produto</h5>
                    <button type="button" class="close" id="closeEditCardapioModal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="saveEditcardapio.php" method="POST">
                        <input type="hidden" name="id_cardapio" id="editCardapioID" value="">
                        <div class="form-group">
                            <label for="editCardapioDay">Dia da semana:</label>
                            <select class="form-control" id="editCardapioDay" name="dia_semana" required>
                                <option value="segunda">Segunda-feira</option>
                                <option value="terça">Terça-feira</option>
                                <option value="quarta">Quarta-feira</option>
                                <option value="quinta">Quinta-feira</option>
                                <option value="sexta">Sexta-feira</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editCardapioFood">Comidas:</label>
                            <input type="text" class="form-control" name="comidas" id="editCardapioFood" required>
                        </div>
                        <div class="form-group">
                            <label for="editCardapioDessert">Categoria:</label>
                            <input type="text" class="form-control" name="sobremesa" id="editCardapioDessert" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/produtosadm.js"></script>
    <script>
        document.getElementById("openCardapioModal").addEventListener("click", function () {
            $('#cardapioModal').modal('show');
        });

        function openEditCardapioModal(id, food, dessert, day) {
            document.getElementById("editCardapioID").value = id;
            document.getElementById("editCardapioFood").value = food;
            document.getElementById("editCardapioDessert").value = dessert;
            document.getElementById("editCardapioDay").value = day;
            $('#editCardapioModal').modal('show');
        }

        document.getElementById("closeEditCardapioModal").addEventListener("click", function () {
            $('#editCardapioModal').modal('hide');
        });

        document.getElementById("closeCardapioModal").addEventListener("click", function () {
            $('#cardapioModal').modal('hide');
        });
    </script>
</body>

</html>
<?php
session_start();
include_once('config.php');
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM produtos WHERE id LIKE '%$data%' or nome LIKE '%$data%' or preco LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM produtos ORDER BY id DESC";
}

function getProdutosByCategoria($conexao, $categoria)
{
    $sql = "SELECT * FROM produtos WHERE categoria = '$categoria' ORDER BY id DESC";
    $result = $conexao->query($sql);
    return $result;
}

$categorias = array('salgados', 'doces', 'bebidas', 'sorvetes');


$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="fotos/cantinalogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="css/cardapio.css">
    <title>Tela de Cardápio</title>
</head>

<body>
    <header>
        <a href="home.php"><img src="fotos/cantinalogo2.png" alt="logo cantina Federal"></a>
    </header>
    <section class="bg-cardapio bg-section" id="cardapio">
        <div class="container-fluid">
            <h1 class="container-h1">Cardápio</h1>
            <div class="row">
                <div class="col-sm-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($categorias as $index => $categoria) { ?>
                                <div class="swiper-slide">
                                    <ul class="nav nav-pills category-buttons" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($index === 0) echo 'active'; ?>"
                                               data-toggle="pill"
                                               href="#<?= $categoria ?>">
                                                <?php echo ucfirst($categoria); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="tab-content slideanim">
                <?php foreach ($categorias as $index => $categoria) { ?>
                    <div id="<?= $categoria ?>"
                         class="tab-pane fade <?php if ($index === 0) echo 'show active'; ?> slide">
                        <div class="row">
                            <div class="col-sm-7">
                                <ul class="list-group">
                                    <?php
                                    $categoria_result = getProdutosByCategoria($conexao, $categoria);
                                    while ($user_data = mysqli_fetch_assoc($categoria_result)) {
                                        echo '<li class="list-group-item">';
                                        echo '<h4 class="list-group-item-heading">' . $user_data['nome'];
                                        echo '<span class="badge pull-right">R$' . $user_data['preco'] . '</span>';
                                        echo '</h4>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <div class="right-cover">
                                    <h3><?php echo ucfirst($categoria); ?></h3>
                                    <img src="fotos/<?= $categoria ?>.jpg?v=<?= time() ?>"
                                         class="cardapio-img img-fluid"
                                         alt="Imagem de <?= $categoria ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/cardapio.js"></script>

</body>


</html>
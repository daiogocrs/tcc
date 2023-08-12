<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/cardapio.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tela de Cardápio</title>
</head>

<body>

    <header>
        <a href="home.php"><img src="fotos/cantinalogo2.png" alt="logo cantina Federal"></a>
    </header>

    <script type="text/javascript" src="js/cardapio.js"></script>
    <section class="bg-cardapio bg-section" id="cardapio">
        <div class="container-fluid">
            <h1 class="container-h1">Cardápio</h1>
            <div class="row">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#salgados">Salgados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#doces">Doces</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#bebidas">Bebidas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#sorvetes">Picolé e sorvetes</a>
                    </li>
                </ul>
                <div class="tab-content slideanim">
                    <div id="salgados" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-sm-7">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <?php
                                        while ($user_data = mysqli_fetch_assoc($result)) {
                                            echo '<h4 class="list-group-item-heading">' . $user_data['nome'];
                                            echo '<span class="badge pull-right">' . $user_data['preco'] . '</span>';
                                            echo '</h4>';
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <div class="right-cover">
                                    <h3>Salgados</h3>
                                    <img src="fotos/salgados.jpg" class="cardapio-img img-fluid"
                                        alt="Imagem de salgados">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="doces" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-7">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4 class="list-group-item-heading">Churros<span class="badge pull-right">R$0,80
                                                pila</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <div class="right-cover">
                                    <h3>Doces</h3>
                                    <img src="fotos/doces.jpg" class="cardapio-img img-fluid" alt="Imagem de doces">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bebidas" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-7">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4 class="list-group-item-heading">Café<span
                                                class="badge pull-right">R$3,50</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <div class="right-cover">
                                    <h3>Bebidas</h3>
                                    <img src="fotos/bebidas.jpg" class="cardapio-img img-fluid" alt="Imagem de bebidas">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="sorvetes" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-7">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4 class="list-group-item-heading">Sorvete X<span
                                                class="badge pull-right">R$5,00</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <div class="right-cover">
                                    <h3>Picolé e sorvetes</h3>
                                    <img src="fotos/sorvetes.jpg" class="cardapio-img img-fluid"
                                        alt="Imagem de sorvetes">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
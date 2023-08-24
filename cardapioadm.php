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
    <link rel="stylesheet" type="text/css" href="css/cardapio.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <title>Tela de Cardápio</title>
    <style>
        html, body {
     font-family: 'Lato', sans-serif;
     overflow-x: hidden;
     width: 100%;
}
 header img {
     margin-left: 20px;
     margin-top: 20px;
     position: absolute;
     width: 200px;
}
 a {
     text-decoration: none;
}
 ul {
     list-style-type: none;
}
 a:hover, a:focus {
     text-decoration: none;
}
 h1, h2, h3, h4, h5, h6 {
     font-family: 'Lato', sans-serif;
     font-weight: 600;
     text-align: center;
     text-transform: none;
}
 hr {
     border-color: #ffc266;
     border-width: 5px;
     max-width: 100%;
}
 .container-h1 {
     color: #333;
     font-family: 'Lora', serif;
     font-family: 'Ubuntu', sans-serif;
     font-size: 50px;
     font-weight: 700;
     margin: 50px auto;
     text-align: center;
}
 .btn {
     background-color: #182c39;
     border-radius: 0;
     color: #fff;
     display: table;
     font-weight: 500;
     margin: 20px auto;
     padding: 10px;
}
 .btn:hover{
     background-color: transparent;
     border: 1px solid #182c39;
     color: #182c39;
}
 .hr-h3s {
     border: 3px solid #E94B3C;
     margin: 0 auto 35px auto;
     width: 70px;
}
 textarea {
     resize: none;
}
 section {
     align-items: center;
     padding: 50px 60px;
}
 .bg-section h2 {
     background-color: #182c39;
     border-radius: 50px;
     color: #ffc266;
     font-family: 'Montserrat', sans-serif;
     margin: 50px 0;
     padding: 25px 20px;
     text-transform: none;
}
 .slideanim {
     visibility: hidden;
}
 .slide {
     -moz-animation-duration: 1.5s;
     -moz-animation-name: slide;
     -webkit-animation-duration: 1.5s;
     -webkit-animation-name: slide;
     animation-duration: 1.5s;
     animation-name: slide;
     visibility: visible;
}
 @keyframes slide {
     0% {
         opacity: 0;
         transform: translateX(50%);
    }
     100% {
         opacity: 1;
         transform: translateX(0%);
    }
}
 @-webkit-keyframes slide {
     0% {
         opacity: 0;
         -webkit-transform: translateX(50%);
         transform: translateX(50%);
    }
     100% {
         opacity: 1;
         -webkit-transform: translateX(0%);
         transform: translateX(0%);
    }
}
 .navbar {
     background-color: #182c39;
     border-color: rgb(51, 17, 0);
     border-color: rgba(51, 17, 0, 0.2);
     font-weight: 700;
     padding: 15px 0;
     transition: padding .5s;
}
.navbar .nav-link {
    border: none;
}
 .navbar .navbar-brand {
     color: #fff;
     font-family: 'Leckerli One', cursive;
     font-size: 25px;
     font-weight: 500;
     padding-left: 15px;
     text-shadow: black 0.3em 0.3em 0.3em;
     text-transform: none;
}
 .navbar .navbar-brand:hover, .navbar .navbar-brand:focus {
     color: #ffc266;
     transition: color 1s;
}
 .navbar .navbar-nav {
     padding-right: 50px;
}
 .navbar .navbar-nav > li > a {
     color: #fff;
     font-family: 'Lato', sans-serif;
     font-size: 14px;
     font-weight: 600;
     margin: auto 5px;
     text-shadow: #222 0.3em 0.3em 0.3em;
     text-transform: uppercase;
}
 .navbar .navbar-nav > li > a:hover, .navbar .navbar-nav > li > a:focus:hover {
     color: #ffc266;
     transition: color 1s;
}
 .navbar .navbar-nav > li.active > a:hover, .navbar .navbar-nav > li.active > a:focus:hover {
     background-color: transparent;
}
 .navbar.scrolled {
     box-shadow: 0 3px 3px rgba(0,0,0,0.1);
     opacity: 0.9;
     padding: 5px 0;
}

/* Estilos personalizados para os botões de categoria */
.category-buttons {
    display: inline-flex;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.category-buttons .nav-link {
    padding: 10px 15px;
    background-color: #182c39;
    color: #fff;
    border: none;
    text-decoration: none;
    white-space: nowrap;
    min-width: auto;
    max-width: 200px; 
    overflow: hidden; 
    text-overflow: ellipsis; 
    transition: background-color 0.3s, color 0.3s;
}

.category-buttons .nav-link.active {
    background-color: #944743;
    border: none;
    color: #fff;
}

.category-buttons .nav-link:hover {
    background-color: #944743;
    color: #fff;
}

.swiper-container {
    overflow: hidden;
    position: relative;
}

.swiper-wrapper {
    display: flex;
}

.swiper-slide {
    flex-shrink: 0;
    width: 100%;
    transition: transform 0.3s ease-in-out;
}

.swiper-button-next,
.swiper-button-prev {
    color: #fff;
    font-size: 24px;
}

.swiper-pagination {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}

.swiper-pagination-bullet {
    background-color: #fff;
    opacity: 0.5;
    width: 10px;
    height: 10px;
    margin: 0 5px;
    border-radius: 50%;
}

.swiper-pagination-bullet-active {
    opacity: 1;
}

 .jumbotron {
     background-image: url('https://res.cloudinary.com/dbte0ueti/image/upload/v1536951689/new/jumbotron.jpg');
     background-position: 0% 25%;
     background-repeat: no-repeat;
     background-size: cover;
     color: white;
     height: 700px;
     margin-bottom: 0px;
     text-shadow: black 0.3em 0.3em 0.3em;
}
 .jumbotron .header-content-inner {
     font-family: 'Roboto', sans-serif;
     font-weight: 700;
     margin-bottom: 0;
     margin: 200px;
     text-transform: none;
}
 .jumbotron h1 {
     font-size: 45px;
}
 .jumbotron h3 {
     font-size: 25px;
}
 .bg-about {
     background-color: white;
     margin: auto 50px;
}
 #about h3 {
     color: #E94B3C;
     font-family: 'Roboto', sans-serif;
}
 #about .restaurant-history p {
     color: #444;
     font-family: 'Roboto', sans-serif;
     font-size: 15px;
     padding: 20px 80px;
}
 p.first::first-letter {
     color: #000;
     font-size: 150%;
}
 #about h1 {
     padding-top: 35px;
}
 #about .image {
     display: block;
     height: auto;
     width: 100%;
}
 #about .hov-img * {
     box-sizing: border-box;
}
 #about .hov-img {
     display: inline-block;
     height: auto;
     margin-bottom: 10px;
     max-width: 100%;
     overflow: hidden;
     position: relative;
}
 #about .hov-img img {
     max-width: 100%;
}
 #about .hov-img-bottom {
     display: block;
}
 #about .hov-img-top {
     -moz-transition: all 0.4s ease-in-out 0s;
     -ms-transition: all 0.4s ease-in-out 0s;
     -webkit-transition: all 0.4s ease-in-out 0s;
     background: rgba(0, 0, 0, 0.6);
     bottom: 0;
     color: #fff;
     height: 100%;
     left: 0;
     opacity: 0;
     position: absolute;
     right: 0;
     top: 0;
     transition: all 0.4s ease-in-out 0s;
     width: 100%;
}
 #about .hov-img:hover .hov-img-top {
     opacity: 1;
}
 #about .hov-img-text {
     -moz-transform: translate(-50%, -50%);
     -ms-transform: translate(-50%, -50%);
     -webkit-transform: translate(-50%, -50%);
     display: inline-block;
     font-size: 18px;
     left: 50%;
     position: absolute;
     text-align: center;
     text-shadow: black .2em .2em .2em;
     top: 50%;
     transform: translate(-50%, -50%);
}
 #about .hov-img-text p {
     font-size: 15px;
     line-height: 1.2em;
}
 #about .hov-img-slideup {
     -moz-transform: translateY(100%);
     -ms-transform: translateY(100%);
     -webkit-transform: translateY(100%);
     transform: translateY(100%);
}
 #about .hov-img:hover .hov-img-slideup {
     -moz-transform: translateY(0);
     -ms-transform: translateY(0);
     -webkit-transform: translateY(0);
     transform: translateY(0);
}
 .bg-cardapio {
     margin: auto 50px;
}
 #cardapio .nav-pills {
     background-color: #182c39;
     border-color: transparent;
     color: #000;
     font-weight: 500;
     margin: 25px;
}
 #cardapio .nav-pills > li > a, #cardapio .nav-pills > li > a:focus {
     border-radius: 0;
     border: 1px solid #fff;
     color: #fff;
     font-family: 'Roboto', sans-serif;
     font-size: 15px;
     font-weight: 500;
     text-transform: uppercase;
}
 #cardapio .nav-pills > li > a:hover, #cardapio .nav-pills > li > a:focus:hover {
     background-color: #944743;
     color: #fff;
}
 #cardapio .nav-pills > li > a.active, #cardapio .nav-pills > li > a.active:focus {
     background-color: #944743;
     color: #fff;
}
 #cardapio .hr-cardapio {
     border: 2px solid #182c39;
     width: 100%;
}
 #cardapio .list-group-item {
     background-color: transparent;
     border-bottom: 1px solid #555;
     border: none;
     padding: 0 auto;
}
 #cardapio .tab-content .tab-pane h3 {
     font-family: 'Leckerli One', cursive;
     text-align: center;
}
 #cardapio .list-group-item:first-child {
     border-top-left-radius: 0;
     border-top-right-radius: 0;
}
 #cardapio .list-group-item:last-child {
     border-bottom-left-radius: 0;
     border-bottom-right-radius: 0;
}
 #cardapio .list-group-item h4 {
     color: #182c39;
     font-size: 18px;
     text-align: left;
     text-transform: none;
}
 #cardapio .list-group-item p {
     color: #555555;
     font-size: 14px;
     font-style: italic;
     font-weight: 500;
     text-align: left;
     text-transform: none;
}
 #cardapio .badge {
     background-color: #444;
     border-radius: 0;
     color: #fff;
     font-size: 12px;
}
 #cardapio .right-cover {
     background-color: #fff;
     color: #DC4C46;
     padding: 10px;
     text-shadow: #DC4C46 .4em .4em .4em;
     text-transform: none;
}
 #service .service-round {
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     border: 8px solid #182c39;
     color: #182c39;
     display: inline-block;
     height: 100px;
     padding: 10px;
     text-align: center;
     width: 100px;
}
 #service .service-round i {
     color: #182c39;
}
 #service h4 {
     color: #555;
     font-size: 20px;
     margin: 10px auto;
}
 #service .round:hover .fa {
     color: #ffc266;
     transition: color 2s;
}
 #service .round:hover .service-round {
     border-color: #ffc266;
     transition: border-color 2s;
}
 #gallery h3 {
     color: #182c39;
     font-family: 'Lato', sans-serif;
     font-weight: 700;
     margin: 50px auto 10px auto;
     text-transform: none;
}
 #gallery .gallery {
     margin: 0px 80px;
}
 #gallery .no-gutter > [class*="col-"] {
     padding-left: 0;
     padding-right: 0;
}
 #gallery .caption-content {
     background: rgba(0, 0, 0, 0.8);
     bottom: 100%;
     color: #f1f1f1;
     height: 0;
     left: 0;
     overflow: hidden;
     position: absolute;
     right: 0;
     transition: .5s ease;
     width: 100%;
}
 #gallery .portfolio-item:hover .caption-content {
     bottom: 0;
     height: 100%;
}
 #gallery .caption-content .fa {
     -moz-transform: translate(-50%, -50%);
     -ms-transform: translate(-50%, -50%);
     -o-transform: translate(-50%, -50%);
     -webkit-transform: translate(-50%, -50%);
     color: white;
     font-size: 40px;
     left: 50%;
     overflow: hidden;
     position: absolute;
     top: 50%;
     transform: translate(-50%, -50%);
     white-space: nowrap;
}
 #gallery .more-img {
     background-color: #182c39;
     margin: 0 80px;
}
 #gallery .more-img .to-gallery {
     color: #fff;
     margin: 0px auto;
     padding: 10px;
     text-align: center;
     text-transform: none;
}
 #gallery .more-img .to-gallery h4 {
     color: #fff;
     font-size: 16px;
     margin: auto;
     padding: 5px;
     text-transform: none;
}
 #gallery .more-img .social-networks .fa {
     color: #fff;
     font-size: 20px;
     margin: 5px 5px;
}
 #gallery .more-img .social-networks .fa:hover {
     color: #ffc266;
}
 #staff .thumbnail-row {
     margin: auto 60px;
}
 #staff h3 {
     color: #182c39;
     font-family: 'Lato', sans-serif;
     margin: 50px auto 10px auto;
     text-transform: none;
}
 #staff img {
     border-radius: 50%;
     margin-bottom: 10px;
}
 #staff h5 {
     color: #222;
     font-family: 'Roboto', sans-serif;
     font-size: 18px;
}
 #staff h6 {
     color: #555;
     font-size: 16px;
}
 #staff img:hover {
     box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.9);
     transition: .3s;
}
 #testimonials .hr-testimonials {
     border: 1px solid #182c39;
     margin: 0 auto 35px auto;
     width: 50%;
}
 #testimonials h3 {
     color: #182c39;
     margin: 40px auto;
}
 #testimonials .carousel {
     float: none;
     margin: auto;
}
 #testimonials .carousel-indicators li {
     background-color: #fff;
     border-radius: 50%;
     border: 2px solid #182c39;
     height: 10px;
     width: 10px;
}
 #testimonials .carousel-indicators li.active {
     background-color: #182c39;
     border-color: #fff;
}
 #testimonials .carousel-item h4 {
     font-size: 18px;
     font-weight: 500;
     line-height: 1.2em;
     padding-bottom: 20px;
}
 #testimonials .carousel-item h5 {
     font-size: 15px;
     font-style: italic;
     font-weight: 500;
     margin-bottom: 80px;
}
 #contact .form-group input, #contact .form-group textarea {
     border-radius: 0;
     border: 1px solid #000;
}
 #contact .form-group input:hover, #contact .form-group textarea:hover {
     border-color: #ababee;
     box-shadow: 2px 2px 2px rgba(0,0,0, .2);
}
 #contact .contact-buttons input, #contact .contact-buttons input:focus {
     background-color: #182c39;
     border-radius: 0;
     border: 1px solid #182c39;
     color: #fff;
     cursor: pointer;
     font-weight: 500;
     margin: 20px auto 40px auto;
     padding: 10px;
}
 #contact .contact-buttons input:hover {
     background-color: #fff;
     color: #182c39;
}
 #contact .left-box {
     background-color: #182c39;
     color: #fff;
     font-size: 15px;
     font-weight: 500;
     line-height: 1.8em;
     margin: 0 20px;
     padding: 30px 50px;
     text-transform: none;
}
 #contact .left-box .span-contact {
     color: #ffc266;
     font-size: 17px;
     font-weight: 700;
     padding-right: 20px;
}
 #contact #googleMap {
     -webkit-filter: grayscale(100%);
     filter: grayscale(100%);
}
/* ***** Footer ***** */
 #footer {
     background-color: #182c39;
     color: white;
     font-family: 'Roboto', sans-serif;
}
 #footer ul {
     line-height: 2.2;
     list-style-type: none;
     padding-left: 0;
}
 #footer h5 {
     color: white;
     font-size: 18px;
     margin-bottom: 10px;
     margin-top: 40px;
     text-transform: uppercase;
}
 #footer a {
     color: #aaa;
}
 #footer a:hover, #footer a:focus {
     color: white;
     text-decoration: none;
}
 #footer .social-networks {
     padding-bottom: 25px;
     padding-top: 20px;
}
 #footer .footer-items .fa {
     background-color: white;
     border-radius: 50%;
     color: #182c39;
     font-size: 17px;
     height: 30px;
     line-height: 31px;
     margin-bottom: 5px;
     padding-bottom: 25px;
     text-align: center;
     text-decoration: none;
     transition: color 1s;
     width: 30px;
}
 #footer .footer-items {
     font-size: 15px;
     margin: auto;
     padding-left: 50px;
}
 #footer .fa-facebook:hover, #footer .fa-instagram:hover {
     background-color: #182c39;
     border: 1px solid #fff;
     color: #fff;
}
 .footer-copyright {
     background-color: #10222e;
}
 .footer-copyright p {
     color: #ccc;
     font-size: 15px;
     margin-bottom: 0;
     padding: 10px 0;
     text-align: center;
}
 #footer .hr-foot {
     border: 1px solid #fff;
     margin: 10px auto;
     width: 80%;
}
 #footer .to-top {
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     background-position: center;
     background-repeat: no-repeat;
     background: rgba(0, 0, 0, 0.5);
     border-radius: 50%;
     bottom: 12px;
     color: #fff;
     font-size: 30px;
     height: 40px;
     position: fixed;
     right: 12px;
     text-align: center;
     text-decoration: none;
     width: 40px;
}
 #footer .to-top:hover {
     -moz-transition: all 1s ease;
     -ms-transition: all 1s ease;
     -o-transition: all 1s ease;
     -webkit-transition: all 1s ease;
     background-color: #222;
     color: #fff;
     transition: all 1s ease;
}
    </style>
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
                                            <a class="nav-link" data-toggle="pill" href="#<?= $categoria ?>"><?php echo ucfirst($categoria); ?></a>
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
            <?php foreach ($categorias as $categoria) { ?>
                <div id="<?= $categoria ?>" class="tab-pane fade <?php if ($categoria === 'salgados') echo 'show active'; ?> slide">
                    <div class="row">
                        <?php
                        $categoria_result = getProdutosByCategoria($conexao, $categoria);
                        echo '<div class="col-sm-7">';
                        echo '<ul class="list-group">';
                        while ($user_data = mysqli_fetch_assoc($categoria_result)) {
                            echo '<li class="list-group-item">';
                            echo '<h4 class="list-group-item-heading">' . $user_data['nome'];
                            echo '<span class="badge pull-right">R$' . $user_data['preco'] . '</span>';
                            echo '</h4>';
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                        ?>
                        <div class="col-sm-5">
                            <div class="right-cover">
                                <h3><?php echo ucfirst($categoria); ?></h3>
                                <img src="fotos/<?= $categoria ?>.jpg?v=<?= time() ?>" class="cardapio-img img-fluid" alt="Imagem de <?= $categoria ?>">
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
    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>

</body>


</html>
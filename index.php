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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="js/bibliotecas.js"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Cantina Federal</title>
    <style>
        body {
            overflow-x: hidden;
        }

        section {
            font-family: 'Lato', sans-serif;
            width: 100%;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        ul {
            list-style-type: none;
        }

        a:hover,
        a:focus {
            text-decoration: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            text-transform: none;
            font-weight: 600;
            font-family: 'Lato', sans-serif;
            text-align: center;
        }

        hr {
            border-color: #ffc266;
            border-width: 5px;
            max-width: 100%;
        }

        .container-h1 {
            font-family: 'Lora', serif;
            text-align: center;
            font-size: 50px;
            font-weight: 700;
            margin: 50px auto;
            color: #333;
            font-family: 'Ubuntu', sans-serif;
        }

        .btn {
            color: #fff;
            background-color: #182c39;
            margin: 20px auto;
            border-radius: 0;
            font-weight: 500;
            display: table;
            padding: 10px;
        }

        .btn:hover {
            color: #182c39;
            background-color: transparent;
            border: 1px solid #182c39;
        }

        .hr-h3s {
            border: 3px solid #E94B3C;
            width: 70px;
            margin: 0 auto 35px auto;
        }

        textarea {
            resize: none;
        }

        section {
            align-items: center;
            padding: 50px 60px;
        }

        .bg-section h2 {
            font-family: 'Montserrat', sans-serif;
            text-transform: none;
            color: #ffc266;
            background-color: #182c39;
            margin: 50px 0;
            padding: 25px 20px;
            border-radius: 50px;
        }

        .slideanim {
            visibility: hidden;
        }

        .slide {
            animation-name: slide;
            -webkit-animation-name: slide;
            -moz-animation-name: slide;
            animation-duration: 1.5s;
            -webkit-animation-duration: 1.5s;
            -moz-animation-duration: 1.5s;
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

        .jumbotron {
            margin-bottom: 0px;
            background-image: url('fotos/cantinaentrada.png');
            background-size: cover;
            background-repeat: no-repeat;
            color: white;
            text-shadow: black 0.3em 0.3em 0.3em;
            height: 40%;
            width: auto;
        }

        .jumbotron .header-content-inner {
            font-weight: 700;
            text-transform: none;
            margin-bottom: 0;
            margin: 200px;
            font-family: 'Roboto', sans-serif;
        }

        .jumbotron h1 {
            font-size: 45px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .jumbotron h1 {
                font-size: 45px;
                text-align: left;
            }
        }

        .bg-sobre {
            margin: auto 50px;
            background-color: white;
        }

        #sobre h3 {
            font-family: 'Roboto', sans-serif;
            color: #E94B3C;
        }

        #sobre .restaurant-historia p {
            padding: 20px 80px;
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            color: #444;
        }

        p.first::first-letter {
            font-size: 150%;
            color: #000;
        }

        #sobre h1 {
            padding-top: 35px;
        }

        #sobre .image {
            display: block;
            width: 100%;
            height: auto;
        }

        #sobre .hov-img * {
            box-sizing: border-box;
        }

        #sobre .hov-img {
            position: relative;
            display: inline-block;
            overflow: hidden;
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        #sobre .hov-img img {
            max-width: 100%;
        }

        #sobre .hov-img-bottom {
            display: block;
        }

        #sobre .hov-img-top {
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            -moz-transition: all 0.4s ease-in-out 0s;
            -webkit-transition: all 0.4s ease-in-out 0s;
            -ms-transition: all 0.4s ease-in-out 0s;
            transition: all 0.4s ease-in-out 0s;
        }

        #sobre .hov-img:hover .hov-img-top {
            opacity: 1;
        }

        #sobre .hov-img-text {
            text-align: center;
            font-size: 18px;
            display: inline-block;
            position: absolute;
            text-shadow: black .2em .2em .2em;
            top: 50%;
            left: 50%;
            -moz-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        #sobre .hov-img-text p {
            font-size: 15px;
            line-height: 1.2em;
        }

        #sobre .hov-img-slideup {
            -moz-transform: translateY(100%);
            -webkit-transform: translateY(100%);
            -ms-transform: translateY(100%);
            transform: translateY(100%);
        }

        #sobre .hov-img:hover .hov-img-slideup {
            -moz-transform: translateY(0);
            -webkit-transform: translateY(0);
            -ms-transform: translateY(0);
            transform: translateY(0);
        }

        #galeria h3 {
            font-family: 'Lato', sans-serif;
            text-transform: none;
            color: #182c39;
            margin: 50px auto 10px auto;
            font-weight: 700;
        }

        #galeria .galeria {
            margin: 0px 80px;
        }

        #galeria .no-gutter>[class*="col-"] {
            padding-right: 0;
            padding-left: 0;
        }

        #galeria .caption-content {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            color: #f1f1f1;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        #galeria .portfolio-item:hover .caption-content {
            bottom: 0;
            height: 100%;
        }

        #galeria .caption-content .fa {
            white-space: nowrap;
            color: white;
            font-size: 40px;
            position: absolute;
            overflow: hidden;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        #galeria .mais-img {
            margin: 0 80px;
            background-color: #801300;
        }

        #galeria .mais-img .to-galeria {
            text-align: center;
            text-transform: none;
            color: #fff;
            padding: 10px;
            margin: 0px auto;
        }

        #galeria .mais-img .to-galeria h4 {
            text-transform: none;
            color: #fff;
            padding: 5px;
            margin: auto;
            font-size: 16px;
        }

        #galeria .mais-img .social-networks .fa {
            font-size: 20px;
            margin: 5px 5px;
            color: #fff;
        }

        #galeria .mais-img .social-networks .fa:hover {
            color: #ffc266;
        }

        #staff .thumbnail-row {
            margin: auto 60px;
        }

        #staff h3 {
            font-family: 'Lato', sans-serif;
            text-transform: none;
            color: #182c39;
            margin: 50px auto 10px auto;
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
            box-shadow: 2px 2px 2px 0 rgba(0, 0, 0, 0.9);
            transition: .3s;
        }

        #testimonials .hr-testimonials {
            border: 1px solid #182c39;
            width: 50%;
            margin: 0 auto 35px auto;
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
            border: 2px solid #182c39;
            background-color: #fff;
            height: 10px;
            width: 10px;
            border-radius: 50%;
        }

        #testimonials .carousel-indicators li.active {
            border-color: #fff;
            background-color: #182c39;
        }

        #testimonials .carousel-item h4 {
            font-size: 18px;
            line-height: 1.2em;
            font-weight: 500;
            padding-bottom: 20px;
        }

        #testimonials .carousel-item h5 {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 80px;
            font-style: italic;
        }

        #contato .form-group input,
        #contato .form-group textarea {
            border: 1px solid #000;
            border-radius: 0;
        }

        #contato .form-group input:hover,
        #contato .form-group textarea:hover {
            border-color: #ababee;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, .2);
        }

        #contato .contato-buttons input,
        #contato .contato-buttons input:focus {
            color: #fff;
            background-color: #801300;
            margin: 20px auto 40px auto;
            border-radius: 0;
            font-weight: 500;
            padding: 10px;
            border: 1px solid #5a0e01;
            cursor: pointer;
        }

        #contato .contato-buttons input:hover {
            color: #182c39;
            background-color: #fff;
        }

        #contato .left-box {
            background-color: #801300;
            margin: 0 20px;
            font-size: 15px;
            text-transform: none;
            line-height: 1.8em;
            font-weight: 500;
            padding: 30px 50px;
            color: #fff;
        }

        #contato .left-box .span-contato {
            color: white;
            font-weight: 700;
            padding-right: 20px;
            font-size: 17px;
        }

        #contato #googleMap {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }

        /*---HOME---*/
        /*---FOOTER---*/
        #footer {
            background-color: #801300;
            color: white;
            font-family: 'Roboto', sans-serif;
        }

        #footer ul {
            list-style-type: none;
            padding-left: 0;
            line-height: 2.2;
        }

        #footer h5 {
            font-size: 18px;
            color: white;
            margin-top: 40px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        #footer a {
            color: #aaa;
        }

        #footer a:hover,
        #footer a:focus {
            text-decoration: none;
            color: white;
        }

        #footer .social-networks {
            padding-top: 20px;
            padding-bottom: 25px;
        }

        #footer .footer-items .fa {
            font-size: 17px;
            margin-bottom: 5px;
            background-color: white;
            color: black;
            border-radius: 50%;
            padding-bottom: 25px;
            height: 30px;
            width: 30px;
            text-align: center;
            line-height: 31px;
            text-decoration: none;
            transition: color 1s;
        }

        #footer .footer-items {
            margin: auto;
            padding-left: 70px;
            font-size: 15px;
        }

        #footer .fa-facebook:hover,
        #footer .fa-instagram:hover {
            border: 1px solid #fff;
            color: #fff;
            background-color: lightslategray;
        }

        .footer-copyright {
            background-color: #10222e;
        }

        .footer-copyright p {
            text-align: center;
            color: #ccc;
            font-size: 15px;
            padding: 10px 0;
            margin-bottom: 0;
        }

        #footer .hr-foot {
            width: 80%;
            margin: 10px auto;
            border: 1px solid #fff;
        }

        #footer .to-top {
            color: #fff;
            font-size: 30px;
            position: fixed;
            right: 12px;
            bottom: 12px;
            height: 40px;
            width: 40px;
            text-decoration: none;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            text-align: center;
            background: rgba(0, 0, 0, 0.5);
            background-repeat: no-repeat;
            background-position: center;
        }

        #footer .to-top:hover {
            background-color: #222;
            color: #fff;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -ms-transition: all 1s ease;
            -o-transition: all 1s ease;
            transition: all 1s ease;
        }
    </style>
</head>

<body>
    <header class="header-animation">
        <div class="navigation-wrap bg start-header start-style">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light">

                            <a class="navbar-brand" href="index.php"><img src="fotos/cantinalogo2.png" alt=""></a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="home/cardapio.php">Cardápio</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="home/marmitas.php">Delivery</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="home/login.php">Entrar</a>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="bg-sobre bg-section" id="sobre">
        <div class="container-fluid">
            <h1 class="container-h1">Sobre nós</h1>
            <div class="row">
                <div class="col-sm-5">

                    <div class="hov-img">
                        <img src="fotos/cantina1.png" alt="Mesas" class="hov-img-bottom img-fluid">
                        <div class="hov-img-top hov-img-slideup">
                            <div class="hov-img-text">
                                <h5>Mesas</h5>
                                <p>Nossas mesas foram cuidadosamente dispostas para criar um ambiente acolhedor e
                                    elegante, projetado para acomodar tanto encontros íntimos quanto celebrações
                                    animadas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hov-img">
                        <img src="fotos/cantina2.png" alt="Mesas confortáveis" class="hov-img-bottom img-fluid">
                        <div class="hov-img-top hov-img-slideup">
                            <div class="hov-img-text">
                                <h5>Mesas confortáveis</h5>
                                <p>Mesas confortáveis, estrategicamente posicionadas junto às paredes, para oferecer um
                                    refúgio acolhedor para os apreciadores da boa comida e da boa companhia.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="row ">
                        <div class="restaurant-historia slideanim text-center">
                            <h3 class="section-heading">Cantina Federal</h3>
                            <p class="sobre-historia first">Bem-vindo à Cantina Federal, um local onde tradição e
                                inovação se unem para proporcionar uma experiência gastronômica única e memorável.
                                Localizada no cidade de Sombrio-SC, a Cantina Federal é muito mais do que um simples
                                restaurante ou lanchonete - é um espaço onde os sabores autênticos se entrelaçam com
                                um ambiente acolhedor, criando momentos especiais para nossos clientes.</br>
                                Nosso cardápio é uma celebração dos sabores que atravessam gerações. Desde clássicos
                                reconfortantes, como hambúrgueres artesanais e batatas fritas crocantes, até pratos
                                regionais que honram as raízes culinárias do nosso país, oferecemos uma ampla variedade
                                de opções para agradar a todos os paladares. Utilizamos ingredientes locais sempre que
                                possível, mantendo o compromisso com a qualidade e o frescor.</p>
                            <button type="button" class="btn mais" id="mais" data-toggle="collapse"
                                data-target="#demo">Mais</button>
                            <div id="demo" class="collapse">
                                <p class="sobre-historia">Ao entrar na Cantina Federal, você é recebido por uma
                                    atmosfera acolhedora e amigável. Nossa decoração combina elementos rústicos com
                                    toques modernos, refletindo a essência da nossa cozinha. Seja para um almoço rápido,
                                    um jantar relaxante ou um encontro descontraído com amigos, nosso ambiente é o
                                    cenário perfeito.</br>
                                    A Cantina Federal não é apenas um local de refeições, mas também um membro ativo da
                                    comunidade. Acreditamos em retribuir e colaborar com aqueles que nos rodeiam.
                                    Participamos de iniciativas locais, apoiamos eventos beneficentes e trabalhamos para
                                    minimizar nosso impacto ambiental, adotando práticas sustentáveis sempre que
                                    possível.</br>
                                    Nossa equipe é o coração da Cantina Federal. Cada membro é escolhido não apenas por
                                    suas habilidades, mas também por sua paixão pela culinária e pelo atendimento
                                    excepcional. Estamos dedicados a proporcionar um serviço amigável e eficiente,
                                    garantindo que cada visita seja uma experiência memorável.</br>
                                    Na Cantina Federal, convidamos você a se juntar a nós em uma jornada culinária que
                                    homenageia o passado enquanto abraça o futuro. Seja para uma refeição rápida ou um
                                    banquete reconfortante, estamos aqui para oferecer um lugar onde os sabores se
                                    transformam em lembranças duradouras.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section id="galeria" class="bg-galeria no-padding">
        <div class="container-fluid">
            <h3>Galeria</h3>
            <hr class="hr-h3s">
            <div class="row no-gutter galeria slideanim">

                <div class="col-sm-4 portfolio-item">
                    <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-instagram fa-3x"></i>
                            </div>
                        </div>
                        <img src="fotos/cantina3.png" class="img-fluid
                        " alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-instagram fa-3x"></i>
                            </div>
                        </div>
                        <img src="fotos/cantina4.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-instagram fa-3x"></i>
                            </div>
                        </div>
                        <img src="fotos/cantina5.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-instagram fa-3x"></i>
                            </div>
                        </div>
                        <img src="fotos/cantina6.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-instagram fa-3x"></i>
                            </div>
                        </div>
                        <img src="fotos/cantina7.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-instagram fa-3x"></i>
                            </div>
                        </div>
                        <img src="fotos/cantina8.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
            <div class="row mais-img">

                <div class="to-galeria">
                    <h4>Para mais fotos visite-nos em</h4>
                    <div class="social-networks">
                        <a href="https://www.instagram.com/cantina_federal/" target="_blank" class="instagram"><i
                                class="fa fa-instagram"></i></a>
                        <a href="https://www.facebook.com/cantinafederal?mibextid=ZbWKwL" target="_blank"
                            class="instagram"><i class="fa fa-facebook"></i></a>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <section class="bg-contato bg-section" id="contato">
        <div class="container-fluid">
            <h1 class="container-h1">Entre em contato</h1>
            <div class="row slideanim">
                <div class="col-md-6 col-sm-6 contato-left">
                    <div class="left-box">
                        <address class="contato">
                            <span class="span-contato">Telefone:</span>
                            <br>
                            <a href="https://api.whatsapp.com/send/?phone=5548998228233&text&type=phone_number&app_absent=0"
                                style="text-decoration: none; color: white;">+55 (48) 99822-8233</a>
                            <br>
                            <span class="span-contato">Email:</span>
                            <br>
                            joseartur@hotmail.com
                            <br>
                            <span class="span-contato">Localização:</span>
                            <br>
                            Bairro Januária
                            <br>
                            Sombrio, Santa Catarina
                            <br>
                            <a href="https://maps.app.goo.gl/8mKSrc17zimr1EoXAy"
                                style="text-decoration: none; color: white; font-weight: bold; font-size: 16px;">Google
                                Maps Aqui</a>
                        </address>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 contato-right">

                    <form novalidate action="mailto:joseartur@hotmail.com" name="frm" method="post">
                        <div class="form-group has-feedback">
                            <label class="sr-only">Nome:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome" required>

                        </div>
                        <div class="form-group has-feedback">
                            <label class="sr-only">Sobrenome:</label>
                            <input type="text" name="surname" class="form-control" placeholder="Sobrenome" required>

                        </div>
                        <div class="form-group has-feedback">
                            <label class="sr-only">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>

                        </div>
                        <div class="form-group">
                            <label class="sr-only" name="comentario" for="comentario">Comentário:</label>
                            <textarea class="form-control" rows="5" id="comentario"
                                placeholder="Deseja comentar algo?"></textarea>
                        </div>
                        <div class="contato-buttons pull-left">
                            <input type="submit" name="submit" value="Enviar" />
                            <input type="reset" value="Apagar" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <footer class="-bg-footer" id="footer">
        <div class="container-fluid">
            <div class="row footer-align">
                <div class="col-md-6 col-sm-6">
                    <h5>Nosso Contato</h5>
                    <hr class="hr-foot">
                    <div class="footer-items">
                        <address>
                            Bairro Januária
                            <br>
                            Sombrio, Santa Catarina
                            <br>
                            Brasil
                            <br>
                            <i class="fa fa-phone address"></i> <a
                                href="https://api.whatsapp.com/send/?phone=5548998228233&text&type=phone_number&app_absent=0">+55
                                (48) 99822-8233</a>
                            <br>
                            <i class="fa fa-envelope address"></i> <a
                                href="mailto:joseartur@hotmail.com">joseartur@hotmail.com</a>
                        </address>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h5>Aberto</h5>
                    <hr class="hr-foot">
                    <div class="footer-items">
                        <ul>
                            <li>Seg-Sex: 07:30-18:30</li>
                            <li>Sábado: FECHADOS</li>
                            <li>Domingo: FECHADOS</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <a class="to-top" href="#myPage" title="toTop">
            <i class="fa fa-chevron-up"></i>
        </a>
    </footer>
    <script type="text/javascript" src="js/home.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
</body>

</html>
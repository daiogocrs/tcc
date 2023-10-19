<?php
$mensagemPedido = '';

if (isset($_POST['submit'])) {
    include('../config.php');

    function limparDados($conexao, $dados)
    {
        $dados = trim($dados);
        $dados = mysqli_real_escape_string($conexao, $dados);
        return $dados;
    }

    $tamanho = limparDados($conexao, $_POST['tamanho']);
    $comidas = isset($_POST['comida']) ? implode(', ', array_map([$conexao, 'real_escape_string'], $_POST['comida'])) : '';

    $query = "INSERT INTO pedidos (tamanho, comidas) VALUES (?, ?)";

    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "ss", $tamanho, $comidas);

    if (mysqli_stmt_execute($stmt)) {
        $mensagemPedido = 'Seu pedido foi feito!';
    } else {
        $mensagemPedido = 'Erro ao inserir pedido: ' . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
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
    <link rel="stylesheet" type="text/css" href="../css/">
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Tela de Pedido de Marmitas</title>
    <style>
        /*---HEADER---*/
        @import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');
        header{
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            line-height: 24px;
            font-weight: 400;
            color: #212112;
            transition: all 200ms linear;
        }
        header ::selection {
            color: #fff;
            background-color: #8167a9;
        }
        header ::-moz-selection {
            color: #fff;
            background-color: #8167a9;
        }
        header .start-header {
            opacity: 1;
            transform: translateY(0);
            padding: 20px 0;
            box-shadow: 0 10px 30px 0 rgba(138, 155, 165, 0.15);
            -webkit-transition : all 0.3s ease-out;
            transition : all 0.3s ease-out;
        }
        header .start-header.scroll-on {
            box-shadow: 0 5px 10px 0 rgba(138, 155, 165, 0.15);
            padding: 10px 0;
            -webkit-transition : all 0.3s ease-out;
            transition : all 0.3s ease-out;
        }
        header .start-header.scroll-on .navbar-brand img{
            height: 24px;
            -webkit-transition : all 0.3s ease-out;
            transition : all 0.3s ease-out;
        }
        header .navigation-wrap{
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            -webkit-transition : all 0.3s ease-out;
            transition : all 0.3s ease-out;
        }
        header .navbar{
            padding: 0;
        }
        header .navbar-brand img{
            height: 50px;
            width: auto;
            display: block;
            -webkit-transition : all 0.3s ease-out;
            transition : all 0.3s ease-out;
        }
        header .navbar-toggler {
            float: right;
            border: none;
            padding-right: 0;
        }
        header .navbar-toggler:active, .navbar-toggler:focus {
            outline: none;
        }
        header .navbar-light .navbar-toggler-icon {
            width: 24px;
            height: 17px;
            background-image: none;
            position: relative;
            border-bottom: 1px solid #000;
            transition: all 300ms linear;
        }
        header .navbar-light .navbar-toggler-icon:after, .navbar-light .navbar-toggler-icon:before{
            width: 24px;
            position: absolute;
            height: 1px;
            background-color: #000;
            top: 0;
            left: 0;
            content: '';
            z-index: 2;
            transition: all 300ms linear;
        }
        header .navbar-light .navbar-toggler-icon:after{
            top: 8px;
        }
        header .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon:after {
            transform: rotate(45deg);
        }
        header .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon:before {
            transform: translateY(8px) rotate(-45deg);
        }
        header .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            border-color: transparent;
        }
        header .nav-link{
            color: white !important;
            font-weight: 500;
            transition: all 200ms linear;
        }
        header .nav-item:hover .nav-link{
            color: #8167a9 !important;
        }
        header .nav-item.active .nav-link{
            color: #afafaf !important;
        }
        header .nav-link {
            position: relative;
            padding: 5px 0 !important;
            display: inline-block;
        }
        header .nav-item:after{
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            content: '';
            background-color: #8167a9;
            opacity: 0;
            transition: all 200ms linear;
        }
        header .nav-item:hover:after{
            bottom: 0;
            opacity: 1;
        }
        header .nav-item.active:hover:after{
            opacity: 0;
        }
        header .nav-item{
            position: relative;
            transition: all 200ms linear;
        }
        header .bg {
            background-color: #801300 !important;
            transition: all 200ms linear;
        }
        header .section {
            position: relative;
            width: 100%;
            display: block;
        }
        header .full-height {
            height: 100vh;
        }
        header .over-hide {
            overflow: hidden;
        }
        header .absolute-center {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            margin-top: 40px;
            transform: translateY(-50%);
            z-index: 20;
        }
        header h1{
            font-size: 48px;
            line-height: 1.2;
            font-weight: 700;
            color: #212112;
            text-align: center;
        }
        header p{
            text-align: center;
            margin: 0;
            padding-top: 10px;
            opacity: 1;
            transform: translate(0);
            transition: all 300ms linear;
            transition-delay: 1700ms;
        }
        header .header-animation p{
            opacity: 0;
            transform: translateY(40px);
            transition-delay: 1700ms;
        }
        header h1 span{
            display: inline-block;
            transition: all 300ms linear;
            opacity: 1;
            transform: translate(0);
        }
        header.header-animation h1 span:nth-child(1){
            opacity: 0;
            transform: translateY(-20px);
        }
        header.header-animation h1 span:nth-child(2){
            opacity: 0;
            transform: translateY(-30px);
        }
        header.header-animation h1 span:nth-child(3){
            opacity: 0;
            transform: translateY(-50px);
        }
        header.header-animation h1 span:nth-child(4){
            opacity: 0;
            transform: translateY(-10px);
        }
        header.header-animation h1 span:nth-child(5){
            opacity: 0;
            transform: translateY(-50px);
        }
        header.header-animation h1 span:nth-child(6){
            opacity: 0;
            transform: translateY(-20px);
        }
        header.header-animation h1 span:nth-child(7){
            opacity: 0;
            transform: translateY(-40px);
        }
        header.header-animation h1 span:nth-child(8){
            opacity: 0;
            transform: translateY(-10px);
        }
        header.header-animation h1 span:nth-child(9){
            opacity: 0;
            transform: translateY(-30px);
        }
        header.header-animation h1 span:nth-child(10){
            opacity: 0;
            transform: translateY(-20px);
        }
        header h1 span:nth-child(1){
            transition-delay: 1000ms;
        }
        header h1 span:nth-child(2){
            transition-delay: 700ms;
        }
        header h1 span:nth-child(3){
            transition-delay: 900ms;
        }
        header h1 span:nth-child(4){
            transition-delay: 800ms;
        }
        header h1 span:nth-child(5){
            transition-delay: 1000ms;
        }
        header h1 span:nth-child(6){
            transition-delay: 700ms;
        }
        header h1 span:nth-child(7){
            transition-delay: 900ms;
        }
        header h1 span:nth-child(8){
            transition-delay: 800ms;
        }
        header h1 span:nth-child(9){
            transition-delay: 600ms;
        }
        header h1 span:nth-child(10){
            transition-delay: 700ms;
        }
        header.header-animation h1 span:nth-child(11){
            opacity: 0;
            transform: translateY(30px);
        }
        header.header-animation h1 span:nth-child(12){
            opacity: 0;
            transform: translateY(50px);
        }
        header.header-animation h1 span:nth-child(13){
            opacity: 0;
            transform: translateY(20px);
        }
        header.header-animation h1 span:nth-child(14){
            opacity: 0;
            transform: translateY(30px);
        }
        header.header-animation h1 span:nth-child(15){
            opacity: 0;
            transform: translateY(50px);
        }
        header h1 span:nth-child(11){
            transition-delay: 1300ms;
        }
        header h1 span:nth-child(12){
            transition-delay: 1500ms;
        }
        header h1 span:nth-child(13){
            transition-delay: 1400ms;
        }
        header h1 span:nth-child(14){
            transition-delay: 1200ms;
        }
        header h1 span:nth-child(15){
            transition-delay: 1450ms;
        }
        header .nav-item .dropdown-menu {
            transform: translate3d(0, 10px, 0);
            visibility: hidden;
            opacity: 0;
            max-height: 0;
            display: block;
            padding: 0;
            margin: 0;
            transition: all 200ms linear;
        }
        header .nav-item.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            max-height: 999px;
            transform: translate3d(0, 0px, 0);
        }
        header .dropdown-menu {
            padding: 10px!important;
            margin: 0;
            font-size: 13px;
            letter-spacing: 1px;
            color: #212121;
            background-color: #fcfaff;
            border: none;
            border-radius: 3px;
            box-shadow: 0 5px 10px 0 rgba(138, 155, 165, 0.15);
            transition: all 200ms linear;
        }
        header .dropdown-toggle::after {
            display: none;
        }

        header .dropdown-item {
            padding: 3px 15px;
            color: #212121;
            border-radius: 2px;
            transition: all 200ms linear;
        }
        header .dropdown-item:hover, 
        header .dropdown-item:focus {
            color: #fff;
            background-color: rgba(129,103,169,.6);
        }
        @media (max-width: 767px) {
            header h1{
                font-size: 38px;
        }
            header .nav-item:after{
                display: none;
        }
            header .nav-item::before {
                position: absolute;
                display: block;
                top: 15px;
                left: 0;
                width: 11px;
                height: 1px;
                content: "";
                border: none;
                background-color: #000;
                vertical-align: 0;
        }
        }
        /*---HEADER---*/
        /*---PEDIDOS---*/
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300);
        div .form-wrap * {
            margin: 0;
            padding: 0;
        }
        .form-wrap a {
            color: #666;
            text-decoration: none;
        }
        .form-wrap a:hover {
            color: #4FDA8C;
        }
        input {
            font: 16px/26px "Raleway", sans-serif;
        }
        .form-wrap{
            background-color: #f1f2f2;
            color: #666;
            font: 16px/26px "Raleway", sans-serif;
        }
        .form-wrap {
            -moz-box-shadow: 0px 1px 8px #BEBEBE;
            -webkit-box-shadow: 0px 1px 8px #BEBEBE;
            background-color: #fff;
            box-shadow: 0px 1px 8px #BEBEBE;
            margin: 8em auto;
            width: 320px;
        }
        .form-wrap .tabs {
            overflow: hidden;
        }
        .form-wrap .tabs h3 a {
            background-color: #e6e7e8;
            color: #666;
            display: block;
            font-weight: 400;
            padding: 0.5em 0;
            text-align: center;
        }
        .form-wrap .tabs-content {
            padding: 1.5em;
        }
        .form-wrap .tabs-content div[id$="tab-content"] {
            display: none;
        }
        .form-wrap .tabs-content .active {
            display: block !important;
        }
        .form-wrap form .input#user_tamanho {
            -moz-box-sizing: border-box;
            border: 1px solid #CFCFCF;
            box-sizing: border-box;
            color: inherit;
            display: inline-block;
            font-family: inherit;
            width: 100%;
        }
        .form-wrap form .input {
            margin: 0 0 .8em 0;
            outline: 0;
            padding-right: 2em;
            padding: .8em 0 10px .8em;
        }
        .form-wrap form .button {
            background-color: #801300;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: .8em 0 10px .8em;
            text-transform: uppercase;
            width: 100%;
        }
        .form-wrap form .button:hover {
            background-color: #4FDA8C;
        }
        .form-wrap form label[for] {
            cursor: pointer;
            padding-left: 20px;
            position: relative;
        }
        .form-wrap form label[for]:before {
            border: 1px solid #CFCFCF;
            content: '';
            height: 17px;
            left: -14px;
            position: absolute;
            top: 0px;
            width: 17px;
        }
        .form-wrap form label[for]:after {
            -moz-transform: rotate(-45deg);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
            background-color: transparent;
            border-right: none;
            border-top: none;
            border: 3px solid #28A55F;
            content: '';
            filter: alpha(opacity=0);
            height: 5px;
            left: -10px;
            opacity: 0;
            position: absolute;
            top: 4px;
            transform: rotate(-45deg);
            width: 9px;
        }
        .form-wrap .help-text {
            margin-top: .6em;
        }
        .form-wrap .help-text p {
            font-size: 14px;
            text-align: center;
        }
        .form-wrap nav ul {
            list-style-type: none;
            margin: 0 2% auto 0;
            max-width: 100%;
            padding-left: 0;
            text-align: right;
        }
        .form-wrap nav ul li {
            display: inline-block;
            line-height: 60px;
            margin-left: 10px;
        }
        .form-wrap nav ul li a {
            color: black;
            font-size: large;
            text-decoration: none;
        }
        .marmitas-options {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
        }
        .marmita-option {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
            width: 30%; 
        }
        .marmita-option:hover {
            background-color: #f0f0f0;
        }
        .marmita-content {
            display: block;
        }
        .marmita-title {
            font-size: 16px;
            font-weight: bold;
        }
        .marmita-price {
            font-size: 14px;
        }
        .marmita-option label {
            list-style-type: none;
        }
        .marmita-option label::before {
            display: none;
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

                            <a class="navbar-brand" href="../index.php"><img src="../fotos/cantinalogo2.png" alt=""></a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="../index.php">Home</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="cardapio.php">Cardápio</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                        <a class="nav-link" href="marmitas.php">Delivery</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="login.php">Entrar</a>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="form-wrap">
        <div class="tabs">
            <h3 class="signup-tab"><a>Faça seu Pedido</a></h3>
        </div>
        <div class="tabs-content">
            <div id="signup-tab-content" class="active">
                <form class="form_cadastro" action="marmitas.php" method="POST">
                    <div class="marmitas-options">
                        <label class="marmita-option">
                            <input type="radio" name="tamanho" value="pequena" id="tamanho-pequena">
                            <div class="marmita-content">
                                <span class="marmita-title">Marmita Pequena</span>
                                <span class="marmita-price">R$10</span>
                            </div>
                        </label>
                        <label class="marmita-option">
                            <input type="radio" name="tamanho" value="media" id="tamanho-media">
                            <div class="marmita-content">
                                <span class="marmita-title">Marmita Média</span>
                                <span class="marmita-price">R$15</span>
                            </div>
                        </label>
                        <label class="marmita-option">
                            <input type="radio" name="tamanho" value="grande" id="tamanho-grande">
                            <div class="marmita-content">
                                <span class="marmita-title">Marmita Grande</span>
                                <span class="marmita-price">R$20</span>
                            </div>
                        </label>
                    </div>
                    <div class="comidas-options" style="display: none;">
                        <label>Escolha suas comidas:</label>
                        <input type="checkbox" class="input" name="comida[]" value="arroz"> Arroz <br>
                        <input type="checkbox" class="input" name="comida[]" value="arroz temperado"> Arroz Temperado <br>
                        <input type="checkbox" class="input" name="comida[]" value="macarrao"> Macarrão <br>
                        <input type="checkbox" class="input" name="comida[]" value="tomate"> Tomate <br>
                        <input type="checkbox" class="input" name="comida[]" value="alface"> Alface <br>
                        <input type="checkbox" class="input" name="comida[]" value="pepino"> Pepino <br>
                        <input type="checkbox" class="input" name="comida[]" value="batata frita"> Batata Frita <br>
                        <input type="checkbox" class="input" name="comida[]" value="maionese"> Maionese <br>
                        <input type="checkbox" class="input" name="comida[]" value="batata palha"> Batata Palha <br>
                        <input type="checkbox" class="input" name="comida[]" value="farofa"> Farofa <br>
                        <select class="input" id="user_tamanho" autocomplete="off" name="carne" required>
                            <option value="" disabled selected>Selecione a Carne</option>
                            <option value="nenhuma">Nenhuma</option>
                            <option value="frango">Frango</option>
                            <option value="salsichao">Salsichao</option>
                            <option value="porco">Porco</option>
                        </select>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <label>Localização:</label>
                        <span id="localizacaoSpan"></span>
                        <input type="button" onclick="obterLocalizacao()" class="button" value="Obter Localização">
                        <input type="submit" class="button" name="submit" id="submit" value="Enviar Pedido">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/header.js"></script>
    <script>
        const tamanhoOptions = document.querySelectorAll('input[name="tamanho"]');
        const comidasOptions = document.querySelector('.comidas-options');
        
        tamanhoOptions.forEach((option) => {
            option.addEventListener("change", () => {
                if (option.checked) {
                    document.querySelector('.marmitas-options').style.display = 'none';
                    comidasOptions.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
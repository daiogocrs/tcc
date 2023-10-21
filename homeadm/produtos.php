<?php
    session_start();
    include('../config.php');
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['nivel_acesso']) == 'adm'))
    {
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

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM usuarios WHERE id_usuarios LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id_usuarios DESC";
    }
    else
    {
        $sql = "SELECT * FROM usuarios ORDER BY id_usuarios DESC";
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
    <script type="text/javascript" src="../js/bibliotecas.js"></script>
    <title>Cantina Federal</title>
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
/*---HOME---*/
section {
	overflow-x: hidden;
	font-family: 'Lato', sans-serif;
	width: 100%;
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
.btn:hover{
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
	background-image: url('../fotos/cantinaentrada.png');
	background-position: 0% 25%;
	background-size: cover;
	background-repeat: no-repeat;
	color: white;
	text-shadow: black 0.3em 0.3em 0.3em;
	height: 700px;
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
}
.jumbotron h3 {
	font-size: 25px;
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
#galeria .no-gutter > [class*="col-"] {
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
	box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.9);
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
#contato .form-group input, #contato .form-group textarea {
	border: 1px solid #000;
	border-radius: 0;
}
#contato .form-group input:hover, #contato .form-group textarea:hover {
	border-color: #ababee;
	box-shadow: 2px 2px 2px rgba(0,0,0, .2);
}
#contato .contato-buttons input, #contato .contato-buttons input:focus {
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
#footer a:hover, #footer a:focus {
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
	padding-left: 50px;
	font-size: 15px;
}
#footer .fa-facebook:hover, #footer .fa-instagram:hover {
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

                            <a class="navbar-brand" href="homeadm.php"><img src="../fotos/cantinalogo2.png" alt=""></a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="homeadm.php">Home</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="cardapioadm.php">Cardápio</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="marmitasadm.php">Delivery</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                        <a class="nav-link" href="produtos.php">Produtos</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Conta</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="../sair.php">Sair</a>
                                        </div>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section style="text-align: center;">
        <h1 class="container-h1" style="margin-top: 80px;">Produtos</h1>
        <a href="cadastroprodutos.php" style="margin-top: 80px;">
            <button id="botao1"
                style="color: #fff; background-color: #801300; margin: 20px auto 40px auto; border-radius: 0; font-weight: 500; padding: 10px; border: 1px solid #5a0e01; cursor: pointer;">Cadastrar
                Produtos</button>
        </a>
    </section>
    <section>
    <h2>Produtos Disponíveis</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
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
                    echo "<td>" . $user_data['id_produtos'] . "</td>";
                    echo "<td>" . $user_data['nome'] . "</td>";
                    echo "<td>" . $user_data['preco'] . "</td>";
                    echo "<td>" . $user_data['categoria'] . "</td>";
                    echo "<td>
                        <a class='btn btn-sm btn-primary' href='editprodutos.php?id_produtos=$user_data[id_produtos]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                            </a> 
                            <a class='btn btn-sm btn-danger' href='deleteprodutos.php?id_produtos=$user_data[id_produtos]' title='Deletar'>
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
</section>


    <script type="text/javascript" src="../js/home.js"></script>
    <script type="text/javascript" src="../js/header.js"></script>
</body>

</html>
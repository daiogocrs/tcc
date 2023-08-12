<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,senha,email,cidade,bairro,rua) 
        VALUES ('$nome','$senha','$email','$cidade','$bairro','$rua')");

        header('Location: login.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<title>Tela de Cadastro</title>
    
</head>

<body>

<header>
		<a href="home.php"><img src="fotos/cantinalogo2.png" alt="logo cantina Federal"></a>
		<nav>
			<ul>
				<li><a href="home.php">Voltar</a></li>
			<ul>
		</nav>
	</header>

	<div class="form-wrap">
		<div class="tabs">
			<h3 class="signup-tab"><a>Cadastre-se</a></h3>
		</div>
		<div class="tabs-content">
			<div id="signup-tab-content" class="active">
				<form class="form_cadastro" action="cadastro.php" method="POST">
					<input type="text" class="input" id="user_nome" autocomplete="off" placeholder="Nome" name="nome" required>
					<input type="email" class="input" id="user_email" autocomplete="off" placeholder="Email" name="email" required>
					<input type="text" class="input" id="user_cidade" autocomplete="off" placeholder="Cidade" name="cidade" required>
					<input type="text" class="input" id="user_bairro" autocomplete="off" placeholder="Bairro" name="bairro" required>
					<input type="text" class="input" id="user_rua" autocomplete="off" placeholder="Rua" name="rua" required>
					<input type="password" class="input" id="user_senha" autocomplete="off" placeholder="Senha" name="senha" required>
					<input type="submit" class="button" name="submit" id="submit" value="Cadastrar">
				</form>
				<div class="help-text">
					<p>Já possui uma conta?</p>
					<p><a href="login.php">Entre aqui</a></p>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
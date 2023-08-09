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
	<title>Tela de login</title>
    
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
			<h3 class="signup-tab"><a>Logar</a></h3>
		</div>
		<div class="tabs-content">
			<div id="signup-tab-content" class="active">
				<form class="form_cadastro" action="testLogin.php" method="POST">
					<input type="email" class="input" id="user_email" autocomplete="off" placeholder="Email" name="email" required>
					<input type="password" class="input" id="user_senha" autocomplete="off" placeholder="Senha" name="senha" required>
					<input type="submit" class="button" name="submit" value="Entrar">
				</form>
				<div class="help-text">
					<p>Não possui uma conta ainda?</p>
					<p><a href="cadastro.php">Cadastrar</a></p>
				</div>
			</div>
		</div>
</body>

</html>
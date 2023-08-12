<?php

if (isset($_POST['submit'])) {
	include_once('config.php');

	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$categoria = $_POST['categoria'];

	$result = mysqli_query($conexao, "INSERT INTO produtos(nome,preco,categoria) 
        VALUES ('$nome','$preco','$categoria')");

	header('Location: cadastroprodutos.php');
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
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"></script>
	<title>Tela de Cadastro de Produtos</title>

</head>

<body>

	<header>
		<a href="homeadm.php"><img src="fotos/cantinalogo2.png" alt="logo cantina Federal"></a>
		<nav>
			<ul>
				<li><a href="produtos.php">Voltar</a></li>
				<ul>
		</nav>
	</header>

	<div class="form-wrap">
		<div class="tabs">
			<h3 class="signup-tab"><a>Cadastre seu Produto</a></h3>
		</div>
		<div class="tabs-content">
			<div id="signup-tab-content" class="active">
				<form class="form_cadastro" action="cadastroprodutos.php" method="POST">
					<input type="text" class="input" id="user_nome" autocomplete="off" placeholder="Nome" name="nome"
						required>
					<input type="text" class="input" id="user_preco" autocomplete="off" placeholder="Preço" name="preco"
						required>
					<input type="text" class="input" id="user_categoria" autocomplete="off" placeholder="Categoria"
						name="categoria" required>
					<input type="submit" class="button" name="submit" id="submit" value="Cadastrar">
				</form>
			</div>
		</div>
	</div>
</body>

</html>
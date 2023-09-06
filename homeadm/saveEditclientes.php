<?php
    include('../config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];
        
        $sqlInsert = "UPDATE usuarios 
        SET nome='$nome',senha='$senha',email='$email',cidade='$cidade',bairro='$bairro',rua='$rua'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: sistemaclientes.php');

?>
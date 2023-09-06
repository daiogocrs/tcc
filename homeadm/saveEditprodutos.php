<?php
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        
        $sqlInsert = "UPDATE produtos
        SET nome='$nome',preco='$preco',categoria='$categoria'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: sistemaprodutos.php');

?>
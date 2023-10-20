<?php
    include('../config.php');
    if(isset($_POST['update']))
    {
        $id_produtos = $_POST['id_produtos'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        
        $sqlInsert = "UPDATE produtos
        SET nome='$nome',preco='$preco',categoria='$categoria'
        WHERE id_produtos=$id_produtos";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: sistemaprodutos.php');

?>
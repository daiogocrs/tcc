<?php
    include('../config.php');
    if(isset($_POST['update']))
    {
        $id_marmita = $_POST['id_marmita'];
        $tamanho = $_POST['tamanho'];
        $preco = $_POST['preco'];
        
        $sqlInsert = "UPDATE precos_marmitas
        SET tamanho='$tamanho',preco='$preco'
        WHERE id_marmita=$id_marmita";
        $result = $conexao->query($sqlInsert);
    }
    header('Location: tamanho.php');

?>
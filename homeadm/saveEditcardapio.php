<?php
    include('../config.php');
    if(isset($_POST['update']))
    {
        $id_cardapio = $_POST['id_cardapio'];
        $comidas = $_POST['comidas'];
        $sobremesa = $_POST['sobremesa'];
        $dia_semana = $_POST['dia_semana'];
        
        $sqlInsert = "UPDATE cardapio
        SET comidas='$comidas',sobremesa='$sobremesa',dia_semana='$dia_semana'
        WHERE id_cardapio=$id_cardapio";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: cardapioadm.php');

?>
<?php

    if(!empty($_GET['id_cardapio']))
    {
        include('../config.php');

        $id_cardapio = $_GET['id_cardapio'];

        $sqlSelect = "SELECT *  FROM cardapio WHERE id_cardapio=$id_cardapio";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM cardapio WHERE id_cardapio=$id_cardapio";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: cardapioadm.php');
   
?>
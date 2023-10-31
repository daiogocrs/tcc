<?php

    if(!empty($_GET['id_marmita']))
    {
        include('../config.php');

        $id_marmita = $_GET['id_marmita'];

        $sqlSelect = "SELECT *  FROM precos_marmitas WHERE id_marmita=$id_marmita";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM precos_marmitas WHERE id_marmita=$id_marmita";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: tamanho.php');
   
?>
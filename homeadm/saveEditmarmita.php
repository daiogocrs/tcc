<?php
include('../config.php');
if(isset($_POST['update']))
{
    $id_marmita = $_POST['id_marmita'];
    $tamanho = $_POST['tamanho']; 
    $preco = $_POST['preco'];

    $sqlUpdate = "UPDATE precos_marmitas SET tamanho=?, preco=? WHERE id_marmita=?";
    $stmt = $conexao->prepare($sqlUpdate);
    if ($stmt) {
        $stmt->bind_param("sdi", $tamanho, $preco, $id_marmita);
        if ($stmt->execute()) {
            $stmt->close();
        } else {
            echo "Erro na atualização: " . $conexao->error;
        }
    } else {
        echo "Erro na preparação da declaração: " . $conexao->error;
    }
}
header('Location: tamanho.php');
?>

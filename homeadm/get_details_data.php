<?php
include('../config.php');

if (isset($_GET['id'])) {
    $pedidoID = $_GET['id'];
    $sql = "SELECT tamanho, bebidas, retirar_algo FROM pedidos WHERE id_pedidos = $pedidoID";
    $result = $conexao->query($sql);
    $detailsData = mysqli_fetch_assoc($result);

    echo json_encode($detailsData);
}
?>

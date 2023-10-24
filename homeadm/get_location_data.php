<?php
include('../config.php');

if (isset($_GET['id'])) {
    $pedidoID = $_GET['id'];
    $sql = "SELECT cidade, bairro, rua, numero, complemento FROM pedidos WHERE id_pedidos = $pedidoID";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
?>

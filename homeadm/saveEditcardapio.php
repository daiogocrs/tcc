<?php
include('../config.php');
if(isset($_POST['update']))
{
    $id_cardapio = $_POST['id_cardapio'];
    $comidas = ucwords($_POST['comidas']); 
    $sobremesa = ucwords($_POST['sobremesa']); 
    $dia_semana = $_POST['dia_semana'];

    $sqlUpdate = "UPDATE cardapio SET comidas=?, sobremesa=?, dia_semana=? WHERE id_cardapio=?";
    $stmt = $conexao->prepare($sqlUpdate);
    if ($stmt) {
        $stmt->bind_param("sssi", $comidas, $sobremesa, $dia_semana, $id_cardapio);
        if ($stmt->execute()) {
            $stmt->close();
        } else {
            echo "Erro na atualização: " . $conexao->error;
        }
    } else {
        echo "Erro na preparação da declaração: " . $conexao->error;
    }
}
header('Location: cardapioadm.php');
?>

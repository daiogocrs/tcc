<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($row['nivel_acesso'] == 'adm') {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: homeadm.php');
        } else {
            header('Location: homelogado.php');
        }
    }
} else {
    header('Location: login.php');
}
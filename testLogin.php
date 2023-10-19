<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: home/login.php');
    } else {
        $row = $result->fetch_assoc();
        if ($row['nivel_acesso'] == 'adm') {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: homeadm/homeadm.php');
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: home/login.php');
        }
    }
} else {
    header('Location: home/login.php');
}

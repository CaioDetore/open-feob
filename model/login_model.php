<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['email_usuario']) && !empty($_POST['senha']))
    {
        // Acessa
        include_once('conexao.php');
        $email = $_POST['email_usuario'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuario WHERE email_usuario = '$email' and senha = '$senha'";        

        $result = $conn->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['email_usuario']);
            unset($_SESSION['senha']);
            $_SESSION["errologin"] = "Usuário ou Senha Inválido";
            header('Location: ../view/login.php');
        }
        else
        {
            $_SESSION['email_usuario'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: ../view/perfil.php');
        }
    }
    else
    {
        // Não acessa
        header('Location: ../view/login.php');
    }
?>
<?php
    session_start();
        if((!isset($_SESSION['email_usuario']) == true) and (!isset($_SESSION['senha']) == true))
        {
            unset($_SESSION['email_usuario']);
            unset($_SESSION['senha']);
            $_SESSION['nologin'] = 'Necessário uma conta';
            header('Location: login.php');
        }
        
        $email = $_SESSION['email_usuario'];

        $RES=mysqli_query($conn, "select * from usuario where email_usuario ='$email'");
        $PERFIL=mysqli_fetch_array($RES, MYSQLI_NUM); 
?>
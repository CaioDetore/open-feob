<?php
    session_start();
    unset($_SESSION['email_usuario']);
    unset($_SESSION['senha']);
    header("Location: ../view/login.php");
?>
<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bdnome = "openfeob";

    // conexão com o banco
    $conn = mysqli_connect($servidor, $usuario, $senha, $bdnome);

    // Checar se a conexão funcinou
    if(!$conn)
    {
        die("Falha na Conexão: ".mysqli_connect_errno()." -> ".mysqli_connect_error());
    }
    else
    {
        // echo("Conectado");
    }
?>
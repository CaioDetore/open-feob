<?php
    session_start();

    if(isset($_POST['submit']))
    {
        include_once('conexao.php');

        $nome = $_POST['nome_usuario'];
        $sobrenome = $_POST['sobrenome_usuario'];
        $data_nasc = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $celular = $_POST['celular'];
        $email = $_POST['email_usuario'];
        $senha = $_POST['senha'];
        $data_cadastro = date('Y/m/d');

        $result = mysqli_query($conn, "INSERT INTO usuario(nome_usuario, sobrenome_usuario, data_nascimento, cidade, estado, celular, email_usuario, senha, data_cadastro) VALUES ('$nome', '$sobrenome', '$data_nasc', '$cidade', '$estado', '$celular', '$email', '$senha', '$data_cadastro')");
    }

        //ir pra outra pagina e enviar mensagem que foi cadastrado
        $_SESSION["successcad"] = "Cadastro realizado com sucesso. Faça o login para acessar sua conta.";
        header('location: ../view/login.php'); 

        // Fechar a conexão com o banco
        mysqli_close($conn);

?>
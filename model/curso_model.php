<?php
    include_once('conexao.php');

    session_start();
    if((!isset($_SESSION['email_usuario']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email_usuario']);
        unset($_SESSION['senha']);
        $_SESSION['nologin'] = 'Necessário uma conta';
        header('Location: ../view/login.php');
    }
    $email = $_SESSION['email_usuario'];

    $RES=mysqli_query($conn, "select * from usuario where email_usuario ='$email'");
    $PERFIL=mysqli_fetch_array($RES, MYSQLI_NUM); 

    $id = $PERFIL[0];

    if(isset($_POST['submit']))
    {
        $nome_curso = $_POST['nome_curso'];
        $descricao = $_POST['descricao'];
        $tempo_estimado = $_POST['tempo_estimado'];
        $video_sobre = $_POST['video_sobre'];
        $data_cadastro = date('Y/m/d');

        $query = "INSERT INTO curso(usuario_id_usuario, nome_curso, descricao, tempo_estimado, video_sobre, data_cadastro) VALUES($id, '$nome_curso', '$descricao', $tempo_estimado, '$video_sobre', '$data_cadastro')";
    
        if(!mysqli_query($conn, $query))
        {
            die("<br>Falha na Inserção dos Dados = $query -> ".mysqli_errno($conn)." -> ".mysqli_error($conn));
        }

        //ir pra outra pagina e enviar mensagem que foi cadastrado
        $_SESSION["successcad"] = "Cadastro realizado com sucesso. Faça o login para acessar sua conta.";
        header('location: ../view/perfil.php'); 

        // Fechar a conexão com o banco
        mysqli_close($conn);

    }

        

?>
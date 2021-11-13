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

    $ID_CURSO = $_GET['c'];

    if(isset($_POST['submit']))
    {
        $nome_aula = $_POST['nome_aula'];
        $descricao = $_POST['descricao'];
        $video_aula = $_POST['video_aula'];
        $num_aula = $_POST['num_aula'];
        $data_cadastro = date('Y/m/d');

        $query = "INSERT INTO aula(curso_id_curso, nome_aula, descricao, video_aula, num_aula, data_cadastro) VALUES($ID_CURSO, '$nome_aula', '$descricao', '$video_aula', $num_aula, '$data_cadastro')";
    
        if(!mysqli_query($conn, $query))
        {
            die("<br>Falha na Inserção dos Dados = $query -> ".mysqli_errno($conn)." -> ".mysqli_error($conn));
        }

        //ir pra outra pagina e enviar mensagem que foi cadastrado
        $_SESSION["successcadaula"] = "Aula publicada com sucesso!";
        header('location: ../view/aulas.php?c='.$ID_CURSO); 

        // Fechar a conexão com o banco
        mysqli_close($conn);

    }

        

?>
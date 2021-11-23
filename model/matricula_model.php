<?php
    session_start();

    include_once('conexao.php');

    include('../controller/busca_curso_aluno_user.php');

    $data_matricula = date('Y/m/d');
    
    $result = mysqli_query($conn, "INSERT INTO matricula (usuario_id_usuario, curso_id_curso, data_matricula) VALUES ($PERFIL[0], $ID_CURSO, '$data_matricula');");

    //ir pra outra pagina e enviar mensagem que foi cadastrado
    $_SESSION["matricula_sucedida"] = "Matricula realizada com sucesso!";
    header('location: ../view/aulas.php?c='.$ID_CURSO.''); 

    // Fechar a conexão com o banco
    mysqli_close($conn);
?>
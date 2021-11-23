<?php
    include_once('conexao.php');
    session_start();

        $id_curso = $_POST['id_curso'];
        $nome_curso = $_POST['nome_curso'];
        $descricao = $_POST['descricao'];
        $tempo_estimado = $_POST['tempo_estimado'];
        $video_sobre = $_POST['video_sobre'];
        $data_edicao = date('Y/m/d');

        $query = "UPDATE curso SET nome_curso = '$nome_curso', descricao = '$descricao', tempo_estimado = '$tempo_estimado', video_sobre = '$video_sobre', data_edicao = '$data_edicao'  WHERE id_curso = $id_curso";
    
        if(!mysqli_query($conn, $query))
        {
            die("<br>Falha na Inserção dos Dados = $query -> ".mysqli_errno($conn)." -> ".mysqli_error($conn));
            $_SESSION["edit_falha"] = "Falha ao editar. Veja se os dados foram preenchidos corretamente.";
            header('location: ../view/pagina_curso.php?c='.$id_curso);
        } else {
            //ir pra outra pagina e enviar mensagem que foi cadastrado
            $_SESSION["edit_sucesso"] = "Editado com sucesso.";
            header('location: ../view/pagina_curso.php?c='.$id_curso);
        }

        mysqli_close($conn);

?>
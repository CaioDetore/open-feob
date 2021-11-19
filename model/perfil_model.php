<?php

        if(isset($_POST['submit']))
        {
            include_once('conexao.php');
            include_once('../controller/logado_perfil_editar.php');

            $nome = $_POST['nome_usuario'];
            $sobrenome = $_POST['sobrenome_usuario'];
            $data_nasc = $_POST['data_nascimento'];
            $email = $_POST['email_usuario'];
            $senha = $_POST['senha'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $celular = $_POST['celular'];
            $foto_perfil = $_POST['foto_perfil'];
            $facebook = $_POST['facebook'];
            $instagram = $_POST['instagram'];
            $youtube = $_POST['youtube'];
            $linkedin = $_POST['linkedin'];
            $data_edição = date('Y-m-d');

            $query = "UPDATE usuario SET nome_usuario = '$nome', sobrenome_usuario = '$sobrenome', data_nascimento = '$data_nasc', email_usuario = '$email', senha = '$senha', cidade = '$cidade', estado = '$estado', celular = $celular, facebook = '$facebook', instagram = '$instagram', youtube = '$youtube', linkedin = '$linkedin', data_edicao = '$data_edição' WHERE id_usuario = $PERFIL[0]";

            if(!mysqli_query($conn, $query))
            {
                die("<br> Falha na Inserção dos Dados = $query ".mysqli_errno($conn)." -> ".mysqli_error($conn));
                $_SESSION["edit_error"];
                header('location: ../view/editar_perfil.php'); 
            } else {
                $_SESSION["edit_succes"] = "Edição realizada com sucesso!";
                header('location: ../view/editar_perfil.php'); 
            }

            mysqli_close($conn);
        }
?>
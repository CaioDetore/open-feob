<?php

  $ID_CURSO = $_GET['c'];

  include_once('../model/conexao.php');
  if((!isset($_SESSION['email_usuario']) == true) and (!isset($_SESSION['senha']) == true))
  {
      unset($_SESSION['email_usuario']);
      unset($_SESSION['senha']);
      $_SESSION['nologin'] = 'É necessário estar logado para ver o curso.';
      header('Location: login.php');
  }
    
  $email = $_SESSION['email_usuario'];

  $RES=mysqli_query($conn, "select * from usuario where email_usuario ='$email'");
  $PERFIL=mysqli_fetch_array($RES, MYSQLI_NUM); 

  $RES=mysqli_query($conn, "select * from curso where id_curso ='$ID_CURSO'");
  $CURSO=mysqli_fetch_array($RES, MYSQLI_NUM); 

  $RES2=mysqli_query($conn, "select * from usuario where id_usuario ='$CURSO[1]'");
  $TUTOR=mysqli_fetch_array($RES2, MYSQLI_NUM); 

  $RES_MATRICULA = mysqli_query($conn, "SELECT * FROM matricula WHERE curso_id_curso = $ID_CURSO");
  $MATRICULA = mysqli_fetch_array($RES_MATRICULA, MYSQLI_NUM);
//   como as variaveis estão em um array você precisa colocar o index do campo que vc quer o valor

?>
<?php
  include_once('../model/conexao.php');
  session_start();

  $pagina = $_GET['pg']; 
  if ($pagina == null) {
    header('location:fiscal_usuarios.php?pg=0');
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONTES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/main.css">

    <link rel="shortcut icon" href="../img/icone.png">

    <!-- BOX ICON -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <title>OpenFeob</title>
</head>
<body style="background-color: #212529;color: white;">
    <!-- COMEÇO HEADER -->
    <header id="header">

            <nav class="navbar navbar-expand-lg navbar-light">

                <img src="../img/logo-nav.png" class="image-fluid" height="67">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="justify-content-end collapse navbar-collapse" id="navbarNav">
    
                    <ul class="navbar-nav">
                      <?php 
                      if(!isset($_SESSION['email_usuario'])) {
                        include('../controller/menu_deslogado.php');
                      } else {
                        include('../controller/menu_logado.php');
                      }
                      ?>
                    </ul>
      
                </div>
            </nav>
    </header>

    <!-- FIM HEADER -->

    <!-- SIDENAV -->
    <div id="sidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <span class="d-flex justify-content-center"> <img src="../img/logo-nav.png" class="image-fluid" height="67"> </span> <hr>
        <a href="aulas.php?c="> <i class='bx bx-arrow-back'></i>  Voltar </a>
        <a href="fiscal_usuarios.php?pg=10"> Usuarios </a>
        <a href="fiscal_cursos.php?pg=0"> Cursos </a>
    </div>
    <!-- FIM SIDENAV -->

    <!-- BANNER -->
    <div id="banner">
    </div>

    <!-- FIM BANNER -->
    <!-- MAIN (todo conteudo da pagina deve ficar aq dentro) -->
    <div id="main">
      <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776; Menu </span>

      <!-- CURSOS-FISCAL -->
      <div id="fiscal-curso" class="container">
        <h2 class="text-center m-1"> Usuarios cadastrados: </h2>
        <table class="table table-dark table-hover">        
            <thead>
            <tr> 
              <td> Nome </td>
              <td> Aluno Tutor </td>
              <!-- <td> Admin  </td> -->
              <td> Data Cadastro </td>
              <td> Ativo </td>
              <td>  </td>
            </tr>
            </thead>
            <tbody>
            <?php 
              $busca= "SELECT * FROM usuario"; 

              $total_registros_por_pg = '10'; 
                            
              if(!$pagina) 
              {
                $pc = '1';          
              } else {
                $pc = $pagina;    
              }
                            
              $inicio = $pc - 1; 
              $inicio = $inicio * $total_registros_por_pg; 
            
              $limite = mysqli_query($conn, "$busca LIMIT $inicio, $total_registros_por_pg");
              $total = mysqli_query($conn, $busca);
            
              $tr = mysqli_num_rows($total); 
              $tp = $tr / $total_registros_por_pg; 
              
              while($dados = mysqli_fetch_assoc($limite))
              {    
                if($dados['ativo'] == 1){
                  $atv = 'Ativo';
                } else {
                  $atv = 'Desativo';
                }

                if($dados['tutor'] == 1){
                    $ttr = 'Sim';
                } else {
                    $ttr = 'Não';
                }

                echo
                ('
                  <tr title="Clique no olho para ver a requisição">
                    <td>'.$dados['nome_usuario'].' '.$dados['sobrenome_usuario'].'</td>
                    <td>'.$ttr.'</td>
                    <td>'.$dados['data_cadastro'].'</td>
                    <td>'.$atv.'</td>
                    <td> <a href="perfil_user.php?u='.$dados['id_usuario'].'"> <i class="bx bx-show-alt" title="Clique para análisar o usuario" ></i> </a> </td>
                  </tr>
                ');
              }
            ?>
            </tbody>
        </table>
      </div>
    <!-- FIM CURSOS -->
    </div>        

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
    
    
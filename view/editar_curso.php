<?php
  session_start();

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
    
    <title>OpenFeob - <?php echo($CURSO[2]); ?></title>
</head>
<body>
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

    <!-- BANNER -->
    <div id="banner" class="block" style="height: 300px;">
    </div>
    <!-- FIM BANNER -->
      
    <!-- SOBRECURSO -->
    <!-- FORMULARIO -->
    <form action="../model/editar_curso_model.php" method="$_POST"> 
    <div id="sobrecurso" class="block"> 
      <div class="container">
        <div class="row">

            <!-- sobre curso -->
            <div class="sobre_curso col-lg-4 col-md-6 align-self-center mb-md-0 mb-4 pt-3">
              <h2 class="text-center"> Sobre o Curso </h2> <hr>
              <p class="m-2 text-center title"> <b> <?php echo($CURSO[2]); ?> </b> </p>
              <p class="m-2"> <b> Tempo estimado: </b> <input class="form-control" type="number" value="<?php echo($CURSO[6]); ?>" title="Insira um valor em horas"> </p>
              <p class="m-2"> <b> Alunos matriculados: </b> </p>
              <p class="m-2"> <b> Data de publicação: </b> <?php echo($CURSO[9]); ?> </p>
              <p class="m-2"> <b> Descrição: </b> </p>
              <p class="ms-2"> <textarea type="text box" class="form-control" title="Coloque aqui uma breve descrição do que se trata seu curso" name="descricao" id="descricao"> <?php echo($CURSO[7]); ?>  </textarea>  </p>
            </div>
          
          <!-- fim sobre curso -->

          <!-- video sobre -->
          <div class="col-lg-8 col-md-6 align-self-center text-center">
            <h3> Video Sobre </h3>

            <!-- tratamento do video -->
            <?php 
              $string_video = $CURSO[4];

              $array_nome = explode("v=", $string_video);

              if(strpos($array_nome[1], "&") != 0)
              {
                $codigo = explode("&", $array_nome[1]);
              } else {
                $codigo[0] = trim($array_nome[1]); 
              }
            ?>
            <!-- //tratamento do video -->

            <iframe width="560" height="315" src=<?php echo('"https://www.youtube.com/embed/'.$codigo[0].'"');  ?>
            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
          </div>
          <!-- fim video sobre -->
        </div>
      </div>  
    </div>
    <!-- FIM SOBRECURSO -->

    <!-- INSCREVER-SE + PERFIL ALUNO TUTOR -->
    <div id="sobrecurso" class="block"> 
        <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-md-6 align-self-center mb-md-0 mb-4">
                <input type="submit" class="btn btn-primary button button-primary" style="width: 100%;">
            </div>
    </form>
    <!-- FIM FORMULARIO -->
            <!-- sobre tutor -->
            <div class="sobre_tutor col-lg-8 col-md-6 text-end">
            <div class="pe-5 text-end"> 
                <h5> Publicado por: <?php echo($TUTOR[1]) ?> </h5>
                <p>informações extras</p>
            
            </div>
            <img src="../img/golden-fish.png">
            </div>
            <!-- fim sobre tutor -->
        </div>
        </div>  
    </div>
    <!-- FIM INSCREVER-SE + PERFIL ALUNO TUTOR -->



    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
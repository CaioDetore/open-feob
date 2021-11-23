<?php
  error_reporting(0);

  session_start();

  include('../controller/busca_curso_aluno_user.php')

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
    <!-- ALERTAS -->
    <?php
       if(isset($_SESSION['edit_sucesso'])):
    ?>
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Curso editado com sucesso!
        </div>
      </div>
    <?php
      endif;
      unset($_SESSION['edit_sucesso']);
    ?>
    <?php
      if(isset($_SESSION['errologin'])):
    ?>
      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Falha ao editar. Veja se os dados foram preenchidos corretamente.
        </div>
      </div>    
    <?php 
      endif;
      unset($_SESSION['errologin']);
    ?>
    <!-- FIM ALERTAS -->
      
    <!-- SOBRECURSO -->
    <div id="sobrecurso" class="block"> 
      <div class="container">
        <div class="row">
            <!-- sobre curso -->
            <div class="sobre_curso col-lg-4 col-md-6 align-self-center mb-md-0 mb-4 pt-3">
              <h2 class="text-center"> Sobre o Curso </h2> <hr>
              <p class="m-2 text-center title"> <b> <?php echo($CURSO[2]); ?> </b> </p>
              <p class="m-2"> <b> Tempo estimado: </b> <?php echo($CURSO[6]); ?> <?php if($CURSO[6]==1){ echo('Hora'); } else { echo('Horas'); }; ?> </p>
              <?php 
                $consulta_matriculados = mysqli_query($conn, 'SELECT * FROM curso c JOIN matricula m ON (c.id_curso = m.curso_id_curso) WHERE c.id_curso = '.$CURSO[0]);
              ?>
              <p class="m-2"> <b> Alunos matriculados: </b> <?php echo mysqli_num_rows($consulta_matriculados); ?>  </p>
              <p class="m-2"> <b> Data de publicação: </b> <?php echo($CURSO[9]); ?> </p>
              <p class="m-2"> <b> Descrição: </b> </p>
              <p class="ms-2"> <?php echo($CURSO[7]); ?> </p>
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
            <?php
              if($CURSO[1] == $PERFIL[0]){
                echo('<a href="aulas.php?c='.$ID_CURSO.'" class="button btn btn-primary button-primary" style="width: 100%;"> Ver Aulas </a>');
                echo('<a href="editar_curso.php?c='.$ID_CURSO.'" class="button btn btn-primary button-primary mt-3" style="width: 100%;"> Editar Curso </a>');
              } else if ($PERFIL[0] == $MATRICULA[1]) {
                echo('<a href="aulas.php?c='.$ID_CURSO.'" class="button btn btn-primary button-primary" style="width: 100%;"> Ver Aulas </a>');
              } else {
                echo ('
                  <a href="../model/matricula_model.php?c='.$ID_CURSO.'" class="button button-primary btn btn-primary" style="width: 100%;" value="'.$ID_CURSO.'"> Inscrever-se </a>
                ');
              }
            ?>
        </div>
        <!-- sobre tutor -->
        <div class="sobre_tutor col-lg-8 col-md-6 text-end">
          <div class="pe-5 text-end"> 
            <h5> Publicado por: <a href="perfil_user.php?u=<?php echo($TUTOR[0]) ?>" target="_blank"> <?php echo($TUTOR[1]." ".$TUTOR[2]) ?> </a> </h5>
            <?php 
              if($CURSO[10] == null){
                $data = $CURSO[9];
              } else {
                $data = $CURSO[10];
              }
            ?>
            <p class="subtitle"> ultima alteração: <?php echo($data); ?></p>
          
          </div>
          <!-- <img src="../img/golden-fish.png"> -->
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
<?php
  session_start();
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
    
    <title>OpenFeob</title>
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
    <div id="banner" class="block">
      <div class="container pt-5">

          <div class="align-self-center mb-md-0 mb-4"> 
            <h1> Bem Vindo à OpenUnifeob </h1>
            <h4 class="mb-4"> Uma plataforma com cursos de alunos para alunos! </h4>
          </div>

      </div>
    </div>

    <!-- FIM BANNER -->
    
    <!-- MENU -->
    <div id="menu" class="block">
      <div class="container">
        <h2 class="title text-center"> O que deseja fazer? </h2>
        <h4 class="subtitle text-center mb-4"> Escolha uma opção abaixo e explore a nossa plataforma </h4>

        <div class="row d-flex justify-content-center">

          <div class="col-lg-3 col-md-6 mb-4 mb-lb-0">
            <a href="cursos.php?pagina=0" class="destaque" >
              <div class="img-container mb-3">
                <img src="../img/menu-curso.jpg" class="img-fluid" title="Ver os cursos.">
              </div>
              <h5 class="text-uppercase"> Ver os cursos </h5>
              <p class="mb-0"> Veja os cursos de seus colegas e comece a estudar agora mesmo! </p>
            </a>
          </div>

          <div class="col-lg-3 col-md-6 mb-4 mb-lb-0">
            <a href="publicar_curso.php" class="destaque" >
              <div class="img-container mb-3">
                <img src="../img/menu-curso.jpg" class="img-fluid" title="Crie um curso e compartilhe seus conhecimentos com seus colegas!">
              </div>
              <h5 class="text-uppercase"> Criar um curso </h5>
              <p class="mb-0"> Crie um curso e compartilhe seus conhecimentos com seus colegas! </p>
            </a>
          </div>

          <div class="col-lg-3 col-md-6 mb-4 mb-lb-0">
            <a href="#" class="destaque" >
              <div class="img-container mb-3">
                <img src="../img/menu-curso.jpg" class="img-fluid" title="Acesse o fórum e fique ligado no que o pessoal anda comentando por aqui!">
              </div>
              <h5 class="text-uppercase"> Acessar o fórum </h5>
              <p class="mb-0"> Acesse o fórum e fique ligado no que o pessoal anda comentando por aqui! </p>
            </a>
          </div>

        </div>

      </div>
    </div>

    <!-- FIM MENU -->

    <!-- FOOTER -->
    <div id="footer" class="container">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Início</a></li>
          <li class="nav-item"><a href="cursos.php" class="nav-link px-2 text-muted">Cursos</a></li>
          <li class="nav-item"><a href="publicar_curso.php" class="nav-link px-2 text-muted">Publicar Curso</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Sobre</a></li>
        </ul>

        <div class="row">
          <div class="col-lg-4 col-md-6 align-self-start mb-md-0 mb-4">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
              <img src="../img/logofeob.png" class="img-fluid bi"  width="30" height="24">
            </a>
            <span class="text-muted">© 2021 OpenFeob, Inc</span>
          </div>
        
          <div class="col-lg-8 col-md-6 text-end justify-content-end d-flex">
            <ul class="nav col-md-4  list-unstyled justify-content-end">
              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/fb-ico.png" class="bi" width="24" height="24"> </a></li>
              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/tt-ico.png" class="bi" width="24" height="24"> </a></li>
              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/yt-ico.png" class="bi" width="24" height="24"> </a></li>
              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/inst-ico.png" class="bi" width="24" height="24"> </a></li>
            </ul>
          </div>

        </div>
      </footer>
      
    </div>
    <!-- FIM FOOTER -->

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
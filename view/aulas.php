<?php
  session_start();

  if ($_GET['c'] == null){
    header('Location:cursos.php?pagina=0');
  }

    // puxando os selescts feito para colocar os dados (as variaveis estão no arquivo de include)
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

    <!-- BOX ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
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
    <div id="banner" class="block" style="height: 300px;">
    </div>
    <!-- FIM BANNER -->

    <!-- AVISO QUE A AULA FOI CADASTRADA OU QUE A MATRICULA FOI REALIZADA -->
    <?php
      if(isset($_SESSION['successcadaula'])):
    ?>
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Aula publicada/editada com sucesso!
          </div>
      </div>

    <?php
      endif;
      unset($_SESSION['successcadaula']);
    ?>
    <!-- matricula -->
    <?php
      if(isset($_SESSION['matricula_sucedida'])):
    ?>
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Matricula realizada com sucesso!
        </div>
      </div>
              
    <?php 
      endif;
      unset($_SESSION['matricula_sucedida']);
    ?>
    <!-- FIM AVISO -->

    <!-- INFO -->
    <div id="info" class="container-fluid">
        
        <div class="nome-curso text-center justify-content-center">
            <h1> <a href="pagina_curso.php?c=<?php echo $ID_CURSO ?>"> <?php echo($CURSO[2]); ?> </a> </h1>
            <hr>
        </div>

        <div class="container">

            <h4> Progresso: </h4>
            <div class="progress container">
                <div class="progress-bar " role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>

            <div class="pt-3">
                <h5> Aulas restantes: <!-- php para as aulas restantes--> </h5> 
                <h5> Aulas concluidas: <!-- php para as aulas concluidas--> </h5> 
            </div>
            
        </div>
        <hr>

    </div>
    <!-- FIM INFO -->

    <!-- AULAS -->
    <div id="aulas">
        <div class="container mb-5">

            <div class="row d-flex justify-content-center">

            <?php
                $busca= "SELECT * FROM aula WHERE curso_id_curso = $ID_CURSO";  
                $limite = mysqli_query($conn, "$busca");
                
                while($dados = mysqli_fetch_assoc($limite))
                {
                    echo('
                    <div class="card col-lg-3 col-md-6 mb-lb-0 m-2">
                        <div class="img-container ">
                            <!-- php para inserção da imagem_aula -->
                            <img src="../img/miniatura-aula.jpg" class="img-fluid">
                        </div>
                        <h5 class="text-uppercase">'.$dados['nome_aula'].'</h5>
                        <p class="mb-0">'.$dados['descricao'].'</p>
                        <a href="aula_assistir.php?c='.$ID_CURSO.'&a='.$dados['id_aula'].'&na='.$dados['num_aula'].'" class="button btn btn-primary button-primary" style="width: 100%;"> Acessar aula </a>
                    </div>
                    ');
                }     
            ?>

            <?php
              if($CURSO[1] == $PERFIL[0]){
                echo('
                  <div class="card col-lg-3 col-md-6 mb-lb-0 m-2">
                    <a class="button btn" href="publicar_aula.php?c='.$ID_CURSO.'" style="width: 100%;"> Adicionar Aula <i class="bx bx-add-to-queue"></i>  </button>
                  </div>
                ');
              }
            ?>
            </div>

        </div>
    </div>
    <!-- FIM AULAS -->

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
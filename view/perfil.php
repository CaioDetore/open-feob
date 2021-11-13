<?php
    include_once('../model/conexao.php');
    session_start();
    if((!isset($_SESSION['email_usuario']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email_usuario']);
        unset($_SESSION['senha']);
        $_SESSION['nologin'] = 'Necessário uma conta';
        header('Location: login.php');
    }
    
    $email = $_SESSION['email_usuario'];

    $RES=mysqli_query($conn, "select * from usuario where email_usuario ='$email'");
    $PERFIL=mysqli_fetch_array($RES, MYSQLI_NUM); 
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
    <div id="banner" class="block" style="height: 300px;">
    </div>
    <!-- FIM BANNER -->

    <!-- PERFIL | CURSOS -->

    <div id="perfil">
        <div class="container">
            <div class="row">
                <!-- PERFIL -->
                <div class="col-lg-4 col-md-4 mb-4 mb-lb-0 border-end">
                    <div class="img-perfil dados">
                        <img src="../img/img-perfil.jpg" class="img-fluid rounded-circle"> 
                    </div>
                    <div class="pt-3">
                        <h3 class="text-center"> <?php echo($PERFIL[1].' '.$PERFIL[2]); ?> <a href="editar_perfil.php" class="ico"> <img src="../img/edit-ico.png" class="img-fluid"> </a> </h3>   <hr>
                        <h6>Cursos Matriculados: <!-- php --></h6>
                        <h6>Cursos Finalizados: <!-- php --></h6>
                        <h6>Cursos Públicados: <?php 
                            $consulta = mysqli_query($conn, 'SELECT * FROM curso WHERE usuario_id_usuario = '.$PERFIL[0]);
                            echo mysqli_num_rows($consulta);
                        ?></h6>

                        <!-- redes sociais href= php com o link -->
                        <div id="footer" class="text-end justify-content-center d-flex pt-3">
                            <ul class="nav list-unstyled">
                              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/fb-ico.png" class="bi" width="24" height="24"> </a></li>
                              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/tt-ico.png" class="bi" width="24" height="24"> </a></li>
                              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/yt-ico.png" class="bi" width="24" height="24"> </a></li>
                              <li class="ms-3"> <a class="text-muted" href="#"> <img src="../img/inst-ico.png" class="bi" width="24" height="24"> </a></li>
                            </ul>
                        </div>

                    </div>
                    
                </div>
                <!-- FIM PERFIL -->

                <!-- CURSOS -->
                <div class="col-8 block">
                        <div class="matriculados">
                            <h1 class="title">Matriculado:</h1>

                            <div id="menu" class="block pt-3" style="background-color: white;">
                        
                                <div class="row d-flex justify-content-center">

                                    <!-- <div class="col-lg-4 col-md-6 mb-4 mb-lb-0">
                                        <a href="pagina_curso.php" class="destaque" >
                                            <div class="img-container">
                                            php para inserção da imagem_curso
                                            <img src="../img/miniatura-curso.jpg" class="img-fluid" title="Ver os cursos.">
                                            </div>
                                            <h5 class="text-uppercase"> php para a inserção do campo nome_curso  $CURSO[3] </h5>
                                            <p class="mb-0"> php para a inserção do campo descricao_curso $CURSO[7] </p>
                                            <button class="button btn btn-primary button-primary" style="width: 100%;"> Acessar curso </button>
                                        </a>
                                    </div> -->

                                </div>
                            </div>
                        </div>

                        <div class="meus-cursos">
                            <h1 class="title">Seus Cursos:</h1>

                            <div id="menu" class="block pt-3" style="background-color: white;">
                        
                                <div class="row d-flex justify-content-center">
                        
                                    <?php 
                                        $busca = "SELECT * FROM curso where usuario_id_usuario = $PERFIL[0]";
                                        $limite = mysqli_query($conn, $busca);

                                        $RES2=mysqli_query($conn, $busca);
                                        $CURSO=mysqli_fetch_array($RES2, MYSQLI_NUM); 

                                        while($dados = mysqli_fetch_assoc($limite))
                                        {
                                            echo('
                                            <div class="col-lg-4 col-md-6 mb-4 mb-lb-0">
                                                <a href="pagina_curso.php?c='.$dados['id_curso'].'" class="destaque" >
                                                    <div class="img-container">
                                                    <img src="../img/miniatura-curso.jpg" class="img-fluid" title="Ver os cursos.">
                                                    </div>
                                                    <h5 class="text-uppercase">'.$dados['nome_curso'].' </h5>
                                                    <p class="mb-0">'.$dados['descricao'].' </p>
                                                    <button class="button btn btn-primary button-primary" style="width: 100%;"> Acessar curso </button>
                                                </a>
                                            </div>          
                                            ');
                                        }
                                    ?> 

                                </div>
                            </div>
                        </div>

                </div>
                <!-- FIM CURSOS -->

            </div>
        </div>
    </div>

    <!-- FIM PERFIL | CURSOS -->


    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
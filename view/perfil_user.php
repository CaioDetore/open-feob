<?php

    include_once('../model/conexao.php');
    // include das informações
    include_once('../controller/logado_perfil_editar.php');
    
    $USER_ID = $_GET['u'];
    if ($USER_ID == null) {
        header('Location: perfil.php');
    }
    $RES_USER=mysqli_query($conn, "select * from usuario where id_usuario ='$USER_ID'");
    $USER=mysqli_fetch_array($RES_USER, MYSQLI_NUM); 

    // include das querys
    include_once('../controller/select_perfil.php');

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
    
    <title>OpenFeob - Perfil <?php echo($USER[1].' '.$USER[2]);?> </title>
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
                        <h3 class="text-center"> <?php echo($USER[1].' '.$USER[2]); ?>  </h3>   <hr>
                        <h6>Cursos Matriculados: <?php 
                            $consulta_matricula = mysqli_query($conn, 'SELECT * FROM matricula WHERE usuario_id_usuario = '.$USER[0]);
                            echo mysqli_num_rows($consulta_matricula);
                        ?> </h6>
                        <h6>Cursos Finalizados: <!-- php --></h6>
                        <h6>Cursos Públicados: <?php 
                            $consulta_publicados = mysqli_query($conn, 'SELECT * FROM curso WHERE usuario_id_usuario = '.$USER[0]);
                            echo mysqli_num_rows($consulta_publicados);
                        ?></h6>

                        <!-- redes sociais href= php com o link -->
                        <div id="footer" class="text-end justify-content-center d-flex pt-3">
                            <ul class="nav list-unstyled">
                              <li class="ms-3"> <a class="text-muted" href="<?php echo $USER[10] ?>" target="_blank"> <img src="../img/fb-ico.png" class="bi" width="24" height="24"> </a></li>
                              <li class="ms-3"> <a class="text-muted" href="<?php echo $USER[13] ?>" target="_blank"> <img src="../img/in-ico.png" class="bi" width="24" height="24"> </a></li>
                              <li class="ms-3"> <a class="text-muted" href="<?php echo $USER[12] ?>" target="_blank"> <img src="../img/yt-ico.png" class="bi" width="24" height="24"> </a></li>
                              <li class="ms-3"> <a class="text-muted" href="<?php echo $USER[11] ?>" target="_blank"> <img src="../img/inst-ico.png" class="bi" width="24" height="24"> </a></li>
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

                                    <?php 
                                        // query
                                        $busca_matricula = $SELECT_USER[1];
                                        $limite = mysqli_query($conn, $busca_matricula);

                                        $RES_MATRICULA=mysqli_query($conn, $busca_matricula);
                                        $CURSO=mysqli_fetch_array($RES_MATRICULA, MYSQLI_NUM); 

                                        if (mysqli_num_rows($limite) > 0) {
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
                                        } else {
                                            echo('<h4 class="subtitle"> '.$USER[1].' está inscrito em nenhum curso.');
                                        }
                                    ?> 

                                </div>
                            </div>
                        </div>

                        <div class="meus-cursos">
                            <h1 class="title">Seus Cursos:</h1>

                            <div id="menu" class="block pt-3" style="background-color: white;">
                        
                                <div class="row d-flex justify-content-center">
                        
                                    <?php 
                                        $busca = $SELECT_USER[0];
                                        $limite = mysqli_query($conn, $busca);

                                        $RES2=mysqli_query($conn, $busca);
                                        $CURSO=mysqli_fetch_array($RES2, MYSQLI_NUM); 

                                        if (mysqli_num_rows($limite) > 0) {
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
                                        } else {
                                            echo('<h4 class="subtitle"> '.$USER[1].' não possui cursos.');
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
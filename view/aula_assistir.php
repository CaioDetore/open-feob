<?php
  session_start();
  if ($_GET['c'] == null || $_GET['a'] == null){
    header('Location:cursos.php?pagina=0');
  }
    // puxando os selescts feito para colocar os dados (as variaveis estão no arquivo de include)
  include('../controller/busca_curso_aluno_user.php');  

  $ID_AULA = $_GET['a'];

  $RES_AULA=mysqli_query($conn, "select * from aula where id_aula ='$ID_AULA'");
  $AULA=mysqli_fetch_array($RES_AULA, MYSQLI_NUM); 
  
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
<body  style="background-color: #212529;color: white;">
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
        <a href="aulas.php?c=<?php echo $ID_CURSO ?>"> <i class='bx bx-arrow-back'></i>  Voltar </a>
        <?php 
            $busca= "SELECT * FROM aula WHERE curso_id_curso = $ID_CURSO";  
            $limite = mysqli_query($conn, "$busca");
            
            while($dados = mysqli_fetch_assoc($limite)){
                echo('<a href="aula_assistir.php?c='.$ID_CURSO.'&a='.$dados['id_aula'].'" title="Clique para acessar a aula! Descrição:'.$dados['descricao'].'"> Aula '.$dados['num_aula'].' - '.$dados['nome_aula'].' </a>');
            }
        ?>
    </div>
    <!-- FIM SIDENAV -->
    

    <!-- MAIN (todo conteudo da pagina deve ficar aq dentro) -->
    <div id="main">      
        <div class="container pt-3">
        <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776; Menu </span>
            <div class="video mt-2">
                <h1 class="title text-center"> <?php echo($AULA[2]) ?> </h1>
                <!-- tratamento do video -->
                <?php 
                    $string_video = $AULA[5];

                    $array_nome = explode("v=", $string_video);

                    if(strpos($array_nome[1], "&") != 0)
                    {
                        $codigo = explode("&", $array_nome[1]);
                    } else {
                        $codigo[0] = trim($array_nome[1]); 
                    }
                ?>
                <!-- //tratamento do video -->
                <div class="d-flex justify-content-center mt-5">
                    <iframe width="1300" height="662" src=<?php echo('"https://www.youtube.com/embed/'.$codigo[0].'"');  ?>
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>

                <div class="d-flex justify-content-end">
                    <?php 
                    
                        $anterior= mysqli_query($conn, "SELECT * FROM aula WHERE curso_id_curso = $AULA[1] AND num_aula < $AULA[6]");

                        if(mysqli_num_rows($anterior) > 0){
                            $na = $AULA[6] - 1;

                            $RES_AULA_ID=mysqli_query($conn, "SELECT id_aula FROM aula WHERE curso_id_curso = $AULA[1] AND num_aula =$na");
                            $BUSCA_ID_AULA=mysqli_fetch_array($RES_AULA_ID, MYSQLI_NUM); 

                            $a = $BUSCA_ID_AULA['0'];

                            echo('<a href="aula_assistir.php?c='.$ID_CURSO.'&a='.$a.'&na='.$na.'" class="btn btn-secondary button-secondary  mb-4 mt-4 me-2" > Anterior </a>');
                        }
                        
                        $proximo= mysqli_query($conn, "SELECT * FROM aula WHERE curso_id_curso = $AULA[1] AND num_aula > $AULA[6]");

                        if(mysqli_num_rows($proximo) > 0){  
                            $na = $AULA[6] + 1;

                            $RES_AULA_ID=mysqli_query($conn, "SELECT id_aula FROM aula WHERE curso_id_curso = $AULA[1] AND num_aula =$na");
                            $BUSCA_ID_AULA=mysqli_fetch_array($RES_AULA_ID, MYSQLI_NUM); 

                            $a = $BUSCA_ID_AULA['0'];

                            echo('<a href="aula_assistir.php?c='.$ID_CURSO.'&a='.$a.'&na='.$na.'" class="btn btn-secondary button-secondary  mb-4 mt-4 me-2" > Próximo</a>');
                        }
     
                    ?>  
                    
                    
                </div>
            </div>
        </div>
    </div>           

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
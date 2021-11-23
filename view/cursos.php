<?php
  include_once('../model/conexao.php');
  session_start();

  if ($_GET['pagina'] == null){
    header('Location:cursos.php?pagina=0'); 
  }
  
  // $RES=mysqli_query($conn, "select * from cursos where ativo = 1");
  // $CURSOS=mysqli_fetch_array($RES, MYSQLI_NUM); 

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
<body style="background-color: var(--light);">
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

          <div class="mb-md-0 mb-4"> 
            <h1 class="d-flex title justify-content-center pt-3"> Encontre um curso de sua escolha! </h1>

            <form action="../model/pesquisa_model.php" method="post" class="d-flex title justify-content-center">
                <input class="form-control" type="text" name="pesquisa" placeholder="Digite o nome do curso aqui..."/> 
                <button type="submit" class="busca ms-3"> </button> 
            </form>	

          </div>

      </div>
    </div>

    <!-- FIM BANNER -->
    
    <!-- FILTRO -->
    <div id="filtro">
        <div class="container-fluid">
            <h5 class="title d-flex justify-content-center"> Filtro avançado </h3>
            <hr>
            
            <div class="container">    
            <form action=""  class="row row-cols-lg-auto g-3 align-items-center">
                
                <div class="row g-3">
                    <div class="col-auto">
                        <label for="categoria" class="col-form-label"> Categoria: </label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="" id="categoria" style="width: 300px;"> 
                            <option value=""> Selecione </option>
                            <option value=""> Exatas </option>
                            <option value=""> 2 </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-auto">
                        <label for="categoria" class="col-form-label"> Área do curso: </label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="" id="categoria" style="width: 300px;"> 
                            <option value=""> Selecione </option>
                            <option value=""> Direito </option>
                            <option value=""> 2 </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-auto">
                        <label for="categoria" class="col-form-label"> Ordenar por: </label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="" id="categoria" style="width: 300px;"> 
                            <option value=""> Selecione </option>
                            <option value=""> Data publicação </option>
                            <option value=""> Mais vistos </option>
                        </select>
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
    <hr>
    <!-- FIM FILTRO -->

    <!-- CURSOS/MENU -->
    <div id="menu" class="block pt-3" style="background-color: var(--light);">
        <div class="container">
  
          <div class="row d-flex justify-content-center">
              <?php
                if (isset($_SESSION['query_pesquisa'])) {
                  $busca= $_SESSION['query_pesquisa'];
                } else {
                  $busca= "SELECT * FROM curso"; // busca tudo
                }
                unset($_SESSION['query_pesquisa']);

                $total_registros_por_pg = '10'; // define a qutde de elementos por pg
                $pagina = $_GET['pagina']; // pega o num da pg
                              
                if(!$pagina) // validação pra mostrar a primeira pg caso não tenha pg la em cima
                {
                  $pc = '1';          
                } else {
                  $pc = $pagina;    
                }
                              
                $inicio = $pc - 1; // pega o valor da pg - 1
                $inicio = $inicio * $total_registros_por_pg; 
              
                $limite = mysqli_query($conn, "$busca LIMIT $inicio, $total_registros_por_pg");
                $total = mysqli_query($conn, $busca);
              
                if (mysqli_num_rows($total) > 0) {
                    $tr = mysqli_num_rows($total); 
                    $tp = $tr / $total_registros_por_pg; // para saber quantas pg tem
                    
                    while($dados = mysqli_fetch_assoc($limite))
                    {
                        echo('
                          <div class="col-lg-3 col-md-6 mb-4 mb-lb-0">
                          <a href="pagina_curso.php?c='.$dados['id_curso'].'" class="destaque" >
                            <div class="img-container">
                              <!-- php para inserção da imagem_curso -->
                              <img src="../img/miniatura-curso.jpg" class="img-fluid" title="Clique para ver o curso.">
                            </div>
                            <h5 class="text-uppercase"> '.$dados['nome_curso'].' </h5>
                            <p class="mb-0"> '.$dados['descricao'].'</p>
                            <button class="button btn btn-primary button-primary" style="width: 100%;"> Acessar curso </button>
                          </a>
                        </div>
                        ');
                    }     

                    if (mysqli_num_rows($total) > 10) {
                      $anterior = $pc - 1;
                      $proximo = $pc + 1;
                      if($pc>1)
                      {
                          echo("<a href = 'cursos.php?pagina='".$anterior."'>< - Anterior </a> ");
                      }
                      if($pc<10)
                      {
                          echo("<a href='cursos.php?pagina='".$proximo."'> Proxima -> </a> ");
                      }
                    }
                } else {
                    echo('<h1> Nada encontrado... Clique <a href="cursos.php?pagina=0"> aqui </a> para voltar. </h1');
                }
                
              ?>
  
          </div>
  
        </div>
      </div>

    <!-- FIM CURSOS/MENU  -->

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
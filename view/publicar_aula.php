<?php
    session_start();
    if((!isset($_SESSION['email_usuario']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email_usuario']);
        unset($_SESSION['senha']);
        $_SESSION['nologin'] = 'Necessário uma conta';
        header('Location: ../view/login.php');
    }
    $logado = $_SESSION['email_usuario'];
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

    <!-- CADCURSO -->
    <div id="cadcurso" class="container pt-5">
        <div class="infocurso">
            <h1 class="title text-center mb-5"> Publicar Aula </h1>
                
            <form action="../model/aula_model.php?c=<?php echo($_GET['c']); ?>" method="POST">
            <div class="row justify-content-around">
                <div class="col-4">
                    <label for="nome_aula" class="form-label"> Título da Aula: </label>
                    <input type="text" class="form-control" title="Insira o título da aula" name="nome_aula" id="nome_aula"> 

                    <label for="descricao" class="form-label pt-3"> Descrição: </label>
                    <textarea type="text box" class="form-control" title="Coloque aqui uma breve descrição do que se trata a aula" name="descricao" id="descricao"> </textarea>

                    <label for="num_aula" class="form-label pt-3"> Ordem da aula: </label>
                    <input type="number" class="form-control" title="Digite o número da aula. Caso seje a primeira aula digite: 1, caso seja a segunda aula digite: 2..... " name="num_aula" id="num_aula">

                    <!-- checkboxes (NÃO USAR AINDA)-->
                    <input type="checkbox" id="comentarios" name="comentarios" value="comentarios" disabled>
                    <label for="comentarios"> Permitir comentários:   </label><br>
                    <input type="checkbox" id="email_visu" name="email_visu" value="emailview" disabled>
                    <label for="email_visu"> Permitir visualização de seu email: </label><br>

                </div>

                <div class="col-4">

                  <div class="mb-3">
                    <label for="video_aula" class="form-label pt-3"> <h3> Video aula: </h3> 
                    <h5 class="subtitle"> Insira o link do video da aula </h5> </label>
                    <input type="text" class="form-control" name="video_aula" id="video_aula" title="Insira o link do seu vídeo do youtube.">
                  </div>

                  <div class="mb-3">
                    <label for="miniatura" class="form-label pt-3"> <h4> Miniatura do vídeo: </h4>
                    <p class="subtitle"> (opcional) Insira uma imagem que mostre o que ira se tratar a aula. Recomendamos uma imagem 640 x 426 </p> </label>
                    <input class="form-control" type="file" id="miniatura">
                  </div>

                </div>

            </div>
            <div class="pb-3 d-flex justify-content-center mt-5"> 
                <button type="submit" name="submit" id="submit" class="button btn btn-primary button-primary">Adicionar Aula</button>
            </div> 
            </form>

         </div>
    </div>

    <!-- FIM CADCURSO -->



    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
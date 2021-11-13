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

    <!-- EDITAR PERFIL -->
    <div id="perfil">
        <form action="../model/perfil_model.php" method="POST">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 col-md-6 mb-4 mb-lb-0 border">
                        <h2 class="text-center p-2"> Conta </h2> <hr>
                        <div class="mb-3">
                            <label for="nome_" class="form-label"> Nome: </label>
                            <input type="text" class="form-control" id="nome_" name="nome_usuario">
                        </div>
                        <div class="mb-3">
                            <label for="sobrenome_" class="form-label"> Sobrenome: </label>
                            <input type="text" class="form-control" id="sobrenome_" name="sobrenome_usuario">
                        </div>
                        <div class="mb-3">
                            <label for="datanasc_" class="form-label"> Data de Nascimento: </label>
                            <input type="date" class="form-control" id="datanasc_" name="data_nascimento">
                        </div>
                        <div class="mb-3">
                            <label for="email_" class="form-label"> Email: </label>
                            <input type="text" class="form-control" id="email_" name="email_usuario">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha">
                            <div class="col-auto">
                                <span id="senha_box" class="form-text">
                                <input type="checkbox" onclick="mostrarOcultarSenha()" style="color: var(--light);"> Mostrar senha. </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nome_" class="form-label"> Celular: </label>
                            <input type="text" class="form-control" id="nome_" name="celular">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Imagem de perfil</label>
                            <input class="form-control" type="file" id="formFile" name="foto_perfil">
                        </div>
                    </div>    
                        
                    <div class="col-lg-6 col-md-6 mb-4 mb-lb-0 border">
                        <h2 class="text-center p-2"> Endereço: </h2> <hr>
                        <div class="mb-3">
                            <label for="cidade_" class="fomr-label"> Cidade: </label>
                            <input type="text" class="form-control" id="cidade_" name="cidade">
                        </div>
                        <div class="mb-3">
                            <label for="estado_" class="form-label"> Estado: </label> 
                            <input type="text" class="form-control" id="estado_" name="estado">
                        </div>

                        <div class="p-3 border">
                            <h2 class="text-center"> Redes Sociais </h2> 
                            <p class="subtitle text-center"> Insira os links das suas redes sociais. </p> <hr>
                            <div class="mb-3">
                                <label for="facebook_" class="form-label"> Facebook: </label>
                                <input type="text" class="form-control" id="facebook_" name="facebook">
                            </div>
                            <div class="mb-3">
                                <label for="instagram_" class="form-label"> Instagram: </label>
                                <input type="text" class="form-control" id="instagram_" name="instagram">
                            </div>
                            <div class="mb-3">
                                <label for="youtube_" class="form-label"> Youtube: </label>
                                <input type="text" class="form-control" id="youtube_" name="youtube">
                            </div>
                            <div class="mb-3">
                                <label for="linkedin_" class="form-label"> Linkedin: </label>
                                <input type="text" class="form-control" id="linkedin_" name="linkedin">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="button button-primary btn btn-primary mb-5" title="Clique para confirmar as alterações"> Confirmar </button>
                </div>
            </div>
        </form>
    </div>


    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
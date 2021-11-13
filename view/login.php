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
    
    <title>OpenFeob - Entrar</title>
</head>
<body id="login-bg">
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

    <!-- LOGIN -->
    <div id="login"> 
        <div class="container ">

          <!-- alertas -->
            <!-- simbolos -->
            <div class="alerta">
              <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
              <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </symbol>
              <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
              </symbol>
              <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </symbol>
              </svg>
                <!-- cadastro realizado  -->
              <?php
                    if(isset($_SESSION['successcad'])):
              ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                          Cadastro realizado com sucesso. Faça o login para acessar sua conta.
                        </div>
                    </div>

              <?php
                    endif;
                    unset($_SESSION['successcad']);
              ?>
                <!-- erro no login -->
              <?php
                  if(isset($_SESSION['errologin'])):
              ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Usuário ou Senha Inválido. Caso não tenha uma conta <a href="cadastrar.php" class="alert-link"> clique aqui </a> para criar sua conta agora.
                    </div>
                  </div>
              
              <?php 
                  endif;
                  unset($_SESSION['errologin']);
              ?>
                <!-- login não realizado -->
                <?php
                  if(isset($_SESSION['nologin'])):
              ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Para acessar essa página é necessário ter uma conta. <a href="cadastrar.php" class="alert-link"> Clique aqui </a> para criar sua conta agora.
                    </div>
                  </div>
              
              <?php 
                  endif;
                  unset($_SESSION['nologin']);
              ?>
            </div>
          <!-- fim alertas -->

          <div class="menu d-flex flex-column align-items-start pt-5 ">
            <h2 class="title me-md-2">Acesse sua conta:</h2>

            <form action="../model/login_model.php" method="POST">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email_usuario">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Senha:</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="senha">
                </div>
                <a href="cadastrar.php" class="me-5" title="Clique para criar uma conta.">Criar conta</a>
                <button type="submit" name="submit" id="submit" class="button btn btn-primary button-primary justify-content-end">Acessar minha conta</button>
            </form>
              
          </div>
        </div>
    </div>
    

    <!-- FIM LOGIN -->


    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>
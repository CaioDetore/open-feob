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
    <title>OpenFeob - Criar Conta</title>
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
    <!-- CADASTRO -->
    <div>
      <div class="container">
        <div class="menu d-flex flex-column align-items-start pt-5">
          <h2 class="d-flex title pt-3">Criar uma conta:</h2>
          <h4 class="d-flex justify-content-center  subtitle"> Crie sua conta e acesse os conteúdos do nosso site! </h4>
          
          <form class="m-4" action="../model/cad_model.php" method="POST">
            <!-- dados pessoais -->
            <div class="mb-3">
              <label for="p_nome" class="form-label">Primeiro Nome:</label>
              <input type="text" id="nome_usuario" name="nome_usuario" class="form-control" placeholder="Ex: João" title="Digite seu primeiro nome!" required>
            </div>

            <div class="mb-3">
              <label for="s_nome" class="form-label">Sobrenome:</label>
              <input type="text" id="sobrenome_usuario" name="sobrenome_usuario" class="form-control" placeholder="Ex: Pereira" title="Digite seu sobrenome!" required>
            </div>

            <div class="mb-3">
              <label for="nascimento" class="form-label">Data de Nascimento: </label>
              <input type="date" class="form-control" id="nascimento" name="data_nascimento" required>
            </div>

            <div class="mb-3">
              <label for="">Cidade: </label>
              <input type="text" class="form-control" id="cidade" name ="cidade" placeholder="Ex: São João da Boa Vista" title="Digite sua cidade." required>
            </div>

            <div class="mb-3">
              <label for="estado" class="form-label">Estado: </label>
              <select class="form-select" id="estado" name="estado" title="Selecione o seu estado." required>
                <option value="">Selecione</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espirito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MT">Mato Grosso</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="">Celular:</label>
              <input type="tel" pattern="[0-9]{11}" class="form-control" id="celular" name="celular" placeholder="Ex: 19991234567" title="Digite o número do seu celular seguindo o modelo do exemplo." required>
            </div>

            <!-- dados para o acesso à conta -->
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="text" class="form-control" id="email_usuario" name="email_usuario" aria-describedby="emailHelp" placeholder="Ex: meuemail@sou.unifeob.edu.br" title="Digite seu email! Ele sera utilizado para acessar sua conta." required>
              <div id="emailHelp" class="form-text" style="color: var(--light);">Seu email será utilizado para você acessar sua conta.</div>
            </div>

            <div class="row g-3 align-items-center mb-3">
              <div class="col-auto">
                <label for="senha" class="col-form-label">Senha:</label>
              </div>

              <div class="col-auto">
                <input type="password" id="senha" name="senha" class="form-control" aria-describedby="passwordHelpInline" title="Digite uma senha para acessar sua conta." required>
              </div>

              <div class="col-auto">
                <span id="passwordHelpInline" class="form-text">
                  <input type="checkbox" onclick="mostrarOcultarSenha()" style="color: var(--light);"> Mostrar senha. </span>
              </div>
            </div>

            <!-- // -->
            <div class="pb-3 d-flex justify-content-end">
              <button type="submit" name="submit" id="submit" class="button btn btn-primary button-primary">Criar conta</button>
            </div>

            <?php
                if(isset($_SESSION['errocad'])):
            ?>
                <div class="alert alert-danger" role="alert">
                <p class="p-msg">ERRO: </p>
                </div>

            <?php
                endif;
                unset($_SESSION['errologin']);
            ?>

          </form>

        </div>
      </div>
    </div>
    <!-- FIM CADASTRO -->
    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
  </body>
</html>
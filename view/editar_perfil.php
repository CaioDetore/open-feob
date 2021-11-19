<?php
    include_once('../model/conexao.php');
    include_once('../controller/logado_perfil_editar.php')
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
                    if(isset($_SESSION['edit_succes'])):
              ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                            Edição realizada com sucesso!
                        </div>
                    </div>

              <?php
                    endif;
                    unset($_SESSION['edit_succes']);
              ?>
              <!-- erro edit -->
              <?php
                  if(isset($_SESSION['edit_error'])):
              ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Error ao editar seu perfil. Verifique se todas as informações estão preenchidas.
                    </div>
                  </div>
              
              <?php 
                  endif;
                  unset($_SESSION['edit_error']);
              ?>
            </div>
    <!-- fim alertas -->
    <!-- EDITAR PERFIL -->
    <div id="perfil">
        <form action="../model/perfil_model.php" method="POST">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 col-md-6 mb-4 mb-lb-0 border">
                        <h2 class="text-center p-2"> Conta </h2> <hr>
                        <div class="mb-3">
                            <label for="nome_" class="form-label"> Nome: </label>
                            <input type="text" class="form-control" id="nome_" name="nome_usuario" value="<?php echo $PERFIL[1] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="sobrenome_" class="form-label"> Sobrenome: </label>
                            <input type="text" class="form-control" id="sobrenome_" name="sobrenome_usuario" value="<?php echo $PERFIL[2] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="datanasc_" class="form-label"> Data de Nascimento: </label>
                            <input type="date" class="form-control" id="datanasc_" name="data_nascimento" value="<?php echo $PERFIL[3] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email_" class="form-label"> Email: </label>
                            <input type="text" class="form-control" id="email_" name="email_usuario" value="<?php echo $PERFIL[4] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha" value="<?php echo $PERFIL[5] ?>">
                            <div class="col-auto">
                                <span id="senha_box" class="form-text">
                                <input type="checkbox" onclick="mostrarOcultarSenha()" style="color: var(--light);"> Mostrar senha. </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nome_" class="form-label"> Celular: </label>
                            <input type="text" class="form-control" id="nome_" name="celular" value="<?php echo $PERFIL[8] ?>">
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
                            <input type="text" class="form-control" id="cidade_" name="cidade" value="<?php echo $PERFIL[6] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="estado_" class="form-label"> Estado: </label> 
                            <select class="form-select" id="estado" name="estado" title="Selecione o seu estado.">
                                <option value="<?php echo $PERFIL[7] ?>"><?php echo $PERFIL[7] ?></option>
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

                        <div class="p-3 border">
                            <h2 class="text-center"> Redes Sociais </h2> 
                            <p class="subtitle text-center"> Insira os links das suas redes sociais. </p> <hr>
                            <div class="mb-3">
                                <label for="facebook_" class="form-label"> Facebook: </label>
                                <input type="text" class="form-control" id="facebook_" name="facebook" value="<?php echo $PERFIL[10] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="instagram_" class="form-label"> Instagram: </label>
                                <input type="text" class="form-control" id="instagram_" name="instagram" value="<?php echo $PERFIL[11] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="youtube_" class="form-label"> Youtube: </label>
                                <input type="text" class="form-control" id="youtube_" name="youtube" value="<?php echo $PERFIL[12] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="linkedin_" class="form-label"> Linkedin: </label>
                                <input type="text" class="form-control" id="linkedin_" name="linkedin" value="<?php echo $PERFIL[13] ?>">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="submit" id="submit" class="button button-primary btn btn-primary mb-5" title="Clique para confirmar as alterações"> Confirmar </button>
                    <a href="perfil.php" class="button button-primary btn btn-primary mb-5 ms-5" style="background-color: var(--dark)"> Cancelar </a>
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
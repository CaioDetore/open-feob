<?php 
    include_once('conexao.php');

    session_start();
    
    $pesquisa = $_POST['pesquisa'];

    $select = "SELECT * FROM curso where nome_curso LIKE '%$pesquisa%'";
    $_SESSION['query_pesquisa'] = $select;
    header('location: ../view/cursos.php?pagina=0'); 

?>
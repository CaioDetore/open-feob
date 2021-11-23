<?php
    error_reporting(0);
    $SELECT_PERFIL = array(
        "SELECT * FROM curso where usuario_id_usuario = $PERFIL[0]",
        "SELECT c.id_curso, c.nome_curso, c.descricao FROM curso c 
        JOIN matricula m ON (m.curso_id_curso = c.id_curso) 
        JOIN usuario u ON (u.id_usuario = m.usuario_id_usuario)
        WHERE u.id_usuario = $PERFIL[0]"
    );

    $SELECT_USER = array(
        "SELECT * FROM curso where usuario_id_usuario = $USER_ID",
        "SELECT c.id_curso, c.nome_curso, c.descricao FROM curso c 
        JOIN matricula m ON (m.curso_id_curso = c.id_curso) 
        JOIN usuario u ON (u.id_usuario = m.usuario_id_usuario)
        WHERE u.id_usuario = $USER_ID"
    );
?>
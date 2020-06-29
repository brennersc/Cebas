<?php

session_start();

require_once('db_class.php');

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastro?erro=1');
}

$email = strip_tags(trim(addslashes($_POST['email'])));
$senha = strip_tags(trim(addslashes(md5($_POST['password']))));

$objDb = new db();
$link = $objDb->conecta_mysql();


$sql = " SELECT id, email FROM usuario WHERE email = '$email' AND senha = '$senha' ";

$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {

    $dados_usuario = mysqli_fetch_array($resultado_id);

    if (isset($dados_usuario['email'])) {

        $_SESSION['id_usuario'] = $dados_usuario['id'];
        $_SESSION['email'] = $dados_usuario['email'];

        $id_usuario = $_SESSION['id_usuario'];

        $sql = 0;
        $resultado_id = 0;

        $sql = "SELECT 

        u.id,
        ca.id_cadastro,
        c.id_curso,
        f.id_familiares,
        p.id_profissao,

        ca.id_usuario as cadastro,
        c.id_usuario as curso,
        f.id_usuario as familiares,
        p.id_usuario as proficao

        FROM 

        usuario u 
        left  join cadastro ca   on u.id = ca.id_usuario
        left  join curso c       on u.id = c.id_usuario
        left  join familiares f  on u.id = f.id_usuario
        left  join profissao p   on u.id = p.id_usuario
        
        where 
        
        u.id = '$id_usuario' ";

        $resultado_id = mysqli_query($link, $sql);

        $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

        $cadastro   = $registro['cadastro'];
        $graducao   = $registro['curso'];
        $familiar   = $registro['familiares'];
        $proficao   = $registro['proficao'];


        if ($cadastro == null) {
            header('Location: ../fumec-form');
        } elseif ($graducao == null) {
            header('Location: ../fumec-form-2');
        } elseif ($proficao == null) {
            header('Location: ../fumec-form-3');
        } elseif ($familiar == null) {
            header('Location: ../fumec-form-4');
        } else {
            header('Location: ../fumec-form-5');
        }

    } else {
        header('Location: ../login?erro=1');
    }
} else {
    echo "Erro na execução da consulta, favor entrar em contato com o admin do site";
}


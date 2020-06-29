<?php


require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

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
        
        u.id = '$id_usuario'";

$resultado_id = mysqli_query($link, $sql);

$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

$nomecadastro   = $registro['cadastro'];
$graducao       = $registro['curso'];
$nomefamiliar   = $registro['familiares'];
$nomeproficao   = $registro['proficao'];

if (($nomecadastro != null) and ($graducao != null) and ($nomeproficao != null) and ($nomefamiliar != null)) {
    echo  '<li class="breadcrumb-item"><a href="fumec-form">Cadastro</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-2">Curso</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-3">Informações</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-4">Grupo Familiar</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-5">Casdatro realizado</a></li>';
} else if (($nomecadastro != null) and ($graducao != null) and ($nomeproficao != null) and ($nomefamiliar == null)) {
    echo  '<li class="breadcrumb-item"><a href="fumec-form">Cadastro</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-2">Curso</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-3">Informações</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-4">Grupo Familiar</a></li>';
    echo  '<li class="breadcrumb-item">Casdatro realizado</li>';
} elseif (($nomecadastro != null) and ($graducao != null) and ($nomeproficao != null) and ($nomefamiliar == null)) {
    echo  '<li class="breadcrumb-item"><a href="fumec-form">Cadastro</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-2">Curso</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-3">Informações</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-4">Grupo Familiar</a></li>';
    echo  '<li class="breadcrumb-item">Casdatro realizado</li>';
} elseif (($nomecadastro != null) and ($graducao != null) and ($nomeproficao == null)) {
    echo  '<li class="breadcrumb-item"><a href="fumec-form">Cadastro</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-2">Curso</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-3">Informações</a></li>';
    echo  '<li class="breadcrumb-item">Grupo Familiar</li>';
} elseif (($nomecadastro != null) and ($graducao == null)) {
    echo  '<li class="breadcrumb-item"><a href="fumec-form">Cadastro</a></li>';
    echo  '<li class="breadcrumb-item"><a href="fumec-form-2">Curso</a></li>';
    echo  '<li class="breadcrumb-item">Informações</li>';
} elseif (($nomecadastro == null)) {
    echo  '<li class="breadcrumb-item"><a href="fumec-form">Cadastro</a></li>';
    echo  '<li class="breadcrumb-item">Curso</li>';
}

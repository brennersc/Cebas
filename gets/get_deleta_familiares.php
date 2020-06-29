<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
  header('Location: cadastro?erro=1');
}

require_once('db_class.php');

// $status = $_POST['status'];

$id_usuario = $_SESSION['id_usuario'];

$id_familiares = $_GET['ex'];

$objDb = new db();
$link = $objDb->conecta_mysql();

echo $id_familiares;

$sql = "DELETE FROM `familiares` WHERE id_usuario = '$id_usuario' and id_familiares = '$id_familiares'";


if (mysqli_query($link, $sql)) {

  header('Location: ../fumec-form-4');

} else {
  echo '<div class="caixa-anuncio group">';
    echo '<div class="row ">';
      echo '<div class="titulo" class="col-sm-12">';
        echo '<h3><B><center>Erro na consulta de Anuncios no banco de dados!</center></B></h3>';
        echo '<h3><B><center><a href="./">Voltar</a></center></B></h3>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
}

<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastro?erro=1');
}

require_once('db_class.php');


$graduacao          = strip_tags(trim(addslashes($_POST['graduacao'])));
$qualgraduacao      = strip_tags(trim(addslashes($_POST['qualgraduacao'])));

$primeirocurso      = strip_tags(trim(addslashes($_POST['primeirocurso'])));
$segundocurso       = strip_tags(trim(addslashes($_POST['segundocurso'])));
$terceirocurso      = strip_tags(trim(addslashes($_POST['terceirocurso'])));

/*
$turno1             = strip_tags(trim(addslashes($_POST['turno1'])));
$turno2             = strip_tags(trim(addslashes($_POST['turno2'])));
$turno3             = strip_tags(trim(addslashes($_POST['turno3'])));
*/

$id_usuario = $_SESSION['id_usuario'];

if (empty($primeirocurso) || empty($segundocurso) || empty($terceirocurso)) {;
    header('Location: ../fumec-form-2?selecione=1');
    die();
}

if ($primeirocurso == $segundocurso || $primeirocurso == $terceirocurso || $segundocurso  == $terceirocurso) {
    header('Location: ../fumec-form-2?selecione=1');
    die();
}

$objDb  =  new db();
$link  =  $objDb->conecta_mysql();

$sql  =  "SELECT * FROM curso where id_usuario  =  '$id_usuario' ";

if ($resultado_id  =  mysqli_query($link, $sql)) {

    $dados_usuario  =  mysqli_fetch_array($resultado_id);

    if (isset($dados_usuario['id_usuario'])) {

        $sql  =  "UPDATE curso SET 
                `graduacao`         = '$graduacao',
                `primeiro`          = '$primeirocurso',
                `segundo`           = '$segundocurso',
                `terceiro`          = '$terceirocurso',
                `qualgraduacao`     = '$qualgraduacao' 
                WHERE id_usuario    = '$id_usuario' ";
        if (mysqli_query($link, $sql)) {
            header('Location: ../fumec-form-2');
        } else {
            echo "Erro ao fazer UPDATE!";
        }
    } else {

        $sql = "INSERT INTO 
        `curso`(`id_usuario`, `graduacao`, `primeiro`, `segundo`, `terceiro`, `qualgraduacao`) 
        VALUES ('$id_usuario','$graduacao' ,'$primeirocurso' ,'$segundocurso', '$terceirocurso','$qualgraduacao')";

        $objDb = new db();
        $link = $objDb->conecta_mysql();

        if (mysqli_query($link, $sql)) {

            header('Location: ../fumec-form-2');
        } else {

            echo "Erro ao registrar o usuário!";
        }
    }
} else {
    echo 'Erro ao tentar localizar o registro de email';
}

// echo "1º Graduação: " . $graduacao . "  - " .$qualgraduacao." <BR>";
// echo '<BR>';
// echo "1º curso: " . $primeirocurso .    ' - '    . $turno1 . "<BR>";
// echo "2º curso: " . $segundocurso  .     ' - '    . $turno2 . "<BR>";
// echo "3º curso: " . $terceirocurso .    ' - '    . $turno3 . "<BR>";
// echo '<BR>';
// echo '***************************************<BR>';

// echo '<a href="../fumec-form-3"><h2>Proximo Formulario</h2></a>';
// echo '<a href="../fumec-form-2"><h2>Voltar</h2></a>';

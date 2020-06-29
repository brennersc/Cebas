<?php

require_once('gets/db_class.php');
require_once('gets/cursos.class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$curso = new Cursos();

$sql = "SELECT * FROM curso where id_usuario = '$id_usuario'";


$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

        $registro['graduacao']      = htmlspecialchars($registro['graduacao']);
        $registro['qualgraduacao']  = htmlspecialchars($registro['qualgraduacao']);
        $registro['primeiro']       = htmlspecialchars($registro['primeiro']);
        $registro['segundo']        = htmlspecialchars($registro['segundo']);
        $registro['terceiro']       = htmlspecialchars($registro['terceiro']);
        $registro['turno_primeiro']  = htmlspecialchars($registro['turno_primeiro']);
        $registro['turno_segundo']  = htmlspecialchars($registro['turno_segundo']);
        $registro['turno_terceiro'] = htmlspecialchars($registro['turno_terceiro']);

        switch ($registro['turno_terceiro']) {
            case ($registro['turno_terceiro'] === 'EaD1'): {
                    $registro['turno_terceiro'] = 'EaD';
                    break;
                }
            case ($registro['turno_terceiro'] === 'EaD2'): {
                    $registro['turno_terceiro'] = 'EaD';
                    break;
                }
                case ($registro['turno_terceiro'] === 'EaD3'): {
                    $registro['turno_terceiro'] = 'EaD';
                    break;
                }
        }
        switch ($registro['turno_segundo']) {
            case ($registro['turno_segundo'] === 'EaD1'): {
                    $registro['turno_segundo'] = 'EaD';
                    break;
                }
            case ($registro['turno_segundo'] === 'EaD2'): {
                    $registro['turno_segundo'] = 'EaD';
                    break;
                }
                case ($registro['turno_segundo'] === 'EaD3'): {
                    $registro['turno_segundo'] = 'EaD';
                    break;
                }
        }
        switch ($registro['turno_primeiro']) {
            case ($registro['turno_primeiro'] === 'EaD1'): {
                    $registro['turno_primeiro'] = 'EaD';
                    break;
                }
            case ($registro['turno_primeiro'] === 'EaD2'): {
                    $registro['turno_primeiro'] = 'EaD';
                    break;
                }
                case ($registro['turno_primeiro'] === 'EaD3'): {
                    $registro['turno_primeiro'] = 'EaD';
                    break;
                }
        }

        echo'<br>';
        echo'<span>Cursos</span>';
        echo'<div class="caixa">';
            echo'<div class="row">';
                echo'<div class="col-12 ">';
                    echo '<h5><b>Sua 1º graduação: </b> ' . $registro['graduacao'] .'</h5>';
                echo'</div>';
                echo'<div class="col-12 ">';
                    echo '<h5><b>Qual graduação possui: </b>' . $registro['qualgraduacao'] .'</h5>';
                echo'</div>';

                echo'<br><br>';
                echo'<div class="col-12 ">';
                    echo '<h5><b>Curso desejado:</b></h5>';
                echo'</div>';
                echo'<div class="col-12 ">';
                    echo '<h5><b>1º opção :</b> ' . $registro['primeiro'] . '</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo '<h5><b>2º opção :</b> ' . $registro['segundo'] . '</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo '<h5><b>3º opção :</b> ' . $registro['terceiro'] . '</h5>';
                echo'</div>';

            echo'</div>';
        echo'</div>';

    }
} else {
    echo '<div class="">';
    echo '<div class="row ">';
    echo '<div class="" class="col-sm-12">';
    echo '<h3><B>Nada encontrado</B></h3>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
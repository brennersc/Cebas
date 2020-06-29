<?php
require('gets/cursos.class.php');
$mostra = new Cursos;

//-------------------------------------------------------------------------------------	
//retorna select de cursos
$codigo_curso = isset($_GET['curso']) ? (int)$_GET['curso'] : null;

if (!empty($codigo_curso)) {
	$turnos = $mostra->selectTurnoJson($codigo_curso);
	print_r($turnos);
}
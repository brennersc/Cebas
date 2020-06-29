<?php
include_once('class/Candidato.php');
include_once('class/StatusEnum.php');
include_once('class/ReturnJason.php');

$idCandidato = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

if (isset($acao)) {
    try {
        $candidato = new Candidato();
        
        if ($acao === 'naoiniciado') {
            $candidato->atualizaStatus($idCandidato, StatusEnum::EmAnalise);
        }
        elseif ($acao === 'analise') {
            $candidato->atualizaStatus($idCandidato, StatusEnum::Aprovado);
        }
        elseif ($acao === 'aprovado') {
            $candidato->atualizaStatus($idCandidato, StatusEnum::Reprovado);
        }
        elseif ($acao === 'reprovado') {
            $candidato->atualizaStatus($idCandidato, StatusEnum::NaoIniciado);
        }

        $return = new ReturnJason(array('erro' => 0, 'mensagem' => '')); 
    } catch (Exception $e) {
        $return = new ReturnJason(array('erro' => 1, 'mensagem' => $e->getMessage())); 
    }
}
else {
    $return = new ReturnJason(array('erro' => 1, 'mensagem' => 'impossivel atualizar este registro')); 
}
echo json_encode($return);
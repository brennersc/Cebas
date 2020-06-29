<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastro?erro = 1');
}

require_once('db_class.php');

$objDb = new db();
$link = $objDb->conecta_mysql();

$cpf  =  strip_tags(trim(addslashes($_POST['cpf'])));

$cpfexiste = "SELECT cpf FROM cadastro where cpf = '$cpf' ";

$resultado_id = mysqli_query($link, $cpfexiste);

while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

    if($cpf  == $registro['cpf']){
        $retorno = array(
            'mensagem' => "O CPF informado já possui inscrição.",
            'sucesso' => 1
        );
        print_r(json_encode($retorno));
        exit();
    
    }

}

$retorno = array('sucesso' => 0);
print_r(json_encode($retorno));

// if($registro['cpf'] !=""){

//     echo("O CPF informado já possui inscrição.");

// }
?>
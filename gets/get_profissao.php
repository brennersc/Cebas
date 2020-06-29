<?php


session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastro?erro=1');
}

require_once('db_class.php');


if ($_POST['salario'] == '') {
    $_POST['salario'] = 0;
}
if ($_POST['renda'] == '') {
    $_POST['renda'] = 0;
}


$Unico          = strip_tags(trim(addslashes($_POST['Unico'])));
$profissao      = strip_tags(trim(addslashes($_POST['profissao'])));
$empresa        = strip_tags(trim(addslashes($_POST['empresa'])));
$salario        = strip_tags(trim(addslashes($_POST['salario'])));
$renda          = strip_tags(trim(addslashes($_POST['renda'])));
$result         = strip_tags(trim(addslashes($_POST['result'])));

$salario_formatado =  str_replace(',','', str_replace('.','', $salario));
$renda_formatado =  str_replace(',','', str_replace('.','', $renda));
$result = ($salario_formatado + $renda_formatado)/100;
$result = number_format($result,2, ',', '.');

//TESTE
/*
echo  'Salario ' .$salario  ;
echo '<br>';
echo  'Renda ' . $renda ;
echo '<br>';

echo 'Total '. $result;
echo '<br>';
*/

if (isset($_POST['nome'])) {
    $nome           = strip_tags(trim(addslashes($_POST['nome'])));
    $datanascimento = implode('-', array_reverse(explode('/', $_POST['datanascimento'])));
    $cpf            = strip_tags(trim(addslashes($_POST['cpf'])));
    $rg             = strip_tags(trim(addslashes($_POST['rg'])));
    $email          = strip_tags(trim(addslashes($_POST['email'])));
    $celular        = strip_tags(trim(addslashes($_POST['celular'])));
    $Telefone       = strip_tags(trim(addslashes($_POST['Telefone'])));
}

$id_usuario = $_SESSION['id_usuario'];


$objDb = new db();
$link = $objDb->conecta_mysql();

$sql  =  "SELECT * FROM profissao where id_usuario  =  '$id_usuario' ";

if ($resultado_id  =  mysqli_query($link, $sql)) {

    $dados_usuario  =  mysqli_fetch_array($resultado_id);

    if (isset($dados_usuario['id_usuario'])) {

        if (isset($_POST['nome'])) {
            $sql  =  "UPDATE profissao 
        SET 
        cadastrounico   = '$Unico',
        profissao       = '$profissao',
        empresa         = '$empresa',
        salario_bruto   = '$salario',
        outras_rendas   = '$renda',
        total           = '$result',

        nome            = '$nome',
        email           = '$email',
        data_nascimento = '$datanascimento',
        cpf             = '$cpf',
        num_identidade  = '$rg',
        celular         = '$celular',
        telefone        = '$Telefone'

        WHERE id_usuario  =  '$id_usuario' ";
        } else {
            $sql  =  "UPDATE profissao 
            SET 
            cadastrounico   = '$Unico',
            profissao       = '$profissao',
            empresa         = '$empresa',
            salario_bruto   = '$salario',
            outras_rendas   = '$renda',
            total           = '$result'

            WHERE id_usuario  =  '$id_usuario' ";
        }

        if (mysqli_query($link, $sql)) {
            header('Location: ../fumec-form-3');
        } else {
            echo $sql;

            echo "Erro ao fazer UPDATE!";
        }
    } else {

        if (isset($_POST['nome'])) {

            $sql = "INSERT INTO `profissao`
        (`id_usuario`, `cadastrounico`, `profissao`, `empresa`, `salario_bruto`, 
        `outras_rendas`, `total`, `nome`, `data_nascimento`, `num_identidade`, `cpf`, `email`, `celular`, 
        `telefone`) 
        VALUES ('$id_usuario','$Unico', '$profissao','$empresa','$salario','$renda','$result','$nome',
        '$datanascimento','$rg','$cpf','$email','$celular','$Telefone')";
        } else {

            $sql = "INSERT INTO `profissao`
            (`id_usuario`, `cadastrounico`, `profissao`, `empresa`, `salario_bruto`, 
            `outras_rendas`, `total`) 
            VALUES ('$id_usuario','$Unico', '$profissao','$empresa','$salario','$renda','$result')";
        }
        // echo $sql;
        // die();

        if (mysqli_query($link, $sql)) {
            header('Location: ../fumec-form-3');
        } else {

            echo "Erro ao registrar o usu�rio!";
        }
    }
} else {
    echo 'Erro ao tentar localizar o registro de email';
}
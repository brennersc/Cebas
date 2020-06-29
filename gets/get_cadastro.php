<?php


session_start();


if (date('d/m/Y') < '27/08/2019') {
    header('Location: ../login');
}

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastro?erro = 1');
}

require_once('db_class.php');

$objDb = new db();
$link = $objDb->conecta_mysql();

$nome            =  strip_tags(trim(addslashes($_POST['nome'])));
$email           =  strip_tags(trim(addslashes($_POST['email'])));
$datanascimento  =  implode('-', array_reverse(explode('/', $_POST['datanascimento'])));
$cpf             =  strip_tags(trim(addslashes($_POST['cpf'])));
$km              =  strip_tags(trim(addslashes($_POST['km'])));
$rg              =  strip_tags(trim(addslashes($_POST['rg'])));
$orgao           =  strip_tags(trim(addslashes($_POST['orgao'])));
$dataexpedicao   =  implode('-', array_reverse(explode('/', $_POST['dataexpedicao'])));
$Genero          =  strip_tags(trim(addslashes($_POST['Genero'])));
$EstadoCivil     =  strip_tags(trim(addslashes($_POST['EstadoCivil'])));
$celular         =  strip_tags(trim(addslashes($_POST['celular'])));
$Telefone        =  strip_tags(trim(addslashes($_POST['Telefone'])));
$cep             =  strip_tags(trim(addslashes($_POST['cep'])));
$cidade          =  strip_tags(trim(addslashes($_POST['cidade'])));
$uf              =  strip_tags(trim(addslashes($_POST['uf'])));
$bairro          =  strip_tags(trim(addslashes($_POST['bairro'])));
$rua             =  strip_tags(trim(addslashes($_POST['rua'])));
$numero          =  strip_tags(trim(addslashes($_POST['numero'])));
$complemento    =  strip_tags(trim(addslashes($_POST['complemento'])));

$id_usuario  =  $_SESSION['id_usuario'];


if ($nome  ==  '' || $email  ==  '' || $cpf  ==  '' || $datanascimento  == '' || $rg  == '' || $id_usuario  == '') {

    die();
}

$objDb  =  new db();
$link  =  $objDb->conecta_mysql();


$sql  =  "SELECT * FROM cadastro where id_usuario  =  '$id_usuario' ";

if ($resultado_id  =  mysqli_query($link, $sql)) {

    $dados_usuario  =  mysqli_fetch_array($resultado_id);

    if (isset($dados_usuario['id_usuario'])) {

        $sql  =  "UPDATE cadastro 
        SET 
        nome = '$nome',
        email = '$email',
        data_nascimento = '$datanascimento',
        cpf = '$cpf',
        km = '$km',
        num_identidade = '$rg',
        emissor = '$orgao',
        data_expedicao = '$dataexpedicao',
        sexo = '$Genero',
        estado_civil = '$EstadoCivil',
        celular = '$celular',
        telefone = '$Telefone',
        bairro = '$bairro',
        rua = '$rua',
        cidade = '$cidade',
        estado = '$uf',
        cep = '$cep',
        complemento = '$complemento',
        numero = '$numero'
        WHERE id_usuario  =  '$id_usuario' ";

        if (mysqli_query($link, $sql)) {
            header('Location: ../fumec-form');
        } else {

            echo "Erro ao fazer UPDATE!";
        }
    } else {

        $sql  =  "INSERT INTO `cadastro`(
        `id_usuario`, `nome`, `email`, `data_nascimento`, `cpf`, `km`, `num_identidade`, `emissor`, `data_expedicao`, 
        `sexo`, `estado_civil`, `celular`, `telefone`, `bairro`, `rua`, `cidade`, `estado`, `cep`, `complemento`, `numero`) 
        VALUES (
            '$id_usuario', '$nome', '$email', '$datanascimento','$cpf', '$km','$rg','$orgao','$dataexpedicao',
            '$Genero','$EstadoCivil','$celular','$Telefone','$bairro','$rua','$cidade', '$uf', '$cep', '$complemento','$numero'
        )";
        echo $sql;
        if (mysqli_query($link, $sql)) {
            header('Location: ../fumec-form');
        } else {

            echo "Erro ao registrar o usuário!";
        }
    }
} else {
    echo 'Erro ao tentar localizar o registro de email';
}

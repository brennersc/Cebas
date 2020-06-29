<?php

include_once('Candidato.php');

require_once('../../gets/db_class.php');

require('../../gets/cursos.class.php');

$cursos = new Cursos;

require_once('../../gets/db_class.php');

session_start();


$id = $_GET['id'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$id_funcionario   =  strip_tags(trim(addslashes($_POST['id_funcionario'])));


$ca_nome            =  strip_tags(trim(addslashes($_POST['ca_nome'])));
$email           =  strip_tags(trim(addslashes($_POST['email'])));
$datanascimento  =  implode('-', array_reverse(explode('/', $_POST['datanascimento'])));
$ca_cpf             =  strip_tags(trim(addslashes($_POST['ca_cpf'])));
$km              =  strip_tags(trim(addslashes($_POST['km'])));
$ca_rg              =  strip_tags(trim(addslashes($_POST['ca_rg'])));
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

/* ---------------------------------------------------------------------- */
$graduacao          = strip_tags(trim(addslashes($_POST['graduacao'])));
$qualgraduacao      = strip_tags(trim(addslashes($_POST['qualgraduacao'])));

$primeirocurso      = strip_tags(trim(addslashes($_POST['primeirocurso'])));
$segundocurso       = strip_tags(trim(addslashes($_POST['segundocurso'])));
$terceirocurso      = strip_tags(trim(addslashes($_POST['terceirocurso'])));
/* ---------------------------------------------------------------------- */
$Unico          = strip_tags(trim(addslashes($_POST['Unico'])));
$profissao      = strip_tags(trim(addslashes($_POST['profissao'])));
$empresa        = strip_tags(trim(addslashes($_POST['empresa'])));
$salario        = strip_tags(trim(addslashes($_POST['salario'])));
$renda_res      = strip_tags(trim(addslashes($_POST['renda_res'])));
$result         = strip_tags(trim(addslashes($_POST['result'])));

$nome_res           = strip_tags(trim(addslashes($_POST['nome_res'])));
$datanascimento_res = implode('-', array_reverse(explode('/', $_POST['datanascimento_res'])));
$cpf_res            = strip_tags(trim(addslashes($_POST['cpf_res'])));
$rg_res             = strip_tags(trim(addslashes($_POST['rg_res'])));
$email_res          = strip_tags(trim(addslashes($_POST['email_res'])));
$celular_res        = strip_tags(trim(addslashes($_POST['celular_res'])));
$Telefone_res       = strip_tags(trim(addslashes($_POST['Telefone_res'])));


// echo $id . '<br>';
// echo $ca_nome . '<br>';
// echo $email . '<br>';
// echo $datanascimento . '<br>';
// echo $ca_cpf . '<br>';
// echo $km . '<br>';
// echo $ca_rg . '<br>';
// echo $orgao . '<br>';
// echo $dataexpedicao . '<br>';
// echo $Genero . '<br>';
// echo $EstadoCivil . '<br>';
// echo $celular . '<br>';
// echo $Telefone . '<br>';
// echo $cep . '<br>';
// echo $cidade . '<br>';
// echo $uf . '<br>';
// echo $bairro . '<br>';
// echo $rua . '<br>';
// echo $numero . '<br>';
// echo $complemento . '<br>';

// echo '***************************************<BR>';

// echo $graduacao . '<br>';
// echo $qualgraduacao . '<br>';
// echo $primeirocurso . '<br>';
// echo $segundocurso . '<br>';
// echo $terceirocurso . '<br>';

// echo '***************************************<BR>';

// echo $Unico . '<br>';
// echo $profissao . '<br>';
// echo $empresa . '<br>';
// echo $salario . '<br>';
// echo $renda_res . '<br>';
// echo $result . '<br>';
// echo $nome_res . '<br>';
// echo $datanascimento_res . '<br>';
// echo $cpf_res . '<br>';
// echo $rg_res . '<br>';
// echo $email_res . '<br>';
// echo $celular_res . '<br>';
// echo $Telefone_res . '<br>';

// echo '***************************************<BR>';

// foreach ($_POST["nome"] as $key => $nome) {

//     echo "Nome: "           . $nome . "<BR>";
//     echo "ID: "             . strip_tags(trim(addslashes($_POST['id'][$key]))) . "<BR>";
//     echo "CPF: "            . strip_tags(trim(addslashes($_POST['cpf'][$key]))) . "<BR>";
//     echo "rg: "             . strip_tags(trim(addslashes($_POST['rg'][$key])))  . "<BR>";
//     echo "ocupacao: "       . strip_tags(trim(addslashes($_POST['ocupacao'][$key]))) . "<BR>";
//     echo "renda: "          . strip_tags(trim(addslashes($_POST['renda'][$key]))) . "<BR>";
//     echo "outras: "         . strip_tags(trim(addslashes($_POST['outrasrenda'][$key]))) . "<BR>";
//     echo "qual: "           . strip_tags(trim(addslashes($_POST['qual'][$key]))) . "<BR>";
//     echo '***************************************<BR>';
// }
$sql = "UPDATE usuario SET email = '$email' WHERE id =  '$id' ";

if (mysqli_query($link, $sql)) {
    // echo '***************************************<BR>';
    // echo $sql . '<br>';
    // echo '***************************************<BR>';
    // echo  'SUCESSO !!! <BR>';
} else {

    echo "Erro ao fazer UPDATE - id funcionario !";
}

/* ---------------------------------------------------------------------- */

$sql = "UPDATE usuario SET id_funcionario = '$id_funcionario' WHERE id =  '$id' ";

if (mysqli_query($link, $sql)) {
    // echo '***************************************<BR>';
    // echo $sql . '<br>';
    // echo '***************************************<BR>';
    // echo  'SUCESSO !!! <BR>';
} else {

    echo "Erro ao fazer UPDATE - id funcionario !";
}

/* ---------------------------------------------------------------------- */
$sql  =  "UPDATE cadastro 
            SET 
            nome = '$ca_nome',
            email = '$email',
            data_nascimento = '$datanascimento',
            cpf = '$ca_cpf',
            km = '$km',
            num_identidade = '$ca_rg',
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
            WHERE id_usuario  =  '$id' ";

if (mysqli_query($link, $sql)) {
    // echo '***************************************<BR>';
    // echo $sql . '<br>';
    // echo '***************************************<BR>';
    // echo  'SUCESSO !!! <BR>';
} else {

    echo "Erro ao fazer UPDATE - CADASTRO !";
}
/* ---------------------------------------------------------------------- */
$sql  =  "UPDATE curso SET 
                `graduacao`         = '$graduacao',
                `primeiro`          = '$primeirocurso',
                `segundo`           = '$segundocurso',
                `terceiro`          = '$terceirocurso',
                `qualgraduacao`     = '$qualgraduacao' 
                WHERE id_usuario    = '$id' ";

if (mysqli_query($link, $sql)) {
    // echo '***************************************<BR>';
    // echo $sql . '<br>';
    // echo '***************************************<BR>';
    // echo  'SUCESSO !!! <BR>';
} else {
    echo "Erro ao fazer UPDATE - CURSO!";
}
/* ---------------------------------------------------------------------- */


$sql_pro  =  "UPDATE profissao 
        SET 
        cadastrounico   = '$Unico',
        profissao       = '$profissao',
        empresa         = '$empresa',
        salario_bruto   = '$salario',
        outras_rendas   = '$renda_res',
        total           = '$result',

        nome            = '$nome_res',
        email           = '$email_res',
        data_nascimento = '$datanascimento_res',
        cpf             = '$cpf_res',
        num_identidade  = '$rg_res',
        celular         = '$celular_res',
        telefone        = '$Telefone_res'

        WHERE id_usuario  =  '$id' ";

if (mysqli_query($link, $sql_pro)) {
    // echo '***************************************<BR>';
    // echo $sql_pro . '<br>';
    // echo '***************************************<BR>';
    // echo  'SUCESSO !!! <BR>';
} else {
    echo "Erro ao fazer UPDATE - PROFISSAO!";
}
/* ---------------------------------------------------------------------- */

$sql = "DELETE FROM `familiares` WHERE id_usuario = '$id'";

mysqli_query($link, $sql);

foreach ($_POST["nome"] as $key => $nome) {

    $id_familiares  =  strip_tags(trim(addslashes($_POST['id_familiares'][$key])));
    $cpf            =  strip_tags(trim(addslashes($_POST['cpf'][$key])));
    $rg             =  strip_tags(trim(addslashes($_POST['rg'][$key])));
    $ocupacao       =  strip_tags(trim(addslashes($_POST['ocupacao'][$key])));
    $renda          =  strip_tags(trim(addslashes($_POST['renda'][$key])));
    $outrasrenda    =  strip_tags(trim(addslashes($_POST['outrasrenda'][$key])));
    $qual           =  strip_tags(trim(addslashes($_POST['qual'][$key])));

    $sql = "INSERT INTO `familiares`( `id_usuario`, `nome`, `rg`, `cpf`, `ocupacao`, `renda`,`outrasrenda`,`qual`) 

                    VALUES ('$id','$nome','$rg',' $cpf',' $ocupacao ',' $renda','$outrasrenda','$qual')";

    if (mysqli_query($link, $sql)) {
        // echo '***************************************<BR>';
        // echo $sql . '<br>';
        // echo '***************************************<BR>';
        // echo  'SUCESSO !!! <BR>';
    } else {
        echo "Erro ao fazer UPDATE - FAMILIARES!";
    }
}

header('Location: ../editar?id=' . $id . '&salvo=1');
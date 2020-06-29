<?php
session_start();

require_once('db_class.php');

$email          = strip_tags(trim(addslashes($_POST['email'])));
$termos_de_uso  = strip_tags(trim(addslashes($_POST['remember'])));    //$_POST['termos_de_uso'];
$senha          = strip_tags(trim(addslashes(md5($_POST['password']))));        //md5($_POST['senha']);
$senhaConfirma  = strip_tags(trim(addslashes(md5($_POST['PasswordCheck']))));    //md5($_POST['senhaConfirma']);


if ($email == '' || $termos_de_uso == '' || $senha == '' || $senhaConfirma == '') {

    header('Location: cadastro?preencher=1');

    die();
}

$objDb = new db();
$link = $objDb->conecta_mysql();
$email_existe = false;

//verificar se o e-mail já existe
$sql = "SELECT * FROM usuario WHERE email = '$email' ";

if ($resultado_id = mysqli_query($link, $sql)) {

    $dados_usuario = mysqli_fetch_array($resultado_id);

    if (isset($dados_usuario['email'])) {

        $email_existe = true;
    }
} else {
    echo 'Erro ao tentar localizar o registro de email ';
}

if ($email_existe) {

    $retorno_get = '';

    if ($email_existe) {
        $retorno_get .= "erro_email=1&";
    }

    header('Location: ../cadastro?' . $retorno_get);
    //echo 'Erro email existe';
    die();
}

//verificar senhas
if ($senha == $senhaConfirma) {

    $sql = "INSERT INTO usuario (email, senha, termos_de_uso) VALUES ('$email', '$senha', '$termos_de_uso')";

    //executar a query
    if (mysqli_query($link, $sql)) {

        $sql = 0;
        $resultado_id = 0;
        $dados_usuario = 0;
        $_SESSION['id_usuario'] = 0;

        $sql = " SELECT id, email FROM usuario WHERE email = '$email' AND senha = '$senha' ";

        $resultado_id = mysqli_query($link, $sql);

        if ($resultado_id) {

            $dados_usuario = mysqli_fetch_array($resultado_id);

            if (isset($dados_usuario['email'])) {

                $_SESSION['id_usuario'] = $dados_usuario['id'];
                $_SESSION['email'] = $dados_usuario['email'];

                    header('Location: ../fumec-form');

            } else {
                header('Location: ../index?erro=1');
            }
        } else {

            echo "Erro ao LOGAR!";
        }
    } else {

        echo "Erro ao EXECUTAR A QUERY!";
    }
} else {
    echo "ERRO SENHAS DIFERENTES";
}

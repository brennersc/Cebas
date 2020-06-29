<?php

include_once('class/Funcionario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $senha = SHA1($senha);

    $funcionario = new Funcionario();
    $func = $funcionario->login($login, $senha);
    if($func == TRUE){
        header('location:dashboard.php');
    }else{
        header('location:index.php?msg=010');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'logout') {
    
    $funcionario = new Funcionario();
    $func = $funcionario->logout();
    
}

 



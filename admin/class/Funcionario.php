<?php

include('Connection.php');

class Funcionario extends Connection
{

    public function login($login, $senha)
    {

        $sql = "SELECT * FROM funcionario WHERE login = '$login' and pass = '$senha'";
        $query = Connection::conect()->query($sql);

        if ($query->num_rows > 0) {
            $funcionario = $query->fetch_object();
            session_start();
            $_SESSION["id"] = $funcionario->id;
            $_SESSION["name"] = $funcionario->nome;
            return true;
        } else {
            return false;
        }

    }

    public function logout(){
        session_start();
        session_destroy();
        header('location:index.php');
    }
}
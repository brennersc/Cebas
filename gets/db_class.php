<?php

    class db {

        //host
        //private $host = 'nadia';
        private $host = 'localhost';

        //usuario
        //private $usuario = 'cebas';
        private $usuario = 'root';

        //senha
        //private $senha = '4G!yw4WqqG#A';
        private $senha = '';

        //banco de dados
        private $database = 'cebas';

        public function conecta_mysql(){

            //criar conexao
            $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

            mysqli_set_charset($con, 'utf8');

            if(mysqli_connect_errno()){
                echo 'Erro ao tentar se conectar com BD MySQL: ' . mysqli_connect_error();
            }

            return $con;

        }

    }

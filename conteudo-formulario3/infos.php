<?php

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT * ,DATE_FORMAT(p.data_nascimento, '%d/%m/%Y') as data_ FROM profissao p where id_usuario = '$id_usuario'";


$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

        $registro['cadastrounico']      = htmlspecialchars($registro['cadastrounico']);
        $registro['profissao']          = htmlspecialchars($registro['profissao']);
        $registro['empresa']            = htmlspecialchars($registro['empresa']);
        $registro['salario_bruto']      = htmlspecialchars($registro['salario_bruto']);
        $registro['outras_rendas']      = htmlspecialchars($registro['outras_rendas']);
        $registro['total']              = htmlspecialchars($registro['total']);
        $registro['nome']               = htmlspecialchars($registro['nome']);
        $registro['data_nascimento']    = htmlspecialchars($registro['data_nascimento']);
        $registro['cpf']                = htmlspecialchars($registro['cpf']);
        $registro['num_identidade']     = htmlspecialchars($registro['num_identidade']);
        $registro['email']              = htmlspecialchars($registro['email']);
        $registro['celular']            = htmlspecialchars($registro['celular']);
        $registro['telefone']           = htmlspecialchars($registro['telefone']);

        echo'<br>';
        echo'<span>Informações Adicionais</span>';

        echo'<div class="caixa">';
        
            echo'<div class="row">';
                
                if($registro['cadastrounico'] == ''){
                    $possui = 'Não possui cadastro único';
                }else{
                    $possui = 'Possui cadastro único';
                }
                echo'<div class="col-12">';
                    echo'<h5><b>Possui Cadastro Único: </b> '.$possui.'.</h5>';
                echo'</div>';

                echo'<div class="col-12">';
                    echo'<h5><b>Nº Cadastro Único:</b> '.$registro['cadastrounico'].'</h5>';
                echo'</div>';
            
                echo'<div class="col-12">';
                    echo'<h5><b>Profissão:</b> '.$registro['profissao'].'</h5>';
                echo'</div>';

                echo'<div class="col-12">';
                    echo'<h5><b>Empresa:</b> '.$registro['empresa'].'</h5>';
                echo'</div>';
            
                echo'<div class="col-12">';
                    echo'<h5><b>Salario Bruto:</b> '.$registro['salario_bruto'].'</h5>';
                echo'</div>';

                echo'<div class="col-12">';
                    echo'<h5><b>Outras Rendas:</b> '.$registro['outras_rendas'].'</h5>';
                echo'</div>';

                echo'<div class="col-12">';
                    echo'<h5><b>Total:</b> '.$registro['total'].'</h5>';
                echo'</div>';

            echo'</div>';

        echo'</div>';
//--------------------------------------------------------------------------------        
        if($registro['nome'] != ''){
            echo'<span>Responsável legal</span>';
            
            echo'<div class="caixa">';
            
                echo'<div class="row">';

                    echo'<div class="col-12">';
                        echo'<h5><b>Nome:</b> '.$registro['nome'].'</h5>';
                    echo'</div>';

                    echo'<div class="col-12">';
                        echo'<h5><b>Data de Nascimento:</b> '.$registro['data_'].'</h5>';
                    echo'</div>';

                    echo'<div class="col-12 ">';
                        echo'<h5><b>CPF:</b> '.$registro['cpf'].'</h5>';
                    echo'</div>';

                    echo'<div class="col-12 ">';
                        echo'<h5><b>Nº Identidade: </b> '.$registro['num_identidade'].'</h5>';
                    echo'</div>';

                    echo'<div class="col-12 ">';
                        echo'<h5><b>Email:</b> '.$registro['email'].'</h5>';
                    echo'</div>';

                    echo'<div class="col-12 ">';
                        echo'<h5><b>Celular:</b> '.$registro['celular'].'</h5>';
                    echo'</div>';

                    echo'<div class="col-12 ">';
                        echo'<h5><b>Telefone:</b> '.$registro['telefone'].'</h5>';
                    echo'</div>';

                echo'</div>';
                
            echo'</div>';
        }
//--------------------------------------------------------------------------------
    }
} else {
    echo '<div class="">';
        echo '<div class="row ">';
            echo '<div class="" class="col-sm-12">';
                echo '<h3><B><center>Erro na consulta de Anuncios no banco de dados!</center></B></h3>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

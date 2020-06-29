<?php

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT * ,DATE_FORMAT(c.data_nascimento, '%d/%m/%Y') as data_ ,DATE_FORMAT(c.data_expedicao, '%d/%m/%Y') as data_e FROM cadastro c where id_usuario = '$id_usuario'";


$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

        $registro['nome']           = htmlspecialchars($registro['nome']);
        $registro['email']          = htmlspecialchars($registro['email']);
        $registro['data_nascimento']= htmlspecialchars($registro['data_nascimento']);
        $registro['cpf']            = htmlspecialchars($registro['cpf']);
        $registro['km']             = htmlspecialchars($registro['km']);
        $registro['num_identidade'] = htmlspecialchars($registro['num_identidade']);
        $registro['emissor']        = htmlspecialchars($registro['emissor']);
        $registro['data_expedicao'] = htmlspecialchars($registro['data_expedicao']);
        $registro['sexo']           = htmlspecialchars($registro['sexo']);
        $registro['estado_civil']   = htmlspecialchars($registro['estado_civil']);
        $registro['celular']        = htmlspecialchars($registro['celular']);
        $registro['telefone']       = htmlspecialchars($registro['telefone']);
        $registro['bairro']         = htmlspecialchars($registro['bairro']);
        $registro['rua']            = htmlspecialchars($registro['rua']);
        $registro['cidade']         = htmlspecialchars($registro['cidade']);
        $registro['estado']         = htmlspecialchars($registro['estado']);
        $registro['cep']            = htmlspecialchars($registro['cep']);
        $registro['complemento']    = htmlspecialchars($registro['complemento']);
        $registro['numero']         = htmlspecialchars($registro['numero']);

        echo'<br>';
        echo'<span>Dados Pessoais</span>';

        echo'<div class="caixa">';
            echo'<div class="row">';
                echo'<div class="col-12 ">';
                    echo'<h5><b>Nome:</b> '.$registro['nome'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Data de Nascimento:</b> '.$registro['data_'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>CPF:</b> '.$registro['cpf'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Gênero:</b> '.$registro['sexo'].'</h5>';
                echo'</div>';


                echo'<div class="col-12 ">';
                    echo'<h5><b>Nº Identidade:</b> '.$registro['num_identidade'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Órgão Emissor:</b> '.$registro['emissor'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Data de Expedição:</b> '.$registro['data_e'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Estado Civil:</b> '.$registro['estado_civil'].'</h5>';
                echo'</div>';
            echo'</div>';
        echo'</div>';
//--------------------------------------------------------------------------------  
        
        echo'<span>Endereço</span>';

        echo'<div class="caixa">';
            echo'<div class="row">';
                echo'<div class="col-12 ">';
                    echo'<h5><b>CEP:</b> '.$registro['cep'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Estado:</b> '.$registro['estado'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Cidade:</b> '.$registro['cidade'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Rua:</b> '.$registro['rua'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Nº:</b> '.$registro['numero'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                echo'<h5><b>Complemento:</b>'.$registro['complemento'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Bairro:</b> '.$registro['bairro'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Km de distância da FUMEC:  </b> ' .$registro['km'].' km</h5>';
                echo'</div>';
            echo'</div>';
        echo'</div>';
//--------------------------------------------------------------------------------  
        
        echo'<span>Dados Pessoais</span>';

        echo'<div class="caixa">';
            echo'<div class="row">';
                echo'<div class="col-12 ">';
                    echo'<h5><b>Celular:</b> '.$registro['celular'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Telefone:</b> '.$registro['telefone'].'</h5>';
                echo'</div>';

                echo'<div class="col-12 ">';
                    echo'<h5><b>Email:</b> '.$registro['email'].'</h5>';
                echo'</div>';
            echo'</div>';
        echo'</div>';
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
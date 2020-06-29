<?php

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

// $sql = "SELECT * FROM familiares where id_usuario = '$id_usuario'";


// $sql = "SELECT u.id, u.email, ca.nome, ca.km, ca.celular, ca.telefone, p.cadastrounico, ca.data_cadastro, 
// tf.total_familia, rf.renda_familia, rf.outra_renda_familia, p.total,

// ( rf.renda_familia + rf.outra_renda_familia + replace(replace(p.total, '.',''),',','.') ) AS renda_percapta

// FROM usuario u 
// left join cadastro ca on u.id = ca.id_usuario 
// left join profissao p on u.id = p.id_usuario
// LEFT JOIN (SELECT COUNT(nome) AS total_familia, id_usuario FROM familiares where nome != '' GROUP BY id_usuario) AS tf ON u.id = tf.id_usuario
// LEFT JOIN (SELECT SUM(replace(replace(renda, '.',''),',','.')) AS renda_familia, SUM(replace(replace(outrasrenda, '.',''),',','.')) AS outra_renda_familia, id_usuario 
// FROM familiares GROUP BY id_usuario) AS rf ON u.id = rf.id_usuario where ca.id_usuario is not null
// ORDER BY ca.id_usuario DESC";

$sql = "SELECT u.id, f.nome, f.rg, f.cpf, f.ocupacao, f.renda, f.outrasrenda, f.qual, tf.total_familia, rf.renda_familia, rf.outra_renda_familia, p.total, 
( rf.renda_familia + rf.outra_renda_familia + replace(replace(p.total, '.',''),',','.') ) 
AS renda_percapta 
FROM usuario u 
left join familiares f on u.id = f.id_usuario 
left join profissao p on u.id = p.id_usuario 
LEFT JOIN (SELECT COUNT(nome) AS total_familia, id_usuario 
FROM familiares where nome != '' GROUP BY id_usuario) AS tf ON u.id = tf.id_usuario 
LEFT JOIN (SELECT SUM(replace(replace(renda, '.',''),',','.')) 
AS renda_familia, SUM(replace(replace(outrasrenda, '.',''),',','.')) 
AS outra_renda_familia, id_usuario 
FROM familiares GROUP BY id_usuario) 
AS rf ON u.id = rf.id_usuario 
where f.id_usuario is not null  and f.id_usuario = '$id_usuario'";




$resultado_id = mysqli_query($link, $sql);



if ($resultado_id) {
    echo '<span>Grupo Familiar</span>';
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

        $registro['nome']           = htmlspecialchars($registro['nome']);
        $registro['rg']             = htmlspecialchars($registro['rg']);
        $registro['cpf']            = htmlspecialchars($registro['cpf']);
        $registro['ocupacao']       = htmlspecialchars($registro['ocupacao']);
        $registro['renda']          = htmlspecialchars($registro['renda']);
        $registro['outrasrenda']    = htmlspecialchars($registro['outrasrenda']);
        $registro['qual']           = htmlspecialchars($registro['qual']);


        $total = $registro['renda_percapta'];
        $qnt = ($registro['total_familia'] + 1);

        $percapta = ($total / $qnt);

        if ($registro['nome'] != '') {
            echo '<div class="caixa">';

            echo '<div class="row">';

            echo '<div class="col-12">';
            echo '<h5><b>Nome:</b> ' . $registro['nome'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12">';
            echo '<h5><b>CPF:</b> ' . $registro['cpf'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Nº Identidade:</b> ' . $registro['rg'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Profissão: </b> ' . $registro['ocupacao'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Renda Bruta Mensal: </b> ' . $registro['renda'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Renda Bruta Mensal: </b> ' . $registro['outrasrenda'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Grau Parentesco: </b> ' . $registro['qual'] . '</h5>';
            echo '</div>';

            echo '</div>';

            echo '</div>';
            //--------------------------------------------------------------------------------
            echo '<hr>';
        } else {
            echo '<div class="caixa">';

            echo '<div class="row">';

            echo '<div class="col-12">';
            echo '<h5><b>Nome:</b> Dados não cadastrados</h5>';
            echo '</div>';

            echo '<div class="col-12">';
            echo '<h5><b>CPF:</b> ' . $registro['cpf'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Nº Identidade:</b> ' . $registro['rg'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Profissão: </b> ' . $registro['ocupacao'] . '</h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Renda Bruta Mensal: </b></h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Renda Bruta Mensal: </b></h5>';
            echo '</div>';

            echo '<div class="col-12 ">';
            echo '<h5><b>Grau Parentesco: </b></h5>';
            echo '</div>';

            echo '</div>';

            echo '</div>';
        }
    }
    if ($registro['qual'] != '') {
    echo '<div class="caixa">';

    echo '<div class="row">';

    echo '<div class="col-12">';
    echo '<h5><b>Quantidade de pessoas no grupo familiar:</b> ' . $qnt . '</h5>';
    echo '</div>';

    echo '<div class="col-12">';
    echo '<h5><b>Renda per capita: </b> R$ ' . number_format($percapta, 2, ',', '.') . '</h5>';
    echo '</div>';

    echo '</div>';

    echo '</div>';
    }
} else {
    echo '<div class="">';
    echo '<div class="row ">';
    echo '<div class="" class="col-sm-12">';
    echo '<h3><B>
                                    <center>Erro na consulta de Anuncios no banco de dados!</center>
                                </B></h3>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

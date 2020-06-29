<?php

include 'Connection.php';

class Candidato extends Connection
{

    public function __construct()
    {
        //echo "<h3>ATENÇÃO: A validação da sessao esta desabilitada!</h3>";
        $this->validaSessaoFuncionario();
    }

    public function buscaCandidatos($filtro = null)
    {
        // $sql = "SELECT u.id, u.email, ca.nome, ca.km, ca.celular, ca.telefone, p.cadastrounico, ca.data_cadastro,
        // tf.total_familia, rf.renda_familia, rf.outra_renda_familia, ((rf.renda_familia + rf.outra_renda_familia) / tf.total_familia) AS renda_percapta
        // FROM usuario u
        // left join cadastro ca on u.id = ca.id_usuario
        // left join profissao p on u.id = p.id_usuario
        // LEFT JOIN (SELECT COUNT(*) AS total_familia, id_usuario FROM familiares GROUP BY id_usuario) AS tf ON u.id = tf.id_usuario
        // LEFT JOIN (SELECT SUM(renda) AS renda_familia, SUM(outrasrenda) AS outra_renda_familia, id_usuario FROM familiares GROUP BY id_usuario) AS rf ON u.id = rf.id_usuario
        // ORDER BY ca.id_usuario DESC"; (rf.renda_familia + rf.outra_renda_familia + total) / (tf.total_familia + 1)

        $sql = "SELECT u.status, u.id, u.email, ca.nome, ca.cpf, ca.km, ca.celular, ca.telefone, p.cadastrounico, ca.data_cadastro,
        tf.total_familia, rf.renda_familia, rf.outra_renda_familia, p.total, cu.primeiro, cu.turno_primeiro, cu.graduacao,
        ( rf.renda_familia + rf.outra_renda_familia + replace(replace(p.total, '.',''),',','.') ) AS renda_percapta
        FROM usuario u

        inner join cadastro ca on u.id = ca.id_usuario
        left join curso cu on u.id = cu.id_usuario

        left join profissao p on u.id = p.id_usuario
        LEFT JOIN (SELECT COUNT(nome) AS total_familia, id_usuario FROM familiares where nome != '' GROUP BY id_usuario) AS tf ON u.id = tf.id_usuario
        LEFT JOIN (SELECT SUM(replace(replace(renda, '.',''),',','.')) AS renda_familia, SUM(replace(replace(outrasrenda, '.',''),',','.')) AS outra_renda_familia, id_usuario
        FROM familiares GROUP BY id_usuario) AS rf ON u.id = rf.id_usuario
        WHERE ca.id_usuario is not null";

        /*
        if(!empty($filtro['renda'])){
        $sql .= " AND (rf.renda_familia + rf.outra_renda_familia + REPLACE( REPLACE(p.total, '.',''),',','.'))  <= ".$filtro['renda'];
        }
        if(!empty($filtro['status'])){
        $sql .= " AND u.status = ".$filtro['status'];
        }
        if(!empty($filtro['graduacao'])){
        $sql .= " AND cu.graduacao = '".$filtro['graduacao']."'";
        }
        if(!empty($filtro['cadastrounico'])){
        if($filtro['cadastrounico'] == "Sim"){
        $sql .= " AND LENGTH(p.cadastrounico) > 5";
        }else{
        $sql .= " AND LENGTH(p.cadastrounico) < 5";
        }
        }
         */

        if(!empty($filtro['status'])){
            $sql .= " AND u.status = ".$filtro['status'];
        }

        //Esquema para a combo de perfil!
        if (!empty($filtro['perfil'])) {
            if ($filtro['perfil'] == 1) {
                $sql .= " AND (((rf.renda_familia + rf.outra_renda_familia + REPLACE( REPLACE(p.total, '.',''),',','.')) / (tf.total_familia + 1)) > 1500 OR (SELECT COUNT(*) from familiares where id_usuario = u.id) = 0 OR (cu.graduacao = 'Não'))";
            } else {
                $sql .= " AND (((rf.renda_familia + rf.outra_renda_familia + REPLACE( REPLACE(p.total, '.',''),',','.')) / (tf.total_familia + 1)) <= 1500 AND (SELECT COUNT(*) from familiares where id_usuario = u.id) > 0) ";
            }
        }

        $sql .= " ORDER BY ca.id_usuario DESC";

        //echo $sql;
        //exit();

        if ($query = Connection::conect()->query($sql)) {
            while ($obj = $query->fetch_object()) {
                $listagem[] = $obj;
            };
            return $listagem;
        } else {
            return "Banco de dados inacessível";
        }
    }

    public function atualizaStatus($id, $status_code)
    {
        $sql = "UPDATE usuario set status = $status_code, id_funcionario = " . $_SESSION["id"] . " WHERE id = $id";
        if(!Connection::conect()->query($sql))
            throw new Exception("Impossivel atualizar o registro");
    }

    public function validaSessaoFuncionario()
    {
        session_start();
        if (!isset($_SESSION['id']) or !isset($_SESSION['name'])) {
            header('location:index.php');
        }
    }
}

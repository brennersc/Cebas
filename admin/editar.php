<?php


include_once('class/Candidato.php');

require_once('../gets/db_class.php');

require('../gets/cursos.class.php');

$cursos = new Cursos;

require_once('../gets/db_class.php');

$id = $_GET['id'];

//echo $id;
session_start();

$_SESSION["id"];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT
u.email             as u_email,

ca.nome             as ca_nome,
ca.data_nascimento  as ca_data_nascimento,
ca.cpf              as ca_cpf,
ca.km,
ca.num_identidade   as ca_num_identidade,
ca.emissor,
ca.data_expedicao  as ca_data_expedicao,
ca.sexo,
ca.estado_civil,
ca.celular          as ca_celular ,
ca.telefone         as ca_telefone,
ca.bairro,
ca.rua,
ca.cidade,
ca.estado,
ca.cep,
ca.complemento,
ca.numero,

cu.graduacao,
cu.primeiro,
cu.segundo,
cu.terceiro,
cu.qualgraduacao,

p.profissao,
p.empresa,
p.salario_bruto,
p.outras_rendas,
p.total,
p.cadastrounico,
p.nome              as p_nome,
p.email             as p_email,
p.data_nascimento   as p_data_nascimento,
p.cpf               as p_cpf,
p.celular           as p_celular,
p.telefone          as p_telefone,
p.num_identidade    as p_num_identidade,

fa.nome,
fa.rg,
fa.cpf,
fa.ocupacao,
fa.renda,
fa.qual,
fa.outrasrenda

FROM 
usuario u 
left join cadastro ca 		on u.id = ca.id_usuario
left join curso cu 			on u.id = cu.id_usuario
left join profissao p 		on u.id = p.id_usuario
left join familiares fa 	on u.id = fa.id_usuario 

where u.id = '$id' ";

$resultado_id = mysqli_query($link, $sql);

$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);


$salvo = isset($_GET['salvo']) ? $_GET['salvo'] : 0;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="vendor/css/bootadmin.min.css">
    <link rel="stylesheet" href="vendor/libraries/datatable/css/datatable.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <title>CEBAS</title>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <!--  <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>-->
        <a class="navbar-brand" href="./index"><img src="img/logo-fumec-vertical-branca.png" style="height:35px"><b>CEBAS</b></a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['name'] ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="login.php?action=logout" class="dropdown-item">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">

        <div class="content p-4">
        <?php if($salvo == 1){echo'
                 <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <center>DADOS SALVOS COM SUCESSO!</center>
                </div><br>';
                 } ?>
            <h2 class="mb-4">CANDIDATO - <?= $registro['ca_nome']?> </h2>
            <a href="./dashboard.php"><button type="" class="btn btn-info float-right" style="margin-top: -50px;"> Voltar </button></a>

            <div class="card mb-4">
                <div class="card-body">
                    <form id="signupForm" method="post" action='class/get_alterar?id=<?= $id ?>'>
                    <input type="hidden" class="form-control campo " id="id_funcionario" name="id_funcionario" value="<?= $_SESSION["id"] ?>" readonly>
                        <span>Dados Pessoais</span>
                        <div class="caixa">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 form-group">
                                    <label class="form-control-label" for="inputUserName">Nome Completo: </label>
                                    <input type="text" class="form-control" id="nome" name="ca_nome" value="<?= $registro['ca_nome'] ?>" letterswithbasicpunc="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$">
                                </div>
                                <div class="col-sm-12  col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">Data de Nascimento: </label>
                                    <input type="text" class="form-control data" id="datanascimento" name="datanascimento" value="<?= date("d/m/Y", strtotime($registro['ca_data_nascimento'])) ?>" maxlength="10">
                                </div>
                                <div class="col-sm-12  col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">CPF: </label>
                                    <input type="text" class="cpf form-control" name='ca_cpf' onblur="validarCpf()" id='cpf' maxlength='15' value="<?= $registro['ca_cpf'] ?>" placeholder='Ex.: 000-000-000.00'>
                                </div>
                                <div class="col-sm-12 col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">Gênero: </label>
                                    <select class="form-control" name="Genero" data-fv-notempty="true" data-fv-field="requiredSelect">
                                        <?php
                                        echo '<option value="" disabled>Gênero</option>';
                                        $arr = array(
                                            'masculino'      => 'Masculino',
                                            'feminino'       => 'Feminino',
                                            'naodefinido'    => 'Não definido'
                                        );
                                        foreach ($arr as $key => $sexo) {
                                            $selected = ($registro['sexo'] == $key) ? 'selected = "selected"' : '';
                                            echo '<option ' . $selected . ' value="' . $key . '">' . $sexo . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Nº Identidade: </label>
                                    <input type="text" class="form-control" id="rg" name="ca_rg" maxlength='10' value="<?= $registro['ca_num_identidade'] ?>">
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Órgão Emissor: </label>
                                    <input type="text" class="form-control letras" id="orgao" name="orgao" maxlength='10' value="<?= $registro['emissor'] ?>" lettersonly="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$">
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Data de Expedição: </label>
                                    <input type="text" class="form-control data" name="dataexpedicao" id="dataexpedicao" value="<?= date("d/m/Y", strtotime($registro['ca_data_expedicao'])) ?>" maxlength="10">
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Estado Civil: </label>
                                    <select class="form-control" name="EstadoCivil" data-fv-notempty="true" data-fv-field="requiredSelect">

                                        <?php
                                        echo '<option value="" disabled>Selecione...</option>';
                                        $arr = array(
                                            'solteiro'      => 'Solteiro',
                                            'casado'        => 'Casado',
                                            'separado'      => 'Separado',
                                            'divorciado'    => 'Divorciado',
                                            'uniaoestavel'  => 'União Estável',
                                            'viuvo'         => 'Viúvo'
                                        );
                                        foreach ($arr as $key => $EstadoCivil) {
                                            $selected = ($registro['estado_civil'] == $key) ? 'selected = "selected"' : '';
                                            echo '<option ' . $selected . ' value="' . $key . '">' . $EstadoCivil . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <span>Endereço</span>
                        <div class="caixa">
                            <div class="row">
                                <div class="col-sm-12 col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">CEP: </label>
                                    <input type="text" class="cep form-control" name='cep' onblur="pesquisacep(this.value);" id='cep' maxlength='10' value="<?= $registro['cep'] ?>" maxlength='9' placeholder='Ex.: 99999-999' >
                                </div>
                                <div class="col-sm-12 col-lg-3  form-group">
                                    <label class="form-control-label" for="inputUserName">Cidade: </label>
                                    <input type="text" class="form-control cidade" id="cidade" name="cidade" maxlength='30' value="<?= $registro['cidade'] ?>">
                                </div>
                                <div class="col-sm-12 col-lg-3  form-group">
                                    <label class="form-control-label" for="inputUserName">Estado: </label>
                                    <select class="form-control uf" name="uf" id="uf" data-fv-notempty="true" maxlength='30' data-fv-field="requiredSelect">
                                        <?php
                                        echo '<option value="" disabled>Estado</option>';
                                        $arr = array(
                                            'AC' => 'Acre',
                                            'AL' => 'Alagoas',
                                            'AP' => 'Amapá',
                                            'AM' => 'Amazonas',
                                            'BA' => 'Bahia',
                                            'CE' => 'Ceará',
                                            'DF' => 'Distrito Federal',
                                            'ES' => 'Espírito Santo',
                                            'GO' => 'Goiás',
                                            'MA' => 'Maranhão',
                                            'MT' => 'Mato Grosso',
                                            'MS' => 'Mato Grosso do Sul',
                                            'MG' => 'Minas Gerais',
                                            'PA' => 'Pará',
                                            'PB' => 'Paraíba',
                                            'PR' => 'Paraná',
                                            'PE' => 'Pernambuco',
                                            'PI' => 'Piauí',
                                            'RJ' => 'Rio de Janeiro',
                                            'RN' => 'Rio Grande do Norte',
                                            'RS' => 'Rio Grande do Sul',
                                            'RO' => 'Rondônia',
                                            'RR' => 'Roraima',
                                            'SC' => 'Santa Catarina',
                                            'SP' => 'São Paulo',
                                            'SE' => 'Sergipe',
                                            'TO' => 'Tocantins',
                                            'ET' => 'Estrangeiro'
                                        );
                                        foreach ($arr as $key => $estado) {
                                            $selected = ($registro['estado'] == $key) ? 'selected = "selected"' : '';
                                            echo '<option ' . $selected . ' value="' . $key . '">' . $estado . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4  form-group">
                                    <label class="form-control-label" for="inputUserName">Bairro: </label>
                                    <input type="text" class="form-control bairro" id="bairro" name="bairro" maxlength='30' value="<?= $registro['bairro'] ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-lg-5  form-group">
                                    <label class="form-control-label" for="inputUserName">Rua: </label>
                                    <input type="text" class="form-control rua" id="rua" name="rua" value="<?= $registro['rua'] ?>" maxlength='30'>
                                </div>
                                <div class="col-sm-12 col-lg-2  form-group">
                                    <label class="form-control-label" for="inputUserName">Nº: </label>
                                    <input type="text" class="form-control numero" id="numero" name="numero" maxlength='10' value="<?= $registro['numero'] ?>">
                                </div>
                                <div class="col-sm-12 col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">Complemento: </label>
                                    <input type="text" class="form-control" name='complemento' maxlength='30' value="<?= $registro['complemento'] ?>" id='complemento'>
                                </div>
                                <div class="col-sm-12 col-lg-3  form-group">
                                    <label class="form-control-label" for="inputUserName">Km de distância da FUMEC: </label>
                                    <input type="number" class="form-control " id="km" name="km" value="<?= $registro['km'] ?>" maxlength='6'>
                                </div>
                            </div>
                        </div>
                        <span>Contatos</span>
                        <div class="caixa">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6  form-group">
                                    <label class="form-control-label" for="inputUserName">Email: </label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $registro['u_email'] ?>">
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Celular: </label>
                                    <input class='form-control  input-lg phone' type='text' name='celular' id='celular' value="<?= $registro['ca_celular'] ?>" minlength="15" maxlength='15' placeholder='Ex.: (99) 99999-999'>
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Telefone: </label>
                                    <input class='form-control  input-lg phone' type='text' name='Telefone' id='Telefone' value="<?= $registro['ca_telefone'] ?>" maxlength='15' placeholder='Ex.: (99) 99999-999'>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="caixa">
                            <div class="row">
                                <div class="col-sm-12 col-lg-2  form-group">
                                    <label class="form-control-label" for="inputUserName">É a primeira graduação? </label><br>
                                    <?php
                                    if ($registro['graduacao'] === 'Sim') { ?>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="sim" name="graduacao" value="Sim" class="graduacao" checked >
                                            <label for="inputBasicMale1">Sim</label>
                                        </div>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="nao" name="graduacao" value="Não" class="graduacao">
                                            <label for="inputBasicFemale1">Não</label>

                                        </div>

                                    <?php } else { ?>

                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="Sim" name="graduacao" value="Sim" class="graduacao">
                                            <label for="inputBasicMale1">Sim</label>
                                        </div>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="nao" name="graduacao" value="Não" class="graduacao" checked>
                                            <label for="inputBasicFemale1">Não</label>
                                        </div>

                                    <?php } ?>
                                </div>
                                <div id="campo" <?php if ($registro['graduacao'] === 'Sim') { ?>style="display: none" <?php } ?>class="col-sm-12 col-lg-10 form-group">
                                    <label class="form-control-label" for="inputUserName">Qual graduação possui? </label>
                                    <input type="text" class="form-control" id="graduacao" maxlength='100' name="qualgraduacao" value="<?= $registro['qualgraduacao'] ?>" <?php if(!isset($registro['qualgraduacao'])){ ?> disabled <?php } ?>>
                                </div>
                            </div>
                        </div>

                        <div class="caixa">
                            <div class="row">
                                <div class="col-9 form-group">
                                    <label class="form-control-label" for="inputUserName">Informe o 1º curso desejado: </label>
                                    <?php if(!isset($registro['primeiro'])){ ?>
                                        <input type="text" class="form-control" placeholder="1º curso desejado"  disabled >
                                         <?php }else{ ?>
                                    <?php $cursos->selectCurso('primeirocurso', $registro['primeiro']); ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 form-group">
                                    <label class="form-control-label" for="inputUserName">Informe o 2º curso desejado: </label>
                                    <?php if(!isset($registro['segundo'])){ ?>
                                        <input type="text" class="form-control" placeholder="2º curso desejado"  disabled >
                                    <?php }else{ ?>
                                        <?php $cursos->selectCurso('segundocurso', $registro['segundo']); ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 form-group">
                                    <label class="form-control-label" for="inputUserName">Informe o 2º curso desejado: </label>
                                    <?php if(!isset($registro['terceiro'])){ ?>
                                        <input type="text" class="form-control" placeholder="2º curso desejado"  disabled >
                                    <?php }else{ ?>
                                        <?php $cursos->selectCurso('terceirocurso', $registro['terceiro']);  ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="caixa">
                            <div class="row">
                                <div class="col-sm-12 col-lg-2  form-group">
                                    <label class="form-control-label" for="inputUserName">Possui Cadastro Único? </label><br>
                                    <?php if ($registro['cadastrounico'] != '') { ?>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="simnumunico" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico" checked>
                                            <label for="inputBasicMale1">Sim</label>
                                        </div>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="naonumunico" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico">
                                            <label for="inputBasicFemale1">Não</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="simnumunico" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico">
                                            <label for="inputBasicMale1">Sim</label>
                                        </div>
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="naonumunico" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico" checked>
                                            <label for="inputBasicFemale1">Não</label>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div id="camponumunico" <?php if ($registro['cadastrounico'] == '') { ?>style="display: none" <?php } ?> class="col-sm-12 col-lg-10 form-group">
                                    <label class="form-control-label" for="inputUserName">Nº Cadastro Único: </label>
                                    <input type="text" class="form-control" id="Unico" name="Unico" maxlength='50' value="<?= $registro['cadastrounico'] ?>" <?php if(!isset($registro['cadastrounico'])){ ?> disabled <?php } ?> >
                                </div>
                            </div>
                        </div>
                        <div class="caixa">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="inputUserName">Profissão: </label>
                                    <input type="text" class="form-control" id="Profissão" value="<?= $registro['profissao'] ?>" maxlength='80' name="profissao" <?php if(!isset($registro['profissao'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="inputUserName">Empresa: </label>
                                    <input type="text" class="form-control " id="Empresa" value="<?= $registro['empresa'] ?>" maxlength='80' name="empresa" <?php if(!isset($registro['empresa'])){ ?> disabled <?php } ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label class="form-control-label" for="inputUserName">Salario Bruto: </label>
                                    <input type="text" class="form-control money" id="txt1" name="salario" onkeyup="calcular_total()" maxlength='12' value="<?= $registro['salario_bruto'] ?>" placeholder="R$" <?php if(!isset($registro['salario_bruto'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="form-control-label" for="inputUserName">Outras Rendas: </label>
                                    <input type="text" class="form-control money" id="txt2" name="renda_res" onkeyup="calcular_total()" maxlength='12' value="<?= $registro['outras_rendas'] ?>" placeholder="R$" <?php if(!isset($registro['outras_rendas'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="form-control-label" for="inputUserName">Total: </label>
                                    <input type="text" class="form-control money" id="result" name="result" placeholder="R$" maxlength='12' value="<?= $registro['total'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <span>Responsável legal</span>

                        <div class="caixa">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 form-group">
                                    <label class="form-control-label" for="inputUserName">Nome Completo: </label>
                                    <input type="text" class="form-control" id="nome" name="nome_res" value="<?= $registro['p_nome'] ?>" maxlength='100' letterswithbasicpunc="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" <?php if(!isset($registro['p_nome'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-sm-12  col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">Data de Nascimento: </label>
                                    <input type="text" class="form-control data" id="datanascimento" name="datanascimento_res" <?php if ($registro['p_nome'] == '') { ?> value="" <?php } else { ?> value="<?= date("d/m/Y", strtotime($registro['p_data_nascimento']));
                                                                                                                                                                                                        } ?>" maxlength="10" <?php if(!isset($registro['p_data_nascimento'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-sm-12  col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">CPF: </label>
                                    <input type="text" class="cpf form-control cpf" name='cpf_res' id='cpf' maxlength='15' value="<?= $registro['p_cpf'] ?>" placeholder='Ex.: 000-000-000.00' <?php if(!isset($registro['p_cpf'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-sm-12 col-lg-2 form-group">
                                    <label class="form-control-label" for="inputUserName">Nº Identidade: </label>
                                    <input type="text" class="form-control" id="rg" name="rg_res" maxlength='15' value="<?= $registro['p_num_identidade'] ?>" <?php if(!isset($registro['p_num_identidade'])){ ?> disabled <?php } ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6  form-group">
                                    <label class="form-control-label" for="inputUserName">Email: </label>
                                    <input type="email" class="form-control" id="email" name="email_res" maxlength='100' value="<?= $registro['p_email'] ?>" <?php if(!isset($registro['p_email'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Celular: </label>
                                    <input class='form-control  input-lg phone' type='text' name='celular_res' id='celular' minlength="15" maxlength='15' value="<?= $registro['p_celular'] ?>" placeholder='Ex.: (99) 99999-999' <?php if(!isset($registro['p_celular'])){ ?> disabled <?php } ?>>
                                </div>
                                <div class="col-sm-12 col-lg-3 form-group">
                                    <label class="form-control-label" for="inputUserName">Telefone: </label>
                                    <input class='form-control  input-lg phone' type='text' name='Telefone_res' id='Telefone' maxlength='15' value="<?= $registro['p_telefone'] ?>" placeholder='Ex.: (99) 99999-999' <?php if(!isset($registro['p_telefone'])){ ?> disabled <?php } ?>>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <span>Espaço destinado para o preencimento do grupo familiar, pessoas cujo o candidato depende da renda financeira.</span><br>
                        <span>É obrigatório cadastrar pelo menos uma renda.</span>

                        <?php

                        $sql_FAMILIARES  =  "SELECT * FROM familiares where id_usuario  =  '$id' ";
                        $resultado_FAMILIARES  =  mysqli_query($link, $sql_FAMILIARES);


                        $dados_usuario  =  mysqli_fetch_array($resultado_FAMILIARES);

                        //ACHOU O ID!!!!
                        if (isset($dados_usuario['id_familiares'])) {
                            // echo $dados_usuario['id_familiares'];
                            $resultado_FAMILIARES  =  mysqli_query($link, $sql_FAMILIARES);
                            while ($registro_FAMILIARES = mysqli_fetch_array($resultado_FAMILIARES, MYSQLI_ASSOC)) {

                                ?>

                                <div id="origem" class="caixa">
                                    <div class="row espacobutton">
                                        <div class="col-12">
                                            <button type="button" title="Excluir" class="btn btn-danger btn-sm btn-circle float-right removerCampo">x</button>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control campo " id="id" name="id[]" value="<?= $registro_FAMILIARES['id_familiares'] ?>" readonly>

                                    <div class="row">

                                        <div class="col-sm-12 col-lg-6 form-group">


                                            <label class="form-control-label" for="inputUserName">Nome:</label>
                                            <input type="text" class="form-control campo " id="nome" name="nome[]" value="<?= $registro_FAMILIARES['nome'] ?>" maxlength='100' pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$">
                                        </div>

                                        <div class="col-sm-12 col-lg-3 form-group">
                                            <label class="form-control-label" for="inputUserName">CPF: </label>
                                            <input type="text" class="form-control cpf " id="cpf" name="cpf[]" onblur="validarCpf()" maxlength='15' value="<?= $registro_FAMILIARES['cpf'] ?>" placeholder='Ex.: 000-000-000.00'>
                                        </div>

                                        <div class="col-sm-12 col-lg-3 form-group">
                                            <label class="form-control-label" for="inputUserName">Nº Identidade: </label>
                                            <input type="text" class="form-control" id="rg" name="rg[]" value="<?= $registro_FAMILIARES['rg'] ?>" maxlength='30' placeholder=''>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 form-group">
                                            <label class="form-control-label" for="inputUserName">Profissão: </label>
                                            <input type="text" class="form-control " id="ocupacao" value="<?= $registro_FAMILIARES['ocupacao'] ?>" maxlength='100' name="ocupacao[]" >
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-12 form-group">
                                            <label class="form-control-label" for="inputUserName">Renda brutra mensal: </label>
                                            <input type="text" class="form-control money calcular " placeholder="R$" id="txt[]" maxlength='12' value="<?= $registro_FAMILIARES['renda']; ?>" name="renda[]" onkeyup="calcular()" >
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-12 form-group">
                                            <label class="form-control-label" for="inputUserName">Outras rendas:</label>
                                            <input type="text" class="form-control money calcular2 " placeholder="R$" id="txt1[]" maxlength='12' value="<?= $registro_FAMILIARES['outrasrenda']; ?>" name="outrasrenda[]" onkeyup="calcular()">
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-12 form-group">
                                            <label class="form-control-label" for="inputUserName">Grau de Parentesco: </label>
                                            <select class="form-control " id="qual" name="qual[]" data-fv-notempty="true" data-fv-field="requiredSelect" >
                                                <?php
                                                echo '<option value="" selected disabled>Qual?</option>';
                                                $arr = array(
                                                    'Pai' => 'Pai',
                                                    'Mãe'       => 'Mãe',
                                                    'Marido'    => 'Marido',
                                                    'Esposa'    => 'Esposa',
                                                    'Avô(ó)'    => 'Avô(ó)',
                                                    'Sogro(a)'  => 'Sogro(a)',
                                                    'Irmão(ã)'  => 'Irmão(ã)',
                                                    'Filho(a)'  => 'Filho(a)',
                                                    'Neto(a)'   => 'Neto(a)',
                                                    'Outros'    => 'Outros',
                                                    'Nenhum'    => 'Nenhum'
                                                );
                                                foreach ($arr as $key => $qual) {
                                                    $selected = ($registro_FAMILIARES['qual'] == $key) ? 'selected = "selected"' : '';
                                                    echo '<option ' . $selected . ' value="' . $key . '">' . $qual . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    } else {
                        echo '<br><br>';
                        echo "<b>Usuario não completou o cadastro do grupo familiar</b>";
                        ?>
                            <div id="origem" class="caixa">
                                <div class="row espacobutton">
                                    <div class="col-12">
                                        <button type="button" title="Excluir" class="btn btn-danger btn-sm btn-circle float-right removerCampo">x</button>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control campo " id="id" name="id[]" value="<?= $registro_FAMILIARES['id_familiares'] ?>" readonly>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6 form-group">
                                        <label class="form-control-label" for="inputUserName">Nome:</label>
                                        <input type="text" class="form-control campo " id="nome" name="nome[]" value="<?= $registro['nome'] ?>" maxlength='100' pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" <?php if(!isset($registro['nome'])){ ?> disabled <?php } ?>>
                                    </div>

                                    <div class="col-sm-12 col-lg-3 form-group">
                                        <label class="form-control-label" for="inputUserName">CPF: </label>
                                        <input type="text" class="form-control cpf " id="cpf" name="cpf[]" onblur="validarCpf()" maxlength='15' value="<?= $registro['cpf'] ?>" placeholder='Ex.: 000-000-000.00' <?php if(!isset($registro['cpf'])){ ?> disabled <?php } ?>>
                                    </div>

                                    <div class="col-sm-12 col-lg-3 form-group">
                                        <label class="form-control-label" for="inputUserName">Nº Identidade: </label>
                                        <input type="text" class="form-control" id="rg" name="rg[]" value="<?= $registro['rg'] ?>" maxlength='30' placeholder='' <?php if(!isset($registro['rg'])){ ?> disabled <?php } ?>>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 form-group">
                                        <label class="form-control-label" for="inputUserName">Profissão: </label>
                                        <input type="text" class="form-control " id="ocupacao" value="<?= $registro['ocupacao'] ?>" maxlength='100' name="ocupacao[]" <?php if(!isset($registro['ocupacao'])){ ?> disabled <?php } ?>>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 form-group">
                                        <label class="form-control-label" for="inputUserName">Renda brutra mensal: </label>
                                        <input type="text" class="form-control money calcular " placeholder="R$" id="txt[]" maxlength='12' value="<?= $registro['renda']; ?>" name="renda[]" onkeyup="calcular()" <?php if(!isset($registro['renda'])){ ?> disabled <?php } ?>>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 form-group">
                                        <label class="form-control-label" for="inputUserName">Outras rendas:</label>
                                        <input type="text" class="form-control money calcular2 " placeholder="R$" id="txt1[]" maxlength='12' value="<?= $registro['outrasrenda']; ?>" name="outrasrenda[]" onkeyup="calcular()" <?php if(!isset($registro['outrasrenda'])){ ?> disabled <?php } ?>>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 form-group">
                                        <label class="form-control-label" for="inputUserName">Grau de Parentesco: </label>
                                        <select class="form-control " id="qual" name="qual[]" data-fv-notempty="true" data-fv-field="requiredSelect" <?php if(!isset($registro['qual'])){ ?> disabled <?php } ?>>
                                            <?php
                                            echo '<option value="" selected disabled>Qual?</option>';
                                            $arr = array(
                                                'Pai' => 'Pai',
                                                'Mãe'       => 'Mãe',
                                                'Marido'    => 'Marido',
                                                'Esposa'    => 'Esposa',
                                                'Avô(ó)'    => 'Avô(ó)',
                                                'Sogro(a)'  => 'Sogro(a)',
                                                'Irmão(ã)'  => 'Irmão(ã)',
                                                'Filho(a)'  => 'Filho(a)',
                                                'Neto(a)'   => 'Neto(a)',
                                                'Outros'    => 'Outros',
                                                'Nenhum'    => 'Nenhum'
                                            );
                                            foreach ($arr as $key => $qual) {
                                                $selected = ($registro['qual'] == $key) ? 'selected = "selected"' : '';
                                                echo '<option ' . $selected . ' value="' . $key . '">' . $qual . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <?php
                    }
                    ?>
                        <button type="button" title="Adicionar" id="btn-success" class="btn btn-success btn-circle adicionar" alt="Menu principal">+</button>
                        <br><br>
                        <button type="submit" class="btn btn-success float-right"> Salvar </button><br><br>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="vendor/js/jquery.min.js"></script>
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/js/bootadmin.min.js"></script>
    <script src="vendor/libraries/datatable/js/datatable.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <!-- Mascaras -->
    <script src="../scripts/jquery.mask.min.js" type="text/javascript"></script>
    <script src="../scripts/bootstrap-notify.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="scripts/procuraCEP.js"></script>

    <script>
        $(".graduacao").change(function() {
            if ($("#nao").prop("checked") == true) {
                $('#campo').fadeIn("show");
            } else {
                $('#campo').hide();
            }
        });

        $(".numunico").change(function() {
            if ($("#simnumunico").prop("checked") == true) {
                $('#camponumunico').fadeIn("show");
            } else {
                $('#camponumunico').hide();
            }
        });

        $(document).ready(function() {
            $('#listaInscritos').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    search: "Buscar:",
                    lengthMenu: "Exibir _MENU_ registros",
                    info: "Total de registros cadastrados: _TOTAL_",
                    paginate: {
                        first: "Primeiro",
                        previous: "Anterior",
                        next: "Pr&oacute;ximo",
                        last: "&eacute;ltimo"
                    },
                },
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });


        function callCrudAction(action, id) {
            var acao = action;
            var id = id;
            var buttonCancelar = "#buttonCancelar" + id;
            var buttonConfirmar = "#buttonConfirmar" + id;
            $.ajax({
                type: "POST",
                url: "verificacaoStatus.php",
                data: {
                    acao: action,
                    id: id
                },
                success: function(data) {
                    $(buttonConfirmar).remove();
                    $(buttonCancelar).show();
                },
            });
        }



        $(document).ready(function() {

            $('.phone').mask('(00) 00000-0000'); // Máscara para TELEFONE
            $('.cpf').mask('000.000.000-00', {
                reverse: true
            }); // Máscara para CPF
            $('.cep').mask('00000-000'); // Máscara para CEP
            $('.rg').mask('AA-99.999.999'); // Máscara para RG
            $('.money').mask('000.000.000.000.000,00', {
                reverse: true
            }); // Máscara para dinheiro

        });

        function calcular_total() {
            var valor1 = parseFloat(document.getElementById('txt1').value
                .replace('.', '').replace(',', ''));

            var valor2 = parseFloat(document.getElementById('txt2').value
                .replace('.', '').replace(',', ''));

            var total = valor1 + valor2;

            document.getElementById('result').value = formatReal(total);

        }

        function getMoney(str) {
            return parseInt(str.replace(/[\D]+/g, ''));
        }

        function formatReal(int) {
            var tmp = int + '';
            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
            if (tmp.length > 6)
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

            return tmp;

            calcular();
        }



        function removeCampo() {
            $(".removerCampo").off("click");
            $(".removerCampo").on("click", function() {
                //$("span").parent().parent().parent().parent().find("div#origem").css({ "color": "blue", "border": "2px solid blue" });
                if ($(this).parent().parent().parent().parent().find("div#origem").length > 1) {
                    $(this).parent().parent().parent().remove();
                }
                $cont--;
                document.getElementById('QTDE').value = ($cont);
            });
        }

        var $cont = 1;

        $(".adicionar").click(function() {
            //$("span").parent().parent().parent().find("div#origem").css({ "color": "red", "border": "2px solid red" });
            novoCampo = $(this).parent().find("div#origem:first").clone();
            novoCampo.find("input").val('');
            novoCampo.find("input").val('');
            novoCampo.insertAfter($(this).parent().find("div#origem:last"));
            removeCampo();
            $cont++;
            document.getElementById('QTDE').value = ($cont);
            calcular();
        });
        removeCampo();

        // function calcular() {

        //     for ($calc = 1; $calc < 5; ++$calc) {
        //         //     alert ("teste")
        //         // }
        //         var valor1 = parseFloat(document.getElementById('txt[]').value
        //             .replace('.', '').replace(',', ''));

        //         var valor2 = parseFloat(document.getElementById('txt1[]').value
        //             .replace('.', '').replace(',', ''));

        //         var total = valor1 + valor2;

        //     }
        // }
    </script>


</body>

</html>
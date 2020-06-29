<?PHP

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT 
        `id_usuario`, 
        `nome`,
        `data_nascimento`, 
        `cpf`, 
        `km`, 
        `num_identidade`, 
        `emissor`, 
        `data_expedicao`, 
        `sexo`, 
        `estado_civil`, 
        `celular`, 
        `telefone`, 
        `bairro`, 
        `rua`, 
        `cidade`, 
        `estado`, 
        `cep`, 
        `complemento`,
        `numero`, 
        `data_cadastro`,

        u.email as emaill

        From 

        usuario u        

        left join cadastro ca on u.id = ca.id_usuario 

        where u.id = '$id_usuario' ";

$resultado_id = mysqli_query($link, $sql);

$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

if ($registro == null) {
    $registro['emaill']             = htmlspecialchars($registro['emaill']);
    $registro['nome']               = '';
    $registro['data_nascimento']    = '';
    $registro['cpf']                = '';
    $registro['km']                 = '';
    $registro['num_identidade']     = '';
    $registro['emissor']            = '';
    $registro['data_expedicao']     = '';
    $registro['sexo']               = '';
    $registro['estado_civil']       = '';
    $registro['celular']            = '';
    $registro['telefone']           = '';
    $registro['bairro']             = '';
    $registro['rua']                = '';
    $registro['cidade']             = '';
    $registro['estado']             = '';
    $registro['cep']                = '';
    $registro['complemento']        = '';
    $registro['numero']             = '';
} else {

    $registro['emaill']          = htmlspecialchars($registro['emaill']);
    $registro['nome']            = htmlspecialchars($registro['nome']);
    $registro['data_nascimento'] = htmlspecialchars($registro['data_nascimento']);
    $registro['cpf']             = htmlspecialchars($registro['cpf']);
    $registro['km']              = htmlspecialchars($registro['km']);
    $registro['num_identidade']  = htmlspecialchars($registro['num_identidade']);
    $registro['emissor']         = htmlspecialchars($registro['emissor']);
    $registro['data_expedicao']  = htmlspecialchars($registro['data_expedicao']);
    $registro['sexo']            = htmlspecialchars($registro['sexo']);
    $registro['estado_civil']    = htmlspecialchars($registro['estado_civil']);
    $registro['celular']         = htmlspecialchars($registro['celular']);
    $registro['telefone']        = htmlspecialchars($registro['telefone']);
    $registro['bairro']          = htmlspecialchars($registro['bairro']);
    $registro['rua']             = htmlspecialchars($registro['rua']);
    $registro['cidade']          = htmlspecialchars($registro['cidade']);
    $registro['estado']          = htmlspecialchars($registro['estado']);
    $registro['cep']             = htmlspecialchars($registro['cep']);
    $registro['complemento']     = htmlspecialchars($registro['complemento']);
    $registro['numero']          = htmlspecialchars($registro['numero']);
}


?>

<form id="signupForm" method="post" action="gets/get_cadastro">
    <span>Dados Pessoais</span>
    <div class="caixa">
        <div class="row">
            <div class="col-sm-12 col-lg-6 form-group">
                <label class="form-control-label" for="inputUserName">Nome Completo: *</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $registro['nome'] ?>" required="pattern">
            </div>
            <div class="col-sm-12  col-lg-2 form-group">
                <label class="form-control-label" for="inputUserName">Data de Nascimento: *</label>
                <input type="text" class="form-control data" id="datanascimento" name="datanascimento" <?php if ($registro['nome'] == '') { ?> value="" <?php } else { ?> value="
                        <?= date("d/m/Y", strtotime($registro['data_nascimento']));
                } ?>" maxlength="10" required="required">
            </div>
            <div class="col-sm-12  col-lg-2 form-group">
                <label class="form-control-label" for="inputUserName">CPF: *</label>
                <input type="text" class="cpf form-control" name='cpf' onblur="validarCpf()" id='cpf' maxlength='15' value="<?= $registro['cpf'] ?>" placeholder='Ex.: 000-000-000.00' required="required">
            </div>
            <div class="col-sm-12 col-lg-2 form-group">
                <label class="form-control-label" for="inputUserName">Gênero: * <?php echo $registro['sexo'] ?></label>
                <select class="form-control" name="Genero" data-fv-notempty="true" data-fv-field="requiredSelect" required="required">
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
                <label class="form-control-label" for="inputUserName">Nº Identidade: *</label>
                <input type="text" class="form-control" id="rg" name="rg" maxlength='10' value="<?= $registro['num_identidade'] ?>" required="required">
            </div>
            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">Órgão Emissor: *</label>
                <input type="text" class="form-control letras" id="orgao" name="orgao" maxlength='10' value="<?= $registro['emissor'] ?>" required="required">
            </div>
            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">Data de Expedição: *</label>
                <input type="text" class="form-control data" name="dataexpedicao" id="dataexpedicao" <?php if ($registro['nome'] == '') { ?> value=" " <?php } else { ?> value="
                        <?= date("d/m/Y", strtotime($registro['data_expedicao']));
                } ?>" maxlength="10" required="required">
            </div>
            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">Estado Civil: *</label>
                <select class="form-control" name="EstadoCivil" data-fv-notempty="true" data-fv-field="requiredSelect" required="required">

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
                <label class="form-control-label" for="inputUserName">CEP: *</label>
                <input type="text" class="cep form-control" name='cep' onblur="pesquisacep(this.value);" id='cep' maxlength='10' value="<?= $registro['cep'] ?>" maxlength='9' placeholder='Ex.: 99999-999' required="required">
            </div>
            <div class="col-sm-12 col-lg-3  form-group">
                <label class="form-control-label" for="inputUserName">Cidade: *</label>
                <input type="text" class="form-control cidade" id="cidade" name="cidade" maxlength='30' value="<?= $registro['cidade'] ?>" required="required">
            </div>
            <div class="col-sm-12 col-lg-3  form-group">
                <label class="form-control-label" for="inputUserName">Estado: *</label>
                <select class="form-control uf" name="uf" id="uf" data-fv-notempty="true" maxlength='30' data-fv-field="requiredSelect" required="required">
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
                <label class="form-control-label" for="inputUserName">Bairro: *</label>
                <input type="text" class="form-control bairro" id="bairro" name="bairro" maxlength='30' value="<?= $registro['bairro'] ?>" required="required">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-5  form-group">
                <label class="form-control-label" for="inputUserName">Rua: *</label>
                <input type="text" class="form-control rua" id="rua" name="rua" value="<?= $registro['rua'] ?>" maxlength='30' required="required">
            </div>
            <div class="col-sm-12 col-lg-2  form-group">
                <label class="form-control-label" for="inputUserName">Nº: *</label>
                <input type="text" class="form-control numero" id="numero" name="numero" maxlength='10' value="<?= $registro['numero'] ?>" required="required">
            </div>
            <div class="col-sm-12 col-lg-2 form-group">
                <label class="form-control-label" for="inputUserName">Complemento: </label>
                <input type="text" class="form-control" name='complemento' maxlength='30' value="<?= $registro['complemento'] ?>" id='complemento'>
            </div>
            <div class="col-sm-12 col-lg-3  form-group">
                <label class="form-control-label" for="inputUserName">Km de distância da FUMEC: *</label>
                <input type="number" class="form-control " id="km" name="km" value="<?= $registro['km'] ?>" maxlength='6' required="required">
            </div>
        </div>
    </div>
    <span>Contatos</span>
    <div class="caixa">
        <div class="row">
            <div class="col-sm-12 col-lg-6  form-group">
                <label class="form-control-label" for="inputUserName">Email: *</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $registro['emaill'] ?>" required="required" readonly>
            </div>
            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">Celular: *</label>
                <input class='form-control  input-lg phone' type='text' name='celular' id='celular' value="<?= $registro['celular'] ?>" minlength="15" maxlength='15' placeholder='Ex.: (99) 99999-999' required="required">
            </div>
            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">Telefone: </label>
                <input class='form-control  input-lg phone' type='text' name='Telefone' id='Telefone' value="<?= $registro['telefone'] ?>" maxlength='15' placeholder='Ex.: (99) 99999-999'>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success float-right"><i class="icon wb-check" aria-hidden="true"></i>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"> Salvar</font>
        </font>
    </button><br><br>
</form>
<hr>

<!-- end Primeiro Content -->
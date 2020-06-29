<?PHP

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT p.*, c.data_nascimento as data_ 
FROM 
cadastro as c 
left join profissao as p on c.id_usuario = p.id_usuario 

where c.id_usuario = '$id_usuario' ";

$resultado_id = mysqli_query($link, $sql);

$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

$data = htmlspecialchars($registro['data_']);

// separando yyyy, mm, ddd
list($ano, $mes, $dia) = explode('-', $data);
// data atual
$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
// Descobre a unix timestamp da data de nascimento do fulano
$nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
// cálculo
$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

/*<?php echo " Idade: $idade Ano s";?> */
if ($registro['salario_bruto'] == '') {
    $registro['salario_bruto'] = 0;
}
if ($registro['outras_rendas'] == '') {
    $registro['outras_rendas'] = 0;
}

if ($registro == null) {
    $registro['cadastrounico'] = '';
    $registro['profissao'] = '';
    $registro['empresa'] = '';
    $registro['total'] = '';
    $registro['nome'] = '';
    $registro['data_nascimento'] = '';
    $registro['cpf'] = '';
    $registro['num_identidade'] = '';
    $registro['email'] = '';
    $registro['celular'] = '';
    $registro['telefone'] = '';
} else {
    $registro['cadastrounico'] = htmlspecialchars($registro['cadastrounico']);
    $registro['profissao'] = htmlspecialchars($registro['profissao']);
    $registro['empresa'] = htmlspecialchars($registro['empresa']);
    $registro['salario_bruto'] = htmlspecialchars($registro['salario_bruto']);
    $registro['outras_rendas'] = htmlspecialchars($registro['outras_rendas']);
    $registro['total'] = htmlspecialchars($registro['total']);
    $registro['nome'] = htmlspecialchars($registro['nome']);
    $registro['data_nascimento'] = htmlspecialchars($registro['data_nascimento']);
    $registro['cpf'] = htmlspecialchars($registro['cpf']);
    $registro['num_identidade'] = htmlspecialchars($registro['num_identidade']);
    $registro['email'] = htmlspecialchars($registro['email']);
    $registro['celular'] = htmlspecialchars($registro['celular']);
    $registro['telefone'] = htmlspecialchars($registro['telefone']);
}

?>
<style>
    .caixa {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
    }
</style>
<form id="signupForm" method="post" action="gets/get_profissao">
    <div class="caixa">
        <div class="row">
            <div class="col-sm-12 col-lg-2  form-group">
                <label class="form-control-label" for="inputUserName">Possui Cadastro Único? </label><br>
                <?php if ($registro['cadastrounico'] != '') { ?>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="sim" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico" required="required" checked>
                        <label for="inputBasicMale1">Sim</label>
                    </div>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="nao" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico" required="required">
                        <label for="inputBasicFemale1">Não</label>
                    </div>
                <?php } else { ?>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="sim" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico" required="required">
                        <label for="inputBasicMale1">Sim</label>
                    </div>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="nao" name="numunico" value="<?= $registro['numunico'] ?>" class="numunico" required="required" checked>
                        <label for="inputBasicFemale1">Não</label>
                    </div>
                <?php } ?>

            </div>
            <div id="campo" <?php if ($registro['cadastrounico'] == '') { ?>style="display: none" <?php } ?> class="col-sm-12 col-lg-10 form-group">
                <label class="form-control-label" for="inputUserName">Nº Cadastro Único: *</label>
                <input type="text" class="form-control" id="Unico" name="Unico" maxlength='50' value="<?= $registro['cadastrounico'] ?>" required="required">
            </div>
        </div>
    </div>
    <div class="caixa">
        <div class="row">
            <div class="col-6 form-group">
                <label class="form-control-label" for="inputUserName">Profissão: </label>
                <input type="text" class="form-control" id="Profissão" value="<?= $registro['profissao'] ?>" maxlength='80' name="profissao">
            </div>
            <div class="col-6 form-group">
                <label class="form-control-label" for="inputUserName">Empresa: </label>
                <input type="text" class="form-control " id="Empresa" value="<?= $registro['empresa'] ?>" maxlength='80' name="empresa">
            </div>
        </div>
        <div class="row">
            <div class="col-4 form-group">
                <label class="form-control-label" for="inputUserName">Salario Bruto: </label>
                <input type="text" class="form-control money" id="txt1" name="salario" onkeyup="calcular()" maxlength='12' value="<?= $registro['salario_bruto'] ?>" placeholder="R$">
            </div>
            <div class="col-4 form-group">
                <label class="form-control-label" for="inputUserName">Outras Rendas: </label>
                <input type="text" class="form-control money" id="txt2" name="renda" onkeyup="calcular()" maxlength='12' value="<?= $registro['outras_rendas'] ?>" placeholder="R$">
            </div>
            <div class="col-4 form-group">
                <label class="form-control-label" for="inputUserName">Total: </label>
                <input type="text" class="form-control money" id="result" name="result" placeholder="R$" maxlength='12' value="<?= $registro['total'] ?>" readonly>
            </div>
        </div>
    </div>
    <?PHP
    if ($idade < 18) {
        //echo "Idade: $idade Anos";
        ?>
        <span>Responsável legal</span>

        <div class="caixa">
            <div class="row">
                <div class="col-sm-12 col-lg-6 form-group">
                    <label class="form-control-label" for="inputUserName">Nome Completo: *</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $registro['nome'] ?>" maxlength='100' required="pattern">
                </div>
                <div class="col-sm-12  col-lg-2 form-group">
                    <label class="form-control-label" for="inputUserName">Data de Nascimento: </label>
                    <input type="text" class="form-control data" id="datanascimento" name="datanascimento" 
                    <?php if ($registro['nome'] == '') { ?> value="" <?php } else { ?> value="<?= date("d/m/Y", strtotime($registro['data_nascimento']));
                        } ?>" maxlength="10" required="required">
                </div>
                <div class="col-sm-12  col-lg-2 form-group">
                    <label class="form-control-label" for="inputUserName">CPF: *</label>
                    <input type="text" class="cpf form-control cpf" name='cpf' id='cpf' maxlength='15' value="<?= $registro['cpf'] ?>" placeholder='Ex.: 000-000-000.00' required="required">
                </div>
                <div class="col-sm-12 col-lg-2 form-group">
                    <label class="form-control-label" for="inputUserName">Nº Identidade: *</label>
                    <input type="text" class="form-control" id="rg" name="rg" maxlength='15' value="<?= $registro['num_identidade'] ?>" required="required">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6  form-group">
                    <label class="form-control-label" for="inputUserName">Email: *</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength='100' value="<?= $registro['email'] ?>" required="required">
                </div>
                <div class="col-sm-12 col-lg-3 form-group">
                    <label class="form-control-label" for="inputUserName">Celular: *</label>
                    <input class='form-control  input-lg phone' type='text' name='celular' id='celular' minlength="15" maxlength='15' value="<?= $registro['celular'] ?>" placeholder='Ex.: (99) 99999-999' required="required">
                </div>
                <div class="col-sm-12 col-lg-3 form-group">
                    <label class="form-control-label" for="inputUserName">Telefone: </label>
                    <input class='form-control  input-lg phone' type='text' name='Telefone' id='Telefone' maxlength='15' value="<?= $registro['telefone'] ?>" placeholder='Ex.: (99) 99999-999'>
                </div>
            </div>
        </div>

    <?php }
?>
    <button type="submit" class="btn btn-success float-right"><i class="icon wb-check" aria-hidden="true"></i>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"> Salvar</font>
        </font>
    </button><br><br>
</form>
<hr>


<!-- end Primeiro Content -->
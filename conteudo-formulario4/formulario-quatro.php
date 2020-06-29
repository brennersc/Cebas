<!-- Primeiro Content -->
<?php

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$total = 0;
$somaTotal = 0;
$cont = 0;

$objDb = new db();
$link = $objDb->conecta_mysql();

//$sql = "SELECT * FROM familiares where id_usuario = '$id_usuario'";

$sql = "SELECT f.*, p.total as total FROM profissao p left join familiares f on f.id_usuario = p.id_usuario where p.id_usuario = '$id_usuario'";

$resultado_id = mysqli_query($link, $sql);

$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

?>
<span>Espaço destinado para o preencimento do grupo familiar, pessoas cujo o candidato depende da renda
    financeira.</span><br>
<span>É obrigatório cadastrar pelo menos uma renda.</span>


<form id="signupForm" method="post" action="gets/get_familiares">
    <div id="origem" class="caixa">
        <div class="row espacobutton">
            <div class="col-12">
                <button type="button" title="Excluir"
                    class="btn btn-danger btn-sm btn-circle float-right removerCampo"><i class="icon wb-close"
                        style="color: #fff" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6 form-group">
                <label class="form-control-label" for="inputUserName">Nome:</label>
                <input type="text" class="form-control campo " id="nome" name="nome[]" value="<?= $registro['nome'] ?>"
                    maxlength='100' pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$"
                    <?php if (($registro['total'] == '') || ($registro['total'] == null)) {
                                                                                                                                                                                                    echo 'required';
                                                                                                                                                                                                } ?>>
            </div>

            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">CPF: </label>
                <input type="text" class="form-control cpf " id="cpf" name="cpf[]" onblur="validarCpf()" maxlength='15'
                    value="<?= $registro['cpf'] ?>" placeholder='Ex.: 000-000-000.00'>
            </div>

            <div class="col-sm-12 col-lg-3 form-group">
                <label class="form-control-label" for="inputUserName">Nº Identidade: </label>
                <input type="text" class="form-control" id="rg" name="rg[]" value="<?= $registro['rg'] ?>"
                    maxlength='30' placeholder=''>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 form-group">
                <label class="form-control-label" for="inputUserName">Profissão: </label>
                <input type="text" class="form-control " id="ocupacao" value="<?= $registro['ocupacao'] ?>"
                    maxlength='100' name="ocupacao[]"
                    <?php if ($registro['total'] == '' or $registro['total'] == '0,00') {
                                                                                                                                                    echo 'required';
                                                                                                                                                } ?>>
            </div>
            <div class="col-lg-2 col-md-6 col-12 form-group">
                <label class="form-control-label" for="inputUserName">Renda brutra mensal: </label>
                <input type="text" class="form-control money calcular " placeholder="R$" id="txt[]" maxlength='12'
                    value="<?= $registro['renda']; ?>" name="renda[]" onkeyup="calcular()"
                    <?php if ($registro['total'] == '' or $registro['total'] == '0,00') {
                                                                                                                                                                                                echo 'required';
                                                                                                                                                                                            } ?>>
            </div>
            <div class="col-lg-2 col-md-6 col-12 form-group">
                <label class="form-control-label" for="inputUserName">Outras rendas:</label>
                <input type="text" class="form-control money calcular2 " placeholder="R$" id="txt1[]" maxlength='12'
                    value="<?= $registro['outrasrenda']; ?>" name="outrasrenda[]" onkeyup="calcular()"
                    <?php if ($registro['total'] == '' or $registro['total'] == '0,00') {
                                                                                                                                                                                                            echo 'required';
                                                                                                                                                                                                        } ?>>
            </div>
            <div class="col-lg-2 col-md-6 col-12 form-group">
                <label class="form-control-label" for="inputUserName">Grau de Parentesco: </label>
                <select class="form-control " id="qual" name="qual[]" data-fv-notempty="true"
                    data-fv-field="requiredSelect"
                    <?php if ($registro['total'] == '' or $registro['total'] == '0,00') {
                                                                                                                                    echo 'required';
                                                                                                                                } ?>>
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
    <button type="button" title="Adicionar" id="btn-success" class="btn btn-success btn-circle adicionar"
        alt="Menu principal"><i class="icon wb-plus" style="color: #fff" aria-hidden="true"></i></button>
    <br><br>
    <button id="submit" type="submit" class="btn btn-success float-right"><i class="icon wb-check"
            aria-hidden="true"></i>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"> Salvar</font>
        </font>
    </button><br><br>
</form>
<hr>
<script>
    function validarCpf() {
        if ($('#cpf').val().length > 0) {
            $.ajax({
                url: 'gets/get_cpf.php',
                type: 'POST',
                data: {
                    cpf: $('#cpf').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.sucesso == 1) {
                        alert(data.mensagem);
                        $('#cpf').addClass("is-invalid");
                        $("#cpf").focus();
                        document.getElementById('cpf').value = '';
                        $("#signupForm :input").prop("disabled", true);

                    }
                }
            });
        }
    }
</script>
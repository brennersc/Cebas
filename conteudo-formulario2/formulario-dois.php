<!-- Segundo Content -->
<?php

require('gets/cursos.class.php');

$cursos = new Cursos;

require_once('gets/db_class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT * From curso where id_usuario = '$id_usuario' ";

$resultado_id = mysqli_query($link, $sql);

$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

if ($registro == null) {

    $registro['graduacao']       = '';
    $registro['qualgraduacao']   = '';
    $registro['primeiro']        = '';
    $registro['segundo']         = '';
    $registro['terceiro']        = '';
    $registro['turno_primeiro']  = '';
    $registro['turno_segundo']   = '';
    $registro['turno_terceiro']  = '';
} else {
    $registro['graduacao']      = htmlspecialchars($registro['graduacao']);
    $registro['qualgraduacao']  = htmlspecialchars($registro['qualgraduacao']);
    $registro['primeiro']       = htmlspecialchars($registro['primeiro']);
    $registro['segundo']        = htmlspecialchars($registro['segundo']);
    $registro['terceiro']       = htmlspecialchars($registro['terceiro']);
    $registro['turno_primeiro']  = htmlspecialchars($registro['turno_primeiro']);
    $registro['turno_segundo']  = htmlspecialchars($registro['turno_segundo']);
    $registro['turno_terceiro'] = htmlspecialchars($registro['turno_terceiro']);
}
?>

<style>
    .caixa {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
    }
</style>

<form id="signupForm" method="post" action="gets/get_cursos">
    <div class="caixa">
        <div class="row">
            <div class="col-sm-12 col-lg-2  form-group">
                <label class="form-control-label" for="inputUserName">É a primeira graduação? </label><br>
                <?php
                if ($registro['graduacao'] === 'Sim') { ?>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="sim" name="graduacao" value="Sim" class="graduacao" required="required" checked>
                        <label for="inputBasicMale1">Sim</label>
                    </div>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="nao" name="graduacao" value="Não" class="graduacao" required="required">
                        <label for="inputBasicFemale1">Não</label>

                    </div>

                <?php } else { ?>

                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="Sim" name="graduacao" value="Sim" class="graduacao" required="required">
                        <label for="inputBasicMale1">Sim</label>
                    </div>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" id="nao" name="graduacao" value="Não" class="graduacao" required="required" checked>
                        <label for="inputBasicFemale1">Não</label>
                    </div>

                <?php } ?>
            </div>
            <div id="campo" <?php if ($registro['graduacao'] === 'Sim') { ?>style="display: none" <?php } ?>class="col-sm-12 col-lg-10 form-group">
                <label class="form-control-label" for="inputUserName">Qual graduação possui? </label>
                <input type="text" class="form-control" id="graduacao" maxlength='100' name="qualgraduacao" value="<?= $registro['qualgraduacao'] ?>" required="required">
            </div>
        </div>
    </div>

    <div class="caixa">
        <div class="row">
            <div class="col-9 form-group">
                <label class="form-control-label" for="inputUserName">Informe o 1º curso desejado: *</label>
                <?php $cursos->selectCurso('primeirocurso', $registro['primeiro']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-9 form-group">
                <label class="form-control-label" for="inputUserName">Informe o 2º curso desejado: *</label>
                <?php $cursos->selectCurso('segundocurso', $registro['segundo']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-9 form-group">
                <label class="form-control-label" for="inputUserName">Informe o 3º curso desejado: *</label>
                <?php $cursos->selectCurso('terceirocurso', $registro['terceiro']);  ?>
            </div>
        </div>
    </div>

    <button type="submit" id="btn-success" class="btn btn-success float-right"><i class="icon wb-check" aria-hidden="true"></i>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"> Salvar</font>
        </font>
    </button><br><br>

</form>
<script>
    window.onload = function() {
        var selects = document.getElementsByClassName("curso");

        for (var i = 0; i < selects.length; i++) {
            selects[i].onchange = function(e) {
                var val = this.value;

                for (var z = 0; z < selects.length; z++) {
                    var index = Array.prototype.indexOf.call(selects, this);

                    if ((z !== index) && selects[z].value === val) {
                        //alert("Este mês já foi selecionado, por favor, escolha outro!");

                        var options = this.getElementsByTagName("option");

                        for (var o = 0; o < options.length; o++) {
                            if (options[o].selected) {
                                options[o].selected = false;
                            }
                        }

                        options[0].selected = true;
                        //options[0].setAttribute("disabled") = true;
                        alert("Selecione outro curso!");

                        return false;
                    }
                }
            }
        }
    }
</script>

<!-- end Segundo Content -->
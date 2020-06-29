<!-- FOMULARIOS -->
<div class="page-content container">
    <div class="row">
        <div class="col-12">
            <!-- Panel Wizard Form -->
            <div class="panel">
                <div class="panel-heading">
                    <br>
                </div>
                <div class="panel-body">
                    <!-- Steps -->
                    <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">

                        <div class="step col-lg-3" data-target="#exampleAccount" role="tab">
                            <span class="step-number">1</span>
                            <div class="step-desc">
                                <span class="step-title">Cadastro</span>
                                <p>Informações candidato</p>
                            </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleBilling" role="tab">
                            <span class="step-number">2</span>
                            <div class="step-desc">
                                <span class="step-title">Curso</span>
                                <p>Informações acadêmicas</p>
                            </div>
                        </div>

                        <div class="step col-lg-3 current" data-target="#exampleGetting" role="tab">
                            <span class="step-number">3</span>
                            <div class="step-desc">
                                <span class="step-title">Informações Adicionais</span>
                                <p></p>
                            </div>
                        </div>

                        <div class="step col-lg-3 " data-target="#exampleGetting" role="tab">
                            <span class="step-number">4</span>
                            <div class="step-desc">
                                <span class="step-title">Grupo Familiar</span>
                                <p></p>
                            </div>
                        </div>

                    </div>
                    <!-- End Steps -->

                    <!-- Wizard Content -->
                    <div class="wizard-content">
                        <!-- Primeiro Content -->
                        <?php

                        require_once('gets/db_class.php');

                        $id_usuario = $_SESSION['id_usuario'];

                        $objDb = new db();
                        $link = $objDb->conecta_mysql();

                        $sql = "SELECT id_familiares FROM familiares where id_usuario = '$id_usuario' ";

                        $resultado_id = mysqli_query($link, $sql);

                        $dados_usuario = mysqli_fetch_array($resultado_id);

                        if ($dados_usuario == NULL) {
                            include('formulario-tres.php');
                        } else {
                            include('infos.php');
                        }
                        $sql2 = "SELECT id_profissao FROM profissao where id_usuario = '$id_usuario' ";

                        $resultado_id2 = mysqli_query($link, $sql2);

                        $dados_usuario2  =  mysqli_fetch_array($resultado_id2);

                        

                        ?>
                    </div>
                    <!-- End Wizard Content -->

                    <div class="wizard-buttons">
                        <a class="btn btn-default btn-outline" href="fumec-form-2" role="button">Voltar</a>
                        <?php if (!isset($dados_usuario2['id_profissao'])) {
                            ?>
                            <button class="btn btn-primary btn-outline float-right" href="fumec-form-4" role="button" disabled>Avançar</button>
                        <?php
                        } else {
                        ?>
                            <a class="btn btn-primary btn-outline float-right" href="fumec-form-4" role="button">Avançar</a>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
            <!-- End Panel Wizard One Form -->
        </div>
    </div>
</div>
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
                    <div class="steps steps-sm row d-print-none" data-plugin="matchHeight" data-by-row="true" role="tablist">

                        <div class="step col-lg-3" data-target="#exampleBilling" role="tab">
                            <span class="step-number">2</span>
                            <div class="step-desc">
                                <span class="step-title">Curso</span>
                                <p>Informações acadêmicas</p>
                            </div>
                        </div>

                        <div class="step col-lg-3 " data-target="#exampleGetting" role="tab">
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

                        <div class="step col-lg-3 current done" data-target="#exampleGetting" role="tab">
                            <span class="step-number">5</span>
                            <div class="step-desc">
                                <span class="step-title">Sucesso</span>
                                <p>Cadastro realizado</p>
                            </div>
                        </div>

                    </div>
                    <!-- End Steps -->

                    <!-- Wizard Content -->
                    <div class="wizard-content">
                        <!-- Primeiro Content -->
                        <?php include('formulario-cinco.php'); ?>
                        <!-- end Primeiro Content -->
                    </div>
                    <!-- End Wizard Content -->

                    <div class="wizard-buttons d-print-none">
                        <a class="btn btn-default btn-outline" href="fumec-form-4" role="button">Voltar</a>
                        
                    </div>

                </div>
            </div>
            <!-- End Panel Wizard One Form -->
        </div>
    </div>
</div>
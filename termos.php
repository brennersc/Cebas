<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Termos | Bolsa Oportunidade FUMEC</title>

    <link rel="icon" href="img/logo-branco.png">
    <!-- <link rel="apple-touch-icon" href="base/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="base/assets/images/favicon.ico"> -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="global/css/bootstrap.min.css">
    <link rel="stylesheet" href="global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="base/assets/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="global/vendor/jquery-wizard/jquery-wizard.css">
    <link rel="stylesheet" href="global/vendor/formvalidation/formValidation.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="global/vendor/media-match/media.match.min.js"></script>
    <script src="global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="global/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- cabeçalho -->
    <?php include('header.php'); ?>
    <!-- cabeçalho -->
    <style>
        .btn-site {
            background-color: #e4eaec !important;
        }

        .page {
            background-image: url(img/fundo.png) !important;
        }

        div>ol>li>a {
            color: #fff !important;
        }

        .page-title {
            color: #fff !important;
        }

        .page,
        .css-menubar .site-footer {
            margin-left: 0px !important;
        }

        .caixa {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
        }
    </style>
    <!-- Page -->
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Bolsa Oportunidade FUMEC</h1><br>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item">Cadastro</li>
                <li class="breadcrumb-item"></li> -->
            </ol>
            <div class="page-header-actions">
                <a class="btn btn-sm btn-default btn-outline btn-round btn-site" href="http://www.fumec.br/" target="_blank">
                    <i class="icon wb-link" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Site Fumec</span>
                </a>
            </div>
        </div>


        <!-- FOMULARIOS -->
        <!-- FOMULARIOS -->
        <div class="page-content container">
            <div class="row">
                <div class="col-12">
                    <!-- Panel Wizard Form -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Termos de Uso</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Wizard Content -->
                            <div class="wizard-content">

                                <!-- Primeiro Content -->
                                <p>
                                    Declaro que as informações por mim prestadas representam a verdade e estou
                                    ciente de que a omissão de informações ou a apresentação de dados e
                                    documentos falsos e/ou divergentes podem acarretar na eliminação do
                                    processo de concessão da bolsa podendo implicar também na sanção penal
                                    prevista no art.299 do Código Penal, conforme transcrição abaixo:
                                </p>
                                <p><i>
                                        “Art. 299 – Omitir, em documento público ou particular, declaração que nele
                                        deveria constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da
                                        que devia ser escrita, com o fim de prejudicar direito, criar obrigação ou alterar
                                        a verdade sobre o fato juridicamente relevante.<br>

                                        Pena: Reclusão de 1 (um) a 5 (cinco) anos e multa, se o documento é público e
                                        reclusão de 1 (um) a 3(três) anos, se o documento é particular. ”
                                    </i><br>

                                </p>
                                <p><b>DECLARO ainda que:</b></p>
                                <p><b>I</b> – Possuo renda familiar per capita compatível com a Lei n-12.101, de 2009;</p>
                                <p><b>II</b> – Os serviços serão por mim usufruídos no período letivo de (Ano/Semestre).</p>

                                <!-- end Primeiro Content -->

                            </div>
                            <!-- End Wizard Content -->
                        </div>
                    </div>
                    <!-- End Panel Wizard One Form -->
                </div>
            </div>
        </div>
        <!-- FOMULARIOS -->
    </div>
    <!-- End Page -->


    <!-- RODAPE -->
    <?php include('footer.php'); ?>
    <!-- RODAPE -->

    <!-- Core  -->
    <script src="global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="global/vendor/jquery/jquery.js"></script>
    <script src="global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="global/vendor/bootstrap/bootstrap.js"></script>
    <script src="global/vendor/animsition/animsition.js"></script>
    <script src="global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

    <!-- Plugins -->
    <script src="global/vendor/switchery/switchery.js"></script>
    <script src="global/vendor/intro-js/intro.js"></script>
    <script src="global/vendor/screenfull/screenfull.js"></script>
    <script src="global/vendor/slidepanel/jquery-slidePanel.js"></script>
    <script src="global/vendor/formvalidation/formValidation.js"></script>
    <script src="global/vendor/formvalidation/framework/bootstrap.js"></script>
    <script src="global/vendor/matchheight/jquery.matchHeight-min.js"></script>
    <script src="global/vendor/jquery-wizard/jquery-wizard.js"></script>

    <!-- Scripts -->
    <script src="global/js/Component.js"></script>
    <script src="global/js/Plugin.js"></script>
    <script src="global/js/Base.js"></script>
    <script src="global/js/Config.js"></script>

    <script src="base/assets/js/Section/Menubar.js"></script>
    <script src="base/assets/js/Section/GridMenu.js"></script>
    <script src="base/assets/js/Section/Sidebar.js"></script>
    <script src="base/assets/js/Section/PageAside.js"></script>
    <script src="base/assets/js/Plugin/menu.js"></script>

    <script src="global/js/config/colors.js"></script>
    <script src="base/assets/js/config/tour.js"></script>
    <script>
        Config.set('assets', 'base/assets');
    </script>

    <!-- Page -->
    <script src="base/assets/js/Site.js"></script>
    <script src="global/js/Plugin/asscrollable.js"></script>
    <script src="global/js/Plugin/slidepanel.js"></script>
    <script src="global/js/Plugin/switchery.js"></script>
    <script src="global/js/Plugin/jquery-wizard.js"></script>
    <script src="global/js/Plugin/matchheight.js"></script>

    <script src="base/assets/examples/js/forms/wizard.js"></script>



    <!-- Mascaras -->
    <script src="jquery.mask.min.js" type="text/javascript"></script>
    <script src="bootstrap-notify.min.js" type="text/javascript"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            $('.phone').mask('(00) 00000-0000'); // Máscara para TELEFONE
            $('.cpf').mask('000.000.000-00', {
                reverse: true
            }); // Máscara para CPF
            $('.cep').mask('00000-000'); // Máscara para CEP
            $('.rg').mask('AA-99.999.999'); // Máscara para RG

        });
    </script>

    <!-- Mascaras -->
</body>

</html>
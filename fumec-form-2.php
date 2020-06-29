<?PHP
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: index');
}

$selecione = isset($_GET['selecione']) ? $_GET['selecione'] : 0;

require_once('gets/db_class.php');

$objDb = new db();
$link = $objDb->conecta_mysql();

$id_usuario = $_SESSION['id_usuario'];

$sql2 = "SELECT id_cadastro FROM cadastro where id_usuario = '$id_usuario' ";

$resultado_id2 = mysqli_query($link, $sql2);

$dados_usuario2 = mysqli_fetch_array($resultado_id2);

if ($dados_usuario2 == null) {
    header('Location: fumec-form');
}
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Bolsa Oportunidade FUMEC</title>

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
<style>
    .btn-site {
        background-color: #e4eaec !important;
    }

    div>ol>li>a {
        color: #fff !important;
    }

    .page-title {
        color: #fff !important;
    }

    .page {
        background-image: url(img/fundo.png) !important;
    }

    .error {
        color: red
    }
</style>

<body class="animsition">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- cabeçalho -->
    <?php include('header.php'); ?>
    <!-- cabeçalho -->
    <style>
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
    <?php
    if ($selecione == 1) {
        ?>
        <script>
            $(document).ready(function() {
                $('.curso').css({
                    'border-color': '#ff0000'
                });
            });
        </script>
        <style>
            .curso {
                border-color: #ff0000
            }
        </style>
    <?php
}
?>
    <!-- Page -->
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Bolsa Oportunidade FUMEC</h1><br>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="fumec-form.php">Cadastro</a></li>
                    <li class="breadcrumb-item">Curso</li> -->
                <?php include('caminho.php'); ?>
            </ol>
            <div class="page-header-actions">
                <a class="btn btn-sm btn-default btn-outline btn-round btn-site" href="http://www.fumec.br/" target="_blank">
                    <i class="icon wb-link" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Site Fumec</span>
                </a>
            </div>
        </div>


        <!-- FOMULARIOS -->
        <?php include('conteudo-formulario2/form-insc-2.php'); ?>
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

    <!-- validação -->
    <script type="text/javascript" src="lib/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="dist/jquery.validate.js"></script>
    <script type="text/javascript" src="scripts/validacaoFORMULARIO.js"></script>
    <script type="text/javascript" src="dist/additional-methods.js"></script>
    <script type="text/javascript" src="dist/localization/messages_pt_BR.js"></script>


    <!-- Mascaras -->
    <script src="scripts/jquery.mask.min.js" type="text/javascript"></script>
    <script src="scripts/bootstrap-notify.min.js" type="text/javascript"></script>




    <script type="text/javascript">
        $(document).ready(function() {

            $('.phone').mask('(00) 00000-0000'); // Máscara para TELEFONE
            $('.cpf').mask('000.000.000-00', {
                reverse: true
            }); // Máscara para CPF
            $('.cep').mask('00000-000'); // Máscara para CEP
            $('.rg').mask('AA-99.999.999'); // Máscara para RG

        });


        $(".graduacao").change(function() {
            if ($("#nao").prop("checked") == true) {
                $('#campo').fadeIn("show");
            } else {
                $('#campo').hide();
            }
        });

        //verificar se os campos sao validos
        $(document).ready(function() {

            $('#btn-success').click(function() {

                var campo_vazio = false;

                if ($('.curso').val() == 0) {
                    //alert('teste');
                    $('.curso').css({
                        'border-color': '#ff0000'
                    });
                    campo_vazio = true;
                } else {
                    $('.curso').css({
                        'border-color': '#11c26d'
                    });
                }
                if ($('.curso1').val() == 0) {
                    //alert('teste');
                    $('.curso1').css({
                        'border-color': '#ff0000'
                    });
                    campo_vazio = true;
                } else {
                    $('.curso1').css({
                        'border-color': '#11c26d'
                    });
                }
                if ($('.curso2').val() == 0) {
                    //alert('teste');
                    $('.curso2').css({
                        'border-color': '#ff0000'
                    });
                    campo_vazio = true;
                } else {
                    $('.curso2').css({
                        'border-color': '#11c26d'
                    });
                }


                // if ($('.turno').val() == '') {
                //     $('.turno').css({
                //         'border-color': '#ff0000'
                //     });
                //     campo_vazio = true;
                // } else {
                //     alert('teste');
                //     $('.turno').css({
                //         'border-color': '#11c26d'
                //     });
                // }

                if (campo_vazio) return false;

            });

        });
    </script>
    <!-- Mascaras -->
</body>

</html>
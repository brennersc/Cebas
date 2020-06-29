<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Esqueceu | Bolsa Oportunidade FUMEC</title>

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
    <link rel="stylesheet" href="base/assets/examples/css/pages/forgot-password.css">


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

<body class="animsition page-forgot-password layout-full">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
            <h2>Esqueceu sua senha ?</h2>
            <p>Insira seu email registrado para redefinir sua senha</p>

            <form method="post" role="form">
                <div class="form-group">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Seu Email">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Redefinir sua senha</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Page -->


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

    <script>
        (function(document, window, $) {
            'use strict';

            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);
    </script>
</body>

</html>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Esqueci a senha | Bolsa Oportunidade FUMEC</title>
    <link rel="icon" href="../img/logo-branco.png">
    <link rel="stylesheet" href="../global/css/bootstrap.min.css">
    <link rel="stylesheet" href="../global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="../base/assets/css/site.min.css">
    <link rel="stylesheet" href="../global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="../base/assets/examples/css/pages/login-v3.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
</head>

<body class="animsition page-login-v3 layout-full">
    <style>
        img {

            width: 200px !important;
            height: 200px !important;
        }
        .page-login-v3:before {
            background-image: url(../img/fundo.png) !important;

        }
        .page {
            background-image: url(../img/fundo.png) !important;
        }
    </style>

    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
            <div class="panel">
                <div class="panel-body">
                <h1>Esqueceu sua senha?</h1>
                  <p class="lead">Informe seu e-mail que enviaremos instruções para cadastro de uma nova senha.</p>
                  <?php
                     $msg = isset($_GET['msg']) ? base64_decode($_GET['msg']) : '';
                     switch($msg){
                        case 1: 
                           $alerta = "<strong>Mensagem enviada com sucesso.</strong><br>Caso o e-mail não tenha chegado na sua caixa de entrada, por favor, verifique sua pasta de spam (lixo eletrônico) ou suas configurações de spam."; 
                           $divClass = "alert-success";
                           break;
                        case 2: 
                           $alerta = "Não foi possível enviar e-mail com nova senha";
                           $divClass = "alert-danger";
                           break;
                        case 3: 
                           $alerta = "Não foi possível localizar o e-mail informados";
                           $divClass = "alert-danger";
                           break;
                        case 4: 
                           $alerta = "<strong>SENHA enviada com sucesso.</strong><br>Caso o e-mail não tenha chegado na sua caixa de entrada, por favor, verifique sua pasta de spam (lixo eletrônico) ou suas configurações de spam.";
                           $divClass = "alert-success";
                           break;
                        case 5: 
                           $alerta = "Chave de identificação inválida. Solicite uma nova senha";
                           $divClass = "alert-warning";
                           break;
                     }
                     if(isset ($alerta)):
                        ?>
                        <div class="alert <?php echo $divClass ?>" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <?php echo $alerta ?>
                        </div>
                     <?php endif; ?>

                  <form method="post" name="formulario" action="esqueci_action.php" role="form">
                     <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required size="32" maxlength="150" class="form-control input-lg">
                     </div>       
                     <div class="form-group">
                     <input type="submit" value="Enviar solicitação" class="btn btn-primary">
                     <a href="http://bolsaoportunidade.fumec.br/login" class="btn btn-default">Voltar para o login</a>
                     </div>
                  </form>  

                </div>
            </div>
        </div>
    </div>
    <script src="../global/vendor/jquery/jquery.js"></script>>
    <script src="../global/vendor/bootstrap/bootstrap.js"></script>
    
</body>

</html>


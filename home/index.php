<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">

  <title>Bolsa Oportunidade FUMEC</title>
  <link rel="icon" href="../img/logo-branco.png">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link rel="icon" href="img/LOGO-MOSTRA-2019.png">
  <link href="css/style.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Navigation teste git -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span id="logos" class="logo" alt="logo-fumec" title="Universidade FUMEC">logo fumec</span>
        <!-- <img src="img/logo-fumec.png" alt="logo-fumec" title="Universidade FUMEC"> -->
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="#duvidas">INFORMAÇÕES</a> </li>
          <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="resultado#lista">RESULTADO</a> </li>
          <?php if (date('d/m/Y') <= '27/08/2019') { ?>
          <li class="nav-item"> <a class="nav-link caixa-rosa js-scroll-trigger" href="#inscreva">INSCREVA-SE</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <section class="masthead">

  </section>

  <section id="inscreva">
    <div class="container">

      <?php if (date('d/m/Y') <= '27/08/2019') { ?>
      <div class="row">
        <a class="caixa-rosa center" href="../login" style="font-size:30px">INSCREVA-SE</a>
      </div>
      <br>
      <div class="row">

        <div class="col-12" style="text-align:center">
          <span class="texto" style="font-size:35px;  text-align:center">O seu sonho de estudar em uma excelente
            <br>universidade vai se tornar realidade!</span></div>

      </div>
      <br><br>
      <div class="row">
        <span class="" style="font-size:25px;  text-align:center">
          A graduação é um grande passo para o sucesso profissional e a Universidade FUMEC quer proporcionar novas
          oportunidades para você!
        </span>
        <br><br>
        <span class="" style="font-size:25px;  text-align:center">
          Estamos lançando o <b>Bolsa Oportunidade FUMEC</b>, que oferece <b>bolsas de estudos de 100%, em
            todos os nossos cursos</b>. Consulte condições e faça sua inscrição!
        </span>
      </div>
      <?php } ?>
      <br><br>
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-6">
          <a href="../pdf/Edital Bolsa Oportunidade - Processo Seletivo 1 sem 2019.pdf" target="_blank"><img class="pdf-img" src="../img/PDF_icone.png"></a>
        </div>
        <div class="col-12 col-sm-12 col-lg-6"><span class="" style="font-size:30px; color:rgb(19, 109, 228)"><a href="../pdf/Edital Bolsa Oportunidade - Processo Seletivo 1 sem 2019.pdf" target="_blank"><i>Acesse aqui o
                Edital completo</i></a></span>
          <p><span class="" style="font-size:25px; text-align: justify;">
              Não adie o seu sonho de estudar em uma tradicional UNIVERSIDADE, com mais de 50 anos de história! E tudo
              isso </span><span class="" style="font-size:25px; color:rgb(19, 109, 228)">GRATUITAMENTE!</span>
        </div>

      </div>
      <br><br>
      <hr class="my-4">
      <br><br>

      <div class="row">
        <span class="" style="font-size:25px;  text-align:center; width: 100%; position: relative">
          Você que se inscreveu na seleção para a <p>Bolsa Oportunidade da Universidade FUMEC,
        </span>
      </div>
      <div class="row">
        <span id="duvidas" class="" style="font-size:35px;  text-align:center; width: 100%; position: relative; padding-top: 50px">
          <b>ATENÇÃO!</b>
        </span>
      </div>
      <div class="row">
        <span class="" style="font-size:25px;  text-align:center; width: 100%; position: relative; padding-top: 50px">
          <b>Para dar continuidade ao processo, você deve se inscrever e realizar o Vestibular ou informar a nota do
            ENEM, para isso:</b>
        </span>
      </div>

      <div class="row">
        <span class="" style="font-size:23px;  text-align:justify; width: 100%; position: relative; padding-top: 50px; margin-left: 100px">
          <b>•</b> Acesse o link abaixo para agendar gratuitamente a sua prova do Vestibular e selecione a opção <b>PROVA
            AGENDADA.</b>
        </span>
        <span class="" style="font-size:23px;  text-align:justify; width: 100%; position: relative; padding-top: 50px; margin-left: 100px">
          <b>•</b> Cadastre a sua NOTA DO ENEM (caso já tenha realizado a prova do EXAME NACIONAL DE ENSINO MÉDIO em
          2018
          ou anos anteriores) e selecione a opção <b>ENEM.</b>
        </span>
      </div>
      <div class="row">
        <a class="caixa-rosa botao-centro" href="http://www.inscricao.fumec.br/bolsaoportunidade" style="margin-left: 25%; font-size:30px; margin-top: 50px">inscricao.fumec.br/bolsaoportunidade</a>
      </div>
      <div class="row">
        <span class="" style="font-size:25px;  text-align:center; width: 100%; position: relative; padding-top: 50px">
          Caso já tenha participado do Vestibular da Universidade FUMEC ou cadastrado a sua nota do ENEM para o 2º
          semestre de 2019, pedimos que aguarde a próxima etapa do processo.
        </span>
      </div>
      <br><br>
      <hr class="my-4">
      <br>
      <div class="row">
        <span class="" style="font-size:30px;  text-align:center; width: 100%; position: relative; padding-top: 50px">
          <b>A FUMEC acredita em você!</b>
        </span>
      </div>
    </div>

  </section>

  <section id="rodape">
    <div class="container">

      <div class="row">
        <span class="" style="color: #fff; font-size:30px;  text-align:center; width: 100%; position: relative;">
          <b>FALE CONOSCO E SIGA NOSSAS REDES</b>
        </span>
      </div>
      <br><br>
      <div class="row">
        <div class="col-lg-3 ml-auto text-center rodape"> <i class="fa fa-phone fa-3x mb-3 sr-contact" style="color: #fff"></i>
          <p style="color: #fff">0800 0300 200</p>
        </div>
        <div class="col-lg-3 mr-auto text-center rodape"> <i class="fa fa-facebook-square fa-3x mb-3 sr-contact" style="color: #fff"></i>
          <p style="color: #fff"> <a class="rodape" href="http://pt-br.facebook.com/fumec" target="_blank">Facebook</a> </p>
        </div>
        <div class="col-lg-3 mr-auto text-center rodape"> <i class="fa fa-instagram fa-3x mb-3 sr-contact" style="color: #fff"></i>
          <p style="color: #fff"> <a class="rodape" href="https://www.instagram.com/fumec/" target="_blank">Instagram</a> </p>
        </div>
        <div class="col-lg-3 mr-auto text-center rodape"> <i class="fa fa-youtube-play fa-3x mb-3 sr-contact" style="color: #fff"></i>
          <p style="color: #fff"> <a class="rodape" href=" https://www.youtube.com/user/UniversidadeFumecMG/videos" target="_blank">YouTube</a> </p>
        </div>
      </div>
    </div>
  </section>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script type="text/javascript" src="vendor/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
  <script src="js/creative.js"></script>
</body>

</html>
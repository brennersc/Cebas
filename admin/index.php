
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>CEBAS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="vendor/css/login.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <form method="POST" action="login.php" class="form-signin">
      <img class="mb-4" src="img/logo-small.png" alt="" >
        <?php if(isset($_GET['msg'])&& $_GET['msg'] == '010' ) :?>
        <div class="alert alert-danger" role="alert">
          <b>Usuario ou senha inválidos</b>
        </div>
        <?php endif ?>
      <label for="inputEmail" class="sr-only">Login</label>
      <input type="text" id="inputEmail" class="form-control" name="login" placeholder="Login" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; CEBAS </p>
    </form>
  </body>
</html>

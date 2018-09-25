<?php
session_start();
  require_once "inc/config.php";
  if(isset($_SESSION['codUsuarioG']) )
	{
		 session_destroy();
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>VIVECORP</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1></h1>
      </div>
      <div class="login-box">
        <form class="login-form" action="POST" id="wfrLogin">
          <h3 class="login-head"><img src="images/logo.jpg" width="250" alt="" ></h3>

          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input class="form-control" type="text" id="txtUsuario" placeholder="Usuario" autofocus required>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" id="txtPassword" placeholder="Password" required>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>LOGIN</button>
          </div>
        </form>
        <div id="msgError" class="alert alert-danger" role="alert" style="display: none"></div>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- llamar a las clases jquery -->
    <script src="jsapp/login.js"></script>
    <!-- llamar a las clases jquery fin -->
    <script type="text/javascript">

    </script>
  </body>
</html>

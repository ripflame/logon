<?php
include( 'includes/require_ssl.php' );
include( 'includes/db_controller.php' );
include( 'includes/helpers.php' );

global $salt;

if ( isset( $_POST['submit'] ) ) {
  $email_sent = true;
  $email = $db->real_escape_string( $_POST['email'] );

  if ( user_email_exists( $email ) ) {
    $timestamp = date_timestamp_get( date_create() );
    $token = md5( $token . $timestamp );

    if ( user_forgot_password( $email, $token ) ) {
      send_fp_email( $email, $token );
    }

  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logon - Login</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header">
	<div id="menu" class="container">
		<ul>
			<li><a href="index.php" accesskey="1" title="">Home</a></li>
			<li class="current_page_item"><a href="login.php" accesskey="1" title="">Login</a></li>
			<li><a href="register.php" accesskey="2" title="">Registro</a></li>
		</ul>
	</div>
</div>
<div id="logo" class="container">
	<h1><a href="index.php" class="icon icon-cogs"><span>Logon</span></a></h1>
</div>
<div id="page" class="container">
	<div id="content" class="centered">
		<div class="title">
			<h2>Olvidé mi contraseña</h2>
      <?php if ( $email_sent ) : ?>
			<span class="byline">Se ha enviado un link a tu correo</span>
      <p>Recuerda revisar tu carpeta de spam.</p>
      <a class="button" href="login.php" title="Login">Login</a>
      <?php else : ?>
			<span class="byline">Ingresa tu correo electrónico</span>
		</div>
    <form class="table" action="" method="post">
      <table cellspacing="15">
        <tr>
          <td>
            <label for="email">Correo electrónico</label>
          </td>
          <td>
            <input type="email" id="email" name="email" value="" required>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="submit" value="Enviar">
          </td>
        </tr>
      </table>
    </form>
    <?php endif; ?>
	</div>
</div>
<div id="copyright" class="container">
	<p>Copyright &copy; 2014 Leon-Enriquez.com All rights reserved.</p>
</div>
<div class="badge container">
  <a href="http://digitalocean.com" title="Digital Ocean" target="_blank"><img src="images/digitalOceanBadge.png" alt="digitalocean"></a>
</div>
</body>
</html>

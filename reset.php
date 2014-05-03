<?php
include( 'includes/require_ssl.php' );
include( 'includes/db_controller.php' );
include( 'includes/helpers.php' );

global $salt;

$token_valid = false;
$password_reset = false;

if ( isset( $_GET['token'] ) && isset( $_GET['email'] ) )  {
  if ( token_is_valid( $_GET['token'] ) ) {
    $token_valid = true;
    $email = $_GET['email'];
  }
} else {
  header( 'Location: login.php' );
  exit();
}

if ( isset( $_POST['submit'] ) ) {
  $password = $db->real_escape_string( $_POST['password'] );
  $password_confirm = $db->real_escape_string( $_POST['password_confirm'] );

  if ( $password == $password_confirm ) {
    if ( update_user_password( $password ) ) {
      $password_reset = true;
    }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logon - Reinicio de contraseña</title>
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
			<h2>Reinicio de contraseña</h2>
      <?php if ( $password_reset ) : ?>
			<span class="byline">Tu contraseña ha sido cambiada.</span>
      <a class="button" href="login.php" title="Login">Login</a>
      <?php elseif ( !$token_valid ) : ?>
			<span class="byline red">Este link ya no es válido.</span>
      <a class="button" href="login.php" title="Login">Login</a>
		</div>
      <?php else : ?>
			<span class="byline">Ingresa tu contraseña nueva</span>
		</div>
    <form class="table" action="" method="post">
      <table cellspacing="15">
        <tr>
          <td>
            <label for="password">Contraseña nueva</label>
          </td>
          <td>
            <input type="password" id="password" name="password" value="" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="password_confim">Confirma tu contraseña</label>
          </td>
          <td>
            <input type="password" id="password_confim" name="password_confim" value="" required>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="submit" value="Actualizar contraseña">
          </td>
        </tr>
      </table>
      <input type="hidden" name="email" value="<?= $email; ?>">
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

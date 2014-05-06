<?php
include( 'includes/require_ssl.php' );
include( 'includes/db_controller.php' );
include( 'includes/helpers.php' );

global $salt;

session_start();

$token_valid = false;
$password_reset = false;

if ( isset( $_POST['submit'] ) ) {
  $password = $db->real_escape_string( $_POST['password'] );
  $password_confirm = $db->real_escape_string( $_POST['password_confirm'] );
  $email = $db->real_escape_string( $_POST['email'] );

  if ( $password == $password_confirm ) {
    if ( update_user_password( $password, $email ) ) {
      $password_reset = true;
    }
  }
} else {
  if ( isset( $_GET['token'] ) && isset( $_GET['email'] ) )  {
    if ( token_is_valid( $_GET['token'] ) ) {
      $token_valid = true;
      $email = $_GET['email'];
    }
  } else {
    if ( isset( $_SESSION['username'] ) ) {
      header( 'Location: profile.php' );
    } else {
      header( 'Location: login.php' );
    }
    exit();
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
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="js/main.js" type="text/javascript"></script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header">
	<div id="menu" class="container">
		<ul>
			<li class="current_page_item"><a href="index.php" accesskey="1" title="">Home</a></li>
      <?php if ( isset( $_SESSION['username'] ) ) : ?>
      <li><a href="profile.php" accesskey="1" title=""><?php echo $_SESSION['username']; ?></a>
      <li><a href="includes/logout.php" accesskey="2" title="">Salir</a>
      <?php else: ?>
			<li><a href="login.php" accesskey="1" title="">Login</a></li>
			<li><a href="register.php" accesskey="2" title="">Registro</a></li>
      <?php endif; ?>
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
            <label for="password_confirm">Confirma tu contraseña</label>
          </td>
          <td>
            <input type="password" id="password_confirm" name="password_confirm" value="" required>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="submit" value="Actualizar contraseña">
          </td>
        </tr>
      </table>
      <input type="hidden" id="email" name="email" value="<?= $email; ?>">
    </form>
    <div id="pswd_info">
      <h4>La contraseña debe cumplir lo siguiente:</h4>
      <ul>
        <li id="letter" class="invalid">Cuando menos <strong>una letra</strong></li>
        <li id="capital" class="invalid">Cuando menos <strong>una mayúscula</strong></li>
        <li id="number" class="invalid">Cuando menos <strong>un número</strong></li>
        <li id="length" class="invalid">Cuando menos <strong>8 caracteres</strong></li>
      </ul>
    </div>
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

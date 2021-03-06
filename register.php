<?php
session_start();
if ( isset( $_SESSION['username'] ) ) {
  header( 'Location: profile.php' );
}

include( 'includes/require_ssl.php' );
include( 'includes/db_controller.php' );

$user_already_exists = false;

if ( isset( $_POST['submit'] ) ) {
  $username = $db->real_escape_string( $_POST['username'] );
  $password = $db->real_escape_string( $_POST['password'] );
  $password_confirm = $db->real_escape_string( $_POST['password_confirm'] );
  $name = $db->real_escape_string( $_POST['name'] );
  $last_name_1 = $db->real_escape_string( $_POST['last_name_1'] );
  $last_name_2 = $db->real_escape_string( $_POST['last_name_2'] );
  $email = $db->real_escape_string( $_POST['email'] );
  if ( isset( $_POST['age'] ) && !isset( $_POST['sex'] ) ) {
    $age = $db->real_escape_string( $_POST['age'] );
  }

  if ( isset( $_POST['sex'] ) && !isset( $_POST['age'] ) ) {
    $sex = $db->real_escape_string( $_POST['sex'] );
  }

  if ( isset( $_POST['sex'] ) && isset( $_POST['age'] ) ) {
    $age = $db->real_escape_string( $_POST['age'] );
    $sex = $db->real_escape_string( $_POST['sex'] );
  }

  if ( !username_exists( $username ) && !user_email_exists( $email ) ) {
    if ( $password == $password_confirm ) {
      $crypt_password = crypt( $password );
      if ( isset( $age ) && !isset( $sex ) ) {
        $query = " INSERT INTO `users` (`username`, `password`, `name`, `last_name_1`, `last_name_2`, `email`, `age`, `privilege`) VALUES ('$username', '$crypt_password', '$name', '$last_name_1', '$last_name_2', '$email', '$age', 1)";
      }
      if ( isset( $sex ) && !isset( $age ) ) {
        $query = " INSERT INTO `users` (`username`, `password`, `name`, `last_name_1`, `last_name_2`, `email`, `sex`, `privilege`) VALUES ('$username', '$crypt_password', '$name', '$last_name_1', '$last_name_2', '$email', '$sex', 1)";
      }
      if ( isset( $sex ) && isset( $age ) ) {
        $query = " INSERT INTO `users` (`username`, `password`, `name`, `last_name_1`, `last_name_2`, `email`, `age`, `sex`, `privilege`) VALUES ('$username', '$crypt_password', '$name', '$last_name_1', '$last_name_2', '$email', '$age', '$sex', 1)";
      }

      if ( $db->query( $query ) ) {
        $_SESSION['username'] = $username;
        $_SESSION['login'] = date("Y-m-d H:i:s");
        header( 'Location: profile.php' );
        exit();
      }
    }
  } else {
    $user_already_exists = true;
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logon - Registro</title>
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
			<li><a href="index.php" accesskey="1" title="">Home</a></li>
			<li><a href="login.php" accesskey="1" title="">Login</a></li>
			<li class="current_page_item"><a href="register.php" accesskey="2" title="">Registro</a></li>
		</ul>
	</div>
</div>
<div id="logo" class="container">
	<h1><a href="index.php" class="icon icon-cogs"><span>Logon</span></a></h1>
</div>
<div id="page" class="container">
	<div id="content" class="centered">
		<div class="title">
			<h2>Regístrate</h2>
      <?php if ( $user_already_exists ) : ?>
        <span class="byline red">Este usuario ya está registrado.</span>
      <?php elseif ( !$user_already_exists ) : ?>
        <span class="byline">Prueba de concepto de login seguro.</span>
      <?php endif; ?>
		</div>
    <form class="table" action="" method="post">
      <table cellspacing="15">
        <tr>
          <td>
            <label for="username">Nombre de usuario <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="username" name="username" value="" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="email">Email <span class="red">*</span></label>
          </td>
          <td>
            <input type="email" id="email" name="email" value="" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="password">Contraseña <span class="red">*</span></label>
          </td>
          <td>
            <input type="password" id="password" name="password" value="" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="password_confirm">Confirma tu contraseña <span class="red">*</span></label>
          </td>
          <td>
            <input type="password" id="password_confirm" value="" name="password_confirm" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="name">Nombre(s) <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="name" value="" name="name">
          </td>
        </tr>
        <tr>
          <td>
            <label for="last_name_1">Primer Apellido <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="last_name_1" value="" name="last_name_1">
          </td>
        </tr>
        <tr>
          <td>
            <label for="last_name_2">Segundo Apellido <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="last_name_2" value="" name="last_name_2">
          </td>
        </tr>
        <tr>
          <td>
            <label for="age">Edad</label>
          </td>
          <td>
            <input type="number" id="age" value="" name="age" min="1">
          </td>
        </tr>
        <tr>
          <td>
            <label for="sex">Sexo</label>
          </td>
          <td>
            <select name="sex" id="sex">
              <option value=""></option>
              <option value="Hombre">Hombre</option>
              <option value="Mujer">Mujer</option>
            </select>
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
    <div id="pswd_info">
      <h4>La contraseña debe cumplir lo siguiente:</h4>
      <ul>
        <li id="letter" class="invalid">Cuando menos <strong>una letra</strong></li>
        <li id="capital" class="invalid">Cuando menos <strong>una mayúscula</strong></li>
        <li id="number" class="invalid">Cuando menos <strong>un número</strong></li>
        <li id="length" class="invalid">Cuando menos <strong>8 caracteres</strong></li>
        <li id="both" class="invalid">Ambas contraseñas son <strong>iguales</strong></li>
      </ul>
    </div>
    <p>Los campos con un asterisco ( <span class="red">*</span> ) son obligatorios.</p>
	</div>
</div>
<div id="copyright" class="container">
	<p>Copyright &copy; 2014 Leon-Enriquez.com. All rights reserved.</p>
</div>
<div class="badge container">
  <a href="http://digitalocean.com" title="Digital Ocean" target="_blank"><img src="images/digitalOceanBadge.png" alt="digitalocean"></a>
</div>
</body>
</html>

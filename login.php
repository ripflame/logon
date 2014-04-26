<?php
include( 'includes/db_controller.php' );

if ( isset( $_POST['submit'] ) ) {
  $username = $db->real_escape_string( $_POST['username'] );
  $password = $db->real_escape_string( $_POST['password'] );

  if ( is_valid_user( $username, $password ) ) {
    session_start();
    $_SESSION['username'] = $username;
    header( 'Location: index.php' );
    exit();
  } else {
    echo 'Nombre de usuario o contraseña inválidos';
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
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
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
	<h1><a href="#" class="icon icon-cogs"><span>Logon</span></a></h1>
</div>
<div id="page" class="container">
	<div id="content" class="centered">
		<div class="title">
			<h2>Ingresa</h2>
			<span class="byline">Prueba de concepto de login seguro.</span>
		</div>
    <form class="table" action="" method="post">
      <table cellspacing="0">
        <tr>
          <td>
            <label for="username">Nombre de usuario</label>
          </td>
          <td>
            <input type="text" id="username" name="username" value="" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="password">Contraseña</label>
          </td>
          <td>
            <input type="password" id="password" name="password" value="" required>
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
	</div>
</div>
<div id="copyright" class="container">
	<p>Copyright &copy; 2014 Logon.com. All rights reserved.</a></p>
</div>
</body>
</html>

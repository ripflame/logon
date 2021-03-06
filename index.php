<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logon</title>
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
	<div id="content">
		<div class="title">
			<h2>Bienvenido a Logon</h2>
			<span class="byline">Prueba de concepto de login seguro.</span>
		</div>
		<!--<p>This is <strong>TwoColours</strong>, a free, fully standards-compliant CSS template designed by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under a <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attributions 3.0</a> license, so you are pretty much free to do whatever you want with it (even use it commercially) provided you keep the links in the footer intact. Aside from that, have fun with it :) </p>-->
    <p><strong>Logon</strong> es una prueba de concepto para un módulo seguro de manejo de sesiones y de login.</p>
	</div>
	<div id="sidebar"><img class="image image-full" src="images/server.jpg" alt=""/></div>
</div>
<div id="featured-wrapper">
	<div id="featured" class="container">
		<div class="major">
			<h2>Características</h2>
			<span class="byline">Características de seguridad de esta prueba de concepto</span>
		</div>
		<div class="column1">
			<span class="icon icon-user"></span>
			<div class="title">
				<h2>Nombres de usuarios</h2>
				<span class="byline">Id's de usuarios no sensibles a mayúsculas</span>
			</div>
		</div>
		<div class="column2">
			<span class="icon icon-asterisk"></span>
			<div class="title">
				<h2>Contraseñas</h2>
				<span class="byline">Control de contraseña fuerte</span>
			</div>
		</div>
		<div class="column3">
			<span class="icon icon-asterisk"></span>
			<div class="title">
				<h2>Contraseñas</h2>
				<span class="byline">Mecanismo seguro de recuperación de contraseña</span>
			</div>
		</div>
		<div class="column4">
			<span class="icon icon-asterisk"></span>
			<div class="title">
				<h2>Contraseñas</h2>
				<span class="byline">Transmisión de contraseña sobre TLS</span>
			</div>
		</div>
    <div style="height: 20px; clear: both;"></div>
		<div class="column1">
			<span class="icon icon-signin"></span>
			<div class="title">
				<h2>Autenticación</h2>
				<span class="byline"><strike>Re-autenticación para editar características sensibles de configuración</strike></span>
			</div>
		</div>
		<div class="column2">
			<span class="icon icon-warning-sign"></span>
			<div class="title">
				<h2>Errores</h2>
				<span class="byline">Mensajes adecuados de error de inicio de sesión</span>
			</div>
		</div>
		<div class="column3">
			<span class="icon icon-lock"></span>
			<div class="title">
				<h2>Seguridad</h2>
				<span class="byline"><strike>Prevención de ataques de fuerza bruta</strike></span>
			</div>
		</div>
		<div class="column4">
			<span class="icon icon-home"></span>
			<div class="title">
				<h2>Sesiones</h2>
        <span class="byline">Expiración de sesión: <strong>automática</strong>, <strong>manual</strong> <strike>y del lado del <strong>cliente</strong></strike></span>
			</div>
		</div>
	</div>
</div>
<div id="contact" class="container">
		<div class="major">
			<h2>Desarrolladores</h2>
			<!--<span class="byline">Phasellus nec erat sit amet nibh pellentesque congue</span>-->
      <ul class="byline">
        <li>Gilberto León</li>
        <li>Amado Canté</li>
        <li>Mario Silveira</li>
        <li>Andrés Rosado</li>
      </ul>
		</div>
		<ul class="contact">
			<li><a href="https://github.com/ripflame/logon" class="icon icon-github"><span>Github</span></a></li>
		</ul>
</div>
<div id="copyright" class="container">
  <p>Copyright &copy; 2014 Leon-Enriquez.com All rights reserved.</p>
</div>
<div class="badge container">
  <a href="http://digitalocean.com" title="Digital Ocean" target="_blank"><img src="images/digitalOceanBadge.png" alt="digitalocean"></a>
</div>
</body>
</html>

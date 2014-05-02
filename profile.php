<?php
include( 'includes/lock.php' );
include( 'includes/require_ssl.php' );
include( 'includes/db_controller.php' );
session_start();

if ( $_SERVER["REQUEST_METHOD"] == "GET" ) {
  if ( isset( $_GET['edit'] ) ) {
    if ( $_GET['edit'] = "yes" ) {
      $edit_mode = true;
    }
  }
}

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $db->real_escape_string( $_POST['username'] );
  $email = $db->real_escape_string( $_POST['email'] );
  $name = $db->real_escape_string( $_POST['name'] );
  $last_name_1 = $db->real_escape_string( $_POST['last_name_1'] );
  $last_name_2 = $db->real_escape_string( $_POST['last_name_2'] );
  $age = $db->real_escape_string( $_POST['age'] );
  $sex = $db->real_escape_string( $_POST['sex'] );

  if ( update_user( $username, $email, $name, $last_name_1, $last_name_2, $age, $sex ) ) {
    header( 'Location: profile.php' );
    exit();
  }
}

$user = get_user( $_SESSION['username'] );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logon - Perfil</title>
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
	<h1><a href="profile.php" class="icon icon-user"><span><?php echo $_SESSION['username']; ?></span></a></h1>
</div>
<div id="page" class="container">
	<div id="content" class="centered">
		<div class="title">
			<h2>Perfil de usuario</h2>
			<span class="byline">Estos son tus datos de usuario.</span>
		</div>
    <?php if ( !$edit_mode ): ?>
    <form class="table" action="" method="get">
      <table cellspacing="15">
        <tr>
          <td>
            <label for="username">Nombre de usuario:</label>
          </td>
          <td>
            <span class="profile" id="username"><?= $user['username']; ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <label for="email">Email:</label>
          </td>
          <td>
            <span class="profile-data" id="email"><?= $user['email']; ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <label for="name">Nombre:</label>
          </td>
          <td>
            <span class="profile-data" id="name"><?= $user['name'] . ' ' . $user['last_name_1'] . ' ' . $user['last_name_2']; ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <label for="age">Edad:</label>
          </td>
          <td>
            <span class="profile-data" id="age"><?= $user['age']; ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <label for="sex">Sexo:</label>
          </td>
          <td>
            <span class="profile-data" id="sex"><?= $user['sex']; ?></span>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" value="Editar">
          </td>
        </tr>
      </table>
      <input type="hidden" name="edit" value="yes">
    </form>
    <?php else: ?>
    <form class="table" action="" method="post">
      <table cellspacing="15">
        <tr>
          <td>
            <label for="username">Nombre de usuario:</label>
          </td>
          <td>
            <span class="profile"><?= $user['username']; ?></span>
            <input type="hidden" name="username" value="<?= $user['username']; ?>" id="username">
          </td>
        </tr>
        <tr>
          <td>
            <label for="email">Email <span class="red">*</span></label>
          </td>
          <td>
            <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="name">Nombre(s) <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="name" value="<?= $user['name']; ?>" name="name" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="last_name_1">Primer Apellido <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="last_name_1" value="<?= $user['last_name_1']; ?>" name="last_name_1" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="last_name_2">Segundo Apellido <span class="red">*</span></label>
          </td>
          <td>
            <input type="text" id="last_name_2" value="<?= $user['last_name_2']; ?>" name="last_name_2" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="age">Edad</label>
          </td>
          <td>
            <input type="number" id="age" value="<?= $user['age']; ?>" name="age" min="1">
          </td>
        </tr>
        <tr>
          <td>
            <label for="sex">Sexo</label>
          </td>
          <td>
            <select name="sex" id="sex">
              <option value=""></option>
              <option value="Hombre" <?php if ( $user['sex'] == "Hombre" ) echo selected; ?>>Hombre</option>
              <option value="Mujer" <?php if ( $user['sex'] == "Mujer" ) echo selected; ?>>Mujer</option>
            </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="submit" value="Guardar cambios">
          </td>
        </tr>
      </table>
    </form>
    <p>Los campos con un asterisco ( <span class="red">*</span> ) son obligatorios.</p>
    <?php endif; ?>
	</div>
</div>
<div id="copyright" class="container">
	<p>Copyright &copy; 2014 Logon.com. All rights reserved.</a></p>
</div>
<div class="badge container">
  <img src="images/digitalOceanBadge.png" alt="digitalocean">
</div>
</body>
</html>

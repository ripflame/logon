<?php
include( 'config.php' );

function update_user( $username, $email, $name, $last_name_1, $last_name_2, $age, $sex ) {
  global $db;

  $query = "UPDATE `users` set `username`='".$username."', `email`='".$email."', `name`='".$name."', `last_name_1`='".$last_name_1."', `last_name_2`='".$last_name_2."', `age`='".$age."', `sex`='".$sex."' WHERE `username`='".$username."'";
  if ( $db->query( $query ) ) {
    return true;
  } else {
    return false;
  }
}

// Recordar codificar funcionalidad
function username_exists( $username ) {
  return false;
}

// Recordar codificar funcionalidad
function user_email_exists( $email ) {
  return true;
}

function is_valid_user( $username, $password ) {
  global $db;

	$query = "SELECT * FROM `users` WHERE `username`='$username'";
	$result = $db->query( $query );
	if($result->num_rows == 1) {
		$row = 	$result->fetch_assoc();
		if(crypt($password, $row["password"]) == $row["password"]) {
      return true;
		} else {
      return false;
		}
	} else {
    return false;
	}
}

function get_user( $username ) {
  global $db;

	$query = "SELECT * FROM `users` WHERE `username`='$username'";
	$result = $db->query( $query );
	if($result->num_rows == 1) {
		$row = 	$result->fetch_assoc();
    return $row;
	} else {
    return false;
	}
}

function user_forgot_password( $email, $token ) {
  global $db;

  $query = "UPDATE `users` set `token`='".$token."', last_time_forgot='".date("Y-m-d H:i:s")."' WHERE `email`='".$email."'";
  if ( $db->query( $query ) ) {
    return true;
  } else {
    return false;
  }
}

function token_is_valid( $token ) {
  global $db;

  $query = "SELECT `token` FROM `users` WHERE `token`='$token'";
	$result = $db->query( $query );
  if($result->num_rows == 1) {
    $query = "SELECT `last_time_forgot` FROM `users` WHERE `token`='$token'";
    $result = $db->query( $query );
    $row = $result->fetch_assoc();
    $last_time_forgot = $row['last_time_forgot'];
    if ( strtotime( $last_time_forgot ) > strtotime( "-30 minutes" ) ) {
      return true;
    }
	} else {
    return false;
	}
}
?>

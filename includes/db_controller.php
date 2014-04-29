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

function user_exists( $username ) {
  return false;
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
?>

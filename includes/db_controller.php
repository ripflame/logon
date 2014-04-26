<?php
include( 'config.php' );

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
?>

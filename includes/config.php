<?php
$db_hostname = "localhost";
$db_user = "logondb";
$db_password = "Hhft8dbT69y5pAMQ";
$db_name = "logondb";

$db = new mysqli( $db_hostname, $db_user, $db_password, $db_name );
$db->set_charset( 'utf8' );

$salt = 'LazerSharksAreL337';
?>

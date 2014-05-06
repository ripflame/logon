<?php
include( 'config.php');
session_start();
if ( !isset( $_SESSION['username'] ) || $_SESSION['login'] > strtotime( "-30 minutes" ) ) {
  header( 'Location: ../index.php' );
}
?>

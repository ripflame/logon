<?php

function send_fp_email( $email, $token ) {
  $to = $email;
  $subject = 'Recuperación de contraseña';
  $headers = 'From: webmaster@leon-enriquez.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
  $message = "Para recuperar tu contraseña sigue el siguiente link: \r\n" .
    "https://leon-enriquez.com/logon/reset.php?token=" . $token . "&email=" . $email;

  return mail($to, $subject, $message, $headers);
}

?>

<?php
$to      = 'ripflame@gmail.com';
$subject = 'Desde PHP';
$message = 'PROBANDO ESTA MIERDA';
$headers = 'From: webmaster@leon-enriquez.com' . "\r\n" .
    'Reply-To: webmaster@leon-enriquez.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>

<?php
$to      = 'fqqcnhif@guerrillamail.com';
$subject = 'Desde PHP';
$message = 'PROBANDO ESTA MIERDA';
$headers = 'From: don@verga.com' . "\r\n" .
    'Reply-To: don@vergacom' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>

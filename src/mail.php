<?php

//mail("nico@becode.org", "subject", "message", "From: Sender");

//die();

//$success = mail('example@example.com', 'My Subject', "message");
//if (!$success) {
  //  print_r(error_get_last());
//}

//phpinfo();

$to      = "hoge@localhost.local";
$subject = "TEST";
$message = "Test du courrier";
$headers = "From: from@example.com";

//mail($to, $subject, $message, $headers);

use PHPMailer\PHPMailer\PHPMailer;

require_once "includes/phpmailer/Exception.php";
require_once "includes/phpmailer/PHPMailer.php";
//require_once "includes/phpmailer/SMTP.php";

$mail = new PHPMailer(true);


try {
    // config
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // Simple Mail Transfer Protocol
    //$mail->isSMTP();
    $mail->Host = "localhost";
    $mail->Port = 1025; // Used by Mailhog

    // Charset
    $mail->CharSet = "utf-8";

    // Recipient
    $mail->addAddress("nico@becode.org");

    // Sender
    $mail->setFrom("nicolas.jamar@gmail.com");

    // Content
    $mail->Subject = "Subscribe to your app";
    $mail->Body = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
    Dolor excepturi neque perferendis. Assumenda debitis dolor ducimus 
    esse exercitationem fugiat impedit inventore saepe temporibus. 
    Dolor in ipsum libero necessitatibus quas qui.";

    // Send
    $mail->send();
    echo "Message sent !";

} catch(Exception) {
    echo "Message not sent. Error: {$mail->ErrorInfo}";
}
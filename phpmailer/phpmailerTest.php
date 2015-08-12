<?php

require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host     = "srv58.hosting24.com";
$mail->Port     = 465;
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'alain_urologista@drsolutionapp.info';                            // SMTP username
$mail->Password = 'pto2phil';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted


$mail->From = 'alain_urologista@drsolutionapp.info';
$mail->FromName = 'Alain Dutra';
$mail->AddAddress('alain.dutra@gmail.com', '');  // Add a recipient
$mail->AddReplyTo('alain.uro@gmail.com', 'reply');
//$mail->AddCC('');
//$mail->AddBCC('');

$mail->WordWrap = 50;      
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Test';
$mail->Body    =  "<!DOCTYPE html>
        <html lang='en-us'>
            <head>
                <meta charset='utf-8'>
                <title>Test</title>

            </head>
            <body>
            <p>Did it work ? </p>
            </body>
    </html>";

if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}
?>
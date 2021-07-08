<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendEmail($para_usuario,$asunto,$mensaje){
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'masterbikes456@gmail.com';                     //SMTP username
    $mail->Password   = 'Masterbikes2021';                               //SMTP password
    $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('masterbikes456@gmail.com', 'Master Bikes');
    $mail->addAddress($para_usuario);     //Add a recipient
  



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $mensaje;

    $mail->send();
   // echo 'Mensaje fue enviado';
} catch (Exception $e) {
   // echo 'Mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
}

}
?>
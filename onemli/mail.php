<?php  
use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPmailer.php';
require_once 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true); 
 
$alert = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];



        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'resitakin11@gmail.com';
            $mail->Password = 'ywbrntgveqgomoxm';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = '587';
            $mail->Charset   = 'utf-8';

            $mail->setFrom('resitakin11@gmail.com');
            $mail->addAddress('resit.akin96@gmail.com');

            $mail->isHTML();
            $mail->Subject = 'MErhaba Dünya'.$name;
            $mail->Body    = "Name : $name <br> Phone : $phone <br> Êmail : $email<br>Subject : $subject <br>Message : $message";

            $mail->send();
            $alert = "<div class='alert-success'><span> Mesaj başarılı gönderildi </span></div>";


        } catch (Exception $th) {
          $alert = '<div class="alert-error"><span>'.$e->getMessage().'</span></div>';
        }

}




?>
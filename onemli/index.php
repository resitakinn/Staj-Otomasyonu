<?php
// PHPMailer sınıflarını global namespace alanına içe aktarın
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);
// Eğer bir hata ile karşılaşırsak yakalamak için
// Kodlarımızı try catch blogunda yazıyoruz.
try {
    //Sunucu ayarları
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;           // Hata ayıklamak için debug etkin
    $mail->isSMTP();                                 // SMTP kullanarak gönderim
    $mail->Host       = 'smtp.gmail.com';           // SMTP sunucusu
    $mail->SMTPAuth   = true;                        // SMTP kimlik doğrulaması etkin
    $mail->Username   = 'resitakin11@gmail.com';       // SMTP kullanıcısı
    $mail->Password   = 'ywbrntgveqgomoxm';                     // SMTP şifre
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // TLS ile şifreleme etkin
    $mail->Port       = 587;                              // SMTP port
    
    //Karakter ayarları
    $mail->CharSet  ="utf-8";         //Türkçe karakter sorununun önüne geçecektir.
    $mail->Encoding="base64";
    
    // Alıcılar
    $mail->setFrom('resitakin11@gmail.com', 'Mailer');
    $mail->addAddress('resit.akin96@gmail.com', 'Ahmet');     // Alıcı
    $mail->addAddress('resit.akin96@hotmail.com');             // Ad kısmı opsiyoneldir.
    //$mail->addReplyTo('info@ornek.com', 'Bilgi');
    //$mail->addCC('cc@ornek.com');
    //$mail->addBCC('bcc@ornek.com');
    // Ekler
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Ek kısmı
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Ek ismi opsiyoneldir.
    // İçerik
    $mail->isHTML(true);                                  // Mail HTML formatında olacaktır.
    $mail->Subject = 'Mailin Konusu';
    $mail->Body    = 'Burası mesajın gövdesidir. <b>burası bold!</b>';
    $mail->AltBody = 'non-HTML mail istemcileri için mesaj gövdesidir.';
    $mail->send();
    echo 'Mesajınız gönderildi';
} catch (Exception $e) {
    echo "Mesajınız gönderilemedi. Mailer Hata: {$mail->ErrorInfo}";
}
?>


<!doctype html>

<html lang="en">

  <head>

    <title>Title</title>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>

  <body>







  <div class="container my-5" style="width:500px;">

    <div class="row bg-dark text-white " >

      

    <div class="col-12 " >

        <h1 class="text-center">

            Mesaj Gönderin

        </h1>

    <form action="" method="POST" class="my-2" >

            <input type="text"  class="text-center form-control" name="name" id="" placeholder="Ad Soyad Giriniz" ><br>

            <input type="email"  class="text-center form-control" name="email" id="" placeholder="E mail Giriniz" ><br>

            <input type="text"  class="text-center form-control" name="phone" id="" placeholder="Cep Tel Giriniz" ><br>

            <input type="text"  class="text-center form-control" name="subject" id="" placeholder="Konu Gİriniz"><br>

             <textarea  class="text-center form-control" name="message" id="" cols="30" rows="10"></textarea> <br>

            <div class="text-center">

            <button type="submit" name="submit" class="btn bg-danger text-white " >GÖNDER</button>

            </div>

            <div class="col-md-12 my-2">

              <?php echo $alert;  ?>

            </div>

        </form>

    </div>

    

    

    </div>

  </div>

      

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>

</html>
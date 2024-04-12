<?php


include "./db/db.php";

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


?>







<!DOCTYPE html>

<html>


<head>

    <title>Şifremi Unuttum Sayfası</title>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">



    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



    <!-- Custom CSS -->

    <link href="css/styles.css" rel="stylesheet" />

    <script src="js/sweetalert2.all.min.js"></script>

    <style>
    body {


        background-image: url(assets/img/logo.jpeg);



        background-position: center center;

        background-attachment: fixed;



    }





    /* Form ve kart stil ayarları */
    .giris {
        margin-top: 20px;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 10px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        text-align: center;
    }

    /* E-posta girişi alanı stil ayarları */
    .form-group {
        margin-top: 20px;
    }

    /* Buton stil ayarları */
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 10px;
        color: #fff;
    }

    /* Telefon ekranı için stiller */
    @media screen and (max-width: 600px) {
        .card {
            margin: 10px;
            padding: 10px;
        }
    }

    /* Genel stil ayarları */
    /* Telefon modu için stiller */
    @media screen and (max-width: 767px) {

        /* Örnek stiller */
        body {
            font-family: Arial, sans-serif;
            background-image: url(assets/img/logo.jpeg);
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            text-align: center;
            /* İçeriği yatayda ortala */
        }

        /* Diğer stiller buraya eklenir */

    }
    </style>

</head>



<body>

    <div class="container arkaPlan">

        <div class="row justify-content-center">

            <div class="col-md-6 giris">

                <div class="card">

                    <div class="card-header">

                        <h4>ŞİFRE SIFIRLA</h4>

                    </div>

                    <div class="card-body">

                        <form action="" method="post">

                            <div class="form-group">

                                <b>E-posta Adresi : </b>

                                <input type="text" class="form-control" name="emaill">

                            </div>







                            <div class="row">



                                <div class="col-md-12 text-right">

                                    <button type="submit" class="btn btn-primary" name="gonder">Gönder</button>



                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <?php

    if (isset($_POST['gonder'])) {



        $email = htmlspecialchars(trim($_POST['emaill']));



        if (!$email) {

            echo " <script>  Swal.fire( {title:'Başarısız', text:' BOŞ GEÇMEYİNİZ', icon:'error',confirmButtonText:'Tamam' })</script>";
        } else {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:'DOĞRU BİR E-MAİL ADRESİ GİRİNİZ', icon:'error',confirmButtonText:'Tamam' })</script>";

                # code...

            } else {

                $varmi = $baglanti->prepare("SELECT kullanicilar.ogrenciEmail,kullanicilar.ogretmenMail,kullanicilar.isim FROM kullanicilar WHERE ogrenciEmail=:ogrenci or ogretmenMail=:ogretmen ");

                $varmi->execute(['ogrenci' => $email, 'ogretmen' => $email]);

                if ($varmi->rowCount()) {

                    $rand1 = rand(1000000, 6000000);

                    $rand2 = rand(1000000, 6000000);

                    $rand3 = uniqid();

                    $sifirlamaKodu = $rand3 . $rand1 . uniqid("StajOtomasyon_") . $rand2 . $rand3;


                    $sifirlamalink = "<a href=\"http://localhost/StajOtomasyonuu/sifresifirlama.php?activasyonCode=$sifirlamaKodu\">Şifre Sıfırlama Bağlantısı</a>";



                    $row = $varmi->fetch(PDO::FETCH_ASSOC);
                    // PHPMailer sınıflarını global namespace alanına içe aktarın

                    $mail = new PHPMailer(true);
                    // Eğer bir hata ile karşılaşırsak yakalamak için
                    // Kodlarımızı try catch blogunda yazıyoruz.


                    try {
                        //Sunucu ayarları
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;           // Hata ayıklamak için debug etkin
                        $mail->isSMTP();                                 // SMTP kullanarak gönderim
                        $mail->Host       = 'smtp.gmail.com';           // SMTP sunucusu
                        $mail->SMTPAuth   = true;                        // SMTP kimlik doğrulaması etkin
                        $mail->Username   = 'email gelcek';       // SMTP kullanıcısı
                        $mail->Password   = 'şifre gelcek';          // SMTP şifre
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // TLS ile şifreleme etkin
                        $mail->Port       = 587;                              // SMTP port
                        $mail->CharSet  = "utf-8";         //Türkçe karakter sorununun önüne geçecektir.
                        $mail->Encoding = "base64";
                        $mail->setFrom('email gelcek', 'Staj Otomasyon');
                        $mail->addAddress($email);     // Alıcı
                        $mail->isHTML(true);                                  // Mail HTML formatında olacaktır.
                        $mail->Subject = 'Web Sitesinden Mesaj Var';
                        $mail->Body    = $row['isim'];
                        $mailicerik = '<div><h2 style="text-align:center">Şifre Sıfırlama Talimatları</h2> 
                                                <div class="im"> <div style="text-align:center">
                                                <img src="https://upload.wikimedia.org/wikipedia/tr/b/be/A%C4%9Fr%C4%B1%C4%B0brahim%C3%87e%C3%A7en%C3%9Cniversitesi-logo.png" alt="Staj Otomasyon" >
                                            </div>
                        
                                            <p>Merhaba, Sayın '. $row['isim'] . '</p>
                                            <p>Şifrenizi sıfırlamak için aşağıdaki talimatları izleyebilirsiniz:</p>
                                            <ol>
                                                <li>Aşağıdaki bağlantıya tıklayın:</li>
                                            </ol>
                                            ' . $sifirlamalink . '
                                            <ol">
                                                <li>Bağlantıya tıkladığınızda sizi yeni şifrenizi belirlemeniz için bir sayfaya yönlendirecektir. Yeni şifrenizi girin ve onaylayın.</li>
                                                <li>Şifrenizi değiştirdikten sonra, artık yeni şifrenizle giriş yapabilirsiniz.</li>
                                            </ol>
                                            <p>Lütfen bu talimatları izlerken dikkatli olun ve yeni şifrenizin güçlü ve güvenli olduğundan emin olun. Ayrıca, bu şifre sıfırlama bağlantısı bir saat boyunca geçerlidir, bu nedenle işlemi hızlı bir şekilde tamamlamaya çalışın.</p>
                                            <p>Herhangi bir sorunuz veya sorununuz varsa, bize ulaşmaktan çekinmeyin. Size yardımcı olmaktan mutluluk duyarız.</p>
                                            <p>Teşekkür ederiz.</p>
                                            <br> BU İŞLEMİ SİZ YAPMADIYSANIZ DİKKATE ALMAYINIZ !!!
                                            <h2>Sistem Kurucusu : Mehmet Reşit Akın</h2>
                                
                            
                                         </div>';

                        $mail->msgHTML($mailicerik);
                        $olusturmaTarihi = time();
                        

                        $kaydet = $baglanti->prepare("UPDATE kullanicilar SET aktivasyonCode=? , aktivasyonSaat=? WHERE

            ogrenciEmail = ? OR ogretmenMail = ?");


                        $kaydet->execute([$sifirlamaKodu, $olusturmaTarihi, $email, $email]);
                        $mail->SMTPDebug = 0;
                        if ($mail->send()) {

                            session_start();
                            $_SESSION['mail'] = "ok";
                            header("Location:index.php");
                        } else {
                            echo "<script>  Swal.fire({

                position: 'center',                              

                title: 'Mail Gönderilmedi ',

                html: '<p style=\"font-size:20px;\" >E-MAİL İLETİLMEDİ  </p>',

                 icon: 'error',

                 showConfirmButton: true,

                 confirmButtonText: 'KAPAT',

                timer: 5500

              })</script>";
                        }
                    } catch (Exception $e) {
                        // Hata durumunda kullanıcıya özel bir hata mesajı gösterme
                        echo "E-posta gönderirken bir hata oluştu: " . $e->getMessage();
                    }
                } else {

                    echo " <script>  Swal.fire( {title:'Başarısız', text:'SİSTEMDE BÖYLE BİR E-MAİL YOKTUR', icon:'error',confirmButtonText:'Tamam' })</script>";
                }
            }
        }
    }

    ?>



    <!-- Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">

    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">

    </script>

</body>



</html>
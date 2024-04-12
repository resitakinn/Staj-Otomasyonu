<?php
include("db/db.php");
session_start();
ob_start();
// if (isset($_SESSION['oturum']) && $_SESSION['oturum'] == 6789) {
//     header("Location:anasayfa");
// }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staj Giriş Sayfası</title>
    <meta charset="UTF-8">
    <meta property="og:image" content="https://upload.wikimedia.org/wikipedia/tr/b/be/A%C4%9Fr%C4%B1%C4%B0brahim%C3%87e%C3%A7en%C3%9Cniversitesi-logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/tr/b/be/A%C4%9Fr%C4%B1%C4%B0brahim%C3%87e%C3%A7en%C3%9Cniversitesi-logo.png" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap İcon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/sweetalert2.all.min.js"></script>
    <style>

        body {
            background-image: url(assets/img/logo.jpeg);
            background-position: center center;
            background-attachment: fixed;
        }

    </style>

</head>
<body>

    <div class="container">
        <marquee behavior=alternate>
            <h1 class="text-white">PATNOS MESLEK YÜKSEKOKULU STAJ OTOMASYONU</h1>
        </marquee>
        <?php      
        if (isset($_GET['durum']) && $_GET['durum'] == 'izinsizgiris') {
            echo " <script>  Swal.fire( {title:'GİRİŞ YAPINIZ', text:'İZİNSİZ YETKİ ALANINA GİRDİNİZ !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
            header("Refresh:3;url=index");
        }

        if (isset($_SESSION['AktivasyonYok'])) {

            if ($_SESSION['AktivasyonYok'] == "yes") {

                echo " <script>  Swal.fire( {title:'AKTİVASYON HATASI', text:'GECERSİZ AKTİVASYON LİNK', icon:'error',confirmButtonText:'Tamam' })</script>";

            }

            unset($_SESSION['AktivasyonYok']);
            header("Refresh:3;url=index");
        }

        if (isset($_SESSION['aktivasyonSureGecti'])) {

            if ($_SESSION['aktivasyonSureGecti'] == "yes") {
                echo " <script>  Swal.fire( {title:'AKTİVASYON HATASI', text:'SÜRESİ GEÇEN AKTİVASYON KOD ', icon:'error',confirmButtonText:'Tamam' })</script>";
            }

            unset($_SESSION['aktivasyonSureGecti']);
            header("Refresh:3;url=index");
        }

        if (isset($_SESSION['sifreDegisti'])) {



            if ($_SESSION['sifreDegisti'] == "yes") {

                echo " <script>  Swal.fire( {title:'ŞİFRE DEĞİŞTİ', icon:'success',confirmButtonText:'Tamam' })</script>";

            }



            unset($_SESSION['sifreDegisti']);

            header("Refresh:3;url=index");

        }
        if (isset($_SESSION['mail'])) {

        if ($_SESSION['mail'] == "ok") {

                echo "<script>  Swal.fire({

                position: 'center',                              

                title: 'Mail Gönderildi ',

                html: '<p style=\"font-size:20px;\" >E-MAİL ADRESİNE GİDİP ŞİFRE AKTİVASYON LİNKE TIKLAYIN  </p>',

                 icon: 'success',

                 showConfirmButton: true,

                 confirmButtonText: 'KAPAT',

                timer: 5500

              })</script>";
            unset($_SESSION['mail']);

            header("Refresh:5");

        }
      }



        ?>

        <div class="row justify-content-center my-1 ">

            <div class="col-md-6 giris">

                <div class="card">

                    <div class="card-header">

                        <img src="https://upload.wikimedia.org/wikipedia/tr/b/be/A%C4%9Fr%C4%B1%C4%B0brahim%C3%87e%C3%A7en%C3%9Cniversitesi-logo.png" class="float-end" width="150" alt="">

                        <h4 class="my-5">GİRİŞ YAPINIZ !!! </h4>

                        <p>Sisteme Bilgisayardan Girilmesi Önerilir...</p>



                    </div>

                    <div class="card-body ">

                        <form action="" method="post">

                            <div class="form-group">

                                <label for="kadi">Kullanıcı Adı :</label>

                                <input type="text" class="form-control" id="kadi" name="kadi" value="<?= @$_POST['kadi'] ?>">

                            </div>

                            <div class="form-group">

                                <label for="sifre">Şifre :</label>

                                <input type="password" class="form-control" id="sifre" name="sifre">

                            </div>

                            <div class="form-group">

                                <div class="form-floating mb-3">

                                    <div class="col-12 ">

                                        <img src="inc/captcha" width="120" height="50" id="capt" alt="">

                                        <i type=button onClick=reload(); value='Yenile' class="bi bi-arrow-clockwise btn btn-success mx-2"> Yenile</i>

                                        <script type="text/javascript">

                                            function reload() {

                                                img = document.getElementById("capt");

                                                img.src = "inc/captcha"

                                            }

                                        </script>

                                    </div>

                                </div>

                                <div class="form-group">
                                     <b>Doğrulama kodunu Giriniz :</b>

                                    <input class="form-control" id="inputcaptcha" name="captcha" type="text"  />

                                </div>

                                <div class="row">

                                    <div class="col-md-12 text-right my-2">

                                        <button type="submit" class="btn btn-primary" name="kullaniciGiris">Giriş

                                            Yap</button>

                                    </div>

                                </div>



                                <div class="text-center">
                                    <a href="sifre-unuttum">Şifrenizi mi Unuttunuz?</a><br>
                                    <a href="assets/Öğrenci-Kılavuz.pdf" target="_blank">Öğrenci Kılavuz</a>

                                </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php

    if (isset($_POST['kullaniciGiris'])) {

        $kadi = htmlspecialchars(trim($_POST['kadi']));

        $sifre = htmlspecialchars(trim("5645xa" . md5(sha1($_POST['sifre'])) . "2023"));

        $captcha = htmlspecialchars(trim($_POST['captcha']));



        if ($captcha == "") {

            echo "<script>  Swal.fire({

            position: 'center',                              

            title: 'DOĞRULAMA KODUNUZ BOŞ GEÇMEYİNİZ',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

             icon: 'error',

             showConfirmButton: false,

            timer: 2000

          })</script>";

        } else {

            if ($captcha == $_SESSION['captcha']) {



                if (!$kadi || !$sifre) {

                    echo "Boş";

                } else {



                    if ($sorguAdminDurum = $baglanti->query("SELECT kullanicilar.kadi,kullanicilar.sifre,kullanicilar.aktif FROM kullanicilar where kadi='$kadi' and sifre='$sifre' and aktif=2 ")->fetch()) {





                        echo "<script>  Swal.fire({

                                position: 'center',                              

                                title: 'STAJ DEFTERİNİZİ YÜKLEDİĞİNİZ TESPİT EDİLMİŞTİR BU YÜZDEN GİRİŞİNİZ PASİF DURUMA GEÇMİŞTİR ',

                                html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

                                 icon: 'error',

                                 showConfirmButton: true,

                                 confirmButtonText: 'KAPAT',

                                timer: 5500

                              })</script>";

                        exit();

                    } elseif ($sorguAdminDurum = $baglanti->query("SELECT kullanicilar.kadi,kullanicilar.sifre,kullanicilar.aktif FROM kullanicilar where kadi='$kadi' and sifre='$sifre' and aktif=0 ")->fetch()) {



                        echo "<script>  Swal.fire({

                                position: 'center',                              

                                title: 'GİRİŞİNİZ PASİF DURUMA GEÇMİŞTİR',

                                html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

                                 icon: 'error',

                                 showConfirmButton: false,

                                 confirmButtonText: 'KAPAT',

                                timer: 3500

                              })</script>";

                        exit();

                    } else {

     // --- 2 oturum giriş kontrol  alanı  baslangıc

                        $kontrol = $baglanti->query("SELECT kullanicilar.sesionaktif FROM kullanicilar where  kadi = '$kadi' ");
                        $kontrol ->execute();
                        $cek = $kontrol->fetch();


                        if ($cek['sesionaktif'] != "") {  
                           
                        
                            $sesionSifirla = $baglanti->prepare("UPDATE kullanicilar SET sesionaktif=?  where   kadi =? ");
                            $sesionSifirla -> execute([null,$kadi]); 
                            

                            if ($sorguAdmingiris = $baglanti->prepare("SELECT * FROM kullanicilar where kadi=:kadi and sifre=:sifre and aktif= 1 ")) {

                                $sorguAdmingiris->execute(

                                    [

                                        'kadi' => $kadi,

                                        'sifre' => $sifre

                                    ]

                                );

                                $sonuc1 = $sorguAdmingiris->fetch();



                                if ($sonuc1) {

                                    $_SESSION['oturum'] = "6789";

                                    $_SESSION['kadi'] = $kadi;
                                    $tokenn = bin2hex(random_bytes(32)); // 32 byte (256 bit) uzunluğunda bir rastgele token oluşturur

       
                                    $_SESSION['token']= $tokenn;
                                    

                                    // $_SESSION['sifre'] = $sifre;

                                    $_SESSION['yetki'] = $sonuc1['yetki'];
                                    echo "<script>  Swal.fire({

                            position: 'center',

                            icon: 'success',

                            title: 'GİRİŞ BAŞARILI LÜTFEN BEKLEYİNİZ ',

                            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

                            showConfirmButton: false,

                            timer: 2500

                          })</script>";

                                    header("Refresh:2;url=anasayfa");
                                    exit ();

                                } else {
                                    echo "<script>  Swal.fire({

                                position: 'center',                              

                                title: 'GİRİŞ BİLGİLERİ HATALI ',

                                html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

                                 icon: 'error',

                                 showConfirmButton: false,

                                timer: 1100

                              })</script>";
                              exit ();

                                }

                            }

                        

                        } else {

                            // ---oturum giriş alanı 

                            if ($sorguAdmingiris = $baglanti->prepare("SELECT * FROM kullanicilar where kadi=:kadi and sifre=:sifre and aktif= 1 ")) {

                                $sorguAdmingiris->execute(

                                    [

                                        'kadi' => $kadi,

                                        'sifre' => $sifre

                                    ]

                                );

                                $sonuc1 = $sorguAdmingiris->fetch();



                                if ($sonuc1) {

                                    $_SESSION['oturum'] = "6789";

                                    $_SESSION['kadi'] = $kadi;
                                    $tokenn = bin2hex(random_bytes(32)); // 32 byte (256 bit) uzunluğunda bir rastgele token oluşturur

       
                                    $_SESSION['token']= $tokenn;

                                    // $_SESSION['sifre'] = $sifre;

                                    $_SESSION['yetki'] = $sonuc1['yetki'];



                                    echo "<script>  Swal.fire({

                            position: 'center',

                            icon: 'success',

                            title: 'GİRİŞ BAŞARILI LÜTFEN BEKLEYİNİZ.. ',

                            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

                            showConfirmButton: false,

                            timer: 2500

                          })</script>";

                                    header("Refresh:2;url=anasayfa");
                                    exit ();

                                } else {

                                    echo "<script>  Swal.fire({

                                position: 'center',                              

                                title: 'GİRİŞ BİLGİLERİ HATALI ',

                                html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

                                 icon: 'error',

                                 showConfirmButton: false,

                                timer: 1100

                              })</script>";
                              exit ();

                                }

                            }

                            // ---oturum giriş alanı  bitiş

                        }

                    }

                }

            } else {

                echo " <script>  Swal.fire( {

                title:'CAPTCHA YANLIŞ GİRDİNİZ',               

                 html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-frown-fill\"> </p>',

                  icon:'error',

                  showConfirmButton:false,

                  timer: 1700

                 })</script>";
                 exit ();

            }

        }

    }



    ?>



    <!-- Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">

    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">

    </script>

</body>



</html>
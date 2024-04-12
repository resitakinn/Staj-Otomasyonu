<?php
date_default_timezone_set('Europe/Istanbul');
include("db/db.php");


ob_start();
session_start();

if (!(isset($_SESSION['oturum']) && $_SESSION['oturum'] == 6789)) {
    header("Location:index.php?durum=izinsizgiris");
}



$kullanicisor = $baglanti->prepare('SELECT * FROM kullanicilar , gorev WHERE kadi=:kadi  and kullanicilar.kGorev=gorev.gorevid');
$kullanicisor->execute([

    'kadi' => $_SESSION['kadi']
    //   'sifre' =>$_SESSION['sifre']

]);


$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);




?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Patnos Meslek YüksekOkulu <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="https://taladro-fan.com/favicon.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- <link rel="stylesheet" href="/css/yeni.css"> -->
    <link rel="stylesheet" href="css/kaynak/style.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <!-- Bootstrap İcon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <link href="css/kaynak/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->

        <a class="navbar-brand ps-3" href="anasayfa"> Hoş Geldiniz :
            <?php echo $kullanicicek['isim'];  ?>  
            
           <?php 
           if ($_SESSION['yetki'] == 2 or $_SESSION['yetki'] == 3) { ?>
            <div id="zamanlayici">04:00</div>
            <script>
                var zamanlayici = 240; // 5 dakika (300 saniye)
                var zamanlayiciElementi = document.getElementById("zamanlayici");

                function zamanlayiciyiGuncelle() {
                    var dakika = Math.floor(zamanlayici / 60);
                    var saniye = zamanlayici % 60;
                    var dakikaStr = dakika < 10 ? "0" + dakika : dakika;
                    var saniyeStr = saniye < 10 ? "0" + saniye : saniye;
                    
                    zamanlayiciElementi.textContent = dakikaStr + ":" + saniyeStr;
                }

                function zamanlayiciyiBaslat() {
                    zamanlayiciyiGuncelle();
                    zamanlayiciDongusu = setInterval(function() {
                        zamanlayici--;
                        if (zamanlayici < 0) {
                            clearInterval(zamanlayiciDongusu);
                            zamanlayiciElementi.textContent = "Süre doldu";
                            window.location.href = "https://taladro-fan.com/StajOtomasyonuu/cikis";
                            // Zaman dolunca yapılacak işlemleri buraya ekleyebilirsiniz.
                        } else {
                            zamanlayiciyiGuncelle();
                        }
                    }, 1000);
                }

                zamanlayiciyiBaslat();
            </script>
          <?php }
           
           
           ?>
        </a>

        <!-- Sidebar Toggle-->
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <!-- style="position:absolute;right:0; top:10px;" -->
            <button class="btn btn-link"  id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        </ul>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="cikisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Çıkış Yapıcaksınız</h5>
                    <button type="button" class="close bg-danger text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Çıkış Yapmak İstiyormusunuz
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <a href="cikis" class="btn btn-danger text-white">Çıkış Yap</a>
                </div>
            </div>
        </div>
    </div>

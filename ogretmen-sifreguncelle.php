<?php

include('./db/db.php');

$title = "Öğretmen Güncelleme";

$menu = "ogretmen";

include 'inc/head.php';

ob_start();

include 'inc/sidebar.php';
include 'yetki/yetki1kisit.php';
?>



<!-- Modal Öğretmen Bilgi Güncelleme Başlangış -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>




<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title ?></h1>
            <ol class="breadcrumb mb-4">
                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active"><?= $title ?> </li>
            </ol>





            <div class="container p-4">

                <div class="card mb-4">


                    <div class="card-header">

                        <i class="fas fa-table me-1 "></i>

                        <?= $title ?>


                    </div>


                    <?php

                    $id = $_GET['id'];

                    $ogretmenSorgula = $baglanti->query("SELECT ogretmenbilgi.ogretmenAdSoyad, ogretmenbilgi.ogretmenSicilNo,ogretmenbilgi.ogretmenSifre FROM ogretmenbilgi WHERE  ogretmenbilgi.id='$id' ");

                    $cek = $ogretmenSorgula->fetch();



                    ?>



                    <form action="" method="post" style="width: 100%; margin:auto; padding:15px;">

                        <div class="form-group mb-3">

                            <b>Ad Soyad:</b>

                            <input type="text" class="form-control"  value="<?= $cek['ogretmenAdSoyad'] ?>" disabled>

                        </div>

                        <div class="form-group mb-3">

                            <b>Sicil Numara:</b>

                            <input type="text" class="form-control"  value="<?= $cek['ogretmenSicilNo'] ?>" disabled>

                        </div>




                        <div class="form-group mb-3">

                            <b>Şifre Girin:</b>

                            <input type="password" class="form-control" name="ogretmenSifre" value="<?= $cek['ogretmenSifre'] ?>">

                        </div>



                        <button type="submit" class="btn btn-primary float-end my-2" name="ogretmenSifreDegistir">Şifre Değiştir</button>

                    </form>


                </div>

            </div>


        </div>
    </main>



    <?php



    if (isset($_POST['ogretmenSifreDegistir'])) {

        $ogretmenAdSoyad = htmlspecialchars(trim($_POST['ogretmenAdSoyad']));

        $ogretmenSicilNo = htmlspecialchars(trim($_POST['ogretmenSicilNo']));


        $ogretmensifre = htmlspecialchars(trim("5645xa" . md5(sha1($_POST['ogretmenSifre'])) . "2023"));

        if ($baglanti->query("UPDATE kullanicilar SET

`sifre`='$ogretmensifre'

  

   WHERE ogretmenid =" . $id)) {

            echo " <script>  Swal.fire( {title:'Başarılı', text:'Öğretmen  Şifre Değişti !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



            header("Refresh:2;url=ogretmen-ekle.php");

            // Eğer güncelleme sorgusu çalıştıysa alinankitap.php sayfasına yönlendiriyoruz.



        } else {

            echo " <script>  Swal.fire( {title:'Başarısız', text:'Öğretmen Şifre Değişmedi !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
        }
    }

    ?>



    <?php include 'inc/footer.php'; ?>
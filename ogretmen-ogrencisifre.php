<?php

include('./db/db.php');

$title = "Öğrenci Şifre Değiştirme";

include 'inc/head.php';

ob_start();

include 'inc/sidebar.php';



include 'yetki/yetki3kisit.php';

$id = $_GET['id'];
$cek = $baglanti->query("SELECT * FROM ogrencibilgi where id ='$id'");


$ogrencicek = $cek->fetch();

?>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>




<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title ?></h1>
            <ol class="breadcrumb mb-4">
                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">
                    <?= $title ?> </li>
            </ol>





            <div class="container p-5">

                <div class="card mb-4">


                    <div class="card-header">

                        <i class="fas fa-table me-1 "></i>

                        <?= $title ?>


                    </div>




                    <div class="p-3">

                    <form action="" method="POST">




<div class="form-group mb-3">

    <b>Şifre Girin :</b>

    <input type="password" name="ogrenciSifre" class="form-control" value="<?= $ogrencicek['ogrenciSifre'] ?>">

</div>





<button type="submit" class="btn btn-primary float-end" name="ogrenciSifreDegistir">Kaydet</button>

</form>
                    </div>


                    <?php



                if (isset($_POST['ogrenciSifreDegistir'])) {


                    $ogrenciSifre =    htmlspecialchars(trim("5645xa" . md5(sha1($_POST['ogrenciSifre'])) . "2023"));

               


                        if ($baglanti->query("UPDATE `kullanicilar` SET 
            `sifre`='$ogrenciSifre'
             WHERE  kullanicilar.kullaniciid=" . $id)) {
                            echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRENCİ  GÜNCELLENDİ !!!', icon:'success',  time:2000,confirmButtonText:'Tamam' })</script>";



                            header("Refresh:2;url=ogrenci-liste");
                        }
                     else {

                        echo " <script>  Swal.fire( {title:'Başarısız', text:'ÖĞRENCİ GÜNCELLENMEDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                    }
                
                }
                ?>


                </div>

            </div>


        </div>
    </main>


    <?php include 'inc/footer.php'; ?>
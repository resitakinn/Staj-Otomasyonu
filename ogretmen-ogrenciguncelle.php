<?php

include('./db/db.php');

$title = "Öğrenci Güncelle";

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

                                <b>Tc No:</b>

                                <input type="text" class="form-control" name="ogrenciTc"
                                    value="<?= $ogrencicek['ogrenciTc'] ?>" maxlength="11">

                            </div>

                            <div class="form-group mb-3">

                                <b>Ad Soyad:</b>

                                <input type="text" class="form-control" name="ogrenciAdsoyad"
                                    value="<?= $ogrencicek['ogrenciAdsoyad'] ?>">

                            </div>

                            <div class="form-group mb-3">

                                <b>Öğrenci Numara:</b>

                                <input type="text" class="form-control" name="ogrenciOgrNo"
                                    value="<?= $ogrencicek['ogrenciOgrNo'] ?>">

                            </div>

                            <input type="text" class="form-control" name="id" value="<?= $ogrencicek['id'] ?>" hidden>

                            <div class="form-group mb-3">

                                <b>Öğrenci Sınıf:</b>

                                <select class="form-control" name="ogrenciSinif">



                                    <option value="<?= $ogrencicek['ogrenciSinif'] ?>">
                                        <?= $ogrencicek['ogrenciSinif'] ?> Sınıf</option>

                                    <?php
                                    // lazım olursa aktif yapcam burası ogretmen ogrenciyi guncellemek istediginde sınıfını degistirmek için kullnılır

                                    // if ($ogrencicek['ogrenciSinif'] == 1) {

                                    //     echo ' <option value="2">2 Sınıf</option>';
                                    // } elseif ($ogrencicek['ogrenciSinif'] == 2) {

                                    //     echo '<option value="1">1 Sınıf</option>';
                                    // }

                                    ?>
                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>Bölüm:</b>

                                <select class="form-control" name="ogrenciBolum">

                                    <?php

                                    $bolumAdCek = $ogrencicek['ogrenciBolum'];

                                    $bolum = $baglanti->query("SELECT bolumAd FROM unibolum where unibolum.bolumid='$bolumAdCek' AND  bolumDurum=1 ");

                                    $bolumcek = $bolum->fetch();
                                    ?>

                                    <option value="<?= $ogrencicek['ogrenciBolum'] ?>"><?= $bolumcek['bolumAd'] ?>
                                    </option>

                                    <!-- <option value="<?= $ogrencicek['ogrenciBolum'] ?>">------------</option> -->

                                    <?php
                                    // lazım olursa aktif yapcam burası ogretmen ogrenciyi guncellemek istediginde bölümü degistirmek için kullnılır

                                    // $bolum = $baglanti->query("SELECT * FROM unibolum");

                                    // $bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);
                                    // foreach ($bolumcek as $bolumsonuc) {

                                    ?>
                                    <!-- <option value="<?php echo $bolumsonuc['idbolum'] ?>"><?= $bolumsonuc['bolumAd'] ?></option> -->

                                    <?php
                                    // }
                                    ?>

                                </select>

                            </div>



                            <div class="form-group mb-3">

                                <b>İl:</b>

                                <select class="form-control" id="ilcek" name="il">

                                    <?php

                                    $cekil = $ogrencicek['il'];

                                    $il = $baglanti->query("SELECT * FROM iller where iller.il_no='$cekil'");

                                    $ilcek = $il->fetch();
                                    ?>

                                    <option value="<?= $ogrencicek['il'] ?>"><?= $ilcek['il_isim'] ?> </option>

                                    <?php

                                    $il = $baglanti->query("SELECT * FROM iller");

                                    $ilcek = $il->fetchAll(PDO::FETCH_ASSOC);
                                    echo '<option>İL SEÇİNİZ </option>';


                                    foreach ($ilcek as $ilgoster) {
                                    ?>                                                                        
                                    <option value="<?php echo $ilgoster['il_no'] ?>"><?= $ilgoster['il_isim'] ?> </option>
                                    <?php } ?>

                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>İlçe:</b>

                                <select class="form-control" id="ilcecek" name="ilce">
                                    <?php

                                    $cekilce = $ogrencicek['ilce'];

                                    $ilce = $baglanti->query("SELECT * FROM ilceler where ilce_no = '$cekilce'");

                                    $ilceCek = $ilce->fetch();
                                    ?>
                                    <option value="<?= $ogrencicek['ilce'] ?>"><?= $ilceCek['ilce_isim'] ?></option>

                                </select>

                            </div>
                            <button type="submit" class="btn btn-primary float-end" name="ogrenciGuncelleKaydet">Kaydet</button>

                        </form>
                    </div>

                </div>

            </div>


        </div>
    </main>

    <script>
    $("#ilcek").on('change', function() {

        var ilceekle = $("#ilcek").val();

        $("#ilcecek").load('ilcecek', {

            'ilcek': ilceekle

        });

    });
    </script>
     <?php



if (isset($_POST['ogrenciGuncelleKaydet'])) {

    $ogrenciTc =       htmlspecialchars(trim($_POST['ogrenciTc']));

    $ogrenciAdsoyad =  htmlspecialchars(trim($_POST['ogrenciAdsoyad']));

    $ogrenciOgrNo =    htmlspecialchars(trim($_POST['ogrenciOgrNo']));

    $ogrenciBolum =    htmlspecialchars(trim($_POST['ogrenciBolum']));

    $ogrenciSinif =    htmlspecialchars(trim($_POST['ogrenciSinif']));

    $il =              htmlspecialchars(trim($_POST['il']));

    $ilce =            htmlspecialchars(trim($_POST['ilce']));

    $id =              htmlspecialchars(trim($_POST['id']));

    if ($baglanti->query("UPDATE ogrencibilgi SET

ogrenciTc = '$ogrenciTc',

ogrenciAdsoyad = '$ogrenciAdsoyad',

ogrenciOgrNo =  '$ogrenciOgrNo', 

ogrenciBolum =  '$ogrenciBolum',

ogrenciSinif =  '$ogrenciSinif',

il =  '$il',

ilce =  '$ilce'

WHERE id =" . $id)) {



        if ($baglanti->query("UPDATE `kullanicilar`,ogrencibilgi SET 

`isim`='$ogrenciAdsoyad',`kadi`='$ogrenciOgrNo',`bolum`='$ogrenciBolum'

WHERE ogrencibilgi.id=kullanicilar.kullaniciid and kullanicilar.kullaniciid=" . $id)) {
            echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRENCİ  GÜNCELLENDİ !!!', icon:'success',  time:2000,confirmButtonText:'Tamam' })</script>";



            header("Refresh:2;url=ogrenci-liste");
        }
    } else {

        echo " <script>  Swal.fire( {title:'Başarısız', text:'ÖĞRENCİ GÜNCELLENMEDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
    }
}

?>





    <?php include 'inc/footer.php'; ?>
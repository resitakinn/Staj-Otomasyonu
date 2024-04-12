<?php

include('./db/db.php');

$title = "Öğrenci Ekle";

include 'inc/head.php';

ob_start();

include 'inc/sidebar.php';
include 'yetki/yetki3kisit.php';

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

                        <?= $title  ?>

                        <?php $ogretmenKimlikİd = $kullanicicek['ogretmenid'];

                        $sorgu = $baglanti->query("SELECT  ogretmenbilgi.ogretmenBolumAd,ogretmenbilgi.ogretmenDanismanDurum FROM `ogretmenbilgi` where ogretmenbilgi.id='$ogretmenKimlikİd' ");;


                        $sonuc = $sorgu->fetch();
                        $bolum = $sonuc['ogretmenBolumAd'];
                        $ogretmensinif = $sonuc['ogretmenDanismanDurum'];
                        ?>
                    </div>




                    <div class="p-3">

                        <form action="" method="POST">

                            <div class="form-group mb-3">

                                <b>Tc No:</b>

                                <input type="text" class="form-control" name="ogrenciTc" value="<?= @$_POST['ogrenciTc'] ?>" maxlength="11">

                            </div>

                            <div class="form-group mb-3">

                                <b>Ad Soyad:</b>

                                <input type="text" class="form-control" name="ogrenciAdsoyad" value="<?= @$_POST['ogrenciAdsoyad'] ?>">

                            </div>

                            <div class="form-group mb-3">

                                <b>Öğrenci Numara:</b>

                                <input type="text" class="form-control" name="ogrenciOgrNo" value="<?= @$_POST['ogrenciOgrNo'] ?>">

                            </div>



                            <div class="form-group mb-3">

                                <b>Bölüm:</b>

                                <select class="form-control" name="ogrenciBolum">
                                    <option value="">Bölüm Seçiniz</option>
                                    <?php

                                    $bolum = $baglanti->query("SELECT * FROM unibolum where unibolum.idbolum='$bolum' AND  bolumDurum=1 ");

                                    $bolumcek = $bolum->fetch();
                                    ?>
                                    <option value="<?php echo $bolumcek['idbolum'] ?>"><?= $bolumcek['bolumAd'] ?>
                                    </option>



                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>Sınıf Giriniz:</b>

                                <select class="form-control" name="ogrenciSinif">

                                    <option>Sınıf Giriniz </option>
                                    <option value="<?=$ogretmensinif?>"><?=$ogretmensinif?> Sınıf</option>                              

                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>İl:</b>

                                <select class="form-control" id="il" name="il">

                                    <option>İl Seçiniz </option>

                                    <?php



                                    $il = $baglanti->query("SELECT * FROM iller");

                                    $ilcek = $il->fetchAll(PDO::FETCH_ASSOC);



                                    foreach ($ilcek as $ilgoster) {

                                    ?>



                                        <option value="<?php echo $ilgoster['il_no'] ?>"><?= $ilgoster['il_isim'] ?>
                                        </option>





                                    <?php } ?>

                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>İlçe:</b>

                                <select class="form-control" id="ilce" name="ilce">

                                    <option value="">ilçe seçiniz</option>

                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>Unvan:</b>

                                <select class="form-control" name="kGorev">

                                    <option value="2">Unvan Seçiniz </option>

                                    <?php



                                    $gorev = $baglanti->query("SELECT * FROM gorev");

                                    $gorevcek = $gorev->fetchAll(PDO::FETCH_ASSOC);



                                    foreach ($gorevcek as $gorevgoster) {

                                    ?>

                                        <?php
                                        if ($gorevgoster['gorevid'] == 2) { ?>
                                            <option value="<?php echo $gorevgoster['gorevid'] ?>"><?= $gorevgoster['gorevAd'] ?>

                                            <?php  }
                                            ?>


                                            </option>





                                        <?php } ?>

                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <b>Şifre Girin :</b>

                                <input type="password" name="ogrenciSifre" class="form-control">

                            </div>

                            <div class="form-group mb-3">

                                <b>Şifre Tekrar Girin :</b>

                                <input type="password" name="ogrenciSifre2" class="form-control">

                            </div>

                            <button type="submit" class="btn btn-primary float-end" name="ogrenciKaydet">Sisteme Yeni Öğrenci Kaydet</button>

                        </form>
                    </div>


                    <?php

                    if (isset($_POST['ogrenciKaydet'])) {

                        $ogrenciTc = htmlspecialchars(trim($_POST['ogrenciTc']));

                        $ogrenciAdsoyad = htmlspecialchars(trim($_POST['ogrenciAdsoyad']));

                        $ogrenciOgrNo = htmlspecialchars(trim($_POST['ogrenciOgrNo']));

                        $ogrenciBolum = htmlspecialchars(trim($_POST['ogrenciBolum']));

                        $ogrenciSinif = htmlspecialchars(trim($_POST['ogrenciSinif']));

                        $il = htmlspecialchars(trim($_POST['il']));

                        $ilce = htmlspecialchars(trim($_POST['ilce']));

                        $ogrenciSifre = htmlspecialchars(trim($_POST['ogrenciSifre']));

                        $ogrenciSifre2 = htmlspecialchars(trim($_POST['ogrenciSifre2']));





                        if (!$ogrenciTc || !$ogrenciAdsoyad || !$ogrenciOgrNo || !$ogrenciBolum ||  !$il  || !$ilce  || !$ogrenciSifre || !$ogrenciSifre2 || !$ogrenciSinif) {

                            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'BOŞ ALAN BIRAKMAYINIZ!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                        } elseif ($ogrenciSifre != $ogrenciSifre2) {

                            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'GİRİLEN ŞİFRELER UYUŞMUYOR!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                        } else {

                            $ogrkontrol = $baglanti->query("SELECT * FROM ogrencibilgi where ogrenciOgrNo='$ogrenciOgrNo'")->fetch();

                            $kontrolTc = $baglanti->query("SELECT * FROM ogrencibilgi where ogrenciTc='$ogrenciTc'")->fetch();

                            if ($ogrkontrol) {

                                echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRİLEN ÖĞRENCİ NUMARA KULLANILMAKTA !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
                            } elseif ($kontrolTc) {

                                echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRİLEN TC NUMARA KULLANILMAKTA !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                            } else {

                                $sorgu = $baglanti->prepare('INSERT INTO ogrencibilgi SET



ogrenciTc=?,    

ogrenciAdsoyad=?,    

ogrenciOgrNo=?,

ogrenciBolum=?,    

ogrenciSinif=?,    

il=?,

ilce=?







');



                                $kaydet = $sorgu->execute([

                                    $ogrenciTc, $ogrenciAdsoyad, $ogrenciOgrNo, $ogrenciBolum, $ogrenciSinif, $il, $ilce

                                ]);













                                if ($kaydet) {

                                    echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRENCİ  EKLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                                    header("Refresh:1;url=ogrenci-liste");
                                }



                                $cek = $baglanti->query("SELECT * FROM ogrencibilgi where ogrenciOgrNo='$ogrenciOgrNo' ");

                                $ogrencicek = $cek->fetch();

                                $kullaniciid = $ogrencicek['id'];

                                $yetkiekle = $ogrencicek['yetki'];

                                $kGorev = $_POST['kGorev'];

                                $users = $baglanti->prepare('INSERT INTO kullanicilar SET



isim=?,    

kadi=?,

sifre=?,    

yetki=?,

kullaniciid=?,

kGorev=?,

bolum = ?







');

                                $ogrenciSifre3 = "5645xa" . md5(sha1($_POST['ogrenciSifre2'])) . "2023";

                                $users->execute([

                                    $ogrenciAdsoyad, $ogrenciOgrNo, $ogrenciSifre3, $yetkiekle, $kullaniciid, $kGorev, $ogrenciBolum

                                ]);

                                $ogrencibilgisifreguncelle = $baglanti->prepare("UPDATE ogrencibilgi SET ogrenciSifre = ? WHERE id = ?");

                                $ogrencibilgisifreguncelle->execute([$ogrenciSifre3, $kullaniciid]);
                            }
                        }
                    }

                    ?>











                </div>

            </div>


        </div>
    </main>

    <script>
        $("#il").on('change', function() {

            var ilceekle = $("#il").val();

            $("#ilce").load('ilcecek', {

                'il': ilceekle

            });

        });
    </script>


    <?php include 'inc/footer.php'; ?>
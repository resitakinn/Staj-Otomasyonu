<?php

$title = "Öğrenci Listesi";

$menu = "ogrenci";

ob_start();

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki1kisit.php';

?>





<div id="layoutSidenav_content">

    <?php

    if (isset($_SESSION['ogrenciDelete'])) {

        if ($_SESSION['ogrenciDelete'] == "ok") {

            echo " <script>

    Swal.fire( {

       title:'BAŞARILI',

       text:'ÖĞRENCİ SİLİNDİ !!!',

       icon:'success',

       showConfirmButton:false,

       time:2000

      })</script>";

            unset($_SESSION['ogrenciDelete']);

            header("Refresh:2");

        } elseif ($_SESSION['ogrenciDelete'] == "no") {

            echo " <script>

    Swal.fire( {

       title:'BAŞARISIZ',

       text:'ÖĞRENCİ SİLİNMEDİ !!!',

       icon:'error',

       showConfirmButton:false,

       time:2000

      })</script>";

            unset($_SESSION['ogrenciDelete']);

            header("Refresh:2");

        }

    }





    ?>

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">Öğrenci Ekleme

                </li>

            </ol>





            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table me-1"></i>

                    Öğrenci Ekleme Tablosu

                    <div class="float-end my-2"><a href="#" class="nav-link text-white btn btn-primary p-1" style="color:green;" data-toggle="modal" data-target="#ogrenciEklemeİslemleri"> <i class="bi bi-person-plus-fill" style="font-size:20px; "> </i>Öğrenci Ekle</a> <br>
                    <a href="ogrenci-kaydet" class="nav-link text-white btn btn-primary p-1" style="color:green;" > <i class="bi bi-person-plus-fill" style="font-size:20px; "> </i>Çoklu Öğrenci Ekle</a></div>





                </div>





                <div class="card-body">

                    <table id="myTable" class="table table-striped">

                        <thead>

                            <tr class="text-center">



                                <th>SIRA</th>

                                <th>id#</th>

                                <th>Tc Kimlik</th>

                                <th>AD & SOYAD</th>

                                <th>Öğrenci Numarası</th>

                                <th>Bölüm Ad</th>

                                <th>Sınıf</th>

                                <th>iL</th>

                                <th>İLÇE</th>



                                <th>

                                    <input type="text" name="" id="" class="form-control text-center" disabled placeholder="İşlemler">

                                </th>



                            </tr>

                        </thead>



                        <tbody>

                            <?php

                            $ogrenciSorgula = $baglanti->query("SELECT `id`,`ogrenciTc`, `ogrenciAdsoyad`, `ogrenciOgrNo`, `ogrenciBolum`,`ogrenciSinif`, `il`, `ilce`, `ogrenciSifre`,unibolum.bolumAd,iller.il_isim,ilceler.ilce_isim  FROM `ogrencibilgi`,unibolum ,ilceler,iller WHERE ogrencibilgi.ogrenciBolum=unibolum.bolumid AND ogrencibilgi.ilce=ilceler.ilce_no AND ogrencibilgi.il=iller.il_no  ORDER BY ogrencibilgi.ogrenciOgrNo ASC ");

                            $cek = $ogrenciSorgula->fetchAll(PDO::FETCH_ASSOC);

                            $sayi = 0;

                            foreach ($cek as $ogrencicek) {

                                $sayi = ++$sayi;

                            ?>

                                <tr class="text-center " style="line-height: 35px;">

                                    <th><?= $sayi ?></th>

                                    <th><?= $ogrencicek['id'] ?></th>

                                    <th><?= $ogrencicek['ogrenciTc'] ?></th>

                                    <th><?= $ogrencicek['ogrenciAdsoyad'] ?></th>

                                    <th><?= $ogrencicek['ogrenciOgrNo'] ?></th>

                                    <th><?= $ogrencicek['bolumAd'] ?></th>

                                    <th><?php

                                        if ($ogrencicek['ogrenciSinif'] != "") {

                                            echo $ogrencicek['ogrenciSinif'] . " Sınıf";

                                        } else {

                                            echo "Sınıf Girmediniz ";

                                        }



                                        ?></th>

                                    <th><?= $ogrencicek['il_isim'] ?></th>

                                    <th><?= $ogrencicek['ilce_isim'] ?></th>



                                    <th style="font-weight: 900;font-size:20px;"><a href="#" data-toggle="modal" data-target="#ogrenciBilgiGuncelleme<?= $ogrencicek['id'] ?>"><i class="fa fa-edit  text-success" href="#" alt="İşlemler"></i></a> <a href="islem.php?id=<?php echo $ogrencicek['id'] ?>&islem=ogrenciSil"><i class="bi bi-trash3-fill text-danger"></i></a></th>

                                </tr>



                            <?php } ?>



                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

    <?php include 'inc/footer.php'; ?>

<!-- Modal Öğrenci Ekleme Başlangış-->

<div class="modal fade" id="ogrenciEklemeİslemleri">

    <div class="modal-dialog">

        <div class="modal-content">



            <!-- Modal Başlık -->

            <div class="modal-header">

                <h4 class="modal-title"> <i class="bi bi-person me-2"></i> Yeni Öğrenci Ekle</h4>

                <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal İçerik -->

            <div class="modal-body">

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
                            $bolum = $baglanti->query("SELECT * FROM unibolum WHERE bolumDurum=1 ");
                            $bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($bolumcek as $bolumsonuc) {  ?>
                                <option value="<?php echo $bolumsonuc['idbolum'] ?>"><?= $bolumsonuc['bolumAd'] ?></option>
                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group mb-3">

                        <b>Sınıf Giriniz:</b>

                        <select class="form-control" name="ogrenciSinif">

                            <option>Sınıf Giriniz </option>
                            <option value="1">1 Sınıf</option>
                            <option value="2">2 Sınıf</option>

                        </select>

                    </div>

                    <div class="form-group mb-3">

                        <b>İl:</b>

                        <select class="form-control" id="ilcek" name="il">
                            <option>İl Seçiniz </option>
                            <?php
                            $il = $baglanti->query("SELECT * FROM iller");
                            $ilcek = $il->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($ilcek as $ilgoster) { ?>
                                <option value="<?php echo $ilgoster['il_no'] ?>"><?= $ilgoster['il_isim'] ?></option>
                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group mb-3">

                        <b>İlçe:</b>

                        <select class="form-control" id="ilcecek" name="ilce">

                            <option value="">ilçe seçiniz</option>

                        </select>

                    </div>

                    <div class="form-group mb-3">

                        <b>Unvan:</b>

                        <select class="form-control" name="kGorev">
                            <option>Unvan Seçiniz </option>
                            <?php
                            $gorev = $baglanti->query("SELECT * FROM gorev");
                            $gorevcek = $gorev->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($gorevcek as $gorevgoster) { ?>
                                <option value="<?php echo $gorevgoster['gorevid'] ?>"><?= $gorevgoster['gorevAd'] ?> </option>
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

                    <button type="submit" class="btn btn-primary float-end" name="ogrenciKaydet">Kaydet</button>

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



                            header("Refresh:1;url=ogrenci-ekle");
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

<!-- <script>
    $("#il").on('change', function() {

        var ilceekle = $("#il").val();

        $("#ilce").load('ilcecek', {

            'il': ilceekle

        });

    });
</script> -->

<!-- Modal Öğrenci Ekleme Bitiş-->



<!-- Modal Öğrenci Bilgi Düzenleme Başlangış-->

<?php



$cek = $baglanti->query("SELECT * FROM ogrencibilgi");

$ogrencicek = $cek->fetchAll(PDO::FETCH_ASSOC);



foreach ($ogrencicek as $cekogr) { ?>

    <div class="modal fade" id="ogrenciBilgiGuncelleme<?= $cekogr['id'] ?>">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Başlık -->

                <div class="modal-header">

                    <h4 class="modal-title"> <i class="bi bi-person me-2"></i> Öğrenci Bilgi Düzenleme </h4>

                    <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>

                </div>



                <!-- Modal İçerik -->

                <div class="modal-body">

                    <form action="" method="POST">

                        <div class="form-group mb-3">

                            <b>Tc No:</b>

                            <input type="text" class="form-control" name="ogrenciTc" value="<?= $cekogr['ogrenciTc'] ?>" maxlength="11">

                        </div>

                        <div class="form-group mb-3">

                            <b>Ad Soyad:</b>

                            <input type="text" class="form-control" name="ogrenciAdsoyad" value="<?= $cekogr['ogrenciAdsoyad'] ?>">

                        </div>

                        <div class="form-group mb-3">

                            <b>Öğrenci Numara:</b>

                            <input type="text" class="form-control" name="ogrenciOgrNo" value="<?= $cekogr['ogrenciOgrNo'] ?>">

                        </div>

                        <input type="text" class="form-control" name="id" value="<?= $cekogr['id'] ?>" hidden>

                        <div class="form-group mb-3">

                            <b>Öğrenci Sınıf:</b>
                            <select class="form-control" name="ogrenciSinif">
                                <option value="<?= $cekogr['ogrenciSinif'] ?>"><?= $cekogr['ogrenciSinif'] ?> Sınıf</option>
                                <?php
                                if ($cekogr['ogrenciSinif'] == 1) {
                                    echo ' <option value="2">2 Sınıf</option>';
                                } elseif ($cekogr['ogrenciSinif'] == 2) {
                                    echo '<option value="1">1 Sınıf</option>';
                                }
                                ?>
                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Bölüm:</b>

                            <select class="form-control" name="ogrenciBolum">
                                <?php
                                $bolumAdCek = $cekogr['ogrenciBolum'];
                                $bolum = $baglanti->query("SELECT bolumAd FROM unibolum where unibolum.bolumid='$bolumAdCek' ");
                                $bolumcek = $bolum->fetch();
                                ?>
                                <option value="<?= $cekogr['ogrenciBolum'] ?>"><?= $bolumcek['bolumAd'] ?></option>
                                <option value="<?= $cekogr['ogrenciBolum'] ?>">------------</option>
                                <?php
                                $bolum = $baglanti->query("SELECT * FROM unibolum WHERE bolumDurum=1");
                                $bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($bolumcek as $bolumsonuc) { ?>
                                    <option value="<?php echo $bolumsonuc['idbolum'] ?>"><?= $bolumsonuc['bolumAd'] ?></option>
                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>İl:</b>

                            <select class="form-control" id="ilcek" name="il">
                                <?php
                                $cekil = $cekogr['il'];
                                $il = $baglanti->query("SELECT * FROM iller where iller.il_no='$cekil'");
                                $ilcek = $il->fetch();
                                ?>
                                <option value="<?= $cekogr['il'] ?>"><?= $ilcek['il_isim'] ?> </option>
                                <?php
                                $il = $baglanti->query("SELECT * FROM iller");
                                $ilcek = $il->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($ilcek as $ilgoster) { ?>
                                    <option value="<?php echo $ilgoster['il_no'] ?>"><?= $ilgoster['il_isim'] ?></option>
                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>İlçe:</b>

                            <select class="form-control" id="ilcecek" name="ilce">

                                <?php

                                $cekilce = $cekogr['ilce'];

                                $ilce = $baglanti->query("SELECT * FROM ilceler where ilce_no = '$cekilce'");

                                $ilceCek = $ilce->fetch();
                                ?>

                                <option value="<?= $cekogr['ilce'] ?>"><?= $ilceCek['ilce_isim'] ?></option>

                            </select>

                        </div>                 

                        <button type="submit" class="btn btn-primary float-end" name="ogrenciGuncelleKaydet">Kaydet</button>

                    </form>

                </div>

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



                        if ($baglanti->query("UPDATE `kullanicilar` SET 

            `isim`='$ogrenciAdsoyad',`kadi`='$ogrenciOgrNo',`bolum`='$ogrenciBolum'

             WHERE  kullanicilar.kullaniciid=" . $id)) {
                            echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRENCİ  GÜNCELLENDİ !!!', icon:'success',  time:2000,confirmButtonText:'Tamam' })</script>";



                            header("Refresh:2;url=ogrenci-ekle");
                        }
                    } else {

                        echo " <script>  Swal.fire( {title:'Başarısız', text:'ÖĞRENCİ GÜNCELLENMEDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                    }
                }

                ?>



            </div>

        </div>

    </div>

<?php } ?>



<script>
    $("#ilcek").on('change', function() {

        var ilceekle = $("#ilcek").val();

        $("#ilcecek").load('ilcecek', {

            'ilcek': ilceekle

        });

    });
</script>

<!-- Modal Öğrenci Bilgi Düzenleme Bitiş-->





   

    
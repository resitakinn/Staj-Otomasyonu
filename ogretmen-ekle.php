<?php

$title = "Öğretmen Listesi";

$menu = "ogretmen";

ob_start();

include 'inc/head.php';
include 'inc/sidebar.php';
include 'yetki/yetki1kisit.php';
?>



<?php



if (isset($_SESSION['ogretmenDelete'])) {

    if ($_SESSION['ogretmenDelete'] == "ok") {

        echo " <script>

           Swal.fire( {

              title:'BAŞARILI',

              text:'ÖĞRETMEN SİLİNDİ !!!',

              icon:'success',

              showConfirmButton:false,

              time:2000

             })</script>";

        unset($_SESSION['ogretmenDelete']);

        header("Refresh:2");
    } elseif ($_SESSION['ogretmenDelete'] == "no") {

        echo " <script> 

        Swal.fire( {

            title:'BAŞARISIZ',

            text:'ÖĞRETMEN SİLİNMEDİ !!!',

            icon:'error',

            showConfirmButton:false,

            time:2000 

        })

    </script>";

        unset($_SESSION['bolum_delete']);

        header("Refresh:2;");
    }
}

?>

<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">
                    Öğretmen Ekleme </li>

            </ol>

            <div class="container-fluid">

                <div class="card mb-4">

                    <div class="card-header">

                        <i class="fas fa-table me-1 "></i>

                        Öğretmen Ekleme Tablosu

                        <div class="float-end my-2 btn btn-primary "><a href="#" class="nav-link text-white " data-toggle="modal" data-target="#ogretmenEkle"><i class="bi bi-person-plus-fill  " style="font-size:20px;  "> </i>Öğretmen Ekle</a></div>

                    </div>



                    <div class="card-body col-12 col-md-12">

                        <table id="myTable" class="table table-striped">

                            <thead>

                                <tr class="text-center">



                                    <th>SIRA</th>

                                    <th>id#</th>

                                    <th>AD & SOYAD</th>

                                    <th>Sicil No</th>

                                    <th>Danışman Sınıf</th>

                                    <th>iL</th>

                                    <th>İLÇE</th>

                                    <th>Bölüm Ad</th>

                                    <th>Görev</th>

                                    <th>#</th>



                                </tr>

                            </thead>



                            <tbody>

                                <?php



                                $ogretmenSorgula = $baglanti->query("SELECT `id`, `ogretmenAdSoyad`, `ogretmenSicilNo`, `ogretmenDanismanDurum`, `ogretmenGorev`,  `ogretmenBolumAd`,unibolum.bolumAd,ilceler.ilce_isim,iller.il_isim   FROM `ogretmenbilgi`,unibolum ,ilceler,iller WHERE ogretmenbilgi.ogretmenBolumAd=unibolum.bolumid AND ogretmenbilgi.ilce=ilceler.ilce_no AND ogretmenbilgi.il=iller.il_no  ORDER BY ogretmenbilgi.id ASC ");

                                $cek = $ogretmenSorgula->fetchAll(PDO::FETCH_ASSOC);

                                $sayi = 0;

                                foreach ($cek as $ogretmenCek) {

                                    $sayi = ++$sayi;

                                ?>

                                    <tr class="text-center " style="line-height: 35px;">

                                        <th><?= $sayi ?></th>

                                        <th><?= $ogretmenCek['id'] ?></th>

                                        <th><?= $ogretmenCek['ogretmenAdSoyad'] ?></th>

                                        <th><?= $ogretmenCek['ogretmenSicilNo'] ?></th>

                                        <th><?= $ogretmenCek['ogretmenDanismanDurum'] ?> Sınıf</th>

                                        <th><?= $ogretmenCek['il_isim'] ?></th>

                                        <th><?= $ogretmenCek['ilce_isim'] ?></th>

                                        <th><?= $ogretmenCek['bolumAd'] ?></th>

                                        <th><?= $ogretmenCek['ogretmenGorev'] ?></th>

                                        <th style="font-weight: 900;font-size:20px;"><a href="ogretmen-guncelle?id=<?php echo $ogretmenCek['id']; ?>"><i class="fa fa-edit  text-success" href="#" alt="İşlemler"></i></a> <a href="islem?id=<?php echo $ogretmenCek['id'] ?>&islem=ogretmenSil"><i class="bi bi-trash3-fill text-danger"></i></a></th>

                                    </tr>



                                <?php } ?>



                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </main>
    <!-- Modal Öğretmen Ekleme Başlangış-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="modal fade" id="ogretmenEkle">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Başlık -->

                <div class="modal-header">

                    <h4 class="modal-title"> <i class="bi bi-person me-2"></i> Yeni Öğretmen Ekle</h4>

                    <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>

                </div>



                <!-- Modal İçerik -->

                <div class="modal-body">

                    <form action="" method="post">

                        <div class="form-group mb-3">

                            <b>Ad Soyad:</b>

                            <input type="text" class="form-control" name="ogretmenAdSoyad" value="<?= @$_POST['ogretmenAdSoyad'] ?>">

                        </div>

                        <div class="form-group mb-3">

                            <b>Sicil Numara:</b>

                            <input type="text" class="form-control" name="ogretmenSicilNo" value="<?= @$_POST['ogretmenSicilNo'] ?>">

                        </div>

                        <div class="form-group mb-3">

                            <b>Danışman Durumu:</b>

                            <select class="form-control" name="ogretmenDanismanDurum">
                                <option>Sınıf Giriniz </option>
                                <option value="1">1 Sınıf</option>
                                <option value="2">2 Sınıf</option>
                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Görevi:</b>

                            <select class="form-control" name="ogretmenGorev">

                                <option value="">Görev Seciniz</option>

                                <option value="Dr.Öğretim Görevlisi">Dr.Öğretim Görevlisi</option>

                                <option value="Dc.Öğretim Görevlisi">Dc.Öğretim Görevlisi</option>

                                <option value="Müdür Yardımcısı">Müdür Yardımcısı</option>

                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Bölüm:</b>

                            <select class="form-control" name="ogretmenBolumAd">
                                <option value="">Bölüm Seçiniz</option>
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

                            <select class="form-control" id="ilid" name="il" value="">
                                <option>İl Seçiniz </option>
                                <?php
                                $il = $baglanti->query("SELECT * FROM iller");

                                $ilcek = $il->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($ilcek as $ilgoster) {
                                ?>
                                    <option value="<?php echo $ilgoster['il_no'] ?>"><?= $ilgoster['il_isim'] ?></option>
                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>İlçe:</b>

                            <select class="form-control" id="ilceler" name="ilce" value="<?= @$_POST['ilce'] ?>">

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
                                    <option value="<?php echo $gorevgoster['gorevid'] ?>"><?= $gorevgoster['gorevAd'] ?></option>                               
                                <?php } ?>
                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Şifre Girin:</b>

                            <input type="password" class="form-control" name="ogretmensifre">

                        </div>



                        <button type="submit" class="btn btn-primary float-end" name="ogretmenKaydet">Kaydet</button>

                    </form>

                </div>







            </div>

        </div>

    </div>

    <?php

    if (isset($_POST['ogretmenKaydet'])) {

        $adSoyad =       htmlspecialchars(trim($_POST['ogretmenAdSoyad']));

        $sicil =         htmlspecialchars(trim($_POST['ogretmenSicilNo']));

        $danismanDurum = htmlspecialchars(trim($_POST['ogretmenDanismanDurum']));

        $gorev =         htmlspecialchars(trim($_POST['ogretmenGorev']));

        $bolum =         htmlspecialchars(trim($_POST['ogretmenBolumAd']));

        $il =            htmlspecialchars(trim($_POST['il']));

        $ilce =          htmlspecialchars(trim($_POST['ilce']));

        $sifre =         htmlspecialchars(trim($_POST['ogretmensifre']));



        if (!$adSoyad || !$sicil || !$danismanDurum || !$gorev || !$bolum || !$il  || !$ilce  || !$sifre) {

            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'BOŞ ALAN BIRAKMAYINIZ!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
        }

        // elseif ($sicil = strlen($_POST['ogretmenSicilNo']) >= 10) {

        //   echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'sicil numara 9 haneden oluşmalıdır!!!', icon:'success',confirmButtonText:'Tamam' })</script>";

        // } 

        else {

            $kontrol = $baglanti->query("SELECT ogretmenbilgi.ogretmenSicilNo FROM ogretmenbilgi where ogretmenSicilNo = '$sicil'")->fetch();

            $kontrol2 = $baglanti->query("SELECT ogretmenbilgi.ogretmenDanismanDurum,ogretmenbilgi.ogretmenBolumAd FROM ogretmenbilgi where ogretmenDanismanDurum = '$danismanDurum' and ogretmenBolumAd = '$bolum' ")->fetch();

            if ($kontrol) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:'Aynı sicil Numara Kullanılmakta !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
            } elseif ($kontrol2) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:'Aynı bolum  ve sınıf  Kullanılmakta!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
            } else {

                $sorgu = $baglanti->prepare('INSERT INTO ogretmenbilgi SET

            

      ogretmenAdSoyad=?,

      ogretmenSicilNo=?,

      ogretmenDanismanDurum=?,

      ogretmenGorev=?,

      ogretmenBolumAd=?,

      il=?,

      ilce=?

  



');

                $sifre = htmlspecialchars(trim("5645xa" . md5(sha1($_POST['ogretmensifre'])) . "2023"));





                $kaydet = $sorgu->execute([

                    $adSoyad, $sicil, $danismanDurum, $gorev, $bolum, $il, $ilce

                ]);



                if ($kaydet) {

                    echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRETMEN  EKLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                    header("Refresh:1;url=ogretmen-ekle");

                    $cekk = $baglanti->query("SELECT * FROM ogretmenbilgi where ogretmenSicilNo='$sicil' ");

                    $ogretmencek = $cekk->fetch();

                    $ogretmenid = $ogretmencek['id'];

                    $yetkiekle = $ogretmencek['yetki'];

                    $kgorev = $_POST['kGorev'];

                    $usersler = $baglanti->prepare('INSERT INTO kullanicilar SET

      

      isim=?,    

      kadi=?,

      sifre=?,    

      yetki=?,

      ogretmenid=?,

      kGorev = ?,

      bolum = ?

      

      

      

      ');



                    $usersler->execute([

                        $adSoyad, $sicil, $sifre, $yetkiekle, $ogretmenid, $kgorev, $bolum

                    ]);





                    $ogretmensifreguncelle = $baglanti->prepare("UPDATE ogretmenbilgi SET ogretmenSifre = ? WHERE id = ?");

                    $ogretmensifreguncelle->execute([$sifre, $ogretmenid]);
                }
            }
        }
    }







    ?>



    <script>
        $("#ilid").on('change', function() {

            var sehir = $("#ilid").val();

            $("#ilceler").load('ilcecek', {

                'ilid': sehir

            });

        });
    </script>

    <!-- Modal Öğretmen Ekleme Bitiş-->


    <?php

    include 'inc/footer.php';



    ?>
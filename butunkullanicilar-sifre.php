<?php

$title = "Şifre Güncelleme";

$menu = "sifre";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki1kisit.php';



?>





<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">Öğrenci Ekleme</li>

            </ol>





            <div class="card mb-4 ">

                <div class="col-12 text-center">

                    <button class="btn bg-success my-2 text-white float-start p-2 ms-2" id="ogrencilistele"><i class="bi bi-person me-2"></i> Öğrenci Listele</button>

                    <button class="btn bg-danger my-2 active text-white float-end p-2 me-2 " id="ogretmenlistele"><i class="bi bi-person me-2"></i> Öğretmen Listele</button>

                </div>





                <div class="card-body active" id="ogrencigoster">

                    <h1 class="text-center">Öğrenci Liste</h1>

                    <table id="myTable" class="table table-striped">



                        <thead>

                            <tr class="text-center">



                                <th>S.No</th>

                                <th>Ad Soyad</th>

                                <th>Öğrenci No</th>

                                <th>Sınıf</th>

                                <th>Bölüm Ad</th>

                                <th>Kayıt Yıl</th>

                                <th>İşlemler </th>



                            </tr>

                        </thead>

                        <tbody>



                            <?php



                            $ogrenciCek = $baglanti->prepare("SELECT * FROM ogrencibilgi,unibolum where ogrencibilgi.ogrenciBolum=unibolum.bolumid ");

                            $ogrenciCek->execute();

                            $cekOgrenci = $ogrenciCek->fetchAll(PDO::FETCH_ASSOC);



                            $sayi = 0;

                            foreach ($cekOgrenci as $ogrenciKayitCek) {



                                $sayi = ++$sayi;



                            ?>



                                <tr class="text-center " style="line-height: 35px;">

                                    <th><?= $sayi ?></th>

                                    <th><?= $ogrenciKayitCek['ogrenciAdsoyad']; ?></th>

                                    <th><?= $ogrenciKayitCek['ogrenciOgrNo']; ?></th>

                                    <th><?= $ogrenciKayitCek['ogrenciSinif']; ?> SINIF</th>                                

                                    <th><?= $ogrenciKayitCek['bolumAd']; ?></th>

                                    <th><?= $ogrenciKayitCek['ogrencidate']; ?></th>

                                    <th style="font-weight: 900;font-size:20px;"><a href="#" data-toggle="modal" data-target="#ogrenciBilgiGuncelleme<?= $ogrenciKayitCek['id']; ?>"><i class="fa fa-edit me-5 text-success" href="#" alt="İşlemler"></i></a> <a href="#"><i class="bi bi-trash3-fill text-danger"></i></a></th>



                                </tr>



                            <?php }



                            ?>



                        </tbody>

                    </table>

                </div>



                <div class="card-body " id="ogretmengoster">

                    <h1 class="text-center">Öğretmen Liste</h1>

                    <table id="ogretmenTable" class="table table-striped">

                        <thead>

                            <tr class="text-center">



                                <th>S.NO</th>

                                <th>Ad Soyad</th>

                                <th>Sicil No</th>

                                <th>Bölüm Ad</th>

                                <th>İşlemler</th>



                            </tr>

                        </thead>



                        <tbody>

                            <?php



                            $ogretmenCek = $baglanti->prepare("SELECT * FROM ogretmenbilgi,unibolum where ogretmenbilgi.ogretmenBolumAd=unibolum.bolumid ");

                            $ogretmenCek->execute();

                            $cekOgretmen = $ogretmenCek->fetchAll(PDO::FETCH_ASSOC);



                            $sayi = 0;

                            foreach ($cekOgretmen as $ogretmenKayitCek) {



                                $sayi = ++$sayi;



                            ?>

                                <tr class="text-center " style="line-height: 35px;">

                                    <th><?= $sayi ?></th>

                                    <th><?= $ogretmenKayitCek['ogretmenAdSoyad'] ?></th>

                                    <th><?= $ogretmenKayitCek['ogretmenSicilNo'] ?></th>

                                    <th><?= $ogretmenKayitCek['bolumAd'] ?></th>



                                    <th style="font-weight: 900;font-size:20px;"><a href="ogretmen-guncelle?id=<?= $ogretmenKayitCek['id'] ?>"><i class="fa fa-edit me-5 text-success" href="#" alt="İşlemler"></i></a> <a href="#"><i class="bi bi-trash3-fill text-danger"></i></a></th>



                                <?php }



                                ?>

                        </tbody>

                    </table>

                </div>











            </div>

        </div>

    </main>



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

                    <h4 class="modal-title"> <i class="bi bi-person me-2"></i> <?=$title?> </h4>

                    <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>

                </div>



                <!-- Modal İçerik -->

                <div class="modal-body">

                    <form action="" method="POST">

                      

                        <div class="form-group mb-3">

                            <b>Ad Soyad:</b>

                            <input type="text" class="form-control" name="ogrenciAdsoyad" value="<?= $cekogr['ogrenciAdsoyad'] ?>">

                        </div>

                        <div class="form-group mb-3">

                            <b>Öğrenci Numara:</b>

                            <input type="text" class="form-control" name="ogrenciOgrNo" value="<?= $cekogr['ogrenciOgrNo'] ?>" >

                        </div>

                        <input type="text" class="form-control" name="id" value="<?= $cekogr['id'] ?>" hidden>

                       

                       

                       

                       

                        <div class="form-group mb-3">

                            <b>Şifre Girin :</b>

                            <input type="password" name="ogrenciSifre" class="form-control" value="<?= $cekogr['ogrenciSifre'] ?>">

                        </div>





                        <button type="submit" class="btn btn-primary float-end" name="ogrenciGuncelleKaydet">Kaydet</button>

                    </form>

                </div>

                <?php



                if (isset($_POST['ogrenciGuncelleKaydet'])) {

                   
                    $ogrenciAdsoyad =  htmlspecialchars(trim($_POST['ogrenciAdsoyad']));

                    $ogrenciOgrNo =    htmlspecialchars(trim($_POST['ogrenciOgrNo']));                   

                    $ogrenciSifre =    htmlspecialchars(trim("5645xa" . md5(sha1($_POST['ogrenciSifre'])) . "2023"));

                    $id =              htmlspecialchars(trim($_POST['id']));

                    if ($baglanti->query("UPDATE ogrencibilgi SET


   ogrenciAdsoyad = '$ogrenciAdsoyad',

    ogrenciOgrNo =  '$ogrenciOgrNo'


   WHERE id =" . $id)) {



                        if ($baglanti->query("UPDATE `kullanicilar`,ogrencibilgi SET 

            `isim`='$ogrenciAdsoyad',`kadi`='$ogrenciOgrNo',`sifre`='$ogrenciSifre'

             WHERE ogrencibilgi.id=kullanicilar.kullaniciid and kullanicilar.kullaniciid=" . $id)) {
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

<?php include 'inc/footer.php'; ?>
   
    <script>
        $(document).ready(function() {

            $("#ogrencigoster").show();
            $("#ogretmengoster").hide();



            $("#ogretmenlistele").click(function() {

                $("#ogretmenlistele").addClass("active");
                $("#ogrencilistele").removeClass("active");

                $("#ogretmengoster").show();
                $("#ogrencigoster").hide();


            });

            $("#ogrencilistele").click(function() {

                $("#ogretmenlistele").removeClass("active");
                $("#ogrencilistele").addClass("active");


                $("#ogretmengoster").hide();
                $("#ogrencigoster").show();

            });




        });
    </script>


  
   
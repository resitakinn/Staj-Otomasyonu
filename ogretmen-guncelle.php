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
                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">
                    <?= $title ?> </li>
            </ol>





            <div class="container p-4">

                <div class="card mb-4">


                    <div class="card-header">

                        <i class="fas fa-table me-1 "></i>

                        <?= $title ?>


                    </div>


                    <?php

                    $id = $_GET['id'];

                    $ogretmenSorgula = $baglanti->query("SELECT `id`, `ogretmenAdSoyad`, `ogretmenSicilNo`, `ogretmenDanismanDurum`, `ogretmenGorev`,  `ogretmenBolumAd`,ilceler.ilce_isim,iller.il_isim ,ogretmenSifre,ogretmenbilgi.il,ogretmenbilgi.ilce  FROM `ogretmenbilgi`,unibolum ,ilceler,iller WHERE ogretmenbilgi.ogretmenBolumAd=unibolum.bolumid AND ogretmenbilgi.ilce=ilceler.ilce_no AND ogretmenbilgi.il=iller.il_no and ogretmenbilgi.id='$id' ");

                    $cek = $ogretmenSorgula->fetch();



                    ?>



                    <form action="" method="post" style="width: 100%; margin:auto; padding:15px;">

                        <div class="form-group mb-3">

                            <b>Ad Soyad:</b>

                            <input type="text" class="form-control" name="ogretmenAdSoyad" value="<?= $cek['ogretmenAdSoyad'] ?>">

                        </div>

                        <div class="form-group mb-3">

                            <b>Sicil Numara:</b>

                            <input type="text" class="form-control" name="ogretmenSicilNo" value="<?= $cek['ogretmenSicilNo'] ?>">

                        </div>



                        <div class="form-group mb-3">

                            <b>Danışman Durumu:</b>

                            <select class="form-control" name="ogretmenDanismanDurum">

                                <option value="<?= $cek['ogretmenDanismanDurum'] ?>">
                                    <?= $cek['ogretmenDanismanDurum'] ?> Sınıf</option>

                                <?php

                                if ($cek['ogretmenDanismanDurum'] == 1) {

                                    echo ' <option value="2">2 Sınıf</option>';
                                } elseif ($cek['ogretmenDanismanDurum'] == 2) {

                                    echo '<option value="1">1 Sınıf</option>';
                                }



                                ?>









                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Görevi:</b>

                            <select class="form-control" name="ogretmenGorev">

                                <option value="<?= $cek['ogretmenGorev'] ?>"><?= $cek['ogretmenGorev'] ?></option>

                                <option value="Dr.Öğretim Görevlisi">Dr.Öğretim Görevlisi</option>

                                <option value="Dc.Öğretim Görevlisi">Dc.Öğretim Görevlisi</option>

                                <option value="Müdür Yardımcısı">Müdür Yardımcısı</option>

                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Bölüm:</b>

                            <select class="form-control" name="ogretmenBolumAd">

                                <?php

                                $bolumAdCek = $cek['ogretmenBolumAd'];

                                $bolum = $baglanti->query("SELECT bolumAd FROM unibolum where unibolum.bolumid='$bolumAdCek' ");

                                $bolumcek = $bolum->fetch();



                                ?>

                                <option value="<?= $cek['ogretmenBolumAd'] ?>"><?= $bolumcek['bolumAd'] ?></option>

                                <?php



                                $bolum = $baglanti->query("SELECT * FROM unibolum WHERE bolumDurum=1");

                                $bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);



                                foreach ($bolumcek as $bolumsonuc) {

                                ?>

                                    <option value="<?php echo $bolumsonuc['idbolum'] ?>"><?= $bolumsonuc['bolumAd'] ?>
                                    </option>



                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>İl:</b>

                            <select class="form-control" id="ilid" name="il" value="">

                                <option value="<?= @$cek['il'] ?>"><?= $cek['il_isim'] ?></option>

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

                            <select class="form-control" id="ilceler" name="ilce">

                                <option value="<?= @$cek['ilce'] ?>"> <?= $cek['ilce_isim'] ?> </option>



                            </select>

                        </div>

                        <div class="form-group mb-3">

                            <b>Şifre Girin:</b>

                            <input type="password" class="form-control" name="ogretmenSifre" value="<?= $cek['ogretmenSifre'] ?>">

                        </div>



                        <button type="submit" class="btn btn-primary float-end my-2" name="ogretmenGuncelle">Güncelle</button>

                    </form>





                    <!-- Modal Altı

      <div class="modal-footer">

        <button type="button" class="btn btn-danger outline" data-dismiss="modal">Kapat</button>

      </div> -->









                </div>

            </div>


        </div>
    </main>

    <script>
        $("#ilid").on('change', function() {

            var sehir = $("#ilid").val();

            $("#ilceler").load('ilcecek.php', {

                'ilid': sehir

            });

        });
    </script>



    <?php



    if (isset($_POST['ogretmenGuncelle'])) {

        $ogretmenAdSoyad = htmlspecialchars(trim($_POST['ogretmenAdSoyad']));

        $ogretmenSicilNo = htmlspecialchars(trim($_POST['ogretmenSicilNo']));

        $ogretmenDanismanDurum = htmlspecialchars(trim($_POST['ogretmenDanismanDurum']));

        $ogretmenGorev = htmlspecialchars(trim($_POST['ogretmenGorev']));

        $ogretmenBolumAd = htmlspecialchars(trim($_POST['ogretmenBolumAd']));

        $il = htmlspecialchars(trim($_POST['il']));

        $ilce = htmlspecialchars(trim($_POST['ilce']));

        $kontrol = htmlspecialchars(trim($cek['ogretmenSifre']));
        $adminsifre = htmlspecialchars(trim($_POST['ogretmenSifre']));

        if (!$ogretmenAdSoyad || !$ogretmenSicilNo || !$ogretmenDanismanDurum || !$ogretmenGorev || !$ogretmenBolumAd || !$il || !$ilce || !$adminsifre ) {
            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'BOŞ GEÇMEYİNİZ !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
        }
        elseif ($kontrol === $adminsifre) {
            $ogretmenguncelle = $baglanti->prepare("UPDATE ogretmenbilgi SET ogretmenAdSoyad = ?, ogretmenSicilNo =?, 
 
    ogretmenDanismanDurum = ?, ogretmenGorev = ? , ogretmenBolumAd = ?,
 
   il = ?, ilce = ?    WHERE id =?");
            $ogretmenguncelle->execute([$ogretmenAdSoyad, $ogretmenSicilNo, $ogretmenDanismanDurum, $ogretmenGorev, $ogretmenBolumAd, $il, $ilce, $id]);


            echo " <script>  Swal.fire( {title:'Başarılı', text:'Öğretmen  Güncellendi !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
            header("Refresh:2;url=ogretmen-ekle.php");
        } else {
            $ogretmensifre = htmlspecialchars(trim("5645xa" . md5(sha1($_POST['ogretmenSifre'])) . "2023"));

            $users = $baglanti->prepare("UPDATE `kullanicilar` SET 

                               `isim`=?,`kadi`=?,`sifre`=?,`bolum`=?
                   
                                WHERE  ogretmenid=? ");
            $users->execute([$ogretmenAdSoyad, $ogretmenSicilNo, $ogretmensifre, $ogretmenBolumAd, $id]);
            echo " <script>  Swal.fire( {title:'Başarılı', text:'Öğretmen  Güncellendi !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
            header("Refresh:2;url=ogretmen-ekle.php");
        }
    }


    ?>



    <?php include 'inc/footer.php'; ?>
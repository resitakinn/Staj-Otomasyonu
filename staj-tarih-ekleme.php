<?php

$title = "Staj Tarih Ekleme";

$menu = "stajTarih";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki3kisit.php';

?>



<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">

                    <?= $title ?></li>

            </ol>





            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table me-1"></i>

                    <?= $title ?>









                </div>

                <div class="container">

                    <script type="text/javascript">

                        validNavigation = false;



                        function countdown() {

                            seconds = document.getElementById("lblKalanSure").innerHTML;

                            if (seconds > 0) {

                                document.getElementById("lblKalanSure").innerHTML = seconds - 1;

                                setTimeout("countdown()", 1000);

                            } else {

                                prolizMainPageRedirect('login.aspx');

                            }

                        }

                        setTimeout("countdown()", 1000);

                    </script>

                    <?php

                    $kullaniciid = $kullanicicek['ogretmenid'];

                    $yil = date("Y");

                    $kontrol = $baglanti->query("SELECT stajtarihekleme.stajBolumAd,stajtarihekleme.stajTarihYil, stajtarihekleme.kullaniciid   FROM `ogretmenbilgi`,kullanicilar,stajtarihekleme WHERE kullanicilar.ogretmenid=ogretmenbilgi.id and ogretmenbilgi.ogretmenBolumAd=stajtarihekleme.stajBolumAd and stajTarihYil='$yil' and  stajtarihekleme.kullaniciid='$kullaniciid'")->fetch();



                    if ($kontrol) {



                        echo " <script>  Swal.fire( {

                            title:'BAŞARISIZ',

                             text:'Staj Tarihi Eklendiği İçin Yeni Tarih Eklenemez',

                              icon:'success',

                              showConfirmButton:false,

                              timer: 1900

                             })</script>";

                        header("Refresh:4;url=anasayfa.php");

                        echo '<div class="alert alert-danger" role="alert">

                        <h4 class="alert-heading">BAŞARISIZ YÖNLENDİRİLİYORSUNUZ   <span id="lblKalanSure" style="color:#CC3300;font-size:25pt;">4</span></h4>

                       

                        

                      </div>';

                        exit();

                    }

                    ?>

                    <form action="" method="post">

                        <div class="mb-3 col-6" style="margin: auto;">

                            <div class="form-group mb-3">



                                <?php $cek = $kullanicicek['bolum'];

                                $bolum = $baglanti->query("SELECT * FROM unibolum where idbolum='$cek'");

                                $bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($bolumcek as $bolumsonuc) {

                                ?> <label for="text" style="font-size: 20px; font-weight:bold;

                                            ">Bölüm:

                                        <?= $bolumsonuc['bolumAd'] ?>



                                    </label>

                                <?php } ?>



                                <select class="form-control" id="" name="bolum">

                                    <option value="">Bölüm Seçiniz</option>

                                    <?php

                                    $cekbolumad =  $kullanicicek['bolum'];

                                    $bolum = $baglanti->query("SELECT * FROM unibolum where idbolum='$cekbolumad '");

                                    $bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);



                                    foreach ($bolumcek as $bolumsonuc) {

                                    ?>

                                        <option value="<?php echo $bolumsonuc['idbolum'] ?>"><?= $bolumsonuc['bolumAd'] ?>

                                        </option>



                                    <?php } ?>

                                </select>

                            </div>

                            <div class="form-group mb-3">

                                <label for="tarihekle">Staj Kayıt Tarih Yılı Aç : </label>

                                <input class="form-control mr-sm-2" type="search" name="stajYil" onkeypress="return isNumberKey(event)" value="<?= date('Y'); ?>" maxlength="4" aria-label="Search">

                                <script>

                                    function isNumberKey(evt) {

                                        var charCode = (evt.which) ? evt.which : event.keyCode;

                                        if (charCode > 31 && (charCode < 48 || charCode > 57))

                                            return false;

                                        return true;

                                    }

                                </script>

                            </div>

                            <div class="form-group mb-3">

                                <label for="tarihekle"> Evrak son Teslim Tarihi Giriniz : </label>

                                <input class="form-control mr-sm-2" name="evrakbitis" type="datetime-local" min="<?php echo date('Y-m-d H:i'); ?>" onkeypress="return isNumberKey(event)" aria-label="Search">

                                <script>

                                    function isNumberKey(evt) {

                                        var charCode = (evt.which) ? evt.which : event.keyCode;

                                        if (charCode > 31 && (charCode < 48 || charCode > 57))

                                            return false;

                                        return true;

                                    }

                                </script>

                            </div>

                            <button type="submit" style="color: red; font-size:15px;" class="btn btn-primary text-white my-2 float-end" data-toggle="modal" data-target="#cikisModal" name="stajkaydet">Kayıt Takvimi Ac </button>



                        </div>

                    </form>

                    <?php



                    if (isset($_POST['stajkaydet'])) {

                        $kullaniciid = $kullanicicek['ogretmenid'];

                        $cekil = $baglanti->prepare("SELECT ogretmenbilgi.ogretmenDanismanDurum FROM kullanicilar,ogretmenbilgi WHERE kullanicilar.ogretmenid=ogretmenbilgi.id and kullanicilar.ogretmenid='$ce' ");

                        $cekil->execute();

                        $ilcekil = $cekil->fetch();

                        $sinif = $ilcekil['ogretmenDanismanDurum'];





                        $bolum = htmlspecialchars(trim($_POST['bolum']));

                        $stajYil = htmlspecialchars(trim($_POST['stajYil']));

                        $evrakbitis = htmlspecialchars(trim( $_POST['evrakbitis']));



                        if ($bolum == 0) {

                            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'Boş Geçmeyiniz', icon:'error',confirmButtonText:'Tamam' })</script>";

                        }





                        if ($stajYil > date("Y")) {

                            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'Girdiğiniz Tarih  Yılı " . $stajYil . " Güncel Yıldan Büyük Yıl Gİremezsin Şuan Güncel Olan Tarih Yılı => " . date("Y") . "', icon:'success',confirmButtonText:'Tamam' })</script>";

                           

                        } elseif ($stajYil < date("Y")) {

                            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'Girdiğiniz Tarih  Yılı " . $stajYil . " Güncel Yıldan Küçük Yıl Gİremezsin Şuan Güncel Olan Tarih Yılı => " . date("Y") . "', icon:'success',confirmButtonText:'Tamam' })</script>";

                        } elseif (!$bolum || !$stajYil  || !$evrakbitis) {

                            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'Boş Geçmeyiniz', icon:'error',confirmButtonText:'Tamam' })</script>";

                            header("Refresh:1;");

                        } else {

                            $sorgu = $baglanti->prepare('INSERT INTO stajtarihekleme SET

            stajBolumAd=?,    

            stajTarihYil=?,                

            stajEvrakBitis=?,

            kullaniciid=?,

            stajSinif=?

          

        

      

      ');

                            $kaydet = $sorgu->execute([

                                $bolum, $stajYil, $evrakbitis, $kullaniciid, $sinif

                            ]);

                            if ($kaydet) {

                                echo " <script>  Swal.fire( {title:'BAŞARILI', text:'EKLENDİ', icon:'success',confirmButtonText:'Tamam' })</script>";

                                header("Refresh:2;url=anasayfa.php");

                            }

                        }

                    }



                    ?>





                    <?php

                    // $ss = $baglanti->query("SELECT * FROM `stajtarihekleme` ");

                    // $ss->execute();

                    // $s=$ss->fetch();



                    // echo $s['stajEvrakBitis'];

                    ?>

                </div>





            </div>

        </div>

    </main>



    <?php include 'inc/footer.php'; ?>
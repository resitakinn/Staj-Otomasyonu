<?php

$title = "Staj Bilgileri Ekleme & Güncelleme";

$menu = "stajBilgiEkleme";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki2kisit.php';



?>





<div id="layoutSidenav_content">



    <main>



        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">

                    <?= $title ?></li>

            </ol>

            <?php

            if ($_SESSION['yetki'] == 3) {



                $ogrenciid =  $kullanicicek['kullaniciid'];

                $kontrol0 = $baglanti->query("SELECT ogrencibilgi.ogrenciSinif FROM kullanicilar,ogrencibilgi WHERE

           ogrencibilgi.id=kullanicilar.kullaniciid and ogrencibilgi.id='$ogrenciid' ");

                $kontrol0->execute();

                $cek = $kontrol0->fetch();

                $sinifCek = $cek['ogrenciSinif'];



                $yil = date("Y");

                $bolum = $kullanicicek['bolum'];

                $kontrol = $baglanti->query("SELECT stajtarihekleme.stajBolumAd,stajtarihekleme.stajTarihYil,stajtarihekleme.stajSinif FROM stajtarihekleme,kullanicilar,ogrencibilgi,unibolum WHERE

            stajtarihekleme.stajBolumAd=unibolum.bolumid and unibolum.bolumid=kullanicilar.bolum 

            and stajtarihekleme.stajTarihYil=' $yil' and stajtarihekleme.stajSinif=ogrencibilgi.ogrenciSinif and ogrencibilgi.ogrenciSinif='$sinifcek' and    stajtarihekleme.stajBolumAd='$bolum'");

                $kontrol->fetch();

                $say = $kontrol->rowCount();



                if ($say == 0 and $_SESSION['yetki'] == 3) {

                    echo '<script>alert("Şuanlık Yetkiniz Yoktur Buraya Girmeye")</script>';

                    header("Refresh:3;url=anasayfa.php");

                    echo '<div class="alert alert-danger" role="alert">

          <h4 class="alert-heading">BAŞARISIZ YÖNLENDİRİLİYORSUNUZ   <span id="lblKalanSure" style="color:#CC3300;font-size:25pt;">4</span></h4>

          <p></p>

          <p class="mb-0">HENÜZ STAJ TAKVİM YILI AKTİF OLMADI</p>

        </div>';

                    exit();
                }       # code...

            } ?>



            <div class="card mb-5 p-3">

                <div class="col-12 text-center">



                    <?php



                    $ogrenciid =  $kullanicicek['kullaniciid'];



                    $ogrencibilgi = $baglanti->query("SELECT stajbilgileri.stajdurumOnay, kullanicilar.kullaniciid FROM stajbilgileri, kullanicilar WHERE stajbilgileri.kullaniciid = '$ogrenciid'")->fetch();



                    $defterKontrol = $baglanti->query("SELECT stajdefter.ogrenciİd FROM `stajdefter`,ogrencibilgi WHERE stajdefter.ogrenciİd=ogrencibilgi.id AND stajdefter.ogrenciİd='$ogrenciid' ");

                    $defterKontrol->fetch();



                    if ($ogrencibilgi !== false) {

                        if ($defterKontrol->rowCount() > 0) {
                        } else { ?>

                            <button class="btn bg-success my-2 active text-white  p-2 me-2 " id="stajBilgiGuncelle">Staj

                                Bilgileri Güncelle</button>

                    <?php      }
                    } else {

                        echo '    <button class="btn bg-primary my-2 text-white  p-2 ms-2" id="stajBilgiKaydet">Staj

                        Bilgileri Kaydet</button>';
                    }  ?>











                </div>

                <?php



                $ogrenciid =  $kullanicicek['kullaniciid'];

                $ogrencibilgi = $baglanti->query("SELECT * FROM ogrencibilgi where id='$ogrenciid'")->fetch();









                $ogrencibilgii = $baglanti->query("SELECT stajbilgileri.stajdurumOnay, kullanicilar.kullaniciid FROM stajbilgileri, kullanicilar WHERE stajbilgileri.kullaniciid = '$ogrenciid'")->fetch();









                if ($ogrencibilgii !== false) {



                    if ($defterKontrol->rowCount() > 0) {

                        echo '<div class="alert alert-danger text-center uotline" role="alert">

                        <h1 class="alert-heading">BAŞARISIZ STAJ DEFTERİNİZİ SİSTEME YÜKLEDİĞİNİZ İÇİN ARTIK GÜNCELLEME YAPAMAZSINIZ   

                        </h1>

                        

                      </div>';

                        include "inc/footer.php";

                        header("Refresh:3;url=anasayfa.php");

                        exit();
                    } else { ?>

                        <div class="container" id="stajGuncel">

                            <h4 class="text-center bg-danger text-white p-4">Bilgileri Güncelle</h4>

                            <div class="col-12 col-md-5  float-start me-5 border border-1 p-4">

                                <h4> TÜM ALANLARI EKSİKSİZ DOLDURUN</h4>

                                <form action="" method="post">

                                    <div class="form-group mb-2">



                                        <input type="text" class="form-control" name="StajtcKimlik" value="<?php echo $ogrencibilgi['ogrenciTc'] ?>" hidden>

                                    </div>

                                    <div class="form-group mb-2">

                                        <input type="text" class="form-control" name="stajAdSoyad" value="<?= $kullanicicek['isim'] ?>" hidden>

                                    </div>



                                    <div class="form-group mb-2">

                                        <?php

                                        $idBolum = $kullanicicek['bolum'];

                                        $cek = $baglanti->query("SELECT * FROM unibolum where unibolum.bolumid='$idBolum'");

                                        $bolumcek = $cek->fetch();



                                        ?>



                                        <select name="stajbolum" id="stajbolum" class="form-control" hidden>

                                            <option value="<?= $bolumcek['bolumid'] ?> "><?= $bolumcek['bolumAd'] ?></option>

                                        </select>

                                    </div>

                                    <div class="form-group mb-2">



                                        <input type="text" class="form-control" name="StajogrNo" value="<?= $kullanicicek['kadi'] ?>" hidden>

                                    </div>

                                    <div class="form-group mb-2">



                                        <input type="text" class="form-control" name="StajTarihYil" value="<?= date("Y") ?>" hidden>

                                    </div>



                                    <div class="form-group mb-2">

                                        <?php

                                        $id = $kullanicicek['kullaniciid'];

                                        $cekil = $baglanti->prepare("SELECT iller.il_no,iller.il_isim FROM kullanicilar,ogrencibilgi,iller WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND ogrencibilgi.il=iller.il_no AND kullanicilar.kullaniciid='$id'");

                                        $cekil->execute();

                                        $ilcekil = $cekil->fetch();



                                        ?>

                                        <select name="stajİl" class="form-control">

                                            <option value="<?= $ilcekil['il_no'] ?>"> <?= $ilcekil['il_isim'] ?></option>

                                        </select>

                                    </div>



                                    <div class="form-group mb-2">





                                        <?php



                                        $cekil = $baglanti->prepare("SELECT ilceler.ilce_no,ilceler.ilce_isim FROM kullanicilar,ogrencibilgi,ilceler WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND ogrencibilgi.ilce=ilceler.ilce_no AND kullanicilar.kullaniciid='$id'");

                                        $cekil->execute();

                                        $ilcekil = $cekil->fetch();



                                        ?>

                                        <select name="stajİlce" id="stajİlce" class="form-control" hidden>

                                            <option value="<?= $ilcekil['ilce_no'] ?> "><?= $ilcekil['ilce_isim']; ?></option>

                                        </select>

                                    </div>

                                    <div class="form-group mb-2">

                                        <?php



                                        $sinifCek = $baglanti->prepare("SELECT ogrencibilgi.ogrenciSinif,kullanicilar.ogrenciEmail FROM kullanicilar,ogrencibilgi WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND kullanicilar.kullaniciid='$id'");

                                        $sinifCek->execute();

                                        $cekSinif = $sinifCek->fetch();



                                        ?>



                                        <select name="StajSinif" class="form-control" hidden>

                                            <option value="<?= $cekSinif['ogrenciSinif'] ?> "><?= $cekSinif['ogrenciSinif'] ?>

                                                Sınıf</option>

                                        </select>

                                    </div>

                                    <?php

                                    $ogrencibilgicekk = $baglanti->query("SELECT * FROM stajbilgileri where kullaniciid='$ogrenciid'")->fetch();



                                    ?>

                                    <div class="form-group mb-2">

                                        <b>Baba Adı :</b>

                                        <input type="text" class="form-control" name="stajBabaAd" value="<?= $ogrencibilgicekk['stajBabaAd'] ?> ">

                                    </div>

                                    <div class="form-group mb-2">

                                        <b>Anne Ad:</b>

                                        <input type="text" class="form-control" name="stajAnneAd" value="<?= $ogrencibilgicekk['stajAnneAd'] ?> ">

                                    </div>



                                    <div class="form-group mb-2">

                                        <?php

                                        $date = $ogrencibilgicekk['stajDogumTarih'];

                                        $phpdate = strtotime($date);

                                        $mysqldate = date('d-m-Y ', $phpdate);

                                        ?>

                                        <b>Doğum Tarihi:</b>

                                        <input type="text" class="form-control" name="stajDogumTarih" value="<?= $mysqldate ?> ">

                                    </div>

                                    <div class="form-group mb-2">

                                        <?php



                                        $email = $baglanti->prepare("SELECT kullanicilar.ogrenciEmail FROM kullanicilar WHERE kullanicilar.kullaniciid='$id'");

                                        $email->execute();

                                        $cekemail = $email->fetch();



                                        ?>

                                        <input type="email" class="form-control" name="stajEmail" value="<?= $cekemail['ogrenciEmail'] ?> ">

                                    </div>

                                    <div class="form-group mb-2">

                                        <b>Telefon:</b>

                                        <input type="tel" class="form-control" name="stajTel" value="<?= $ogrencibilgicekk['stajTel'] ?> ">

                                    </div>

                                    <div class="form-group mb-2">

                                        <b>SSK:</b>

                                        <input type="text" class="form-control" name="sskStajNo" value="<?= $ogrencibilgicekk['sskStajNo'] ?> ">

                                    </div>

                                    <div class="form-group mb-2">

                                        <b for="sskStajDurum">Saglık Güvencem durumu:</b>

                                        <select name="sskStajDurum" id="" class="form-control">

                                            <option value="<?= $ogrencibilgicekk['sskStajDurum'] ?> "><?php

                                                                                                        if ($ogrencibilgicekk['sskStajDurum'] == 1) {

                                                                                                            echo "Var";
                                                                                                        } else {

                                                                                                            echo "Yok";
                                                                                                        } ?></option>

                                            <?php

                                            if ($ogrencibilgicekk['sskStajDurum'] == 1) {

                                                echo '<option value="0">Yok</option>';
                                            } else {

                                                echo '<option value="1">Var</option>';
                                            }

                                            ?>





                                        </select>

                                    </div>





                            </div>

                            <div class="col-12 col-md-5 float-start border border-1 p-4">

                                <h4>STAJ YAPILACAK YERE AİT BİLGİLER</h4>

                                <div class="form-group mb-2">

                                    <b>Ad Ve Soyad:</b>

                                    <input type="text" class="form-control" name="stajİsyeriAd" value="<?= $ogrencibilgicekk['stajİsyeriAd'] ?> ">

                                </div>

                                <div class="form-group mb-2">

                                    <b>Adres:</b>



                                    <textarea name="stajAdress" class="form-control" cols="30" rows="10"><?= $ogrencibilgicekk['stajAdress'] ?> </textarea>

                                </div>



                                <div class="form-group mb-2">

                                    <b>Öğrenci Staj Yaptığı yer:</b>



                                    <select name="stajKurum" class="form-control">

                                        <option value="<?= $ogrencibilgicekk['stajKurum'] ?> "><?php

                                                                                                if ($ogrencibilgicekk['stajKurum'] == 1) {

                                                                                                    echo "Kamu";
                                                                                                } else {

                                                                                                    echo "Özel";
                                                                                                } ?></option>

                                        <?php

                                        if ($ogrencibilgicekk['stajKurum'] == 1) {

                                            echo '<option value="0">Özel</option>';
                                        } else {

                                            echo '<option value="1">Kamu</option>';
                                        }

                                        ?>





                                    </select>

                                </div>

                                <div class="form-group mb-2">

                                    <b>Çalışan sayısı:</b>

                                    <input type="text" class="form-control" name="stajCalisanSayisi" value="<?= $ogrencibilgicekk['stajCalisanSayisi'] ?> ">

                                </div>

                                <button type="submit" class="col-12 btn btn-primary my-3 float-end " name="stajGuncelKaydet">

                                    Staj Bilgileri Güncelle</button>

                                </form>





                            </div>



                            <?php



                            if (isset($_POST['stajGuncelKaydet'])) {





                                $StajtcKimlik = htmlspecialchars(trim($_POST['StajtcKimlik']));

                                $stajAdSoyad =  htmlspecialchars(trim($_POST['stajAdSoyad']));

                                $stajbolum =    htmlspecialchars(trim($_POST['stajbolum']));

                                $StajogrNo =    htmlspecialchars(trim($_POST['StajogrNo']));

                                $StajTarihYil = htmlspecialchars(trim($_POST['StajTarihYil']));

                                $stajil =       htmlspecialchars(trim($_POST['stajİl']));

                                $stajİlce =     htmlspecialchars(trim($_POST['stajİlce']));

                                $StajSinif =    htmlspecialchars(trim($_POST['StajSinif']));

                                $stajBabaAd =   htmlspecialchars(trim($_POST['stajBabaAd']));

                                $stajAnneAd =   htmlspecialchars(trim($_POST['stajAnneAd']));

                                $stajDogumTarih = htmlspecialchars(trim($_POST['stajDogumTarih']));

                                $stajEmail =      htmlspecialchars(trim($_POST['stajEmail']));

                                $stajTel =        htmlspecialchars(trim($_POST['stajTel']));

                                $sskStajNo =      htmlspecialchars(trim($_POST['sskStajNo']));

                                $sskStajDurum =   htmlspecialchars(trim($_POST['sskStajDurum']));

                                $stajİsyeriAd =   htmlspecialchars(trim($_POST['stajİsyeriAd']));

                                $stajAdress =     htmlspecialchars(trim($_POST['stajAdress']));

                                $stajKurum =      htmlspecialchars(trim($_POST['stajKurum']));

                                $stajCalisanSayisi = htmlspecialchars(trim($_POST['stajCalisanSayisi']));







                                if ($baglanti->query("UPDATE `stajbilgileri` SET `StajtcKimlik`=' $StajtcKimlik',`stajAdSoyad`='$stajAdSoyad',`stajbolum`='$stajbolum',`StajogrNo`='$StajogrNo',`StajTarihYil`='$StajTarihYil',`stajİl`='$stajil',`stajİlce`='$stajİlce',`stajSinif`='$StajSinif',`stajBabaAd`='$stajBabaAd',`stajAnneAd`='$stajAnneAd',`stajDogumTarih`='$stajDogumTarih',`stajEmail`='$stajEmail',`stajTel`='$stajTel',`sskStajNo`='$sskStajNo',`sskStajDurum`='$sskStajDurum',`stajİsyeriAd`='$stajİsyeriAd',`stajAdress`='$stajAdress',`stajKurum`='$stajKurum',`stajCalisanSayisi`='$stajCalisanSayisi' WHERE  stajbilgileri.kullaniciid =" . $ogrenciid)) {

                                    echo " <script>  Swal.fire( {title:'Başarılı', text:' BİLGİLER GÜNCELLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                                    header("Refresh:2");

                                    // Eğer güncelleme sorgusu çalıştıysa alinankitap.php sayfasına yönlendiriyoruz.

                                } else {

                                    echo " <script>  Swal.fire( {title:'Başarısız', text:' BİLGİLER GÜNCELLENMEDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                                }
                            }

                            ?>









                        </div>

                    <?php      }
                } else { ?>

                    <div class="container" id="stajGuncel">

                        <h4 class="text-center bg-danger text-white p-4">Bilgileri Güncelle</h4>

                        <div class="col-12 col-md-5  float-start me-5 border border-1 p-4">

                            <h4> TÜM ALANLARI EKSİKSİZ DOLDURUN</h4>

                            <form action="" method="post">

                                <div class="form-group mb-2">

                                    <input type="text" class="form-control" name="StajtcKimlik" value="<?php echo $ogrencibilgi['ogrenciTc'] ?>" hidden>

                                </div>

                                <div class="form-group mb-2">



                                    <input type="text" class="form-control" name="stajAdSoyad" value="<?= $kullanicicek['isim'] ?>" hidden>

                                </div>



                                <div class="form-group mb-2">



                                    <?php

                                    $idBolum = $kullanicicek['bolum'];

                                    $cek = $baglanti->query("SELECT * FROM unibolum where unibolum.bolumid='$idBolum'");

                                    $bolumcek = $cek->fetch();



                                    ?>



                                    <select name="stajbolum" id="stajbolum" class="form-control" hidden>

                                        <option value="<?= $bolumcek['bolumid'] ?> "><?= $bolumcek['bolumAd'] ?></option>

                                    </select>

                                </div>

                                <div class="form-group mb-2">



                                    <input type="text" class="form-control" name="StajogrNo" value="<?= $kullanicicek['kadi'] ?>" hidden>

                                </div>

                                <div class="form-group mb-2">



                                    <input type="text" class="form-control" name="StajTarihYil" value="<?= date("Y") ?>" hidden>

                                </div>



                                <div class="form-group mb-2">



                                    <?php

                                    $id = $kullanicicek['kullaniciid'];

                                    $cekil = $baglanti->prepare("SELECT iller.il_no,iller.il_isim FROM kullanicilar,ogrencibilgi,iller WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND ogrencibilgi.il=iller.il_no AND kullanicilar.kullaniciid='$id'");

                                    $cekil->execute();

                                    $ilcekil = $cekil->fetch();



                                    ?>





                                    <select name="stajİl" id="stajİl" class="form-control" hidden>

                                        <option value="<?= $ilcekil['il_no'] ?> "><?= $ilcekil['il_isim']; ?></option>

                                    </select>

                                </div>



                                <div class="form-group mb-2">





                                    <?php



                                    $cekil = $baglanti->prepare("SELECT ilceler.ilce_no,ilceler.ilce_isim FROM kullanicilar,ogrencibilgi,ilceler WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND ogrencibilgi.ilce=ilceler.ilce_no AND kullanicilar.kullaniciid='$id'");

                                    $cekil->execute();

                                    $ilcekil = $cekil->fetch();



                                    ?>

                                    <select name="stajİlce" id="stajİlce" class="form-control" hidden>

                                        <option value="<?= $ilcekil['ilce_no'] ?> "><?= $ilcekil['ilce_isim']; ?></option>

                                    </select>

                                </div>

                                <div class="form-group mb-2">

                                    <?php



                                    $sinifCek = $baglanti->prepare("SELECT ogrenciSinif FROM kullanicilar,ogrencibilgi WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND kullanicilar.kullaniciid='$id'");

                                    $sinifCek->execute();

                                    $cekSinif = $sinifCek->fetch();



                                    ?>



                                    <select name="StajSinif" class="form-control" hidden>

                                        <option value="<?= $cekSinif['ogrenciSinif'] ?> "><?= $cekSinif['ogrenciSinif'] ?>

                                            Sınıf</option>

                                    </select>

                                </div>

                                <?php

                                $ogrencibilgicekk = $baglanti->query("SELECT * FROM stajbilgileri where kullaniciid='$ogrenciid'")->fetch();



                                ?>

                                <div class="form-group mb-2">

                                    <b>Baba Adı :</b>

                                    <input type="text" class="form-control" name="stajBabaAd" value="<?= $ogrencibilgicekk['stajBabaAd'] ?> ">

                                </div>

                                <div class="form-group mb-2">

                                    <b>Anne Ad:</b>

                                    <input type="text" class="form-control" name="stajAnneAd" value="<?= $ogrencibilgicekk['stajAnneAd'] ?> ">

                                </div>



                                <div class="form-group mb-2">

                                    <?php

                                    $date = $ogrencibilgicekk['stajDogumTarih'];

                                    $phpdate = strtotime($date);

                                    $mysqldate = date('d-m-Y ', $phpdate);

                                    ?>

                                    <b>Doğum Tarihi:</b>

                                    <input type="text" class="form-control" name="stajDogumTarih" value="<?= $mysqldate ?> ">

                                </div>

                                <div class="form-group mb-2">


                                    <input type="email" class="form-control" name="stajEmail" value="<?= $ogrencibilgicekk['stajEmail'] ?> " hidden>

                                </div>

                                <div class="form-group mb-2">

                                    <b>Telefon:</b>

                                    <input type="tel" class="form-control" name="stajTel" value="<?= $ogrencibilgicekk['stajTel'] ?> ">

                                </div>

                                <div class="form-group mb-2">

                                    <b>SSK:</b>

                                    <input type="text" class="form-control" name="sskStajNo" value="<?= $ogrencibilgicekk['sskStajNo'] ?> ">

                                </div>

                                <div class="form-group mb-2">

                                    <b>Saglık Güvencem durumu:</b>

                                    <select name="sskStajDurum" class="form-control">

                                        <option value="<?= $ogrencibilgicekk['sskStajDurum'] ?> "><?php

                                                                                                    if ($ogrencibilgicekk['sskStajDurum'] == 1) {

                                                                                                        echo "Var";
                                                                                                    } else {

                                                                                                        echo "Yok";
                                                                                                    } ?></option>

                                        <?php

                                        if ($ogrencibilgicekk['sskStajDurum'] == 1) {

                                            echo '<option value="0">Yok</option>';
                                        } else {

                                            echo '<option value="1">Var</option>';
                                        }

                                        ?>





                                    </select>

                                </div>





                        </div>

                        <div class="col-12 col-md-5 float-start border border-1 p-4">

                            <h4>STAJ YAPILACAK YERE AİT BİLGİLER</h4>

                            <div class="form-group mb-2">

                                <b>Ad Ve Soyad:</b>

                                <input type="text" class="form-control" name="stajİsyeriAd" value="<?= $ogrencibilgicekk['stajİsyeriAd'] ?> ">

                            </div>

                            <div class="form-group mb-2">

                                <b>Adres:</b>



                                <textarea name="stajAdress" class="form-control" cols="30" rows="10"><?= $ogrencibilgicekk['stajAdress'] ?> </textarea>

                            </div>



                            <div class="form-group mb-2">

                                <b>Öğrenci Staj Yaptığı yer:</b>



                                <select name="stajKurum" class="form-control">

                                    <option value="<?= $ogrencibilgicekk['stajKurum'] ?> "><?php

                                                                                            if ($ogrencibilgicekk['stajKurum'] == 1) {

                                                                                                echo "Kamu";
                                                                                            } else {

                                                                                                echo "Özel";
                                                                                            } ?></option>

                                    <?php

                                    if ($ogrencibilgicekk['stajKurum'] == 1) {

                                        echo '<option value="0">Özel</option>';
                                    } else {

                                        echo '<option value="1">Kamu</option>';
                                    }

                                    ?>





                                </select>

                            </div>

                            <div class="form-group mb-2">

                                <b>Çalışan sayısı:</b>

                                <input type="text" class="form-control" name="stajCalisanSayisi" value="<?= $ogrencibilgicekk['stajCalisanSayisi'] ?> ">

                            </div>

                            <button type="submit" class="col-12 btn btn-primary my-3 float-end " name="stajGuncelKaydet">

                                Staj Bilgileri Güncelle</button>

                            </form>





                        </div>



                        <?php



                        if (isset($_POST['stajGuncelKaydet'])) {

                            $StajtcKimlik = htmlspecialchars(trim($_POST['StajtcKimlik']));

                            $stajAdSoyad =  htmlspecialchars(trim($_POST['stajAdSoyad']));

                            $stajbolum =    htmlspecialchars(trim($_POST['stajbolum']));

                            $StajogrNo =    htmlspecialchars(trim($_POST['StajogrNo']));

                            $StajTarihYil = htmlspecialchars(trim($_POST['StajTarihYil']));

                            $stajİl =       htmlspecialchars(trim($_POST['stajİl']));

                            $stajİlce =     htmlspecialchars(trim($_POST['stajİlce']));

                            $StajSinif =    htmlspecialchars(trim($_POST['StajSinif']));

                            $stajBabaAd =   htmlspecialchars(trim($_POST['stajBabaAd']));

                            $stajAnneAd =   htmlspecialchars(trim($_POST['stajAnneAd']));

                            $stajDogumTarih = htmlspecialchars(trim($_POST['stajDogumTarih']));

                            $stajEmail =      htmlspecialchars(trim($_POST['stajEmail']));

                            $stajTel =        htmlspecialchars(trim($_POST['stajTel']));

                            $sskStajNo =      htmlspecialchars(trim($_POST['sskStajNo']));

                            $sskStajDurum =   htmlspecialchars(trim($_POST['sskStajDurum']));

                            $stajİsyeriAd =   htmlspecialchars(trim($_POST['stajİsyeriAd']));

                            $stajAdress =     htmlspecialchars(trim($_POST['stajAdress']));

                            $stajKurum =      htmlspecialchars(trim($_POST['stajKurum']));

                            $stajCalisanSayisi = htmlspecialchars(trim($_POST['stajCalisanSayisi']));



                            if ($baglanti->query("UPDATE `stajbilgileri` SET `StajtcKimlik`=' $StajtcKimlik',`stajAdSoyad`='$stajAdSoyad',`stajbolum`='$stajbolum',`StajogrNo`='$StajogrNo',`StajTarihYil`='$StajTarihYil',`stajİl`='$stajİl',`stajİlce`='$stajİlce',`stajSinif`='$StajSinif',`stajBabaAd`='$stajBabaAd',`stajAnneAd`='$stajAnneAd',`stajDogumTarih`='$stajDogumTarih',`stajEmail`='$stajEmail',`stajTel`='$stajTel',`sskStajNo`='$sskStajNo',`sskStajDurum`='$sskStajDurum',`stajİsyeriAd`='$stajİsyeriAd',`stajAdress`='$stajAdress',`stajKurum`='$stajKurum',`stajCalisanSayisi`='$stajCalisanSayisi' WHERE  stajbilgileri.kullaniciid =" . $ogrenciid)) {

                                echo " <script>  Swal.fire( {title:'Başarılı', text:' BİLGİLER GÜNCELLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                                header("Refresh:2");

                                // Eğer güncelleme sorgusu çalıştıysa alinankitap.php sayfasına yönlendiriyoruz.

                            } else {

                                echo " <script>  Swal.fire( {title:'Başarısız', text:' BİLGİLER GÜNCELLENMEDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                            }
                        }

                        ?>









                    </div>

                <?php }



                ?>



                <div class="container" id="stajBilgi">

                    <?php



                    $ogrencibilgi = $baglanti->query("SELECT * FROM ogrencibilgi where id='$ogrenciid'")->fetch();

                    $StajtcKimlik = $ogrencibilgi['ogrenciTc'];

                    $kontrol1 = $baglanti->query("SELECT stajbilgileri.StajtcKimlik,stajbilgileri.kullaniciid FROM 

               stajbilgileri WHERE stajbilgileri.StajtcKimlik='$StajtcKimlik' and stajbilgileri.kullaniciid='$ogrenciid'");

                    $kontrol1->fetch();

                    if ($kontrol1->rowCount() > 0) {

                        echo '

         <div class="alert alert-danger stil my-3 " role="alert">

          <h4 class="alert-heading text-dark text-center "><i class="bi bi-exclamation-circle"> BAŞARISIZ <i class="bi bi-exclamation-circle ms-1"></i></i></h4>

          <p></p>

          <p class="mb-0   text-dark text-center" style="color:red;font-weight:bold;font-size:20px;">Sistemde Kayıt Var Güncelleme Yapınız</p>

        </div>

       

        

        ';
                    } else { ?>



                        <h4 class="text-center bg-danger text-white p-4"> Bilgi Kaydet</h4>

                        <div class="col-12 col-md-5 float-start me-5 border border-1 p-4">

                            <h4>ÖĞRENCİYE AİT BİLGİLER (Tüm alanları eksiksiz doldurunuz)</h4>



                            <form action="" method="post">

                                <div class="form-group mb-2">

                                    <?php

                                    $ogrenciid =  $kullanicicek['kullaniciid'];

                                    $ogrencibilgi = $baglanti->query("SELECT * FROM ogrencibilgi where id='$ogrenciid'")->fetch();





                                    ?>



                                    <input type="text" class="form-control" name="StajtcKimlik" value="<?php echo $ogrencibilgi['ogrenciTc'] ?> " hidden>



                                </div>

                                <div class="form-group mb-2">



                                    <input type="text" class="form-control" name="stajAdSoyad" value="<?php echo $ogrencibilgi['ogrenciAdsoyad'] ?>" hidden>

                                </div>



                                <div class="form-group mb-2">

                                    <?php

                                    $idBolum = $ogrencibilgi['ogrenciBolum'];

                                    $cek = $baglanti->query("SELECT * FROM unibolum where unibolum.bolumid='$idBolum'");

                                    $bolumcek = $cek->fetch();



                                    ?>



                                    <select name="stajbolum" class="form-control" hidden>

                                        <option value="<?= $bolumcek['bolumid'] ?> "><?= $bolumcek['bolumAd'] ?></option>

                                    </select>

                                </div>

                                <div class="form-group mb-2">



                                    <input type="text" class="form-control" name="StajogrNo" value="<?php echo $ogrencibilgi['ogrenciOgrNo'] ?>" hidden>

                                </div>

                                <div class="form-group mb-2">

                                    <b>Öğretim yılı:</b>

                                    <input type="text" class="form-control" name="StajTarihYil" value="<?= date("Y") ?>">

                                </div>



                                <div class="form-group mb-2">



                                    <?php

                                    $id = $ogrencibilgi['id'];

                                    $cekil = $baglanti->prepare("SELECT iller.il_no,iller.il_isim FROM ogrencibilgi,iller WHERE  ogrencibilgi.il=iller.il_no AND ogrencibilgi.id='$id'");

                                    $cekil->execute();

                                    $ilcekil = $cekil->fetch();



                                    ?>





                                    <select name="stajİl" id="stajİl" class="form-control" hidden>

                                        <option value="<?= $ilcekil['il_no'] ?> "><?= $ilcekil['il_isim']; ?></option>

                                    </select>

                                </div>



                                <div class="form-group mb-2">





                                    <?php



                                    $cekil = $baglanti->prepare("SELECT ilceler.ilce_no,ilceler.ilce_isim FROM ogrencibilgi,ilceler WHERE  ogrencibilgi.ilce=ilceler.ilce_no AND ogrencibilgi.id='$id'");

                                    $cekil->execute();

                                    $ilcekil = $cekil->fetch();



                                    ?>

                                    <select name="stajİlce" id="stajİlce" class="form-control" hidden>

                                        <option value="<?= $ilcekil['ilce_no'] ?> "><?= $ilcekil['ilce_isim']; ?></option>

                                    </select>

                                </div>

                                <div class="form-group mb-2">

                                    <?php



                                    $sinifCek = $baglanti->prepare("SELECT ogrenciSinif FROM kullanicilar,ogrencibilgi WHERE kullanicilar.kullaniciid=ogrencibilgi.id AND kullanicilar.kullaniciid='$id'");

                                    $sinifCek->execute();

                                    $cekSinif = $sinifCek->fetch();



                                    ?>



                                    <select name="StajSinif" class="form-control" hidden>

                                        <option value="<?= $cekSinif['ogrenciSinif'] ?> "><?= $cekSinif['ogrenciSinif'] ?>

                                            Sınıf</option>

                                    </select>

                                </div>

                                <div class="form-group mb-2">

                                    <b>Baba Adı :</b>

                                    <input type="text" class="form-control" name="stajBabaAd" placeholder="Baba  Adını Girin" value="<?php if ($_POST) {

                                                                                                                                            echo $_POST['stajBabaAd'];
                                                                                                                                        } else {

                                                                                                                                            echo "";
                                                                                                                                        } {
                                                                                                                                        } ?>">

                                </div>

                                <div class="form-group mb-2">

                                    <b>Anne Ad:</b>

                                    <input type="text" class="form-control" name="stajAnneAd" placeholder="Anne Ad  Adını Girin" value="<?php if ($_POST) {

                                                                                                                                            echo $_POST['stajAnneAd'];
                                                                                                                                        } else {

                                                                                                                                            echo "";
                                                                                                                                        } {
                                                                                                                                        } ?>">

                                </div>



                                <div class="form-group mb-2">

                                    <b>Doğum Tarihi:</b>

                                    <input type="date" class="form-control" name="stajDogumTarih" placeholder="Doğum Tarihi Girin" value="<?php if ($_POST) {

                                                                                                                                                echo $_POST['stajDogumTarih'];
                                                                                                                                            } else {

                                                                                                                                                echo "";
                                                                                                                                            } {
                                                                                                                                            } ?>">

                                </div>

                                <div class="form-group mb-2">

                                    <b ">E-posta:</b>

                                    <input type=" email" class="form-control" name="stajEmail" placeholder="E-posta Adresinizi Girin" value="<?php

                                                                                                                                                echo  $ogrencibilgi['ogrenciEmail'];

                                                                                                                                                ?>">

                                </div>

                                <div class="form-group mb-2">

                                    <b>Telefon:</b>

                                    <input type="tel" class="form-control" name="stajTel" placeholder="Telefon Numaranızı Girin" value="<?php if ($_POST) {

                                                                                                                                            echo $_POST['stajTel'];
                                                                                                                                        } else {

                                                                                                                                            echo "";
                                                                                                                                        } {
                                                                                                                                        } ?>">

                                </div>

                                <div class="form-group mb-2">

                                    <b>SSK:</b>

                                    <input type="text" class="form-control" name="sskStajNo" placeholder="SSK Numaranızı varsa Girin" value="<?php if ($_POST) {

                                                                                                                                                    echo $_POST['sskStajNo'];
                                                                                                                                                } else {

                                                                                                                                                    echo "";
                                                                                                                                                } {
                                                                                                                                                } ?>">

                                </div>

                                <div class="form-group mb-2">

                                    <b>Sağlık Güvencem var:</b>

                                    <select name="sskStajDurum" class="form-control">

                                        <option value="">Seçiniz</option>

                                        <option value="1">Var</option>

                                        <option value="">Yok</option>

                                    </select>

                                </div>





                        </div>

                        <div class="col-12 col-md-5  float-start border border-1 p-4">

                            <h4>STAJ YAPILACAK YERE AİT BİLGİLER</h4>

                            <div class="form-group mb-2">

                                <b>Ad Ve Soyad:</b>

                                <input type="text" class="form-control" name="stajİsyeriAd" placeholder="Adınızı ve Soyadı Giriniz" value="<?php if ($_POST) {

                                                                                                                                                echo $_POST['stajİsyeriAd'];
                                                                                                                                            } else {

                                                                                                                                                echo "";
                                                                                                                                            } {
                                                                                                                                            } ?>">

                            </div>

                            <div class="form-group mb-2">

                                <b>Adres:</b>



                                <textarea name="stajAdress" class="form-control" cols="30" rows="10"><?php if ($_POST) {

                                                                                                            echo $_POST['stajAdress'];
                                                                                                        } else {

                                                                                                            echo "";
                                                                                                        } {
                                                                                                        } ?></textarea>

                            </div>



                            <div class="form-group mb-2">

                                <b>Öğrenci Staj Yaptığı yer:</b>

                                <select name="stajKurum" class="form-control">

                                    <option>Seçiniz</option>

                                    <option value="1">Kamu</option>

                                    <option value="0">Özel</option>



                                </select>

                            </div>

                            <div class="form-group mb-2">

                                <b>Çalışan sayısı:</b>

                                <input type="text" class="form-control" name="stajCalisanSayisi" placeholder="Çalışan sayısı" value="<?php if ($_POST) {

                                                                                                                                            echo $_POST['stajCalisanSayisi'];
                                                                                                                                        } else {

                                                                                                                                            echo "";
                                                                                                                                        } {
                                                                                                                                        } ?>">

                            </div>

                            <input type="text" class="form-control text-danger" name="kullanici" value="<?php echo $ogrenciid ?>" hidden>

                            <button type="submit" class="btn btn-primary my-3 float-end " name="stajKaydet">Staj Bilgileri

                                Kaydet</button>

                            </form>





                        </div>

                        <?php



                        if (isset($_POST['stajKaydet'])) {

                            $StajtcKimlik = htmlspecialchars(trim($_POST['StajtcKimlik']));

                            $stajAdSoyad =  htmlspecialchars(trim($_POST['stajAdSoyad']));

                            $stajbolum =    htmlspecialchars(trim($_POST['stajbolum']));

                            $StajogrNo =    htmlspecialchars(trim($_POST['StajogrNo']));

                            $StajTarihYil = htmlspecialchars(trim($_POST['StajTarihYil']));

                            $stajİl =       htmlspecialchars(trim($_POST['stajİl']));

                            $stajİlce =     htmlspecialchars(trim($_POST['stajİlce']));

                            $StajSinif =    htmlspecialchars(trim($_POST['StajSinif']));

                            $stajBabaAd =   htmlspecialchars(trim($_POST['stajBabaAd']));

                            $stajAnneAd =   htmlspecialchars(trim($_POST['stajAnneAd']));

                            $stajDogumTarih = htmlspecialchars(trim($_POST['stajDogumTarih']));

                            $stajEmail =      htmlspecialchars(trim($_POST['stajEmail']));

                            $stajTel =        htmlspecialchars(trim($_POST['stajTel']));

                            $sskStajNo =      htmlspecialchars(trim($_POST['sskStajNo']));

                            $sskStajDurum =   htmlspecialchars(trim($_POST['sskStajDurum']));

                            $stajİsyeriAd =   htmlspecialchars(trim($_POST['stajİsyeriAd']));

                            $stajAdress =     htmlspecialchars(trim($_POST['stajAdress']));

                            $stajKurum =      htmlspecialchars(trim($_POST['stajKurum']));

                            $stajCalisanSayisi = htmlspecialchars(trim($_POST['stajCalisanSayisi']));

                            $kullaniciid = $_POST['kullanici'];

                            if (

                                !$StajtcKimlik || !$stajAdSoyad || !$stajbolum || !$StajogrNo || !$StajTarihYil || !$stajİl ||

                                !$stajİlce || !$StajSinif || !$stajBabaAd || !$stajAnneAd || !$stajDogumTarih || !$stajEmail ||

                                !$stajTel || !$sskStajNo  || !$stajİsyeriAd || !$stajAdress || !$stajCalisanSayisi

                            ) {

                                echo " <script>  Swal.fire( {title:'Başarısız', text:'BOŞ ALAN BIRAKMAYINIZ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                            } else {

                                $ogrid = $baglanti->query("SELECT * FROM stajbilgileri where kullaniciid='$kullaniciid'")->fetch();

                                $kontrolTc = $baglanti->query("SELECT * FROM stajbilgileri where StajtcKimlik='$StajtcKimlik'")->fetch();

                                if ($ogrid) {

                                    echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRİLEN ÖĞRENCİ  KAYITLI GÜNCELLEME'YE GİDİNİZ  !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                                } elseif ($kontrolTc) {

                                    echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRİLEN TC NUMARA KAYITLI GÜNCELLEME'YE GİDİNİZ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                                } else {





                                    $stajbilgiKaydet = $baglanti->prepare('INSERT INTO stajbilgileri SET

        StajtcKimlik=?,

         stajAdSoyad=?,

          stajbolum=?,

           StajogrNo=?,

            StajTarihYil=?,

             stajİl=?,

              stajİlce=?,

              StajSinif=?,

               stajBabaAd=?,

                stajAnneAd=?,

                 stajDogumTarih=?,

                  stajEmail=?,

                   stajTel=?,

                   sskStajNo=?,

                    sskStajDurum=?,

                    stajİsyeriAd=?,

                     stajAdress=?,

                      stajKurum=?,

                       stajCalisanSayisi=?,                   

                         kullaniciid=? ');

                                    $kaydet = $stajbilgiKaydet->execute([

                                        $StajtcKimlik,

                                        $stajAdSoyad,

                                        $stajbolum,

                                        $StajogrNo,

                                        $StajTarihYil,

                                        $stajİl,

                                        $stajİlce,

                                        $StajSinif,

                                        $stajBabaAd,

                                        $stajAnneAd,

                                        $stajDogumTarih,

                                        $stajEmail,

                                        $stajTel,

                                        $sskStajNo,

                                        $sskStajDurum,

                                        $stajİsyeriAd,

                                        $stajAdress,

                                        $stajKurum,

                                        $stajCalisanSayisi,

                                        $kullaniciid

                                    ]);

                                    if ($kaydet) {

                                        echo " <script>  Swal.fire( {title:'Başarılı', text:'BİLGİLER EKLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                                        header("Refresh:1;url=anasayfa.php");
                                    }
                                }
                            }
                        }



                        ?>





                </div>





            <?php  }



            ?>





            </div>

        </div>

    </main>



    <!-- jquery   -->
    


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- jquery bitiş -->

    <script>
        $(document).ready(function() {



            $("#stajBilgi").show();

            $("#stajGuncel").hide();







            $("#stajBilgiGuncelle").click(function() {



                $("#stajBilgiGuncelle").addClass("active");

                $("#stajBilgiKaydet").removeClass("active");



                $("#stajGuncel").show();

                $("#stajBilgi").hide();





            });



            $("#stajBilgiKaydet").click(function() {



                $("#stajBilgiGuncelle").removeClass("active");

                $("#stajBilgiKaydet").addClass("active");





                $("#stajGuncel").hide();

                $("#stajBilgi").show();



            });









        });
    </script>





    <?php include 'inc/footer.php'; ?>





    
    <script type="text/javascript">
 

                function countdown() {

                    seconds = document.getElementById("lblKalanSure").innerHTML;

                    if (seconds > 0) {

                        document.getElementById("lblKalanSure").innerHTML = seconds - 1;

                        setTimeout("countdown()", 1000);

                    } else {

                        prolizMainPageRedirect('anasayfa');

                    }

                }

                setTimeout("countdown()", 1000);
            </script>
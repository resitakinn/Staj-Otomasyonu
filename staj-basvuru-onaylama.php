<?php

$title = "Staj Başvuru Onaylama";

$menu = "stajOnay";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki3kisit.php';



?>



<?php



if (isset($_SESSION['stajApproval'])) {

    if ($_SESSION['stajApproval'] == "ok") {

        echo " <script>

        Swal.fire({

            position: 'center',

            icon: 'success',

            title: 'KAYIT ONAYLANDI',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

            showConfirmButton: false,

            timer: 1500

        })

    </script>";

        unset($_SESSION['stajApproval']);

        header("Refresh:2");

    }

}

if (isset($_SESSION['stajcancel'])) {

    if ($_SESSION['stajcancel'] == "no") {

        echo "<script>

        Swal.fire({

            position: 'center',

            title: 'ONAY DURUMU İPTAL EDİLDİ ',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

            icon: 'error',

            showConfirmButton: false,

            timer: 2000

        })

    </script>";

        unset($_SESSION['stajcancel']);

        header("Refresh:2");

    }

}

if (isset($_SESSION['stajbasvurusil'])) {

    if ($_SESSION['stajbasvurusil'] == "yes") {

        echo " <script>

        Swal.fire({

            position: 'center',

            icon: 'success',

            title: 'STAJ BİLGİLERİ KAYDI SİLİNDİ',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

            showConfirmButton: false,

            timer: 1500

        })

    </script>";

        unset($_SESSION['stajbasvurusil']);

        header("Refresh:2");

    }

}







?>



<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa" class="me-2 nav-link">Anasayfa</a> /<li class="breadcrumb-item ms-2 active"><?= $title ?></li>

            </ol>





            <div class="card mb-4">

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

                <?php $bolum = $kullanicicek['bolum'];

                $yil = date("Y");

                $bolum = $kullanicicek['bolum'];

                $kontrol = $baglanti->query("SELECT stajtarihekleme.stajBolumAd,stajtarihekleme.stajTarihYil,stajtarihekleme.stajSinif FROM stajtarihekleme,kullanicilar,ogrencibilgi,unibolum WHERE

            stajtarihekleme.stajBolumAd=unibolum.bolumid and unibolum.bolumid=kullanicilar.bolum 

            and stajtarihekleme.stajTarihYil=' $yil' and stajtarihekleme.stajSinif=ogrencibilgi.ogrenciSinif and ogrencibilgi.ogrenciSinif='$sinifcek' and    stajtarihekleme.stajBolumAd='$bolum'");

                $kontrol->fetch();

                $say = $kontrol->rowCount();



                if ($say == 0 and $_SESSION['yetki'] == 2) {

                    echo '<script>alert("Şuanlık Yetkiniz Yoktur Buraya Girmeye")</script>';

                    header("Refresh:3;url=anasayfa.php");

                    echo '<div class="alert alert-danger" role="alert">

          <h4 class="alert-heading">BAŞARISIZ YÖNLENDİRİLİYORSUNUZ   <span id="lblKalanSure" style="color:#CC3300;font-size:25pt;">4</span></h4>

          <p></p>

          <p class="mb-0">HENÜZ STAJ TAKVİM YILI AKTİF OLMADI</p>

        </div>';

                    exit();

                } ?>





                <div class="card-body">

                    <?php



                    $ogretmenid = $kullanicicek['ogretmenid'];

                    $ogretmenbilgiCek = $baglanti->query("SELECT ogretmenbilgi.ogretmenDanismanDurum,ogretmenbilgi.ogretmenBolumAd FROM `kullanicilar`,ogretmenbilgi WHERE kullanicilar.ogretmenid=ogretmenbilgi.id AND ogretmenbilgi.id='$ogretmenid'")->fetch();

                    $sinifnumara = $ogretmenbilgiCek['ogretmenDanismanDurum'];

                    $sinifBolum = $ogretmenbilgiCek['ogretmenBolumAd'];



                    $ogrencibasvurulari = $baglanti->query("SELECT stajtarihekleme.stajEvrakBitis,stajbilgileri.id,stajbilgileri.StajtcKimlik,stajbilgileri.stajAdSoyad,stajbilgileri.stajbolum,stajbilgileri.StajogrNo,stajbilgileri.StajTarihYil,stajbilgileri.stajİl,stajbilgileri.stajİlce,stajbilgileri.stajSinif,stajbilgileri.stajBabaAd,stajbilgileri.stajAnneAd,stajbilgileri.stajDogumTarih,stajbilgileri.stajEmail,stajbilgileri.stajTel,stajbilgileri.sskStajNo,stajbilgileri.sskStajDurum,stajbilgileri.stajİsyeriAd,stajbilgileri.stajAdress,stajbilgileri.stajKurum,stajbilgileri.stajCalisanSayisi,stajbilgileri.stajdurumOnay,stajbilgileri.sistemyetki,iller.il_isim,ilceler.ilce_isim

                    FROM

                    stajtarihekleme,stajbilgileri,ogretmenbilgi,iller,ilceler

                    WHERE

                    ogretmenbilgi.id=stajtarihekleme.kullaniciid AND stajbilgileri.stajİl=iller.il_no AND stajbilgileri.stajİlce=ilceler.ilce_no AND

                    ogretmenbilgi.ogretmenDanismanDurum=stajbilgileri.stajSinif AND ogretmenbilgi.ogretmenBolumAd=stajbilgileri.stajbolum AND

                    stajbilgileri.stajSinif='$sinifnumara' AND stajbilgileri.stajbolum = '$sinifBolum' AND stajtarihekleme.kullaniciid='$ogretmenid';");

                    $basvurucek = $ogrencibasvurulari->fetchAll(PDO::FETCH_ASSOC);

                    ?>

                    <table id="stajOnay" class="table table-striped">

                        <thead>

                            <tr class="text-center">



                                <th>#</th>

                                <th>Tc Kimlik</th>

                                <th>Ad Soyad</th>

                                <th>Öğrenci No</th>

                                <th>Staj Tarih Yılı Bitiş</th>



                                <th>Onay Durumu</th>

                                <th>

                                    Güncelleme Yapan Kullanıcı Yetkisi

                                </th>



                                <th>

                                    <input type="text" name="" id="" class="form-control text-center" disabled placeholder="İşlemler">

                                </th>





                            </tr>

                        </thead>



                        <tbody>

                            <?php

                            $siraNo = 0;

                            foreach ($basvurucek as $basvurugoster) {

                                $siraNo = ++$siraNo;

                            ?>



                                <tr class="text-center " style="line-height: 35px;">

                                    <th><?= $siraNo ?></th>

                                    <th><?= $basvurugoster['StajtcKimlik']; ?></th>

                                    <th><?= $basvurugoster['stajAdSoyad']; ?></th>

                                    <th><?= $basvurugoster['StajogrNo']; ?></th>

                                    <th><?php

                                        $tarih = $basvurugoster['stajEvrakBitis'];

                                        $phpdate = strtotime($tarih);

                                        echo $mysqldate = date('d-m-Y H:i:s', $phpdate);



                                        ?></th>

                                    <th><?php

                                        if ($basvurugoster['stajdurumOnay'] == 0) {

                                            echo "<i class=\"bi bi-x-lg\" style=\"color:red;font-size:30px;\"></i>";

                                        } else {

                                            echo " <i class= \"bi bi-check-lg\" style=\"color:green;font-size:30px;\"></i>";

                                        }



                                        ?></th>

                                    <th>

                                        <?php



                                        if ($basvurugoster['sistemyetki'] == 1) {

                                            echo "Admin";

                                        } elseif ($basvurugoster['sistemyetki'] == 2) {

                                            echo "Öğretmen";

                                        } else {

                                            echo "Henüz Güncelleme Yapılmadı";

                                        }

                                        ?>

                                    </th>



                                    <th>

                                        <a data-toggle="modal" data-target="#ogrencistajsilme<?php echo $basvurugoster['id']; ?>"><b class="btn btn-danger"><i class="bi bi-trash3-fill text-white"> SİL </i></b></a>



                                        <b class="nav-link float-end" style="color:green;" data-toggle="modal" data-target="#ogrencionaylama<?php echo $basvurugoster['id']; ?>"><b class="btn btn-primary">İncele</b></b>

                                    </th>





                                </tr>

                            <?php }

                            ?>



                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>





    
    
<!-- ogrenci Staj bilgileri silme başlangıç -->







<?php

$ogrencibasvurulari = $baglanti->query("SELECT unibolum.bolumAd,stajtarihekleme.stajEvrakBitis,stajtarihekleme.kayitacmaTarih,stajbilgileri.id,stajbilgileri.StajtcKimlik,stajbilgileri.stajAdSoyad,stajbilgileri.stajbolum,stajbilgileri.StajogrNo,stajbilgileri.StajTarihYil,stajbilgileri.stajİl,stajbilgileri.stajİlce,stajbilgileri.stajSinif,stajbilgileri.stajBabaAd,stajbilgileri.stajAnneAd,stajbilgileri.stajDogumTarih,stajbilgileri.stajEmail,stajbilgileri.stajTel,stajbilgileri.sskStajNo,stajbilgileri.sskStajDurum,stajbilgileri.stajİsyeriAd,stajbilgileri.stajAdress,stajbilgileri.stajKurum,stajbilgileri.stajCalisanSayisi,stajbilgileri.stajdurumOnay,iller.il_isim,ilceler.ilce_isim,kullanicilar.kFoto

 FROM

 stajtarihekleme,stajbilgileri,ogretmenbilgi,iller,ilceler,unibolum,kullanicilar

 WHERE

  stajbilgileri.stajİl=iller.il_no AND stajbilgileri.stajİlce=ilceler.ilce_no AND 

  stajbilgileri.stajbolum=unibolum.idbolum and stajbilgileri.kullaniciid=kullanicilar.kullaniciid");

$basvurucek = $ogrencibasvurulari->fetchAll(PDO::FETCH_ASSOC);





foreach ($basvurucek as $id) { ?>

    <!-- Modal Öğrenci Onaylama Liste Başlangış-->

    <div class="modal fade " id="ogrencistajsilme<?php echo $id['id'] ?>">







        <div class="modal-dialog  " style="   width: 90%;

      max-width: 90%;

      height: 90%;

      margin: auto;">

            <div class="modal-content  ">



                <div class="card mb-4">

                    <div class="card-header">

                        <i class="bi bi-person me-1"></i>

                        Öğrenci Başvuru Silme

                        <!-- Modal Başlık -->

                        <button type="button" class="close btn btn-danger float-end" data-dismiss="modal">&times;</button>



                    </div>



                    <div class="card-body  ">

                        <div class="tablo" style="border: 2px solid black; width: 100%; height:auto;">



                            <br>

                            <br>





                            <div id="iki float-start" style=" position:relative; height:120px;">

                                <img src="assets/img/tabloLogo.png" style="position: absolute; left: 1%; top: -45px;" alt="resim">

                            </div>





                            <div id="baslık" style="text-align: center;  margin-top: -125px;">

                                <b>T.C</b> <br>

                                AĞRI İBRAHİM ÇEÇEN ÜNİVERSİTESİ

                                <p>Patnos Meslek Yüksekokulu Müdürlüğü</p>

                                <h4>ZORUNLU STAJ FORMU</h4>

                            </div>





                            <div id="iki float-end" style=" position:relative; ">

                                <?php

                                $resim = $id['kFoto'];

                                if ($resim == 0) {

                                    echo '<img src="assets/img/user.png" width="170" height="233" style="position: absolute; right: 1%; top: -165px;" alt="resim">';
                                } else {



                                    echo '<img src="assets/ogrencifoto/' . $resim . '" width="170" height="233" style="position: absolute; right: 1%; top: -165px;" alt="resim">';
                                }



                                ?>



                            </div>





                            <br>

                            <br>



                            <br>



                            <table border="2" align="center">

                                <tr>

                                    <td colspan="15" width="752">

                                        <h5 class="text-center mb-3">ÖĞRENCİYE AİT BİLGİLER (Tüm alanları eksiksiz

                                            doldurunuz)</h5>

                                    </td>

                                </tr>

                                <tr>

                                    <td width="10%"> T.C Kimlik No :</td>

                                    <td colspan="6" width="10%"><?= $id['StajtcKimlik']; ?></td>





                                    <td width="10%">Baba/Anne Adı :</td>

                                    <td colspan="9" width="10%"><?= $id['stajBabaAd']; ?> & <?= $id['stajAnneAd']; ?> </td>

                                </tr>



                                <tr>

                                    <td>Adı ve Soyadı :</td>

                                    <td colspan="6"><?= $id['stajAdSoyad']; ?></td>





                                    <td>Doğum yeri/Tarih :</td>

                                    <td colspan="6"><?= $id['il_isim']; ?>/ <?= $id['stajDogumTarih']; ?></td>

                                </tr>

                                <tr>

                                    <td>Bölüm/Programı :</td>

                                    <td colspan="6"><?= $id['bolumAd']; ?></td>





                                    <td>Eposta :</td>

                                    <td colspan="5"><?= $id['stajEmail']; ?></td>

                                </tr>

                                <tr>

                                    <td>Öğrenci No :</td>

                                    <td colspan="6"><?= $id['StajogrNo']; ?></td>



                                    <td>Telefon :</td>

                                    <td colspan="6"><?= $id['stajTel']; ?></td>

                                </tr>

                                <tr>

                                    <td>Öğretim yılı :</td>

                                    <td colspan="6"><?= $id['kayitacmaTarih']; ?></td>



                                    <td>SSK NO :</td>

                                    <td colspan="6"><?= $id['sskStajNo']; ?></td>

                                </tr>







                                <td> sağlık güvencesi :</td>

                                <?php

                                if ($id['sskStajDurum'] == 0) {

                                    echo " <td colspan=\"6\"> <input type=\"checkbox\" checked   style=\"text-color:blue;\">Sağlık güvencem Yok</td>";

                                    echo "<td colspan=\"6\"> <input type=\"checkbox\"  DISABLED>Sağlık güvencem Var(Anne-baba)</td>";
                                } else {

                                    echo " <td colspan=\"6\"> <input type=\"checkbox\" DISABLED>Sağlık güvencem Yok</td>";

                                    echo "<td colspan=\"6\"> <input type=\"checkbox\" checked  >Sağlık güvencem Var(Anne-baba)</td>";
                                }



                                ?>





                                <tr>

                                    <td colspan="15" width="752">

                                        <h5 class="text-center mb-3">STAJ YAPILACAK YERE AİT BİLGİLER</h5>

                                    </td>

                                </tr>







                                <tr>

                                    <td>Adı/Unvanı</td>

                                    <td colspan="7"><?= $id['stajİsyeriAd']; ?></td>



                                    <td colspan="6"></td>

                                </tr>





                                <tr>

                                    <td style="height: 100px;">Aders</td>

                                    <td colspan="6"><?= $id['stajAdress']; ?></td>





                                    <td colspan="1" style="width: 10%;">Öğrenci Staj Yaptığı yer :</td>



                                    <?php

                                    if ($id['stajKurum'] == 0) {

                                        echo " <td colspan=\"1\"> <input type=\"checkbox\" checked   style=\"text-color:blue;\">kamu</td>";

                                        echo "<td colspan=\"1\"> <input type=\"checkbox\"  DISABLED>Özel</td>";
                                    } else {

                                        echo " <td colspan=\"1\"> <input type=\"checkbox\" DISABLED>Kamu</td>";

                                        echo "<td colspan=\"1\"> <input type=\"checkbox\" checked  >Özel</td>";
                                    }



                                    ?>



                                    </td>







                                </tr>

                                <tr>

                                    <td colspan="6">Çalışan sayısı

                                        <input type="text" disabled value="<?= $id['stajCalisanSayisi']; ?>">

                                    </td>

                                </tr>

                                <tr>

                                    <td colspan="15" align="center" width="100%">

                                        <h5 class="text-center mb-3">STAJ BAŞLANGIÇ-BİTİŞ TARİHLERİ VE SÜRESİNE AİT BİLGİLER

                                        </h5>

                                    </td>



                                </tr>



                                <tr>



                                    <td>Staj Bitiş Tarihi :</td>

                                    <td><?php

                                        $tarih = $id['stajEvrakBitis'];

                                        $phpdate = strtotime($tarih);

                                        echo $mysqldate = date('d-m-Y', $phpdate);

                                        ?></td>

                                    <td>Staj Süresi :</td>

                                    <td>40 iş günü</td>

                                </tr>







                            </table>





                            <div class="row col-6 " style="margin: auto; padding:10px;">

                                <button type="submit" class="btn btn-danger my-1 ">

                                    <a href="islem?id=<?= $id['id'] ?>&islem=stajbasvurusil" style="text-decoration: none;"><i class="bi bi-trash3-fill text-white"> ÖĞRENCİ SİL </i> </a></button>





                            </div>

                        </div>



                    </div>

                </div>







            </div>

        </div>

    </div>



    <!-- Modal Öğrenci Onaylama Liste Bitiş-->



<?php } ?>















<!-- ogrenci Staj bilgileri silme bitiş -->




<?php

$ogrencibasvurulari = $baglanti->query("SELECT unibolum.bolumAd,stajtarihekleme.stajEvrakBitis,stajtarihekleme.kayitacmaTarih,stajbilgileri.id,stajbilgileri.StajtcKimlik,stajbilgileri.stajAdSoyad,stajbilgileri.stajbolum,stajbilgileri.StajogrNo,stajbilgileri.StajTarihYil,stajbilgileri.stajİl,stajbilgileri.stajİlce,stajbilgileri.stajSinif,stajbilgileri.stajBabaAd,stajbilgileri.stajAnneAd,stajbilgileri.stajDogumTarih,stajbilgileri.stajEmail,stajbilgileri.stajTel,stajbilgileri.sskStajNo,stajbilgileri.sskStajDurum,stajbilgileri.stajİsyeriAd,stajbilgileri.stajAdress,stajbilgileri.stajKurum,stajbilgileri.stajCalisanSayisi,stajbilgileri.stajdurumOnay,iller.il_isim,ilceler.ilce_isim,kullanicilar.kFoto

 FROM

 stajtarihekleme,stajbilgileri,ogretmenbilgi,iller,ilceler,unibolum,kullanicilar

 WHERE

  stajbilgileri.stajİl=iller.il_no AND stajbilgileri.stajİlce=ilceler.ilce_no AND 

  stajbilgileri.stajbolum=unibolum.idbolum and stajbilgileri.kullaniciid=kullanicilar.kullaniciid");

$basvurucek = $ogrencibasvurulari->fetchAll(PDO::FETCH_ASSOC);





foreach ($basvurucek as $id) { ?>

    <!-- Modal Öğrenci Onaylama Liste Başlangış-->

    <div class="modal fade " id="ogrencionaylama<?php echo $id['id'] ?>">







        <div class="modal-dialog  " style="   width: 90%;

      max-width: 90%;

      height: 90%;

      margin: auto;">

            <div class="modal-content  ">



                <div class="card mb-4">

                    <div class="card-header">

                        <i class="bi bi-person me-1"></i>

                        Öğrenci Başvuru Onaylama

                        <!-- Modal Başlık -->

                        <button type="button" class="close btn btn-danger float-end" data-dismiss="modal">&times;</button>



                    </div>



                    <div class="card-body  ">

                        <div class="tablo" style="border: 2px solid black; width: 100%; height:auto;">



                            <br>

                            <br>





                            <div id="iki float-start" style=" position:relative; height:120px;">

                                <img src="assets/img/tabloLogo.png" style="position: absolute; left: 1%; top: -45px;" alt="resim">

                            </div>





                            <div id="baslık" style="text-align: center;  margin-top: -125px;">

                                <b>T.C</b> <br>

                                AĞRI İBRAHİM ÇEÇEN ÜNİVERSİTESİ

                                <p>Patnos Meslek Yüksekokulu Müdürlüğü</p>

                                <h4>ZORUNLU STAJ FORMU</h4>

                            </div>





                            <div id="iki float-end" style=" position:relative; ">

                                <?php

                                $resim = $id['kFoto'];

                                if ($resim == 0) {

                                    echo '<img src="assets/img/user.png" width="10" height="10" style="position: absolute; right: 1%; top: -201px;

                  height: 287px;" alt="resim">';
                                } else {



                                    echo '<img src="assets/ogrencifoto/' . $resim . '" width="170" height="233" style="position: absolute; right: 1%;top: -174px;

                  height: 239px;" alt="resim">';
                                }



                                ?>



                            </div>





                            <br>

                            <br>



                            <br>



                            <table border="2" align="center">

                                <tr>

                                    <td colspan="15" width="752">

                                        <h5 class="text-center mb-3">ÖĞRENCİYE AİT BİLGİLER (Tüm alanları eksiksiz

                                            doldurunuz)</h5>

                                    </td>

                                </tr>

                                <tr>

                                    <td width="10%"> T.C Kimlik No :</td>

                                    <td colspan="6" width="10%"><?= $id['StajtcKimlik']; ?></td>





                                    <td width="10%">Baba/Anne Adı :</td>

                                    <td colspan="9" width="10%"><?= $id['stajBabaAd']; ?> & <?= $id['stajAnneAd']; ?> </td>

                                </tr>



                                <tr>

                                    <td>Adı ve Soyadı :</td>

                                    <td colspan="6"><?= $id['stajAdSoyad']; ?></td>





                                    <td>Doğum yeri/Tarih :</td>

                                    <td colspan="6"><?= $id['il_isim']; ?>/ <?= $id['stajDogumTarih']; ?></td>

                                </tr>

                                <tr>

                                    <td>Bölüm/Programı :</td>

                                    <td colspan="6"><?= $id['bolumAd']; ?></td>





                                    <td>Eposta :</td>

                                    <td colspan="5"><?= $id['stajEmail']; ?></td>

                                </tr>

                                <tr>

                                    <td>Öğrenci No :</td>

                                    <td colspan="6"><?= $id['StajogrNo']; ?></td>



                                    <td>Telefon :</td>

                                    <td colspan="6"><?= $id['stajTel']; ?></td>

                                </tr>

                                <tr>

                                    <td>Öğretim yılı :</td>

                                    <td colspan="6"><?= $id['kayitacmaTarih']; ?></td>



                                    <td>SSK NO :</td>

                                    <td colspan="6"><?= $id['sskStajNo']; ?></td>

                                </tr>







                                <td> sağlık güvencesi :</td>

                                <?php

                                if ($id['sskStajDurum'] == 0) {

                                    echo " <td colspan=\"6\"> <input type=\"checkbox\" checked   style=\"text-color:blue;\">Sağlık güvencem Yok</td>";

                                    echo "<td colspan=\"6\"> <input type=\"checkbox\"  DISABLED>Sağlık güvencem Var(Anne-baba)</td>";
                                } else {

                                    echo " <td colspan=\"6\"> <input type=\"checkbox\" DISABLED>Sağlık güvencem Yok</td>";

                                    echo "<td colspan=\"6\"> <input type=\"checkbox\" checked  >Sağlık güvencem Var(Anne-baba)</td>";
                                }



                                ?>





                                <tr>

                                    <td colspan="15" width="752">

                                        <h5 class="text-center mb-3">STAJ YAPILACAK YERE AİT BİLGİLER</h5>

                                    </td>

                                </tr>







                                <tr>

                                    <td>Adı/Unvanı</td>

                                    <td colspan="7"><?= $id['stajİsyeriAd']; ?></td>



                                    <td colspan="6"></td>

                                </tr>





                                <tr>

                                    <td style="height: 100px;">Aders</td>

                                    <td colspan="6"><?= $id['stajAdress']; ?></td>





                                    <td colspan="1" style="width: 10%;">Öğrenci Staj Yaptığı yer :</td>



                                    <?php

                                    if ($id['stajKurum'] == 0) {

                                        echo " <td colspan=\"1\"> <input type=\"checkbox\" checked   style=\"text-color:blue;\">kamu</td>";

                                        echo "<td colspan=\"1\"> <input type=\"checkbox\"  DISABLED>Özel</td>";
                                    } else {

                                        echo " <td colspan=\"1\"> <input type=\"checkbox\" DISABLED>Kamu</td>";

                                        echo "<td colspan=\"1\"> <input type=\"checkbox\" checked  >Özel</td>";
                                    }



                                    ?>



                                    </td>







                                </tr>

                                <tr>

                                    <td colspan="6">Çalışan sayısı

                                        <input type="text" disabled value="<?= $id['stajCalisanSayisi']; ?>">

                                    </td>

                                </tr>

                                <tr>

                                    <td colspan="15" align="center" width="100%">

                                        <h5 class="text-center mb-3">STAJ BAŞLANGIÇ-BİTİŞ TARİHLERİ VE SÜRESİNE AİT BİLGİLER

                                        </h5>

                                    </td>



                                </tr>



                                <tr>



                                    <td>Staj Bitiş Tarihi :</td>

                                    <td><?php

                                        $tarih = $id['stajEvrakBitis'];

                                        $phpdate = strtotime($tarih);

                                        echo $mysqldate = date('d-m-Y', $phpdate);

                                        ?></td>

                                    <td>Staj Süresi :</td>

                                    <td>40 iş günü</td>

                                </tr>







                            </table>





                            <div class="row col-1 " style="margin: auto; padding:10px;">

                                <button type="submit" class="btn btn-success my-1 "><a href="islem?id=<?php echo $id['id']; ?>&islem=stajonay" style="text-decoration: none; color:white;">Onayla</a></button>



                                <?php

                                if ($id['stajdurumOnay'] != 0) { ?>

                                    <button type="submit" class="btn btn-danger "><a href="islem?id=<?php echo $id['id']; ?>&islem=stajonayiptal" style="text-decoration: none; color:white;">PASİF ET</a></button>

                                <?php }

                                ?>

                            </div>

                        </div>



                    </div>

                </div>







            </div>

        </div>

    </div>



    <!-- Modal Öğrenci Onaylama Liste Bitiş-->



<?php } ?>


<?php include 'inc/footer.php'; ?>
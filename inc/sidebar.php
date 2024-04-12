<?php



include("db/db.php");



?>



<div id="layoutSidenav">

    <div id="layoutSidenav_nav">

        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

            <div class="sb-sidenav-menu">

                <div class=" text-center ">

                    <?php

                    $resim = $kullanicicek['kFoto'];

                    if ($resim == 0 or $resim == null) {

                        echo '<img class="foto" src="assets/img/user.png" alt=""><br><br>

                        <a class="navbar-brand " href="anasayfa">';

                    } else {

                        if ($_SESSION['yetki'] == "1") {

                            echo ' <img class="foto" src="assets/adminfoto/' . $resim . '" alt=""><br><br>

                                <a class="navbar-brand " href="anasayfa">';

                        } elseif ($_SESSION['yetki'] == "2") {

                            echo '<img class="foto" src="assets/ogretmenfoto/' . $resim . '" alt=""><br><br>

                                    <a class="navbar-brand " href="anasayfa">';

                        } elseif ($_SESSION['yetki'] == "3") {

                            echo '<img class="foto" src="assets/ogrencifoto/' . $resim . '" alt=""><br><br>

                                        <a class="navbar-brand " href="anasayfa">';

                        } else {

                            echo " <script>

                                      Swal.fire( {

                                        title:'Başarısız',

                                         text:' BÖYLE BİR YETKİ YOK !!!',

                                          icon:'success',

                                          confirmButtonText:'Tamam' 

                                        })</script>";

                        }

                    }

                    echo $kullanicicek['gorevAd'];

                    ?>





                </div>



                <?php





                if ($_SESSION['yetki'] == "1") { ?>

                    <div class="nav">

                        <div class="sb-sidenav-menu-heading text-white"><?=$kullanicicek['gorevAd'];?> Yetkili İşlemler</div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#adminislem" aria-expanded="false" aria-controls="adminislem">

                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>

                            <b class="<?php if ($menu == "Anasayfa" or$menu == "bolum" or $menu == "bolum" or $menu == "ogretmen" or $menu == "ogrenci" or $menu == "staj" or $menu == "StajDefter" or $menu == "sifre")

                                            echo "text-white";

                                        ?>"> STAJ iŞLEMLERİ</b>

                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

                        </a>

                        <div class="collapse <?php

                        if ($menu == "bolum"  or $menu == "ogretmen" or $menu == "ogrenci" or $menu == "staj" or $menu == "StajDefter" or $menu == "sifre" or $menu == "adminbilgi")

                                                    echo "show";

                                                ?>" id="adminislem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link <?php if ($menu == "bolum")

                                                        echo "active";

                                                    ?>" href="bolum-ekle">Bölüm ekle</a>

                                <a class="nav-link <?php if ($menu == "ogretmen")

                                                        echo "active";

                                                    ?>" href="ogretmen-ekle">Öğretmen Ekleme</a>

                                <a class="nav-link <?php if ($menu == "ogrenci")

                                                        echo "active";

                                                    ?>" href="ogrenci-ekle">Öğrenci Ekleme</a>

                                <a class="nav-link <?php if ($menu == "staj")

                                                        echo "active";

                                                    ?>" href="staj-durumlari">Staj durumları</a>

                                <a class="nav-link <?php if ($menu == "StajDefter")

                                                        echo "active";

                                                    ?>" href="staj-defter-durumlari">Staj Defter</a>

                                <a class="nav-link <?php if ($menu == "sifre")

                                                        echo "active";

                                                    ?>" href="butunkullanicilar-sifre">Şifre İşlemleri</a>

                                <a class="nav-link <?php if ($menu == "adminbilgi")

                                                        echo "active";

                                                    ?>" href="adminbilgi">Admin Bilgi Düzenleme</a>





                            </nav>

                        </div>



                       



                    </div>

                <?php } else if ($_SESSION['yetki'] == "2") { ?>



                    <div class="nav">



                        <div class="sb-sidenav-menu-heading text-white"><?=$kullanicicek['gorevAd'];?> STAJ İŞLEMLERİ</div>
                        <a class="nav-link" href="assets/Öğretmen-Kılavuz.pdf" target="_blank">Öğretmen Kılavuz</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ogretmenislem" aria-expanded="false" aria-controls="ogretmenislem">
                       
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>

                            STAJ iŞLEMLERİ

                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

                        </a>
                        
                        <div class="collapse show" id="ogretmenislem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                            <nav class="sb-sidenav-menu-nested nav">

                            

                                <a class="nav-link <?php if ($menu == "stajTarih")

                                                        echo "active";

                                                    ?>" href="staj-tarih-ekleme">Staj Tarih İşlemleri</a>

                                <?php

                                $ce = $kullanicicek['ogretmenid'];

                                $cekil = $baglanti->prepare("SELECT ogretmenbilgi.ogretmenDanismanDurum FROM kullanicilar,ogretmenbilgi WHERE kullanicilar.ogretmenid=ogretmenbilgi.id and kullanicilar.ogretmenid='$ce' ");

                                $cekil->execute();

                                $ilcekil = $cekil->fetch();

                                $sinifcek = $ilcekil['ogretmenDanismanDurum'];

                                $bolum = $kullanicicek['bolum'];

                                $yil = date("Y");



                                $kontrol = $baglanti->query("SELECT stajBolumAd , stajTarihYil,stajSinif FROM `unibolum`,stajtarihekleme,kullanicilar WHERE stajtarihekleme.stajBolumAd=unibolum.bolumid and unibolum.bolumid=kullanicilar.bolum and stajtarihekleme.stajTarihYil='$yil'  and kullanicilar.bolum='$bolum' and stajtarihekleme.stajSinif='$sinifcek'");

                                $kontrol->fetch();

                                $say = $kontrol->rowCount();







                                if ($say > 0) { ?>



                                    <a class="nav-link <?php if ($menu == "stajOnay")

                                                            echo "active";

                                                        ?>" href="staj-basvuru-onaylama">Staj Başvuru Onaylama</a>

                                    <a class="nav-link <?php if ($menu == "stajDefterOnay")

                                                            echo "active";

                                                        ?>" href="staj-defter-onaylama">Staj Defteri Durumu</a>



                                <?php  }

                                ?>





                                <a class="nav-link <?php if ($menu == "ogrenciListe")

                                                        echo "active";

                                                    ?>" href="ogrenci-liste">Bölüm Öğrencileri</a>
                                <a class="nav-link <?php if ($menu == "ogretmenProfil")

                                                        echo "active";

                                                    ?>" href="ogretmen-profil">Kişisel Bilgiler</a>
                            



                            </nav>

                        </div>









                    </div>



                <?php } else if ($_SESSION['yetki'] == "3") { ?>



                    <div class="nav">

                        <?php

                        $c = $kullanicicek['kullaniciid'];

                        $cekil = $baglanti->prepare("SELECT ogrencibilgi.ogrenciSinif FROM kullanicilar,ogrencibilgi WHERE kullanicilar.kullaniciid=ogrencibilgi.id and kullanicilar.kullaniciid='$c' ");

                        $cekil->execute();

                        $ilcekil = $cekil->fetch();

                        $sinifcek = $ilcekil['ogrenciSinif'];

                        ?>



                        <div class="sb-sidenav-menu-heading text-white"> <?=$kullanicicek['gorevAd'];?> STAJ İŞLEMLERİ</div>
                        
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ogrenciislem" aria-expanded="false" aria-controls="ogrenciislem">

                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>

                            ÖĞRENCİ iŞLEMLERİ

                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

                        </a>

                        <div class="collapse show" id="ogrenciislem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                            <nav class="sb-sidenav-menu-nested nav">

                                <?php $bolum = $kullanicicek['bolum'];

                                $yil = date("Y");

                                $kontrol = $baglanti->query("SELECT stajtarihekleme.stajBolumAd,stajtarihekleme.stajTarihYil,stajtarihekleme.stajSinif FROM stajtarihekleme,kullanicilar,ogrencibilgi,unibolum WHERE

                                stajtarihekleme.stajBolumAd=unibolum.bolumid and unibolum.bolumid=kullanicilar.bolum 

                               and stajtarihekleme.stajTarihYil=' $yil' and stajtarihekleme.stajSinif=ogrencibilgi.ogrenciSinif and ogrencibilgi.ogrenciSinif='$sinifcek'

                               AND

                                stajtarihekleme.stajBolumAd='$bolum'");

                                $kontrol->fetch();

                                $say = $kontrol->rowCount();



                                if ($say < 0) { ?>





                                    <a class="nav-link <?php if ($menu == "stajBilgiEkleme")

                                                            echo "active";

                                                        ?>" href="ogrenci-staj-bilgi-ekleme">Staj Bilgileri

                                        Ekleme</a>

                                    <a class="nav-link <?php if ($menu == "stajDefteriEkleme")

                                                            echo "active";

                                                        ?>" href="ogrenci-staj-defteri">Staj Defteri Ekleme</a>

                                <?php } elseif ($say > 0) { ?>

                                    <a class="nav-link <?php if ($menu == "stajBilgiEkleme")

                                                            echo "active";

                                                        ?>" href="ogrenci-staj-bilgi-ekleme">Staj Bilgileri

                                        Ekleme</a>

                                    <!-- <a class="nav-link <?php if ($menu == "stajDefteriEkleme")

                                                                echo "disabled";

                                                            ?>" href="ogrenci-staj-defteri">Staj Defteri Ekleme</a> -->

                                    <?php



                                    $id = $kullanicicek['kullaniciid'];

                                    $kontroldurum = $baglanti->query("SELECT stajbilgileri.stajdurumOnay, stajbilgileri.kullaniciid FROM stajbilgileri, kullanicilar WHERE kullanicilar.kullaniciid = stajbilgileri.kullaniciid AND stajbilgileri.kullaniciid = '$id'");

                                    $k = $kontroldurum->fetch();



                                    if ($k) {

                                        if ($k['stajdurumOnay'] == 0) {

                                            $ogrencibilgi = $baglanti->query("SELECT stajdurumOnay FROM stajbilgileri where kullaniciid='$c'")->fetch();

                                            $durum = $ogrencibilgi['stajdurumOnay'];

                                            if ($durum == 0) { ?>



                                                <a class="nav-link disabled <?php if ($menu == "stajDefteriEkleme")

                                                                                echo "active";

                                                                            ?>" href="ogrenci-staj-defteri">Staj

                                                    Defteri Ekleme </a>



                                            <?php } else {

                                                // echo "suan işe yaramıyor ";

                                            }

                                        } else { ?>

                                            <a class="nav-link <?php if ($menu == "stajDefteriEkleme")

                                                                    echo "active";

                                                                ?>" href="ogrenci-staj-defteri">Staj Defteri

                                                Ekleme</a>

                                    <?php }

                                    }



                                    ?>



                                <?php }

                                ?>



                                <a class="nav-link  <?php if ($menu == "ogrenciProfil")

                                                        echo "active";

                                                    ?>" href="ogrenci-profil">Kişisel Bilgiler</a>





                            </nav>

                        </div>



                    </div>







                <?php }        ?>



            </div>



            <div class="sb-sidenav-footer text-center" style=" width:100%; margin: auto; ">

                <a class="nav-link " href="#" aria-expanded="false">



                    <button class="btn btn-danger text-white" data-toggle="modal" data-target="#cikisModal"><i class="bi bi-box-arrow-left "> Çıkış Yap

                        </i>

                    </button>



                </a>



            </div>

        </nav>

    </div>
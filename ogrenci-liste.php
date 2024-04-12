<?php

$title = "Öğrenci Bilgileri";

$menu = "ogrenciListe";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki3kisit.php';



?>







<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa" class="me-2 nav-link">Anasayfa</a> /<li class="breadcrumb-item ms-2 active"><?= $title ?></li>

            </ol>





            <div class="card mb-4">
                <div class="card-header">

                    <i class="fas fa-table me-1"></i>

                    Öğrenci Ekleme Tablosu

                    <div class="float-end my-2"><a href="ogretmen-ogrenciekle" class="nav-link text-white btn btn-primary p-1" style="color:green;">
                            <i class="bi bi-person-plus-fill" style="font-size:20px; "> </i>Öğrenci Ekle</a>
                            <br>
                    <a href="ogrenci-kaydet" class="nav-link text-white btn btn-primary p-1" style="color:green;" > <i class="bi bi-person-plus-fill" style="font-size:20px; "> </i>Çoklu Öğrenci Ekle</a>
                    </div>

                </div>





                <div class="card-body">

                    <?php
 


                    $ogretmenid = $kullanicicek['ogretmenid'];

                    $ogretmenbilgiCek = $baglanti->query("SELECT ogretmenbilgi.ogretmenDanismanDurum,ogretmenbilgi.ogretmenBolumAd FROM `kullanicilar`,ogretmenbilgi WHERE kullanicilar.ogretmenid=ogretmenbilgi.id AND ogretmenbilgi.id='$ogretmenid' ")->fetch();

                    $sinifnumara = $ogretmenbilgiCek['ogretmenDanismanDurum'];

                    $sinifBolum = $ogretmenbilgiCek['ogretmenBolumAd'];



                    $ogrencibasvurulari = $baglanti->query("SELECT ogrencibilgi.id,ogrencibilgi.ogrenciTc,ogrencibilgi.ogrenciAdsoyad,ogrencibilgi.ogrenciOgrNo,unibolum.bolumAd,ogrencibilgi.ogrenciSinif,ogrencibilgi.il,ogrencibilgi.ogrencidate
                    FROM
                     unibolum, ogrencibilgi,ogretmenbilgi
                     WHERE
                    ogrencibilgi.ogrenciSinif=ogretmenbilgi.ogretmenDanismanDurum and ogrencibilgi.ogrenciBolum=ogretmenbilgi.ogretmenBolumAd and
                    ogrencibilgi.ogrenciBolum=unibolum.bolumid and ogretmenbilgi.ogretmenDanismanDurum='$sinifnumara' 
                    and ogretmenbilgi.ogretmenBolumAd='$sinifBolum' and unibolum.bolumid = '$sinifBolum' ");

                    $basvurucek = $ogrencibasvurulari->fetchAll(PDO::FETCH_ASSOC);

                    ?>

                    <table id="ogrenci-bolum-listele" class="table table-striped">

                        <thead>

                            <tr class="text-center">



                                <th>#</th>

                                <th>Tc Kimlik</th>

                                <th>Ad Soyad</th>

                                <th>Öğrenci No</th>

                                <th>Öğrenci Bolum</th>

                                <th>Öğrenci Sınıf</th>

                                <th>Öğrenci Kayıt Yılı </th>
                                <th> </th>





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

                                    <th><?= $basvurugoster['ogrenciTc']; ?></th>

                                    <th><?= $basvurugoster['ogrenciAdsoyad']; ?></th>

                                    <th><?= $basvurugoster['ogrenciOgrNo']; ?></th>
                                    <th><?= $basvurugoster['bolumAd']; ?></th>
                                    <th><?= $basvurugoster['ogrenciSinif']; ?> Sınıf</th>
                                    <th><?= $basvurugoster['ogrencidate']; ?></th>

                                    <th>





                                        <b class="nav-link" style="color:green;">
                                            <b class="btn btn-success "><a class="text-white" style="text-decoration: none;"  href="ogretmen-ogrenciguncelle?id=<?php echo $basvurugoster['id']; ?>">Bilgi Güncelle</a>
                                            </b>
                                            <b class="btn btn-dark "><a class="text-white" style="text-decoration: none;"  href="ogretmen-ogrencisifre?id=<?php echo $basvurugoster['id']; ?>">Şifre Değiştir</a>
                                            </b>

                                        </b>


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




    <?php include 'inc/footer.php'; ?>

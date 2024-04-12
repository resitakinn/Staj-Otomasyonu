<?php

$title = "Staj Defter Onaylama";

$menu = "stajDefterOnay";

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

                <b class="bg-danger text-white text-center p-4">UYARI : <i>

                        Eğer Öğrenci Staj defterini Yüklediyse ve sistemde kaydı silinmişse Defteri sistemden silin aksi

                        takdirde sisteme girişi olamaz !!!

                    </i></b>

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



                <?php



                if (isset($_SESSION['stajdefterok'])) {

                    if ($_SESSION['stajdefterok'] == "ok") {

                        echo "<script>

Swal.fire({

position: 'center',

title: 'BAŞARILI BİR ŞEKİLDE ONAYLANDI',

html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

icon: 'success',

showConfirmButton: false,

timer: 2000

})

</script>";

                        unset($_SESSION['stajdefterok']);

                        header("Refresh:2");

                    }

                }

                if (isset($_SESSION['stajdefteronayiptal'])) {

                    if ($_SESSION['stajdefteronayiptal'] == "no") {

                        echo "<script>

    Swal.fire({

        position: 'center',

        title: 'BAŞARILI BİR ŞEKİLDE ONAY DURUMU PASİF EDİLDİ',

        html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

        icon: 'success',

        showConfirmButton: false,

        timer: 2000

    })

</script>";

                        unset($_SESSION['stajdefteronayiptal']);

                        header("Refresh:2");

                    }

                }

                if (isset($_SESSION['stajDefterDelete'])) {

                    if ($_SESSION['stajDefterDelete'] == "ok") {

                        echo "<script>

        Swal.fire({

            position: 'center',

            title: 'BAŞARILI BİR ŞEKİLDE SİLİNDİ',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

            icon: 'success',

            showConfirmButton: false,

            timer: 2000

        })

    </script>";

                        unset($_SESSION['stajDefterDelete']);

                        header("Refresh:2");

                    } elseif ($_SESSION['stajDefterDelete'] == "no") {

                        echo "<script>

        Swal.fire({

            position: 'center',

            title: 'BAŞARISIZ DEFTER SİLİNMEDİ',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

            icon: 'success',

            showConfirmButton: false,

            timer: 2000

        })

    </script>";

                        unset($_SESSION['stajdefteronayiptal']);

                        header("Refresh:2");

                    }

                }





                ?>







                <div class="card-body">



                    <?php



                    $ogrtmenİd = $kullanicicek['ogretmenid'];

                    $ogretmenBilgi = $baglanti->prepare("SELECT ogretmenbilgi.ogretmenDanismanDurum,ogretmenbilgi.ogretmenBolumAd,ogretmenbilgi.id

                FROM

                ogretmenbilgi 

                WHERE

                ogretmenbilgi.id='$ogrtmenİd'");

                    $ogretmenBilgi->execute();

                    $cekogretmenBilgi = $ogretmenBilgi->fetch();



                    $ogretmenSinif =  $cekogretmenBilgi['ogretmenDanismanDurum'];

                    $ogretmenBolum =  $cekogretmenBilgi['ogretmenBolumAd'];

                    $ogretmenİd    =  $cekogretmenBilgi['id'];



                    $stajDefter = $baglanti->prepare("SELECT stajdefter.defterid,

                stajdefter.yil,

                stajdefter.ogrNumara,

                stajdefter.ogrdefter,

                stajdefter.ogrBolum,

                stajdefter.ogrSinif,

                stajdefter.ogrenciİd,

                stajdefter.stajDefterOnay,

                ogrencibilgi.ogrenciAdsoyad,

                ogrencibilgi.aktif

                



                FROM

                `stajdefter`,ogretmenbilgi,ogrencibilgi

                WHERE

                stajdefter.ogrSinif=ogretmenbilgi.ogretmenDanismanDurum

                AND

                stajdefter.ogrBolum=ogretmenbilgi.ogretmenBolumAd

                AND

                ogretmenbilgi.ogretmenDanismanDurum='$ogretmenSinif'

                AND

                ogretmenbilgi.ogretmenBolumAd='$ogretmenBolum'

                AND

                stajdefter.ogrenciİd=ogrencibilgi.id ORDER BY  ogrencibilgi.id asc, ogrencibilgi.id;

                ");

                    $stajDefter->execute();

                    $defterBigiCek = $stajDefter->fetchAll(PDO::FETCH_ASSOC);











                    ?>



                    <table id="stajDefterOnay" class="table table-striped">



                        <thead>

                            <tr class="text-center">



                                <th>S.No</th>

                                <th>#id</th>

                                <th>Yil</th>

                                <th>Ad Soyad</th>

                                <th>Öğrenci No</th>

                                <th>Defter Onay Durumu</th>

                                <th>Defter İndir</th>

                                <th>ÖĞRENCİ SİSTEM KAYDI <BR> SİLİK & DONUK VEYA AKTİF DURUMU </th>



                                <th>

                                    <input type="text" name="" id="" class="form-control text-center" disabled placeholder="İşlemler">

                                </th>



                            </tr>

                        </thead>



                        <tbody>

                            <?php

                            $sayi = 0;

                            foreach ($defterBigiCek as $stajBilgiCekDefter) {

                                $sayi = ++$sayi;

                            ?>







                                <tr class="text-center " style="line-height: 35px;">

                                    <th> <?= $sayi ?></th>

                                    <th> <?= $stajBilgiCekDefter['defterid'] ?></th>

                                    <th> <?= $stajBilgiCekDefter['yil'] ?></th>

                                    <th><?= $stajBilgiCekDefter['ogrenciAdsoyad'] ?></th>

                                    <th><?= $stajBilgiCekDefter['ogrNumara'] ?></th>



                                    <td>

                                        <?php



                                        if ($stajBilgiCekDefter['stajDefterOnay'] == 1) {

                                            echo '  <i class="bi bi-check-lg" style="color:green;font-size:30px;"></i>';

                                        } else {



                                            echo '<i class="bi bi-x-lg" style="color:red;font-size:30px;"></i>';

                                        }



                                        ?>



                                    </td>

                                    <td>

                                        <a href="assets/stajdefteri/<?= $stajBilgiCekDefter['ogrdefter'] ?>" class="nav-link float-end" target="_blank" download>

                                            <?php

                                            $stajUzanti = $stajBilgiCekDefter['ogrdefter'];



                                            $ayir = explode(".", $stajUzanti);



                                            if ($ayir[1] == "pdf") {

                                                echo '<b class="btn btn-success"><i class="bi bi-filetype-pdf"style="font-size:20px;"></i> ÖNİZLE</b>';

                                            } elseif ($ayir[1] == "docx") {

                                                echo '<b class="btn btn-success"><i class="bi bi-file-earmark-word" style="font-size:20px;"></i> ÖNİZLE</b>';

                                            } elseif ($ayir[1] == "rtf") {

                                                echo '<b class="btn btn-success"><i class="bi bi-file-earmark-word" style="font-size:20px;"></i> ÖNİZLE</b>';

                                            } else {

                                                echo "uygun format degil";

                                            }



                                            ?>



                                        </a>

                                    </td>

                                    <th>

                                        <?php

                                        if ($stajBilgiCekDefter['aktif'] == 0) {

                                            echo '<button class="btn bg-danger text-white" style="font-weight:bold;">SİSTEM YÖNETİCİSİ TARAFINDAN PASİF</button>';

                                        } elseif ($stajBilgiCekDefter['aktif'] == 1) {

                                            echo '<button class="btn bg-primary text-white" style="font-weight:bold; p-1">DEFTER YÜKLEMESİN' . "'" . 'DEN 24 SONRA SİSTEME TEKRAR GİRİŞ YAPTIĞINDA OTOMATİK PASİF DURUMA GEÇECEKTİR.' . "<br><br>" . '<b style="background-color:red;padding:5px;border-radius:5px;">' . ' ŞUAN DURUMU ( AKTİF )</b>' . '</button>';

                                        } elseif ($stajBilgiCekDefter['aktif'] == 2) {

                                            echo '<button class="btn bg-warning text-dark" style="font-weight:bold;">DEFTER YÜKLEMESİN' . "'" . 'DEN 24 SONRA' . "<br>" . 'SİSTEMDEN OTOMATİK ( SİLİK ) DURUMA GEÇMİŞTİR</button>';

                                        }







                                        ?>

                                    </th>

                                    <th>

                                        <div class="d-flex justify-content-center">

                                            <?php

                                            if ($stajBilgiCekDefter['stajDefterOnay'] == 1) { ?>



                                                <a href="islem.php?id=<?= $stajBilgiCekDefter['defterid'] ?>&islem=defteronaylaiptal" class="nav-link float-end">

                                                    <b class="btn btn-warning">ONAYI PASİF ET</b>



                                                </a>

                                            <?php } else { ?>



                                                <a href="islem.php?id=<?= $stajBilgiCekDefter['defterid'] ?>&islem=defteronayla" class="nav-link float-end">

                                                    <b class="btn btn-primary"><i class="bi bi-book-half"></i> ONAYLA</b>

                                                </a>

                                            <?php   }

                                            ?>

                                            <button type="submit" class="btn btn-danger mx-5" data-toggle="modal" data-target="#deftersil<?= $stajBilgiCekDefter['defterid'] ?>" <i class="bi bi-book-half"></i> DEFTER SİL</button>

                                        </div>







                                    </th>



                                </tr>

                            <?php  }



                            ?>





                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>


<!-- öğrenci Staj defter Silme başlangıç -->



<?php



$cek = $baglanti->query("SELECT * FROM stajdefter");

$ogrencicek = $cek->fetchAll(PDO::FETCH_ASSOC);



foreach ($ogrencicek as $cekogr) { ?>

    <!-- Modal -->

    <div class="modal fade" id="deftersil<?= $cekogr['defterid'] ?>" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Staj Defter </h5>



                </div>

                <div class="modal-body">



                    <h4>Staj Defteri Silmek İstediniz Bu İşlem Geri Alınamaz!!!</h4>





                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                    <button type="button" class="btn btn-danger"><a href="islem?id=<?php echo $cekogr['defterid']; ?>&islem=defterSil" class="text-white" style="text-decoration: none;">SİL</a></button>

                </div>

            </div>

        </div>

    </div>

<?php } ?>


<!-- öğrenci Staj defter Silme bitiş -->


    <?php include 'inc/footer.php'; ?>
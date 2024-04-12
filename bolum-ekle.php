<?php

$title = "Bölüm Ekleme Listesi";

$menu = "bolum";

include 'inc/head.php';

ob_start();

include 'inc/sidebar.php';

include 'yetki/yetki1kisit.php';



?>



<?php



if (isset($_SESSION['bolum_delete'])) {

    if ($_SESSION['bolum_delete'] == "ok") {

        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'BÖLÜM SİLİNDİ !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

        unset($_SESSION['bolum_delete']);

        header("Refresh:2;");
    } elseif ($_SESSION['bolum_delete'] == "no") {

        echo " <script> 

        Swal.fire( {

            title:'BAŞARISIZ',

            text:'BÖLÜM SİLİNMEDİ !!!',

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
                    Bölüm Ekleme</li>

            </ol>





            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table me-1"></i>

                    STAJ

                    <div class="float-end my-2"><a href="#" class="nav-link" style="color:green;" data-toggle="modal" data-target="#bolumEkleModal">Bölüm Ekle</a></div>

                    <i class="bi bi-plus float-end me-2 " style="font-size:25px; color:green;"> </i>



                </div>



                <div class="card-body">

                    <table id="myTable" class="table table-striped">

                        <thead>

                            <tr class="text-center">



                                <th>Sıra</th>

                                <th>Bölümid</th>

                                <th>Bölümler</th>

                                <th>Öğretmen Liste</th>

                                <th>Durum</th>

                                <th>İşlemler</th>



                            </tr>

                        </thead>



                        <tbody>

                            <?php



                            $cek = $baglanti->query("SELECT * FROM unibolum");

                            $bolumcek = $cek->fetchAll(PDO::FETCH_ASSOC);

                            $sayi = 0;

                            foreach ($bolumcek as $bolumgoster) {

                                $sayi = ++$sayi; ?>



                                <tr class="text-center " style="line-height: 35px;">

                                    <th><?= $sayi ?></th>

                                    <th><?= $bolumgoster['bolumid'] ?></th>

                                    <th><?= $bolumgoster['bolumAd'] ?></th>



                                    <th><button class="btn btn-success" data-toggle="modal" data-target="#ogretmenListe<?php echo $bolumgoster['bolumid'] ?>"><i class="bi bi-card-list"></i> Öğretmen Listesi</button></th>

                                    <th>

                                        <?php

                                        if ($bolumgoster['bolumDurum'] == '1') { ?>

                                            <button class="btn btn-success "><i class="bi bi-check-lg"></i></button>

                                        <?php } else { ?>

                                            <button class="btn btn-danger "><i class="bi bi-x-lg"></i></button>

                                        <?php   }



                                        ?>



                                    </th>

                                    <th>



                                        <a><button class="btn btn-primary me-2 " data-toggle="modal" data-target="#bolumDuzenleModal<?= $bolumgoster['idbolum'] ?>"><i class="fa fa-edit"></i> Bölüm Düzenleme</button></a>

                                        <?php

                                        if ($bolumgoster['bolumDurum'] == '1') { ?>

                                            <a href="islem.php?id=<?php echo $bolumgoster['idbolum']; ?>&islem=BolumdurumPasif"><button class="btn btn-warning me-2 "><i class="bi bi-x-lg"></i> PASİF ET
                                                </button></a>

                                        <?php } else { ?>

                                            <a href="islem.php?id=<?php echo $bolumgoster['idbolum']; ?>&islem=BolumdurumAktif"><button class="btn btn-success me-2 "><i class="fa fa-edit"></i> AKTİF
                                                    ET</button></a>

                                        <?php   }



                                        ?>



                                        <a href="islem.php?id=<?php echo $bolumgoster['idbolum']; ?>&islem=BolumSil"><button class="btn btn-danger" me-2> <i class="bi bi-trash3-fill text-white me-2"></i>Bölüm Silme</button></a>


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
    <!-- Modal Bölüm ekleme Başlangıç-->



    <div class="modal fade" id="bolumEkleModal">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Başlık -->

                <div class="modal-header">

                    <h4 class="modal-title">Bölüm Ekle</h4>

                    <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>

                </div>



                <!-- Modal İçerik -->

                <div class="modal-body">

                    <p class="bg-danger text-white p-1">Bolum Numara Sekmesinden En Son Numarayı Takip Ediniz Ve Ona
                        Göre

                        Bölüm Kaydet Bölümüne Yeni Değeri Atayınız </p>

                    <form action="" method="POST">

                        <div class="form-group mb-3">

                            <b> Bölüm Numara: </b>

                            <select class="form-control">

                                <?php



                                $cek = $baglanti->query("SELECT * FROM unibolum  ORDER BY `unibolum`.`bolumid` ASC");

                                $bolumcek = $cek->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($bolumcek as $bolumgoster) { ?>

                                    <option>

                                        <?php echo $bolumgoster['bolumAd'] . ' = ' . $bolumgoster['bolumid'] ?></option>

                                <?php }



                                ?>





                            </select>

                        </div>



                        <div class="form-group mb-3">

                            <b>Bölüm Ad:</b>

                            <input type="text" class="form-control" name="bolumAd" value="<?php echo @$_POST['bolumAd'] ?>">

                        </div>

                        <div class="form-group mb-3">

                            <b>Bölüm Numara Kaydet :</b>

                            <input type="text" class="form-control" name="bolumid" value="<?php



                                                                                            $say = $bolumgoster['bolumid'];

                                                                                            echo $sayi = ++$say;



                                                                                            ?>">



                        </div>

                        <button type="submit" class="btn btn-primary float-end" name="bolumKaydet">Kaydet</button>

                    </form>

                </div>

                <?php



                if (isset($_POST['bolumKaydet'])) {

                    $bolumAd  = htmlspecialchars(trim($_POST['bolumAd']));

                    $bolumid  = htmlspecialchars(trim($_POST['bolumid']));

                    if (!$bolumAd || !$bolumid) {

                        echo " <script>  Swal.fire( {title:'HATA', text:'Boş Alan Bırakmayınız !!!', icon:'error',confirmButtonText:'Tamam' })</script>";

                        header("Refresh:2;url=bolum-ekle");
                    } elseif ($bolumid > $sayi) {



                        echo " <script>  Swal.fire( {title:'HATA', text:'Bolum Numara Sekmesinden En  Son Numarayı Takip Ediniz Ve Ona Göre Bölüm Kaydet Bölümüne Yeni Değeri Atayınız !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
                    } elseif ($baglanti->query("SELECT * FROM unibolum  where   bolumid = '$bolumid' ")->fetch()) {

                        echo " <script>  Swal.fire( {title:'HATA', text:'SİSTEMDE KAYITLI AYNI BÖLÜM SAYISI VAR  !!! = " . $bolumid . " ', icon:'error',confirmButtonText:'Tamam' })</script>";
                    } elseif ($baglanti->query("SELECT * FROM unibolum  where  bolumAd = '$bolumAd' ")->fetch()) {

                        header("Refresh:3;");

                        echo " <script>  Swal.fire( {title:'HATA', text:'SİSTEMDE KAYITLI AYNI BÖLÜM AD VAR !!! = " . $bolumAd . "', icon:'error',confirmButtonText:'Tamam' })</script>";
                    } elseif ($baglanti->query("SELECT * FROM unibolum  where   bolumid = '$bolumid' ")->fetch()) {

                        $time = header("Refresh:5;");

                        echo " <script>

        Swal.fire( {

        title:'HATA', 

        text:'Aynı Bolum Numara  Ataması Var tablodan bölümid sutunundan  guncel son veri takip ediniz !!!',

         icon:'error',

         confirmButtonText:'Tamam' 

        })

        </script>";
                    } else {

                        $sorgu = $baglanti->prepare('INSERT INTO unibolum SET

        

        bolumAd=?,

        bolumid=?         

  

   ');

                        $kaydet = $sorgu->execute([

                            $bolumAd, $bolumid

                        ]);



                        if ($kaydet) {

                            echo " <script>  Swal.fire( {title:'Başarılı', text:'BÖLÜM EKLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";

                            header("Refresh:1;url=bolum-ekle");
                        }
                    }
                }


                ?>

            </div>

        </div>

    </div>

    <!-- Modal Bölüm ekleme Bitiş-->





    <?php



    $cek = $baglanti->query("SELECT * FROM unibolum");

    $bolumcek = $cek->fetchAll(PDO::FETCH_ASSOC);



    foreach ($bolumcek as $bolumgoster) { ?>

        <!-- Modal Bölüm Düzenleme Başlangış-->

        <div class="modal fade" id="bolumDuzenleModal<?php echo $bolumgoster['idbolum'] ?>">

            <div class="modal-dialog">

                <div class="modal-content">



                    <!-- Modal Başlık -->

                    <div class="modal-header">

                        <h4 class="modal-title">Bölüm Güncelleme</h4>

                        <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>

                    </div>



                    <!-- Modal İçerik -->

                    <div class="modal-body">

                        <form action="" method="POST">

                            <div class="form-group mb-3">

                                <b>Bölüm Ad:</b>

                                <input type="text" class="form-control" name="bolumAd" value="<?php echo $bolumgoster['bolumAd'] ?>">

                            </div>

                            <div class="form-group mb-3">

                                <b>Bölüm Numara:</b>

                                <input type="text" class="form-control" name="bolumid" value="<?php echo $bolumgoster['bolumid'] ?>">

                            </div>

                            <button type="submit" class="btn btn-primary float-end" name="bolumGuncelle">Güncelle</button>

                        </form>

                    </div>



                    <!-- Modal Altı

  <div class="modal-footer">

    <button type="button" class="btn btn-danger outline" data-dismiss="modal">Kapat</button>

  </div> -->



                </div>

            </div>

        </div>

    <?php   }



    if (isset($_POST['bolumGuncelle'])) {

        $bolumAd  = htmlspecialchars(trim($_POST['bolumAd']));

        $bolumid  = htmlspecialchars(trim($_POST['bolumid']));

        $id = $bolumgoster['idbolum'];

        if ($baglanti->query("UPDATE unibolum SET bolumAd = '$bolumAd', bolumid =  '$bolumid' WHERE idbolum =" . $id)) {

            echo " <script>  Swal.fire( {title:'Başarılı', text:'BÖLÜM Güncellendi !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



            header("Refresh:2");

            // Eğer güncelleme sorgusu çalıştıysa alinankitap sayfasına yönlendiriyoruz.

        } else {

            echo " <script>  Swal.fire( {title:'Başarısız', text:'BÖLÜM Güncellenmedi !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
        }
    }

    ?>

    <!-- Modal Bölüm Düzenleme Bitiş-->

    <!-- Modal Öğretmen Liste Başlangış-->

    <?php



    $cek = $baglanti->query("SELECT * FROM unibolum");

    $bolumcek = $cek->fetchAll(PDO::FETCH_ASSOC);



    foreach ($bolumcek as $bolumgoster) { ?>



        <div class="modal fade " id="ogretmenListe<?= $bolumgoster['bolumid'] ?>">

            <div class="modal-dialog  " style="width: 90%;

      max-width: 90%;

      height: 90%;

      margin: auto;">

                <div class="modal-content  ">







                    <div class="card mb-4">

                        <div class="card-header">

                            <i class="bi bi-person me-1"></i>

                            Öğretmen Listesi

                            <!-- Modal Başlık -->

                            <button type="button" class="close btn btn-danger float-end" data-dismiss="modal">&times;</button>



                        </div>



                        <div class="card-body  ">

                            <table id="myTable" class="table table-striped  ">

                                <thead>

                                    <tr class="text-center">



                                        <th>#</th>

                                        <th>Ad Soyad</th>

                                        <th>Sicil No</th>

                                        <th>Danışman Durumu</th>

                                        <th>Görevi</th>

                                        <th>#

                                        </th>





                                    </tr>

                                </thead>

                                <?php

                                $listeogretmen = $bolumgoster['bolumid'];

                                $bolumogretmencek = $baglanti->query("SELECT * FROM `ogretmenbilgi`,unibolum WHERE ogretmenbilgi.ogretmenBolumAd=unibolum.bolumid and unibolum.bolumid='$listeogretmen' ");

                                $bolumcekogrtmn = $bolumogretmencek->fetchAll(PDO::FETCH_ASSOC);



                                foreach ($bolumcekogrtmn as $bolumgosterogr) { ?>

                                    <tbody>

                                        <tr class="text-center " style="line-height: 35px;">

                                            <th><?= $bolumgosterogr['id'] ?></th>

                                            <th><?= $bolumgosterogr['ogretmenAdSoyad'] ?></th>

                                            <th><?= $bolumgosterogr['ogretmenSicilNo'] ?></th>

                                            <th><?= $bolumgosterogr['ogretmenDanismanDurum'] ?> Sınıf</th>

                                            <th><?= $bolumgosterogr['ogretmenGorev'] ?></th>

                                            <th><button class="btn  me-2"><a href="ogretmen-guncelle?id=<?php echo $bolumgosterogr['id']; ?>"><i class="fa fa-edit text-success" alt="İşlemler"></i></a></button><button class="btn btn-white me-2"><a href="islem?id=<?php echo $bolumgosterogr['id'] ?>&islem=ogretmenSil"><i class="bi bi-trash3-fill text-danger"></i></a></button></th>

                                        </tr>





                                    </tbody>

                                <?php } ?>

                            </table>



                        </div>



                    </div>









                </div>

            </div>

        </div>

    <?php   } ?>

    <!-- Modal Öğretmen Liste Bitiş-->


    <?php include 'inc/footer.php'; ?>
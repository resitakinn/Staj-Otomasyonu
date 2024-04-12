<?php

$title = "Staj Defter Eklenen Listesi";

$menu = "StajDefter";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki1kisit.php';



?>



<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <h1 class="mt-4"><?= $title ?></h1>

            <ol class="breadcrumb mb-4">

                <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">

                    Öğrenci Staj Durumları</li>



            </ol>

            <b class="bg-danger text-white">Uyarı : </b><b><i>

                    <p>Eğer Öğrenci Staj defterini Yüklediyse ve sistemde kaydı silinmişse öncelikle Ögrenciyi aktif</p>

                    edin ve ardından da defteri sistemden silin aksi takdirde sisteme girişi olamaz !!!

                </i></b>



            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table me-1"></i>

                    Öğrenci Staj Durumları





                </div>



                <?php

                if (isset($_SESSION['defterSil'])) {

                    if ($_SESSION['defterSil'] == "yes") {

                        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'STAJ DEFTERİ SİLİNDİ !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

                        unset($_SESSION['defterSil']);

                        header("Refresh:2;");
                    }
                }

                if (isset($_SESSION['ogrenciAktif'])) {

                    if ($_SESSION['ogrenciAktif'] == "yes") {

                        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'ÖĞRENCİ AKTİF EDİLDİ !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

                        unset($_SESSION['ogrenciAktif']);

                        header("Refresh:2;");
                    }
                }

                if (isset($_SESSION['ogrencisilmekaydı'])) {

                    if ($_SESSION['ogrencisilmekaydı'] == "yes") {

                        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'ÖĞRENCİ KAYDI SİSTEMDEN SİLİNDİ  !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

                        unset($_SESSION['ogrencisilmekaydı']);

                        header("Refresh:2;");
                    }
                }

                if (isset($_SESSION['ogrencipasifkaydı'])) {

                    if ($_SESSION['ogrencipasifkaydı'] == "yes") {

                        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'ÖĞRENCİ KAYDI SİSTEMDEN PASİF DURUMA GEÇTİ  !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

                        unset($_SESSION['ogrencipasifkaydı']);

                        header("Refresh:2;");
                    }
                }

                if (isset($_SESSION['admindefteronay'])) {

                    if ($_SESSION['admindefteronay'] == "yes") {

                        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'STAJ DEFTERİ AKTİF EDİLDİ !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

                        unset($_SESSION['admindefteronay']);

                        header("Refresh:2;");
                    }
                }

                if (isset($_SESSION['admindefteronayiptal'])) {

                    if ($_SESSION['admindefteronayiptal'] == "yes") {

                        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'STAJ DEFTERİ PASİF EDİLDİ !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

                        unset($_SESSION['admindefteronayiptal']);

                        header("Refresh:2;");
                    }
                }





                ?>



                <div class="card-body">

                    <table id="stajDefterDurumlari" class="table table-striped" border="2">

                        <thead>

                            <tr class="text-center">



                                <th>S.No</th>

                                <th> #id</th>

                                <th>Ad Soyad</th>

                                <th>Ogr No</th>

                                <th>Bolum</th>

                                <th>Staj Defter </th>

                                <th>Sınıf</th>

                                <th>Öğretmen</th>

                                <th style="width: 13%;">Onay Durumu</th>

                                <th style="width: 13%;">Öğrenci Sisteme Giriş Durumu</th>

                                <th>

                                    #



                                </th>



                            </tr>

                        </thead>



                        <tbody>

                            <?php



                            $stajcek = $baglanti->prepare("SELECT                              

                            stajdefter.defterid,

                            ogrencibilgi.ogrenciAdsoyad,

                            stajdefter.ogrNumara,

                            unibolum.bolumAd,

                            stajdefter.ogrdefter,

                            stajdefter.ogrSinif,

                            ogretmenbilgi.ogretmenAdSoyad,

                            stajdefter.stajDefterOnay,

                            kullanicilar.aktif,

                            stajdefter.ogrenciİd

                            FROM

                            ogrencibilgi,stajdefter,unibolum,ogretmenbilgi,kullanicilar

                            WHERE

                            stajdefter.ogrenciİd = ogrencibilgi.id and stajdefter.ogrBolum = unibolum.idbolum and  stajdefter.stajOgretmenİd = ogretmenbilgi.id and stajdefter.ogrenciİd=kullanicilar.kullaniciid

                                                            ");

                            $stajcek->execute();

                            $cekstaj = $stajcek->fetchAll(PDO::FETCH_ASSOC);

                            $total = 0;

                            foreach ($cekstaj as $stajbilgileriCek) {

                                $total = ++$total;

                            ?>

                                <tr class="text-center " style="line-height: 35px;">

                                    <th><?= $total ?></th>

                                    <th>

                                        <?= $stajbilgileriCek['defterid'] ?>

                                    </th>

                                    <th><?= $stajbilgileriCek['ogrenciAdsoyad'] ?></th>

                                    <th><?= $stajbilgileriCek['ogrNumara'] ?></th>

                                    <th><?= $stajbilgileriCek['bolumAd'] ?></th>

                                    <th>

                                        <div class="d-flex ">

                                            <button class="btn bg-success text-white"> <a href="assets/stajdefteri/<?= $stajbilgileriCek['ogrdefter'] ?>" class="nav-link float-end" target="_blank">GÖRÜNTÜLE</a>

                                        </div>

                                        </button>

                                        <button class="btn bg-dark text-white">

                                            <a href="assets/stajdefteri/<?= $stajbilgileriCek['ogrdefter'] ?>" class="nav-link float-end" target="_blank" download>iNDİR</a>



                                        </button>

                </div>



            </div>



            </th>

            <th><?= $stajbilgileriCek['ogrSinif'] ?> Sınıf</th>

            <th><?= $stajbilgileriCek['ogretmenAdSoyad'] ?> </th>

            <th>

                <?php



                                if ($stajbilgileriCek['stajDefterOnay'] == 0) { ?>

                    <button class="btn bg-danger text-white" data-toggle="modal" data-target="#defterStajOnay<?= $stajbilgileriCek['defterid'] ?>">

                        <i class="bi bi-x"> Onaylanmadı</i>

                    </button>

                <?php  } else { ?>

                    <button class="btn bg-success text-white" data-toggle="modal" data-target="#defterStajOnayiptal<?= $stajbilgileriCek['defterid'] ?>">

                        <i class="bi bi-check2">

                            Onaylandı</i>

                    </button>

                <?php   }

                ?>

            </th>

            <th>





                <?php



                                if ($stajbilgileriCek['aktif'] == 1) { ?>



                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ogrenciPasifsilik<?= $stajbilgileriCek['ogrenciİd'] ?>">

                        AKTİF

                    </button>

                <?php  } elseif ($stajbilgileriCek['aktif'] == 2) {  ?>



                    <button class="btn bg-danger text-white" data-toggle="modal" data-target="#ogrenciAktifSilikDurumu<?= $stajbilgileriCek['ogrenciİd'] ?>">Sistemden Kaydı

                        Silik </button>

                <?php  } elseif ($stajbilgileriCek['aktif'] == 0) {  ?>



                    <button class="btn bg-warning text-white" data-toggle="modal" data-target="#ogrenciAktifSilikDurumu<?= $stajbilgileriCek['ogrenciİd'] ?>">Pasif </button>

                <?php    }



                ?>
            </th>

            <th>
                <button class="btn bg-danger text-white" data-toggle="modal" data-target="#deftersil<?= $stajbilgileriCek['defterid'] ?>">Sil </button>
            </th>
            </tr>
        <?php } ?>
        </tbody>

        </table>

        <div class=" d-flex justify-content-around">

            <hr class="text-danger col-3 " style="font-weight:25px;">

            <b class="text-center"> <?= $title ?> </b>

            <hr class="text-danger col-3 " style="font-weight:25px;">

        </div>

        </div>

</div>

</div>

</main>

<script>
    $(document).ready(function() {
        $('#stajDefterDurumlari').wrap("<div style='\n\
     overflow: auto;\n\
     overflow-y: hidden;\n\
     -ms-overflow-y: hidden\n\
     position:relative;\n\
     margin-right:5px;\n\
     padding-bottom: 15px;\n\
     display:block;\n\
 '>/");
    });
    $('#stajDefterDurumlari').DataTable({
        responsive: true,
        language: {
            info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
            infoEmpty: "Gösterilecek hiç kayıt yok.",
            loadingRecords: "Kayıtlar yükleniyor.",
            zeroRecords: "Tablo boş",
            search: "Arama:",
            infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
            buttons: {
                copyTitle: "Panoya kopyalandı.",
                copySuccess: "Panoya %d satır kopyalandı",
                copy: "Kopyala",
                print: "Yazdır",
            },

            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        responsive: true
    });
</script>

<!-- Yetki Girişi Admin olan ogrenci  aktif  modal başlangıç -->
<?php



$cek = $baglanti->query("SELECT * FROM ogrencibilgi");

$ogrencicek = $cek->fetchAll(PDO::FETCH_ASSOC);



foreach ($ogrencicek as $cekogr) { ?>

    <!-- Modal -->

    <div class="modal fade" id="ogrenciAktifSilikDurumu<?= $cekogr['id'] ?>" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Sistem Giriş Durumu</h5>



                </div>

                <div class="modal-body">





                    <div class="text-center"><?php

                                                if ($cekogr['aktif'] == 1) {

                                                    echo '  <button type="button" class="btn btn-primary">

                                  Aktif 

                              </button>';
                                                } elseif ($cekogr['aktif'] == 2) {

                                                    echo ' <button class="btn bg-danger text-white"  >Sistemden Kaydı Silik </button>';
                                                } elseif ($cekogr['aktif'] == 0) {

                                                    echo ' <button class="btn bg-Warning text-white" >Pasif </button>';
                                                }



                                                ?>

                    </div>





                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                    <button type="button" class="btn btn-primary"><a href="islem?id=<?php echo $cekogr['id']; ?>&islem=ogrenciAktif" class="text-white" style="text-decoration: none;">Aktif ET</a></button>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

<!--   Yetki Girişi Admin olan ogrenci  pasif modal bitiş -->
<!-- Yetki Girişi Admin olan ogrenci  pasif ve silik   modal başlangıç -->
<?php

$cek = $baglanti->query("SELECT * FROM ogrencibilgi");

$ogrencicek = $cek->fetchAll(PDO::FETCH_ASSOC);



foreach ($ogrencicek as $cekogr) { ?>

    <!-- Modal -->

    <div class="modal fade" id="ogrenciPasifsilik<?= $cekogr['id'] ?>" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Sistem Giriş Durumu</h5>



                </div>

                <div class="modal-body">





                    <div class="text-center"><?php

                                                if ($cekogr['aktif'] == 1) {

                                                    echo '  <button type="button" class="btn btn-primary">

                                  Aktif 

                              </button>';
                                                } elseif ($cekogr['aktif'] == 2) {

                                                    echo ' <button class="btn bg-danger text-white"  >Sistemden Kaydı Silik </button>';
                                                } elseif ($cekogr['aktif'] == 0) {

                                                    echo ' <button class="btn bg-Warning text-white" >Pasif </button>';
                                                }



                                                ?>

                    </div>





                </div>

                <div class="container-fluid modal-footer ">



                    <button type="button" class="btn btn-danger"><a href="islem?id=<?php echo $cekogr['id']; ?>&islem=ogrencisilik" class="text-white" style="text-decoration: none;">ÖĞRENCİ SİLME</a></button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                    <button type="button" class="btn btn-warning "><a href="islem?id=<?php echo $cekogr['id']; ?>&islem=ogrencipasif" class="text-dark" style="text-decoration: none;">ÖĞRENCİ PASİF ETME</a></button>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

<!--   Yetki Girişi Admin olan ogrenci pasif ve silik modal bitiş -->




<!-- Yetki Girişi Admin olan ogrenci  defter onay modal başlangıç -->





<?php



$cek = $baglanti->query("SELECT * FROM stajdefter");

$ogrencicek = $cek->fetchAll(PDO::FETCH_ASSOC);



foreach ($ogrencicek as $cekogr) { ?>

    <!-- Modal -->

    <div class="modal fade" id="defterStajOnay<?= $cekogr['defterid'] ?>" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Staj Defter Durum Değiştirme</h5>



                </div>

                <div class="modal-body">



                    <div class="text-center"><?php

                                                if ($cekogr['stajDefterOnay'] == 1) {

                                                    echo '  <button type="button" class="btn btn-primary col-12">

                                  Aktif 

                              </button>';
                                                } elseif ($cekogr['stajDefterOnay'] == 0) {

                                                    echo ' <button class="btn bg-dark text-white col-12" >Pasif </button>';
                                                }



                                                ?>

                    </div>





                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                    <button type="button" class="btn btn-primary"><a href="islem?id=<?php echo $cekogr['defterid']; ?>&islem=admindefteronay" class="text-white" style="text-decoration: none;">Aktif ET</a></button>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

<!--  Yetki Girişi Admin olan ogrenci defter onay modal bitiş -->

<!-- Yetki Girişi Admin olan ogrenci staj defteri  aktif pasif modal başlangıç -->

<?php



$cek = $baglanti->query("SELECT * FROM stajdefter");

$ogrencicek = $cek->fetchAll(PDO::FETCH_ASSOC);



foreach ($ogrencicek as $cekogr) { ?>

    <!-- Modal -->

    <div class="modal fade" id="defterStajOnayiptal<?= $cekogr['defterid'] ?>" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Staj Defter Durum Değiştirme</h5>



                </div>

                <div class="modal-body">



                    <div class="text-center"><?php

                                                if ($cekogr['stajDefterOnay'] == 1) {

                                                    echo '  <button type="button" class="btn btn-primary col-12">

                                  Aktif 

                              </button>';
                                                } elseif ($cekogr['stajDefterOnay'] == 0) {

                                                    echo ' <button class="btn bg-dark text-white col-12" >Pasif </button>';
                                                }



                                                ?>

                    </div>





                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                    <button type="button" class="btn btn-danger"><a href="islem?id=<?php echo $cekogr['defterid']; ?>&islem=admindefteronayiptal" class="text-white" style="text-decoration: none;">PASİF ET</a></button>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

<!--  Yetki Girişi Admin olan ogrenci staj defteri aktif pasif modal bitiş -->
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
<?php

$title = "Staj Defteri Ekleme";

$menu = "stajDefteriEkleme";

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki2kisit.php';



?>





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



<div id="layoutSidenav_content">

  <main>

    <div class="container-fluid px-4">

      <h1 class="mt-4"><?= $title ?></h1>

      <ol class="breadcrumb mb-4">

        <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active"><?= $title ?></li>

      </ol>

      <?php

      if ($_SESSION['yetki'] == 3) {

        $ogrenciid = $kullanicicek['kullaniciid'];



        $ogrencibilgi = $baglanti->query("SELECT stajbilgileri.stajdurumOnay, kullanicilar.kullaniciid FROM stajbilgileri, kullanicilar WHERE stajbilgileri.kullaniciid = '$ogrenciid'")->fetch();



        if ($ogrencibilgi !== false) {

          if ($ogrencibilgi['stajdurumOnay'] == 0) {

            echo '  <div class="alert alert-danger text-center" role="alert">

                     <h4 class="alert-heading text-center">HENÜZ STAJ BİLGİLERİNİZ ONAYLANAMADIĞI NEDENİ İLE BU ALANA GİRİŞ YASAKTIR DANIŞMAN ÖĞRETMENİZLE GÖRÜŞÜNÜZ !!!

                     </h4>

                     <i class="bi bi-emoji-dizzy-fill " style="font-size:50px;"></i>

                      <p class="text-center"><span id="lblKalanSure" style="color:#CC3300;font-size:25pt;">10</span></p>

                     <p class="mb-0"></p>

                     </div>';

            header("Refresh:10;url=anasayfa.php");

            include 'inc/footer.php';

            exit();

          } else {

            $ogrencidefter = $baglanti->query("SELECT ogrencibilgi.id,stajdefter.ogrenciİd FROM `stajdefter`,ogrencibilgi WHERE  stajdefter.ogrenciİd= '$ogrenciid' ");

            $ogrencidefter->fetch(PDO::FETCH_ASSOC);

            $say = $ogrencidefter->rowCount();

            if ($say) {

              echo '

              <div class="alert alert-secondary text-center" role="alert">

                  <h4 class="alert-heading text-primary"><i class="bi bi-exclamation-circle"> BAŞARISIZ <i class="bi bi-exclamation-circle ms-1"></i></i></h4>

                  <p></p>

                  <p class="mb-0 text-dark" style="color:red;font-weight:bold;font-size:20px;"><i>AÇILAN ' . $yil . ' STAJ TAKVİMİNDE  STAJ DEFTERİNİZİ SİSTEME YÜKLEDİNİZ ' . '<br>' . ' EN GEC 24 SAAT SONRA SİSTEMDEN KAYDINIZ SİLİNİCEKTİR ŞUAN ANASAYFAYA YÖNLENDİRİLİYORSUNUZ </p>

              </div>';

              header("Refresh:3;url=anasayfa.php");





              include 'inc/footer.php';

              exit();

            } else {

              echo '

              <div class="alert alert-secondary text-center" role="alert">

                  <h4 class="alert-heading text-primary"><i class="bi bi-exclamation-circle"> BAŞARILI <i class="bi bi-exclamation-circle ms-1"></i></i></h4>

                  <p></p>

                  <p class="mb-0 text-dark" style="color:red;font-weight:bold;font-size:20px;"><i>AÇILAN ' . $yil . ' STAJ TAKVİMİNDE  STAJ BİLGİLERİNİZ  ONAYLANDI SON GÜNE BIRAKMADAN  STAJ DEFTERİNİZİ YÜKLEYİNİZ  </p>

              </div>';

            }

          }

        } else {

          echo '  <div class="alert alert-warning" role="alert">

                                    <h4 class="alert-heading text-center">HENÜZ STAJ BİLGİLERİNİZ SİSTEMDE YOKTUR SİSTEME YÜKLEYİNCE AKTİF OLACAKTIR !!!</h4>

                                    <p class="text-center"><span id="lblKalanSure" style="color:#CC3300;font-size:25pt;">10</span></p>

                                    <p class="mb-0"></p>

                                  </div>';

          header("Refresh:10;url=ogrenci-staj-bilgi-ekleme.php");

          include 'inc/footer.php';

          exit();

        }

      }

      ?>





      <div class="card-body">



        <?php

        if ($_SESSION['yetki'] == 3) {

          $yil = date("Y");

          $bolum = $kullanicicek['bolum'];

          $kontrol = $baglanti->query("SELECT kullanicilar.kullaniciid,stajtarihekleme.stajBolumAd,stajtarihekleme.stajTarihYil,stajtarihekleme.stajSinif FROM stajtarihekleme,kullanicilar,ogrencibilgi,unibolum WHERE

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

          }

        }

        ?>

        <?php

        if ($_SESSION['yetki'] == 3) {



          $idogretmencek = $baglanti->prepare("SELECT ogretmenbilgi.id FROM ogrencibilgi,ogretmenbilgi WHERE ogrencibilgi.ogrenciBolum = ogretmenbilgi.ogretmenBolumAd and ogrencibilgi.ogrenciSinif = ogretmenbilgi.ogretmenDanismanDurum and ogrencibilgi.id='  $ogrenciid '");

          $idogretmencek->execute();

          $idCekOgretmen = $idogretmencek->fetch();

        }



        ?>

        <div class="container">

          <h2><?= $title ?></h2>

          <div class="col-12 float-start me-5">

            <form action="" method="post" enctype="multipart/form-data">

              <div class="form-group mb-2">

                <?php

                if ($_SESSION['yetki'] == 3) {

                  $ogretmenid = $baglanti->prepare("SELECT ogretmenbilgi.id FROM ogrencibilgi,ogretmenbilgi WHERE ogrencibilgi.ogrenciBolum = ogretmenbilgi.ogretmenBolumAd and ogrencibilgi.ogrenciSinif = ogretmenbilgi.ogretmenDanismanDurum and ogrencibilgi.id='  $ogrenciid '");

                  $ogretmenid->execute();

                  $cekOgretmenİd = $ogretmenid->fetch();



                  $cekOgretmenİd['id'];

                  $ogrencibilgi = $baglanti->query("SELECT stajtarihekleme.stajEvrakBitis,ogrencibilgi.ogrenciOgrNo,ogrencibilgi.ogrenciSinif,ogrencibilgi.ogrenciBolum,ogrencibilgi.id FROM `stajtarihekleme`,ogrencibilgi WHERE stajtarihekleme.stajBolumAd=ogrencibilgi.ogrenciBolum AND stajtarihekleme.stajSinif=ogrencibilgi.ogrenciSinif AND ogrencibilgi.id= '$ogrenciid'")->fetch();

                  $tarih = $ogrencibilgi['stajEvrakBitis'];

                  $ogrNumarasi = $ogrencibilgi['ogrenciOgrNo'];

                  $phpdate = strtotime($tarih);

                  $mysqldate = date('d-m-Y H:i:s', $phpdate);

                  date_default_timezone_set('Europe/Istanbul');

                  $time_left = strtotime($tarih) - time(); // Geri sayımın yapılacağı tarih ve saat belirtilir

                  $gunTarih = floor($time_left / 86400); // Kalan gün sayısı hesaplanır

                  $saatKalan = floor(($time_left % 86400) / 3600); // Kalan saat sayısı hesaplanır

                  $dakikaKalan = floor(($time_left % 3600) / 60); // Kalan dakika sayısı hesaplanır

                  $kalanSaniye = ($time_left % 60); // Kalan saniye sayısı hesaplanır               }



                }

                ?>

                <label for=""> Kalan Son Ekleme Tarihi : </label>

                <b>

                  <?php if ($_SESSION['yetki'] == 3) {

                    echo $mysqldate;

                  } ?>



                  <br>

                  <?php

                  if ($_SESSION['yetki'] == 3) {

                    if ($gunTarih <= 0) {





                      $date = explode(" ", $mysqldate);





                      echo "<script>  Swal.fire({

                        position: 'center',

                        icon: 'error',

                        title: ' SON TESLİM TARİHİ <br>  $date[0] <br> Geçen süre $gunTarih Gün  <br> MALESEF VERİLEN GÜN VE TARİH SÜRELERİ GEÇTİ',

                        html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-frown-fill\"></p>',

                        showConfirmButton: false,

                        timer: 7000

                      })</script>";

                      echo   "MALESEF VERİLEN GÜN VE TARİH sÜRELERİ GEÇTİ" .  " Geçen Süre: " . $gunTarih . " GÜN <br> ";

                      include 'inc/footer.php';

                      exit();

                    } else {



                      echo "Kalan süre: " . $gunTarih . " GÜN <br> ";

                    }

                  }





                  ?>

                </b>

              </div>

              <div class="form-group mb-2">

                <b>

                  <p>Dosya Adınızı Ad Soyad Ve ogrenci Numarası Olarak Sisteme kaydedin <br> ÖRNEK (mehmet_resit_akin.pdf)</p>

                  <p>Kabul Edilen Dosya Uzantıları (Word,Pdf)</p>

                </b>

                <label for="ogrno">Öğrenci Numaranız: <b style="font-weight: bold;"><u><?php if ($_SESSION['yetki'] == 3) {

                                                                                          echo $ogrNumarasi;

                                                                                        } ?></u></b></label>

                <?php

                if ($_SESSION['yetki'] == 3) { ?>

                  <input type="text" class="form-control" id="ogrno" name="ogrenciNumarasi" hidden value="<?= $ogrNumarasi; ?>">



                  <?php } else {

                  // diger kullanıcı alanı 

                  $ogrencibilgi = $baglanti->prepare("SELECT ogrencibilgi.id,ogrencibilgi.ogrenciOgrNo,ogrencibilgi.ogrenciBolum,ogrencibilgi.ogrenciSinif FROM `ogrencibilgi` ");

                  $ss = $ogrencibilgi->fetchAll(PDO::FETCH_ASSOC);



                  foreach ($ss as $cek) { ?>

                    <select name="ogrenciNumarasi">

                      <option value="<?= $cek['id'] ?>"><?= $cek['id'] ?></option>

                    </select>

                <?php }

                }

                ?>

              </div>

              <div class="form-group mb-2">

                <label for="defter">Staj Defter Ekleme:</label>

                <input type="file" class="form-control" accept=".docx,.rtf,.pdf" name="stajDefter" id="defter" placeholder="Staj Defter Ekleme">

                <input type="text" name="ogretmenid" hidden value="<?= $idCekOgretmen['id']; ?>">



              </div>









              <button type="submit" class="btn btn-primary my-3" name="stajDefterEkleme">Ekle</button>

            </form>

          </div>

          <div class="col-5 float-start">

          </div>



        </div>



      </div>

    </div>

  </main>

  <?php





  if ($_SESSION['yetki'] == 3) {

    if (isset($_POST['stajDefterEkleme'])) {



      $ogrenciNumarasi = htmlspecialchars(trim($_POST['ogrenciNumarasi']));

      $boslukKontrol = htmlspecialchars(trim($_FILES["stajDefter"]["name"]));

      $dosyaAdi = $ogrenciNumarasi . "_" . str_replace(" ", "_", $boslukKontrol);

      $dosyaUzantisi = pathinfo($dosyaAdi, PATHINFO_EXTENSION);

      $izinVerilenUzantilar = array("pdf", "docx", "rtf");

      if ($ogrenciNumarasi == "" or $dosyaAdi == "") {

        echo "Boş Geçmeyiniz";

      } else {



        if (in_array($dosyaUzantisi, $izinVerilenUzantilar)) {



          $uploadDir = "assets/stajdefteri/";

          $hedefDosyaYolu = $uploadDir . $dosyaAdi;



          if (move_uploaded_file($_FILES["stajDefter"]["tmp_name"], $hedefDosyaYolu)) {



            $ogrSinif = $ogrencibilgi['ogrenciSinif'];

            $ogrBolum = $ogrencibilgi['ogrenciBolum'];

            $ogrid = $ogrencibilgi['id'];

            $ogretmenid = $_POST['ogretmenid'];

            $sene = date("Y");

            $bugun = date('Y-m-d');

            $birGunSonrasi = date('Y-m-d', strtotime('+1 days', strtotime($bugun)));



            $defterKaydet = $baglanti->prepare("INSERT INTO stajdefter SET yil=? , ogrNumara =?, ogrdefter =?,ogrBolum =?,ogrSinif =?,ogrenciİD=?,stajOgretmenİd=?,stajDate=?");

            $defterKaydet->execute([$sene, $ogrenciNumarasi, $dosyaAdi, $ogrBolum, $ogrSinif, $ogrid, $ogretmenid, $birGunSonrasi]);

            if ($defterKaydet) {

              echo "<script>

              Swal.fire({

              position: 'center',

              title: 'BAŞARILI BİR ŞEKİLDE KAYDEDİLDİ',

              html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-smile-fill\"></p>',

              icon: 'success',

              showConfirmButton: false,

              timer: 2000

              })

              </script>";

              header("Refresh:2;url=anasayfa.php");

            } else {

              echo "<script>

              Swal.fire({

              position: 'center',

              title: 'BAŞARISIZ SİSTEME KAYDEDİLMEDİ',

              html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

              icon: 'error',

              showConfirmButton: false,

              timer: 2000

              })

              </script>";

              header("Refresh:2;");

            }

          } else {



            echo "<script>

            Swal.fire({

            position: 'center',

            title: 'DOSYA YÜKLENMEDİ',

            html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

            icon: 'error',

            showConfirmButton: false,

            timer: 2000

            })

            </script>";

            header("Refresh:2;");

          }

        } else {

          echo "<script>

          Swal.fire({

          position: 'center',

          title: 'GEÇERSİZ DOSYA UZANTISI iZİN VERİLEN UZANTILAR DIŞINDA YÜKLEME YAPMAYINIZ',

          html: '<p style=\"font-size:50px;\" class=\"bi bi-emoji-surprise-fill\"></p>',

          icon: 'error',

          showConfirmButton: false,

          timer: 2000

          })

          </script>";

          header("Refresh:2;");

        }

      }

    }

  }

  ?>







  <?php

  include 'inc/footer.php';

  ?>
<?php
$title = "Öğrenci Profil";
$menu = "ogrenciProfil";
include 'inc/head.php';
include 'inc/sidebar.php';
include 'yetki/yetki2kisit.php';

?>


<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid ">
      <h1 class="mt-4"><?= $title ?></h1>
      <ol class="breadcrumb mb-4">
        <a href="anasayfa.php" class="me-2 nav-link">Anasayfa</a> / <li class="breadcrumb-item ms-2 active">
          <?= $title ?></li>
      </ol>
      <?php
      $ogrenciid =  $kullanicicek['kullaniciid'];
      $ogrencibilgi = $baglanti->query("SELECT ogrencibilgi.ogrenciEmail FROM ogrencibilgi where id='$ogrenciid'")->fetch();
      ?>

<div class="container card mb-4 ">
        <div class="col-12 text-center">
          <button class="btn bg-success my-2 text-white float-start p-2 ms-2" id="ogrenciAlan"><i class="bi bi-person me-2"></i>Kişisel Bilgiler</button>
          <button class="btn bg-danger my-2 active text-white float-end p-2 me-2 " id="ogrenciSifreAlan"><i class="fa fa-key me-2"></i>Şifre Değiştir</button>
        </div>

        <div class="container" id="ogrenciKisiselAlan">

          <div class="container custom-container">
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="custom-box">
                  <h2>E-MAİL KAYDET</h2>
                  <?php


if ($ogrencibilgi['ogrenciEmail'] == "") { ?>



    <!-- mail boş sa görünecek kod yeri  -->
    <form action="" method="post">

<div class="form-group mb-2">
  <label for="email">E-posta:</label>
  <input type="email" class="form-control" id="email" name="ogrenciEmail">
</div>
<div class="text-center">
  <button type="submit" name="epostaKaydet" class=" col-12 col-md-5 btn btn-primary  my-3">E-mail Kaydet</button>

</div>


</form>
<?php
if (isset($_POST['epostaKaydet'])) {
  $ogrencimail = $_POST['ogrenciEmail'];
  if (!$ogrencimail) {
    echo " <script>  Swal.fire( {title:'Başarısız', text:'BOŞ GEÇMEYİNİZ', icon:'success',confirmButtonText:'Tamam' })</script>";
  } elseif ($baglanti->query("SELECT
   kullanicilar.ogrenciEmail,kullanicilar.ogretmenMail 
   FROM  kullanicilar 
   where  kullanicilar.ogrenciEmail='$ogrencimail' OR kullanicilar.ogretmenMail='$ogrencimail' ")->fetch()) {
    echo " <script>  Swal.fire( {title:'Başarısız', text:' AYNI MAİL SİSTEMDE KAYITLI!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
  } elseif ($baglanti->query("UPDATE `kullanicilar` SET `ogrenciEmail`='$ogrencimail' WHERE
kullanicilar.kullaniciid =' $ogrenciid' ")) {
    // şuan burası çalışmıyor staj bilgileri eklme menusu
    //                      $baglanti->query("UPDATE `stajbilgileri` SET `stajEmail`='$ogrencimail' WHERE
    // stajbilgileri.kullaniciid =' $ogrenciid' ");
    $baglanti->query("UPDATE `ogrencibilgi` SET `ogrenciEmail`='$ogrencimail' WHERE
ogrencibilgi.id =' $ogrenciid' ");
    echo " <script>  Swal.fire( {title:'Başarılı', text:'E-MAİL GÜNCELLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";

    header("Refresh:2;url=anasayfa.php");
  } else {
    echo " <script>  Swal.fire( {title:'başarısız', text:'E-MAİL GÜNCELLENMEDİ !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
  }
}
?>




<?php  } else { ?>
                <!-- mail dolu ise görünecek kod yeri  -->
                <form action="" method="post">

                  <div class="form-group mb-2">
                    <label for="email">E-posta:</label>
                    <input type="email" class="form-control" id="email" name="ogrenciEmail" value="<?php echo $ogrencibilgi['ogrenciEmail'] ?>">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="epostaKaydet" class=" col-12 col-md-5 btn btn-primary  my-3">E-mail GÜncelle</button>

                  </div>


                </form>
                  <?php
                  if (isset($_POST['epostaKaydet'])) {
                    $ogrencimail = htmlspecialchars(trim($_POST['ogrenciEmail']));





                    if (!$ogrencimail) {
                      echo " <script>  Swal.fire( {title:'Başarısız', text:'BOŞ GEÇMEYİNİZ', icon:'success',confirmButtonText:'Tamam' })</script>";
                    } elseif ($baglanti->query("SELECT kullanicilar.ogrenciEmail,kullanicilar.ogretmenMail 
                     FROM  kullanicilar 
                     where kullanicilar.ogrenciEmail='$ogrencimail' OR kullanicilar.ogretmenMail='$ogrencimail' ")->fetch()) {
                      echo " <script>  Swal.fire( {title:'Başarısız', text:' AYNI MAİL SİSTEMDE KAYITLI!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                    } elseif ($baglanti->query("UPDATE `kullanicilar` SET `ogrenciEmail`='$ogrencimail' WHERE
                    kullanicilar.kullaniciid =' $ogrenciid' ")) {


                      echo " <script>  Swal.fire( {title:'Başarılı', text:'E-MAİL GÜNCELLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";

                      header("Refresh:2;url=anasayfa.php");
                    } else {
                      echo " <script>  Swal.fire( {title:'başarısız', text:'E-MAİL GÜNCELLENMEDİ !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
                    }
                  }
                  ?>


                

              <?php }
              ?>
                </div>
              </div>
              <div class="col-12 col-md-4 col-sm-12">
                <div class="custom-box">
                  <h2>RESİM YÜKLEME</h2>
                  <form action="" method="post" enctype="multipart/form-data">



                    <div class="form-group mb-2">
                      <label for="resim">Resim Yükle:</label>
                      <input type="file" class="form-control-file" id="resim" name="kFoto" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary my-3" name="resimKaydet">RESİM YÜKLE</button>
                  </form>
                  <?php
                  if (isset($_POST['resimKaydet'])) {


                    $uploadDir = "assets/ogrencifoto/";
                    $resim = uniqid() . '.' . basename($_FILES['kFoto']['type']);
                    $uploadedFile = $uploadDir . $resim;
  
                    $kfoto = htmlspecialchars(trim(move_uploaded_file($_FILES['kFoto']['tmp_name'], $uploadedFile)));
  
                    if (!$kfoto) {
                      echo " <script>  Swal.fire( {title:'Başarısız', text:' BOŞ GEÇMEYİNİZ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                    } elseif ($baglanti->query("UPDATE `kullanicilar` SET `kFoto`='$resim' WHERE  kullanicilar.kullaniciid =' $ogrenciid'")) {
                      echo " <script>  Swal.fire( {title:'Başarılı', text:' BİLGİLER GÜNCELLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
  
                      header("Refresh:2;url=anasayfa.php");
  
  
                      // Eğer güncelleme sorgusu çalıştıysa alinankitap.php sayfasına yönlendiriyoruz.
                    } else {
                      echo " <script>  Swal.fire( {title:'Başarısız', text:' BİLGİLER GÜNCELLENMEDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                    }
                  }
  
  
                  ?>


                
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="custom-box">
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <form><br><br>
                    <?php
                    $resim = $kullanicicek['kFoto'];
                    if ($resim == 0) {
                      echo '<img src="assets/img/user.png" width="150" height="150" class="border border-4  rounded-5 " alt="" style="position:relative;margin-top:-190px;">';
                    } else {

                      echo '<img src="assets/ogrencifoto/' . $resim . '"  width="150" height="150" class="border border-4 rounded-5 " alt="" style="position:relative;margin-top:-190px;">';
                    }

                    ?>
                    <br><br>
                  </form>
                </div>
              </div>
            </div>
          </div>




        </div>






 
        <div class="container" id="ogrenciSifre">
        <?php
        if (isset($_POST['sifreupdate'])) {
          $a = 0;
          $say = 0;
          $eskiS = htmlspecialchars(trim($_POST['eskisifre']));
          $yeniSifre = htmlspecialchars(trim($_POST['yeniSifre']));
          $SifreTekrar = htmlspecialchars(trim($_POST['yeniSifreTekrar']));



          if (empty($eskiS) || empty($yeniSifre) || empty($SifreTekrar)) {
            echo " <script>  Swal.fire( {title:'Başarısız', text:' BOŞ ALAN BIRAKMAYINIZ!!!', icon:'error',confirmButtonText:'Tamam' })</script>";
          } else {
            $eskisifre = "5645xa" . md5(sha1($_POST['eskisifre'])) . "2023";
            $kontrol = $baglanti->query("SELECT * FROM kullanicilar WHERE Sifre='$eskisifre' and  kullaniciid='$ogrenciid' ")->fetch();
            if ($kontrol == false) {
              echo " <script>  Swal.fire( {title:'Başarısız', text:' ESKİ ŞİFRE YANLIŞ GİRDİNİZ!!!', icon:'error',confirmButtonText:'Tamam' })</script>";
            } else {
              $yeniSifre =htmlspecialchars(trim($_POST['yeniSifre']));
              $SifreTekrar = htmlspecialchars(trim($_POST['yeniSifreTekrar']));
              if ($yeniSifre != $SifreTekrar) {
                echo " <script>  Swal.fire( {title:'Başarısız', text:' YENİ ŞİFRE UYUŞMUYOR!!!', icon:'error',confirmButtonText:'Tamam' })</script>";
              } else {
                $yeniSifre = htmlspecialchars(trim("5645xa" . md5(sha1($_POST['yeniSifre'])) . "2023"));


                $sifreKontrol = $baglanti->query("SELECT kullanicilar.sifre FROM kullanicilar WHERE sifre='$yeniSifre'")->fetch();

                if ($sifreKontrol) {
                  echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRDİĞİNİZ YENİ ŞİFRE GÜVENLİK SEBEBİ İLE KABUL EDİLMİYOR LÜFTEN BAŞKA TEKRAR ŞİFRE GİRİNİZ', icon:'error',confirmButtonText:'Tamam' })</script>";
                } else {
                  // if ($baglanti->query("UPDATE `ogrencibilgi` SET `ogrenciSifre`='$yeniSifre' WHERE  id =' $ogrenciid'")) {
                  if ($baglanti->query("UPDATE `kullanicilar` SET `sifre`='$yeniSifre' WHERE  kullaniciid =' $ogrenciid'")) {
                    echo " <script>  Swal.fire( {title:'Başarılı', text:' ŞİFRE GÜNCELLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
                  }
                  // }
                }
              }
            }
          }
        }
        ?>
        <h2>Şifre Güncelleme Formu </h2><br>

        <div class="d-flex justify-content-center ">

          <form method="post" action="">
            <div class="form-group mb-2">
              <label>Eski Şifre & </label> <label for="showPassword">Şifreyi Göster</label> <input type="checkbox" id="showPassword">
              <input type="password" class="form-control" id="password" name="eskisifre" placeholder="Eski Şifrenizi Girin" value="<?= @$eskiS; ?>">


              <script>
                var passwordField = document.getElementById("password");
                var showPasswordCheckbox = document.getElementById("showPassword");

                showPasswordCheckbox.addEventListener("change", function() {
                  passwordField.type = this.checked ? "text" : "password";
                });
              </script>

            </div>
            <div class="form-group mb-2">
              <label for="yeniSifre">Yeni Şifre:</label>
              <input type="password" class="form-control" id="yeniSifre" name="yeniSifre" placeholder="Yeni Şifrenizi Girin">

            </div>
            <div class="form-group mb-2">
              <label for="yeniSifreTekrar">Yeni Şifre (Tekrar):</label>
              <input type="password" class="form-control" id="yeniSifreTekrar" name="yeniSifreTekrar" placeholder="Yeni Şifrenizi Tekrar Girin">

            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary my-3 " name="sifreupdate">Şifreyi
                Güncelle</button>
            </div>
          </form>
        </div>



      </div>
    </div>
  </main>

  <!-- jquery   -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <!-- jquery bitiş -->
  <script>
    $(document).ready(function() {

      $("#ogrenciKisiselAlan").show();
      $("#ogrenciSifre").hide();



      $("#ogrenciSifreAlan").click(function() {

        $("#ogrenciSifreAlan").addClass("active");
        $("#ogrenciAlan").removeClass("active");

        $("#ogrenciSifre").show();
        $("#ogrenciKisiselAlan").hide();


      });

      $("#ogrenciAlan").click(function() {

        $("#ogrenciSifreAlan").removeClass("active");
        $("#ogrenciAlan").addClass("active");


        $("#ogrenciSifre").hide();
        $("#ogrenciKisiselAlan").show();

      });




    });
  </script>

  <?php include 'inc/footer.php'; ?>


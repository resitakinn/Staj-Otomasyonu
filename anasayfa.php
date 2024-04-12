<?php

$title = "Anasayfa";
$menu = "Anasayfa";
include 'inc/head.php';
include 'inc/sidebar.php'; ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container px-4">

            <ol class="breadcrumb mb-4">
                <li>
                    <h1 class="mt-4 breadcrumb-item active"><?= $title ?></h1>



                </li>
            </ol>

            <?php
      if ($_SESSION['yetki'] == 2) { ?>
            <div class="ac-kural container  " style=" cursor:pointer;">
                <i class="fas fa-eye"></i> <b style="font-weight: 900; color:black;">SİSTEM KURALLARI OKUMAK İÇİN
                    TIKLAYINIZ</b>
            </div>

            <!-- Kapatma Butonu -->
            <div class="kapat-kural  container active" style=" display: none; cursor:pointer;">
                <i class="fas fa-eye-slash"></i> <b style="font-weight: 900; color:black;">KURALLARI KAPATMAK İÇİN
                    TIKLAYINIZ</b>
            </div>


            <div class="card container kural-aktif" id>
                <h4 class="text-center">LÜTFEN OKUYUNUZ</h4>
                <ol>



                    <li style="background-color: red; font-weight:900;color:black; padding:4px;">ÖNCELİKLE ŞİFREİNİ
                        DEĞİŞTİR SİSTEMDE SANA BELİRTİLEN ŞİFRE İLE GİRİŞ YAPMA</li>
                    <li style="background-color: red; font-weight:900;color:black; padding:4px;">ŞİFRE UNUTMA
                        OLASILIĞINA KARŞI SİSTEME E-MAİL ADRESİNİ KAYDET</li>
                    <li style="background-color: red; font-weight:900;color:black; padding:4px;">SİSTEMDEN ÇIKIŞ
                        YAPMADAN SAYFAYI KAPATMA SONRA SİSTEME GİRMEKTE SIKINTI ÇEKERSİN </li>
                    <li>FARKLI CİHAZDAN 2 YADA DAHA FAZLA AYNI ANDA OTURUM AÇAMAZSIN</li>
                    <li>SOL ÜSTTE BULUNAN SÜRE 0 OLDUGUNDA SİSTEMDEN OTOMATİK ÇIKIŞ YAPILIR</li>
                    <li>ADIMLARI TAKİP ET</li>
                    <li>UYARILARI DİKKATE AL</li>
                    <li>SORUN YAŞAMA DURUMUNDA YETKİLİ MERCEKLE GÖRÜŞÜNÜZ</li>
                </ol>

            </div>
            <?php }
      if ($_SESSION['yetki'] == 3) { ?>
            <div class="ac-kural container  " style=" cursor:pointer;">
                <i class="fas fa-eye"></i> <b style="font-weight: 900; color:black;">SİSTEM KURALLARI OKUMAK İÇİN
                    TIKLAYINIZ</b>
            </div>

            <!-- Kapatma Butonu -->
            <div class="kapat-kural  container active" style="display: none; cursor:pointer;">
                <i class="fas fa-eye-slash"></i> <b style="font-weight: 900; color:black;">KURALLARI KAPATMAK İÇİN
                    TIKLAYINIZ</b>
            </div>


            <div class="card container kural-aktif" id>
                <h4 class="text-center">LÜTFEN OKUYUNUZ</h4>
                <ol>

                    <li style="background-color: red; font-weight:900;color:black; padding:4px;">ÖNCELİKLE ŞİFREİNİ
                        DEĞİŞTİR SİSTEMDE SANA BELİRTİLEN ŞİFRE İLE GİRİŞ YAPMA</li>
                    <li style="background-color: red; font-weight:900;color:black; padding:4px;">ŞİFRE UNUTMA
                        OLASILIĞINA KARŞI SİSTEME E-MAİL ADRESİNİ KAYDET</li>
                    <li style="background-color: red; font-weight:900;color:black; padding:4px;">SİSTEMDEN ÇIKIŞ
                        YAPMADAN SAYFAYI KAPATMA SONRA SİSTEME GİRMEKTE SIKINTI ÇEKERSİN </li>
                    <li>FARKLI CİHAZDAN 2 YADA DAHA FAZLA AYNI ANDA OTURUM AÇAMAZSIN</li>
                    <li>SOL ÜSTTE BULUNAN SÜRE 0 OLDUGUNDA SİSTEMDEN OTOMATİK ÇIKIŞ YAPILIR</li>
                    <li>ADIMLARI TAKİP ET</li>
                    <li>UYARILARI DİKKATE AL</li>
                    <li>STAJ DEFTERİNİ YÜKLERKEN SİSTEME SADECE BİR KERE YÜKLEME YAPABİLİRSİN</li>
                    <li>SORUN YAŞAMA DURUMUNDA DANIŞMAN ÖĞRETMENİZLE GÖRÜŞÜNÜZ</li>
                </ol>

            </div>
            <?php  }
      ?>



            <?php


      if (isset($_SESSION['islemyetkisiz'])) {
        if ($_SESSION['islemyetkisiz'] == "no") {
          echo "<script>
Swal.fire({
position: 'center',
title: 'ERİŞİM İZNİNİZ YOK',
icon: 'error',
showConfirmButton: false,
timer: 1500
})
</script>";
          unset($_SESSION['islemyetkisiz']);
        }
      }



      if ($_SESSION['yetki'] == 3) {
        $ogrenciKimlikİd = $kullanicicek['kullaniciid'];       

        /* --------- ÖĞRENCİYE ÖĞRETMEN ATANIP ATANMADIGI KONTROL ETME BAŞLANGIÇ ---------- */
        $cekogrenciid = $baglanti->query("SELECT ogrencibilgi.id,ogrencibilgi.ogrenciSinif,ogrencibilgi.ogrenciBolum FROM `ogrencibilgi` WHERE ogrencibilgi.id='$ogrenciKimlikİd'");
        $idkimlikcek = $cekogrenciid->fetch(PDO::FETCH_ASSOC);



        $ogrenciid = $idkimlikcek['id'];
        $ogrencisinif = $idkimlikcek['ogrenciSinif'];
        $ogrencibolum = $idkimlikcek['ogrenciBolum'];
            /* --------- STAK TAKVİM AKTİF PASİF BAŞLANGIÇ ------------ */
        $stajKontrol = $baglanti->query("SELECT ogrencibilgi.ogrenciBolum,ogrencibilgi.ogrenciSinif FROM `ogrencibilgi`,stajtarihekleme WHERE 
         stajtarihekleme.stajSinif='$ogrencisinif' and stajtarihekleme.stajBolumAd='$ogrencibolum'
        ");
        $stajKontrol->fetch();
        if ($stajKontrol->rowCount() <=  0) {
          echo '<div class=" hata text-center" ><i>
         <div class="alert alert-danger stil " role="alert">
          <h4 class="alert-heading text-danger "><i class="bi bi-exclamation-circle"> BAŞARISIZ <i class="bi bi-exclamation-circle ms-1"></i></i></h4>
          <p></p>
          <p class="mb-0   text-danger" style="color:red;font-weight:bold;font-size:20px;"><i>HENÜZ STAJ TAKVİM YILI AKTİF OLMADI!!! </p>
        </div>
        </i>
        </div>
        
        ';       
          
        }else {
          echo '<div class="alert alert-success text-center my-2" style="width:50% ; margin:auto; " role="alert">
          <h4 class="alert-heading">BAŞARILI</h4>
          <p></p>
          <p class="mb-0">STAJ TAKVİM KAYDI AÇILMIŞTIR </p>
        </div>';
        }
            /* --------- STAK TAKVİM AKTİF PASİF BİTİŞ ------------ */
        $kontrol1 = $baglanti->query("SELECT ogrencibilgi.id, ogrencibilgi.ogrenciBolum,ogrencibilgi.ogrenciSinif,ogretmenbilgi.ogretmenBolumAd,ogretmenbilgi.ogretmenDanismanDurum FROM `ogrencibilgi`,ogretmenbilgi WHERE ogrencibilgi.ogrenciBolum=ogretmenbilgi.ogretmenBolumAd and ogrencibilgi.ogrenciSinif=ogretmenbilgi.ogretmenDanismanDurum AND ogretmenbilgi.ogretmenDanismanDurum='$ogrencisinif' and ogretmenbilgi.ogretmenBolumAd='$ogrencibolum' and ogrencibilgi.id='$ogrenciid'
        ");
        $kontrol1->fetch();
        if ($kontrol1->rowCount() <=  0) {
          echo '<div class=" hata text-center" ><i>
         <div class="alert alert-danger stil " role="alert">
          <h4 class="alert-heading text-danger "><i class="bi bi-exclamation-circle"> BAŞARISIZ <i class="bi bi-exclamation-circle ms-1"></i></i></h4>
          <p></p>
          <p class="mb-0   text-danger" style="color:red;font-weight:bold;font-size:20px;"><i >AÇILAN ' . $yil . ' STAJ TAKVİMİNDE BÖLÜMÜNÜZDE UYGUN ÖĞRETMEN ATANMAMIŞTIR ÖĞRENCİ İŞLERİNE DANIŞINIZ!!! </p>
        </div>
        </i>
        </div>
        
        ';
         
          
        }


        /* --------- ÖĞRENCİYE ÖĞRETMEN ATANIP ATANMADIGI KONTROL ETME BİTİŞ ---------- */
       
        $tokenOlustur =  $_SESSION['token'];  // Token'i kullanmak veya saklamak için




        $ekle = $baglanti->query("UPDATE kullanicilar SET sesionaktif = '$tokenOlustur' where kullaniciid='$ogrenciKimlikİd'");

        /* --------- STAK TAKVİM AKTİF PASİF BAŞLANGIÇ ------------ */

        $sorgu = $baglanti->query("SELECT kullanicilar.ogrenciEMail,kullanicilar.kadi FROM  kullanicilar where kullanicilar.kullaniciid='$ogrenciKimlikİd' ");;

        $sorgu->execute();
        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
          $mail = $sonuc['ogrenciEMail'];
          $sifrekontrol = "5645xa" . md5(sha1($sonuc['kadi'])) . "2023";
          $Ksifre = $baglanti->query("SELECT kullanicilar.sifre FROM  kullanicilar where  kullanicilar.sifre = '$sifrekontrol' and kullanicilar.kullaniciid='$ogrenciKimlikİd' ")->fetch();
          if ($Ksifre) {
            echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
              <h4 class="alert-heading text-center">!!! Bilgilendirme</h4>
              <p></p>
              <p class="mb-0">GÜVENLİK NEDENİ İLE HEMEN ŞİFRENİZİ DEĞİŞTİRİNİZ</p>
            </div>';
            if ($mail == null) {
              echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
                <h4 class="alert-heading text-center">!!! Bilgilendirme</h4>
                <p></p>
                <p class="mb-0">E-MAİL SİSTEMDE YOKTUR HEMEN SİSTEME E-MAİL ADRESİNİZİ KAYDEDİNİZ  </p>
              </div>';
              header("Refresh:8;url=ogrenci-profil");
              include 'inc/footer.php';
              exit();
            }
          } else {
            if ($mail == null) {
              echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
                <h4 class="alert-heading text-center">!!! Bilgilendirme</h4>
                <p></p>
                <p class="mb-0">E-MAİL SİSTEMDE YOKTUR HEMEN SİSTEME E-MAİL ADRESİNİZİ KAYDEDİNİZ  </p>
              </div>';
              header("Refresh:8;url=ogrenci-profil");
              include 'inc/footer.php';
              exit();
            }
          }
        }

        $ogrencidefter = $baglanti->query("SELECT ogrencibilgi.id,stajdefter.ogrenciİd FROM `stajdefter`,ogrencibilgi WHERE  stajdefter.ogrenciİd= '$ogrenciKimlikİd' ");
        $ogrencidefter->fetch(PDO::FETCH_ASSOC);
        $say = $ogrencidefter->rowCount();
        if ($say) {
          echo '
              <div class="alert alert-secondary text-center" role="alert">
                  <h4 class="alert-heading text-primary"><i class="bi bi-exclamation-circle"> UYARI <i class="bi bi-exclamation-circle ms-1"></i></i></h4>
                  <p></p>
                  <p class="mb-0 text-dark" style="color:red;font-weight:bold;font-size:20px;"><i>AÇILAN ' . $yil . ' STAJ TAKVİMİNDE  STAJ DEFTERİNİZİ SİSTEME YÜKLEDİNİZ ' . '<br>' . ' EN GEC 24 SAAT SONRA SİSTEMDEN KAYDINIZ SİLİNİCEKTİR  </p>
              </div>';
          // uyarı takvimi 

          $ogrencidefterDate = $baglanti->query("SELECT stajdefter.stajDate FROM `stajdefter` WHERE  stajdefter.ogrenciİd= '$ogrenciKimlikİd' ");

          $ogrencidefterDate->execute();
          $date = $ogrencidefterDate->fetch();
          // date_default_timezone_set('Europe/Istanbul');

          $girilenTarih = $date['stajDate'];
          $bugun = date('Y-m-d');

          if ($girilenTarih <= $bugun) {
            $guncellekullanici = $baglanti->prepare("UPDATE `kullanicilar` SET `aktif` =? WHERE kullanicilar.kullaniciid = ? ");

            $guncellekullanici->execute([2, $ogrenciKimlikİd]);

            $guncelleOgrBilgi = $baglanti->prepare("UPDATE ogrencibilgi SET `aktif` =? WHERE ogrencibilgi.id=? ");

            $guncelleOgrBilgi->execute([2, $ogrenciKimlikİd]);
            header("Location:cikis");
          }
          include 'inc/footer.php';
          exit();
        }
        $cekveri = $baglanti->prepare("SELECT ogrencibilgi.ogrenciSinif FROM kullanicilar,ogrencibilgi WHERE kullanicilar.kullaniciid=ogrencibilgi.id and kullanicilar.kullaniciid='$ogrenciKimlikİd' ");
        $cekveri->execute();
        $calistirVeri = $cekveri->fetch();
        $sinifcek = $calistirVeri['ogrenciSinif'];
        $yil = date("Y");
        $bolum = $kullanicicek['bolum'];


    //     $kontrol = $baglanti->query("SELECT stajtarihekleme.stajBolumAd,stajtarihekleme.stajTarihYil,stajtarihekleme.stajSinif FROM stajtarihekleme,kullanicilar,ogrencibilgi,unibolum WHERE
    //   stajtarihekleme.stajBolumAd=unibolum.bolumid and unibolum.bolumid=kullanicilar.bolum 
    //  and stajtarihekleme.stajTarihYil=' $yil' and stajtarihekleme.stajSinif=ogrencibilgi.ogrenciSinif and ogrencibilgi.ogrenciSinif='$sinifcek' and    stajtarihekleme.stajBolumAd='$bolum'");
    //     $kontrol->fetch();
    //     if ($kontrol->rowCount() <= 0) {


    //       echo '<div class="alert alert-danger my-2 text-center" style="width:50% ; margin:auto; " role="alert">
    //       <h4 class="alert-heading">BAŞARISIZ</h4>
    //       <p></p>
    //       <p class="mb-0">HENÜZ STAJ TAKVİM YILI AKTİF OLMADI</p>
    //     </div>';
    //     } else {
    //       echo '<div class="alert alert-success text-center my-2" style="width:50% ; margin:auto; " role="alert">
    //       <h4 class="alert-heading">BAŞARILI</h4>
    //       <p></p>
    //       <p class="mb-0">STAJ TAKVİM KAYDI AÇILMIŞTIR </p>
    //     </div>';
    //     }
        /* --------- STAK TAKVİM AKTİF PASİF BİTİŞ ------------ */
        


        /* ---------------- STAJ ONAYLANIP ONAYLANMADIĞI BAŞLANGIÇ---------------- */
        $kontroldurum = $baglanti->query("SELECT  stajbilgileri.stajdurumOnay, stajbilgileri.kullaniciid FROM stajbilgileri, kullanicilar WHERE kullanicilar.kullaniciid = stajbilgileri.kullaniciid AND stajbilgileri.kullaniciid = '$ogrenciKimlikİd'");
        $k = $kontroldurum->fetch(PDO::FETCH_ASSOC);

        if ($k) {
          if ($k['stajdurumOnay'] == 0) {
            echo '
        <div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
            <h4 class="alert-heading text-danger text-center"><i class="bi bi-exclamation-circle"> BAŞARISIZ <i class="bi bi-exclamation-circle ms-1"></i></i></h4>
            <p></p>
            <p class="mb-0 text-danger text-center" style="color:red;font-weight:bold;font-size:20px;"><i>AÇILAN ' . $yil . ' STAJ TAKVİMİNDE HENÜZ STAJ BİLGİLERİ ONAYLANMADI ONAYLANINCA STAJ DEFTERİ EKLEME MENÜSÜ AKTİF OLACAKTIR </p>
        </div>';
          } else {
            echo '
            <div class="alert alert-info text-center my-2" style="width:50% ; margin:auto; " role="alert">
                <h4 class="alert-heading text-primary"><i class="bi bi-exclamation-circle"> BAŞARILI <i class="bi bi-exclamation-circle ms-1"></i></i></h4>
                <p></p>
                <p class="mb-0 text-dark text-center" style="color:red;font-weight:bold;font-size:20px;"><i>AÇILAN ' . $yil . ' STAJ TAKVİMİNDE  STAJ BİLGİLERİNİZ <u style="font-weight:bold;">ONAYLANDI </u>  STAJ DEFTERİ EKLEME MENÜSÜ AKTİFTİR... </p>
            </div>';
          }
        } else {
          $stmt = $baglanti->query("SELECT stajtarihekleme.stajBolumAd,stajtarihekleme.stajSinif
           FROM `stajtarihekleme`,ogrencibilgi
            WHERE
             stajtarihekleme.stajBolumAd=ogrencibilgi.ogrenciBolum and stajtarihekleme.stajSinif=ogrencibilgi.ogrenciSinif and stajtarihekleme.stajBolumAd=' $ogrencibolum' and stajtarihekleme.stajSinif=' $ogrencisinif' ");
          $stmt->execute();
          $rowCount = $stmt->fetchColumn();


          if ($rowCount > 0) {
            echo '   <div class="alert alert-dark text-center my-2" style="width:50% ; margin:auto; " role="alert"> <p class="mb-0 text-danger" style="color:red;font-weight:bold;font-size:20px;"><i> HENÜZ STAJBİLGİLERİ SİSTEME KAYDETMEDİNİZ </p>
          </div>';
          }
        }
        /* ---------------- STAJ ONAYLANIP ONAYLANMADIĞI BİTİŞ---------------- */
      }


      if ($_SESSION['yetki'] == 2) {

        $ogretmenKimlikİd = $kullanicicek['ogretmenid'];        
        $ogretmenBilgiCek = $baglanti->prepare("SELECT ogretmenbilgi.ogretmenDanismanDurum,ogretmenbilgi.ogretmenBolumAd FROM kullanicilar,ogretmenbilgi WHERE kullanicilar.ogretmenid=ogretmenbilgi.id and kullanicilar.ogretmenid='$ogretmenKimlikİd' ");
        $ogretmenBilgiCek->execute();
        $ogretmenCek = $ogretmenBilgiCek->fetch();
        $ogretmenSinif = $ogretmenCek['ogretmenDanismanDurum'];
        $ogretmenbolum = $ogretmenCek['ogretmenBolumAd'];
                
        $yil = date("Y");

        $kontrol1 = $baglanti->query("SELECT ogrencibilgi.ogrenciSinif,ogrencibilgi.ogrenciBolum,ogretmenbilgi.ogretmenDanismanDurum,ogretmenbilgi.ogretmenBolumAd
          FROM 
          ogrencibilgi,ogretmenbilgi 
          WHERE 
          ogrencibilgi.ogrenciSinif=ogretmenbilgi.ogretmenDanismanDurum AND
          ogrencibilgi.ogrenciBolum=ogretmenbilgi.ogretmenBolumAd and
          ogrencibilgi.ogrenciBolum='$ogretmenbolum ' and
          ogrencibilgi.ogrenciSinif='$ogretmenSinif' AND ogrencidate='$yil' ");
          $kontrol1->fetch();
          if ($kontrol1->rowCount() <= 0) {
            echo '<div class=" hata" ><i>
         <div class="alert alert-danger stil my-2" style=" margin:auto; " role="alert">
          <h4 class="alert-heading text-danger text-center"><i class="bi bi-exclamation-circle"> BAŞARISIZ <i class="bi bi-exclamation-circle ms-1"></i></i></h4>
          <p></p>
          <p class="mb-0   text-danger my-2 text-center" style=" margin:auto; " style="color:red;font-weight:bold;font-size:20px;"><i>BULUNDUĞUNUZ '.$yil.' TAKVİM YILINDA  BÖLÜMÜNÜZDE  ÖĞRENCİ YOKTUR!!! </p>
        </div>
        </i>
        </div>
        
        ';
          }
        // ---------------
        $sorgu = $baglanti->query("SELECT kullanicilar.ogretmenMail,kullanicilar.kadi FROM  kullanicilar where kullanicilar.ogretmenid='$ogretmenKimlikİd' ");;

        $sorgu->execute();
        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
          $mail = $sonuc['ogretmenMail'];
          $sifrekontrol = "5645xa" . md5(sha1($sonuc['kadi'])) . "2023";
          $Ksifre = $baglanti->query("SELECT kullanicilar.sifre FROM  kullanicilar where  kullanicilar.sifre = '$sifrekontrol' and kullanicilar.ogretmenid='$ogretmenKimlikİd' ")->fetch();
          if ($Ksifre) {
            echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
              <h4 class="alert-heading text-center">!!! Bilgilendirme</h4>
              <p></p>
              <p class="mb-0">GÜVENLİK NEDENİ İLE HEMEN ŞİFRENİZİ DEĞİŞTİRİNİZ</p>
            </div>';
            if ($mail == null) {
              echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
                <h4 class="alert-heading text-center">!!! Bilgilendirme</h4>
                <p></p>
                <p class="mb-0">E-MAİL SİSTEMDE YOKTUR HEMEN SİSTEME E-MAİL ADRESİNİZİ KAYDEDİNİZ  </p>
              </div>';
              header("Refresh:8;url=ogretmen-profil");
              include 'inc/footer.php';
              exit();
            }
          } else {
            if ($mail == null) {
              echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
                <h4 class="alert-heading text-center">!!! Bilgilendirme</h4>
                <p></p>
                <p class="mb-0">E-MAİL SİSTEMDE YOKTUR HEMEN SİSTEME E-MAİL ADRESİNİZİ KAYDEDİNİZ  </p>
              </div>';
              header("Refresh:8;url=ogretmen-profil");
              include 'inc/footer.php';
              exit();
            }
          }
        }



        // -----------------

            
        

        $kontrol = $baglanti->query("SELECT stajtarihekleme.stajBolumAd , stajtarihekleme.stajTarihYil ,stajtarihekleme.kullaniciid,stajtarihekleme.stajSinif FROM `unibolum`,stajtarihekleme,kullanicilar,ogretmenbilgi WHERE stajtarihekleme.stajBolumAd=unibolum.bolumid and unibolum.bolumid=kullanicilar.bolum and stajtarihekleme.stajTarihYil='$yil'  and stajtarihekleme.kullaniciid=kullanicilar.ogretmenid and kullanicilar.bolum='$ogretmenbolum'and
         stajtarihekleme.stajSinif=ogretmenbilgi.ogretmenDanismanDurum and kullanicilar.ogretmenid='$ogretmenKimlikİd'and  stajtarihekleme.stajSinif='$ogretmenSinif';  ");
        $kontrol->fetch();
        if ($kontrol->rowCount() <= 0) {


          echo '<div class="alert alert-danger my-2" style="width:50% ; margin:auto; " role="alert">
          <h4 class="alert-heading">!!! Bilgilendirme</h4>
          <p></p>
          <p class="mb-0">HENÜZ STAJ TAKVİM  ACMADINIZ </p>
        </div>';
        } else {
          echo '<div class="alert alert-success text-center my-2" style="width:50% ; margin:auto; " role="alert">
          <h4 class="alert-heading">BAŞARILI</h4>
          <p></p>
          <p class="mb-0">STAJ TAKVİM KAYDI AÇTINIZ ' . $yil . ' </p>
        </div>';
         
        }
      }
      ?>

        </div>
    </main>


    <?php include 'inc/footer.php'; ?>
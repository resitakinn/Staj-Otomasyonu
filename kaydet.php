<?php

$title = "Toplu Öğrenci Ekleme";

$menu = "ogrenciTopluEkleme";


include 'inc/head.php';
include 'yetki/yetki3kisit.php';

?>





<?php
// print_r($_POST);
$say = 0;
if ($_POST == false) {
    echo " <script>  Swal.fire( {title:'SİSTEM HATASI', text:'BOŞ GEÇMEYİNİZ!!!', icon:'success',confirmButtonText:'Tamam' })</script>";
   
    exit();
}
foreach ($_POST['ogrenciTc'] as $key => $val) {
    $say =++$say;
    if (isset($val[$key])) {
        // $val dizisinde belirtilen indeks var, şimdi işlemleri gerçekleştir
        $ogrenciTc = htmlspecialchars(trim($_POST['ogrenciTc'][$key]));
        $ogrenciAdsoyad = htmlspecialchars(trim($_POST['ogrenciAdsoyad'][$key]));
        $ogrenciOgrNo = htmlspecialchars(trim($_POST['ogrenciOgrNo'][$key]));
        $ogrenciBolum = htmlspecialchars(trim($_POST['ogrenciBolum'][$key]));
        $ogrenciSinif = htmlspecialchars(trim($_POST['ogrenciSinif'][$key]));
        $ogrenciil = htmlspecialchars(trim($_POST['ogrenciil'][$key]));
        $ogrenciilce = htmlspecialchars(trim($_POST['ilce'][$key]));
        $ogrenciSifre = htmlspecialchars(trim($_POST['ogrenciSifre'][$key]));
        $kGorev = htmlspecialchars(trim($_POST['kGorev'][$key]));
 
        // Diğer değişkenleri de benzer şekilde kontrol et
        if (!$ogrenciTc || !$ogrenciAdsoyad || !$ogrenciOgrNo  || !$ogrenciil || !$ogrenciilce ||!$ogrenciSifre || !$ogrenciSinif) {

            echo " <script>  Swal.fire( {title:'BAŞARISIZ', text:'BOŞ ALAN BIRAKMAYINIZ!!!', icon:'error',confirmButtonText:'Tamam' })</script>";
        } 
        elseif ($ogrenciBolum === "null" || $kGorev === "0" || $ogrenciil === "0" ) {

            echo " <script>  Swal.fire( {title:'HATA', text:'BOŞ ALAN BIRAKMAYINIZ!!!', icon:'error',confirmButtonText:'Tamam' })</script>";
        } 
        else {

            $ogrkontrol = $baglanti->query("SELECT * FROM ogrencibilgi where ogrenciOgrNo='$ogrenciOgrNo'")->fetch();

            $kontrolTc = $baglanti->query("SELECT * FROM ogrencibilgi where ogrenciTc='$ogrenciTc'")->fetch();

            if ($ogrkontrol) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRİLEN ÖĞRENCİ NUMARA KULLANILMAKTA !!!', icon:'error',confirmButtonText:'Tamam' })</script>";
            } elseif ($kontrolTc) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:'GİRİLEN TC NUMARA KULLANILMAKTA !!!', icon:'success',confirmButtonText:'Tamam' })</script>";
            } else {

                $sorgu = $baglanti->prepare('INSERT INTO ogrencibilgi SET
    
    
    ogrenciTc=?,    
    
    ogrenciAdsoyad=?,    
    
    ogrenciOgrNo=?,
    
    ogrenciBolum=?,
    
    il = ?,    
    ilce = ?,    
    ogrenciSinif=?       
    ');


                $kaydet = $sorgu->execute([

                    $ogrenciTc, $ogrenciAdsoyad, $ogrenciOgrNo, $ogrenciBolum,$ogrenciil,$ogrenciilce,$ogrenciSinif

                ]);

                

                if ($kaydet) {
                          if ($say > 0 && $say < 2){
                            echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRENCİ  EKLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                            header("Refresh:2;url=anasayfa");
                          }
                          elseif ($say >=2){
                            echo " <script>  Swal.fire( {title:'Başarılı', text:'ÖĞRENCİLER  EKLENDİ !!!', icon:'success',confirmButtonText:'Tamam' })</script>";



                            header("Refresh:2;url=anasayfa");
                          }

                   
                }



                $cek = $baglanti->query("SELECT * FROM ogrencibilgi where ogrenciOgrNo='$ogrenciOgrNo' ");

                $ogrencicek = $cek->fetch();

                $kullaniciid = $ogrencicek['id'];

                $yetkiekle = $ogrencicek['yetki'];               

                $users = $baglanti->prepare('INSERT INTO kullanicilar SET
    
    
    
    isim=?,    
    
    kadi=?,
    
    sifre=?,    
    
    yetki=?,
    
    kullaniciid=?,
    
    kGorev=?,
    
    bolum = ?
    
    
    
    
    
    
    
    ');

                $ogrenciSifre3 = "5645xa" . md5(sha1($_POST['ogrenciSifre'][$key])) . "2023";

                $users->execute([

                    $ogrenciAdsoyad, $ogrenciOgrNo, $ogrenciSifre3, $yetkiekle, $kullaniciid, $kGorev, $ogrenciBolum

                ]);

                $ogrencibilgisifreguncelle = $baglanti->prepare("UPDATE ogrencibilgi SET ogrenciSifre = ? WHERE id = ?");

                $ogrencibilgisifreguncelle->execute([$ogrenciSifre3, $kullaniciid]);
            }
        }
        
       
    } else {
        // İlgili indeks tanımsız ise, uygun bir işlem yapın veya hata mesajı verin
        echo " <script>  Swal.fire( {title:'SİSTEM HATASI', text:'BOŞ GEÇMEYİNİZ!!!', icon:'error',confirmButtonText:'Tamam' })</script>";
        exit();
    }
   
}


?>


</body>

</html>
<?php



if ($_GET) {



    include("inc/head.php");
    $yetki = $kullanicicek['yetki'];
    $ogretmenKimlikİd = $kullanicicek['ogretmenid'];
    $id = $_GET['id'];
    $islem = $_GET['islem'];


    switch ($islem) {
        case 'BolumdurumPasif':
            $BolumdurumPasif = $baglanti->prepare("UPDATE unibolum SET bolumDurum = ? WHERE idbolum = ?");
            $BolumdurumPasif->execute([0, $id]);
            if ($BolumdurumPasif) {
                header("location:bolum-ekle");
            }
            break;
        case 'BolumdurumAktif':
            $BolumdurumAktif = $baglanti->prepare("UPDATE unibolum SET bolumDurum = ? WHERE idbolum = ?");
            $BolumdurumAktif->execute([1, $id]);
            if ($BolumdurumAktif) {
                header("location:bolum-ekle");
            }
            break;
        case 'BolumSil':
            $BolumSil = $baglanti->prepare("DELETE FROM unibolum WHERE idbolum = ?");
            $BolumSil->execute([$id]);
            if ($BolumSil) {
                session_start();
                $_SESSION['bolum_delete'] = "ok";
                header("location:bolum-ekle");
                exit;
            } else {
                session_start();
                $_SESSION['bolum_delete'] = "no";
                header("location:bolum-ekle");
                exit;
            }
            break;
        case 'ogretmenSil':
            $ogretmenSil = $baglanti->prepare("DELETE FROM ogretmenbilgi WHERE id = ?");
            $ogretmenSil->execute([$id]);
            $ogretmenSil = $baglanti->prepare("DELETE FROM kullanicilar WHERE ogretmenid = ?");
            $ogretmenSil->execute([$id]);
            if ($ogretmenSil) {
                session_start();
                $_SESSION['ogretmenDelete'] = "ok";
                header("location:ogretmen-ekle");
                exit;
            } else {
                session_start();
                $_SESSION['ogretmenDelete'] = "no";
                header("location:ogretmen-ekle");
                exit;
            }
            break;
        case 'ogrenciSil':
            $ogrenciSil = $baglanti->prepare("DELETE FROM ogrencibilgi WHERE id = ?");
            $ogrenciSil->execute([$id]);
            $ogrenciSil = $baglanti->prepare("DELETE FROM kullanicilar WHERE kullaniciid = ?");
            $ogrenciSil->execute([$id]);
            if ($ogrenciSil) {
                session_start();
                $_SESSION['ogrenciDelete'] = "ok";
                header("location:ogrenci-ekle");
                exit;
            } else {
                session_start();
                $_SESSION['ogrenciDelete'] = "no";
                header("location:ogrenci-ekle");
                exit;
            }


            break;
        case 'stajonay':



            if ($yetki == 1) {
                $stajdurumOnay = $baglanti->prepare("UPDATE stajbilgileri SET stajdurumOnay = ? , ogretmenİd = ?,sistemyetki = ? WHERE id = ?");
                $stajdurumOnay->execute([1, null, $yetki, $id]);
                if ($stajdurumOnay) {
                    session_start();
                    $_SESSION['stajApproval'] = "ok";
                    header("location:staj-durumlari");
                }
                exit();
            } elseif ($yetki == 2) {
                $stajdurumOnay = $baglanti->prepare("UPDATE stajbilgileri SET stajdurumOnay = ? , ogretmenİd = ?,sistemyetki = ? WHERE id = ?");
                $stajdurumOnay->execute([1, $ogretmenKimlikİd, $yetki, $id]);
                if ($stajdurumOnay) {
                    session_start();
                    $_SESSION['stajApproval'] = "ok";
                    header("location:staj-basvuru-onaylama");
                }
                exit();
            }





            break;
        case 'stajonayiptal':


            if ($yetki == 1) {
                $stajdurumOnay = $baglanti->prepare("UPDATE stajbilgileri SET stajdurumOnay = ?, sistemyetki = ? WHERE id = ?");
                $stajdurumOnay->execute([0, $yetki, $id]);
                if ($stajdurumOnay) {

                    session_start();
                    $_SESSION['stajcancel'] = "no";

                    header("location:staj-durumlari");
                    exit;
                }
            } elseif ($yetki == 2) {
                $stajdurumOnay = $baglanti->prepare("UPDATE stajbilgileri SET stajdurumOnay = ?, ogretmenİd = ?,sistemyetki = ? WHERE id = ?");
                $stajdurumOnay->execute([0, $ogretmenKimlikİd, $yetki, $id]);
                if ($stajdurumOnay) {

                    session_start();
                    $_SESSION['stajcancel'] = "no";
                    header("location:staj-basvuru-onaylama");
                    exit;
                }
            }


            break;
        case 'stajbasvurusil':


            if ($yetki == 1) {
                $stajbasvurusil = $baglanti->prepare("DELETE FROM stajbilgileri WHERE id = ?");
                $stajbasvurusil->execute([$id]);
                if ($stajbasvurusil) {

                    session_start();
                    $_SESSION['stajbasvurusil'] = "yes";

                    header("location:staj-durumlari");
                    exit;
                }
            } elseif ($yetki == 2) {
                $stajbasvurusil = $baglanti->prepare("DELETE FROM stajbilgileri WHERE id = ?");
                $stajbasvurusil->execute([$id]);
                if ($stajbasvurusil) {

                    session_start();
                    $_SESSION['stajbasvurusil'] = "yes";
                    header("location:staj-basvuru-onaylama");
                    exit;
                }
            }


            break;
        case 'defteronayla':


            $stajdurumOnay = $baglanti->prepare("UPDATE stajdefter SET stajDefterOnay = ?,stajOgretmenİd=? WHERE defterid = ?");
            $stajdurumOnay->execute([1, $ogretmenKimlikİd, $id]);
            if ($stajdurumOnay) {

                session_start();
                $_SESSION['stajdefterok'] = "ok";
                header("Location:staj-defter-onaylama");

                exit;
            }
            break;
        case 'defteronaylaiptal':

            $stajdurumOnay = $baglanti->prepare("UPDATE stajdefter SET stajDefterOnay = ? WHERE defterid = ?");
            $stajdurumOnay->execute([0, $id]);
            if ($stajdurumOnay) {

                session_start();
                $_SESSION['stajdefteronayiptal'] = "no";
                header("Location:staj-defter-onaylama");

                exit;
            }
            break;

        case 'defterSil':
            if ($yetki == 1) {
                $defterSil = $baglanti->prepare("DELETE FROM stajdefter WHERE defterid = ?");
                $defterSil->execute([$id]);
                if ($defterSil) {

                    session_start();
                    $_SESSION['defterSil'] = "yes";
                    header("Location:staj-defter-durumlari");

                    exit;
                }
            } elseif ($yetki == 2) {

                $ogrid = $baglanti->prepare("SELECT stajdefter.ogrenciİd FROM stajdefter Where  stajdefter.defterid = '$id' ");

                $ogrid->execute();
                $cekid = $ogrid->fetch();

                $idogrenci = $cekid['ogrenciİd'];


                $guncellekullanici = $baglanti->prepare("UPDATE `kullanicilar` SET `aktif` =:a WHERE kullanicilar.kullaniciid = '$idogrenci' ");

                $guncellekullanici->execute(['a' => "1"]);

                $guncelleOgrBilgi = $baglanti->prepare("UPDATE ogrencibilgi SET `aktif` =:b WHERE ogrencibilgi.id='$idogrenci' ");

                $guncelleOgrBilgi->execute(['b' => "1"]);
                $stajdurumOnay = $baglanti->prepare("DELETE FROM  stajdefter WHERE defterid = ?");
                $stajdurumOnay->execute([$id]);
                if ($stajdurumOnay) {

                    session_start();
                    $_SESSION['stajDefterDelete'] = "ok";
                    header("Location:staj-defter-onaylama");
                    exit;
                } else {
                    session_start();
                    $_SESSION['stajDefterDelete'] = "no";
                    header("Location:staj-defter-onaylama");
                    exit;
                }
            }

            break;


        case 'ogrenciAktif':

            $ogrenciAktif = $baglanti->prepare("UPDATE ogrencibilgi,kullanicilar SET ogrencibilgi.aktif = ?,kullanicilar.aktif=? WHERE ogrencibilgi.id = ?  AND kullanicilar.kullaniciid = ?  ");
            $ogrenciAktif->execute([1, 1, $id, $id]);
            if ($ogrenciAktif) {

                session_start();
                $_SESSION['ogrenciAktif'] = "yes";
                header("Location:staj-defter-durumlari");

                exit;
            }
            break;
        case 'ogrencisilik':

            $ogrencisilmekaydı = $baglanti->prepare("UPDATE ogrencibilgi,kullanicilar SET ogrencibilgi.aktif = ?,kullanicilar.aktif=? WHERE ogrencibilgi.id = ?  AND kullanicilar.kullaniciid = ?  ");
            $ogrencisilmekaydı->execute([2, 2, $id, $id]);
            if ($ogrencisilmekaydı) {

                session_start();
                $_SESSION['ogrencisilmekaydı'] = "yes";
                header("Location:staj-defter-durumlari");

                exit;
            }
            break;
        case 'ogrencipasif':

            $ogrencipasifkaydı = $baglanti->prepare("UPDATE ogrencibilgi,kullanicilar SET ogrencibilgi.aktif = ?,kullanicilar.aktif=? WHERE ogrencibilgi.id = ?  AND kullanicilar.kullaniciid = ?  ");
            $ogrencipasifkaydı->execute([0, 0, $id, $id]);
            if ($ogrencipasifkaydı) {

                session_start();
                $_SESSION['ogrencipasifkaydı'] = "yes";
                header("Location:staj-defter-durumlari");

                exit;
            }
            break;

        case 'admindefteronay':

            $admindefteronay = $baglanti->prepare("UPDATE stajdefter SET stajdefter.stajDefterOnay = ? WHERE stajdefter.defterid = ?   ");
            $admindefteronay->execute([1, $id]);
            if ($admindefteronay) {

                session_start();
                $_SESSION['admindefteronay'] = "yes";
                header("Location:staj-defter-durumlari");

                exit;
            }
            break;


        case 'admindefteronayiptal':

            $admindefteronayiptal = $baglanti->prepare("UPDATE stajdefter SET stajdefter.stajDefterOnay = ? WHERE stajdefter.defterid = ?   ");
            $admindefteronayiptal->execute([0, $id]);
            if ($admindefteronayiptal) {

                session_start();
                $_SESSION['admindefteronayiptal'] = "yes";
                header("Location:staj-defter-durumlari");

                exit;
            }
            break;
    }
} else {
    session_start();
    $_SESSION['islemyetkisiz'] = "no";
    header("Location:anasayfa");
}

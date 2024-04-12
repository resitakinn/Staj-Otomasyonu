<?php

$title = "Admin Bilgi Düzenleme";

$menu = "adminbilgi";

include 'inc/head.php';

ob_start();

include 'inc/sidebar.php';

include 'yetki/yetki1kisit.php';



?>



<?php



if (isset($_SESSION['bilgiupdate'])) {

    if ($_SESSION['bilgiupdate'] == "yes") {

        echo " <script> 

                Swal.fire( {

                    title:'BAŞARILI',

                    text:'BİLGİ GÜNCELLENDİ !!!',

                    icon:'success',

                    showConfirmButton:false,

                    time:2000 

                })

            </script>";

        unset($_SESSION['bilgiupdate']);

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
                    <?= $title ?></li>

            </ol>





            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table me-1"></i>

                    <?= $title ?>




                </div>

                <?php

                $cek = $baglanti->prepare("SELECT * FROM kullanicilar where id = 1");
                $cek->execute();
                $adminBilgicek = $cek->fetch();

                ?>

                <div class="card-body">

                    <div class="container form-group">
                        <h1><?= $title ?></h1>
                        <form action="" method="post">
                            <div class="form-group mb-3">

                                <b>Admin Ad :</b>

                                <input type="text" class="form-control" name="adminisim"
                                    value="<?= $adminBilgicek['isim'] ?>">

                            </div>
                            <div class="form-group mb-3">

                                <b>Kullanıcı Numara :</b>

                                <input type="text" class="form-control" name="adminkadi"
                                    value="<?= $adminBilgicek['kadi'] ?>">

                            </div>
                            <div class="form-group mb-3">

                                <b>Admin Şifre :</b>

                                <input type="text" class="form-control" name="adminsifre"
                                    value="<?= $adminBilgicek['sifre'] ?>">



                            </div>


                            <button type="submit" class="btn bg-primary" name="adminBilgiGuncelle">Güncelle</button>
                        </form>
                        <?php
                        if (isset($_POST['adminBilgiGuncelle'])) {
                            $adminisim = htmlspecialchars(trim($_POST['adminisim']));
                            $adminkadi = htmlspecialchars(trim($_POST['adminkadi']));
                            $adminsifre = htmlspecialchars(trim($_POST['adminsifre']));
                            $kontrol = $adminBilgicek['sifre'];


                            if (!$adminisim || !$adminkadi || !$adminsifre) {
                                echo " <script> 

                                Swal.fire( {
                        
                                    title:'BAŞARISIZ',
                        
                                    text:'BOŞ GEÇMEYİNİZ !!!',
                        
                                    icon:'success',
                        
                                    showConfirmButton:false,
                        
                                    time:2000 
                        
                                })
                        
                            </script>";
                            }
                            elseif ($kontrol === $adminsifre) {
                                $adminguncelle = $baglanti->prepare("UPDATE `kullanicilar` SET isim = ?,kadi =?, `sifre` = ? WHERE kullanicilar.id =?");
                                $adminguncelle->execute([$adminisim, $adminkadi, $kontrol, 1]);
                                $_SESSION['bilgiupdate'] = "yes";
                                header("Location:adminbilgi");
                            } else {
                                $adminsifre = htmlspecialchars(trim("5645xa" . md5(sha1($_POST['adminsifre'])) . "2023"));

                                $adminguncelle = $baglanti->prepare("UPDATE `kullanicilar` SET isim = ?,kadi =?, `sifre` = ? WHERE kullanicilar.id =?");
                                $adminguncelle->execute([$adminisim, $adminkadi, $adminsifre, 1]);

                                $_SESSION['bilgiupdate'] = "yes";
                                header("Location:adminbilgi");
                            }
                        }


                        ?>
                    </div>

                </div>

            </div>

        </div>



    </main>






    <?php include 'inc/footer.php'; ?>
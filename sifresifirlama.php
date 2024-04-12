<?php



include "./db/db.php";

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="js/sweetalert2.all.min.js"></script>



    <title>Şifre Değiştirme </title>

    <style>
        body {
            background-image: url(assets/img/logo.jpeg);
            background-position: center center;
            background-attachment: fixed;
        }

        /* Genel stil ayarları */


        .col-md-8 {
            margin: 10px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 10px;
            color: #000;
            text-align: center;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }

        .form-group {
            margin-top: 10px;
            color: #000;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            color: #fff;
        }

        /* Telefon ekranı için stiller */
        @media screen and (max-width: 767px) {
            .col-md-8 {
                margin: 0;
                padding: 12px;
                background-color: rgba(255, 255, 255, 0.8);
                border: none;
                border-radius: 0;
                color: #000;
                text-align: left;
            }

            .form-group {
                margin-top: 5px;
            }
        }

        @media screen and (max-width: 767px) {

            /* Örnek stiller */
            body {
                font-family: Arial, sans-serif;
                background-image: url(assets/img/logo.jpeg);
                background-position: center center;
                background-attachment: fixed;
                background-size: cover;
                margin: 0;
                padding: 0;
                text-align: center;
                /* İçeriği yatayda ortala */
            }

            /* Diğer stiller buraya eklenir */
        }

        /* Diğer stiller buraya eklenir */
    </style>

</head>



<body>



    <?php



    $dd = $_GET['activasyonCode'];







    $sor = $baglanti->prepare("SELECT kullanicilar.aktivasyonCode,kullanicilar.aktivasyonSaat,kullanicilar.ogretmenMail,kullanicilar.ogrenciEmail from kullanicilar where aktivasyonCode=:code ");

    $sor->execute(['code' => $dd]);

    if ($sor->rowCount()) {
        $cekveri =  $sor->fetch(PDO::FETCH_ASSOC);
        $saat = $cekveri['aktivasyonSaat'];
        $sure = 3600;

        if (time() - $saat > $sure) {
            $kaktivasyonSure = $baglanti->prepare("UPDATE kullanicilar SET aktivasyonCode=?,aktivasyonSaat=? WHERE

    aktivasyonCode = ?");

            $kaktivasyonSure->execute([null, null, $dd]);



            session_start();

            $_SESSION['aktivasyonSureGecti'] = "yes";

            header("Location:index.php");

            exit();
        }





    ?>






        <div class="container d-flex justify-content-center align-items-center bg-dark text-white" style="height:100vh;opacity: .9;">


            <div class="col-md-8">


                <h2 class="text-center">Şifre Değiştirme</h2>

                <form action="" method="post">



                    <div class="form-group">

                        <b>Yeni Şifre Giriniz <i class="bi bi-key-fill"></i></b>

                        <input type="password" class="form-control" name="password" placeholder="Yeni Şifrenizi girin" required>

                    </div>

                    <div class="form-group">

                        <b>Yeni Şifre Tekrar Giriniz <i class="bi bi-key-fill"></i></b>

                        <input type="password" class="form-control" name="passwordTekrar" placeholder="Yeni Şifrenizi Tekrar girin" required>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="sifreSifirla"><i class="bi bi-save"></i>
                        Kaydet</button>

                </form>

            </div>

        </div>



        <?php



        if (isset($_POST['sifreSifirla'])) {



            $password = htmlspecialchars(trim($_POST['password']));

            $passwordTekrar = htmlspecialchars(trim($_POST['passwordTekrar']));







            if (!$password || !$passwordTekrar) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:' BOŞ GEÇMEYİNİZ', icon:'error',confirmButtonText:'Tamam' })</script>";
            } elseif ($password != $passwordTekrar) {

                echo " <script>  Swal.fire( {title:'Başarısız', text:' ŞİFRELER UYUŞMUYOR', icon:'error',confirmButtonText:'Tamam' })</script>";
            } else {





                $sifre = "5645xa" . md5(sha1($_POST['password'])) . "2023";





                $sifreKontrol = $baglanti->query("SELECT kullanicilar.sifre,kullanicilar.aktivasyonCode FROM kullanicilar WHERE sifre='$sifre'")->fetch();



                if ($sifreKontrol) {

                    echo " <script>  Swal.fire( {title:'Başarısız', text:'LÜFTEN BAŞKA ŞİFRE GİRİNİZ', icon:'error',confirmButtonText:'Tamam' })</script>";
                } else {

                    $kaydet = $baglanti->prepare("UPDATE kullanicilar SET sifre=? WHERE

                aktivasyonCode = ?");



                    $kaydet->execute([$sifre, $dd]);



                    $kaydet2 = $baglanti->prepare("UPDATE kullanicilar SET aktivasyonCode=?,aktivasyonSaat=? WHERE

                aktivasyonCode = ?");

                    $kaydet2->execute([null, null, $dd]);



                    session_start();

                    $_SESSION['sifreDegisti'] = "yes";

                    header("Location:index.php");
                }
            }
        }

        ?>







    <?php } else {





        session_start();

        $_SESSION['AktivasyonYok'] = "yes";

        header("Location:index.php");
    }











    ?>









    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>



</html>
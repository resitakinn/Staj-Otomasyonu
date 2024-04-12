<!DOCTYPE html>

<html>



<head>

    <title>

    ÇIKIŞ YAPILIYOR

    </title>

    <!-- Bootstrap CSS -->

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



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





</head>



<body>

<?php









include 'db/db.php';





session_start();



// Kullanıcı adını oturumdan al

$token = isset($_SESSION['token']) ? $_SESSION['token'] : null;

$kadi = $_SESSION['kadi'];

if ($token) {
 
    // Oturum etkilesini sıfırla

    $sesionsil = $baglanti->prepare("UPDATE kullanicilar SET sesionaktif = ? WHERE kadi = ?");

    $sesionsil->execute([null, $kadi]);


    



    // Oturumu sonlandırma

    session_unset();

    session_destroy();



    $sayi = 3;

    header("Refresh:".$sayi.";url=index");

} else {

    $sayi = 3;

    echo "Oturum bilgisi eksik veya oturum başlatılmamış.";

    header("Refresh:".$sayi.";url=index");

}

?>















    <div class="container p-4">

        <div style="text-align: center">

            <div class="panel panel-default" style="text-align:center !important;">

                <div class="panel-heading"><span id="Label1" style="color:#000040;font-size:12pt;">Oturum Sonlandı</span></div>

                <br />

                <img src="foto.png" alt="">

                <br /><br />

                <span id="lblIcerik" style="font-size:12pt;">

                    <font color=red><br>Çıkış yapılıyor...<br></font>

                </span>

                <br /><br />

                <span id="lblKalanSure" style="color:#CC3300;font-size:25pt;">3</span>

                <span id="Label2" style="font-size:12pt; ">sn içerisinde yönlendirme yapılacak</span>

                <br /><br />

            </div>

        </div>

    </div>









    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>



</html>
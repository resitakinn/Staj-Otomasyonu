<?php 
if($_SESSION['yetki'] != "1" && $_SESSION['yetki'] != "3" ){
    // Yetkisiz kullanıcı uyarısı ve yönlendirme kodları
    echo '<script src="../js/sweetalert2.all.min.js"></script>';
    echo '<script>  Swal.fire({ title: "Yetkisiz Kullanıcı", text: "İZİNSİZ YETKİ ALANINA GİRDİNİZ !!!", icon: "error", confirmButtonText: "Tamam" }).then((value) => {
        if(value.isConfirmed){
            window.location.href = "anasayfa.php";
        }
    })</script>';

    exit;
}


?>
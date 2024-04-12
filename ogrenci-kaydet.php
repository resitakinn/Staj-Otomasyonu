<?php

$title = "Toplu Öğrenci Ekleme";

$menu = "ogrenciTopluEkleme";

ob_start();

include 'inc/head.php';

include 'inc/sidebar.php';

include 'yetki/yetki3kisit.php';

?>


</div>


<br><br><br>
<?php
$bolum = $baglanti->query("SELECT bolumAd,bolumid FROM unibolum WHERE bolumDurum=1 ORDER BY bolumid ASC ");
$bolumcek = $bolum->fetchAll(PDO::FETCH_ASSOC);
$ilgetir = array();

foreach ($bolumcek as $bolumsonuc) {
    $ilgetir[] = $bolumsonuc;
}
if ($_SESSION['yetki'] == 1) {
    $json_bolumler = json_encode($ilgetir);
    $gorev = $baglanti->query("SELECT gorevid,gorevAd FROM gorev ORDER BY `gorev`.`gorevid` ASC");
    $gorevcek = $gorev->fetchAll(PDO::FETCH_ASSOC);
    $gorev = array();
    
    foreach ($gorevcek as $gorevceksonuc) {
        $gorev[] = $gorevceksonuc;
    }
    $json_Gorev = json_encode($gorev);
}
if ($_SESSION['yetki'] == 2) {
    $json_bolumler = json_encode($ilgetir);
    $gorev = $baglanti->query("SELECT gorevid,gorevAd FROM gorev where gorevid = 2 ");
    $gorevcek = $gorev->fetchAll(PDO::FETCH_ASSOC);
    $gorev = array();
    
    foreach ($gorevcek as $gorevceksonuc) {
        $gorev[] = $gorevceksonuc;
    }
    $json_Gorev = json_encode($gorev);
}
?>
<?php
                            $il = $baglanti->query("SELECT * FROM iller");
                            $ilcek = $il->fetchAll(PDO::FETCH_ASSOC);
                            $il = array();
                            foreach ($ilcek as $ilcekK) {
                                $il[] = $ilcekK;
                            }
                          $json_il = json_encode($il);
                          
                            ?>



<div class="container">
    <div class="row">
        <div class="card">
        <fieldset id="formyeri" class="scrollableDiv ">
    <br>
    <div class="text-center">
        <button class="btn bg-primary text-white " id="ekle">SATIR EKLE</button>
    </div>
    <br><br>
    <div class="col-12 p-3">
        <legend class="bg-danger text-white p-3 text-center">Öğrenci ekleme Formu</legend>
        <div id="say"></div>
    </div>
    <br><br>


</fieldset>
<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <button class="btn btn-success" id="kaydet">
            Kaydet
            <div id="loadingGif" style="display:none;">
                <img src="Load.gif" style="width: 60px; height:50px" alt="Yükleniyor...">
            </div>
        </button>

    </div>
</div>


<br><br>
<br>


<div id="sonuc"></div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $("#ekle").click(function() {
        var i = $("#formyeri div").length + 0; // +1 ekleyerek sayıyı artırın
        var div = $('<div/>');
        // var say = ++i;      
        //div.append('<b class="btn bg-dark text-white">' + say + ' KİŞİ </b>');

        div.append('<b>TC: </b> <input type="text" name="ogrenciTc[]" /> ');
        div.append('<b>AD & Soyad : </b> <input type="text" name="ogrenciAdsoyad[]" />');
        div.append('<b>ÖĞRENCİ NUMARA : </b> <input type="text" name="ogrenciOgrNo[]" />');

        var bolumler = <?php echo $json_bolumler; ?>;
        var selectBolum = document.createElement("select");
        selectBolum.name = "ogrenciBolum[]";
        for (var k = 0; k < bolumler.length; k++) {
            var optionBolum = document.createElement("option");
            optionBolum.value = bolumler[k].bolumid;
            optionBolum.text = bolumler[k].bolumAd;
            selectBolum.appendChild(optionBolum);
        }
        div.append('<br><br><b> Bölüm : </b>');
        div.append(selectBolum);

        var kil = <?php echo $json_il; ?>;
        var selectil = document.createElement("select");
        selectil.name = "ogrenciil[]";
        for (var l = 0; l < kil.length; l++) {
            var optionil = document.createElement("option");
            optionil.value = kil[l].il_no;
            optionil.text = kil[l].il_isim;
            selectil.appendChild(optionil);
        }
        div.append('<b> İL : </b>');
        div.append(selectil);

        div.append(
            '<b> ilçe : </b> <select name="ilce[]" > </select>'
        );
        div.append(
            '<b> Sınıf : </b> <select name="ogrenciSinif[]" ><option value="">Sınıf Seçiniz</option><option value="1">1 Sınıf</option>  <option value="2">2 Sınıf</option>  </select>'
        );
        var gorev = <?php echo $json_Gorev; ?>;
        var selectgorev = document.createElement("select");
        selectgorev.name = "kGorev[]";
        for (var j = 0; j < gorev.length; j++) {
            var optiongorev = document.createElement("option");
            optiongorev.value = gorev[j].gorevid;
            optiongorev.text = gorev[j].gorevAd;
            selectgorev.appendChild(optiongorev);
        }
        div.append('<b> Unvan : </b>');
        div.append(selectgorev);
        div.append('<br><br> <b> Şifre : </b> <input type="password" name="ogrenciSifre[]" />');

        var sil = $(
            ' <button class="btn bg-primary text-white" style="margin-left:10px; font-size:15px;">SATIR SİL</button>'
        );


        sil.click(function() {
            if (i > 1) $(this).parent().remove();
        });
        if (i == 1) $("fieldset").after();
        div.append(sil);
        div.append('<hr>');
        $("#formyeri").append(div);

    });
    $(document).on("click", '#kaydet', function() {
        document.getElementById('loadingGif').style.display = 'block';

        setTimeout(function() {
            // GIF'i gizle
            document.getElementById('loadingGif').style.display = 'none';

            $.post("kaydet.php", $('#formyeri').serialize(),
                function(cevap) {
                    $('#sonuc').html(cevap);
                    $('input').val('');
                }, "html");

            $("#kaydet").show();
        }, 2000); // 2 saniye (2000 milisaniye) sonra işlemi başlat
    });

});

// İL DEĞİŞTİRİLDİĞİNDE İLÇELERİ GETİR
$(document).on("change", 'select[name="ogrenciil[]"]', function() {
    var il_idcek = $(this).val();
    var ilce_select = $(this).parent().find('select[name="ilce[]"]');

    // AJAX İSTEĞİ YAP
    $.ajax({
        type: "POST",
        url: "ilcecek.php", // ilçeleri getirecek olan PHP dosyanızın adını buraya yazın
        data: {
            il_idcek: il_idcek
        },
        success: function(cevap) {
            // Gelen cevabı ilçe select'i içine ekle
            ilce_select.html(cevap);
        }
    });
});
</script>



<?php include 'inc/footer.php'; ?>
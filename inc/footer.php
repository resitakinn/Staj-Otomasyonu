<!-- Sistemde Aktif Olanlar Açılır Pencere -->



<!-- Aktif Kişiler Kutusu -->
<!-- Açma Butonu -->

<?php 


if ($title != "Ops!!") { ?>
    <div class="aktif-kisiler card">


    <div>
        <h4 class="text-center">Sistemde Aktif Kişiler</h4>
        <ul>
            <?php
            $cek = $baglanti->prepare("SELECT kullanicilar.sesionaktif,kullanicilar.kFoto,kullanicilar.isim FROM kullanicilar ");
            $cek->execute();

            $say = 0;
            $ceksesion = $cek->fetchAll(PDO::FETCH_ASSOC);
            foreach ($ceksesion as $variabla) {
                $sesion = $variabla['sesionaktif'];
                $foto = $variabla['kFoto'];
                $isim = $variabla['isim'];

                if ($sesion == true) {
                    $say = ++$say; ?>

                    <li style="list-style-type: none; display: flex; align-items: center;">
                        <img src="
        <?php
                    if ($foto == 0 or $foto == null) {
                        echo "assets/img/user.png";
                    } else {
                        echo "assets/ogrencifoto/" . $foto;
                    }
        ?>" style="width: 25%; border-radius: 50%;">

                        <span style="flex: 1; padding-left: 10px;"><?= $isim ?> <i class="fas fa-check text-success"></i></span>
                        
                    </li>
                    <br>
            <?php }
            }
            ?>

            <!-- Diğer kullanıcıları buraya ekleyebilirsiniz -->
        </ul>

    </div>




</div>




<div class="text-center">
    <div class="ac-buton " style=" cursor:pointer;">
        <i class="fas fa-eye"></i>
        <?php

        if ($say == 0) { ?>

            <b style="font-weight: 900; color:black ;text-decoration:underline;">ŞUAN SİSTEMDE AKTİF KİŞİ YOKTUR</b>

        <?php  } else { ?>
            SİSTEMDE AKTİF KİŞİLERİ GÖR <b style="font-weight: 900; color:black ;text-decoration:underline;">ŞUAN AKTİF SAYISI</b> ( <b style="font-weight: 900; color:black"> <?= $say ?> </b> )

        <?php     }


        ?>
    </div>
    <!-- Kapatma Butonu -->
    <div class="kapat-buton active" style=" display: none; cursor:pointer;">
        <i class="fas fa-eye-slash"></i> Sistemde Aktif Kişi Sekmesi Kapat
    </div>


</div>
 
<?php  }

?>



<footer class="py-4 bg-light mt-auto <?php if ($title == "Ops!!" || $title == "Öğrenci Kaydet") {
                                            echo "fixed-bottom";
                                        }   ?>">
    <div class="container-fluid px-4 d-flex  justify-content-between">
        <div class=" small">
            <div class="text-muted">Copyright &copy; <?= date("Y") ?> </div>





        </div>
        <div class="">
            <?php
            $kurucu = "Mehmet Reşit Akın";
            echo  "Tasarım" . " : " .  $kurucu;
            ?>
        </div>
    </div>
    </div>
</footer>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/rg-1.0.0/datatables.min.js"></script>
<!-- Gerekli JavaScript kütüphaneleri -->
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- Optional JavaScript -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Açma butonuna tıklanınca kutuyu göster
        $(".kural-aktif").hide();

        $(".ac-kural").click(function() {
            $(".kural-aktif").show();
            $(".ac-kural").hide();
            $(".kapat-kural").show();
        });

        // Kapatma butonuna tıklanınca kutuyu gizle
        $(".kapat-kural").click(function() {
            $(".kural-aktif").hide();
            $(".ac-kural").show();
            $(".kapat-kural").hide();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Açma butonuna tıklanınca kutuyu göster

        $(".aktif-kisiler").hide();
        $(".ac-buton").click(function() {
            $(".aktif-kisiler").show();
            $(".ac-buton").hide();
            $(".kapat-buton").show();
        });

        // Kapatma butonuna tıklanınca kutuyu gizle
        $(".kapat-buton").click(function() {
            $(".aktif-kisiler").hide();
            $(".ac-buton").show();
            $(".kapat-buton").hide();
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('#myTable').wrap("<div style='\n\
     overflow: auto;\n\
     overflow-y: hidden;\n\
     -ms-overflow-y: hidden\n\
     position:relative;\n\
     margin-right:5px;\n\
     padding-bottom: 15px;\n\
     display:block;\n\
 '>/");
    });
    $('#myTable').DataTable({
        responsive: true,
        language: {
            info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
            infoEmpty: "Gösterilecek hiç kayıt yok.",
            loadingRecords: "Kayıtlar yükleniyor.",
            zeroRecords: "Tablo boş",
            search: "Arama:",
            infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
            buttons: {
                copyTitle: "Panoya kopyalandı.",
                copySuccess: "Panoya %d satır kopyalandı",
                copy: "Kopyala",
                print: "Yazdır",
            },

            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        responsive: true
    });
</script>
<script>
    $(document).ready(function() {
        $('#ogretmenTable').wrap("<div style='\n\
     overflow: auto;\n\
     overflow-y: hidden;\n\
     -ms-overflow-y: hidden\n\
     position:relative;\n\
     margin-right:5px;\n\
     padding-bottom: 15px;\n\
     display:block;\n\
 '>/");
    });
    $('#ogretmenTable').DataTable({
        responsive: true,
        language: {
            info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
            infoEmpty: "Gösterilecek hiç kayıt yok.",
            loadingRecords: "Kayıtlar yükleniyor.",
            zeroRecords: "Tablo boş",
            search: "Arama:",
            infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
            buttons: {
                copyTitle: "Panoya kopyalandı.",
                copySuccess: "Panoya %d satır kopyalandı",
                copy: "Kopyala",
                print: "Yazdır",
            },

            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        responsive: true
    });
</script>

<script>
    $(document).ready(function() {
        $('#stajOnay').wrap("<div style='\n\
     overflow: auto;\n\
     overflow-y: hidden;\n\
     -ms-overflow-y: hidden\n\
     position:relative;\n\
     margin-right:5px;\n\
     padding-bottom: 15px;\n\
     display:block;\n\
 '>/");
    });
    $('#stajOnay').DataTable({
        responsive: true,

        language: {
            "sEmptyTable": "Tabloda herhangi bir veri mevcut değil",
            "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty": "Kayıt yok",
            "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing": "İşleniyor...",
            "sSearch": "Ara:",
            "sZeroRecords": "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                "sFirst": "İlk",
                "sLast": "Son",
                "sNext": "Sonraki",
                "sPrevious": "Önceki"
            },
            "oAria": {
                "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
            },

        },


        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        responsive: true,
    });
</script>

<script>
    $(document).ready(function() {
        $('#stajDefterOnay').wrap("<div style='\n\
     overflow: auto;\n\
     overflow-y: hidden;\n\
     -ms-overflow-y: hidden\n\
     position:relative;\n\
     margin-right:5px;\n\
     padding-bottom: 15px;\n\
     display:block;\n\
 '>/");
    });
    $('#stajDefterOnay').DataTable({
        responsive: true,
        language: {
            "sEmptyTable": "Tabloda herhangi bir veri mevcut değil",
            "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty": "Kayıt yok",
            "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing": "İşleniyor...",
            "sSearch": "Ara:",
            "sZeroRecords": "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                "sFirst": "İlk",
                "sLast": "Son",
                "sNext": "Sonraki",
                "sPrevious": "Önceki"
            },
            "oAria": {
                "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
            },

        },


        lengthMenu: [10, 25, 50, 100],
        pageLength: 10
    });
</script>

<script>
        $(document).ready(function() {
            $('#ogrenci-bolum-listele').wrap("<div style='\n\
     overflow: auto;\n\
     overflow-y: hidden;\n\
     -ms-overflow-y: hidden\n\
     position:relative;\n\
     margin-right:5px;\n\
     padding-bottom: 15px;\n\
     display:block;\n\
 '>/");
        });
        $('#ogrenci-bolum-listele').DataTable({
            responsive: true,
            language: {
                info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                infoEmpty: "Gösterilecek hiç kayıt yok.",
                loadingRecords: "Kayıtlar yükleniyor.",
                zeroRecords: "Tablo boş",
                search: "Arama:",
                infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
                buttons: {
                    copyTitle: "Panoya kopyalandı.",
                    copySuccess: "Panoya %d satır kopyalandı",
                    copy: "Kopyala",
                    print: "Yazdır",
                },

                paginate: {
                    first: "İlk",
                    previous: "Önceki",
                    next: "Sonraki",
                    last: "Son"
                },
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            responsive: true
        });
    </script>




</body>

</html>
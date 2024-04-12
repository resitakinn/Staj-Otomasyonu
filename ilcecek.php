<?php

   include ("db/db.php");


 

   if(isset($_POST['il_idcek'])) {
    $il_id = $_POST['il_idcek'];
    if ($il_id > 0 ) {
        $ilce_sorgu = $baglanti->query("SELECT * FROM ilceler WHERE il_no = $il_id");
    $ilcecek = $ilce_sorgu->fetchAll(PDO::FETCH_ASSOC);
    
    $ilce_options = '<option value="">İlçe Seçiniz</option>';
    
    foreach ($ilcecek as $ilce) {
        $ilce_options .= '<option value="' . $ilce['ilce_no'] . '">' . $ilce['ilce_isim'] . '</option>';
    }
    
    echo $ilce_options;
    exit();
    }
 
}



$ogretmenil = $_POST['ilid'];

$ogrenciil = $_POST['il'];

$ogrenciilguncelle = $_POST['ilcek'];
$ogrenciilguncellee = $_POST['ill'];






    $ilcecek = $baglanti->query("SELECT * FROM 
    ilceler WHERE
     il_no = '$ogretmenil' or
      il_no = '$ogrenciil' or
       il_no = '$ogrenciilguncelle' or
        il_no = '$ogrenciilguncellee' "); 

    $ilcecek -> execute(); 



    foreach ($ilcecek as $cekil ){

            

     

        ?>



<option value="<?php echo  $cekil['ilce_no']?>" ><?php echo  $cekil['ilce_isim']?></option>



<?php } ?>








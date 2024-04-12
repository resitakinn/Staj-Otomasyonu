<?php

$host = 'Localhost'; //localhost

$dbname = 'u1034550_stajotomasyon';

$username = 'root';

$password = '';

$charset = 'utf8';

$collate = 'utf8_turkish_ci';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [

    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

    PDO::ATTR_PERSISTENT => false,

    PDO::ATTR_EMULATE_PREPARES => false,

    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"

];

try {

    $baglanti = new PDO($dsn, $username, $password, $options);

    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //  echo"Veri Tabanı Bağlantısı Başarılı";

} catch (PDOException $baglanti) {

    echo 'Bağlantı hatası: ' . $baglanti->getMessage();

    exit;

}





?>
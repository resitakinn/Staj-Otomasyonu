<?PHP

$image = @imagecreatetruecolor(120, 30) or die("hata oluştu");

// arkaplan rengi oluşturuyoruz
$background = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
imagefill($image, 0, 0, $background);
$linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
$textcolor = imagecolorallocate($image, 0x33, 0x33, 0x33);

// rast gele çizgiler oluşturuyoruz
for ($i = 0; $i < 6; $i++) {
    imagesetthickness($image, rand(1, 3));
    imageline($image, 0, rand(0, 30), 120, rand(0, 30), $linecolor);
}

session_start();

// rastgele sayılar oluşturuyoruz
$sayilar = '';
for ($x = 15; $x <= 95; $x += 20) {
    $sayilar .= ($sayi = rand(0, 9));
    imagechar($image, rand(3, 5), $x, rand(2, 14), $sayi, $textcolor);
}

// sayıları session aktarıyoruz
$_SESSION['captcha'] = $sayilar;

// resim gösteriliyor ve sonrasında siliniyor
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
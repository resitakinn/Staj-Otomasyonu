# Staj-Otomasyonu
![Staj Otomasyonu](https://github.com/resitakinn/Staj-Otomasyonu/blob/main/assets/img/ekran.png)
## Projenin Amacı

Yaptıgım Proje Bir staj otomasyonu projesidir güncel hayatta harcanan kağıt israfını bir nebze olsada engellemek adına boyle bir proje hayata gecirmek istedim projenin detaylı anlatım videosu bağlantıya tıklayarak  Görebilirsiniz...
[Youtube Video](https://youtu.be/qcpeupRXOVA)
## Projenin özellikleri 
proje 3 türlü yetki sistemi var Admin , Öğretmen ve Öğrenci Olarak öğretmen staj takvimini açmadan öğrenci hiçbir şekilde sisteme müdahale edemez gerekli kod güvenlikleri ile kodladığım bir sistemdir.<br/>
Staj Otomasyonu admin rolündeki ise olası bir sistem hatasında anında müdahale edilmek için gerekli kullanıcıdır.<br/>
sistemde şifre unuttum bölümüde yer almaktadır.<br/>
sistemi kolaylıkla acabilirisiniz tüm dosyaları paylaştım ilgilenen arkadaşlara teşekkür ederim...<br/>
### Admin Giriş Bilgileri
**kullanıcı Adı: 512145**<br/>
**kullanıcı Şifre : 12345**

#### Projenin kurulumu
Projeyi önce bilgisayarınıza indirin <br/>
Xampp kurulumu bilgisayarınızda yüklü olsun<br/>
İndirdiğiniz projeyi htdocs klasörüne yükleyin xampp dizininde <br/>
dosyanin içindr SQL dosyası var onu phpmyadmin de kurulumu yapın ve localde çalıştırın kendinize göre ayarlama yapınız..

## Xampp Captacha ( Güvenlik Resmi ) Sorunu Çözümü
Captcha güvenlik kodu gözükmüyorsa GD kütüphanesi aktif değildir o yüzden gözükmez. <br/>
Aktif etmek için C:\xampp\php dizininden (Ben xampp kullandığım için php dosyası burada siz ne kullanıyorsanız oradan ulaşın) php.ini dosyasını açıp içinde CTRL + F ile "gd" diye aratın ";extension=gd" gibi bir ifade olacaktır. <br/>
Önündeki ";" işaretini kaldırıp dosyayı kaydedin. Daha sonra xammp'dan sunucuyu stop tuşuna basarak durdurun. <br/>
Tekrar Start  açtığınızda Captcha güvenlik kodu gözükecektir. <br/>
Staj Otomasyonu

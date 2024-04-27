## Projenin Amacı

Proje Amaçları:

Bu staj otomasyonu projesinin amacı, staj sürecini yönetmek ve izlemek için bir çevrimiçi platform sağlamaktır. Projenin ana hedefleri şunlardır:

1. Staj Sürecini Kolaylaştırmak: Öğrencilerin staj başvuru sürecini kolaylaştırmak ve stajyerlerin stajyerlik sürecini takip etmelerine olanak tanımak.
2. İş Verimliliğini Artırmak: Stajyerlik sürecinin yönetimini otomatize ederek, stajyerleri, stajyer danışmanlarını ve işverenleri daha verimli bir şekilde bir araya getirmek ve iletişimi artırmak.
3. Veri Analizi ve İzleme: Stajyerlerin performansını izlemek, değerlendirmek ve raporlamak için veri analizi araçları sunmak. Bu, stajyerlerin gelişimini değerlendirmek ve stajyerlik deneyimini iyileştirmek için önemli bir araç sağlayacaktır.
4. Gelişen Bir Topluluk Oluşturmak: Öğrenciler, öğretim üyeleri ve işverenler arasında etkileşimi teşvik ederek, stajyerlik sürecini bir topluluk deneyimine dönüştürmek ve karşılıklı öğrenmeyi teşvik etmek.
5. Bu amaçlar doğrultusunda, staj otomasyonu projesi, staj sürecini daha verimli, şeffaf ve etkili hale getirmeyi ve stajyerlerin profesyonel gelişimlerine katkıda bulunmayı hedeflemektedir.
[Youtube Video](https://youtu.be/qcpeupRXOVA)
## Projenin özellikleri 
proje 3 türlü yetki sistemi var Admin , Öğretmen ve Öğrenci Olarak öğretmen staj takvimini açmadan öğrenci hiçbir şekilde sisteme müdahale edemez gerekli kod güvenlikleri ile kodladığım bir sistemdir.<br/>
Staj Otomasyonu admin rolündeki ise olası bir sistem hatasında anında müdahale edilmek için gerekli kullanıcıdır.<br/>
sistemde şifre unuttum bölümüde yer almaktadır.<br/>
sistemi kolaylıkla acabilirisiniz tüm dosyaları paylaştım ilgilenen arkadaşlara teşekkür ederim...<br/>
### Admin Giriş Bilgileri
**kullanıcı Adı: 512145**<br/>
**kullanıcı Şifre : 123456**

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
## Ekran Görüntüsü

![Staj Otomasyonu](https://github.com/resitakinn/Staj-Otomasyonu/assets/103512411/bae5b191-3d74-4439-8bc3-bc55e5c1578e)

Staj Otomasyonu

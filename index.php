<?php
date_default_timezone_set('Europe/Istanbul');
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
function getIPInfo($ip) {
    $url = "http://ip-api.com/json/$ip?fields=status,country,city";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response !== false) {
        $data = json_decode($response, true);
        if ($data['status'] === 'success') {
            return [$data['country'], $data['city']];
        }
    }
    return ['Bilinmiyor', 'Bilinmiyor'];
}
$ip = getUserIP();
list($country, $city) = getIPInfo($ip);
$browser = $_SERVER['HTTP_USER_AGENT'] ?? 'Bilinmiyor';
$referer = $_SERVER['HTTP_REFERER'] ?? 'Direkt erişim';
$time = date("Y-m-d H:i:s");
// SQLite kayıt
$db = new SQLite3('data.db');
$db->exec("CREATE TABLE IF NOT EXISTS visitors (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ip TEXT,
    country TEXT,
    city TEXT,
    browser TEXT,
    referer TEXT,
    time TEXT,
    label TEXT
)");

$stmt = $db->prepare("INSERT INTO visitors (ip, country, city, browser, referer, time) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bindValue(1, $ip);
$stmt->bindValue(2, $country);
$stmt->bindValue(3, $city);
$stmt->bindValue(4, $browser);
$stmt->bindValue(5, $referer);
$stmt->bindValue(6, $time);
$stmt->execute();
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
   <!-- Favicon ve Apple/Android ikonları -->
<link rel="apple-touch-icon" sizes="180x180" href="https://sporcuyuz.com.tr/uploads/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://sporcuyuz.com.tr/uploads/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://sporcuyuz.com.tr/uploads/favicon-16x16.png">
<link rel="manifest" href="https://sporcuyuz.com.tr/uploads/site.webmanifest">
<link rel="icon" href="https://sporcuyuz.com.tr/uploads/favicon.ico" type="image/x-icon">
  <link rel="icon" href="logo.png">
<title>Fitness ve Beslenme Rehberi | Kalori, Diyet, Supplement Bilgileri</title>
<meta name="description" content="Spor ve beslenme dünyasına dair her şey: Kalori hesaplama, supplementler, kahvaltı önerileri, sağlıklı yağlar ve kişisel antrenman programları.">
<meta name="keywords" content="fitness, kalori hesaplama, sporcu beslenmesi, supplement nedir, diyet önerileri, sağlıklı yağlar, spor, protein tozları, antrenman programı">

<meta name="author" content="Efehan">
<meta property="og:title" content="Fitness ve Beslenme Rehberi">
<meta property="og:description" content="Fitness yolculuğunda ihtiyaç duyduğun tüm bilgileri burada bul. Supplementler, diyet, antrenman, kalori hesaplama ve çok daha fazlası.">
<meta property="og:image" content="https://sporcuyuz.com.tr/resimler/kahvalti.png"> <!-- Sitede bulunan görsellerden biri -->
<meta property="og:url" content="https://sporcuyuz.com.tr">
<meta property="og:type" content="website">
<meta name="theme-color" content="#1abc9c">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    
</head>
<body>
    <div class="menu-container">
    <div class="hamburger-menu" onclick="toggleMenu()">
    <span class="material-symbols-outlined">menu</span>
    <span class="menu-text">Menü</span>
</div>
    <nav class="menu">
        <a href="index.php" class="logo"><img src="resimler/logo.png" alt="Logo"></a>
        <a href="diyet.php">Diyet Hakkında</a>
        <a href="kalorihesap.php">Kalori Hesaplayıcı</a>
        <a href="antrenmanlar.php">Antrenman Programı</a>
        <a href="supplementler.php">Supplementler</a>
        <a href="iletisim.php">İletişim & Koçluk</a>
        <a href="programim.php">Kendi Programım</a>
        </nav>
    </div>


    <div class="container">
        <h1 style="text-align: center;">Hoş Geldin Sporcu!</h1>
        <p>Fitness yolculuğunda sana rehberlik etmek için buradayız. İster yeni başla, ister deneyimli bir sporcu ol, sitemizde hedeflerine ulaşman için ihtiyacın olan her şeyi bulacaksın. Antrenman programları, beslenme ipuçları, kalori hesaplaması ve daha fazlası seni bekliyor!</p>
<div class="image-placeholder"><img src="resimler/salonn.png"></div>
<h2>Kalori Hesabı Nedir?</h2>

<p>
Kalori hesabı, gün boyunca vücuduna aldığın ve harcadığın enerjiyi takip etmene yarayan etkili bir yöntemdir. Kilo vermek, almak ya da korumak isteyen herkes için bu hesaplama büyük önem taşır.
</p>

<h3>Kalori Hesabı Nasıl Yapılır?</h3>

<p>
Her bireyin günlük kalori ihtiyacı farklıdır. Bu ihtiyaç; yaş, cinsiyet, kilo, boy ve fiziksel aktivite düzeyine göre belirlenir 🧠. Temel mantık oldukça basit:
</p>

<ul>
  <li>Alınan kalori harcanandan fazla ise → kilo alırsın 🍰</li>
  <li>Alınan kalori harcanandan az ise → kilo verirsin 🏃</li>
  <li>Alınan ve harcanan kalori eşitse → kilon sabit kalır ⚖️</li>
</ul>

<p>
Kalori takibi yapmak, sadece kilo kontrolü sağlamakla kalmaz, aynı zamanda farkında olmadan fazla kalori tüketmeni de engeller. Ne yediğini bilmek, beslenme bilincini artırır 🥗.
</p>

<h3>Kalorini Nasıl Hesaplarsın?</h3>

<p>
Kalorini doğru bir şekilde hesaplamak için karmaşık formüllere ihtiyacın yok. Senin için özel hazırladığımız <a href="kalorihesap.php">kalori hesaplama aracı</a> ile bunu saniyeler içinde yapabilirsin ⚡.
</p>

<p>
Sağlıklı bir beslenme planı oluşturmak, doğru kalori dengesiyle başlar. Unutma, amaç sadece sayıları takip etmek değil, vücudunun neye ihtiyaç duyduğunu öğrenmektir 💚.
</p>
<h2>Antrenman Programları Ne İşe Yarar?</h2>
      <p>Fitness hedeflerine ulaşmak için antrenman programı seçmek oldukça önemli. Çünkü bu programlar, antrenmanlarını daha organize ve verimli hale getirir. Rastgele egzersiz yapmak yerine, belirli bir plana bağlı kalmak, ilerlemeni takip etmeni kolaylaştırır ve motivasyonunu artırır. Ayrıca, farklı kas gruplarını dengeli bir şekilde çalıştırmanı sağlayarak sakatlanma riskini azaltır. Kısacası, antrenman programı, fitness yolculuğunda sana bir yol haritası sunar.
        Bu programlar kaslarını güçlendirmeye, dayanıklılığını artırmaya, kilo vermeye veya genel sağlığını iyileştirmeye yarar. Örneğin, Tam Vücut Antrenmanı, Bölgesel Antrenman, HIIT (Yüksek Yoğunluklu Aralıklı Antrenman) ve Fonksiyonel Antrenman gibi farklı program türleri bulunur. Detaylar için "Antrenman Programı" menümüzü ziyaret et!
      </p>
      
        <!-- Mobil reklam alanı -->
        <div class="mobile-ad">Reklam Alanı</div>
        <h2>Kahvaltıda Ne Yemeliyiz?</h2>

<p>
Kahvaltı, günün ilk ve belki de en önemli öğünü ☀️. Vücudun gece boyu aç kaldıktan sonra enerjiye ihtiyaç duyar, bu yüzden kahvaltıda alacağın besinler tüm gününü etkileyebilir.
</p>

<p>
Dengeli bir kahvaltı, üç temel makro besin öğesini içermelidir: protein, karbonhidrat ve sağlıklı yağlar. Bu üçlü bir araya geldiğinde, hem tokluk süren uzar hem de enerji seviyen dengede kalır 💪.
</p>

<p>
Karbonhidratlar, kahvaltıda sana hızlı enerji sağlar. Ancak burada dikkat edilmesi gereken nokta, "temiz" karbonhidratlara yönelmektir. Yani beyaz ekmek ya da şekerli ürünler yerine tam tahıllı ekmek, yulaf gibi kompleks karbonhidratlar tercih edilmeli 🍞.
</p>

<p>
Protein kaynağı olarak yumurta, peynir veya yoğurt gibi besinler, kas onarımını desteklerken tokluk hissini de artırır 🥚. Birkaç zeytin, avokado ya da cevizle sağlıklı yağları da tabağına eklediğinde, dengeli ve güçlü bir kahvaltı seni güne hazır hale getirir.
</p>

<p>
Kahvaltını sade bir peynir-zeytin tabağıyla yapabileceğin gibi, biraz yulaf ve meyveyle de hafif ama doyurucu bir seçenek oluşturabilirsin. Önemli olan: dengede kalmak 💚.
</p>

        <div class="image-placeholder"><img src="resimler/kahvalti.png"></div>


        <h2>Diyette Ne Yemeliyiz? (Sporcunun Hedefine Göre)</h2>

<p>
Diyette en önemli şey, dengeli ve yeterli beslenmeyi sürdürebilmektir 🍴. Her vücudun ihtiyacı farklıdır; bu yüzden alınan protein, karbonhidrat ve yağ oranlarının kişisel hedeflere göre ayarlanması gerekir. 
</p>

<p>
Lifli ve besleyici gıdalar, hem uzun süre tok kalmanı sağlar hem de enerji seviyeni korur 💪. Ayrıca sağlıklı bir kilo yönetimi için porsiyon kontrolü yapılmalı, şekerli ve işlenmiş gıdalardan mümkün olduğunca uzak durulmalıdır 🚫🍬.
</p>

<h3>Hedefine Göre Gereken Gıdalar:</h3>

<ul>
  <li>
    <strong>Kilo Almak İsteyenler İçin 🍞🍌:</strong><br>
    Tam yağlı süt, pirinç, fıstık ezmesi, kuru meyveler, zeytinyağı, tam buğday ekmeği, yumurta.
  </li><br>
  
  <li>
    <strong>Kilo Vermek İsteyenler İçin 🥦🥚:</strong><br>
    Yumurta, lor peyniri, tavuk göğsü, yulaf ezmesi, yeşil sebzeler, avokado, yoğurt, hindi füme.
  </li><br>

  <li>
    <strong>Kilosunu Korumak İsteyenler İçin 🐟🍎:</strong><br>
    Balık veya tavuk eti, pirinç, kefir, sebze ve meyve çeşitleri, zeytinyağı, yulaf, fındık.
  </li>
</ul>

<p>
Unutma, her hedef için temel prensip: düzenli ve dengeli beslenme. Hedefine uygun gıdaları seç, porsiyonlarını bil ve sürdürülebilir bir şekilde ilerle 💚.
</p>


<h2>Yağlar Dost mu Düşman mı?</h2>

<p>
Yağ denince çoğu kişi uzak durmak istiyor ama aslında her yağ kötü değil 🫒. Vücudun ihtiyaç duyduğu sağlıklı yağlar sayesinde hormon dengesi kurulur, bağışıklık sistemi desteklenir ve enerji seviyesi korunur ⚡.
</p>

<p>
Tabii ki her yağ dost değil. Özellikle işlenmiş ve trans yağ içeren ürünler, kalp-damar sağlığı için risk oluşturabilir. Bu nedenle yağları "iyi" ve "kötü" diye ayırmak önemli 💡.
</p>

<h3>🟢 Sağlıklı Yağlar (Dostlarımız):</h3>
<ul>
  <li>Zeytinyağı </li>
  <li>Avokado yağı 🥑</li>
  <li>Balık yağları (somon, uskumru) 🐟</li>
  <li>Ceviz, badem gibi kuruyemişler 🥜</li>
  <li>Keten tohumu ve chia tohumu 🌱</li>
</ul>

<h3>🔴 Zararlı Yağlar:</h3>
<ul>
  <li>Trans yağlar (kızartmalar, margarinler, paketli atıştırmalıklar)</li>
  <li>Doymuş yağlar (işlenmiş etler, palm yağı, bazı fast food ürünleri)</li>
  <li>Paketli kekler, kurabiyeler, cipsler, hazır dondurulmuş ürünler, soslar 🧁🍟</li>
</ul>

<p>
Sonuç olarak yağlar ne tamamen kötü ne de tamamen iyi — doğru türde ve doğru miktarda tüketildiğinde, sağlığın vazgeçilmez bir parçasıdır 💚.
</p>


        <h2>Supplement Nedir?</h2>
        <p>Supplement, besin takviyesi anlamına gelir ve günlük beslenme ile yeterince alınamayan vitamin, mineral, amino asit gibi maddeleri takviye etmek için kullanılan ürünlerdir; genellikle tablet, kapsül,veya toz formda bulunurlar. Daha fazla bilgi için "supplementler" menüsünü ziyaret et!</p>
        <div class="supplement-resimleri">
            <div class="image-placeholder"><img src="resimler/protein.png"></div>
            <div class="image-placeholder"><img src="resimler/gainer.png"></div>
            <div class="image-placeholder"><img src="resimler/preworkout.png"></div>
            <div class="image-placeholder"><img src="resimler/creatine.png"></div></div>
        </div>
        
    
    </div>
    <div class="footer">
    <a href="hakkimizda.php" target="_blank">Hakkımızda</a>
        <a href="gizlilik.php" target="_blank">Gizlilik Politikası</a>
        <a href="telif.php" target="_blank">Telif Hakları</a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menu = document.querySelector(".menu");
            const hamburger = document.querySelector(".hamburger-menu");
    
            hamburger.addEventListener("click", function () {
                menu.classList.toggle("show");
            });
        });
    </script>

    
</body>
</html>

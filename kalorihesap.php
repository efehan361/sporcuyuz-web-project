<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalori Hesaplama Aracı | Günlük Kalori ve Makro Hesaplayıcı | sporcuyuz.com.tr</title>

<meta name="description" content="Kalori ihtiyacınızı kolayca hesaplayın! Yaş, cinsiyet, boy, kilo ve egzersiz seviyenize göre günlük almanız gereken kaloriyi ve makro dağılımını öğrenin.">
<meta name="keywords" content="kalori hesaplama, günlük kalori ihtiyacı, makro hesaplama, beslenme, sporcu kalorisi, kilo verme, kilo alma, bmr hesaplama, kalori ihtiyacı, kalori hesaplayıcı">
<meta name="author" content="sporcuyuz.com.tr">
<meta name="robots" content="index, follow">

<meta property="og:title" content="Kalori Hesaplayıcı | Günlük Kalori ve Makro Hesaplama">
<meta property="og:description" content="Vücut tipinize özel kalori ihtiyacınızı saniyeler içinde hesaplayın. Kilo almak, vermek ya da korumak isteyenler için ideal.">
<meta property="og:url" content="https://sporcuyuz.com.tr/kalorihesap.php">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary">

<link rel="canonical" href="https://sporcuyuz.com.tr/kalorihesap.php">
   <!-- Favicon ve Apple/Android ikonları -->
<link rel="apple-touch-icon" sizes="180x180" href="https://sporcuyuz.com.tr/uploads/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://sporcuyuz.com.tr/uploads/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://sporcuyuz.com.tr/uploads/favicon-16x16.png">
<link rel="manifest" href="https://sporcuyuz.com.tr/uploads/site.webmanifest">
<link rel="icon" href="https://sporcuyuz.com.tr/uploads/favicon.ico" type="image/x-icon">
  <link rel="icon" href="resimler/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="yazitipleri.css">
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


    
    <div class="ad-container ad-left">Reklam Alanı</div>
    <div class="ad-container ad-right">Reklam Alanı</div>
    
    <div class="container">
        <h1>Kalori Hesaplayıcı</h1>
         <p>Kaloi hesaplayıcı güncellendi! Bilimsel olarak günlük makro alımınızı öğrenebilirsiniz.</p>
        <form id="kaloriForm">
            <div class="form-group">
                <label for="cinsiyet">Cinsiyet:</label>
                <select id="cinsiyet" required>
                    <option value="erkek">Erkek</option>
                    <option value="kadin">Kadın</option>
                </select>
            </div>
            <div class="form-group">
                <label for="yas">Yaş:</label>
                <input type="number" id="yas" required>
            </div>
            <div class="form-group">
                <label for="boy">Boy (cm):</label>
                <input type="number" id="boy" required>
            </div>
            <div class="form-group">
                <label for="kilo">Kilo (kg):</label>
                <input type="number" id="kilo" required>
            </div>
            <div class="form-group">
                <label for="egzersiz">Egzersiz Sıklığı:</label>
                <select id="egzersiz">
                    <option value="1.2">Hareketsiz </option>
                    <option value="1.375">Hafif egzersiz (Haftada 1-3)</option>
                    <option value="1.55">Orta seviye (Haftada 3-5)</option>
                    <option value="1.725">Yoğun (Haftada 6-7)</option>
                    <option value="1.9">Çok yoğun (Profosyonel)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hedefiniz:</label>
                <input type="radio" name="hedef" value="500"checked> Kilo Almak
                <input type="radio" name="hedef" value="-500" > Kilo Vermek
                <input type="radio" name="hedef" value="0"> Kilo Korumak
                
            </div>
            <button type="submit">Hesapla</button>
        </form>
        <div class="results" id="sonuc"></div>
    </div>
      <!-- Mobil reklam alanı -->
 <div class="mobile-ad">Reklam Alanı</div>
 <script>
document.getElementById("kaloriForm").addEventListener("submit", function(event) {
    event.preventDefault();

    // Form verilerini al
    let cinsiyet = document.getElementById("cinsiyet").value;
    let yas = parseInt(document.getElementById("yas").value);
    let boy = parseInt(document.getElementById("boy").value);
    let kilo = parseInt(document.getElementById("kilo").value);
    let egzersiz = parseFloat(document.getElementById("egzersiz").value);
    let hedef = parseInt(document.querySelector('input[name="hedef"]:checked').value);
    let bmr;

    // BMR hesapla (Mifflin-St Jeor formülü)
    if (cinsiyet === "erkek") {
        bmr = 10 * kilo + 6.25 * boy - 5 * yas + 5;
    } else {
        bmr = 10 * kilo + 6.25 * boy - 5 * yas - 161;
    }

    let gunlukKalori = (bmr * egzersiz) + hedef;

    // Hedefe göre protein gramını belirle (kg başına)
    let proteinGram;
    if (hedef > 0) {
        proteinGram = kilo * 1.8; // Kilo almak
    } else if (hedef < 0) {
        proteinGram = kilo * 2.2; // Kilo vermek
    } else {
        proteinGram = kilo * 1.6; // Kilo korumak
    }

    let proteinKalori = proteinGram * 4;

    // Yağ: Toplam kalorinin %25’i
    let yagKalori = gunlukKalori * 0.25;
    let yagGram = yagKalori / 9;

    // Karbonhidrat: Kalan kalorinin tamamı
    let karbonhidratKalori = gunlukKalori - (proteinKalori + yagKalori);
    let karbonhidratGram = karbonhidratKalori / 4;

    // Sonuçları yazdır
    document.getElementById("sonuc").innerHTML = `
        <div class='result-box'>Günlük Kalori: ${Math.round(gunlukKalori)} kcal</div>
        <div class='result-box'>Protein: ${proteinGram.toFixed(1)} g (${Math.round(proteinKalori)} kcal)</div>
        <div class='result-box'>Yağ: ${yagGram.toFixed(1)} g (${Math.round(yagKalori)} kcal)</div>
        <div class='result-box'>Karbonhidrat: ${karbonhidratGram.toFixed(1)} g (${Math.round(karbonhidratKalori)} kcal)</div>`;
});
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menu = document.querySelector(".menu");
            const hamburger = document.querySelector(".hamburger-menu");
    
            hamburger.addEventListener("click", function () {
                menu.classList.toggle("show");
            });
        });
    </script>
     <div class="footer">
     <a href="hakkimizda.php" target="_blank">Hakkımızda</a>
        <a href="gizlilik.php" target="_blank">Gizlilik Politikası</a>
        <a href="telif.php" target="_blank">Telif Hakları</a>
    </div>
    
</body>
</html>
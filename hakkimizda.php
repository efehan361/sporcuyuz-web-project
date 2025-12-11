<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=600, user-scalable=no">
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
    <link rel="stylesheet" href="style.css">
    <title>Hakkımızda</title>
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
        <h1>Hakkımızda</h1>
<p>Sporcuyuz, 11 Mart tarihinde fitness ve gym tutkunları için bir <br>araya gelmiş bir topluluktur. Amacımız, sağlıklı yaşam ve spor konularında doğru ve güncel bilgileri paylaşarak, spor yapmayı hayatının bir parçası haline getirmek isteyen herkese rehberlik etmektir.
    Web sitemizde, fitness ve gym ile ilgili ipuçları, antrenman programları, beslenme önerileri bulabilirsiniz.
   
   "Sporcuyuz" sitesi olarak her seviyeden sporcuya hitap eden içerikler üretmeye özen gösteriyoruz. İster yeni başlayan olun,
    ister deneyimli bir sporcu, web sitemizde size uygun bilgiler ve ilham verici hikayeler bulabilirsiniz. Amacımız, spor yapmanın 
   sadece fiziksel değil, aynı zamanda zihinsel ve sosyal faydalarını da vurgulamaktır.
   
   <br>"Sporcuyuz.com.tr" sitesi Efehan tarafından kurulmuş olup hem kendi alanında deneyim kazanmak hem de spor dünyasında faydalı bilgiler vermeyi amaçlamıştır.</p>
   <br> <p>"Sporcuyuz.com.tr" sitesinde yer alan fiyatlar gerçeği yansıtmamakta olup hiçbir ticari amacı olmamaktadır.</p>
   <img src="resimler/efehan.png">
<div style="display: flex; align-items: center; gap: 12px; background: #ffffff; padding: 12px 18px; border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); width: fit-content; margin-top: 20px;">
    <img src="resimler/insta.jpeg" alt="Instagram Profil" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #e0e0e0;">
    <div style="display: flex; flex-direction: column; align-items: start;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram Logo" style="width: 20px; height: 20px; margin-bottom: 4px;">
        <a href="log.php" class=insta-username" target="_blank" style="text-decoration: none; color: #333; font-weight: bold; font-family: 'Arial', sans-serif; font-size: 18px;">
            @361eefehan
        </a>
    </div>
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
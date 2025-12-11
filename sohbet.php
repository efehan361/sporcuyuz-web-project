<?php
// sohbet.php
session_start();

// Veritabanına bağlan
$db = new SQLite3('visitors.db');

// Sohbet tablosu oluşur (eğer yoksa)
$db->exec("CREATE TABLE IF NOT EXISTS sohbet (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    takma_ad TEXT,
    ip TEXT,
    mesaj TEXT,
    resim TEXT,
    zaman TEXT
)");

// Takma ad kontrol
if (!isset($_SESSION['takma_ad'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $takma_ad = trim($_POST['takma_ad']);
        $sifre = $_POST['sifre'] ?? '';

        if (strtolower($takma_ad) === 'efehan') {
            if ($sifre !== 'stayhighbiszumtod') {
                $hata = "'efehan' takma adını almak için doğru şifreyi girmen gerekir.";
            } else {
                $_SESSION['takma_ad'] = 'efehan';
            }
        } else {
            $_SESSION['takma_ad'] = htmlspecialchars($takma_ad);
        }
    } else {
        // Giriş formu
        echo '<!DOCTYPE html>
        <html><head><meta charset="UTF-8"><title>Sohbet</title>
        <link rel="stylesheet" href="style.css">
        </head><body>
        <div class="container">
        <h2>Takma Adını Gir</h2>';
        if (isset($hata)) echo "<p style='color:red;'>$hata</p>";
        echo '<form method="post">
            <input type="text" name="takma_ad" placeholder="Takma ad" required>
            <br><small>Eğer Kullanıcı Adını "Efehan" Yapmak istersen Şifre Girmelisin.<br> Farklı Bir Kullanıcı Adı Yazıyorsan "Şifre" Kısmını Boş Bırakarak Giriş Yapabilirsin:</small><br>
            <input type="password" name="sifre" placeholder="efehan için şifre">
            <br><br><input type="submit" value="Sohbete Gir">
        </form>
        </div></body></html>';
        exit;
    }
}

// Mesaj gönderimi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mesaj'])) {
    $mesaj = htmlspecialchars(trim($_POST['mesaj']));
    $ip = $_SERVER['REMOTE_ADDR'];
    $takma_ad = $_SESSION['takma_ad'];
    $zaman = date("Y-m-d H:i:s");
    $resim_yolu = '';

    if (isset($_FILES['resim']) && $_FILES['resim']['error'] === 0) {
        $uzanti = pathinfo($_FILES['resim']['name'], PATHINFO_EXTENSION);
        $yeni_ad = 'uploads/' . uniqid() . "." . $uzanti;
        if (move_uploaded_file($_FILES['resim']['tmp_name'], $yeni_ad)) {
            $resim_yolu = $yeni_ad;
        }
    }

    if (!empty($mesaj) || !empty($resim_yolu)) {
        $stmt = $db->prepare("INSERT INTO sohbet (takma_ad, ip, mesaj, resim, zaman) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $takma_ad);
        $stmt->bindValue(2, $ip);
        $stmt->bindValue(3, $mesaj);
        $stmt->bindValue(4, $resim_yolu);
        $stmt->bindValue(5, $zaman);
        $stmt->execute();
    }
    header("Location: sohbet.php");
    exit;
}

// Sohbet verilerini al
$sohbetler = $db->query("SELECT * FROM sohbet ORDER BY id DESC LIMIT 100");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="https://sporcuyuz.com.tr/resimler/kirma.jpg"> <!-- Sitede bulunan görsellerden biri -->
<meta property="og:url" content="https://sporcuyuz.com.tr/sohbet.php">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2325078026748389"
     crossorigin="anonymous"></script>
    <link rel="icon" href="resimler/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Sohbet (Beta Versiyon)</title>
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

    <style>
        
        .mesaj-kutu {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background: #fff;
        }
        .resim-onizleme {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin-top: 5px;
        }
        .sohbet-kapsayici {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sporcuyuz.com.tr</h1>
        <nav>
            <ul>
            
            </ul>
        </nav>
    </header>

    <main class="sohbet-kapsayici">
        
        <p style="text-align:right; margin-right: 10px; font-size: 14px;">
        <p style="font-weight: bold; margin-bottom: 6px;">Gönder Butonuna Basarak Yeni Mesajları Görüntüleyebilirsin!</p>

           <strong> Takma Ad: <?= $_SESSION['takma_ad'] === 'efehan' ? 'efehan (KURUCU)' : $_SESSION['takma_ad'] ?></strong>
        </p>

        <form method="post" enctype="multipart/form-data">
        <textarea name="mesaj" placeholder="Mesajınızı Yazınız.." required style="
  width: 100%;
  max-width: 500px;
  height: 120px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 12px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 15px;
  resize: none;
  background-color: #fafafa;
  box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
"
onfocus="this.style.borderColor='#6c63ff'; this.style.boxShadow='0 0 5px rgba(108, 99, 255, 0.4)'; this.style.backgroundColor='#fff';"
onblur="this.style.borderColor='#ccc'; this.style.boxShadow='inset 0 2px 4px rgba(0,0,0,0.05)'; this.style.backgroundColor='#fafafa';"
></textarea>

            <input type="file" name="resim" accept="image/*">
            <button type="submit">Gönder</button>
        </form>

        <div class="sohbet-alani">
            <?php while ($row = $sohbetler->fetchArray(SQLITE3_ASSOC)) : ?>
                <div class="mesaj-kutu">
                    <strong><?= htmlspecialchars($row['takma_ad']) ?></strong> -
                    <small><?= $row['zaman'] ?></small><br>
                    <?= nl2br(htmlspecialchars($row['mesaj'])) ?><br>
                    <?php if (!empty($row['resim'])): ?>
                        <img src="<?= htmlspecialchars($row['resim']) ?>" class="resim-onizleme">
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

   
    <div class="footer">
    <a href="hakkimizda.php" target="_blank">Hakkımızda</a>
        <a href="gizlilik.php" target="_blank">Gizlilik Politikası</a>
        <a href="telif.php" target="_blank">Telif Hakları</a>
    </div>

</body>
</html>

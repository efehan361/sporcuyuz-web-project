<?php
session_start();

// Şifre
"ornek_sifre"; //GitHub İçin Değiştirildi.

// Şifre kontrolü
if (isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['admin'] = true;
    } else {
        $error = "Şifre yanlış!";
    }
}

// Eğer giriş yapılmamışsa form göster
if (!isset($_SESSION['admin'])) {
?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
        body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    background: linear-gradient(to right, #625fff, #7bd9fe);
    gap: 20px;
}</style>
        <meta charset="UTF-8">
        <title>Admin Giriş</title>
    </head>
    <body>
        <h2>Admin Paneli Girişi</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </body>
    </html>
<?php
    exit();
}
?>

<!-- Başarılı giriş sonrası panel -->
<!DOCTYPE html>
<html>
<title>Admin Paneli</title>
    <style>
   body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    background: linear-gradient(to right, #625fff, #7bd9fe);
    gap: 20px;
}

ul {
    list-style: none; /* Madde işaretlerini kaldır */
    padding: 0;
    margin: 0;
    display: flex; /* Kutuları yatay diz */
    gap: 230px; /* Kutular arası boşluk */
}

.kutu {
    width: 300px;
    height: 460px;
    background-color: whitesmoke;
    border-radius: 20px;
    box-shadow: 2px 2px 18px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column; /* Yukarıdan aşağıya sıralanacak şekilde */
    justify-content: space-between;
    align-items: center;
    padding-top: 30px;
    font-size: 35px;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
}

.kutu a {
    text-decoration: none;
    color: inherit;
    font-weight: bold; /* Bağlantıyı daha belirgin yapmak için */
}

.kutu-aciklama {
    font-size: 33px; /* Küçük metin */
    color: #666;
    text-align: center;
    margin-top: 10px; /* Metin ile kutu arasındaki boşluk */
    margin: auto;

}

.kutu:hover {
    background-color: black;
    color: white;
    transform: scale(1.10);
}


    </style>
</head>
<body>
    <h1 style="font-size: 55px;">Hoş geldin Efehan</h1>
    <ul>
        <li class="kutu">
            <a href="admin_panel.php">Veri Paneli</a>
            <p class="kutu-aciklama">Ziyaretçi Takibi<br>IP Adres Bilgileri<br>Konum Bilgileri</p> 
        </li>
        <li class="kutu">
            <a href="admin_iletisim.php">İletişim Paneli</a>
            <p class="kutu-aciklama">İletişim Kayıtları<br>İletişim Bilgileri</p> 
        </li>
        <li class="kutu">
            <a href="admin_sohbet.php">Sohbet Paneli</a>
            <p class="kutu-aciklama">Beta Versiyonda<br>Sohbet Geçmişi<br>Sohbet Yönetimi</p> 
        </li>
    </ul>
    
</div>
</body>
</html>


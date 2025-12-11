
<?php
date_default_timezone_set('Europe/Istanbul');

// Kişinin bilgilerini al
$ip = $_SERVER['REMOTE_ADDR'];
$tarayici = $_SERVER['HTTP_USER_AGENT'];
$saat = date('Y-m-d H:i:s');

// Log dosyasına kaydet
$logSatiri = "$saat - $ip - $tarayici\n";
file_put_contents('tiklama_loglari.txt', $logSatiri, FILE_APPEND);

// PHP yönlendirme başarısız olursa HTML yönlendirme
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönlendiriliyor...</title>
    <meta http-equiv="refresh" content="0; url=https://www.instagram.com/361eefehan">
</head>
<body>
    <p>Yönlendiriliyorsunuz... Eğer otomatik gitmezse <a href="https://www.instagram.com/361eefehan">buraya tıklayın</a>.</p>
</body>
</html>

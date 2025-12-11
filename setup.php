<?php
date_default_timezone_set('Europe/Istanbul');

$db = new SQLite3('db.sqlite');

$db->exec("CREATE TABLE IF NOT EXISTS ziyaretciler (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ip TEXT,
    ilk_giris TEXT,
    son_giris TEXT,
    ziyaret_sayisi INTEGER,
    ulke TEXT,
    sehir TEXT,
    cihaz TEXT,
    kaynak TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS ziyaret_log (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ip TEXT,
    zaman TEXT
)");

echo "Veritabanı ve tablolar başarıyla oluşturuldu.";
?>


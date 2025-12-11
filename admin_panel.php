<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}
?>
<?php


$password = "ornek_sifre"; //GitHub İçin Değiştirildi.
if (!isset($_SESSION['loggedin'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === $password) {
            $_SESSION['loggedin'] = true;
            header("Location: admin.php");
            exit;
        } else {
            $error = "Şifre yanlış! Tekrar Dene.";
        }
    } date_default_timezone_set('Europe/Istanbul');

    ?>

    <form method="post" style="margin-top:50px; text-align:center;">
        <h2>Hoş Geldin Efehan</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="password" name="password" placeholder="Şifreyi Giriniz">
        <input type="submit" value="Panele Eriş">
    </form>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; margin: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background: #f0f0f0; }
        input[type="text"] { width: 150px; }
        form.inline { display: inline; }
        td.center { text-align: center; }
form.inline input[type="submit"] { margin: auto; display: block; }

    </style>
</head>
<?php
date_default_timezone_set('Europe/Istanbul');

$logDosyasi = 'tiklama_loglari.txt';

// Tek satır silme
if (isset($_GET['sil'])) {
    $satirNo = (int) $_GET['sil'];
    $satirlar = file($logDosyasi, FILE_IGNORE_NEW_LINES);

    if (isset($satirlar[$satirNo])) {
        unset($satirlar[$satirNo]);
        file_put_contents($logDosyasi, implode("\n", $satirlar));
    }

    header("Location: admin.php");
    exit;
}

// Tümünü temizleme
if (isset($_GET['temizle'])) {
    file_put_contents($logDosyasi, '');
    header("Location: admin.php");
    exit;
}

// Logları oku
$loglar = file($logDosyasi, FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Tıklama Kayıtları</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
            background: #f0f0f0;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #222;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        th {
            background: #f7f7f7;
        }
        .sil-buton {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .sil-buton:hover {
            background: #c0392b;
        }
        .temizle-buton {
            display: inline-block;
            margin: 20px auto;
            background: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }
        .temizle-buton:hover {
            background: #2980b9;
        }
        .center {
            text-align: center;
        }
        @media screen and (max-width: 600px) {
            table, tr, td, th {
                font-size: 12px;
            }
            .sil-buton, .temizle-buton {
                padding: 5px 10px;
            }
        }
    </style>
</head>
<body>

<h1>Tıklama Kayıtları</h1>

<div class="center">
    <a class="temizle-buton" href="?temizle=1" onclick="return confirm('Tüm kayıtlar silinsin mi?')">Tümünü Temizle</a>
</div>

<?php if (!empty($loglar)): ?>
<table>
    <tr>
        <th>#</th>
        <th>Tarih - Saat</th>
        <th>IP Adresi</th>
        <th>Tarayıcı</th>
        <th>İşlem</th>
    </tr>
    <?php foreach ($loglar as $index => $satir): 
        list($saat, $ip, $agent) = explode(' - ', $satir);
    ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= htmlspecialchars($saat) ?></td>
        <td><?= htmlspecialchars($ip) ?></td>
        <td><?= htmlspecialchars($agent) ?></td>
        <td>
            <a href="?sil=<?= $index ?>" onclick="return confirm('Bu satır silinsin mi?')">
                <button class="sil-buton">Sil</button>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <p class="center">Hiç tıklama kaydı yok.</p>
<?php endif; ?>

</body>
</html>

<body>
    <h2>Admin Paneli – Ziyaretçi Listesi</h2>
    <table>
        <tr>
            <th>IP Adresi</th>
            <th>Ülke</th>
            <th>Şehir</th>
            <th>Kaynak</th>
            <th>Tarayıcı</th>
            <th>Zaman</th>
            <th>Etiket</th>
            <th>Kullanıcıyı:</th>
        </tr>

        <?php
        $db = new SQLite3('data.db');

        // Silme işlemi
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $stmt = $db->prepare("DELETE FROM visitors WHERE id = ?");
            $stmt->bindValue(1, $_POST['id'], SQLITE3_INTEGER);
            $stmt->execute();
            header("Location: admin.php");
            exit;
        }

        // Etiket güncelleme işlemi
        if (isset($_POST['update_label']) && isset($_POST['id'])) {
            $stmt = $db->prepare("UPDATE visitors SET label = ? WHERE id = ?");
            $stmt->bindValue(1, $_POST['label']);
            $stmt->bindValue(2, $_POST['id'], SQLITE3_INTEGER);
            $stmt->execute();
            header("Location: admin.php");
            exit;
        }

        $results = $db->query("SELECT * FROM visitors ORDER BY id DESC");
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ip']) . "</td>";
            echo "<td>" . htmlspecialchars($row['country']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['referer']) . "</td>";
            echo "<td>" . htmlspecialchars($row['browser']) . "</td>";
            echo "<td>" . htmlspecialchars($row['time']) . "</td>";
            
            // Etiket formu
            echo "<td>
                    <form method='post' class='inline'>
                        <input type='text' name='label' value='" . htmlspecialchars($row['label'] ?? '') . "' placeholder='Etiket ekle'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' name='update_label' value='" . ($row['label'] ? 'Düzenle' : 'Ekle') . "'>
                    </form>
                  </td>";

            // Silme butonu
            echo "<td class='center'>
            <form method='post' class='inline'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='submit' name='delete' value='Sil' onclick=\"return confirm('Silmek istediğine emin misin?');\">
            </form>
          </td>";
    
        }
        ?>
    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
        <img src="resimler/boncuk.png" alt="Boncuğum" style="max-width: 200px; border-radius: 10px;">
        <!-- İstersen daha fazla fotoğraf da ekleyebilirsin -->
    </div>

    </table>
    
</body>
</html>
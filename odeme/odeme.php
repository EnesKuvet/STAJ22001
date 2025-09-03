<?php
session_start();
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: ../giris/giris.php");
    exit;
}
include '../veritabani/baglanti.php';

$kullanici_id = $_SESSION['kullanici_id'];
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adres = $_POST['adres'];
    $odeme_yontemi = $_POST['odeme_yontemi'];
    $tarih = date("Y-m-d H:i:s");
    
    $sepet = $baglanti->query("SELECT urun_id, adet FROM sepet WHERE kullanici_id = $kullanici_id");
    while ($s = $sepet->fetch_assoc()) {
        $urun_id = $s['urun_id'];
        $adet = $s['adet'];
        $baglanti->query("INSERT INTO siparisler (kullanici_id, urun_id, adet, adres, odeme_yontemi, tarih, durum) 
                         VALUES ($kullanici_id, $urun_id, $adet, '$adres', '$odeme_yontemi', '$tarih', 'hazırlanıyor')");
    }
    $baglanti->query("DELETE FROM sepet WHERE kullanici_id = $kullanici_id");
    $mesaj = "Siparişiniz başarıyla tamamlandı!";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ödeme</title>
    <link rel="stylesheet" href="../odeme/odeme.css">
</head>
<body>
<?php include '../header2/header.php'; ?>

<main class="odeme-kapsayici">
    <h2>Ödeme Sayfası</h2>
    <?php if ($mesaj): ?>
        <p class="mesaj"><?= $mesaj ?></p>
    <?php endif; ?>
    <form method="POST" onsubmit="return odemeKontrol()">
        <label for="adres">Teslimat Adresi</label>
        <textarea name="adres" id="adres" placeholder="Adresinizi giriniz..." required></textarea>

        <label for="odeme_yontemi">Ödeme Yöntemi</label>
        <select name="odeme_yontemi" id="odeme_yontemi" required>
            <option value="">Seçiniz</option>
            <option value="Kredi Kartı">Kredi Kartı</option>
            <option value="Kapıda Ödeme">Kapıda Ödeme</option>
            <option value="Havale">Havale</option>
        </select>

        <button type="submit">Siparişi Tamamla</button>
    </form>
</main>

<?php include '../footer2/footer.php'; ?>
<script src="../odeme/odeme.js"></script>
</body>
</html>

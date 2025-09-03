<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: ../giris/giris.php");
    exit;
}

include '../veritabani/baglanti.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="../anasayfa/anasayfa.css">
</head>
<body>
<?php include '../header2/header.php'; ?>


<div id="bildirim" class="bildirim">Ürün Sepete Eklendi!</div>


<div class="kategori-panel">
    <h3>Kategoriler</h3>
    <ul id="kategoriListesi">
        <li onclick="filtrele('hepsi')">Tüm Ürünler</li>
        <li onclick="filtrele('1')">Elektronik</li>
        <li onclick="filtrele('2')">Mobil Eşya</li>
        <li onclick="filtrele('3')">Süs Eşyası</li>
        <li onclick="filtrele('4')">Giyim</li>
        <li onclick="filtrele('5')">Kozmetik</li>
        <li onclick="filtrele('6')">Araç-Gereç</li>
    </ul>
</div>

<section class="urunler-alani" id="urunler">
<?php
$sorgu = "SELECT * FROM urunler";
$sonuc = $baglanti->query($sorgu);

if ($sonuc->num_rows > 0) {
    while ($urun = $sonuc->fetch_assoc()) {
        echo '
        <div class="urun-karti" data-kategori="' . $urun['kategori_id'] . '">
            <img src="' . $urun['resim_yolu'] . '" alt="' . $urun['isim'] . '">
            <h3>' . $urun['isim'] . '</h3>
            <p>₺' . number_format($urun['fiyat'], 2, ',', '.') . '</p>
            <p class="aciklama">' . $urun['aciklama'] . '</p>
            <button onclick="sepeteEkle(' . $urun['id'] . ')">Satın Al</button>
        </div>';
    }
}
$baglanti->close();
?>
</section>
<button id="btnYukariCik" title="Yukarı Çık">↑</button>

<?php include '../footer2/footer.php'; ?>
<script src="../anasayfa/anasayfa.js"></script>
</body>
</html>

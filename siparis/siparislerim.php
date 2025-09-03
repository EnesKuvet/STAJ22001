<?php
session_start();
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: ../giris/giris.php");
    exit;
}

include '../veritabani/baglanti.php';
$kullanici_id = $_SESSION['kullanici_id'];


$sorgu = "SELECT s.*, u.resim_yolu, u.isim as urun_adi, u.fiyat, k.isim, k.soyad 
          FROM siparisler s 
          JOIN urunler u ON s.urun_id = u.id 
          JOIN kullanicilar k ON s.kullanici_id = k.kullanici_id 
          WHERE s.kullanici_id = $kullanici_id 
          ORDER BY s.tarih DESC";

$sonuc = $baglanti->query($sorgu);

$aktif_siparis_var = false;
$siparis_html = "";

while ($s = $sonuc->fetch_assoc()) {
    if (!in_array($s['durum'], ['iptal', 'stok yetersiz'])) {
        $aktif_siparis_var = true;
    }

    
    $kart_class = '';
    if (in_array($s['durum'], ['iptal', 'stok yetersiz'])) {
        $kart_class = 'iptal'; 
    } elseif ($s['durum'] === 'tamamlandı') {
        $kart_class = 'tamamlandi'; 
    }

    
    $durum_class = '';
    if ($s['durum'] === 'hazırlanıyor') {
        $durum_class = 'yesil';
    } elseif (in_array($s['durum'], ['iptal', 'stok yetersiz'])) {
        $durum_class = 'kirmizi';
    } elseif ($s['durum'] === 'tamamlandı') {
        $durum_class = 'yesil';
    }

    ob_start();
    ?>
    <div class="siparis-karti <?= $kart_class ?>">
        <img src="../images/<?= $s['resim_yolu'] ?>" alt="<?= $s['urun_adi'] ?>">
        <div class="siparis-detay">
            <h2><?= $s['urun_adi'] ?></h2>
            <p><strong>Adet:</strong> <?= $s['adet'] ?></p>
            <p><strong>Birim Fiyat:</strong> ₺<?= number_format($s['fiyat'], 2, ',', '.') ?></p>
            <p><strong>Toplam:</strong> ₺<?= number_format($s['fiyat'] * $s['adet'], 2, ',', '.') ?></p>
            <p><strong>Adres:</strong> <?= $s['adres'] ?></p>
            <p><strong>Ödeme Yöntemi:</strong> <?= $s['odeme_yontemi'] ?></p>
            <p><strong>Ad Soyad:</strong> <span class="kucuk-metin"><?= $s['isim'] . ' ' . $s['soyad'] ?></span></p>
            <p><strong>Tarih:</strong> <?= $s['tarih'] ?></p>
            <p class="durum">
                <strong>Durum:</strong>
                <strong class="<?= $durum_class ?>"><?= ucfirst($s['durum']) ?></strong>
            </p>

            <?php if (!in_array($s['durum'], ['iptal', 'stok yetersiz', 'tamamlandı'])): ?>
                <button onclick="siparisIptalEt(<?= $s['id'] ?>)">Siparişi İptal Et</button>
            <?php endif; ?>
        </div>
    </div>
    <?php
    $siparis_html .= ob_get_clean();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Siparişlerim</title>
    <link rel="stylesheet" href="../siparis/siparislerim.css">
</head>
<body>
<?php include '../header2/header.php'; ?>

<main class="siparis-kapsayici">
    <h2>Siparişlerim</h2>

    <div class="siparis-listesi">
        <?= $siparis_html ?>
    </div>

    <?php if ($aktif_siparis_var): ?>
        <div class="toplu-iptal-alani">
            <button onclick="tumSiparisleriIptalEt()">Tüm Siparişleri İptal Et</button>
        </div>
    <?php endif; ?>
</main>

<button id="btnYukariCik" title="Yukarı Çık">↑</button>
<?php include '../footer2/footer.php'; ?>
<script src="../siparis/siparislerim.js"></script>  
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: ../giris/giris.php");
    exit;
}
include '../veritabani/baglanti.php';
$kullanici_id = $_SESSION['kullanici_id'];

$sorgu = "SELECT s.id, s.adet, u.resim_yolu, u.isim, u.fiyat 
          FROM sepet s 
          JOIN urunler u ON s.urun_id = u.id 
          WHERE s.kullanici_id = $kullanici_id";

$sonuc = $baglanti->query($sorgu);
$toplamTutar = 0;
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sepetim</title>
    <link rel="stylesheet" href="../sepet/sepetim.css">
</head>
<body>

<?php include '../header2/header.php'; ?>

<main class="sepet-kapsayici">
    <h2>Sepetim</h2>
    <div id="sepet">
        <?php if ($sonuc->num_rows > 0): ?>
            <?php while ($satir = $sonuc->fetch_assoc()): ?>
                <?php
                    $adet = $satir['adet'];
                    $urunToplam = $adet * $satir['fiyat'];
                    $toplamTutar += $urunToplam;
                ?>
                <div class="sepet-urun">
                    <img src="<?= $satir['resim_yolu'] ?>" alt="<?= $satir['isim'] ?>">
                    <div class="urun-detay">
                        <h3><?= $satir['isim'] ?></h3>
                        <p><strong>Adet:</strong> <?= $adet ?></p>
                        <p><strong>Birim Fiyat:</strong> ₺<?= number_format($satir['fiyat'], 2, ',', '.') ?></p>
                        <p><strong>Toplam:</strong> ₺<?= number_format($urunToplam, 2, ',', '.') ?></p>
                        <button onclick="urunSil(<?= $satir['id'] ?>)">Kaldır</button>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class="toplam-tutar">
                <strong>Sepet Toplamı: ₺<?= number_format($toplamTutar, 2, ',', '.') ?></strong>
            </div>
            <div class="sepet-butonu">
                <a href="../odeme/odeme.php" class="odeme-buton">Ödeme Yap</a>
            </div>
        <?php else: ?>
            <p class="bos-sepet">Sepetinizde ürün bulunmamaktadır.</p>
        <?php endif; ?>
    </div>
</main>
<?php include '../footer2/footer.php'; ?>
<script src="../sepet/sepetim.js"></script>
</body>
</html>

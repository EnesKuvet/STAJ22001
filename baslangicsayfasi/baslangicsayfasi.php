<?php include '../veritabani/baglanti.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../baslangicsayfasi/baslangicsayfasi.css">
</head>
<body>
<?php include '../header1/header.php'; ?>
<section class="kampanya-alani">
    <div class="kampanya-yazi animasyonlu-metin">
        <h2>Yaz İndirimleri Başladı...</h2>
        <p>Tüm Ürünlerde %30 İndirim</p>
    </div>
</section>
<section class="urunler-alani">
    <?php
    $sorgu = "SELECT * FROM urunler ORDER BY id ASC LIMIT 9";
    $sonuc = $baglanti->query($sorgu);

    if ($sonuc->num_rows > 0) {
        while ($satir = $sonuc->fetch_assoc()) {
            echo '
            <div class="urun-karti">
                <img src="' . $satir["resim_yolu"] . '" alt="Ürün">
                <h3>' . htmlspecialchars($satir["isim"]) . '</h3>
                <button class="satin-al-buton">Satın Al</button>
            </div>
            ';
        }
    } else {
        echo "<p>Henüz ürün bulunamadı.</p>";
    }

    $baglanti->close();
    ?>
</section>

<?php include '../footer1/footer.php'; ?>
<script src="../baslangicsayfasi/baslangic.js"></script>
</body>
</html>
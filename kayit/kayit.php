<?php
include '../veritabani/baglanti.php';
$mesaj = "";
$renk = "red";
$yonlendir = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isim = $_POST['isim'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    $sifretekrar = $_POST['sifretekrar'];
    $dogum = $_POST['dogum'];
    $cinsiyet = $_POST['cinsiyet'];

    if ($sifre === $sifretekrar) {
        $kontrolSorgu = $baglanti->prepare("SELECT * FROM kullanicilar WHERE email = ?");
        $kontrolSorgu->bind_param("s", $email);
        $kontrolSorgu->execute();
        $sonuc = $kontrolSorgu->get_result();

        if ($sonuc->num_rows > 0) {
            $mesaj = "Bu E-Posta Zaten Mevcut !";
            $yonlendir = true;
        } else {
            $sifreHash = password_hash($sifre, PASSWORD_DEFAULT);

            $ekle = $baglanti->prepare("INSERT INTO kullanicilar (isim, soyad, email, sifre, dogum_tar, cinsiyet) VALUES (?, ?, ?, ?, ?, ?)");
            $ekle->bind_param("sssssi", $isim, $soyad, $email, $sifreHash, $dogum, $cinsiyet);

            if ($ekle->execute()) {
                $mesaj = "Kayıt Başarılı Giriş Yapabilirsiniz !!";
                $renk = "green";
                $yonlendir = true;
            } else {
                $mesaj = "Kayıt sırasında hata oluştu.";
            }
            $ekle->close();
        }

        $kontrolSorgu->close();
    } else {
        $mesaj = "Şifreler eşleşmiyor!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="../kayit/kayit.css">
</head>
<body>
<?php include '../header1/header.php'; ?>

<div class="kayit-kutusu">
    <h2>Kayıt Ol</h2>
    <?php if ($mesaj): ?>
        <p class="mesaj" style="color: <?= $renk ?>;"><?php echo $mesaj; ?></p>
    <?php endif; ?>
    <form method="POST" onsubmit="return dogrula()">
        <input type="text" name="isim" placeholder="İsim" required>
        <input type="text" name="soyad" placeholder="Soyad" required>
        <input type="email" name="email" placeholder="E-posta" required>

        <input type="password" id="sifre" name="sifre" placeholder="Şifre" onkeyup="sifreKontrol()" required>
        <div id="sifreUyari" class="uyari"> En  Az 8 Karakter !!</div>
        <div id="harfUyari" class="uyari"> En Az 1 Büyük Harf !!</div>
        <div id="rakamUyari" class="uyari"> En Az 1 Rakam !!</div>

        <input type="password" id="sifretekrar" name="sifretekrar" placeholder="Şifreyi Tekrar Giriniz" onkeyup="eslesmeKontrol()" required>
        <div id="eslesmeUyari" class="uyari">Şifreler Eşleşmeli !!</div>

        <input type="date" name="dogum" required>
        <select name="cinsiyet" required>
            <option value="">Cinsiyet</option>
            <option value="1">Erkek</option>
            <option value="2">Kadın</option>
        </select>

        <button type="submit">Kayıt Ol</button>
    </form>
</div>

<?php if ($yonlendir): ?>
    <script>
        setTimeout(function () {
            window.location.href = "../giris/giris.php";
        }, 2900); 
    </script>
<?php endif; ?>

<script src="../kayit/kayit.js"></script>
<?php include '../footer1/footer.php'; ?>
</body>
</html>

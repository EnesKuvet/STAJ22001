<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="../giris/giris.css">
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../header1/header.php';
include '../veritabani/baglanti.php';

$hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];

    $sorgu = $baglanti->prepare("SELECT * FROM kullanicilar WHERE email = ?");
    $sorgu->bind_param("s", $eposta);
    $sorgu->execute();
    $sonuc = $sorgu->get_result();

    if ($sonuc->num_rows == 1) {
        $kullanici = $sonuc->fetch_assoc();

        if (password_verify($sifre, $kullanici['sifre'])) {
            $_SESSION['kullanici_id'] = $kullanici['kullanici_id'];
            $_SESSION['isim'] = $kullanici['isim'];
            header("Location: ../anasayfa/anasayfa.php");
            exit;
        } else {
            $hata = "Hatalı E-Posta Veya Şifre !!";
        }
    } else {
        $hata = "Hatalı E-Posta Veya Şifre !!";
    }
}
?>

<div class="giris-kutusu">
    <h2>Giriş Yap</h2>
    <?php if ($hata): ?>
        <p class="hata"><?php echo $hata; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="eposta">E-posta:</label>
        <input type="email" name="eposta" required>

        <label for="sifre">Şifre:</label>
        <input type="password" name="sifre" required>

        <button type="submit">Giriş Yap</button>
    </form>
    <p>Hesabın yok mu? <a href="../kayit/kayit.php">Kayıt Ol</a></p>
</div>

<?php include '../footer1/footer.php'; ?>
</body>
</html>

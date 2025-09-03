<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: ../giris/giris.php");
    exit;
}
?>
<header class="ust-kisim">
    <link rel="stylesheet" href="../header2/header.css">
    <div class="logo-alani">
        <img src="../images/icon.png" alt="SanalDükkan" class="logo">
        <h1 class="baslik">SanalDükkan</h1>
    </div>
    <nav class="navigasyon">
        <ul>
            <li><a href="../anasayfa/anasayfa.php">Ana Sayfa</a></li>
            <li><a href="../sepet/sepetim.php">Sepetim</a></li>
            <li><a href="../siparis/siparislerim.php">Siparişlerim</a></li>
            <li><a href="../cikis/cikis.php">Oturumu Kapat</a></li>
        </ul>
    </nav>
</header>

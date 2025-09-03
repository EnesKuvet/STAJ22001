<?php
session_start();
include '../veritabani/baglanti.php';

if (!isset($_SESSION['kullanici_id'])) {
    http_response_code(403);
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$urun_id = intval($_GET['id']);


$kontrol = $baglanti->query("SELECT * FROM sepet WHERE kullanici_id = $kullanici_id AND urun_id = $urun_id");
if ($kontrol->num_rows > 0) {
    $baglanti->query("UPDATE sepet SET adet = adet + 1 WHERE kullanici_id = $kullanici_id AND urun_id = $urun_id");
} else {
    $baglanti->query("INSERT INTO sepet (kullanici_id, urun_id, adet) VALUES ($kullanici_id, $urun_id, 1)");
}

echo "ok";
?>

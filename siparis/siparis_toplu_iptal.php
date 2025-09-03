<?php
session_start();
if (!isset($_SESSION['kullanici_id'])) {
    echo json_encode(['basarili' => false]);
    exit;
}

include '../veritabani/baglanti.php';
$kullanici_id = $_SESSION['kullanici_id'];

$sorgu = "UPDATE siparisler SET durum = 'iptal' WHERE kullanici_id = $kullanici_id AND durum NOT IN ('iptal', 'stok yetersiz')";
$baglanti->query($sorgu);

echo json_encode(['basarili' => true]);
?>

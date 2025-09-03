<?php
session_start();
include '../veritabani/baglanti.php';

if (!isset($_SESSION['kullanici_id'])) {
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$sepet_id = intval($_GET['id']);

$baglanti->query("DELETE FROM sepet WHERE id = $sepet_id AND kullanici_id = $kullanici_id");
?>

<?php
session_start();
include '../veritabani/baglanti.php';

if (!isset($_SESSION['kullanici_id'])) exit;

$siparis_id = intval($_GET['id']);
$kullanici_id = $_SESSION['kullanici_id'];

$baglanti->query("UPDATE siparisler SET durum = 'iptal' 
                  WHERE id = $siparis_id AND kullanici_id = $kullanici_id");

echo "Sipariş iptal edildi.";

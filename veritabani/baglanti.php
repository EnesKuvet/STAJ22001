<?php
$vt_sunucu = "localhost";
$vt_kullanici = "root";
$vt_sifre = ""; 
$vt_adi = "sanaldukkan";

$baglanti = new mysqli($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}
?>

<?php
session_start();         // Oturumu başlat
session_unset();         // Tüm oturum değişkenlerini temizle
session_destroy();       // Oturumu tamamen yok et

header("Location: ../baslangicsayfasi/baslangicsayfasi.php"); // Başlangıç sayfasına yönlendir
exit;

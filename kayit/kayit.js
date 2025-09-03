// Şifre alanı aktifken kontroller başlasın
document.getElementById("sifre").addEventListener("input", function () {
    const sifre = this.value;

    const uzunluk = sifre.length >= 8;
    const buyukHarf = /[A-Z]/.test(sifre);
    const rakam = /\d/.test(sifre);

    // Her bir kuralın divini al
    const sifreUyari = document.getElementById("sifreUyari");
    const harfUyari = document.getElementById("harfUyari");
    const rakamUyari = document.getElementById("rakamUyari");

    // Her birini kontrol et ve renklendir
    sifreUyari.style.color = uzunluk ? "green" : "red";
    harfUyari.style.color = buyukHarf ? "green" : "red";
    rakamUyari.style.color = rakam ? "green" : "red";

    // Görünür yap (inputa basınca)
    sifreUyari.style.display = "block";
    harfUyari.style.display = "block";
    rakamUyari.style.display = "block";
});

// Şifre tekrar kontrolü
document.getElementById("sifretekrar").addEventListener("input", function () {
    const sifre = document.getElementById("sifre").value;
    const tekrar = this.value;
    const eslesmeUyari = document.getElementById("eslesmeUyari");

    if (tekrar.length > 0) {
        eslesmeUyari.style.display = "block";
        eslesmeUyari.style.color = (sifre === tekrar) ? "green" : "red";
    } else {
        eslesmeUyari.style.display = "none";
    }
});

// Form gönderilmeden önce kuralları doğrula
function dogrula() {
    const sifre = document.getElementById("sifre").value;
    const tekrar = document.getElementById("sifretekrar").value;

    const uzunluk = sifre.length >= 8;
    const buyukHarf = /[A-Z]/.test(sifre);
    const rakam = /\d/.test(sifre);
    const eslesme = sifre === tekrar;

    if (!uzunluk || !buyukHarf || !rakam || !eslesme) {
        alert("Lütfen şifre kurallarına uyun ve şifreleri doğru girin.");
        return false;
    }

    return true;
}

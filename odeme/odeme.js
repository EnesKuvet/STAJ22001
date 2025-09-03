function odemeKontrol() {
    const adres = document.getElementById("adres").value.trim();
    const odeme = document.getElementById("odeme_yontemi").value;

    if (adres === "" || odeme === "") {
        alert("Lütfen tüm alanları doldurun.");
        return false;
    }

    return true;
}

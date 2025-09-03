function siparisIptalEt(siparisId) {
    if (confirm("Siparişi iptal etmek istiyor musunuz?")) {
        fetch('../siparis/siparis_iptal.php?id=' + siparisId)
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            });
    }
}
function tumSiparisleriIptalEt() {
    if (confirm("Tüm siparişlerinizi iptal etmek istediğinize emin misiniz?")) {
        fetch('../siparis/siparis_toplu_iptal.php', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.basarili) {
                alert("Tüm siparişler iptal edildi.");
                location.reload();
            } else 
                {
                alert("Bir hata oluştu.");
            }
        });
    }
}
window.addEventListener('scroll', function () {
    const yukariBtn = document.getElementById("btnYukariCik");
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        yukariBtn.style.display = "block";
    } else 
        {
        yukariBtn.style.display = "none";
    }
});
document.getElementById("btnYukariCik").addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

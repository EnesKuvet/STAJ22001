
function sepeteEkle(urun_id) {
    fetch('../sepet/sepete_ekle.php?id=' + urun_id)
        .then(response => response.text())
        .then(() => {
            const bildirim = document.getElementById("bildirim");
            bildirim.style.display = "block";
            setTimeout(() => {
                bildirim.style.display = "none";
            }, 2000);
        });
}

function filtrele(kategori) {
    const kartlar = document.querySelectorAll(".urun-karti");
    kartlar.forEach(kart => {
        if (kategori === 'hepsi' || kart.dataset.kategori === kategori) {
            kart.style.display = "block";
        } else {
            kart.style.display = "none";
        }
    });
}

const btnYukariCik = document.getElementById("btnYukariCik");

window.onscroll = function() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    btnYukariCik.style.display = "block";
  } else {
    btnYukariCik.style.display = "none";
  }
};


btnYukariCik.addEventListener("click", function() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"  
  });
});

document.addEventListener("DOMContentLoaded", () => {
    
    const kartlar = document.querySelectorAll(".urun-karti");
    kartlar.forEach((kart, index) => {
        setTimeout(() => {
            kart.classList.add("gorundu");
        }, index * 150);
    });

    const yazi = document.querySelector(".animasyonlu-metin");
    if (yazi) {
        setTimeout(() => {
            yazi.classList.add("gorundu");
        }, 300); 
    }
});
document.querySelectorAll('.satin-al-buton').forEach(button => {
  button.addEventListener('click', () => {
    
    window.location.href = '../giris/giris.php';
  });
});
function urunSil(sepet_id) {
    if (confirm("Bu ürünü sepetinizden kaldırmak istiyor musunuz?")) {
        fetch('../sepet/sepetten_sil.php?id=' + sepet_id)
            .then(response => response.text())
            .then(() => {
                window.location.reload(); 
            });
    }
}

// FancyBox Initialization Helper
window.initFancyBox = function(selector) {
    try {
        console.log("Mencoba inisialisasi FancyBox dengan selector:", selector || "[data-fancybox]");
        
        // Hapus semua binding sebelumnya
        if (typeof Fancybox !== 'undefined' && typeof Fancybox.destroy === 'function') {
            Fancybox.destroy();
        }
        
        // Kumpulkan semua grup galeri yang ada di halaman
        const galleryGroups = {};
        document.querySelectorAll(selector || "[data-fancybox]").forEach(function(el) {
            const groupId = el.getAttribute('data-fancybox');
            if (!galleryGroups[groupId]) {
                galleryGroups[groupId] = [];
            }
            
            galleryGroups[groupId].push({
                el: el,
                src: el.getAttribute('href'),
                caption: el.getAttribute('data-caption') || ''
            });
        });
        
        // Log informasi grup galeri
        console.log(`Ditemukan ${Object.keys(galleryGroups).length} grup galeri`);
        
        // Tambahkan event listener untuk setiap elemen
        Object.keys(galleryGroups).forEach(function(groupId) {
            const items = galleryGroups[groupId];
            
            items.forEach(function(item, index) {
                item.el.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const images = items.map(function(it) {
                        return {
                            src: it.src,
                            caption: it.caption
                        };
                    });
                    
                    try {
                        Fancybox.show(images, {
                            startIndex: index
                        });
                        console.log(`Galeri ${groupId} dibuka dengan ${images.length} gambar`);
                    } catch (error) {
                        console.error("Error saat membuka FancyBox:", error);
                    }
                });
            });
        });
        
        return true;
    } catch (e) {
        console.error("Terjadi kesalahan saat inisialisasi FancyBox:", e);
        return false;
    }
}; 
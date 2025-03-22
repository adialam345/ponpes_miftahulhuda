// Custom Gallery Initialization
document.addEventListener('DOMContentLoaded', function() {
    // Periksa apakah Fancybox tersedia
    if (typeof Fancybox !== 'undefined') {
        console.log("FancyBox tersedia, menginisialisasi...");
        
        // Hapus binding sebelumnya jika ada
        Fancybox.destroy();
        
        // Pendekatan paling sederhana yang lebih reliable
        document.querySelectorAll('[data-fancybox]').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                
                const galleryId = this.getAttribute('data-fancybox');
                console.log("Galeri diklik:", galleryId);
                
                // Kumpulkan semua gambar dalam grup yang sama
                const images = [];
                const elements = document.querySelectorAll(`[data-fancybox="${galleryId}"]`);
                
                elements.forEach(function(element) {
                    images.push({
                        src: element.getAttribute('href'),
                        caption: element.getAttribute('data-caption') || ''
                    });
                });
                
                console.log(`Memuat ${images.length} gambar untuk galeri ${galleryId}`);
                
                // Cari indeks item yang diklik dalam array images
                const currentSrc = this.getAttribute('href');
                let startIndex = 0;
                
                for (let i = 0; i < images.length; i++) {
                    if (images[i].src === currentSrc) {
                        startIndex = i;
                        break;
                    }
                }
                
                // Buka galeri dengan Fancybox API
                try {
                    Fancybox.show(images, {
                        startIndex: startIndex,
                        // Opsi minimal untuk menghindari masalah
                        infinite: true
                    });
                } catch (error) {
                    console.error("Error membuka FancyBox:", error);
                }
            });
        });
        
        console.log("FancyBox event listeners ditambahkan dengan sukses");
    } else {
        console.error("FancyBox tidak tersedia");
    }
}); 
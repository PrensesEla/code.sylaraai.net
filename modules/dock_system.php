<?php
/* 
 * Dock System Module
 * Bu modül, ekranın altında iOS tarzı dock paneli gösterir
 */
?>

<!-- Pembe Arka Plan -->
<div class="pink-background"></div>

<!-- iOS tarzı Dock Container -->
<div class="dock-container">
    <div class="dock-icon">
        <i class="fa fa-home"></i>
        <div class="dock-tooltip">Ana Sayfa</div>
    </div>
    <div class="dock-icon">
        <i class="fa fa-code"></i>
        <div class="dock-tooltip">Kod Editörü</div>
    </div>
    <div class="dock-icon">
        <i class="fa fa-folder"></i>
        <div class="dock-tooltip">Dosyalar</div>
    </div>
    <div class="dock-icon">
        <i class="fa fa-terminal"></i>
        <div class="dock-tooltip">Terminal</div>
    </div>
    <div class="dock-icon">
        <i class="fa fa-cog"></i>
        <div class="dock-tooltip">Ayarlar</div>
    </div>
</div>

<!-- Font Awesome ikon kütüphanesi -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Dock System JavaScript -->
<script src="/assets/js/dock-system.js"></script>

<script>
    // Dock iconlarına tıklama olayları
    document.addEventListener('DOMContentLoaded', function() {
        const dockIcons = document.querySelectorAll('.dock-icon');
        
        dockIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                // Tıklanan ikona animasyon ekle
                this.classList.add('dock-icon-clicked');
                
                // Animasyonu kaldır
                setTimeout(() => {
                    this.classList.remove('dock-icon-clicked');
                }, 300);
                
                // İkon içeriğine göre işlem yap
                const iconType = this.querySelector('i').className;
                
                if (iconType.includes('home')) {
                    console.log('Ana Sayfa tıklandı');
                    // Ana sayfa işlemleri
                } else if (iconType.includes('code')) {
                    console.log('Kod Editörü tıklandı');
                    // Kod editörü işlemleri
                } else if (iconType.includes('folder')) {
                    console.log('Dosyalar tıklandı');
                    // Dosyalar işlemleri
                } else if (iconType.includes('terminal')) {
                    console.log('Terminal tıklandı');
                    // Terminal işlemleri
                } else if (iconType.includes('cog')) {
                    console.log('Ayarlar tıklandı');
                    // Ayarlar işlemleri
                }
            });
        });
    });
    
    // Dock animasyonları için ek CSS
    const style = document.createElement('style');
    style.textContent = `
        .dock-icon-clicked {
            transform: scale(0.8);
            transition: transform 0.2s;
        }
        
        @keyframes dock-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
    `;
    document.head.appendChild(style);
</script>

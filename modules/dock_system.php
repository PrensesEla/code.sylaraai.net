<!-- Kenetlenme Hedefleri - Küçük Kutular -->
<div id="dockTargetsContainer" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 998;">
    <div class="dock-targets-wrapper">
        <div class="dock-target-row">
            <div></div>
            <div class="dock-target" id="dock-target-top" data-dock-side="top"></div>
            <div></div>
        </div>
        <div class="dock-target-row">
            <div class="dock-target" id="dock-target-left" data-dock-side="left"></div>
            <div class="dock-target" id="dock-target-center" data-dock-side="center"></div>
            <div class="dock-target" id="dock-target-right" data-dock-side="right"></div>
        </div>
        <div class="dock-target-row">
            <div></div>
            <div class="dock-target" id="dock-target-bottom" data-dock-side="bottom"></div>
            <div></div>
        </div>
    </div>
</div>

<script>
/**
 * DockManager sınıfı - panellerin kenetlenmesini sağlayan bir sistemdir
 */
class DockManager {
    constructor(containerId, mainContentAreaId) {
        // Ana konteyner ve dock hedefleri
        this.container = document.getElementById(containerId);
        this.mainContentArea = document.getElementById(mainContentAreaId);
        this.dockTargets = document.querySelectorAll('.dock-target');
        
        // Kenetleme durumu için kullanılan değişkenler
        this.lastDockCheck = 0;
        this.lastTargetSide = null;
        
        // Sınıf her oluşturulduğunda olayları otomatik bağla
        this.init();
    }
    
    // Başlangıç ayarları ve olay bağlamaları
    init() {
        // Dock hedeflerine başlangıç stilleri uygula
        this.dockTargets.forEach(target => {
            if (target.id === 'dock-target-center') {
                target.style.backgroundColor = "rgba(255, 54, 201, 0.4)";
                target.style.boxShadow = "0 0 8px rgba(255, 54, 201, 0.3)";
            } else {
                target.style.backgroundColor = "rgba(255, 54, 201, 0.25)";
                target.style.boxShadow = "0 0 8px rgba(255, 54, 201, 0.3)";
            }
        });
    }
    
    // Paneli belirli bir tarafa kenetle
    dockPanel(side, panel) {
        if (!side || side === panel.currentDockSide) return;
        
        // Önce tüm dock sınıflarını kaldır
        panel.classList.remove('floating', 'docked-left', 'docked-right', 'docked-top', 'docked-bottom', 'docked-center');
        
        // Yeni dock sınıfını ekle
        panel.classList.add('docked-' + side);
        panel.currentDockSide = side;
        
        // Ana içerik alanını ayarla
        this.adjustMainContentArea(panel);
        
        // Özel bir olay tetikle (isteğe bağlı)
        const event = new CustomEvent('panel-docked', { 
            detail: { panel: panel, side: side }
        });
        document.dispatchEvent(event);
    }
    
    // Paneli kenetleme durumundan çıkar
    undockPanel(panel) {
        panel.classList.remove('docked-left', 'docked-right', 'docked-top', 'docked-bottom', 'docked-center');
        panel.classList.add('floating');
        panel.currentDockSide = null;
        
        // Ana içerik alanını görünür yap
        if (this.mainContentArea) {
            this.mainContentArea.style.display = "";
        }
        
        // Ana içerik alanını ayarla
        this.adjustMainContentArea(panel);
        
        // Özel bir olay tetikle (isteğe bağlı)
        const event = new CustomEvent('panel-undocked', { 
            detail: { panel: panel }
        });
        document.dispatchEvent(event);
    }
    
    // Ana içerik alanını panelin konumuna göre ayarla
    adjustMainContentArea(panel) {
        if (!this.mainContentArea) return;
        
        // Tüm kenar boşluklarını sıfırla
        this.mainContentArea.style.marginLeft = "";
        this.mainContentArea.style.marginRight = "";
        this.mainContentArea.style.marginTop = "";
        this.mainContentArea.style.marginBottom = "";
        this.mainContentArea.style.width = "";
        this.mainContentArea.style.height = "";
        
        // Panel kenetlenmişse, içerik alanını ayarla
        if (panel.currentDockSide === 'left') {
            this.mainContentArea.style.marginLeft = panel.offsetWidth + "px";
        } else if (panel.currentDockSide === 'right') {
            this.mainContentArea.style.marginRight = panel.offsetWidth + "px";
        } else if (panel.currentDockSide === 'top') {
            this.mainContentArea.style.marginTop = panel.offsetHeight + "px";
        } else if (panel.currentDockSide === 'bottom') {
            this.mainContentArea.style.marginBottom = panel.offsetHeight + "px";
        } else if (panel.currentDockSide === 'center') {
            // Merkezdeyse içerik alanı tamamen gizle
            this.mainContentArea.style.display = "none";
        } else {
            // Kenetlenmemişse içerik alanını tekrar göster
            this.mainContentArea.style.display = "";
        }
    }
    
    // Farenin şu an ne üzerinde olduğunu kontrol et ve gerekirse dock hedefini vurgula
    checkDocking(mouseX, mouseY) {
        let targetDockSide = null;
        
        // Performans için throttle yaparak her 50ms'de bir çalışsın
        if (Date.now() - this.lastDockCheck < 50) {
            return this.lastTargetSide || null;
        }
        
        this.lastDockCheck = Date.now();
        
        this.dockTargets.forEach(target => {
            const rect = target.getBoundingClientRect();
            if (mouseX >= rect.left && mouseX <= rect.right && 
                mouseY >= rect.top && mouseY <= rect.bottom) {
                // Üzerindeyken efekt
                if (target.id === 'dock-target-center') {
                    target.style.backgroundColor = "rgba(255, 54, 201, 0.8)";
                    target.style.boxShadow = "0 0 15px rgba(255, 54, 201, 0.7), inset 0 0 10px rgba(255, 255, 255, 0.6)";
                } else {
                    target.style.backgroundColor = "rgba(255, 54, 201, 0.7)";
                    target.style.boxShadow = "0 0 12px rgba(255, 54, 201, 0.6), inset 0 0 10px rgba(255, 255, 255, 0.4)";
                }
                targetDockSide = target.dataset.dockSide;
            } else {
                // Normal durum
                if (target.id === 'dock-target-center') {
                    target.style.backgroundColor = "rgba(255, 54, 201, 0.4)";
                    target.style.boxShadow = "0 0 8px rgba(255, 54, 201, 0.3)";
                } else {
                    target.style.backgroundColor = "rgba(255, 54, 201, 0.25)";
                    target.style.boxShadow = "0 0 8px rgba(255, 54, 201, 0.3)";
                }
            }
        });
        
        this.lastTargetSide = targetDockSide;
        return targetDockSide;
    }
    
    // Dock hedeflerini göster
    showDockTargets() {
        if (this.container) {
            this.container.style.display = "block";
        }
    }
    
    // Dock hedeflerini gizle
    hideDockTargets() {
        if (this.container) {
            this.container.style.display = "none";
        }
    }
}

// Global obje olarak tanımla (isteğe bağlı)
window.DockManager = DockManager;
</script>

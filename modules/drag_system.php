<script>
/**
 * DragManager sınıfı - panellerin sürüklenmesini sağlayan bir sistemdir
 */
class DragManager {
    constructor(panelId, headerSelector, dockManager = null) {
        // Panel ve başlık elementleri
        this.panel = document.getElementById(panelId);
        this.header = this.panel ? this.panel.querySelector(headerSelector) : null;
        
        // Dock Manager referansı (varsa)
        this.dockManager = dockManager;
        
        // Sürükleme durumu için değişkenler
        this.isDragging = false;
        this.offsetX = 0;
        this.offsetY = 0;
        this.animationFrame = null;
        
        // Panelin kenetleme durumu
        if (this.panel && !this.panel.hasOwnProperty('currentDockSide')) {
            this.panel.currentDockSide = null;
        }
        
        // Olay dinleyicilerini bağla
        this.init();
    }
    
    // Başlangıç ayarları ve olay bağlamaları
    init() {
        if (!this.panel || !this.header) {
            console.error('Panel veya başlık elementi bulunamadı.');
            return;
        }
        
        // Header'a tıklandığında sürüklemeyi başlat
        this.header.onmousedown = this.dragMouseDown.bind(this);
    }
    
    // Sürükleme başladığında çağrılan fonksiyon
    dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        
        this.isDragging = true;
        
        // Eğer panel kenetlenmişse ve sürüklemeye başlarsak, serbest bırak
        if (this.panel.currentDockSide && this.dockManager) {
            this.dockManager.undockPanel(this.panel);
            
            // Merkezden çıkarken paneli makul bir boyuta dönüştür ve ortaya konumlandır
            if (this.panel.currentDockSide === 'center') {
                this.panel.style.top = '50%';
                this.panel.style.left = '50%';
                this.panel.style.width = '300px';
                this.panel.style.height = '400px';
                this.panel.style.transform = 'translate(-50%, -50%)';
                
                // Kısa gecikmeyle transform'u kaldır ve normal pozisyonlama yap
                setTimeout(() => {
                    const rect = this.panel.getBoundingClientRect();
                    this.panel.style.transform = '';
                    this.panel.style.top = rect.top + 'px';
                    this.panel.style.left = rect.left + 'px';
                    
                    // Yeni ofsetleri hesapla
                    this.offsetX = e.clientX - this.panel.offsetLeft;
                    this.offsetY = e.clientY - this.panel.offsetTop;
                }, 10);
            } else {
                // Diğer kenarlardan çıkarken normal hesaplama
                this.offsetX = e.clientX - this.panel.offsetLeft;
                this.offsetY = e.clientY - this.panel.offsetTop;
            }
        } else {
            // Kenetli değilse, normal hesaplama
            this.offsetX = e.clientX - this.panel.offsetLeft;
            this.offsetY = e.clientY - this.panel.offsetTop;
        }
        
        // Sürüklerken stil ayarları
        this.panel.classList.add('floating');
        this.panel.style.zIndex = 1001; // En üstte göster
        
        // Dock hedeflerini göster (dock manager varsa)
        if (this.dockManager) {
            this.dockManager.showDockTargets();
        }
        
        // Global olay dinleyicilerini ekle
        document.onmouseup = this.closeDragElement.bind(this);
        document.onmousemove = this.elementDrag.bind(this);
    }
    
    // Sürükleme devam ederken çağrılan fonksiyon
    elementDrag(e) {
        if (!this.isDragging) return;
        e = e || window.event;
        e.preventDefault();
        
        // Yeni pozisyonu hesapla
        let newX = e.clientX - this.offsetX;
        let newY = e.clientY - this.offsetY;
        
        // Ekran sınırları içinde kalmayı sağla
        const layoutContainer = document.getElementById('ideLayoutContainer') || document.body;
        if (layoutContainer) {
            if (newX < 0) newX = 0;
            if (newY < 0) newY = 0;
            
            // Sağ ve alt sınırları kontrol et
            const maxX = layoutContainer.offsetWidth - this.panel.offsetWidth;
            const maxY = layoutContainer.offsetHeight - this.panel.offsetHeight;
            if (newX > maxX) newX = maxX;
            if (newY > maxY) newY = maxY;
        }
        
        // Daha pürüzsüz hareket için requestAnimationFrame kullan
        if (!this.animationFrame) {
            this.animationFrame = requestAnimationFrame(() => {
                this.panel.style.left = newX + "px";
                this.panel.style.top = newY + "px";
                this.animationFrame = null;
                
                // Dock kontrolü
                if (this.dockManager) {
                    this.dockManager.checkDocking(e.clientX, e.clientY);
                }
            });
        }
    }
    
    // Sürüklemeyi sonlandırdığımızda çağrılan fonksiyon
    closeDragElement(e) {
        // Global olay dinleyicilerini kaldır
        document.onmouseup = null;
        document.onmousemove = null;
        this.isDragging = false;
        
        // Panel z-index'ini normal duruma getir
        this.panel.style.zIndex = 1000;
        
        // Kenetleme kontrolü
        if (e && this.dockManager) {
            const targetSide = this.dockManager.checkDocking(e.clientX, e.clientY);
            if (targetSide) {
                this.dockManager.dockPanel(targetSide, this.panel);
            }
            
            // Dock hedeflerini gizle
            this.dockManager.hideDockTargets();
        }
    }
    
    // Paneli belirli bir pozisyona konumlandır
    setPosition(x, y) {
        if (this.panel) {
            this.panel.style.left = x + "px";
            this.panel.style.top = y + "px";
        }
    }
    
    // Paneli belirli bir boyuta ayarla
    setSize(width, height) {
        if (this.panel) {
            this.panel.style.width = width + "px";
            this.panel.style.height = height + "px";
        }
    }
}

// Global obje olarak tanımla (isteğe bağlı)
window.DragManager = DragManager;
</script>
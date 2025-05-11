/**
 * Drag System Module - Panel Hareket Sistemi
 * Bu modül, sürüklenebilir panellerin yönetimini sağlar
 */
class DragSystem {
    constructor() {
        this.activePanel = null;
        this.offset = { x: 0, y: 0 };
        this.highestZIndex = 1000;
        this.isDragging = false;

        // Başlangıçta tüm sürüklenebilir panelleri ayarla
        this.initDraggablePanels();

        // Global olay dinleyicileri
        document.addEventListener('mouseup', this.onDragEnd.bind(this));
        document.addEventListener('mousemove', this.onDragMove.bind(this));
    }

    initDraggablePanels() {
        const panels = document.querySelectorAll('.draggable-panel');
        panels.forEach(panel => {
            const header = panel.querySelector('.panel-header');
            if (header) {
                header.addEventListener('mousedown', (e) => this.onDragStart(e, panel));

                // Panel'e tıklandığında aktif hale getir
                panel.addEventListener('mousedown', () => this.setActivePanel(panel));
            }
        });
    }

    onDragStart(e, panel) {
        // Eğer olay başlık çubuğu düğmelerinden geliyorsa sürüklemeyi başlatma
        if (e.target.classList.contains('minimize-btn') || 
            e.target.classList.contains('maximize-btn') || 
            e.target.classList.contains('close-btn')) {
            return;
        }

        this.activePanel = panel;
        this.setHighestZIndex(panel);

        // Panel sınıfları kontrolü
        if (!panel.classList.contains('floating') && 
            (panel.classList.contains('docked-left') || 
             panel.classList.contains('docked-right') || 
             panel.classList.contains('docked-top') || 
             panel.classList.contains('docked-bottom') || 
             panel.classList.contains('docked-center'))) {

            // Paneli dock'dan çıkar ve floating hale getir
            panel.classList.remove('docked-left', 'docked-right', 'docked-top', 'docked-bottom', 'docked-center');
            panel.classList.add('floating');

            // Ana içerik alanını yeniden düzenle
            if (window.dockSystem) {
                window.dockSystem.adjustMainContentArea();
            }
        }

        // Sürükleme için fare pozisyonunu kaydet
        this.offset.x = e.clientX - panel.getBoundingClientRect().left;
        this.offset.y = e.clientY - panel.getBoundingClientRect().top;

        this.isDragging = true;

        // Dock hedeflerini göster
        if (window.dockSystem) {
            window.dockSystem.showDockTargets();
        }

        e.preventDefault();
    }

    onDragMove(e) {
        if (!this.activePanel || !this.isDragging) return;

        const panel = this.activePanel;

        // Yeni panel pozisyonunu hesapla
        const x = e.clientX - this.offset.x;
        const y = e.clientY - this.offset.y;

        // Paneli taşı
        panel.style.left = `${x}px`;
        panel.style.top = `${y}px`;

        // Dock hedeflerini kontrol et
        if (window.dockSystem) {
            window.dockSystem.checkDockTargets(e, panel);
        }
    }

    onDragEnd(e) {
        if (!this.activePanel || !this.isDragging) return;

        this.isDragging = false;

        // Dock işlemini tamamla
        if (window.dockSystem) {
            window.dockSystem.completeDocking(this.activePanel);
            window.dockSystem.hideDockTargets();
        }

        this.activePanel = null;
    }

    setHighestZIndex(panel) {
        this.highestZIndex += 1;
        panel.style.zIndex = this.highestZIndex;
    }

    setActivePanel(panel) {
        this.setHighestZIndex(panel);
    }

    // Yeni panel ekleme
    addDraggablePanel(panelElement) {
        const header = panelElement.querySelector('.panel-header');
        if (header) {
            header.addEventListener('mousedown', (e) => this.onDragStart(e, panelElement));
            panelElement.addEventListener('mousedown', () => this.setActivePanel(panelElement));
        }
        
        // Resize işlemleri için ResizeSystem'i kullan
        if (window.resizeSystem) {
            window.resizeSystem.addResizeToPanel(panelElement);
        }
    }
}

// Paneli minimize/maximize etme fonksiyonları
function minimizePanel(panel) {
    panel.classList.toggle('minimized');
}

function maximizePanel(panel) {
    panel.classList.toggle('maximized');
}

function closeCodePanel(panel) {
    panel.style.display = 'none';

    // Dock sistemini kullan
    if (window.dockSystem) {
        window.dockSystem.adjustMainContentArea();
    }
}

// Global olarak erişilebilir hale getir
window.dragSystem = new DragSystem();
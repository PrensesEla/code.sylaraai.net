/**
 * Dock System Module - Panel Kenetlenme Sistemi
 * Bu modül, panellerin ekran kenarlarına kenetlenmesini sağlar
 */
class DockSystem {
    constructor() {
        this.mainContentArea = document.getElementById('mainContentArea');
        this.dockTargets = [];
        this.dockType = null;
        this.panelToDock = null;

        // Dock hedefleri için gerekli elemanlar
        this.createDockTargets();
    }

    createDockTargets() {
        // Dock hedefleri için konteyner oluştur
        this.dockTargetsContainer = document.createElement('div');
        this.dockTargetsContainer.id = 'dockTargetsContainer';
        this.dockTargetsContainer.className = 'dock-targets-container';
        this.dockTargetsContainer.style.position = 'fixed';
        this.dockTargetsContainer.style.top = '0';
        this.dockTargetsContainer.style.left = '0';
        this.dockTargetsContainer.style.width = '100vw';
        this.dockTargetsContainer.style.height = '100vh';
        this.dockTargetsContainer.style.pointerEvents = 'none';
        this.dockTargetsContainer.style.display = 'none';
        this.dockTargetsContainer.style.zIndex = '9999';
        document.body.appendChild(this.dockTargetsContainer);

        // Dock hedefleri wrapper oluştur - gösterge merkezde olacak
        const dockWrapper = document.createElement('div');
        dockWrapper.className = 'dock-targets-wrapper';
        dockWrapper.style.position = 'absolute';
        dockWrapper.style.top = '50%';
        dockWrapper.style.left = '50%';
        dockWrapper.style.transform = 'translate(-50%, -50%)';
        dockWrapper.style.display = 'flex';
        dockWrapper.style.flexDirection = 'column';
        dockWrapper.style.gap = '2%';
        dockWrapper.style.alignItems = 'center';
        dockWrapper.style.justifyContent = 'center';
        dockWrapper.style.width = '320px';
        dockWrapper.style.height = '320px';
        dockWrapper.style.background = 'rgba(243, 105, 249, 0.2)';
        dockWrapper.style.borderRadius = '15px';
        dockWrapper.style.backdropFilter = 'blur(8px)';
        dockWrapper.style.WebkitBackdropFilter = 'blur(8px)';
        dockWrapper.style.border = '2px solid rgba(243, 105, 249, 0.4)';
        dockWrapper.style.boxShadow = '0 4px 25px rgba(243, 105, 249, 0.3)';
        this.dockTargetsContainer.appendChild(dockWrapper);

        // Üst dock hedefi satırı
        const topRow = document.createElement('div');
        topRow.className = 'dock-target-row';
        topRow.style.display = 'flex';
        topRow.style.gap = '2%';
        dockWrapper.appendChild(topRow);

        // Üst dock hedefi 
        const topDock = document.createElement('div');
        topDock.id = 'dock-target-top';
        topDock.className = 'dock-target';
        topDock.style.width = '120px';
        topDock.style.height = '70px';
        topDock.style.backgroundColor = 'rgba(243, 105, 249, 0.2)';
        topDock.style.border = '2px solid rgba(243, 105, 249, 0.5)';
        topDock.style.borderRadius = '10px';
        topDock.style.transition = 'all 0.2s ease';
        topDock.style.display = 'flex';
        topDock.style.justifyContent = 'center';
        topDock.style.alignItems = 'center';
        topRow.appendChild(topDock);

        // İkonlar ekle
        const topIcons = document.createElement('div');
        topIcons.style.display = 'flex';
        topIcons.style.gap = '4px';
        topDock.appendChild(topIcons);

        for (let i = 0; i < 5; i++) {
            const icon = document.createElement('div');
            icon.style.width = '8px';
            icon.style.height = '8px';
            icon.style.backgroundColor = 'rgba(243, 105, 249, 0.7)';
            icon.style.borderRadius = '2px';
            topIcons.appendChild(icon);
        }

        // Orta dock hedefleri satırı
        const middleRow = document.createElement('div');
        middleRow.className = 'dock-target-row';
        middleRow.style.display = 'flex';
        middleRow.style.gap = '2%';
        dockWrapper.appendChild(middleRow);

        // Sol dock hedefi
        const leftDock = document.createElement('div');
        leftDock.id = 'dock-target-left';
        leftDock.className = 'dock-target';
        leftDock.style.width = '70px';
        leftDock.style.height = '120px';
        leftDock.style.backgroundColor = 'rgba(243, 105, 249, 0.2)';
        leftDock.style.border = '2px solid rgba(243, 105, 249, 0.5)';
        leftDock.style.borderRadius = '10px';
        leftDock.style.transition = 'all 0.2s ease';
        leftDock.style.display = 'flex';
        leftDock.style.flexDirection = 'column';
        leftDock.style.justifyContent = 'center';
        leftDock.style.alignItems = 'flex-start';
        leftDock.style.paddingLeft = '10px';
        middleRow.appendChild(leftDock);

        // Sol ikonlar ekle
        const leftIcons = document.createElement('div');
        leftIcons.style.display = 'flex';
        leftIcons.style.flexDirection = 'column';
        leftIcons.style.gap = '4px';
        leftDock.appendChild(leftIcons);

        for (let i = 0; i < 5; i++) {
            const icon = document.createElement('div');
            icon.style.width = '8px';
            icon.style.height = '8px';
            icon.style.backgroundColor = 'rgba(243, 105, 249, 0.7)';
            icon.style.borderRadius = '2px';
            leftIcons.appendChild(icon);
        }

        // Merkez dock hedefi
        const centerDock = document.createElement('div');
        centerDock.id = 'dock-target-center';
        centerDock.className = 'dock-target';
        centerDock.style.width = '120px';
        centerDock.style.height = '120px';
        centerDock.style.backgroundColor = 'rgba(243, 105, 249, 0.2)';
        centerDock.style.border = '2px solid rgba(243, 105, 249, 0.5)';
        centerDock.style.borderRadius = '10px';
        centerDock.style.transition = 'all 0.2s ease';
        middleRow.appendChild(centerDock);

        // Sağ dock hedefi
        const rightDock = document.createElement('div');
        rightDock.id = 'dock-target-right';
        rightDock.className = 'dock-target';
        rightDock.style.width = '70px';
        rightDock.style.height = '120px';
        rightDock.style.backgroundColor = 'rgba(243, 105, 249, 0.2)';
        rightDock.style.border = '2px solid rgba(243, 105, 249, 0.5)';
        rightDock.style.borderRadius = '10px';
        rightDock.style.transition = 'all 0.2s ease';
        rightDock.style.display = 'flex';
        rightDock.style.flexDirection = 'column';
        rightDock.style.justifyContent = 'center';
        rightDock.style.alignItems = 'flex-end';
        rightDock.style.paddingRight = '10px';
        middleRow.appendChild(rightDock);

        // Sağ ikonlar ekle
        const rightIcons = document.createElement('div');
        rightIcons.style.display = 'flex';
        rightIcons.style.flexDirection = 'column';
        rightIcons.style.gap = '4px';
        rightDock.appendChild(rightIcons);

        for (let i = 0; i < 5; i++) {
            const icon = document.createElement('div');
            icon.style.width = '8px';
            icon.style.height = '8px';
            icon.style.backgroundColor = 'rgba(243, 105, 249, 0.7)';
            icon.style.borderRadius = '2px';
            rightIcons.appendChild(icon);
        }

        // Alt dock hedefi satırı
        const bottomRow = document.createElement('div');
        bottomRow.className = 'dock-target-row';
        bottomRow.style.display = 'flex';
        bottomRow.style.gap = '2%';
        dockWrapper.appendChild(bottomRow);

        // Alt dock hedefi
        const bottomDock = document.createElement('div');
        bottomDock.id = 'dock-target-bottom';
        bottomDock.className = 'dock-target';
        bottomDock.style.width = '120px';
        bottomDock.style.height = '70px';
        bottomDock.style.backgroundColor = 'rgba(243, 105, 249, 0.2)';
        bottomDock.style.border = '2px solid rgba(243, 105, 249, 0.5)';
        bottomDock.style.borderRadius = '10px';
        bottomDock.style.transition = 'all 0.2s ease';
        bottomDock.style.display = 'flex';
        bottomDock.style.justifyContent = 'center';
        bottomDock.style.alignItems = 'center';
        bottomRow.appendChild(bottomDock);

        // Alt ikonlar ekle
        const bottomIcons = document.createElement('div');
        bottomIcons.style.display = 'flex';
        bottomIcons.style.gap = '4px';
        bottomDock.appendChild(bottomIcons);

        for (let i = 0; i < 5; i++) {
            const icon = document.createElement('div');
            icon.style.width = '8px';
            icon.style.height = '8px';
            icon.style.backgroundColor = 'rgba(243, 105, 249, 0.7)';
            icon.style.borderRadius = '2px';
            bottomIcons.appendChild(icon);
        }

        // Dock hedeflerini diziye ekle
        this.dockTargets = [
            { element: topDock, position: 'top' },
            { element: leftDock, position: 'left' },
            { element: centerDock, position: 'center' },
            { element: rightDock, position: 'right' },
            { element: bottomDock, position: 'bottom' }
        ];
    }

    showDockTargets() {
        this.dockTargetsContainer.style.display = 'block';
        const wrapper = this.dockTargetsContainer.querySelector('.dock-targets-wrapper');
        if (wrapper) {
            setTimeout(() => {
                wrapper.classList.add('visible');
            }, 10);
        }
    }

    hideDockTargets() {
        const wrapper = this.dockTargetsContainer.querySelector('.dock-targets-wrapper');
        if (wrapper) {
            wrapper.classList.remove('visible');
            setTimeout(() => {
                this.dockTargetsContainer.style.display = 'none';
            }, 300);
        }

        // Aktif hedefleri de temizle
        this.dockTargets.forEach(target => {
            target.element.classList.remove('dock-target-active');
        });

        this.dockType = null;
    }

    checkDockTargets(e, panel) {
        this.panelToDock = panel;
        let activeDockTarget = null;

        // Her hedefi kontrol et
        this.dockTargets.forEach(target => {
            const rect = target.element.getBoundingClientRect();

            // Fare hedefin üzerinde mi?
            if (e.clientX >= rect.left && e.clientX <= rect.right &&
                e.clientY >= rect.top && e.clientY <= rect.bottom) {
                target.element.classList.add('dock-target-active');
                activeDockTarget = target.position;
            } else {
                target.element.classList.remove('dock-target-active');
            }
        });

        this.dockType = activeDockTarget;
    }

    completeDocking(panel) {
        if (!this.dockType || !panel) return;

        // Panel sınıflarını temizle
        panel.classList.remove('floating', 'docked-left', 'docked-right', 'docked-top', 'docked-bottom', 'docked-center');

        // Yeni dock sınıfını ekle
        panel.classList.add(`docked-${this.dockType}`);

        // Panelin stillerini dock tipine göre ayarla
        switch(this.dockType) {
            case 'left':
                panel.style.top = '0';
                panel.style.left = '0';
                panel.style.width = '300px';
                panel.style.height = '100%';
                break;
            case 'right':
                panel.style.top = '0';
                panel.style.right = '0';
                panel.style.left = 'auto';
                panel.style.width = '300px';
                panel.style.height = '100%';
                break;
            case 'top':
                panel.style.top = '0';
                panel.style.left = '0';
                panel.style.width = '100%';
                panel.style.height = '300px';
                break;
            case 'bottom':
                panel.style.bottom = '0';
                panel.style.top = 'auto';
                panel.style.left = '0';
                panel.style.width = '100%';
                panel.style.height = '300px';
                break;
            case 'center':
                panel.style.top = '10%';
                panel.style.left = '10%';
                panel.style.width = '80%';
                panel.style.height = '80%';
                break;
        }

        // Ana içerik alanını ayarla
        this.adjustMainContentArea();

        // Dock işlemini temizle
        this.dockType = null;
        this.panelToDock = null;
    }

    adjustMainContentArea() {
        // Kenarlardaki dock'lara göre ana içerik alanını ayarla
        let marginLeft = 0;
        let marginRight = 0;
        let marginTop = 0;
        let marginBottom = 0;

        // Tüm dock'lu panelleri kontrol et
        document.querySelectorAll('.draggable-panel').forEach(panel => {
            if (panel.style.display === 'none') return; // Gizli panelleri yoksay

            if (panel.classList.contains('docked-left')) {
                marginLeft = Math.max(marginLeft, panel.offsetWidth);
            }
            if (panel.classList.contains('docked-right')) {
                marginRight = Math.max(marginRight, panel.offsetWidth);
            }
            if (panel.classList.contains('docked-top')) {
                marginTop = Math.max(marginTop, panel.offsetHeight);
            }
            if (panel.classList.contains('docked-bottom')) {
                marginBottom = Math.max(marginBottom, panel.offsetHeight);
            }
        });

        // Ana içerik alanını güncelle
        if (this.mainContentArea) {
            this.mainContentArea.style.marginLeft = marginLeft + 'px';
            this.mainContentArea.style.marginRight = marginRight + 'px';
            this.mainContentArea.style.marginTop = marginTop + 'px';
            this.mainContentArea.style.marginBottom = marginBottom + 'px';
            this.mainContentArea.style.width = `calc(100% - ${marginLeft + marginRight}px)`;
            this.mainContentArea.style.height = `calc(100% - ${marginTop + marginBottom}px)`;
        }
    }

    // Panel kapatma fonksiyonu
    closePanel(panel) {
        if (panel) {
            panel.style.display = 'none';
            this.adjustMainContentArea();
        }
    }
}

// Global olarak erişilebilir hale getir
window.dockSystem = new DockSystem();
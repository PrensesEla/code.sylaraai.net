function openMenuPanels(panelElement) {
    if (panelElement) {
        panelElement.style.display = "block";

        // Z-index'i en yükseğe çıkar
        if (window.dragSystem) {
            window.dragSystem.setHighestZIndex(panelElement);
        }
    }
}

function closePanel(panelElement) {
    if (panelElement) {
        panelElement.style.display = "none";

        // Dock sistemini kullan
        if (window.dockSystem) {
            window.dockSystem.adjustMainContentArea();
        }
    }
}

// Yeni dosya oluştur
function createNewFile() {
    if (window.panelManager) {
        const panel = window.panelManager.openNewCodeFile();
        if (panel) {
            openMenuPanels(panel);
        }
    }
}

// Dosyayı aç
function openFile(filePath) {
    if (window.panelManager) {
        const panel = window.panelManager.openFile(filePath);
        if (panel) {
            openMenuPanels(panel);
        }
    }
}

/**
 * Panel Manager Module - Panel Yönetim Sistemi
 * Bu modül, IDE'deki panellerin oluşturulması, açılması ve yönetimini sağlar
 */
class PanelManager {
    constructor() {
        this.panels = {};
        this.activePanels = [];
        
        // Başlangıçta mevcut panelleri kaydet
        this.initExistingPanels();
    }
    
    initExistingPanels() {
        // Mevcut panelleri bul ve kaydet
        document.querySelectorAll('.draggable-panel').forEach((panel, index) => {
            const panelId = panel.id || `panel-${index}`;
            this.panels[panelId] = panel;
            
            // Eğer panel görünür ise aktif panellere ekle
            if (panel.style.display !== 'none') {
                this.activePanels.push(panelId);
            }
        });
    }
    
    // Panel oluşturma
    createPanel(options) {
        const { id, title, content, width, height, x, y } = options;
        
        // Panel zaten varsa, göster ve döndür
        if (this.panels[id]) {
            this.showPanel(id);
            return this.panels[id];
        }
        
        // Yeni panel oluştur
        const panel = document.createElement('div');
        panel.id = id;
        panel.className = 'draggable-panel floating';
        panel.style.width = width || '400px';
        panel.style.height = height || '300px';
        panel.style.left = x || '100px';
        panel.style.top = y || '100px';
        
        // Panel başlığı
        const header = document.createElement('div');
        header.className = 'panel-header';
        header.innerHTML = `
            <span class="title-text">${title || 'Panel'}</span>
            <div class="panel-controls">
                <span class="minimize-btn" onclick="minimizePanel(this.closest('.draggable-panel'))">_</span>
                <span class="maximize-btn" onclick="maximizePanel(this.closest('.draggable-panel'))">□</span>
                <span class="close-btn" onclick="closeCodePanel(this.closest('.draggable-panel'))">&times;</span>
            </div>
        `;
        panel.appendChild(header);
        
        // Panel içeriği
        const contentDiv = document.createElement('div');
        contentDiv.className = 'panel-content';
        
        if (typeof content === 'string') {
            contentDiv.innerHTML = content;
        } else if (content instanceof HTMLElement) {
            contentDiv.appendChild(content);
        }
        
        panel.appendChild(contentDiv);
        
        // Paneli sayfaya ekle
        document.getElementById('ideLayoutContainer').appendChild(panel);
        
        // Paneli kaydet
        this.panels[id] = panel;
        this.activePanels.push(id);
        
        // Sürüklenebilir olarak ayarla
        if (window.dragSystem) {
            window.dragSystem.addDraggablePanel(panel);
        }
        
        return panel;
    }
    
    // Paneli göster
    showPanel(id) {
        const panel = this.panels[id];
        if (panel) {
            panel.style.display = 'block';
            
            // Eğer panel aktif paneller listesinde değilse ekle
            if (!this.activePanels.includes(id)) {
                this.activePanels.push(id);
            }
            
            // Paneli öne getir
            if (window.dragSystem) {
                window.dragSystem.setActivePanel(panel);
            }
        }
        return panel;
    }
    
    // Paneli gizle
    hidePanel(id) {
        const panel = this.panels[id];
        if (panel) {
            panel.style.display = 'none';
            
            // Aktif paneller listesinden çıkar
            const index = this.activePanels.indexOf(id);
            if (index > -1) {
                this.activePanels.splice(index, 1);
            }
            
            // Ana içerik alanını güncelle
            if (window.dockSystem) {
                window.dockSystem.adjustMainContentArea();
            }
        }
    }
    
    // Paneli kapat
    closePanel(id) {
        this.hidePanel(id);
    }
    
    // Dosyayı aç
    openFile(filePath) {
        // Bir dosya paneli oluştur
        const fileId = `file-${filePath.replace(/[^\w]/g, '-')}`;
        
        // Panel zaten varsa göster
        if (this.panels[fileId]) {
            return this.showPanel(fileId);
        }
        
        // Kodu göstermek için bir kod editörü içeren yeni bir panel oluştur
        return this.createPanel({
            id: fileId,
            title: `${filePath}`,
            content: `<div class="code-editor-wrapper">
                        <textarea class="code-editor" spellcheck="false">// ${filePath} içeriği burada gösterilecek</textarea>
                      </div>`,
            width: '600px',
            height: '400px',
            x: '150px',
            y: '80px'
        });
    }
}

// Global olarak erişilebilir hale getir
window.panelManager = new PanelManager();

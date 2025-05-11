
/**
 * Resize System Module - Panel Boyutlandırma Sistemi
 * Bu modül, panellerin boyutlandırılmasını yönetir
 */
class ResizeSystem {
    constructor() {
        // Mevcut panellere resize kontrolü ekle
        setTimeout(() => this.addResizeToExistingPanels(), 500);
    }
    
    // Resize işlemleri için kenar ve köşe kontrolleri ekle
    addResizeHandles(panel) {
        // Zaten resize handles varsa ekleme
        if (panel.querySelector('.resize-handle')) return;
        
        const positions = [
            'top', 'right', 'bottom', 'left', 
            'top-left', 'top-right', 'bottom-left', 'bottom-right'
        ];
        
        positions.forEach(pos => {
            const handle = document.createElement('div');
            handle.className = `resize-handle resize-${pos}`;
            panel.appendChild(handle);
            
            // Resize olayı dinleyicisi ekle
            handle.addEventListener('mousedown', (e) => {
                // Panel dock'landıysa resize işlemini devre dışı bırak
                if (panel.classList.contains('docked-left') || 
                    panel.classList.contains('docked-right') || 
                    panel.classList.contains('docked-top') || 
                    panel.classList.contains('docked-bottom') || 
                    panel.classList.contains('docked-center')) {
                    return;
                }
                
                e.preventDefault();
                e.stopPropagation();
                
                // Panel'i aktif hale getir
                if (window.dragSystem) {
                    window.dragSystem.setActivePanel(panel);
                }
                
                // Panel ölçülerini ve pozisyonunu kaydet
                const rect = panel.getBoundingClientRect();
                const startX = e.clientX;
                const startY = e.clientY;
                const startWidth = rect.width;
                const startHeight = rect.height;
                const startLeft = panel.offsetLeft;
                const startTop = panel.offsetTop;
                
                // Resize tip'ini belirle
                const resizeType = pos;
                
                // Resize işlemi için olay dinleyicisi ekle
                const onResize = (e) => {
                    // X ve Y değişimlerini hesapla
                    const deltaX = e.clientX - startX;
                    const deltaY = e.clientY - startY;
                    
                    // Minimum boyutlar
                    const minWidth = 200;
                    const minHeight = 150;
                    
                    // Pozisyona göre resize işlemleri
                    switch (resizeType) {
                        case 'right':
                            panel.style.width = `${Math.max(minWidth, startWidth + deltaX)}px`;
                            break;
                        case 'left':
                            const newWidth = Math.max(minWidth, startWidth - deltaX);
                            panel.style.width = `${newWidth}px`;
                            panel.style.left = `${startLeft + startWidth - newWidth}px`;
                            break;
                        case 'bottom':
                            panel.style.height = `${Math.max(minHeight, startHeight + deltaY)}px`;
                            break;
                        case 'top':
                            const newHeight = Math.max(minHeight, startHeight - deltaY);
                            panel.style.height = `${newHeight}px`;
                            panel.style.top = `${startTop + startHeight - newHeight}px`;
                            break;
                        case 'top-left':
                            const newWidthTL = Math.max(minWidth, startWidth - deltaX);
                            const newHeightTL = Math.max(minHeight, startHeight - deltaY);
                            panel.style.width = `${newWidthTL}px`;
                            panel.style.height = `${newHeightTL}px`;
                            panel.style.left = `${startLeft + startWidth - newWidthTL}px`;
                            panel.style.top = `${startTop + startHeight - newHeightTL}px`;
                            break;
                        case 'top-right':
                            const newWidthTR = Math.max(minWidth, startWidth + deltaX);
                            const newHeightTR = Math.max(minHeight, startHeight - deltaY);
                            panel.style.width = `${newWidthTR}px`;
                            panel.style.height = `${newHeightTR}px`;
                            panel.style.top = `${startTop + startHeight - newHeightTR}px`;
                            break;
                        case 'bottom-left':
                            const newWidthBL = Math.max(minWidth, startWidth - deltaX);
                            const newHeightBL = Math.max(minHeight, startHeight + deltaY);
                            panel.style.width = `${newWidthBL}px`;
                            panel.style.height = `${newHeightBL}px`;
                            panel.style.left = `${startLeft + startWidth - newWidthBL}px`;
                            break;
                        case 'bottom-right':
                            panel.style.width = `${Math.max(minWidth, startWidth + deltaX)}px`;
                            panel.style.height = `${Math.max(minHeight, startHeight + deltaY)}px`;
                            break;
                    }
                };
                
                // Resize işlemini bitirme olayı
                const onResizeEnd = () => {
                    document.removeEventListener('mousemove', onResize);
                    document.removeEventListener('mouseup', onResizeEnd);
                };
                
                // Belge olaylarını ekle
                document.addEventListener('mousemove', onResize);
                document.addEventListener('mouseup', onResizeEnd);
            });
        });
    }
    
    // Yeni eklenen panele resize kontrolü ekle
    addResizeToPanel(panel) {
        this.addResizeHandles(panel);
    }
    
    // Başlangıçta mevcut panellere resize kontrolü ekle
    addResizeToExistingPanels() {
        const panels = document.querySelectorAll('.draggable-panel');
        panels.forEach(panel => {
            this.addResizeHandles(panel);
        });
    }
}

// Global olarak erişilebilir hale getir
window.resizeSystem = new ResizeSystem();

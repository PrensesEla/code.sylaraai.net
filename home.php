
<?php include("header.php"); ?>
<div id="ideLayoutContainer" style="position: relative; width: 100%; height: calc(100vh - 40px); overflow: hidden;">
    <div id="mainContentArea" style="margin-left: 0px; width: 100%; height: 100%; transition: margin 0.3s ease; position: relative;">
        <!-- Bu alan boş bırakılır, dock sistemi için gereklidir -->
    </div>
    <?php include("pages/panel/file_panel.php"); ?>
    <?php include("pages/code_blank.php"); ?>
</div>

<!-- Drag ve Dock sistemi modüllerini ekle -->
<script src="assets/js/drag-system.js"></script>
<script src="assets/js/resize-system.js"></script>
<script src="assets/js/dock-system.js"></script>
<script src="assets/js/panel-manager.js"></script>

<!-- Panel sistemleri için başlangıç script'i -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dosya gezgini panelini göster
        const filePanel = document.getElementById('fileExplorerPanel');
        if (filePanel) {
            filePanel.style.display = 'block';
        }
        
        // Dosya ağacındaki dosyalara tıklama işlevi
        document.querySelectorAll('.tree-item.file').forEach(fileItem => {
            fileItem.addEventListener('click', function() {
                const fileName = this.querySelector('.item-text').textContent;
                // Dosya yolunu oluştur (örnek)
                const filePath = 'alışkanlıklar/' + fileName;
                
                // Dosyayı aç
                if (window.panelManager) {
                    const panel = window.panelManager.openFile(filePath);
                    if (panel) {
                        panel.style.display = 'block';
                    }
                }
            });
        });
    });
</script>
<?php include("footer.php"); ?>

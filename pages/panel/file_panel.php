<!-- Dosya Gezgini Paneli -->
<div id="fileExplorerPanel" class="draggable-panel floating">
    <div id="fileExplorerHeader" class="panel-header">
        <span class="title-text">Dosya Gezgini</span>
        <div class="panel-controls">
            <span class="minimize-btn" onclick="minimizePanel(this.closest('.draggable-panel'))">_</span>
            <span class="maximize-btn" onclick="maximizePanel(this.closest('.draggable-panel'))">□</span>
            <span class="close-btn" onclick="closeCodePanel(this.closest('.draggable-panel'))">&times;</span>
        </div>
    </div>
    <div id="fileExplorerContent" class="panel-content">
        <div class="windows-file-explorer">
            <ul class="file-tree">
                <li class="tree-item folder expanded">
                    <span class="folder-icon"></span>
                    <span class="item-text">Sistem Klasörleri (Sırasıyla)</span>
                    <ul>
                        <li class="tree-item folder expanded">
                            <span class="folder-icon"></span>
                            <span class="item-text">alışkanlıklar</span>
                            <ul>
                                <li class="tree-item file">
                                    <span class="file-icon"></span>
                                    <span class="item-text">KontrolCümlesi.txt</span>
                                </li>
                                <li class="tree-item file">
                                    <span class="file-icon"></span>
                                    <span class="item-text">KimlikGörünümü.mdb</span>
                                </li>
                                <li class="tree-item file">
                                    <span class="file-icon"></span>
                                    <span class="item-text">BütünHesaplamalar.xlsx</span>
                                </li>
                            </ul>
                        </li>
                        <li class="tree-item folder">
                            <span class="folder-icon"></span>
                            <span class="item-text">Metodlar</span>
                        </li>
                        <li class="tree-item file">
                            <span class="file-icon"></span>
                            <span class="item-text">UygulamaGir.cs</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Dosya ağacı için tüm klasörleri seç
    var folders = document.querySelectorAll('.tree-item.folder');

    // Klasörlere tıklama işlevi ekle - modern davranış
    folders.forEach(folder => {
        folder.addEventListener('click', function(e) {
            // Dosyaya tu0131klandıysa bu ku0131smu0131 iu015flet, klasöre tu0131klandıysa aç/kapat
            if (e.target.closest('.folder')) {
                this.classList.toggle('expanded');
                // Seçim efekti ekle
                document.querySelectorAll('.tree-item').forEach(item => item.classList.remove('selected'));
                this.classList.add('selected');
                e.stopPropagation();
            }
        });
    });

    // Ağaçtaki tüm dosya öğelerine tıklama işlevi ekle - modern davranış
    document.querySelectorAll('.tree-item.file').forEach(item => {
        item.addEventListener('click', function(e) {
            // Önce tüm seçimleri temizle
            document.querySelectorAll('.tree-item.selected').forEach(selectedItem => {
                selectedItem.classList.remove('selected');
            });

            // Bu öğeyi seç
            this.classList.add('selected');

            // Eğer bir dosyaya tu0131klandu0131ysa, bir editu00f6r açacakmu0131ş gibi konsola bilgi yazdır
            console.log('Dosya açılıyor: ' + this.querySelector('.item-text').textContent);

            e.stopPropagation(); // Olay kabarcıklanmasını durdur
        });
    });

    // Windows dosya ağacı için başlangıçta klasörlerin açık olmasını sağla
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.tree-item.folder.expanded').forEach(folder => {
            // Expanded class'ı zaten var, bu nedenle burada ekstra bir şey yapmaya gerek yok
        });
    });
</script>
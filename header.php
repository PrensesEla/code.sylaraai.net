<style>

    </style>
<nav class="vscode-menu-bar">
    <ul>
        <!-- File Menu -->
        <li>
            <a>Dosya</a>
            <ul>
                <li><a>Yeni Dosyası <span class="shortcut">Ctrl+N</span></a></li>
                <li><a>Yeni Klasör <span class="shortcut">Ctrl+Alt+Windows+N</span></a></li>
                <li><a>Yeni Pencere <span class="shortcut">Ctrl+Shift+N</span></a></li>
                <li><hr></li>
                <li><a>Dosya Aç... <span class="shortcut">Ctrl+O</span></a></li>
                <li><a>Proje Aç... <span class="shortcut">Ctrl+K Ctrl+O</span></a></li>
                <li><a>Sunucu Uzerinden Proje Aç...</a></li>
                <li><a>Son Açılanlar</a> <!-- Right arrow for submenu --></li>
                <li><hr></li>
                <li><a>Projeyi Kapat</a></li>
                <li><a>Sunucu Uzerinden Projeyi Kapat...</a></li>
                <li><hr></li>
                <li><a>Kaydet <span class="shortcut">Ctrl+S</span></a></li>
                <li><a>Farklı Kaydet... <span class="shortcut">Ctrl+Shift+S</span></a></li>
                <li><a>Tümünü Kaydet <span class="shortcut">Ctrl+S</span></a></li>
                <li><hr></li>
                <li><a>Tercihler</a></li>
                <li><hr></li>
                <li><a>Çıkış</a></li>
            </ul>
        </li>
        <!-- Edit Menu -->
        <li>
            <a>Düzenle</a>
            <ul>
                <li><a>Geri Al <span class="shortcut">Ctrl+Z</span></a></li>
                <li><a>Yinele <span class="shortcut">Ctrl+Y</span></a></li>
                <li><hr></li>
                <li><a>Kes <span class="shortcut">Ctrl+X</span></a></li>
                <li><a>Kopyala <span class="shortcut">Ctrl+C</span></a></li>
                <li><a>Yapıştır <span class="shortcut">Ctrl+V</span></a></li>
                <li><hr></li>
                <li><a>Tümünü Seç <span class="shortcut">Ctrl+A</span></a></li>
                <li><hr></li>
                <li><a>Bul <span class="shortcut">Ctrl+F</span></a></li>
                <li><a>Değiştir <span class="shortcut">Ctrl+H</span></a></li>
                <li><hr></li>
                <li><a>Dosyalarda Bul <span class="shortcut">Ctrl+</span></a></li>
                <li><a>Dosyalarda Değiştir <span class="shortcut">Ctrl+J</span></a></li>
            </ul>
        </li>
        <!-- Paneller Menu -->
        <li>
            <a>Paneller</a>
            <ul>
                <li><a>Tam Ekran <span class="shortcut">F11</span></a></li>
                <li><a>Yakınlaştır <span class="shortcut">Ctrl+=</span></a></li>
                <li><a>Uzaklaştır <span class="shortcut">Ctrl+-</span></a></li>
                <li><a>Yakınlaştırmayı Sıfırla <span class="shortcut">Ctrl+NumPad0</span></a></li>
                <li><hr></li>
                <li><a onclick="openMenuPanels(document.getElementById('fileExplorerPanel'))">Dosya Gezgin <span class="shortcut">Ctrl+Shift+E</span></a></li>
                <li><a>Hatalar <span class="shortcut">Ctrl+M</span></a></li>
                <li><a>Çıktı <span class="shortcut">Ctrl+Ç</span></a></li>
                <li><hr></li>
                <li><a>Terminal <span class="shortcut">Ctrl+T</span></a></li>
                <li><a>Çalıştır <span class="shortcut">Ctrl+R</span></a></li>
                <li><hr></li>
                <li><a>Dosyaya Git... <span class="shortcut">Ctrl+P</span></a></li>
                <li><a>Kod Satırına Git... <span class="shortcut">Ctrl+G</span></a></li>
            </ul>
        </li>
        <!-- Run Menu -->
        <li>
            <a>Çalıştır</a>
            <ul>
                <li><a>Hata Ayıklamayı Başlat <span class="shortcut">F5</span></a></li>
                <li><a>Hata Ayıklamadan Çalıştır <span class="shortcut">Ctrl+F5</span></a></li>
                <li><a>Hata Ayıklamayı Durdur <span class="shortcut">Shift+F5</span></a></li>
                <li><a>Hata Ayıklamayı Yeniden Başlat <span class="shortcut">Ctrl+Shift+F5</span></a></li>
                <li><a>Devam Et <span class="shortcut">F5</span></a></li>
                <li><hr></li>
                <li><a>Yapılandırmaları Aç</a></li>
                <li><a>Yapılandırma Ekle...</a></li>
                <li><hr></li>
                <li><a>Kesme Noktası</a></li>
                <li><hr></li>
                <li><a>Tüm Kesme Noktalarını Etkinleştir</a></li>
                <li><a>Tüm Kesme Noktalarını Devre Dışı Bırak</a></li>
                <li><a>Tüm Kesme Noktalarını Kaldır</a></li>
            </ul>
        </li>
        <!-- Help Menu -->
        <li>
            <a>Yardım</a>
            <ul>
                <li><a>Hoş Geldiniz</a></li>
                <li><a>Dokümantasyon</a></li>
                <li><a>Sürüm Notları</a></li>
                <li><hr></li>
                <li><a>Klavye Kısayolları Referansı <span class="shortcut">Alt+K</span></a></li>
                <li><a>Video Eğitimleri</a></li>
                <li><a>İpuçları ve Püf Noktaları</a></li>
                <li><hr></li>
                <li><a>YouTube'da Bize Katılın</a></li>
                <li><a>Sorun Bildir</a></li>
                <li><hr></li>
                <li><a>Lisansı Görüntüle</a></li>
                <li><hr></li>
                <li><a>Güncelleştirmeleri Denetle...</a></li>
                <li><hr></li>
                <li><a>Hakkında</a></li>
            </ul>
        </li>
    </ul>
</nav>

<script>
// Basic JavaScript for handling nested submenus if needed,
// For now, CSS hover handles the display.
// More complex interactions (like click-to-open) would require more JS.
document.addEventListener('DOMContentLoaded', function () {
    var menuItems = document.querySelectorAll('.vscode-menu-bar ul li ul li > a');

    menuItems.forEach(item => {
        var subMenu = item.nextElementSibling;
        if (subMenu && subMenu.tagName === 'UL') {
            // This indicates a submenu exists
            // item.innerHTML += ' <span class="submenu-arrow">&#x25B6;</span>'; // Add arrow if not manually added
        }
    });
});
</script>
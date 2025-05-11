<!-- Dosya Gezgini Paneli -->
<div id="fileExplorerPanel" class="draggable-panel floating">
    <div id="fileExplorerHeader" class="panel-header">
        <span class="title-text">Dosya Gezgini</span>
        <span class="close-btn" onclick="closePanel_filepanel(this.parentElement.parentElement)">&times;</span>
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

<script>
  // Panel ve gerekli elementleri seç
  var dockTargetsContainer_filepanel = document.getElementById("dockTargetsContainer_filepanel");
  var dockTargets_filepanel = document.querySelectorAll(".dock-target_filepanel");
  var mainContentArea_filepanel = parent.document.getElementById("mainContentArea_filepanel"); // home.php'deki ana içerik alanı
  
  // Dock sistemi için değişkenler
  let isDragging_filepanel = false;
  let offsetX_filepanel, offsetY_filepanel;
  let currentDockSide_filepanel = null; // 'left', 'right', 'top', 'bottom', or null (floating)
  
  // Paneli belirli bir tarafa kenetle
  function dockPanel_filepanel(side, panel) {
      if (!side || side === currentDockSide) return;
      
      // Önce tüm dock sınıflarını kaldır
      panel.classList.remove('floating', 'docked-left', 'docked-right', 'docked-top', 'docked-bottom');
      
      // Yeni dock sınıfını ekle
      panel.classList.add('docked-' + side);
      currentDockSide = side;
      
      // Ana içerik alanını ayarla
      adjustMainContentArea_filepanel(panel);
  }

   // Ana içerik alanını panelin konumuna göre ayarla
   function adjustMainContentArea_filepanel(panel) {
      if (!mainContentArea_filepanel) return;
      
      // Tüm kenar boşluklarını sıfırla
      mainContentArea_filepanel.style.marginLeft = "";
      mainContentArea_filepanel.style.marginRight = "";
      mainContentArea_filepanel.style.marginTop = "";
      mainContentArea_filepanel.style.marginBottom = "";
      mainContentArea_filepanel.style.width = "";
      mainContentArea_filepanel.style.height = "";
      
      // Panel kenetlenmişse, içerik alanını ayarla
      if (currentDockSide === 'left') {
          mainContentArea_filepanel.style.marginLeft = panel.offsetWidth + "px";
      } else if (currentDockSide === 'right') {
          mainContentArea_filepanel.style.marginRight = panel.offsetWidth + "px";
      } else if (currentDockSide === 'top') {
          mainContentArea_filepanel.style.marginTop = panel.offsetHeight + "px";
      } else if (currentDockSide === 'bottom') {
          mainContentArea_filepanel.style.marginBottom = panel.offsetHeight + "px";
      } else if (currentDockSide === 'center') {
          // Merkezdeyse içerik alanı tamamen gizle
          mainContentArea_filepanel.style.display = "none";
      } else {
          // Kenetlenmemişse içerik alanını tekrar göster
          mainContentArea_filepanel.style.display = "";
      }
  }
  
  // Paneli kenetleme durumundan çıkar
  function undockPanel_filepanel(panel) {
      panel.classList.remove('docked-left', 'docked-right', 'docked-top', 'docked-bottom', 'docked-center');
      panel.classList.add('floating');
      currentDockSide = null;
      
      // Ana içerik alanını görünür yap
      if (mainContentArea_filepanel) {
          mainContentArea_filepanel.style.display = "";
      }

       // Ana içerik alanını ayarla
       adjustMainContentArea_filepanel(panel);
    }
  

  function checkDocking_filepanel(mouseX, mouseY) {
      let targetDockSide = null;
      // Performans için throttle yaparak her 50ms'de bir çalışsın
      if (window.lastDockCheck && Date.now() - window.lastDockCheck < 50) {
          return window.lastTargetSide || null;
      }
      
      window.lastDockCheck = Date.now();
      
      dockTargets_filepanel.forEach(target => {
          var rect = target.getBoundingClientRect();
          if (mouseX >= rect.left && mouseX <= rect.right && mouseY >= rect.top && mouseY <= rect.bottom) {
              // Üzerindeyken efekt - transform yerine doğrudan background değiştirme
              if (target.id === 'dock-target-center') {
                  target.style.backgroundColor = "rgba(255, 54, 201, 0.8)";
                  target.style.boxShadow = "0 0 15px rgba(255, 54, 201, 0.7), inset 0 0 10px rgba(255, 255, 255, 0.6)";
              } else {
                  target.style.backgroundColor = "rgba(255, 54, 201, 0.7)";
                  target.style.boxShadow = "0 0 12px rgba(255, 54, 201, 0.6), inset 0 0 10px rgba(255, 255, 255, 0.4)";
              }
              targetDockSide_filepanel = target.dataset.dockSide;
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
      
      window.lastTargetSide = targetDockSide_filepanel;
      return targetDockSide_filepanel;
  }
</script>

<script>
    // Panel ve gerekli elementleri seç
    var panel_folder = document.getElementById("fileExplorerPanel");
    var header_folder = document.getElementById("fileExplorerHeader");
  
    // Header'a tıklandığında sürüklemeyi başlat
    if (header_folder) {
        header_folder.onmousedown = dragMouseDown_filepanel;
    }

    function dragMouseDown_filepanel(e) {
        e = e || window.event;
        e.preventDefault();
        
        isDragging_filepanel = true;
        
        // Eğer panel kenetlenmişse ve sürüklemeye başlarsak, serbest bırak
        if (currentDockSide) {
            undockPanel_filepanel(panel_folder);
            
            // Merkezden çıkarken paneli makul bir boyuta dönüştür ve tam ortaya konumlandır
            if (currentDockSide_filepanel === 'center') {
                panel_folder.style.top = '50%';
                panel_folder.style.left = '50%';
                panel_folder.style.width = '200px';
                panel_folder.style.height = '300px';
                panel_folder.style.transform = 'translate(-50%, -50%)';
                
                // 150ms sonra transform'u kaldır ve normal pozisyonlama yap
                setTimeout(() => {
                    var rect = panel_folder.getBoundingClientRect();
                    panel_folder.style.transform = '';
                    panel_folder.style.top = rect.top + 'px';
                    panel_folder.style.left = rect.left + 'px';
                    
                    // Yeni ofsetleri hemen hesapla, çünkü panelin pozisyonu değişti
                    offsetX_filepanel = e.clientX - panel_folder.offsetLeft;
                    offsetY_filepanel = e.clientY - panel_folder.offsetTop;
                }, 10);
            } else {
                // Diğer kenarlardan çıkarken normal hesaplama yap
                offsetX_filepanel = e.clientX - panel_folder.offsetLeft;
                offsetY_filepanel = e.clientY - panel_folder.offsetTop;
            }
            
            currentDockSide_filepanel = null;
        } else {
            // Normal durum - kenetli değilse
            offsetX_filepanel = e.clientX - panel_folder.offsetLeft;
            offsetY_filepanel = e.clientY - panel_folder.offsetTop;
        }
        
        panel_folder.classList.add('floating'); // Sürüklerken her zaman floating olmalı
        panel_folder.style.zIndex = 1001; // Sürüklenen panel en üstte
        dockTargetsContainer.style.display = "block";

        document.onmouseup = closeDragElement_filepanel;
        document.onmousemove = elementDrag_filepanel;
    }

    function elementDrag_filepanel(e) {
        if (!isDragging_filepanel) return;
        e = e || window.event;
        e.preventDefault();

        let newX = e.clientX - offsetX_filepanel;
        let newY = e.clientY - offsetY_filepanel;
        
        // Panelin sınırlar içinde kalmasını sağla
        var layoutContainer = parent.document.getElementById('ideLayoutContainer');
        if (layoutContainer) {
            if (newX < 0) newX = 0;
            if (newY < 0) newY = 0;
            
            // Sağ ve alt sınırları kontrol et
            var maxX = layoutContainer.offsetWidth - panel_folder.offsetWidth;
            var maxY = layoutContainer.offsetHeight - panel_folder.offsetHeight;
            if (newX > maxX) newX = maxX;
            if (newY > maxY) newY = maxY;
        }

        // Daha pürüzsüz hareket için requestAnimationFrame kullan
        if (!window.dragAnimationFrame) {
            window.dragAnimationFrame = requestAnimationFrame(() => {
                panel_folder.style.left = newX + "px";
                panel_folder.style.top = newY + "px";
                window.dragAnimationFrame = null;
                
                // Kenetlenme hedefleriyle kesişimi kontrol et
                checkDocking_filepanel(e.clientX, e.clientY);
            });
        }
    }

    function closeDragElement_filepanel(e) {
        // Sürükleme işlemi bitti
        document.onmouseup = null;
        document.onmousemove = null;
        isDragging_filepanel = false;
        panel_folder.style.zIndex = 1000; // Normal z-index'e geri dön
        
        // Son fare konumunda kenetleme kontrolü yap
        if (e) {
            let targetSide = checkDocking_filepanel(e.clientX, e.clientY);
            if (targetSide) {
                dockPanel_filepanel(targetSide, panel_folder);
            }
        }
        
        dockTargetsContainer_filepanel.style.display = "none";
    }
</script>

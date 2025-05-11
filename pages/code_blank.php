<!-- Dosya Gezgini Paneli -->
<div id="codeBlankPage" class="draggable-panel floating">
    <div id="codeBlankPageHeader" class="panel-header">
        <span class="title-text">Boş Sayfa</span>
        <span class="close-btn" onclick="closePanel(this.parentElement.parentElement)">&times;</span>
    </div>
    <div id="codeBlankPageContent" class="panel-content">
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
  // Panel ve gerekli elementleri seç
  var dockTargetsContainer__code_blankpage = document.getElementById("dockTargetsContainer_code_blankpage");
  var dockTargets_code_blankpage = document.querySelectorAll(".dock-target_code_blankpage");
  var mainContentArea_code_blankpage = parent.document.getElementById("mainContentArea_code_blankpage"); // home.php'deki ana içerik alanı
  
  // Dock sistemi için değişkenler
  let isDragging_code_blankpage = false;
  let offsetX_code_blankpage, offsetY_code_blankpage;
  let currentDockSide_code_blankpage = null; // 'left', 'right', 'top', 'bottom', or null (floating)
  
  // Paneli belirli bir tarafa kenetle
  function dockPanel_code_blankpage(side, panel) {
      if (!side || side === currentDockSide) return;
      
      // Önce tüm dock sınıflarını kaldır
      panel.classList.remove('floating', 'docked-left', 'docked-right', 'docked-top', 'docked-bottom');
      
      // Yeni dock sınıfını ekle
      panel.classList.add('docked-' + side);
      currentDockSide = side;
      
      // Ana içerik alanını ayarla
      adjustMainContentArea_code_blankpage(panel);
  }

   // Ana içerik alanını panelin konumuna göre ayarla
   function adjustMainContentArea_code_blankpage(panel) {
      if (!mainContentArea_code_blankpage) return;
      
      // Tüm kenar boşluklarını sıfırla
      mainContentArea_code_blankpage.style.marginLeft = "";
      mainContentArea_code_blankpage.style.marginRight = "";
      mainContentArea_code_blankpage.style.marginTop = "";
      mainContentArea_code_blankpage.style.marginBottom = "";
      mainContentArea_code_blankpage.style.width = "";
      mainContentArea_code_blankpage.style.height = "";
      
      // Panel kenetlenmişse, içerik alanını ayarla
      if (currentDockSide === 'left') {
          mainContentArea_code_blankpage.style.marginLeft = panel.offsetWidth + "px";
      } else if (currentDockSide === 'right') {
          mainContentArea_code_blankpage.style.marginRight = panel.offsetWidth + "px";
      } else if (currentDockSide === 'top') {
          mainContentArea_code_blankpage.style.marginTop = panel.offsetHeight + "px";
      } else if (currentDockSide === 'bottom') {
          mainContentArea_code_blankpage.style.marginBottom = panel.offsetHeight + "px";
      } else if (currentDockSide === 'center') {
          // Merkezdeyse içerik alanı tamamen gizle
          mainContentArea_code_blankpage.style.display = "none";
      } else {
          // Kenetlenmemişse içerik alanını tekrar göster
          mainContentArea_code_blankpage.style.display = "";
      }
  }
  
  // Paneli kenetleme durumundan çıkar
  function undockPanel_code_blankpage(panel) {
      panel.classList.remove('docked-left', 'docked-right', 'docked-top', 'docked-bottom', 'docked-center');
      panel.classList.add('floating');
      currentDockSide = null;
      
      // Ana içerik alanını görünür yap
      if (mainContentArea_code_blankpage) {
          mainContentArea_code_blankpage.style.display = "";
      }

       // Ana içerik alanını ayarla
       adjustMainContentArea_code_blankpage(panel);
   }
 

  
    function checkDocking_code_blankpage(mouseX, mouseY) {
      let targetDockSide = null;
      // Performans için throttle yaparak her 50ms'de bir çalışsın
      if (window.lastDockCheck && Date.now() - window.lastDockCheck < 50) {
          return window.lastTargetSide || null;
      }
      
      window.lastDockCheck = Date.now();
      
      dockTargets_code_blankpage.forEach(target => {
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
              dockTargets_code_blankpage = target.dataset.dockSide;
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
      
      window.lastTargetSide = dockTargets_code_blankpage;
      return dockTargets_code_blankpage;
  }
</script>

<script>
    // Panel ve gerekli elementleri seç
    var code_codeBlankPage = document.getElementById("codeBlankPage");
    var header_codeBlankPage = document.getElementById("codeBlankPageHeader");
  
    // Header'a tıklandığında sürüklemeyi başlat
    if (header_codeBlankPage) {
        header_codeBlankPage.onmousedown = dragMouseDown_code_blankpage;
    }

    function dragMouseDown_code_blankpage(e) {
        e = e || window.event;
        e.preventDefault();
        
        isDragging_code_blankpage = true;
        
        // Eğer panel kenetlenmişse ve sürüklemeye başlarsak, serbest bırak
        if (currentDockSide_code_blankpage) {
            undockPanel_code_blankpage(code_codeBlankPage);
            
            // Merkezden çıkarken paneli makul bir boyuta dönüştür ve tam ortaya konumlandır
            if (currentDockSide_code_blankpage === 'center') {
                code_codeBlankPage.style.top = '50%';
                code_codeBlankPage.style.left = '50%';
                code_codeBlankPage.style.width = '200px';
                code_codeBlankPage.style.height = '300px';
                code_codeBlankPage.style.transform = 'translate(-50%, -50%)';
                
                // 150ms sonra transform'u kaldır ve normal pozisyonlama yap
                setTimeout(() => {
                    var rect = code_codeBlankPage.getBoundingClientRect();
                    code_codeBlankPage.style.transform = '';
                    code_codeBlankPage.style.top = rect.top + 'px';
                    code_codeBlankPage.style.left = rect.left + 'px';
                    
                    // Yeni ofsetleri hemen hesapla, çünkü panelin pozisyonu değişti
                    offsetX_code_blankpage = e.clientX - code_codeBlankPage.offsetLeft;
                    offsetY_code_blankpage = e.clientY - code_codeBlankPage.offsetTop;
                }, 10);
            } else {
                // Diğer kenarlardan çıkarken normal hesaplama yap
                offsetX_code_blankpage = e.clientX - code_codeBlankPage.offsetLeft;
                offsetY_code_blankpage = e.clientY - code_codeBlankPage.offsetTop;
            }
            
            currentDockSide = null;
        } else {
            // Normal durum - kenetli değilse
            offsetX_code_blankpage = e.clientX - code_codeBlankPage.offsetLeft;
            offsetY_code_blankpage = e.clientY - code_codeBlankPage.offsetTop;
        }
        
        code_codeBlankPage.classList.add('floating'); // Sürüklerken her zaman floating olmalı
        code_codeBlankPage.style.zIndex = 1001; // Sürüklenen panel en üstte
        dockTargetsContainer.style.display = "block";

        document.onmouseup = closeDragElement_code_blankpage;
        document.onmousemove = elementDrag_code_blankpage;
    }

    function elementDrag_code_blankpage(e) {
        if (!isDragging_code_blankpage) return;
        e = e || window.event;
        e.preventDefault();

        let newX = e.clientX - offsetX_code_blankpage;
        let newY = e.clientY - offsetY_code_blankpage;
        
        // Panelin sınırlar içinde kalmasını sağla
        var layoutContainer = parent.document.getElementById('ideLayoutContainer');
        if (layoutContainer) {
            if (newX < 0) newX = 0;
            if (newY < 0) newY = 0;
            
            // Sağ ve alt sınırları kontrol et
            var maxX = layoutContainer.offsetWidth - code_codeBlankPage.offsetWidth;
            var maxY = layoutContainer.offsetHeight - code_codeBlankPage.offsetHeight;
            if (newX > maxX) newX = maxX;
            if (newY > maxY) newY = maxY;
        }

        // Daha pürüzsüz hareket için requestAnimationFrame kullan
        if (!window.dragAnimationFrame) {
            window.dragAnimationFrame = requestAnimationFrame(() => {
                code_codeBlankPage.style.left = newX + "px";
                code_codeBlankPage.style.top = newY + "px";
                window.dragAnimationFrame = null;
                
                // Kenetlenme hedefleriyle kesişimi kontrol et
                checkDocking_code_blankpage(e.clientX, e.clientY);
            });
        }
    }

    function closeDragElement_code_blankpage(e) {
        // Sürükleme işlemi bitti
        document.onmouseup = null;
        document.onmousemove = null;
        isDragging_code_blankpage = false;
        code_codeBlankPage.style.zIndex = 1000; // Normal z-index'e geri dön
        
        // Son fare konumunda kenetleme kontrolü yap
        if (e) {
            let targetSide = checkDocking_code_blankpage(e.clientX, e.clientY);
            if (targetSide) {
                dockPanel_code_blankpage(targetSide, code_codeBlankPage);
            }
        }
        
        dockTargetsContainer__code_blankpage.style.display = "none";
    }
</script>

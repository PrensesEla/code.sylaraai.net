$(function(){

    $.dataHeaderAjaxLoad = function(href){
        // Müzik durumunu korumak için medya durumunu kaydedelim
        let audioState = null;
        if (window.saveAudioState) {
            audioState = window.saveAudioState();
        }
        
        // Geçiş animasyonu için mevcut içeriği yavaşça gizleyelim
        $('.containerdiv').fadeOut(200, function() {
            // İçerik gizlendikten sonra AJAX isteği yapalım
            $.ajax({
                type: "post",
                url: "/config/indexconf.php",
                data: {"href":href},
                dataType: "json",
                success: function(cevap){
                    // URL ve başlık güncellemesi
                    history.pushState("", "", "" + href);
                    $('title').text(cevap.title);
                    
                    // İçeriği görünmez şekilde ekleyelim
                    $('.containerdiv').css('opacity', '0').html(cevap.container);
                    
                    // İçerik yüklendikten sonra, sayfa başlatma fonksiyonunu çağır
                    if (typeof pageload === 'function') {
                        pageload();
                    }
                    
                    // Müzik durumunu geri yükle
                    if (window.restoreAudioState && audioState) {
                        setTimeout(function() {
                            window.restoreAudioState(audioState);
                        }, 300);
                    }
                    
                    // İçerik yavaşça görünmesini sağlayalım
                    $('.containerdiv').fadeIn(300).animate({opacity: 1}, 300);
                },
                error: function() {
                    // Hata durumunda içeriği tekrar gösterelim
                    $('.containerdiv').fadeIn(300);
                }
            });
        });
    }

    var path = location.pathname.replace('/','');
    //var path = location.pathname.replace('/','') + location.search; // Include search parameters

    if (!path) {
      path = 'home';
      $.dataHeaderAjaxLoad(path);
      return false;
  }

    if(path){
        $.dataHeaderAjaxLoad(path);
        return false;
    }
});

function pageload(){
  document.querySelectorAll('a[data-page]').forEach(function(element){
    element.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default action
      //var href= $(this).attr('href');
      $.dataHeaderAjaxLoad(element.getAttribute('data-page'));
      return false;
    });
  });
}

function navigateTo(path) {
  $.dataHeaderAjaxLoad(path);
  return false;
}



function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
function eraseCookie(name) {   
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

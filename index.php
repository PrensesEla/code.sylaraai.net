<?php 
// Oturum başlatıldıysa, önce oturumu geçici olarak kapatın
if (session_status() === PHP_SESSION_ACTIVE) {
    session_write_close(); // Oturumu geçici olarak kapat
}
ini_set("allow_url_fopen", 1);
$max_lifetime = 2147483647 - time(); // Geçerli zamana göre maksimum süreyi hesaplar
ini_set('session.gc_maxlifetime', $max_lifetime);
setcookie(session_name(), session_id(), 2147483647);
ini_set('session.gc_probability', 0);
error_reporting(E_ERROR);
include("config/EllieMusic.php");
include("config/ipinicheck.php");
header("Access-Control-Allow-Origin: *");  // Tüm kökenlere izin
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // İzin verilen yöntemler
header("Access-Control-Allow-Headers: Content-Type, Authorization");  // İzin verilen başlıklar
header("Access-Control-Allow-Credentials: true");  // Kimlik doğrulama bilgileri için
header("Access-Control-Max-Age: 3600");  // Önceki başlıkların önbellek süresi (1 saat)
?>
<?php
// include("config/settings/deviceconfig.php"); include("config/inicheck.php"); 
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet")); 
$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
$isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
$isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
$isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
$isIOS = $isIPhone || $isIPad; 

if($isMob){
  echo "
<script>
  function updateDimensions() {
    var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;

    // HTML elementini bul ve boyutlarını ayarla
    var mobilediv = document.getElementById('mobile');
    var bodyElement = document.body;

    mobilediv.style.height = screenHeight + 'px';
    bodyElement.style.height = screenHeight + 'px';
    bodyElement.style.width = '100vw';
  }
</script>";
}else{
  echo "
<script>
  function updateDimensions() {
    var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;

    // HTML elementini bul ve boyutlarını ayarla
    var desktopdiv = document.getElementById('desktop');
    var bodyElement = document.body;

    // Ayarlanan boyutları uygula
    desktopdiv.style.height = screenHeight + 'px';
    bodyElement.style.height = screenHeight + 'px';
    bodyElement.style.width = '100vw';
    desktopdiv.style.backgroundSize = screenWidth + 'px ' + screenHeight + 'px';
    bodyElement.style.backgroundSize = screenWidth + 'px ' + screenHeight + 'px';
  }
</script>";
}
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>SylaraAI - Web Code Interface</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="/assets/css/index.css">

  <link rel="stylesheet" href="/assets/css/home.css">

  <link rel="stylesheet" href="/assets/css/components/footer.css">
  <link rel="stylesheet" href="/assets/css/components/header.css">
  <link rel="stylesheet" href="/assets/css/components/dock.css">

  <link rel="stylesheet" href="/assets/css/panelcontainer/file.panel.css">


  <!-- <link rel="stylesheet" href="http://assets.elliemusic.net/Css/admin/login.css">

  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.core.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.theme.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.audio.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.video.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.system.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.account.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/settings/settings.equalizer.css">


  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/modules/filemanager.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/modules/youtubepages.css">

  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/mediaplayer/nowplaying.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/mediaplayer/videohtml5.css">
  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/mediaplayer/nowplayingvid.css">

  <link rel="stylesheet" href="http://assets.elliemusic.net/Css/bootstrap/bootstrap.css"> -->

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>  
</head>
<style>
  @font-face {
      font-family: 'Ellie-Avalon';
      src: url('fonts/AvalonMedium.ttf') format('truetype');
  }@font-face {
      font-family: 'Ellie-Bickham-two';
      src: url('fonts/Bickham Script Two.ttf') format('truetype');
  }@font-face {
      font-family: 'Ellie-Resptive';
      src: url('fonts/Respective.ttf') format('truetype');
  }

  .vdisplay{
      display: none;
  }
</style>
<body data-bs-theme="" style="background-image: url('http://assets.elliemusic.net/Image/background/bkimage1.png');">
    <?php if($isMob){?>
      <div class="containerdiv" id="mobile">
            <?php include("config/indexconf1.php"); ?>
      </div>
    <?php }else {?>
        <div class="containerdiv" id="desktop">
            <?php include("config/indexconf1.php"); ?>
        </div>
    <?php } ?>
    <?php include("modules/dock_system.php"); ?>
    <?php include("modules/drag_system.php"); ?>
    <!-- <?php include("pages/about.php"); ?>
    <?php include("pages/settings/settings.php"); ?>
    <?php include("pages/quick-menu/quick-equzlier.php"); ?>
    <?php include("pages/quick-menu/quick-settings.php"); ?>
    <?php include("include/session/localstroange.save.time.php"); ?> -->
</body>
<script>
// Function to update dimensions
// İlk olarak sayfa yüklendiğinde boyutları ayarla
updateDimensions();

// Pencere boyutu değiştikçe boyutları güncelle
window.addEventListener('resize', updateDimensions);
</script>
<script src="config/elliepages.js"></script>
<script src="assets/js/menu.js"></script>

<!-- <script src="http://assets.elliemusic.net/js/settings.js"></script>
<script src="http://assets.elliemusic.net/Js/ellieplaylist.js"></script>
<script src="http://music.elliemusic.net:81/config/elliepages.js"></script>

<script src="http://assets.elliemusic.net/Js/ellieplayer.chrome.js"></script>
<script src='http://assets.elliemusic.net/Js/ellieplayer.seekbar.js'></script>
<script src="http://assets.elliemusic.net/Js/ellieplayer.controls.js"></script>
<script src="http://assets.elliemusic.net/Js/ellieplayer.setvolume.js"></script>
<script src="http://assets.elliemusic.net/Js/ellieplayer.progressbar.js"></script> -->


<script src="/assets/js/bootstrap/bootstrap.js"></script>
<script src="/assets/js/bootstrap/bootstrap.bundle.js"></script>
</html>
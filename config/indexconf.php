<?php
/**
 * SPA Router Configuration for Ellie Music
 * Handles server-side content loading for SPA architecture
 * Routes are processed without page reloads to maintain audio playback
 */

// Get the requested route
if(isset($_POST['href'])) {
    $href = $_POST['href'];
    // Split into path segments for multi-level routing
    $segments = explode('/', rtrim($href, '/'));
} else {
    // Default route
    $href = 'home';
    $segments = ['home'];
}

// Initialize response object
$json = [
    'title' => 'Ellie Music',
    'container' => '',
    'success' => true
];

// Process routes based on path segments
switch ($segments[0]) {
    case 'home':
        $json['title'] = 'SylaraAI - Web Code Home';
        ob_start();
        include("../home.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'nowplaying':
        $json['title'] = 'Ellie Music - Now Playing';
        ob_start();
        include("../nowplayingg.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'nowplayingvideo':
        $json['title'] = 'Ellie Music - Video Player';
        ob_start();
        include("../nowplayinggvid.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'filemanager':
        $json['title'] = 'Ellie Music - File Manager';
        ob_start();
        include("../pages/file_manager/index.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'history':
        $json['title'] = 'Ellie Music - History';
        ob_start();
        include("../pages/history.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'albums':
        // Handle album routes with subpaths
        if (count($segments) > 1 && $segments[1] == 'albuminfolist') {
            $json['title'] = 'Ellie Music - Album Detayı';
            ob_start();
            include("../pages/albums/album_index.php");
            $json['container'] = ob_get_clean();
        } else {
            $json['title'] = 'Ellie Music - Albumler';
            ob_start();
            include("../pages/albums/albums_all_list.php");
            $json['container'] = ob_get_clean();
        }
        break;
        
    case 'diskplayer':
        $json['title'] = 'Ellie Music - Disk Player';
        ob_start();
        include("../pages/diskplayer.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'logtest':
        $json['title'] = 'Ellie Music - Log Test';
        ob_start();
        include("../logtest.php");
        $json['container'] = ob_get_clean();
        break;
        
    case 'session':
        // Handle session routes
        if (count($segments) > 1 && $segments[1] == 'logout') {
            $json['title'] = 'Ellie Music - Çıkış Yapılıyor';
            ob_start();
            include("../pages/logout.php");
            $json['container'] = ob_get_clean();
        }
        break;
        
    default:
        // 404 - Page not found
        $json['title'] = 'SylaraAI - Sayfa Bulunamadı';
        $json['container'] = '<div class="error-container"><h2>404 - Sayfa Bulunamadı</h2><p>İstediğiniz sayfa mevcut değil.</p></div>';
        $json['success'] = false;
        break;
}

// Add timestamp for cache busting
$json['timestamp'] = time();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($json);
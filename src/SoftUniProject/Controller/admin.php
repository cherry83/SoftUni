<?

if (isset($url[2]) && strlen($url[2]) > 0)
    $page = CONTROLER_PATH . (file_exists(ADMIN_CONTROLER_PATH . $url[2] . '.php') ? 'Admin/' . $url[2] : '404') . '.php';
else
    $page = CONTROLER_PATH . 'homepage.php';

if ($page != CONTROLER_PATH . 'homepage.php') include($page);

?>
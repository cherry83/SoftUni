<?
  session_start();
  
  ob_start(); 
  
  error_reporting(E_ERROR);
  
  define ("VIEW_PATH" , "../app/Resources/views/");
  define ("CONTROLER_PATH" , "../src/SoftUniProject/Controller/");
  define ("ADMIN_CONTROLER_PATH" , "../src/SoftUniProject/Controller/Admin/");

  include CONTROLER_PATH.'mysqli.php';

  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
  }

  $url = explode ('/',$_SERVER['REDIRECT_URL']);

  if (isset($url[1]) && strlen($url[1])>0)
    $page = CONTROLER_PATH.(file_exists(CONTROLER_PATH.$url[1].'.php')? $url[1] : '404').'.php';
  else 
    $page = CONTROLER_PATH.'homepage.php';

  include CONTROLER_PATH.'homepage.php';
  
  ob_end_flush();
?>
<?
  define ("VIEW_PATH" , "../app/Resources/views/");
  define ("CONTROLER_PATH" , "../src/SoftUniProject/Controller/");

  include CONTROLER_PATH.'mysqli.php';

  $url = explode ('/',$_SERVER['REDIRECT_URL']);

  if (isset($url[1]))
    $page = CONTROLER_PATH.(file_exists(CONTROLER_PATH.$url[1].'.php')? $url[1] : '404').'.php';
  else 
    $page = CONTROLER_PATH.'homepage.php';

  include CONTROLER_PATH.'homepage.php';
  
?>
<?
  if (isset($url[2]))
    $id = intval($url[2]); 
  else
    $id = -1;
  if ($id>0){
	  $res = $mysqli->query("UPDATE pictures SET views=views+1 WHERE id = $id");
	  $res = $mysqli->query("SELECT file FROM pictures WHERE id = $id");
	  if ($res->num_rows>0) { 
	  	$res = $res->fetch_assoc();
	  	$outline = $res['file'];
	  } else {
	  	$outline = 'colours_053-by_endi.png';
	  }
  	include( VIEW_PATH.'coloring.html.php');
  } else {
      $res = $mysqli->query("SELECT * FROM pictures ORDER BY rand()");
    while($picture = $res->fetch_assoc()){
    	$pictures[] = $picture;
    }
    
  	include( VIEW_PATH.'list.html.php');
  }
  
?>
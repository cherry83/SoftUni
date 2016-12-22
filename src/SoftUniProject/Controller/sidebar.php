<?

  $res = $mysqli->query("SELECT * FROM categories ORDER BY name");

  if ($res->num_rows>0) { 
  	while($category = $res->fetch_assoc()){
  		echo "<li><a href='/category/{$category['id']}'>{$category['name']}</a></li>";
  	}
  }
?>
<?    
	$servername = "localhost";
	$username = "root";
	$password = '';
	$dbname = "project";
	
	
	$mysqli= new mysqli($servername, $username, $password, $dbname);

	$mysqli->query("SET character_set_results=utf8");
	mb_internal_encoding('UTF-8');
	$mysqli->query("set names 'utf8'");
		
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>
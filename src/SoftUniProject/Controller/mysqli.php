<?    
	$servername = "localhost";
	$username = "cherryt_prj";
	$password = '.i!lc}XMWvS#';
	$dbname = "cherryt_project";
	
	
	$mysqli= new mysqli($servername, $username, $password, $dbname);

	$mysqli->query($mysqli, "SET character_set_results=utf8");
	mb_internal_encoding('UTF-8');
	$mysqli->query($mysqli, "set names 'utf8'");
		
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>
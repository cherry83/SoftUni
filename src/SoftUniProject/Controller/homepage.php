<?
$res = $mysqli->query("SELECT * FROM pictures ORDER BY date DESC LIMIT 0 , 3");
while ($picture = $res->fetch_assoc()) {
    $last_pictures[] = $picture;
}

$res = $mysqli->query("SELECT * FROM pictures ORDER BY views DESC LIMIT 0 , 3");
while ($picture = $res->fetch_assoc()) {
    $top_pictures[] = $picture;
}

require(VIEW_PATH . 'base.html.php');

?>
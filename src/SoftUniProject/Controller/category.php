<?
if (isset($url[2]))
    $id = intval($url[2]);
else
    $id = -1;

$res = $mysqli->query("SELECT * FROM pictures WHERE category_id= $id");

if ($res->num_rows > 0) {
    while ($picture = $res->fetch_assoc()) {
        $pictures[] = $picture;
    }
}
include(VIEW_PATH . 'category.html.php');
?>
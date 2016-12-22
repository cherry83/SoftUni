<?
if (!isset($user) || $user['role'] == 'ROLE_USER') {
    unset($user);
    unset($_SESSION['user']);
    header('location: /login');
    exit();
}

if ($url[3] == 'edit') {

    $id = intval($url[4]);
    if (isset($_POST['picture'])) {

        $title = $mysqli->real_escape_string($_POST['picture']['name']);
        $category_id = intval($_POST['picture']['category']);
        $res = $mysqli->query("UPDATE `pictures` SET title='$title', category_id='$category_id' WHERE id={$id}");
        header('location: /admin/pictures');
        exit();
    }

    $res = $mysqli->query("SELECT * FROM `pictures` WHERE id=$id");
    $picture = $res->fetch_assoc();

    $res = $mysqli->query("SELECT * FROM `categories` ORDER BY name");
    while ($category = $res->fetch_assoc()) {
        $categories .= "<option value='{$category['id']}' " . ($picture['category_id'] == $category['id'] ? "selected" : "") . ">{$category['name']}</option>";
    }

    include(VIEW_PATH . '/admin/pictures/edit.html.php');

} elseif ($url[3] == 'delete') {

    $id = intval($url[4]);

    if (isset($_POST['picture'])) {
        $res = $mysqli->query("SELECT file FROM `pictures` WHERE id=$id");
        $res = $res->fetch_assoc();
        $file = $res['file'];
        unlink("outlines/$file");
        $mysqli->query("DELETE FROM `pictures` WHERE id=$id");
        header('location: /admin/pictures');
        exit();
    }

    $res = $mysqli->query("SELECT * FROM `pictures` WHERE id=$id");
    $picture = $res->fetch_assoc();

    include(VIEW_PATH . '/admin/pictures/delete.html.php');

} elseif ($url[3] == 'upload') {

    if (isset($_POST['picture'])) {

        $check = getimagesize($_FILES["file_name"]["tmp_name"]);
        if ($check == false) {
            $file_error = "<span class='error text-danger'>Файлът не съдържа изображение</span>";
        } else {

            $target_dir = "outlines/";
            $imageFileType = pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION);
            $target_file = md5(time()) . '.' . $imageFileType;

            move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_dir . $target_file);

            $category = intval($_POST['category']);
            $title = $mysqli->real_escape_string($_POST['picture']['name']);
            $date = time();
            $res = $mysqli->query("INSERT INTO `pictures` (category_id, title, file, date, views, uploaderid) VALUES ('$category', '$title', '$target_file', '$date', 0, {$user['id']})");
            header('location: /admin/pictures');
            exit();

        }
    }
    $res = $mysqli->query("SELECT * FROM `categories` ORDER BY name");
    while ($category = $res->fetch_assoc()) {
        $categories .= "<option value='{$category['id']}'>{$category['name']}</option>";
    }
    include(VIEW_PATH . '/admin/pictures/create.html.php');

} else {


    $res = $mysqli->query("SELECT categories.name AS category, pictures.* FROM pictures LEFT JOIN categories on categories.id=category_id");
    while ($picture = $res->fetch_assoc()) {
        $pictures[] = $picture;
    }
    include(VIEW_PATH . '/admin/pictures/list.html.php');
}


?>
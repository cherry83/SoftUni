<?
if (!isset($user) || $user['role'] == 'ROLE_USER') {
    unset($user);
    unset($_SESSION['user']);
    header('location: /login');
    exit();
}

if ($url[3] == 'edit') {
    $id = intval($url[4]);
    if (isset($_POST['category'])) {
        $res = $mysqli->query("SELECT name FROM `categories` WHERE id=$id");
        $res = $res->fetch_assoc();
        $category_edit = $res['name'];

        $category_name = $mysqli->real_escape_string($_POST['category']['name']);

        $res = $mysqli->query("SELECT * FROM `categories` WHERE name = '$category_name' ");
        if ($res->num_rows > 0 && $category_edit != $category_name) {
            $category_error = "<span>Има друга категория със същото име!</span>";
        } else {
            $res = $mysqli->query("UPDATE `categories` SET name='$category_name' WHERE id={$id}");
            header('location: /admin/categories');
            exit();
        }
    }

    $res = $mysqli->query("SELECT * FROM `categories` WHERE id=$id");
    $category = $res->fetch_assoc();

    include(VIEW_PATH . '/admin/categories/edit.html.php');

} elseif ($url[3] == 'delete') {
    $id = intval($url[4]);

    if (isset($_POST['category'])) {
        $res = $mysqli->query("SELECT id FROM `pictures` WHERE category_id=$id");
        if ($res->num_rows > 0) {
            $delete_error = "<span>Категорията не може да бъде изтрита, защото в нея има картинки!</span>";
        } else {
            $mysqli->query("DELETE FROM `categories` WHERE id={$id}");
            header('location: /admin/categories');
            exit();
        }
    }

    $res = $mysqli->query("SELECT * FROM `categories` WHERE id=$id");
    $category = $res->fetch_assoc();

    include(VIEW_PATH . '/admin/categories/delete.html.php');
} elseif ($url[3] == 'create') {
    if (isset($_POST['category'])) {
        $category_name = $mysqli->real_escape_string($_POST['category']['name']);

        $res = $mysqli->query("SELECT * FROM `categories` WHERE name = '$category_name' ");
        if ($res->num_rows > 0) {
            $create_error = "<span>Има друга категория със същото име!</span>";
        } else {
            $res = $mysqli->query("INSERT INTO `categories` (name) VALUES ('$category_name')");
            header('location: /admin/categories');
            exit();
        }
    }
    include(VIEW_PATH . '/admin/categories/create.html.php');
} else {

    $res = $mysqli->query("SELECT * FROM `categories`");
    while ($category = $res->fetch_assoc()) {
        $categories[] = $category;
    }
    include(VIEW_PATH . '/admin/categories/list.html.php');
}


?>
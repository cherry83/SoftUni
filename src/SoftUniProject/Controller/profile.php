<?
if (!isset($user)) {
    header('location: /login');
    exit();
}

if (isset($_POST['user'])) {

    $user_login = $mysqli->real_escape_string($_POST['user']['email']);
    $user_fullname = $mysqli->real_escape_string($_POST['user']['fullName']);
    $user_password_md5 = md5($_POST['user']['password']['old']);

    if ($user_password_md5 != $user['password']) {
        $old_password_error = "<span>Грешна парола!</span>";
    } else {
        if (strlen($_POST['user']['password']['first'] > 0)) {
            if ($_POST['user']['password']['first'] != $_POST['user']['password']['second']) {
                $password_error = "<span>Въведените пароли не съвпадат!</span>";
            } else {
                $user_password_md5 = md5($_POST['user']['password']['first']);
                $res = $mysqli->query("UPDATE `users` SET password='$user_password_md5', fullname = '$user_fullname' WHERE id={$user['id']}");
                unset($user);
                unset($_SESSION['user']);
                header('location: /login');
                exit();
            }
        } else {
            $res = $mysqli->query("UPDATE `users` SET fullname = '$user_fullname' WHERE id={$user['id']}");
            $user['fullname'] = $user_fullname;
            $_SESSION['user']['fullname'] = $user_fullname;
        }
    }

}

include(VIEW_PATH . '/user/profile.html.php');

?>
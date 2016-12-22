<?
if (isset($user)) {
    header('location: /homepage');
    exit();
}

if (isset($_POST['_username'])) {

    $user_login = $_POST['_username'];
    $user_password = $_POST['_password'];
    $user_login_md5 = md5($user_login);

    $login_error = false;
    $res = $mysqli->query("SELECT users.*, `roles`.name AS role FROM `users` LEFT JOIN users_roles on id=user_id LEFT JOIN roles on role_id=roles.id WHERE md5(`email`) = '$user_login_md5' ");
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if ($user['password'] == md5($user_password)) {
            $_SESSION['user'] = $user;
            header('location: /homepage');
            exit();
        } else {
            $login_error = true;
        }
    } else {
        $login_error = true;
    }
    $login_error = $login_error ? '<span>Непознато потребителско име или грешна парола!</span><br><br>' : '';
}

include(VIEW_PATH . '/security/login.html.php');

?>
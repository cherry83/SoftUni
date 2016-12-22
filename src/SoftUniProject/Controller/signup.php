<?
if (isset($user)) {
  header ('location: /homepage');
  exit(); 
}

if(isset($_POST['user'])) {

	$user_login = $mysqli->real_escape_string($_POST['user']['email']);
	$user_fullname = $mysqli->real_escape_string($_POST['user']['fullName']);
	$user_password = $_POST['user']['password']['first'];
	
	$user_login_md5 = md5($user_login);
	$user_password_md5 = md5($user_password);
	
	$res = $mysqli->query("SELECT * FROM `users` WHERE md5(`email`) = '$user_login_md5' ");
	if ($res->num_rows>0) {
		$email_error = "<span>Вече има регистрация с този email!</span>";
	} else {
		if($_POST['user']['password']['first']!=$_POST['user']['password']['second']) {
			$password_error = "<span>Въведените пароли не съвпадат!</span>";
		} else {
			$res = $mysqli->query("SELECT id FROM `users`");
			$role= $res->num_rows>0?'ROLE_USER':'ROLE_ADMIN';
			$res = $mysqli->query("SELECT id FROM `roles` WHERE name='$role'");
			$role = $res->fetch_assoc();
			$role_id = $role['id'];
			
			$res = $mysqli->query("INSERT INTO `users` (email, password, fullname) VALUES ('$user_login','$user_password_md5','$user_fullname')");
			$user_id = $mysqli->insert_id;
			$res = $mysqli->query("INSERT INTO `users_roles` VALUES($user_id, $role_id)");
			
	  		header ('location: /login');
			exit();
		}
	}
}

  include( VIEW_PATH.'/user/signup.html.php');
  
?>
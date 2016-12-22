<?
if (!isset($user) || $user['role']=='ROLE_USER') {
  unset($user);
  unset($_SESSION['user']);
  header ('location: /login');
  exit(); 
}
	  
  if ($url[3]=='edit') {
  	  $id = intval($url[4]);
  	  if(isset($_POST['user'])){

		$res = $mysqli->query("SELECT email FROM `users` WHERE users.id=$id");  
		$user_edit = $res->fetch_assoc();
		$user_edit = $user_edit['email'];

		$user_email = $mysqli->real_escape_string($_POST['user']['email']);
		$user_fullname = $mysqli->real_escape_string($_POST['user']['fullName']);
		$user_password_md5 = md5($_POST['user']['password']['first']);
		$user_role = $mysqli->real_escape_string($_POST['user']['role']);
		
		$user_login_md5 = md5($user_email);

		$res = $mysqli->query("SELECT * FROM `users` WHERE md5(`email`) = '$user_login_md5' ");
		if ($res->num_rows>0 && $user_edit!=$user_email) {
			$email_error = "<span>Има друга регистрация с този email!</span>";
		} else {
			$res = $mysqli->query("SELECT id FROM roles WHERE name='$user_role'");
			$user_role = $res->fetch_assoc();
			$user_role = $user_role['id'];
			if(strlen($_POST['user']['password']['first']>0)){
				if($_POST['user']['password']['first']!=$_POST['user']['password']['second']) {
					$password_error = "<span>Въведените пароли не съвпадат!</span>";
				} else {
					
					$res = $mysqli->query("UPDATE `users` SET email='$user_email', password='$user_password_md5', fullname = '$user_fullname' WHERE id={$id}");
					$res = $mysqli->query("UPDATE `users_roles` SET role_id = '$user_role' WHERE user_id={$id}");
					
					if ($user['email']==$user_email) {
					  unset($user);
					  unset($_SESSION['user']);
					  header ('location: /homepage');
					} else {
						header ('location: /admin/users');
					}
					exit(); 
				}
			} else {
				$res = $mysqli->query("UPDATE `users` SET email='$user_email', fullname = '$user_fullname' WHERE id={$id}");
				$res = $mysqli->query("UPDATE `users_roles` SET role_id = '$user_role' WHERE user_id={$id}");
				header ('location: /admin/users');
				exit(); 
			}
		}  	  
  	  } 
  	  
	  $res = $mysqli->query("SELECT users.*, `roles`.name AS role, `roles`.id AS role_id FROM `users` LEFT JOIN users_roles on id=user_id LEFT JOIN roles on role_id=roles.id WHERE users.id=$id");  
	  $user_edit = $res->fetch_assoc();
     	  include( VIEW_PATH.'/admin/user/edit.html.php'); 
      	  
  } elseif ($url[3]=='delete') {
  	$id = intval($url[4]);
	  if(isset($_POST['user'])){
		$user_email = $mysqli->real_escape_string($_POST['user']['email']);
		$res = $mysqli->query("SELECT id FROM `pictures` WHERE uploaderid=$id");  
		if ($res->num_rows>0){
			$delete_error = "<span>Потребителян не може да бъде изтрит, защото има публикации!</span>";
		} else {
			$mysqli->query("DELETE FROM `users_roles` WHERE user_id={$id}");
			$mysqli->query("DELETE FROM `users` WHERE id={$id}");
			if ($user['email']==$user_email) {
				  unset($user);
				  unset($_SESSION['user']);
				  header ('location: /homepage');
			} else {
				header ('location: /admin/users');
			}
			exit(); 
		}	  
	  }
	  $res = $mysqli->query("SELECT users.*, `roles`.name AS role, `roles`.id AS role_id FROM `users` LEFT JOIN users_roles on id=user_id LEFT JOIN roles on role_id=roles.id WHERE users.id=$id");  
	  $user_edit = $res->fetch_assoc();  
    	  include( VIEW_PATH.'/admin/user/delete.html.php');  
  } else {

	  $res = $mysqli->query("SELECT users.*, `roles`.name AS role FROM `users` LEFT JOIN users_roles on id=user_id LEFT JOIN roles on role_id=roles.id");
	  while ($user = $res->fetch_assoc()){
	  	$users[] = $user;
	  }
    	  include( VIEW_PATH.'/admin/user/list.html.php');
  }

  
?>
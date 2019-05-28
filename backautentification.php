<?php


session_start();


$mysqli = new mysqli('localhost', 'root','','crud')or die(msqli_error($mysqli));

/* AUTENTIFICATION FORM */
if(isset($_POST['register'])){
	$username = $_POST['username'];
	$email = $_POST['email'];

	$password = $_POST['password'];
	$passhash = md5($password);//password_hash("$password", PASSWORD_DEFAULT);

	if($username != '' && $email != '' && $password != ''){

		/* CHECK IF THE EMAIL IS ALREADY REGISTERED */
		$emailsearch = 1;
		$emailcheck = $mysqli->query("SELECT * FROM users WHERE email=$email") or null;
		if ($emailcheck != null){
			$emailsearch = 0;
		}

		/* REGISTRATION */
		if ($emailsearch == 1){

				/*VALIDATION EMAIL*/
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['message'] = "Invalid email Format";
				$_SESSION['msg_type'] = "danger";
				header("location: autentification.php"); 
			} else{
				$mysqli->query("INSERT INTO users (username, email, password) VALUES('$username', '$email','$passhash')") or die($mysqli->error);
				header("location: login.php");
			}

		} else{
			$_SESSION['message'] = "This email is already registered";
			$_SESSION['msg_type'] = "danger";
			header("location: autentification.php");
		}

	} else{
		$_SESSION['message'] = "Please Fill ALL The Fields";
		$_SESSION['msg_type'] = "danger";
		header("location: autentification.php");
	}
}

/* LOGIN FORM */
if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passhashh = md5($password); //password_hash("$password", PASSWORD_DEFAULT);

	$result = $mysqli->query("SELECT * FROM users WHERE email = '$email'") or die($mysqli->error);
	if($email != '' && $password != ''){
		if(count($result) == 1){
			$row = $result->fetch_array();
			if($row['password'] == $passhashh){
				setcookie("autentification",$email.rand (0,1000), time() + (86400 * 30), "/");
				header("location: index.php");
			} else{
				$_SESSION['message'] = "INCORECT Email OR Password";
				$_SESSION['msg_type'] = "danger";
				header("location: login.php");
			}
		} else{
				$_SESSION['message'] = "This Email Dosn't Exist";
				$_SESSION['msg_type'] = "danger";
				header("location: login.php");
			}
	} else{
		$_SESSION['message'] = "Complete ALL the Fields";
				$_SESSION['msg_type'] = "danger";
				header("location: login.php");
	}

}

if(isset($_GET['logout'])){
	setcookie("autentification", "", time(),"/");
	header("location: index.php");
}

//$2y$10$BCzGzNBRhunHI3cv5o2mReOjO2dgm/uJdLJKxtKNSXwnEl2iEPoPe
//$2y$10$BCzGzNBRhunHI3cv5o2mReOjO2dgm/uJdLJKxtKNSXwnEl2iEPoPe
?>


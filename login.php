<!DOCTYPE html>
<html>
<head>
	<title>LogIN</title>

	<!-- Fonts -->	
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<!-- CSS CONNECT -->
	<link rel="stylesheet" type="text/css" href="css/formstyle.css">

	<!-- bootstrap -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<?php require_once 'backautentification.php'?>
	<?php

		if (isset($_SESSION['message'])): ?>

		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

	<div class="container" >
		<h2 class="h2form">Inser your email and password</h2>
		<form action="backautentification.php" method="POST">
			<div class="form-group">

				<input type="text" name="email" class="form-control" placeholder="Insert your email">

				<input type="password" name="password" class="form-control" placeholder="Insert your pass">
				
				<button type="submit" id="formbutton"  class="btn btn-primary" name="login" >Log In</button>
			</div>
		</form>
	</div>

</body>
</html>
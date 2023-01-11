<?php
$db = mysqli_connect('localhost', 'root', '', 'shop');
if (!$db) {
	echo "database  not connect";
}

?>
<?php


session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM `login` WHERE email='$email' AND password='$password'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) == 1) {


		header("location:update.php");
	} else {
		echo '<script> alert("username or password incorrect")</script>';
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">

	<title>Login Form</title>
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="../photo/fiGBGzXw.png" alt="logo" style="width:20% " class="container">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form action="" method="POST" class="login-email">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
									</label>
									<input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>



								<div class="form-group m-0">
									<button type="submit" name="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>













	<!-- <p class="">Login</p>
	<div class=" col-md-4">
		<label for="exampleInputEmail1" class="form-label">Email </label>
		<input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
	</div>
	<div class=" col-md-4">
		<label for="exampleInputPassword1" class="form-label">Password</label>
		<input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
	</div>
	<div class="input-group">
		<button name="submit" class="btn">Login</button>
	</div>
	</form> -->
</body>

</html>
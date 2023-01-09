<?php
$db =mysqli_connect('localhost','root','','shop');
if(!$db){
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
	if(mysqli_num_rows($result)== 1 )
	{	


		header("location:update.php");
	}


	else
	{
		echo '<script> alert("username or password incorrect")</script>';
	}

}




?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="login.css">

	<title>Login Form</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="fs-1" >Login</p>
			<!-- <div class="input-group">
				<input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div> -->
			
			<div class="mb-3 col-md-4">
        <label for="exampleInputEmail1" class="form-label">Email </label>
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
      </div>
			<div class="mb-3 col-md-4" >
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
      </div>
	  <div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
		</form>
		
	</div>
</body>
</html>
<?php
$db =mysqli_connect('localhost','root','','shop');
if(!$db){
    echo "database  not connect";

}

?>
<?php 
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	

	if ($password == $cpassword) {
		$sql = "SELECT * FROM `login` WHERE email='$email' ";
		$result = mysqli_query($db, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO `login` (username, email, password)
					VALUES ('$username', '$email', '$password')";
			
			$result = mysqli_query($db, $sql);
			if ($result) {
				echo "<script>alert('Your registeration has been complete')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				
			} else {
				echo "<script>alert(' Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert(' Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Passwords does Not Match.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

	<title>Register Form</title>
</head>
<body>
	<div >

<form class=" Container m-2 p-2 " action="" method="POST"  >
      <div class="mb-3 col-md-4">
        <label for="exampleInputEmail1" class="form-label">Email </label>
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
      </div>
	  <div class="mb-3 col-md-4">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text"  class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
        
      </div>
	  <div class="mb-3 col-md-4" >
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
      </div>
      <div class="mb-3 col-md-4" >
        <label for="exampleInputPassword1" class="form-label"> Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
      </div>
	  <div class="input-group">
				<button name="submit" class="btn btn-primary">Register</button>
			</div>
			<p class="login-register-text">go to hoem page ? <a href="home.php">home page</a>.</p>
    </form>
</div>
	<!-- <div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			
			<button type="submit" class="btn btn-primary">order</button>
			
		</form>
	</div> -->
	<!-- <div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Already Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div> -->
</body>
</html>
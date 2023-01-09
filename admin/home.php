<?php
$db =mysqli_connect('localhost','root','','shop');
if(!$db){
    echo "database  not connect";

}


?>

<?php
if(isset($_GET['delete'])){
  $id=htmlspecialchars($_GET['delete']);
  $query = mysqli_query($db,"DELETE FROM `login` WHere `id`='$id'");
  if($query){
    header("location:home.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">My geneey</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="update.php">Update</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="info.php">Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="show-item.php">Show Item</a>
          </li>
          
          <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="kids.php">kids</a></li>
            <li><a class="dropdown-item" href="home.php">home</a></li>
            <li><a class="dropdown-item" href="show-item.php">anthor one</a></li>
          </ul>
        </li> -->
        </ul>
      </div>
    </div>
  </nav>
  <table class="table table-striped">
  <tr>
    <th>ID</th>
    <th>UserName</th>
    <th>Email</th>
  </tr>
  <?php

$conn=mysqli_connect('localhost','root','','shop');
if($conn->connect_error){
  die("Connection faild:".$conn->connect_error);
}

$sql= "SELECT * FROM `login`";
$result =$conn->query($sql);
if($result->num_rows>0)
{
  while($row=$result->fetch_assoc())
  {
    echo "<tr><td>".$row["id"].
    "</td><td>".$row["username"].
    "</td><td>".$row["email"].
    "</td><td><a href='home.php?delete=".$row['id']."' class='btn btn-danger'>delete</a></td></tr>";
  }
  echo "</table>";
}else{
  echo"0 result";
}
$conn->close();
?>
</table>
  <p class="login-register-text"> register anthoer admin <a href="register.php">Register Here</a>.</p>
</body>
</html>


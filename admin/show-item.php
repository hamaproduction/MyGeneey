<?php
$db =mysqli_connect('localhost','root','','shop');
if(!$db){
    echo "database  not connect";

}

?>
<?php
if(isset($_GET['delete'])){
  $id=htmlspecialchars($_GET['delete']);
  $query = mysqli_query($db,"DELETE FROM `admin` WHere `id`='$id'");
  If($query){
    header("location:show-item.php");
  }
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
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
          <li class="nav-item ">
            <a class="nav-link " href="show-item.php">Show Item</a>
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
  
  <div class="row m-2 justify-content-center ">
    <?php
    $query =mysqli_query($db,"SELECT * FROM `admin`");
    while($row=mysqli_fetch_assoc($query)){?>

<div class="card m-2 " style="width: 18rem;">
  <img src="../photo/<?php echo $row['photo'];?>" class="card-img-top" name="file" alt="...">
  <div class="card-body">
    <h5 class="card-title " name="Name"><?php echo $row['Name'];?></h5>
    <h5 class="card-title" name="price"><?php echo $row['price'];?></h5>
    <!-- <p class="card-text" name="Item"><?php echo $row['Item'];?></p> -->
    <a href="show-item.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">delete</a>
    <a href="../admin/index.php?id=<?php  echo $row["id"];?>" class="btn btn-primary stretched-link">View item</a>
  </div>
</div>
<?php } ?>
  </div>
  
</body>
</html>
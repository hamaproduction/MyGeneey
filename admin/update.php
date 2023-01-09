<?php
$db = mysqli_connect('localhost', 'root', '', 'shop');
if (!$db) {
  echo "database  not connect";
}

?>

<?php
if (isset($_GET['delete'])) {
  $id = htmlspecialchars($_GET['delete']);
  $query = mysqli_query($db, "DELETE FROM `admin` WHere `id`='$id'");
  if ($query) {
    header("location:update.php");
  }
}
?>
<?php

if (isset($_POST['submit'])) {

  // $file =htmlspecialchars($_POST['file']);
  // $Item =htmlspecialchars($_POST['Item']);
  // $name =htmlspecialchars($_POST['name']);
  // $price =htmlspecialchars($_POST['price']);


  if (array_key_exists('file', $_FILES)) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileSize = $_FILES['file']['size'];

    $Name = $_POST['Name'];
    $price = $_POST['price'];
    $item = $_POST['Item'];


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $fileAllowed = array('png', 'jpg', 'jpeg', 'svg', 'gif');

    if (in_array($fileActualExt, $fileAllowed)) {
      if ($fileError === 0) {
        if ($fileSize < 100000000) {
          $fileNewName = uniqid('', true) . "." . $fileActualExt;
          $fileDestination = "../photo/$fileNewName";
          move_uploaded_file($fileTmpName, $fileDestination);

          $query = mysqli_query($db, "INSERT INTO `admin` (`Name`,`price`,`Item`,`photo`) VALUES ('$Name','$price','$item','$fileNewName')");
          if ($query) {
            header("location:update.php");
          }
        } else {
          $errors['result'] = "please this photo large bit";
        }
      } else {
        $errors['result'] = "please try agen";
      }
    } else {
      $errors['result'] = "please only upload photo";
    }
  }
}


?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="all.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

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
          <li class="nav-item text-end">
            <a class="nav-link" href="Login.php">Logout</a>
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
  <div class="col-4 bg-white p-3 m-auto radius-10 shadow">
    <form action="update.php" method="POST" enctype="multipart/form-data">

      <input type="file" name="file" class="form-control mt-2">
      <input type="text" name="Item" class="form-control mt-2" placeholder="about item">
      <input type="text" name="Name" class="form-control mt-2" placeholder="name">
      <input type="tel" name="price" class="form-control mt-2" placeholder="price">
      <button class=" btn btn-primary mt-2 w-100" name="submit">add</button>

    </form>
  </div>
  <div class="row m-2 justify-content-center ">
    <?php
    $query = mysqli_query($db, "SELECT * FROM `admin` ORDER BY `admin`.`id` DESC");
    while ($row = mysqli_fetch_assoc($query)) { ?>

      <div class="card m-2" style="width: 18rem;">
        <img src="../photo/<?php echo $row['photo']; ?>" class="card-img-top" name="file" alt="...">
        <div class="card-body">
          <h5 class="card-title " name="Name"><?php echo $row['Name']; ?></h5>
          <h5 class="card-title" name="price"><?php echo $row['price']; ?></h5>
          <!-- <p class="card-text" name="Item"><?php echo $row['Item']; ?></p> -->
          <a href="update.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">delete</a>
          <a href="index.php?id=<?php echo $row['id']; ?>" class="btn btn-primary stretched-link">View item</a>
        </div>
      </div>
    <?php } ?>
  </div>





</body>

</html>
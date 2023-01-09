<?php
$db = mysqli_connect('localhost', 'root', '', 'shop');
if (!$db) {
  echo "database  not connect";
}

?>

<?php
ob_start();
session_start();

global $Name,
  $price,
  $Item,
  $photo,
  $id;

if (!empty($_SERVER['QUERY_STRING'])) {
  $url_queries = explode('&', $_SERVER['QUERY_STRING']);
  $id_value = explode('=', $url_queries[0]);
  $GLOBALS['id'] = $id_value[1];
  $_SESSION['id'] = $GLOBALS['id'];
}


function assign_values($id, $db, $type)
{
  echo $type;
  $res = mysqli_query($db, "SELECT * FROM `admin` WHERE `id`='$id'");

  while ($row = mysqli_fetch_array($res)) {
    $GLOBALS['Name'] = $row["Name"];
    $GLOBALS['price'] = $row["price"];
    $GLOBALS['Item'] = $row["Item"];
    $GLOBALS['photo'] = $row["photo"];
  }
}


if (isset($_SESSION['id'])) {

  assign_values($_SESSION['id'], $db, " "); //delete in double cotaion write seeion

} else if (isset($_GET['id'])) {

  assign_values($_GET['id'], $db, " "); //delete in double cotaion write get

}
?>

<?php

$errors = ['name' => '', 'phone' => '', 'location' => '', 'city' => '', 'secondphone' => '', 'email' => '', 'number' => ''];
if (isset($_POST['submit'])) {
  $number = htmlspecialchars($_POST['number']);
  $name = htmlspecialchars($_POST['name']);
  $location = htmlspecialchars($_POST['location']);
  $city = htmlspecialchars($_POST['city']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $secondphone = htmlspecialchars($_POST['secondphone']);

  if (empty($name)) {
    $errors['name'] = "please enter your name";
  }
  if (empty($phone)) {
    $errors['phone'] = "please enter your phone number";
  } else
if (strlen($phone) < 11) {
    $errors['phone'] = "please enter your number is complete";
  }
  if (empty($location)) {
    $errors['location'] = "please enter your address";
  }
  if (empty($city)) {
    $errors['city'] = "please enter your city";
  } else {
    $query = mysqli_query($db, "INSERT INTO `object`(`name`,`email`,`location`,`phone` ,`city`,`number`,`secondphone`) VALUES('$name','$email','$location','$phone','$city','$number','$secondphone')");

    if ($query) {

      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}


?>
<style>
  * {
    text-align: center;
    align-items: center;
  }
</style>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <title><?php echo $GLOBALS['Name'] ?></title>
</head>

<body>
  <div class="bold nav-md-12 ul-ignor ">
    <!-- <ul>
            <li class="nav "> <h1> <?php echo $GLOBALS['Name'] ?></h1> </li>
        </ul> -->

  </div>

  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../photo/<?php echo $GLOBALS['photo'] ?>" class="d-block w-100 h-50" alt="...">
      </div>

    </div>
  </div>
  </div>

  </div>
  <div class="about">
    <label class="text-xl-start" for="inputEmail4">About Item</label>
    <h6 class="  "><?php echo $GLOBALS['Item'] ?></h6>
    <label class="text-xl-start" for="inputEmail4">price</label>
    <h1 class=" text-info bg-dark"><?php echo $GLOBALS['price'] ?></h1>

  </div>

  <form action="index.php" method="POST">
    <div class="form-row ">
      <div class="form-group col-md-6">
        <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['name']; ?></p>
        <label for="inputEmail4">Name</label>
        <input type="name" class="form-control" name="name" placeholder="Name">
      </div>
      <div class="form-group col-md-6">
        <p class="alret alert-white text-danger p-2 radius-5"></p>
        <label for="inputPassword4">Email</label>
        <input type="email" class="form-control" name="email" id="inputPassword4" placeholder="Email">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6 ">
        <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['location']; ?></p>
        <label for="inputAddress">location</label>
        <input type="text" class="form-control" name="location" id="inputAddress" placeholder="location">
      </div>
      <div class="form-group col-md-6">
        <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['city']; ?></p>
        <label for="inputCity">City</label>
        <input type="text" class="form-control" name="city" id="inputCity" placeholder="City">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['phone']; ?></p>
        <label for="inputAddress2">Phone Number </label>
        <input type="tel" class="form-control" name="phone" id="inputAddress2" placeholder="phone number">
      </div>
      <div class="form-group col-md-5">
        <p class="alret alert-white text-danger p-2 radius-5"></p>
        <label for="inputAddress2">second Phone Number</label>
        <input type="tel" class="form-control" name="secondphone" id="inputAddress2" placeholder="phone number">
      </div>
      <div class="form-group col-md-2">
        <p class="alret alert-white text-danger p-2 radius-5"></p>
        <label for="inputZip">Number Of Order</label>
        <input type="number" class="form-control" id="number" name="number" id="inputZip" value="1">
      </div>
    </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Order </button>

  </form>

  <div class="row m-2 justify-content-center ">
    <?php
    $query = mysqli_query($db, "SELECT * FROM `admin` ORDER BY `admin`.`id` DESC");
    $index = 0;
    while (($row = mysqli_fetch_assoc($query)) && $index <= 3) { ?>
      <div class="form-group">
        <div class="card m-2" style="width: 18rem;">
          <img src="../photo/<?php echo $row['photo']; ?>" class="card-img-top" name="file" alt="...">
          <div class="card-body">
            <h5 class="card-title " name="Name"><?php echo $row['Name']; ?></h5>
            <h5 class="card-title" name="price"><?php echo $row['price']; ?></h5>
            <!-- <p class="card-text" name="Item"><?php echo $row['Item']; ?></p> -->
            <a href="../admin/index.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary stretched-link">View item</a>

          </div>
        </div>

      <?php
      $index++;
    }
      ?>
      </div>
  </div>

</body>

</html>
<?php
$db = mysqli_connect('localhost', 'root', '', 'shop');
if (!$db) {
  echo "database  not connect";
}
?>




<?php
if (isset($_GET['delete'])) {
  $ID = htmlspecialchars($_GET['delete']);
  $query = mysqli_query($db, "DELETE FROM `object` WHere `ID`='$ID'");
  if ($query) {
    header("location:info.php");
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="all.css">
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
          <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="kids.php">kids</a></li>
            <li><a class="dropdown-item" href="home.php">home</a></li>
            <li><a class="dropdown-item" href="show-item.php">anthor one</a></li>
          </ul>
        </li>
        <li>
       
        </li> -->
        </ul>
      </div>
    </div>
  </nav>
  <table class="table table-striped">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>email</th>
      <th>city</th>
      <th>order</th>
      <th>phone</th>
      <th>second phone</th>
      <th>location</th>
      <th>Delete</th>

    </tr>
    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'shop');
    if ($conn->connect_error) {
      die("Connection faild:" . $conn->connect_error);
    }

    $sql = "SELECT * FROM `object`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"] .
          "</td><td>" . $row["name"] .
          "</td><td>" . $row["email"] .
          "</td><td>" . $row["city"] .
          "</td><td>" . $row["number"] .
          "</td><td>" . $row["phone"] .
          "</td><td>" . $row["secondphone"] .
          "</td><td>" . $row["location"] .
          "</td><td><a href='info.php?delete=" . $row['ID'] . "' class='btn btn-danger'>delete</a></td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 result";
    }
    $conn->close();
    ?>
  </table>
</body>

</html>
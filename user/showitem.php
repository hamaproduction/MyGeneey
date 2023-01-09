<?php include 'config.php'?>
<?php

$errors =['name'=>'','phone'=>'','location'=>'','city'=>'','secondphone'=>'','email'=>'','number'=>''];
if(isset($_POST['submit'])){
$number = htmlspecialchars($_POST['number']);
$name = htmlspecialchars($_POST['name']);
$location = htmlspecialchars($_POST['location']);
$city = htmlspecialchars($_POST['city']);
$email= htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$secondphone= htmlspecialchars($_POST['secondphone']);

if(empty($name)){
  $errors['name'] ="please enter your name";
} 
if(empty($phone)){
 $errors['phone']= "please enter your phone number";
}
else
if(strlen($phone)<11){
 $errors['phone']= "please enter your number is complete";
}
if(empty($location)){
 $errors['location']= "please enter your address";
}
if(empty($city)){
 $errors['city']= "please enter your city";
}
else{
 $query=mysqli_query($db,"INSERT INTO `object`(`name`,`email`,`location`,`phone` ,`city`,`number`,`secondphone`) VALUES('$name','$email','$location','$phone','$city','$number','$secondphone')");
 if($query){
   header("location:showitem.php?success");
 }
}
}


?>
<?php
ob_start();
session_start();

$id=$_GET["id"];
$name= "";
$price="";
$Item="";
$photo="";



$res=mysqli_query($db, "SELECT * from admin where id=$id");
while($row=mysqli_fetch_array($res))
{
    $name=$row["name"];
    $price=$row["price"];
    $Item=$row["Item"];
    $photo=$row['photo'];
  
}
?>

<style>
  *{
    margin: 0 auto;
    padding: 0px;
    background-color:whitesmoke ;
    text-align: center;
    
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles/DoctorProfile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title> <?php echo $name ?></title>
</head>


<body>

                   
                  
                  <div class="bold nav-md-12 ul-ignor ">
        <ul>
            <li class="nav"> <h1> <?php echo $name ?></h1> </li>
        </ul>
      </div>
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../photo/<?php echo $photo ?>" class="d-block w-100" alt="...">
          </div>
          
        </div>
      </div>
      </div>
  
</div>
<div class="form-group col-md-4 ">
<label class="text-xl-start" for="inputEmail4">Name</label>
          <h1 class=" text-danger "><?php echo $name?></h1>
          <label class="text-xl-start" for="inputEmail4">price</label>
          <h1 class=" text-info bg-dark"><?php echo $price?></h1>
             
          </div>
  
    <form action="showitem.php" method="POST" > 
          <div class="form-group col-md-4 ">
          <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['name'];?></p>
          <label for="inputEmail4">Name</label>
             <input type="name" class="form-control" name="name"  placeholder="Name">
          </div>
         <div class="form-group col-md-4">
         <p class="alret alert-white text-danger p-2 radius-5"></p>
            <label for="inputPassword4">Email</label>
            <input type="email" class="form-control" name="email" id="inputPassword4" placeholder="Email">
          </div>
        <div class="form-group col-md-4 ">
        <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['location'];?></p>
          <label for="inputAddress">location</label>
          <input type="text" class="form-control" name="location" id="inputAddress" placeholder="location">
        </div>
        <div class="form-group col-md-4">
        <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['phone'];?></p>
          <label for="inputAddress2">Phone Number</label>
          <input type="tel" class="form-control" name="phone" id="inputAddress2" placeholder="phone number">
        </div>
        <div class="form-group col-md-4">
        <p class="alret alert-white text-danger p-2 radius-5"></p>
          <label for="inputAddress2">second Phone Number</label>
          <input type="tel" class="form-control" name="secondphone" id="inputAddress2" placeholder="phone number">
        </div>
          <div class="form-group col-md-4">
          <p class="alret alert-white text-danger p-2 radius-5"><?php echo $errors['city'];?></p>
            <label for="inputCity">City</label>
            <input type="text" class="form-control" name="city" id="inputCity" placeholder="City">
          </div>
          <div class="form-group col-md-4">
          <p class="alret alert-white text-danger p-2 radius-5"></p>
            <label for="inputZip">Number Of Order</label>
            <input type="number" class="form-control" name="number" id="inputZip" value="1">
          </div>
        </div> 
     <div class="form-group col-md-4 mt-2">
        <button type="submit" name="submit" class="btn btn-primary">Order</button>
        <p> total Price: <?php echo $price ?> </p>
</div>
      </form>
                  
</body>

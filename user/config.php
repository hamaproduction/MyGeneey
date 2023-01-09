<?php
$db =mysqli_connect('localhost','root','','shop');
if(!$db){
    echo "database  not connect";

}
function clear($data){
    global $db;
    $data = mysqli_real_escape_string($db,htmlspecialchars($data));
    return $data;
}
function getRows($condition){
    global;
    $query = mysqli_query($db,"SELECT *FROM $condition");
    echo mysqli_num_rows($query);
}
$ip = $_SERVER['REMOT_ADDR'];
$query =mysqli_query($db,"SELECT * FROM `visitor` WHERE `ip`='$ip'");
if(mysqli_num_rows($query) == 0){
  $query =  mysqli_query($db,"INSERT INTO `visitor`(`ip`) VALUES('$ip')");

}else{

}

?>
<!-- <h6>visitor: <?php getRows('visitor');?></h6> -->
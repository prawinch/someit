<?php
session_start();
include '../../dbconnect9.php';
$email = $_SESSION['admin_user'];
$log_res=mysqli_query($conn,"SELECT * FROM `admin-user` WHERE `email`='$email'");
$rows1=mysqli_num_rows($log_res);
if ((!isset($_SESSION['admin_user'])) OR ($rows1 == 0)){
  header("Location: ../");
}
$log_row=mysqli_fetch_array($log_res);
$log_name=$log_row['firstname'];

if(isset($_POST['value'])){
  $price=$_POST['value'];
  $service_id=$_POST['pk'];
  mysqli_query($conn,"UPDATE `services` SET `price`='$price' WHERE `service_id`='$service_id'");
}
?>
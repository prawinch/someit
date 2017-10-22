<?php

include '../../dbconnect9.php';
session_start();
$email = $_SESSION['admin_user'];
$log_res=mysqli_query($conn,"SELECT * FROM `admin-user` WHERE `email`='$email'");
$rows1=mysqli_num_rows($log_res);
if ((!isset($_SESSION['admin_user'])) OR ($rows1 == 0)){
  header("Location: ../../");
}
$log_row=mysqli_fetch_array($log_res);
$log_name=$log_row['firstname'];

if(isset($_GET['ticket_id']) AND isset($_GET['vendor_name'])){
  $ticket_id=$_GET['ticket_id'];
  $vendor_name=$_GET['vendor_name'];
  mysqli_query($conn,"UPDATE `tickets` SET `status`='Assigned to: $vendor_name',`vendor`='$vendor_name' WHERE `ticket_id`='$ticket_id'");

    $his_time = date("Y-m-d h:i:s");
  mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Vendor Changed by - $email')");
  header("Location: ticketedit.php?ticket_id=$ticket_id");
}
?>
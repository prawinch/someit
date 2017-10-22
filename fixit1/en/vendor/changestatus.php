<?php
include '../../dbconnect9.php';
include "../../phpmailer/class.phpmailer.php";
session_start();
$email = $_SESSION['vendor_user'];
$log_res=mysqli_query($conn,"SELECT * FROM `vendors` WHERE `vendor_email`='$email'");
$rows1=mysqli_num_rows($log_res);
if ((!isset($_SESSION['vendor_user'])) OR ($rows1 == 0)){
  header("Location: ../../");
}
$log_row=mysqli_fetch_array($log_res);
$log_name=$log_row['vendor_name'];

if(isset($_GET['ticket_id']) AND isset($_GET['status'])){
  $ticket_id=$_GET['ticket_id'];
  $status=$_GET['status'];

  if($status == 'done'){
  	mysqli_query($conn,"UPDATE `tickets` SET `status`='Work Done by: $log_name' WHERE `ticket_id`='$ticket_id'");

      $his_time = date("Y-m-d h:i:s");
  mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Work Done by - $log_name')");
  header("Location: ticketedit.php?ticket_id=$ticket_id");
  }else if($status == 'raiseinvoice'){
  	mysqli_query($conn,"UPDATE `tickets` SET `status`='Invoice Requested' WHERE `ticket_id`='$ticket_id'");

      $his_time = date("Y-m-d h:i:s");
  mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Invoice Requested by - $email')");
  header("Location: ticketedit.php?ticket_id=$ticket_id");
  }

}
?>
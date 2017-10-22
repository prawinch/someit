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

if(!empty($_POST['name']) AND !empty($_POST['value'])){
  $ticket_id=$_POST['pk'];
  if($_POST['name']=='invoice_date'){
  	$invoice_date=$_POST['value'];
  	mysqli_query($conn,"UPDATE `invoices` SET `invoice_date`='$invoice_date' WHERE `ticket_id`='$ticket_id'");
  }else if($_POST['name']=='bill_due'){
  	$bill_due=$_POST['value'];
  	$inv_res=mysqli_query($conn,"SELECT `invoice_date` FROM `invoices` WHERE `ticket_id`='$ticket_id'");
  	$inv_row=mysqli_fetch_array($inv_res);
  	$invoice_date=$inv_row['invoice_date'];
      $bill_due_date = date('Y-m-d', strtotime($invoice_date . ' + ' . $bill_due . ' days'));
  	mysqli_query($conn,"UPDATE `invoices` SET `bill_due_date`='$bill_due_date', `bill_due`='$bill_due' WHERE `ticket_id`='$ticket_id'");
  }else if($_POST['name']=='description'){
  	$description=$_POST['value'];
  	mysqli_query($conn,"UPDATE `invoices` SET `description`='$description' WHERE `ticket_id`='$ticket_id'");
  }
}
?>
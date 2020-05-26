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

if(isset($_POST['ticket_id']) AND isset($_POST['rot'])){
$ticket_id=$_POST['ticket_id'];
$label1=$_POST['label1'];
$label2=$_POST['label2'];
    $label3 = $_POST['label3'];
$personal_number=$_POST['personal_number'];
$rot='True';
$rot_res=mysqli_query($conn, "SELECT * FROM `rot` WHERE `ticket_id`='$ticket_id'");
$rot_num_rows=mysqli_num_rows($rot_res);
if($rot_num_rows == '1'){
    mysqli_query($conn, "UPDATE `rot` SET `label1`='$label1',`label2`='$label2',`label3`='$label3', `personal_number`='$personal_number' WHERE `ticket_id`='$ticket_id'");
}else{
    mysqli_query($conn, "INSERT INTO `rot`(`ticket_id`, `label1`, `label2`, `label3`, `personal_number`, `rot_data`) VALUES ('$ticket_id','$label1','$label2','$label3', '$personal_number','This is static data from database only occurs on ROT enabled')");
	mysqli_query($conn,"UPDATE `invoices` SET `rot`='$rot' WHERE `ticket_id`='$ticket_id'");
}

  header("Location: invoices.php?ticket_id=$ticket_id");
}
?>
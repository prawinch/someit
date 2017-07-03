<?php

include '../dbconnect9.php';

if (!empty($_POST['email']) AND !empty($_POST['password'])){
$email = $_POST['email'];
$password=$_POST['password'];
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysqli_real_escape_string($conn,$email);
$password = mysqli_real_escape_string($conn,$password);

$log_res=mysqli_query($conn,"SELECT * FROM `admin-user` WHERE `email`='$email' AND `password`='$password'");
$log_row=mysqli_num_rows($log_res);
if($log_row != 0){
	session_start(); // Starting Session	
	$_SESSION['admin_user']=$email;
	header("location: admin/dashboard.php");
} else {
	$log_res1=mysqli_query($conn,"SELECT * FROM `vendors` WHERE `vendor_email`='$email' AND `vendor_password`='$password'");
	$log_row1=mysqli_num_rows($log_res1);
	session_start(); // Starting Session
	if ($log_row1 != 0) {
		$_SESSION['vendor_user']=$email;
		header("location: vendor/dashboard.php");
	}else{
		header("location: index.php");
	}	
}
}else{
	header("location: index.php");
}



?>
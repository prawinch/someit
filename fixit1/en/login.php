<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title>FiXiT | Your Problem Our Solution</title>
    <!-- Sweet Alert -->
    <link href="../global/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="../global/sweetalert/sweetalert.min.js"></script>
    <!-- Javascripts -->
    <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>

</head>
<body>
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
        $_SESSION['admin_user'] = $email;
        //header("location: admin/dashboard.php");
        echo '<script>window.location.href = "admin/dashboard.php"; </script>';
} else {
        $log_res1 = mysqli_query($conn, "SELECT * FROM `vendors` WHERE `vendor_email`='$email' AND `vendor_password`='$password'");
        $log_row1 = mysqli_num_rows($log_res1);

        if ($log_row1 != 0) {
            session_start(); // Starting Session
            $_SESSION['vendor_user'] = $email;
            //header("location: vendor/dashboard.php");
            echo '<script>window.location.href = "vendor/dashboard.php"; </script>';
        } else {
            echo '<script>
        $(document).ready(function () {
            swal({
                title: "Invalid Credentials!",
                text: "Redirecting to homepage",
                timer: 2000,
                type: "error",
                showConfirmButton: false
            }, function(){
                window.location.href = "index.php";
            });
        });
        </script>';
            //header("location: index.php");
        }
}
}else{
    echo '<script>
        $(document).ready(function () {
            swal({
                title: "Invalid Credentials!",
                text: "Redirecting to homepage",
                timer: 2000,
                type: "error",
                showConfirmButton: false
            }, function(){
                window.location.href = "index.php";
            });
        });
        </script>';
    //header("location: index.php");
}
?>
</body>
</html>

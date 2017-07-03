<?php
if(isset($_POST['get_option']))
{

include '../dbconnect9.php';

 $state = $_POST['get_option'];
 $find=mysqli_query($conn,"SELECT * FROM `services` WHERE `service`='$state'");
 while($row=mysqli_fetch_array($find))
 {
  echo "<option>".$row['sub_service']."</option>";
 }
 exit;
}
?>
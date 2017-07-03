<?php
$dbhost = 'localhost';
$dbuser = 'reitsolution_se_fixit';
$dbpass = 'Fixit@99';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'reitsolution_se_fixit';
mysqli_select_db($conn,$dbname);
?>
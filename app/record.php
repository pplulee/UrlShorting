<?php
require_once('./config.php');
require_once('./app/ip.php');
require_once('./app/time.php');
function access($shorturl,$domain,$type){
global $conn;
global $ip;
global $time;
$access="INSERT INTO access VALUES('$shorturl','$domain','$type','$ip','$time');";
$go=mysqli_query($conn,$access);
}
?>
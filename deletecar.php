<?php
require_once('connection.php');
include('authentication.php');
$carid=$_GET['id'];
$sql="DELETE from cars where CAR_ID=$carid";
$result=mysqli_query($con,$sql);

echo '<script>alert("CAR DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "adminvehicle.php";</script>';

?>
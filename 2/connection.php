<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn=mysqli_connect('127.0.0.1:3307','root','','budgetflow');
if(!$conn){
    echo 'Please check your Database connection';
}
?>
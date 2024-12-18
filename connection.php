<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect('127.0.0.1:3307','root','','carproject');
    if(!$con)
    {
        echo 'please check your Database connection';
    }

?>
<?php

require_once('connection.php');
include('authentication.php');

$carid = $_GET['id'];
$book_id = $_GET['bookid'];

// Fetch car details
$sql = "SELECT * FROM cars WHERE CAR_ID = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $carid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$res = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch booking details
$sql2 = "SELECT * FROM booking WHERE BOOK_ID = ?";
$stmt2 = mysqli_prepare($con, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $book_id);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$res2 = mysqli_fetch_assoc($result2);
mysqli_stmt_close($stmt2);

// Check if the car has already been marked as returned
if ($res2['BOOK_STATUS'] == 'RETURNED') {
    echo '<script>alert("ALREADY CAR IS RETURNED")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
    exit();
}

// Update car availability
$sql4 = "UPDATE cars SET AVAILABLE = 'Y' WHERE CAR_ID = ?";
$stmt3 = mysqli_prepare($con, $sql4);
mysqli_stmt_bind_param($stmt3, "i", $carid);
$query2 = mysqli_stmt_execute($stmt3);
mysqli_stmt_close($stmt3);

// Update booking status
$sql5 = "UPDATE booking SET BOOK_STATUS = 'RETURNED' WHERE BOOK_ID = ?";
$stmt4 = mysqli_prepare($con, $sql5);
mysqli_stmt_bind_param($stmt4, "i", $book_id);
$query = mysqli_stmt_execute($stmt4);
mysqli_stmt_close($stmt4);

// Check if both updates were successful
if ($query2 && $query) {
    echo '<script>alert("CAR RETURNED SUCCESSFULLY")</script>';
} else {
    echo '<script>alert("ERROR: Could not update booking status.")</script>';
}

// Redirect to adminbook.php
echo '<script> window.location.href = "adminbook.php";</script>';
exit();

?>

<?php
header('Content-Type: application/json');
include('authentication.php');
include('connection.php');

try {
    $response = [];

    $query = "SELECT COUNT(*) AS totalUsers FROM users";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $response['totalUsers'] = $row['totalUsers'];

    $query = "SELECT COUNT(*) AS activeVehicles FROM cars WHERE AVAILABLE = 'Y'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $response['activeVehicles'] = $row['activeVehicles'];

    $query = "SELECT COUNT(*) AS feedbackCount FROM feedback";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $response['feedbackCount'] = $row['feedbackCount'];

    $query = "SELECT COUNT(*) AS pendingBookings FROM booking WHERE BOOK_STATUS = 'UNDER PROCESSING'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $response['pendingBookings'] = $row['pendingBookings'];

    $query = "
        SELECT 
            CONCAT('Booking ID ', BOOK_ID, ' - ', CAR_ID, ' booked by ', EMAIL) AS description, 
            EMAIL AS user, 
            BOOK_DATE AS date 
        FROM booking 
        ORDER BY BOOK_DATE DESC 
        LIMIT 10";
    $result = mysqli_query($con, $query);
    $recentActivities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $recentActivities[] = $row;
    }
    $response['recentActivities'] = $recentActivities;

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

<?php include('user_auth.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"> -->
    <link rel="stylesheet" href="style/bookstat.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="top-nav">
        <a href="index.php" class="logo">CaRental</a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="cardetails.php">Cars</a></li>
            <li><a href="aboutus.html">About</a></li>
            <li><a href="co.html">Contact</a></li>
            <li><a href="feedback/Feedbacks.php">Feedback</a></li>
            <li><a href="bookinstatus.php" class="active">Booking Status</a></li>
            <li><a href="bookings.php">Booking History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <?php
        require_once('connection.php');
        $email = $_SESSION['email'];
        $sql_user = "SELECT * FROM users WHERE EMAIL='$email'";
        $result_user = mysqli_query($con, $sql_user);
        $user = mysqli_fetch_assoc($result_user);
        $sql_bookings = "SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC";
        $result_bookings = mysqli_query($con, $sql_bookings);

        if (mysqli_num_rows($result_bookings) == 0) {
            echo '<script>alert("No booking details found.")</script>';
            echo '<script>window.location.href = "cardetails.php";</script>';
        } else {
    ?>
    <div class="container">
        <div class="header">
            <p class="name">Hello, <?php echo $user['FNAME'] . " " . $user['LNAME']; ?>!</p>
            <h3>Your Booking Details</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car Name</th>
                    <th>Duration (Days)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = mysqli_fetch_assoc($result_bookings)) { 
                    $car_id = $booking['CAR_ID'];
                    $sql_car = "SELECT * FROM cars WHERE CAR_ID='$car_id'";
                    $result_car = mysqli_query($con, $sql_car);
                    $car = mysqli_fetch_assoc($result_car);
                    
                    // Determine status color
                    $status = $booking['BOOK_STATUS'];
                    $status_color = "#6c757d"; // Default gray
                    
                    if(strtolower($status) == "confirmed" || strtolower($status) == "approved") {
                        $status_color = "#38b000"; // Success green
                    } else if(strtolower($status) == "pending") {
                        $status_color = "#ffc107"; // Warning yellow
                    } else if(strtolower($status) == "cancelled" || strtolower($status) == "rejected") {
                        $status_color = "#dc3545"; // Danger red
                    }
                ?>
                <tr>
                    <td><?php echo $booking['BOOK_ID']; ?></td>
                    <td><?php echo $car['CAR_NAME']; ?></td>
                    <td><?php echo $booking['DURATION']; ?></td>
                    <td style="color: <?php echo $status_color; ?>"><?php echo $booking['BOOK_STATUS']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="button-group">
            <a href="cardetails.php" class="button">Back to Home</a>
        </div>
    </div>

    <?php } ?>
</body>
</html>
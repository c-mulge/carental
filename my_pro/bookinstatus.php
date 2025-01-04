<?php include('user_auth.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <link rel="stylesheet" href="style/bookstat.css">
</head>
<body>
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
                ?>
                <tr>
                    <td><?php echo $booking['BOOK_ID']; ?></td>
                    <td><?php echo $car['CAR_NAME']; ?></td>
                    <td><?php echo $booking['DURATION']; ?></td>
                    <td><?php echo $booking['BOOK_STATUS']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="button-group">
            <a href="cardetails.php" class="button">Go to Home</a>
        </div>
    </div>

    <?php } ?>
</body>
</html>

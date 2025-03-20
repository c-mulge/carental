<?php include('user_auth.php'); ?>
<?php 
    require_once('connection.php');
    
    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    // Fetch user details
    $sql = "SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking History</title>
     <link rel="stylesheet" href="bookings.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>
    <?php
    include('connection.php');
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    $email = $_SESSION['email'];

    $query = "SELECT b.*, c.CAR_NAME, c.CAR_IMG 
              FROM booking b 
              JOIN cars c ON b.CAR_ID = c.CAR_ID 
              WHERE b.EMAIL = ? 
              ORDER BY b.BOOK_DATE DESC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <!-- Navigation Bar -->
    <nav class="top-nav">
        <a href="index.php" class="logo">CaRental</a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="cardetails.php">Cars</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="co.php">Contact</a></li>
            <li><a href="feedback/Feedbacks.php">Feedback</a></li>
            <li><a href="bookinstatus.php">Booking Status</a></li>
            <li><a href="bookings.php" class="active">Booking History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="user-profile">
            <i class="ri-user-line"></i>
            <span><a class="phello" href="profile.php"><?php echo $rows['FNAME'] . " " . $rows['LNAME']; ?></a></span>
        </div>
    </nav>

    <h1 class="overview">My Booking History</h1>

    <div class="container">
        <div class="header-container">
            <h2 class="page-title">
                <i data-feather="calendar"></i>
                All My Bookings
            </h2>
            <a href="cardetails.php" class="back-link">
                <i data-feather="arrow-left"></i>
                Back to Cars
            </a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="booking-table-container">
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Booking Details</th>
                            <th>Dates</th>
                            <th>Price/day</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($booking = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div class="car-name"><?php echo htmlspecialchars($booking['CAR_NAME']); ?></div>
                                    <div class="travel-route">
                                        From <?php echo htmlspecialchars($booking['BOOK_PLACE']); ?> 
                                        to <?php echo htmlspecialchars($booking['DESTINATION']); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="date-primary">
                                        Booked: <?php echo date('d M Y', strtotime($booking['BOOK_DATE'])); ?>
                                    </div>
                                    <div class="date-secondary">
                                        Return: <?php echo date('d M Y', strtotime($booking['RETURN_DATE'])); ?>
                                    </div>
                                    <div class="duration">
                                        Duration: <?php echo htmlspecialchars($booking['DURATION']); ?> days
                                    </div>
                                </td>
                                <td>
                                    <div class="price">₹<?php echo number_format($booking['PRICE']); ?></div>
                                </td>
                                <td>
                                    <div class="price">₹<?php echo number_format($booking['PRICE'] *$booking['DURATION']); ?></div>
                                </td>
                                <td>
                                    <span class="status-badge 
                                        <?php 
                                            echo 'status-' . strtolower(str_replace(' ', '-', $booking['BOOK_STATUS'])); 
                                        ?>">
                                        <?php echo htmlspecialchars($booking['BOOK_STATUS']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i data-feather="calendar-x" width="64" height="64"></i>
                <h2 class="empty-state-title">No Booking History</h2>
                <p class="empty-state-message">You haven't made any bookings yet.</p>
                <a href="cardetails.php" class="book-now-btn">
                    <i data-feather="plus"></i>
                    Book a Car Now
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
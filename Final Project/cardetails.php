<?php 
    require_once('connection.php');
    include('user_auth.php');
    
    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    // Fetch user details
    $sql = "SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);
    
    // Fetch cars by categories
    $large_cars_query = "SELECT * FROM cars WHERE AVAILABLE='Y' AND CAR_TYPE = 'Large'";
    $small_cars_query = "SELECT * FROM cars WHERE AVAILABLE='Y' AND CAR_TYPE = 'Small'";
    $premium_cars_query = "SELECT * FROM cars WHERE AVAILABLE='Y' AND CAR_TYPE = 'Premium'";

    $large_cars = mysqli_query($con, $large_cars_query);
    $small_cars = mysqli_query($con, $small_cars_query);
    $premium_cars = mysqli_query($con, $premium_cars_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link href="cardetails.css" rel="stylesheet"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaRent - Our Fleet</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="cardetails.css">
    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .book-button {
            width: 48%; /* Changed from 50% to allow for gap */
            display: inline-block;
        }

        footer {
            background: var(--dark);
            color: var(--light);
            text-align: center;
            padding: 1.5rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <a href="#" class="logo">CaRental</a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="cardetails.php" class="active">Cars</a></li>
            <li><a href="aboutus.html">About</a></li>
            <li><a href="co.html">Contact</a></li>
            <li><a href="feedback/Feedbacks.php">Feedback</a></li>
            <li><a href="bookinstatus.php">Booking Status</a></li>
            <li><a href="bookings.php">Booking History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="user-profile">
            <i class="ri-user-line"></i>
            <span><a class="phello" href="profile.php"><?php echo $rows['FNAME'] . " " . $rows['LNAME']; ?></a></span>
        </div>
    </nav>

    <h1 class="overview">OUR CARS OVERVIEW</h1>

    <!-- Large Cars Section -->
    <h2 class="category-title">Large Cars</h2>
    <div class="car-grid">
        <?php while ($result = mysqli_fetch_array($large_cars)) { ?>
            <div class="car-card">
                <img src="images/<?php echo $result['CAR_IMG']; ?>" alt="<?php echo $result['CAR_NAME']; ?>" class="car-image">
                <div class="car-details">
                    <h2><?php echo $result['CAR_NAME']; ?></h2>
                    <div class="car-specs">
                        <span><strong>Fuel:</strong> <?php echo $result['FUEL_TYPE']; ?></span>
                        <span><strong>Capacity:</strong> <?php echo $result['CAPACITY']; ?> Seats</span>
                        <span><strong>Rent:</strong> ₹<?php echo $result['PRICE']; ?>/day</span>
                    </div>
                    <div class="button-container">
                        <a href="details.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">View Details</a>
                        <a href="booking.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">Book Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Small Cars Section -->
    <h2 class="category-title">Small Cars</h2>
    <div class="car-grid">
        <?php while ($result = mysqli_fetch_array($small_cars)) { ?>
            <div class="car-card">
                <img src="images/<?php echo $result['CAR_IMG']; ?>" alt="<?php echo $result['CAR_NAME']; ?>" class="car-image">
                <div class="car-details">
                    <h2><?php echo $result['CAR_NAME']; ?></h2>
                    <div class="car-specs">
                        <span><strong>Fuel:</strong> <?php echo $result['FUEL_TYPE']; ?></span>
                        <span><strong>Capacity:</strong> <?php echo $result['CAPACITY']; ?> Seats</span>
                        <span><strong>Rent:</strong> ₹<?php echo $result['PRICE']; ?>/day</span>
                    </div>
                    <div class="button-container">
                        <a href="details.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">View Details</a>
                        <a href="booking.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">Book Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Premium Cars Section -->
    <h2 class="category-title">Premium Cars</h2>
    <div class="car-grid">
        <?php while ($result = mysqli_fetch_array($premium_cars)) { ?>
            <div class="car-card">
                <img src="images/<?php echo $result['CAR_IMG']; ?>" alt="<?php echo $result['CAR_NAME']; ?>" class="car-image">
                <div class="car-details">
                    <h2><?php echo $result['CAR_NAME']; ?></h2>
                    <div class="car-specs">
                        <span><strong>Fuel:</strong> <?php echo $result['FUEL_TYPE']; ?></span>
                        <span><strong>Capacity:</strong> <?php echo $result['CAPACITY']; ?> Seats</span>
                        <span><strong>Rent:</strong> ₹<?php echo $result['PRICE']; ?>/day</span>
                    </div>
                    <div class="button-container">
                        <a href="details.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">View Details</a>
                        <a href="booking.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">Book Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <footer>
        <p>&copy; 2024 CaRental. All rights reserved.</p>
    </footer>
</body>
</html>




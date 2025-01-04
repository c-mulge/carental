<?php 
    require_once('connection.php');
    include('user_auth.php');
    
    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $sql2="select *from cars where AVAILABLE='Y'";
    $cars= mysqli_query($con,$sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style/cardetails.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaRent - Our Fleet</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <nav class="top-nav">
        <a href="#" class="logo">CaRent</a>
        <ul class="nav-links">
            <li><a href="cardetails.php">Home</a></li>
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
    <div class="car-grid">
        <?php while ($result = mysqli_fetch_array($cars)) { ?>
            <div class="car-card">
                <img src="images/<?php echo $result['CAR_IMG']; ?>" alt="<?php echo $result['CAR_NAME']; ?>" class="car-image">
                <div class="car-details">
                    <h2><?php echo $result['CAR_NAME']; ?></h2>
                    <div class="car-specs">
                        <span><strong>Fuel:</strong> <?php echo $result['FUEL_TYPE']; ?></span>
                        <span><strong>Capacity:</strong> <?php echo $result['CAPACITY']; ?> Seats</span>
                        <span><strong>Rent:</strong> ₹<?php echo $result['PRICE']; ?>/day</span>
                    </div>
                    <a href="booking.php?id=<?php echo $result['CAR_ID']; ?>" class="book-button">Book Now</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

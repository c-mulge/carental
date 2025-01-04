<?php
require_once('connection.php');
include('user_auth.php'); 
if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    $sql = "SELECT * FROM cars WHERE CAR_ID='$car_id' AND AVAILABLE='Y'";
    $result = mysqli_query($con, $sql);
    $car = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_SESSION['email']; // Logged-in user's email
    $car_id = $_POST['car_id']; // Car ID from the form
    $book_place = $_POST['book_place']; // Place of booking
    $book_date = $_POST['book_date']; // Booking date
    $duration = $_POST['duration']; // Duration of rental
    $phone_number = $_POST['phone_number']; // User's phone number
    $destination = $_POST['destination']; // Destination for the car rental
    $return_date = $_POST['return_date']; // Return date
    $price = $_POST['price']; // Price for the booking
    
    $sql = "INSERT INTO booking (CAR_ID, EMAIL, BOOK_PLACE, BOOK_DATE, DURATION, PHONE_NUMBER, DESTINATION, RETURN_DATE, PRICE, BOOK_STATUS) 
            VALUES ('$car_id', '$user_email', '$book_place', '$book_date', '$duration', '$phone_number', '$destination', '$return_date', '$price', 'UNDER PROCESSING')";

    if (mysqli_query($con, $sql)) {
        $booking_id = mysqli_insert_id($con); 
        header("Location: payment.php?book_id=" . $booking_id);
        exit();
    } else {
        $error = "Failed to save booking details.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Car - CaRental</title>
    <link rel="stylesheet" href="style/book.css">
</head>
<body>

    <header>
        <div class="logo">CaRental</div>
        <nav class="menu">
            <a href="cardetails.php">Home</a>
            <a href="aboutus.html">About</a>
            <a href="contactus.html">Contact</a>
        </nav>
    </header>
    <div class="main-container">
        <h1>Book Your Car</h1>
        <div class="car-details">
            <h2><?php echo $car['CAR_NAME']; ?></h2>
            <p>Fuel Type: <?php echo $car['FUEL_TYPE']; ?></p>
            <p>Capacity: <?php echo $car['CAPACITY']; ?> seats</p>
            <p class="price">Rent per day: ₹<?php echo $car['PRICE']; ?>/-</p>
        </div>

        <form method="POST" action="booking.php">
            <input type="hidden" name="car_id" value="<?php echo $car['CAR_ID']; ?>">

            <div>
                <label for="book_place">Booking Place</label>
                <input type="text" name="book_place" required>
            </div>

            <div>
                <label for="book_date">Booking Date</label>
                <input type="date" name="book_date" required>
            </div>

            <div>
                <label for="duration">Duration (Days)</label>
                <input type="number" name="duration" required>
            </div>

            <div>
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" required>
            </div>

            <div>
                <label for="destination">Destination</label>
                <input type="text" name="destination" required>
            </div>

            <div>
                <label for="return_date">Return Date</label>
                <input type="date" name="return_date" required>
            </div>

            <input type="hidden" name="price" value="<?php echo isset($_POST['duration']) ? $car['PRICE'] * $_POST['duration'] : $car['PRICE']; ?>">

            <?php if (isset($error)) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>

            <button type="submit">Book Now</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 CaRental. All rights reserved.</p>
    </footer>

</body>
</html>

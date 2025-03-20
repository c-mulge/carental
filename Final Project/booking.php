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
    $pickup=$_POST['pickup'];
    $drop=$_POST['drop'];
    $phone_number = $_POST['phone_number']; // User's phone number
    $destination = $_POST['destination']; // Destination for the car rental
    $return_date = $_POST['return_date']; // Return date
    $price = $_POST['price']; // Price for the booking
    
    $sql = "INSERT INTO booking (CAR_ID, EMAIL, BOOK_PLACE, BOOK_DATE, DURATION, PHONE_NUMBER, DESTINATION, RETURN_DATE, PRICE, BOOK_STATUS, PICK_UP_TIME, DROP_TIME) 
            VALUES ('$car_id', '$user_email', '$book_place', '$book_date', '$duration', '$phone_number', '$destination', '$return_date', '$price', 'UNDER PROCESSING', '$pickup', '$drop')";

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="booking.css">
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
            <p><i class="fas fa-gas-pump"></i> Fuel Type: <?php echo $car['FUEL_TYPE']; ?></p>
            <p><i class="fas fa-users"></i> Capacity: <?php echo $car['CAPACITY']; ?> seats</p>
            <p class="price"><i class="fas fa-tag"></i> Rent per day: ₹<?php echo $car['PRICE']; ?>/-</p>
        </div>

        <form method="POST" action="booking.php">
            <input type="hidden" name="car_id" value="<?php echo $car['CAR_ID']; ?>">

            <div>
                <label for="book_place"><i class="fas fa-map-marker-alt"></i> Booking Place</label>
                <input type="text" name="book_place" required placeholder="Enter pickup location">
            </div>

            <div>
                <label for="book_date"><i class="fas fa-calendar-alt"></i> Start Date</label>
                <input type="date" name="book_date" required>
            </div>

            <div>
                <label for="pickup"><i class="fas fa-clock"></i> Pick Up:</label>
                <input type="time" name="pickup" required placeholder="Pick Up Time">
            </div>

            <div>
                <label for="duration"><i class="fas fa-clock"></i> Duration (Days)</label>
                <input type="number" name="duration" required min="1" placeholder="Number of days">
            </div>

            <div>
                <label for="phone_number"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="tel" name="phone_number" required placeholder="Your contact number">
            </div>

            <div>
                <label for="destination"><i class="fas fa-location-arrow"></i> Destination</label>
                <input type="text" name="destination" required placeholder="Where are you going?">
            </div>

            <div>
                <label for="return_date"><i class="fas fa-calendar-check"></i> Return Date</label>
                <input type="date" name="return_date" required>
            </div>

            <div>
                <label for="drop"><i class="fas fa-clock"></i> Drop:</label>
                <input type="time" name="drop" required placeholder="Drop Time">
            </div>

            <input type="hidden" name="price" value="<?php echo isset($_POST['duration']) ? $car['PRICE'] : $car['PRICE']; ?>">

            <?php if (isset($error)) { ?>
                <p class="error-message"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></p>
            <?php } ?>

            <button type="submit"><i class="fas fa-car"></i> Book Now</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 CaRental. All rights reserved.</p>
    </footer>

    <script>
        document.querySelector('input[name="duration"]').addEventListener('change', function() {
            const duration = this.value;
            const pricePerDay = <?php echo $car['PRICE']; ?>;
            const totalPrice = <?php duration * pricePerDay?>;
            document.querySelector('input[name="price"]').value = totalPrice;
        });

        document.querySelector('input[name="book_date"]').addEventListener('change', function() {
            const bookDate = new Date(this.value);
            const returnDateInput = document.querySelector('input[name="return_date"]');
            returnDateInput.min = this.value;

            const returnDate = new Date(returnDateInput.value);
            if (returnDate <= bookDate) {
                const nextDay = new Date(bookDate);
                nextDay.setDate(nextDay.getDate() + 1);
                returnDateInput.value = nextDay.toISOString().split('T')[0];
            }
        });
    </script>
</body>
</html>
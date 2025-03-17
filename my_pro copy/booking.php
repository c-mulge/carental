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
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #f72585;
            --accent: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --success: #38b000;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.08);
            --hover-shadow: 0 15px 30px rgba(67, 97, 238, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Modern Navigation */
        header {
            background: var(--dark);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .logo {
            color: var(--light);
            font-size: 1.7rem;
            font-weight: 800;
            text-decoration: none;
            position: relative;
        }

        .logo::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 50%;
            height: 3px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .menu {
            display: flex;
            align-items: center;
            list-style: none;
        }

        .menu a {
            color: var(--light);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
            margin-left: 2rem;
            position: relative;
        }

        .menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary);
            transition: width 0.3s ease;
        }

        .menu a:hover {
            color: var(--secondary);
        }

        .menu a:hover::after {
            width: 100%;
        }

        /* Main Container */
        .main-container {
            flex: 1;
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            animation: fadeIn 0.6s ease-out;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 2rem;
            position: relative;
        }

        h1::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .car-details {
            background: var(--light);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary);
        }

        .car-details h2 {
            color: var(--primary-dark);
            margin-bottom: 1rem;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .car-details p {
            margin-bottom: 0.5rem;
            color: var(--gray);
        }

        .car-details .price {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        form div {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        input {
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        button {
            grid-column: span 2;
            padding: 1rem;
            background: var(--primary);
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            margin-top: 1rem;
        }

        button:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        .error-message {
            grid-column: span 2;
            color: var(--secondary);
            background: rgba(247, 37, 133, 0.1);
            padding: 0.8rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        footer {
            background: var(--dark);
            color: var(--light);
            text-align: center;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        /* Animation Effects */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .main-container {
                padding: 1.5rem;
                margin: 1rem;
            }

            form {
                grid-template-columns: 1fr;
            }

            button {
                grid-column: span 1;
            }

            .error-message {
                grid-column: span 1;
            }

            header {
                padding: 1rem 3%;
                flex-direction: column;
                gap: 1rem;
            }

            .menu {
                width: 100%;
                justify-content: space-around;
            }

            .menu a {
                margin: 0;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
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
        // Calculate price dynamically based on duration
        document.querySelector('input[name="duration"]').addEventListener('change', function() {
            const duration = this.value;
            const pricePerDay = <?php echo $car['PRICE']; ?>;
            const totalPrice = <?php duration * pricePerDay?>;
            document.querySelector('input[name="price"]').value = totalPrice;
        });

        // Ensure return date is after booking date
        document.querySelector('input[name="book_date"]').addEventListener('change', function() {
            const bookDate = new Date(this.value);
            const returnDateInput = document.querySelector('input[name="return_date"]');
            returnDateInput.min = this.value;
            
            // If return date is before booking date, reset it
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
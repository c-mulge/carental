<?php 
    require_once('connection.php');
    include('user_auth.php');

    if (isset($_GET['id'])) {
        $car_id = $_GET['id'];
        $query = "SELECT * FROM cars WHERE CAR_ID='$car_id'";
        $result = mysqli_query($con, $query);

        if ($car = mysqli_fetch_assoc($result)) {
            // Car found, store details
        } else {
            echo "Car not found.";
            exit;
        }
    } else {
        echo "Invalid request.";
        exit;
    }
?>

<?php 
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
    <title>CaRent - Car Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="cardetails.css" rel="stylesheet">
    <style>
        .car-details-hero {
            background-color: white;
            padding: 3rem 5%;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .car-details-container {
            display: flex;
            gap: 3rem;
            margin: 2rem 5%;
            align-items: flex-start;
        }

        .car-image-wrapper {
            flex: 1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            position: relative;
        }

        .car-image-wrapper::before {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
            content: "Featured";
        }

        .car-image-large {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .car-image-wrapper:hover .car-image-large {
            transform: scale(1.05);
        }

        .car-info {
            flex: 1;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            position: relative;
        }

        .car-name {
            color: var(--primary-dark);
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .car-name::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .car-specs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .car-spec-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .car-spec-item strong {
            color: var(--dark);
            font-weight: 600;
            display: block;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .car-spec-item span {
            color: var(--primary-dark);
            font-size: 1.1rem;
            font-weight: 500;
        }

        .car-description {
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }

        .book-button {
            display: inline-block;
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            margin-top: 1rem;
        }

        .book-button:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        .booking-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            background: rgba(67, 97, 238, 0.1);
            margin-bottom: 1rem;
        }

        .price-label {
            font-size: 0.95rem;
            color: var(--dark);
            font-weight: 500;
        }

        .price-value {
            font-size: 1.6rem;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .page-title {
            font-size: 2rem;
            text-align: center;
            margin: 2rem 0;
            font-weight: 700;
            color: var(--dark);
        }

        @media (max-width: 900px) {
            .car-details-container {
                flex-direction: column;
                margin: 1rem 3%;
                gap: 1.5rem;
            }

            .car-image-wrapper, .car-info {
                width: 100%;
            }

            .car-specs-grid {
                grid-template-columns: 1fr;
            }

            .car-name {
                font-size: 1.8rem;
            }
        }

        /* Animation Effects */
        .car-image-wrapper {
            animation: fadeIn 0.6s ease-out;
            animation-delay: 0.1s;
            animation-fill-mode: both;
        }

        .car-info {
            animation: fadeIn 0.6s ease-out;
            animation-delay: 0.3s;
            animation-fill-mode: both;
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
        <a href="index.php" class="logo">CaRent</a>
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

    <h1 class="overview">Car Details</h1>

    <div class="car-details-container">
        <div class="car-image-wrapper">
            <img src="images/<?php echo $car['CAR_IMG']; ?>" alt="<?php echo $car['CAR_NAME']; ?>" class="car-image-large">
        </div>
        
        <div class="car-info">
            <h1 class="car-name"><?php echo $car['CAR_NAME']; ?></h1>
            
            <div class="car-specs-grid">
                <div class="car-spec-item">
                    <strong>Fuel Type</strong>
                    <span><?php echo $car['FUEL_TYPE']; ?></span>
                </div>
                <div class="car-spec-item">
                    <strong>Seating Capacity</strong>
                    <span><?php echo $car['CAPACITY']; ?> Persons</span>
                </div>
                <div class="car-spec-item">
                    <strong>Car Type</strong>
                    <span><?php echo $car['CAR_TYPE']; ?></span>
                </div>
                <div class="car-spec-item">
                    <strong>Transmission</strong>
                    <span><?php echo isset($car['TRANSMISSION']) ? $car['TRANSMISSION'] : 'Manual'; ?></span>
                </div>

                <div class="car-spec-item">
                    <strong>Mileage</strong>
                    <span><?php echo $car['MILEAGE']; ?></span>
                </div>

                <div class="car-spec-item">
                    <strong>Deposit Security</strong>
                    <span><?php echo $car['DEPOSITE_SECURITY']; ?></span>
                </div>
            </div>
            
                
            
            <div class="booking-price">
                <span class="price-label">Price per Day</span>
                <span class="price-value">₹<?php echo $car['PRICE']; ?></span>
            </div>

            <a href="booking.php?id=<?php echo $car['CAR_ID']; ?>" class="book-button">Book Now</a>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 CaRental. All rights reserved.</p>
    </footer>
</body>
</html>
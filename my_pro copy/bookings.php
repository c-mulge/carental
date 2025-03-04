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
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
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
        }

        /* Modern Navigation */
        .top-nav {
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

        .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
        }

        .nav-links li {
            margin-left: 2rem;
            position: relative;
        }

        .nav-links a {
            color: var(--light);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--secondary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        
.nav-links a:hover,
.nav-links a.active {
    color: var(--secondary);
}

.nav-links a:hover::after,
.nav-links a.active::after {
    width: 100%;
}

        .user-profile {
            display: flex;
            align-items: center;
            color: var(--light);
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            backdrop-filter: blur(5px);
        }

        .user-profile i {
            margin-right: 0.5rem;
            font-size: 1.2rem;
            color: var(--secondary);
        }

        .phello {
            font-size: 0.9rem;
            color: var(--light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .phello:hover {
            color: var(--secondary);
        }

        /* Page Header */
        .overview {
            text-align: center;
            padding: 4rem 1rem 2rem;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            position: relative;
        }

        .overview::after {
            content: "";
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        /* Booking History Styles */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
        }

        .page-title svg {
            margin-right: 0.75rem;
            stroke: var(--secondary);
        }

        .back-link {
            display: flex;
            align-items: center;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--accent);
            transform: translateX(-3px);
        }

        .back-link svg {
            margin-right: 0.5rem;
        }

        .booking-table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            animation: fadeIn 0.6s ease-out;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
        }

        .booking-table th {
            background: #f6f7fb;
            color: var(--gray);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            text-align: left;
        }

        .booking-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f0f2f5;
        }

        .booking-table tr:last-child td {
            border-bottom: none;
        }

        .booking-table tbody tr {
            transition: all 0.3s ease;
        }

        .booking-table tbody tr:hover {
            background: #f9fafc;
        }

        .car-name {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .travel-route {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .date-primary {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .date-secondary, .duration {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .price {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.9rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-under-processing {
            background-color: rgba(251, 191, 36, 0.2);
            color: #7C2D12;
        }

        .status-returned {
            background-color: rgba(52, 211, 153, 0.2);
            color: #064E3B;
        }

        .status-cancelled {
            background-color: rgba(248, 113, 113, 0.2);
            color: #7F1D1D;
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 16px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: var(--card-shadow);
            animation: fadeIn 0.6s ease-out;
        }

        .empty-state svg {
            color: #e2e8f0;
            margin-bottom: 1.5rem;
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }

        .empty-state-message {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }

        .book-now-btn {
            display: inline-flex;
            align-items: center;
            background: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
        }

        .book-now-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
        }

        .book-now-btn svg {
            margin-right: 0.5rem;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .container {
                width: 95%;
                padding: 1rem 0;
            }
            
            .header-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .booking-table {
                display: block;
                overflow-x: auto;
            }
            
            .booking-table th, 
            .booking-table td {
                padding: 0.75rem 1rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
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
                            <th>Price</th>
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
<?php
session_start();
require_once 'connection.php';

// Check if owner is logged in
if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php");
    exit();
}

// Fetch analytics data
$owner_id = $_SESSION['owner_id'];

// Get total cars
$cars_query = "SELECT COUNT(*) as total_cars FROM cars WHERE OWNER_ID = ?";
$stmt = $conn->prepare($cars_query);
$stmt->bind_param("s", $owner_id);
$stmt->execute();
$total_cars = $stmt->get_result()->fetch_assoc()['total_cars'];

// Get total bookings
$bookings_query = "SELECT COUNT(*) as total_bookings FROM booking b 
                   JOIN cars c ON b.CAR_ID = c.CAR_ID 
                   WHERE c.OWNER_ID = ?";
$stmt = $conn->prepare($bookings_query);
$stmt->bind_param("s", $owner_id);
$stmt->execute();
$total_bookings = $stmt->get_result()->fetch_assoc()['total_bookings'];

// Get total revenue
$revenue_query = "SELECT SUM(b.PRICE) as total_revenue FROM booking b 
                 JOIN cars c ON b.CAR_ID = c.CAR_ID 
                 WHERE c.OWNER_ID = ? AND b.BOOK_STATUS = 'RETURNED'";
$stmt = $conn->prepare($revenue_query);
$stmt->bind_param("s", $owner_id);
$stmt->execute();
$total_revenue = $stmt->get_result()->fetch_assoc()['total_revenue'];

// Get monthly booking data for chart
$monthly_bookings_query = "SELECT DATE_FORMAT(BOOK_DATE, '%Y-%m') as month, 
                          COUNT(*) as bookings, SUM(b.PRICE) as revenue
                          FROM booking b 
                          JOIN cars c ON b.CAR_ID = c.CAR_ID 
                          WHERE c.OWNER_ID = ?
                          GROUP BY month
                          ORDER BY month DESC
                          LIMIT 6";
$stmt = $conn->prepare($monthly_bookings_query);
$stmt->bind_param("s", $owner_id);
$stmt->execute();
$monthly_data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - CaRental</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600">CaRental</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-4"><?php echo htmlspecialchars($_SESSION['owner_name']); ?></span>
                    <a href="owner_logout.php" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">Total Cars</h3>
                <p class="text-3xl font-bold text-gray-900"><?php echo $total_cars; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">Total Bookings</h3>
                <p class="text-3xl font-bold text-gray-900"><?php echo $total_bookings; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">Total Revenue</h3>
                <p class="text-3xl font-bold text-gray-900">₹<?php echo number_format($total_revenue); ?></p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Bookings</h3>
                <canvas id="bookingsChart"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Revenue</h3>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Monthly Bookings Chart
        const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
        new Chart(bookingsCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_column(array_reverse($monthly_data), 'month')); ?>,
                datasets: [{
                    label: 'Bookings',
                    data: <?php echo json_encode(array_column(array_reverse($monthly_data), 'bookings')); ?>,
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Monthly Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column(array_reverse($monthly_data), 'month')); ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?php echo json_encode(array_column(array_reverse($monthly_data), 'revenue')); ?>,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
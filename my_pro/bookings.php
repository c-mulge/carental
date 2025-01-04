<?php include('user_auth.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking History</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-under-processing {
            background-color: #FBBF24;
            color: #7C2D12;
        }
        .status-returned {
            background-color: #34D399;
            color: #064E3B;
        }
        .status-cancelled {
            background-color: #F87171;
            color: #7F1D1D;
        }
    </style>
</head>
<body class="bg-gray-50 font-inter min-h-screen">
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
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    <i data-feather="calendar" class="inline-block mr-3 text-blue-600"></i>
                    My Booking History
                </h1>
                <a href="cardetails.php" class="text-blue-600 hover:underline flex items-center">
                    <i data-feather="arrow-left" class="inline-block mr-2"></i>
                    Back to Cars
                </a>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking Details</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php while($booking = $result->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($booking['CAR_NAME']); ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        From <?php echo htmlspecialchars($booking['BOOK_PLACE']); ?> 
                                                        to <?php echo htmlspecialchars($booking['DESTINATION']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                Booked: <?php echo date('d M Y', strtotime($booking['BOOK_DATE'])); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Return: <?php echo date('d M Y', strtotime($booking['RETURN_DATE'])); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Duration: <?php echo htmlspecialchars($booking['DURATION']); ?> days
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ₹<?php echo number_format($booking['PRICE']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="status-badge 
                                                <?php 
                                                    echo strtolower(str_replace(' ', '-', $booking['BOOK_STATUS'])); 
                                                ?>">
                                                <?php echo htmlspecialchars($booking['BOOK_STATUS']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center">
                    <i data-feather="calendar-x" class="w-24 h-24 text-gray-300 mx-auto mb-4"></i>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">No Booking History</h2>
                    <p class="text-gray-500 mb-6">You haven't made any bookings yet.</p>
                    <a href="cardetails.php" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i data-feather="plus" class="mr-2"></i>
                        Book a Car Now
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
<?php
require_once('connection.php');
include('user_auth.php'); 
require 'vendor/autoload.php'; // Autoload Razorpay SDK


$email = $_SESSION['email'] ?? null;

if (!$email) {
    die("User not authenticated");
}

// Fetch latest booking details
$stmt = $con->prepare("SELECT * FROM booking WHERE EMAIL = ? ORDER BY BOOK_ID DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$emailData = $result->fetch_assoc();

$bid = $emailData['BOOK_ID'] ?? null;
$_SESSION['bid'] = $bid;
$duration = $emailData['DURATION'] ?? 1;
$pricePerDay = $emailData['PRICE'] ?? 1;
$totalPrice = $duration * $pricePerDay;

// Fetch user details
$stmt = $con->prepare("SELECT * FROM users WHERE EMAIL = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_assoc();

// Razorpay API setup
use Razorpay\Api\Api;
$api = new Api('rzp_test_UTVyzQ3LlANHs0', 'E4zMgolgZHKBYh423JOgPH8k');

try {
    $order = $api->order->create([
        'receipt' => 'order_rcptid_' . $bid,
        'amount' => $totalPrice * 100, // Convert to paise
        'currency' => 'INR',
        'payment_capture' => 1
    ]);
    $orderId = $order['id'];
} catch (Exception $e) {
    die("Razorpay Error: " . $e->getMessage());
}

// Pass order details to JavaScript
$orderJson = json_encode($order);
?>

<html>
<head>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Razorpay Payment</h1>
    <p>Please pay below</p>
    <button id="rzp-button1">Pay</button>

    <script>
        var order = <?php echo $orderJson; ?>;
        var options = {
            "key": "rzp_test_UTVyzQ3LlANHs0",
            "amount": "<?php echo $totalPrice * 100; ?>", // Dynamic amount in paise
            "currency": "INR",
            "name": "CaRental",
            "description": "Car Rental Payment",
            "image": "https://example.com/your_logo",
            "order_id": order.id, // Set order ID dynamically
            "callback_url": "psuccess.php",
            "prefill": {
                "name": "<?php echo htmlspecialchars($rows['FNAME'] . ' ' . $rows['LNAME']); ?>",
                "email": "<?php echo htmlspecialchars($rows['EMAIL']); ?>",
                "contact": "+91<?php echo htmlspecialchars($rows['PHONE_NUMBER']); ?>"
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        };
    </script>
</body>
</html>

<?php

require_once('connection.php');
include('user_auth.php');
$email = $_SESSION['email'] ?? null;

$stmt = $con->prepare("SELECT * FROM booking WHERE EMAIL = ? ORDER BY BOOK_ID DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$emailData = $result->fetch_assoc();
$bid = $emailData['BOOK_ID'] ?? null;
$_SESSION['bid'] = $bid;
$duration = $emailData['DURATION'] ?? 10;
$pricePerDay = $emailData['PRICE'] ?? 10;
$totalPrice = $duration * $pricePerDay;

?>

<?php

$value = $_SESSION['email'];
$stmt = $con->prepare("SELECT * FROM users WHERE EMAIL = ?");
$stmt->bind_param("s", $value);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_assoc();
?>

<?php
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Payment Summary - CaRental</title>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    :root {
      --primary: #1a56db;
      --primary-light: #3b82f6;
      --primary-dark: #1e40af;
      --success: #059669;
      --danger: #dc2626;
      --warning: #d97706;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-400: #9ca3af;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-800: #1f2937;
      --gray-900: #111827;
      --shadow-sm: 0px 1px 2px rgba(0, 0, 0, 0.05);
      --shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.1), 0px 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-md: 0px 10px 15px -3px rgba(0, 0, 0, 0.1), 0px 4px 6px -2px rgba(0, 0, 0, 0.05);
      --shadow-lg: 0px 20px 25px -5px rgba(0, 0, 0, 0.1), 0px 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: var(--gray-100);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
    }

    /* Background gradients */
    body::before {
      content: "";
      position: fixed;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0) 70%);
      transform: rotate(-15deg);
      z-index: -1;
    }

    body::after {
      content: "";
      position: fixed;
      bottom: -50%;
      left: -50%;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, rgba(14, 165, 233, 0) 70%);
      transform: rotate(15deg);
      z-index: -1;
    }

    .invoice-container {
      max-width: 500px;
      width: 100%;
      background-color: white;
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
      animation: fadeIn 0.5s ease-out;
    }

    .invoice-header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      padding: 1.5rem;
      color: white;
      position: relative;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }

    .brand-logo {
      background-color: white;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .brand-logo i {
      color: var(--primary);
      font-size: 18px;
    }

    .brand-name {
      font-size: 1.25rem;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .invoice-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .invoice-subtitle {
      font-size: 0.875rem;
      opacity: 0.8;
    }

    .invoice-body {
      padding: 1.5rem;
    }

    .invoice-details {
      margin-bottom: 1.5rem;
    }

    .detail-item {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem 0;
      border-bottom: 1px solid var(--gray-200);
    }

    .detail-item:last-child {
      border-bottom: none;
    }

    .detail-label {
      color: var(--gray-600);
      font-size: 0.875rem;
      font-weight: 500;
    }

    .detail-value {
      font-weight: 500;
      color: var(--gray-800);
      font-size: 0.925rem;
    }

    .invoice-total {
      background-color: var(--gray-50);
      padding: 1rem 1.5rem;
      border-radius: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .total-label {
      font-size: 1rem;
      font-weight: 600;
      color: var(--gray-700);
    }

    .total-value {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--primary-dark);
    }

    .pay-button {
      display: block;
      width: 100%;
      padding: 1rem;
      background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      box-shadow: var(--shadow-md);
    }

    .pay-button:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }
    
    .pay-button i {
      font-size: 1.25rem;
    }

    .cancel-button {
      display: block;
      width: 100%;
      padding: 1rem;
      background: var(--danger);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      box-shadow: var(--shadow-md);
      text-decoration: none;
    }

    .cancel-button:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }
    
    .cancel-button i {
      font-size: 1.25rem;
    }

    .invoice-footer {
      padding: 1rem 1.5rem;
      border-top: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .secure-payment {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.75rem;
      color: var(--gray-600);
    }

    .secure-payment i {
      color: var(--success);
    }

    .payment-methods {
      display: flex;
      gap: 0.5rem;
    }

    .payment-method {
      width: 28px;
      height: 18px;
      opacity: 0.6;
      transition: opacity 0.2s;
    }

    .payment-method:hover {
      opacity: 1;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 640px) {
      .invoice-container {
        border-radius: 0;
        box-shadow: none;
      }

      body {
        padding: 0;
      }
    }
  </style>
</head>
<body>
  <div class="invoice-container">
    <div class="invoice-header">
      <div class="brand">
        <div class="brand-logo">
          <i class="fas fa-car"></i>
        </div>
        <span class="brand-name">CaRental</span>
      </div>
      <h1 class="invoice-title">Booking Summary</h1>
      <p class="invoice-subtitle">Please review your booking details</p>
    </div>
    
    <div class="invoice-body">
      <div class="invoice-details">
        <div class="detail-item">
          <span class="detail-label">Booking ID</span>
          <span class="detail-value">#<?php echo htmlspecialchars($emailData['BOOK_ID'] ?? 'N/A'); ?></span>
        </div>
        
        <div class="detail-item">
          <span class="detail-label">Email</span>
          <span class="detail-value"><?php echo htmlspecialchars($_SESSION['email'] ?? 'N/A'); ?></span>
        </div>
        
        <div class="detail-item">
          <span class="detail-label">Duration</span>
          <span class="detail-value"><?php echo htmlspecialchars($duration ?? '0'); ?> days</span>
        </div>
        
        <div class="detail-item">
          <span class="detail-label">Price per Day</span>
          <span class="detail-value">₹<?php echo htmlspecialchars($pricePerDay ?? '0'); ?>/-</span>
        </div>
        
        <div class="detail-item">
          <span class="detail-label">Booking Date</span>
          <span class="detail-value"><?php echo htmlspecialchars($emailData['BOOK_DATE']); ?></span>
        </div>
      </div>
      
      <div class="invoice-total">
        <span class="total-label">Total Amount</span>
        <span class="total-value">₹<?php echo htmlspecialchars($totalPrice); ?>/-</span>
      </div>
      
      <button class="pay-button" id="rzp-button1">
        <i class="fas fa-lock"></i>
        Pay Now
      </button>
      <a href="cancelbooking.php" class="cancel-button">
        Cancel Booking
      </a>
    </div>
    
  </div>
  <script>
              var order = <?php echo $orderJson; ?>;
                var options = {
                    "key": "rzp_test_UTVyzQ3LlANHs0",
                    "amount": "<?php echo $totalPrice * 100; ?>",
                    "currency": "INR",
                    "name": "CaRental",
                    "description": "Test Transaction",
                    "image": "https://example.com/your_logo",
                    "order_id": order.id, // Dynamically set order_id
                    "callback_url": "psucess.php",
                    "prefill": {
                        "name": "<?php echo htmlspecialchars($rows['FNAME'] . " " . $rows['LNAME']); ?>",
                        "email": "<?php echo htmlspecialchars($rows['EMAIL']); ?>",
                        "contact": "+91 <?php echo htmlspecialchars($rows['PHONE_NUMBER']); ?>"
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
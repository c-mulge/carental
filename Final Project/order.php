
<?php
require 'vendor/autoload.php'; // Autoload Razorpay SDK

use Razorpay\Api\Api;

$api = new Api('rzp_test_UTVyzQ3LlANHs0', 'E4zMgolgZHKBYh423JOgPH8k');

$order = $api->order->create([
    'receipt' => 'order_rcptid_11',
    'amount' => 29900, // Amount in paise (₹299)
    'currency' => 'INR',
    'payment_capture' => 1
]);

echo json_encode($order);
?>
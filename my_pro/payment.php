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
$duration = $emailData['DURATION'] ?? 0;
$pricePerDay = $emailData['PRICE'] ?? 0;
$totalPrice = $duration * $pricePerDay;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay'])) {
    $cardno = trim($_POST['cardno']);
    $exp = trim($_POST['exp']);
    $cvv = trim($_POST['cvv']);

    if (empty($cardno) || empty($exp) || empty($cvv)) {
        echo '<script>alert("Please fill in all fields.")</script>';
    } elseif (!preg_match('/^\d{16}$/', $cardno)) {
        echo '<script>alert("Invalid card number format.")</script>';
    } elseif (!preg_match('/^\d{2}\/\d{2}$/', $exp)) {
        echo '<script>alert("Invalid expiry date format. Use MM/YY.")</script>';
    } elseif (!preg_match('/^\d{3}$/', $cvv)) {
        echo '<script>alert("Invalid CVV format.")</script>';
    } else {
        $stmt = $con->prepare("INSERT INTO payment (BOOK_ID, PRICE) VALUES (?, ?)");
        $stmt->bind_param("id", $bid, $totalPrice);
        if ($stmt->execute()) {
            header("Location: psucess.php");
            exit();
        } else {
            echo '<script>alert("Payment failed. Please try again.")</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Payment Form</title>
  <link rel="stylesheet" href="style/pay.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h1>Enter Payment Information</h1>
      <form method="POST">
        <div class="card__row">
          <div class="card__col">
            <label for="cardNumber" class="card__label">Card Number</label>
            <input
              type="text"
              id="cardNumber"
              class="card__input"
              placeholder="xxxx-xxxx-xxxx-xxxx"
              name="cardno"
              maxlength="16"
              required
            />
          </div>
          <div class="card__col card__chip">
            <img src="images/chip.svg" alt="Card Chip">
          </div>
        </div>
        <div class="card__row">
          <div class="card__col">
            <label for="cardExpiry" class="card__label">Expiry Date</label>
            <input
              type="text"
              id="cardExpiry"
              class="card__input"
              placeholder="MM/YY"
              name="exp"
              maxlength="5"
              required
            />
          </div>
          <div class="card__col">
            <label for="cardCcv" class="card__label">CVV</label>
            <input
              type="password"
              id="cardCcv"
              class="card__input"
              placeholder="xxx"
              name="cvv"
              maxlength="3"
              required
            />
          </div>
        </div>
        <div class="card__buttons">
          <button type="submit" class="pay" name="pay">PAY NOW</button>
          <button class="btn">
            <a href="cancelbooking.php">CANCEL</a>
          </button>
        </div>
      </form>
    </div>

    <div class="bill">
      <h2>Bill Details</h2>
      <p>Booking ID: <span><?php echo htmlspecialchars($emailData['BOOK_ID'] ?? 'N/A'); ?></span></p>
      <p>Customer Email: <span><?php echo htmlspecialchars($_SESSION['email'] ?? 'N/A'); ?></span></p>
      <p>Duration: <span><?php echo htmlspecialchars($duration ?? '0'); ?> days</span></p>
      <p>Price per Day: <span>₹<?php echo htmlspecialchars($pricePerDay ?? '0'); ?>/-</span></p>
      <p>Total Price: <span>₹<?php echo htmlspecialchars($totalPrice ?? '0'); ?>/-</span></p>
      <p>Date: <span><?php echo htmlspecialchars($emailData['BOOK_DATE'] ?? 'N/A'); ?></span></p>
    </div>
  </div>
</body>
</html>
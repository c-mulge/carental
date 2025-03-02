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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Payment Form - CaRental</title>
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
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        max-width: 1000px;
        width: 100%;
        justify-content: center;
    }

    .card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        padding: 2rem;
        width: 100%;
        max-width: 500px;
        animation: fadeIn 0.6s ease-out;
    }

    .bill {
        background: white;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        padding: 2rem;
        width: 100%;
        max-width: 380px;
        animation: fadeIn 0.8s ease-out;
        background: linear-gradient(145deg, var(--dark), #2c3237);
        color: var(--light);
        position: relative;
        overflow: hidden;
    }

    .bill::before {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        background: var(--secondary);
        opacity: 0.1;
        border-radius: 50%;
        top: -75px;
        right: -75px;
    }

    .bill::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        background: var(--primary);
        opacity: 0.1;
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }

    h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
        text-align: center;
        background: linear-gradient(to right, var(--primary), var(--accent));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
    }

    h1::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--secondary);
        border-radius: 2px;
    }

    .bill h2 {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .bill h2::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--secondary);
        border-radius: 2px;
    }

    .bill p {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
    }

    .bill p:last-child {
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .bill span {
        font-weight: 600;
        color: var(--light);
    }

    .card__row {
        display: flex;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }

    .card__col {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .card__chip {
        flex: 0.3;
        align-self: center;
        justify-content: center;
    }

    .card__chip img {
        width: 50px;
        height: auto;
    }

    .card__label {
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--gray);
    }

    .card__input {
        padding: 0.9rem 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .card__input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .card__buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .card__buttons button {
        flex: 1;
        padding: 0.9rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .pay {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
    }

    .pay:hover {
        background: var(--primary-dark);
        box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
        transform: translateY(-3px);
    }

    .btn {
        background: transparent;
        border: 1px solid var(--gray);
        color: var(--gray);
    }

    .btn:hover {
        background: rgba(108, 117, 125, 0.1);
    }

    .btn a {
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
        height: 100%;
    }

    /* Animation Effects */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .bill {
            order: -1;
        }

        .card__buttons {
            flex-direction: column;
        }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h1>Enter Payment Information</h1>
      <form method="POST">
        <div class="card__row">
          <div class="card__col">
            <label for="cardNumber" class="card__label"><i class="fas fa-credit-card"></i> Card Number</label>
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
            <label for="cardExpiry" class="card__label"><i class="fas fa-calendar-alt"></i> Expiry Date</label>
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
            <label for="cardCcv" class="card__label"><i class="fas fa-lock"></i> CVV</label>
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
          <button type="submit" class="pay" name="pay"><i class="fas fa-shopping-cart"></i> PAY NOW</button>
          <button class="btn">
            <a href="cancelbooking.php"><i class="fas fa-times"></i> CANCEL</a>
          </button>
        </div>
      </form>
    </div>

    <div class="bill">
      <h2><i class="fas fa-file-invoice-dollar"></i> Bill Details</h2>
      <p>Booking ID: <span>#<?php echo htmlspecialchars($emailData['BOOK_ID'] ?? 'N/A'); ?></span></p>
      <p>Customer Email: <span><?php echo htmlspecialchars($_SESSION['email'] ?? 'N/A'); ?></span></p>
      <p>Duration: <span><?php echo htmlspecialchars($duration ?? '0'); ?> days</span></p>
      <p>Price per Day: <span>₹<?php echo htmlspecialchars($pricePerDay ?? '0'); ?>/-</span></p>
      <p>Total Price: <span>₹<?php echo htmlspecialchars($totalPrice ?? '0'); ?>/-</span></p>
      <p>Date: <span><?php echo htmlspecialchars($emailData['BOOK_DATE'] ?? 'N/A'); ?></span></p>
    </div>
  </div>

  <script>
    // Format card number to add spaces after every 4 digits
    document.getElementById('cardNumber').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length > 16) {
        value = value.slice(0, 16);
      }
      e.target.value = value;
    });

    // Format expiry date to add / after 2 digits
    document.getElementById('cardExpiry').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      
      if (value.length > 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
      }
      
      e.target.value = value;
    });

    // Only allow numbers in CVV field
    document.getElementById('cardCcv').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/\D/g, '');
    });
  </script>
</body>
</html>
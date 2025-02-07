<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

require_once('connection.php');

// Fetch user details
$email = $_SESSION['email'];
$query = "SELECT name FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $full_name);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Fetch financial data (dummy values for now)
$total_balance = "$12,456.78";
$monthly_spending = "$2,340.25";
$savings_goal = "$5,000 / $10,000";

// Fetch recent transactions from the database (example query)
$transactions = [];
$query = "SELECT date, description, category_id, amount FROM transactions WHERE user_id = ? ORDER BY date DESC LIMIT 5";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($result)) {
    $transactions[] = $row;
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BudgetFlow - User Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="gradient-bg">
    <div class="gradient-animation"></div>
  </div>

  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <a class="logo-link" href="index.html">
          Budget<span>Flow</span>
        </a>
      </div>
      <div class="nav-menu">
        <li><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
        <li><a href="#transactions" class="nav-link">Transactions</a></li>
        <li><a href="#budgets" class="nav-link">Budgets</a></li>
        <li><a href="#insights" class="nav-link">Insights</a></li>
        <li><a href="#profile" class="nav-link">Profile</a></li>
        <li><a href="logout.php" class="nav-link login-btn">Logout</a></li>
      </div>
    </nav>
  </header>

  <main class="dashboard">
    <section class="dashboard-overview">
      <div class="dashboard-header">
        <h1>Welcome, <?php echo htmlspecialchars($full_name); ?></h1>
        <p>Here's an overview of your financial health</p>
      </div>

      <div class="financial-summary">
        <div class="summary-card">
          <div class="summary-icon">
            <i class="fas fa-wallet"></i>
          </div>
          <div class="summary-content">
            <h3>Total Balance</h3>
            <span class="summary-amount"><?php echo $total_balance; ?></span>
          </div>
        </div>
        <div class="summary-card">
          <div class="summary-icon">
            <i class="fas fa-chart-pie"></i>
          </div>
          <div class="summary-content">
            <h3>Monthly Spending</h3>
            <span class="summary-amount"><?php echo $monthly_spending; ?></span>
          </div>
        </div>
        <div class="summary-card">
          <div class="summary-icon">
            <i class="fas fa-piggy-bank"></i>
          </div>
          <div class="summary-content">
            <h3>Savings Goal</h3>
            <span class="summary-amount"><?php echo $savings_goal; ?></span>
          </div>
        </div>
      </div>

      <div class="dashboard-sections">
        <div class="recent-transactions">
          <h2>Recent Transactions</h2>
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($transactions as $transaction) : ?>
              <tr>
                <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                <td><?php echo htmlspecialchars($transaction['category']); ?></td>
                <td class="<?php echo ($transaction['amount'] < 0) ? 'expense' : 'income'; ?>">
                  <?php echo ($transaction['amount'] < 0) ? '-' : '+'; ?>$<?php echo number_format(abs($transaction['amount']), 2); ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="spending-insights">
          <h2>Spending Insights</h2>
          <div class="chart-placeholder">
            <i class="fas fa-chart-bar"></i>
            <p>Detailed spending chart coming soon</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
        <div class="footer-content">
          <div class="footer-brand">
            <div class="logo">Budget<span>Flow</span></div>
            <p>Smart financial management for everyone.</p>
            <div class="social-links">
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
          <div class="footer-links">
            <div class="footer-section">
              <h4>Product</h4>
              <ul>
                <li><a href="#">Features</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Integrations</a></li>
                <li><a href="#">Updates</a></li>
              </ul>
            </div>
            <div class="footer-section">
              <h4>Company</h4>
              <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
            <div class="footer-section">
              <h4>Resources</h4>
              <ul>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">API Docs</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Status</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2024 BudgetFlow. All rights reserved.</p>
          <div class="footer-legal">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Cookie Policy</a>
          </div>
        </div>
      </footer>

  <style>
    /* Dashboard-specific styles */
    .dashboard {
      max-width: 1200px;
      margin: 8rem auto 4rem;
      padding: 0 2rem;
    }

    .dashboard-header h1 {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      background: linear-gradient(to right, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .financial-summary {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin: 2rem 0;
    }

    .summary-card {
      background: white;
      border-radius: 1rem;
      padding: 1.5rem;
      display: flex;
      align-items: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .summary-card:hover {
      transform: translateY(-5px);
    }

    .summary-icon {
      background: var(--background-alt);
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
    }

    .summary-icon i {
      color: var(--primary);
      font-size: 1.5rem;
    }

    @media (max-width: 768px) {
      .financial-summary,
      .dashboard-sections {
        grid-template-columns: 1fr;
      }
    }
  </style>
</body>
</html>

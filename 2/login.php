<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Fetch user from database
    $stmt = $conn->prepare("SELECT user_id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            echo "logged in";
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with this email!";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BudgetFlow</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header class="header">
        <nav class="navbar">
          <div class="logo">
            <a class="logo-link" href="index.html">
                Budget<span>Flow</span>
              </a>
          </div>
          <div class="nav-toggle" id="navToggle">
            <span></span><span></span><span></span>
          </div>
          <ul class="nav-menu" id="navMenu">
            <li><a href="index.html" class="nav-link">Home</a></li>
            <li><a href="features.html" class="nav-link">Features</a></li>
            <li><a href="pricing.html" class="nav-link">Pricing</a></li>
            <li><a href="#testimonials" class="nav-link">Testimonials</a></li>
            <li><a href="contact.html" class="nav-link">Contact</a></li>
            <li><a href="login.html" class="nav-link login-btn">Login</a></li>
            <li><a href="signup.html" class="nav-link signup-btn">Get Started</a></li>
          </ul>
        </nav>
      </header>

    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-box">
                <h1>Welcome Back</h1>
                <p>Log in to your BudgetFlow account</p>
                
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>

                <form class="auth-form" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="pass" required>
                    </div>
                    <button type="submit" class="auth-submit">Log In</button>
                </form>

                <div class="auth-alternate">
                    <span>Don't have an account?</span>
                    <a href="signup.php">Sign up</a>
                </div>
            </div>
        </div>
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
      <script src="script.js"></script>
</body>
</html>

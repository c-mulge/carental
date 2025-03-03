<!-- signup.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - BudgetFlow</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php
session_start();
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST['fname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);
    $confirm_password = trim($_POST['cpass']);

    // Validation checks
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo '<script>alert("All fields are required!"); window.history.back();</script>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format!"); window.history.back();</script>';
        exit();
    }

    if ($password !== $confirm_password) {
        echo '<script>alert("Passwords do not match!"); window.history.back();</script>';
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $check_email_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo '<script>alert("Email already registered!"); window.history.back();</script>';
        exit();
    }
    mysqli_stmt_close($stmt);

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // More secure

    // Insert user into database
    $insert_query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        // Store user session
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;

        // Redirect to dashboard
        echo '<script>alert("Signup successful! Redirecting to Dashboard."); window.location.href = "dashboard.php";</script>';
        exit();
    } else {
        echo '<script>alert("Signup failed. Please try again."); window.history.back();</script>';
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

    <!-- Include the same header as index.html -->
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
                <h1>Create Your Account</h1>
                <p>Start your journey to better financial management</p>
                
                <form class="auth-form" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="cpass" required>
                    </div>
                    <div class="form-terms">
                        <label>
                            <input type="checkbox" required>
                            <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
                        </label>
                    </div>
                    <button type="submit" class="auth-submit">Create Account</button>
                </form>

                <div class="auth-alternate">
                    <span>Already have an account?</span>
                    <a href="login.html">Log in</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Include the same footer as index.html -->
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
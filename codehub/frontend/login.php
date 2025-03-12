<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CodeHub</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <section class="login-section">
        <div class="login-container">
            <div class="form-header">
                <a href="index.php" class="logo" style="color: var(--primary-color); justify-content: center;">
                    <i class="fas fa-code"></i> CodeHub
                </a>
                <h1>Welcome Back</h1>
                <p>Login to access your code snippets</p>
            </div>

            <?php if (!empty($login_err)): ?>
                <div class="alert-danger"><?php echo $login_err; ?></div>
            <?php endif; ?>

            <form action="backend/login.php" method="post">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your Username or Email" required>
                    <?php if (!empty($username_err)): ?>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                    <?php if (!empty($password_err)): ?>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                
                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                </div>
                
                <!-- <div class="social-login">
                    <p>Or login with</p>
                    <div class="social-buttons">
                        <a href="#" class="social-button github">
                            <i class="fab fa-github"></i> GitHub
                        </a>
                        <a href="#" class="social-button google">
                            <i class="fab fa-google"></i> Google
                        </a>
                    </div>
                </div> -->
                
                <div class="form-footer">
                    <p>Don't have an account? <a href="register.php">Sign up here</a></p>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
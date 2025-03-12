<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CodeHub</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <section class="register-section">
        <div class="register-container">
            <div class="form-header">
                <a href="index.php" class="logo" style="color: var(--primary-color); justify-content: center;">
                    <i class="fas fa-code"></i> CodeHub
                </a>
                <h1>Create Your Account</h1>
                <p>Start storing and sharing your code snippets</p>
            </div>

            <?php if (!empty($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <form action="backend/login.php" method="post">
                <div class="form-group">
                    <label for="fname">First name</label>
                    <input type="text" name="fname" id="username" class="form-control" placeholder="Enter your First Name" required>
                    <?php if (!empty($username_err)): ?>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="fname">Last name</label>
                    <input type="text" name="lname" id="username" class="form-control" placeholder="Enter your Last Name" required>
                    <?php if (!empty($username_err)): ?>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your User Name" required>
                    <?php if (!empty($username_err)): ?>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
                    <?php if (!empty($email_err)): ?>
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                    <?php if (!empty($password_err)): ?>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm your Password" required>
                    <?php if (!empty($confirm_password_err)): ?>
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <!-- <div class="plan-selection">
                    <h3>Choose Your Plan</h3>
                    <div class="plan-options">
                        <div class="plan-option <?php echo $selected_plan === 'free' ? 'selected' : ''; ?>" data-plan="free">
                            <div class="plan-name">Free <span class="checkmark"><i class="fas fa-check"></i></span></div>
                            <div class="plan-price">$0/month</div>
                        </div>
                        <div class="plan-option <?php echo $selected_plan === 'pro' ? 'selected' : ''; ?>" data-plan="pro">
                            <div class="plan-name">Pro <span class="checkmark"><i class="fas fa-check"></i></span></div>
                            <div class="plan-price">$9.99/month</div>
                        </div>
                        <div class="plan-option <?php echo $selected_plan === 'team' ? 'selected' : ''; ?>" data-plan="team">
                            <div class="plan-name">Team <span class="checkmark"><i class="fas fa-check"></i></span></div>
                            <div class="plan-price">$29.99/month</div>
                        </div>
                    </div>
                    <input type="hidden" name="plan" id="plan" value="<?php echo $selected_plan; ?>">
                </div> -->
                
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Create Account">
                </div>
                
                <div class="form-footer">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
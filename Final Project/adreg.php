<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - CaRental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="adreg.css">
</head>
<body>
    <div class="container">
        <div class="register">
            <div class="register-info">
                <h2>Admin Portal</h2>
                <p>Register to access the administrative dashboard and manage CaRental services.</p>
            </div>
            <div class="register-form">
                <h2>Admin Registration</h2>
                <form method="POST" action="admin_register.php">
                    <input type="text" name="admin_id" placeholder="Admin ID" required>
                    <input type="text" name="admin_name" placeholder="Full Name" required>
                    <input type="email" name="admin_email" placeholder="Email Address" required>
                    <input type="password" id="admin_password" name="admin_password" placeholder="Password" required>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <p id="password-message"></p>
                    <button type="submit" name="register">Register</button>
                </form>
                <p class="link">Already have an account?
                    <a href="adminlogin.php">Log In</a> here
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const password = document.getElementById("admin_password");
            const confirmPassword = document.getElementById("confirm_password");
            const form = document.querySelector("form");
            const message = document.getElementById("password-message");

            confirmPassword.addEventListener("input", () => {
                if (password.value === confirmPassword.value) {
                    confirmPassword.style.borderColor = "green";
                    message.textContent = "Passwords match!";
                    message.style.color = "green";
                } else {
                    confirmPassword.style.borderColor = "red";
                    message.textContent = "Passwords do not match.";
                    message.style.color = "red";
                }
            });

            form.addEventListener("submit", (e) => {
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert("Passwords do not match!");
                    confirmPassword.focus();
                }
            });
        });
    </script>
</body>
</html>
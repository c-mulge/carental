<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - CaRental</title>
    <link rel="stylesheet" href="style/adregister.css">
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
</head>

<body>
    <div class="container">
        <h2>Admin Registration - CaRental</h2>
        <form method="POST" action="admin_register.php">
            <input type="text" name="admin_id" placeholder="Admin ID" required>
            <input type="text" name="admin_name" placeholder="Full Name" required>
            <input type="email" name="admin_email" placeholder="Email Address" required>
            <input type="password" id="admin_password" name="admin_password" placeholder="Password" required>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <p id="password-message" style="font-size: 14px; margin: 5px 0;"></p>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>

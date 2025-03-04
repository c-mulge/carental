<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - CaRental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            background: linear-gradient(135deg, var(--primary), var(--accent));
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 800px;
            padding: 2rem;
        }

        .register {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .register:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .register-info {
            background: var(--primary);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }

        .register-info h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .register-info p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .register-form {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-form h2 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .register-form input {
            width: 100%;
            padding: 0.6rem;
            margin-bottom: 1rem;
            border: 1px solid var(--gray);
            border-radius: 8px;
            font-size: 0.85rem;
            transition: border-color 0.3s ease;
        }

        .register-form input:focus {
            outline: none;
            border-color: var(--primary);
        }

        #password-message {
            font-size: 0.75rem;
            margin: -0.5rem 0 0.5rem;
            text-align: center;
        }

        .register-form button {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            cursor: pointer;
        }

        .register-form button:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .register {
                grid-template-columns: 1fr;
            }

            .register-info {
                display: none;
            }
        }
    </style>
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
<?php
    require_once('connection.php');

    if (isset($_POST['regs'])) {
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $lic = mysqli_real_escape_string($con, $_POST['lic']);
        $ph = mysqli_real_escape_string($con, $_POST['ph']);
        $pass = mysqli_real_escape_string($con, $_POST['pass']);
        $cpass = mysqli_real_escape_string($con, $_POST['cpass']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $Pass = md5($pass);

      
        $checkEmailQuery = "SELECT * FROM users WHERE EMAIL = '$email'";
        $emailResult = mysqli_query($con, $checkEmailQuery);

        if (mysqli_num_rows($emailResult) > 0) {
           
            echo '<script>alert("Registration successful! Please login.")</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } else {

            if ($pass === $cpass) {
                $sql = "INSERT INTO users (FNAME, LNAME, EMAIL, LIC_NUM, PHONE_NUMBER, PASSWORD, GENDER)
                    VALUES ('$fname', '$lname', '$email', '$lic', '$ph', '$Pass', '$gender')";

                if (mysqli_query($con, $sql)) {
                    echo '<script>alert("Email already exists! Please login.")</script>';
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    echo '<script>alert("Error: Unable to register. Please try again.")</script>';
                }
            } else {
                echo '<script>alert("Passwords do not match.")</script>';
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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

        .main {
            width: 100%;
            max-width: 900px;
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
        }

        .register-form h2 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .register-form label {
            display: block;
            margin-top: 0.5rem;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.8rem;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="tel"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 0.6rem;
            margin-top: 0.3rem;
            border: 1px solid var(--gray);
            border-radius: 8px;
            font-size: 0.85rem;
            transition: border-color 0.3s ease;
        }

        .register-form input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .gender-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .btnn {
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
            margin-top: 1rem;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            cursor: pointer;
        }

        .btnn:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        .link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.8rem;
            color: var(--gray);
        }

        .link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
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
    <div class="main">
        <div class="register">
            <div class="register-info">
                <h2>Welcome</h2>
                <p>Register to access our car rental services and start your journey today!</p>
            </div>
            <div class="register-form">
                <h2>Create Account</h2>
                <form id="register" action="register.php" method="POST">
                    <div class="form-row">
                        <div>
                            <label>First Name:</label>
                            <input type="text" name="fname" placeholder="Enter Your First Name" required>
                        </div>
                        <div>
                            <label>Last Name:</label>
                            <input type="text" name="lname" placeholder="Enter Your Last Name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label>Email:</label>
                            <input type="email" name="email" placeholder="Enter Valid Email"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="e.g., example@domain.com" required>
                        </div>
                        <div>
                            <label>License Number:</label>
                            <input type="text" name="lic" placeholder="Enter Your License Number" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label>Phone Number:</label>
                            <input type="tel" name="ph" maxlength="10" onkeypress="return onlyNumberKey(event)"
                                placeholder="Enter Your Phone Number" required>
                        </div>
                        <div>
                            <label>Gender:</label>
                            <div class="gender-options">
                                <label for="male" class="gender-label">
                                    <input type="radio" id="male" name="gender" value="male" required>
                                    Male
                                </label>
                                <label for="female" class="gender-label">
                                    <input type="radio" id="female" name="gender" value="female">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label>Password:</label>
                            <input type="password" name="pass" id="psw" maxlength="12" placeholder="Enter Password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one number, uppercase and lowercase letter, and 8+ characters"
                                required>
                        </div>
                        <div>
                            <label>Confirm Password:</label>
                            <input type="password" name="cpass" placeholder="Re-enter Password" required>
                        </div>
                    </div>

                    <button type="submit" class="btnn" name="regs">Register</button>
                    <p class="link">Already have an account?
                        <a href="login.php">Log In</a> here
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        function onlyNumberKey(evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                return false;
            }
            return true;
        }

        document.getElementById("register").onsubmit = function (event) {
            const pass = document.querySelector("input[name='pass']").value;
            const cpass = document.querySelector("input[name='cpass']").value;
            if (pass !== cpass) {
                alert("Passwords do not match!");
                event.preventDefault();
            }
        };
    </script>
</body>
</html>
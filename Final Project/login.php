<?php
    session_start();
    require_once('connection.php');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if (empty($email) || empty($pass)) {
            echo '<script>alert("Please fill in all fields")</script>';
        } else {
            $query = "SELECT * FROM users WHERE EMAIL='$email'";
            $res = mysqli_query($con, $query);
            if ($row = mysqli_fetch_assoc($res)) {
                $db_password = $row['PASSWORD'];
                if (md5($pass) == $db_password) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['email'] = $email;
                    header("Location: cardetails.php");
                    exit();
                } else {
                    echo '<script>alert("Incorrect password. Please try again.")</script>';
                }
            } else {
                echo '<script>alert("Email not found. Please check and try again.")</script>';
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
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
        }

        .hai {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            padding: 2rem;
        }

        .content {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: fadeIn 0.6s ease-out;
        }

        .content:hover {
            transform: translateY(-12px);
            box-shadow: var(--hover-shadow);
        }

        h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 2rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
        }

        h2::after {
            content: "";
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            margin-bottom: 1.5rem;
        }

        input[type="email"], 
        input[type="password"] {
            padding: 1rem;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus, 
        input[type="password"]:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .btnn {
            padding: 0.9rem;
            background: var(--primary);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            border: none;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        .btnn:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        .link {
            color: var(--gray);
            margin-top: 1.5rem;
            font-size: 0.95rem;
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

        .forgot-password {
            font-size: 0.9rem;
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
            text-align: left;
            display: block;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .hai {
                padding: 1rem;
            }
            
            .content {
                padding: 1.5rem;
            }
            
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    

    <div class="hai">
        <div class="content">
            <h2>Login Here</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="pass" placeholder="Enter Password" required>
                <div style="display: flex; justify-content: flex-start; width: 100%;">
                    <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                </div>
                <input class="btnn" type="submit" value="Login" name="login">
            </form>
            <p class="link">Don't have an account?<br>
                <a href="register.php">Sign up</a> here
            </p>
        </div>
    </div>
</body>

</html>
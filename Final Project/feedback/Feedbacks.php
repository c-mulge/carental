<?php
require_once('../connection.php');
session_start();
$email = $_SESSION['email'];

if(isset($_POST['submit'])){
	$comment=mysqli_real_escape_string($con,$_POST['comment']);
	$sql="insert into  feedback (EMAIL,COMMENT) values('$email','$comment')";
	$result = mysqli_query($con,$sql);
	echo '<script>alert("Feedback Sent Successfully!!THANK YOU!!")</script>';
	header("Location: ../cardetails.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Home</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
        }

        /* Modern Navigation */
        .top-nav {
            background: var(--dark);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .logo {
            color: var(--light);
            font-size: 1.7rem;
            font-weight: 800;
            text-decoration: none;
            position: relative;
        }

        .logo::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 50%;
            height: 3px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .nav-links {
    display: flex;
    align-items: center;
    list-style: none;
}

.nav-links li {
    margin-left: 2rem;
    position: relative;
}

.nav-links a {
    color: var(--light);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    padding: 0.5rem 0;
}

.nav-links a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: var(--secondary);
    transition: width 0.3s ease;
}

.nav-links a:hover,
.nav-links a.active {
    color: var(--secondary);
}

.nav-links a:hover::after,
.nav-links a.active::after {
    width: 100%;
}


        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        /* Page Header */
        .overview {
            text-align: center;
            padding: 4rem 1rem 2rem;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            position: relative;
        }

        .overview::after {
            content: "";
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        /* Feedback Form Card */
        .feedback-form {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            padding: 2rem;
            margin-top: 2rem;
            animation: fadeIn 0.6s ease-out;
        }

        .feedback-form:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .feedback-form h4 {
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
            outline: none;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 0.9rem;
            background: var(--primary);
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            cursor: pointer;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        .back-btn {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.7rem 1.5rem;
            background: var(--gray);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: var(--dark);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .overview {
                font-size: 2rem;
                padding: 3rem 1rem 1.5rem;
            }
            
            .feedback-form {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="top-nav">
        <a href="../index.php" class="logo">CaRental</a>
        <ul class="nav-links">
            <li><a href="../cardetails.php">Home</a></li>
            <li><a href="../co.html">Contact</a></li>
            <li><a href="../about.html">About Us</a></li>
            <li><a href="Feedbacks.php" class="active">Feedback</a></li>
        </ul>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="container">
        <h1 class="overview">Your Feedback</h1>

        <div class="feedback-form">
            <form method="POST">
                <div class="form-group">
                    <h4>Name</h4>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                </div>
                
                <div class="form-group">
                    <h4>Email</h4>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required value="<?php echo $email; ?>" readonly>
                </div>
                
                <div class="form-group">
                    <h4>Comments</h4>
                    <textarea name="comment" id="comment" class="form-control" rows="6" placeholder="Tell us about your experience..." required></textarea>
                </div>
                
                <button type="submit" name="submit" class="btn-submit">Submit Feedback</button>
            </form>
            
            <div style="text-align: center;">
                <a href="../cardetails.php" class="back-btn">Back to Cars</a>
            </div>
        </div>
    </div>
</body>

</html>
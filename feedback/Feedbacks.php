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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding: 50px 0;
            margin: 0;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }


        .feedback-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .feedback-header h2 {
            font-size: 3rem;
            color: #333;
        }

        .feedback-header .highlight {
            color: #3b82f6;
            font-weight: bold;
        }


        .feedback-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .feedback-form h4 {
            margin-bottom: 15px;
            font-size: 1.2rem;
            color: #333;
        }

        .feedback-form .form-control {
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 12px;
            font-size: 1rem;
        }

        .feedback-form .form-control:focus {
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .feedback-form .btn-submit {
            width: 100%;
            background-color: #3b82f6;
            border: none;
            padding: 14px;
            font-size: 18px;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .feedback-form .btn-submit:hover {
            background-color: #ff5400;
        }


        .back-btn {
            background-color: #3b82f6;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #ff5400;
        }

        @media (max-width: 768px) {
            .feedback-form {
                padding: 20px;
            }

            .feedback-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="feedback-header">
            <h2><span class="highlight">Feedback</span></h2>
        </div>

        <div class="feedback-form">
            <form method="POST">
                <div class="form-group">
                    <label for="name">
                        <h4>Name:</h4>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label for="email">
                        <h4>Email:</h4>
                    </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <label for="comment">
                        <h4>Comments:</h4>
                    </label>
                    <textarea name="comment" id="comment" class="form-control" rows="6" placeholder="Your Feedback" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>

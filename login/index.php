<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<button onclick="goBack()" class="back-btn">← Back to Home</button>
    <?php
require_once('connection.php');
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        
        
        if(empty($email)|| empty($pass))
        {
            echo '<script>alert("please fill the blanks")</script>';
        }
        else{
            $query="select *from users where EMAIL='$email'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['PASSWORD'];
                if(md5($pass)  == $db_password)
                {
                    header("location: cardetails.php");
                    session_start();
                    $_SESSION['email'] = $email;
                    
                }
                else{
                    echo '<script>alert("Enter a proper password")</script>';
                }
            }
            else{
                echo '<script>alert("enter a proper email")</script>';
            }
        }
    }







?>
    <div class="cen">
        <h1 class="heading" style="text-align: center;">Login Pag</h1>
        <form class="form" method="POST">
            <input type="email" name="email" class="input-style" placeholder="Enter Email"><br>
            <input type="password" name="pass" class="input-style" placeholder="Password"><br>
            <div>
                <label><input type="checkbox"> Remember Me</label>
                <p><a href="#" class="forgot-password">Forgot Password?</a></p>
            </div>
            <input type="button" name="login" class="btn" value="Log In">
        </form>
        <div class="loader" id="loader"></div>
        <div class="notification" id="notification"></div>

    </div>
    <script src="ind.js"></script>
</body>

</html>
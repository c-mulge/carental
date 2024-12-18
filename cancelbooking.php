<?php include('user_auth.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <link rel="stylesheet" href="style/cbook.css">
</head>
<body>
<?php
	
    require_once('connection.php');
    $bid = $_SESSION['bid'];
    if(isset($_POST['cancelnow'])){
        $del = mysqli_query($con,"delete from booking where BOOK_ID = '$bid' order by BOOK_ID DESC limit 1");
        echo "<script>window.location.href='cardetails.php';</script>";
    }
?>
    <form class="form" method="POST">
        <h1>ARE YOU SURE YOU WANT TO CANCEL YOUR BOOKING?</h1>
        <div class="btn-group">
            <input type="submit" class="btn cancel" value="Cancel Now" name="cancelnow">
            <button class="btn payment"><a href="payment.php">Go to Payment</a></button>
        </div>
    </form>
</body>

</html>

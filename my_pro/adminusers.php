<?php include('authentication.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <link rel="stylesheet" href="style/advehicel.css">
    <style>
        body{
            overflow-y: scroll;
        }

        body::-webkit-scrollbar{
            display: none;
        }

    </style>
</head>

<body>
    <?php
    require_once('connection.php');
    $query = "SELECT * FROM users";
    $queryy = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryy);
    ?>

    <div class="hai">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">CaRental</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="admindash.php"> Dashboard</a></li>
                    <li><a href="adminvehicle.php"> Vehicle Management</a></li>
                    <li><a href="feed.php">Feedback</a></li>
                    <li><a href="adminbook.php">Booking Request</a></li>
                    <li><a href="index.php">Logout</a></button></li>
                </ul>
            </div>
        </div>
    </div>

    <h1 class="header">USERS</h1>
    <div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>LICENSE NUMBER</th>
                    <th>PHONE NUMBER</th>
                    <th>GENDER</th>
                    <th>DELETE USERS</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($res = mysqli_fetch_array($queryy)) { ?>
                    <tr class="active-row">
                        <td><?php echo $res['FNAME'] . " " . $res['LNAME']; ?></td>
                        <td><?php echo $res['EMAIL']; ?></td>
                        <td><?php echo $res['LIC_NUM']; ?></td>
                        <td><?php echo $res['PHONE_NUMBER']; ?></td>
                        <td><?php echo $res['GENDER']; ?></td>
                        <td><button class="but"><a href="deleteuser.php?id=<?php echo $res['EMAIL']; ?>">DELETE
                                    USER</a></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>
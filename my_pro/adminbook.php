<?php include('authentication.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <link href="style/adbook.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once('connection.php');
    $query = "SELECT * FROM booking ORDER BY BOOK_ID DESC";
    $queryy = mysqli_query($con, $query);
    ?>

    <div class="dashboard-container">
        <div class="navbar">
            <div class="logo">
                <h2>CaRental</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="admindash.php">Dashboard</a></li>
                    <li><a href="adminvehicle.php">Vehicle Management</a></li>
                    <li><a href="adminusers.php">Users</a></li>
                    <li><a href="feed.php">Feedback</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <main>
            <h1 class="header">Bookings</h1>
            <div class="table-container">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Vehicle Serial Number</th>
                            <th>Email</th>
                            <th>Book Place</th>
                            <th>Book Date</th>
                            <th>Duration</th>
                            <th>Phone Number</th>
                            <th>Destination</th>
                            <th>Return Date</th>
                            <th>Booking Status</th>
                            <th>Approve</th>
                            <th>Car Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($queryy)) {
                        ?>
                            <tr>
                                <td><?php echo $res['CAR_ID']; ?></td>
                                <td><?php echo $res['EMAIL']; ?></td>
                                <td><?php echo $res['BOOK_PLACE']; ?></td>
                                <td><?php echo $res['BOOK_DATE']; ?></td>
                                <td><?php echo $res['DURATION']; ?></td>
                                <td><?php echo $res['PHONE_NUMBER']; ?></td>
                                <td><?php echo $res['DESTINATION']; ?></td>
                                <td><?php echo $res['RETURN_DATE']; ?></td>
                                <td><?php echo $res['BOOK_STATUS']; ?></td>
                                <td>
                                    <button class="approve-btn"><a href="approve.php?id=<?php echo $res['BOOK_ID']; ?>">Approve</a></button>
                                </td>
                                <td>
                                    <button class="return-btn"><a href="adminreturn.php?id=<?php echo $res['CAR_ID']; ?>&bookid=<?php echo $res['BOOK_ID']; ?>">Returned</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
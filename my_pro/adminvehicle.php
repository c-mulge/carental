<?php include('authentication.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - Car Details</title>
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
    $query = "SELECT * FROM cars";
    $queryy = mysqli_query($con, $query);
    ?>

    <div class="navbar">
        <div class="navbar-brand">
            <h2 class="logo">CaRental</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="admindash.php">Dashboard</a></li>
                <li><a href="adminusers.php">Users</a></li>
                <li><a href="feed.php">Feedback</a></li>
                <li><a href="adminbook.php">Booking Request</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <header>
        <h1 class="header">Car Details</h1>
        <button class="add">
            <a href="addcar.php">+ Add Cars</a>
        </button>
    </header>

    <div class="table-container">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Car Name</th>
                    <th>Fuel Type</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = mysqli_fetch_array($queryy)) {
                ?>
                    <tr>
                        <!-- <?php echo $serial++; ?> -->
                        <td><?php echo $res['CAR_ID']; ?></td>
                        <td><?php echo $res['CAR_NAME']; ?></td>
                        <td><?php echo $res['FUEL_TYPE']; ?></td>
                        <td><?php echo $res['CAPACITY']; ?></td>
                        <td><?php echo $res['PRICE']; ?></td>
                        <td><?php echo ($res['AVAILABLE'] == 'Y') ? 'Yes' : 'No'; ?></td>
                        <td>
                            <button class="but">
                                <a href="deletecar.php?id=<?php echo $res['CAR_ID']; ?>">Delete</a>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>

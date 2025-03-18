<?php include('authentication.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <link href="adbook.css" rel="stylesheet">
    <style>
        .reject-btn{
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }
        .reject-btn {
            background: #ef4444;;
        }
        .reject-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
        }
        .reject-btn a{
            color: white;
            text-decoration: none;
            display: block;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .book-button {
            width: 48%; /* Changed from 50% to allow for gap */
            display: inline-block;
        }
    </style>
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
                    <li><a href="adminbook.php" class="active">Booking Request</a></li>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($queryy)) {
                            $book_id = $res['BOOK_ID'];
                            $email = $res['EMAIL'];
                            $status = $res['BOOK_STATUS'];
                        ?>
                            <tr>
                                <td><?php echo $res['CAR_ID']; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $res['BOOK_PLACE']; ?></td>
                                <td><?php echo $res['BOOK_DATE']; ?></td>
                                <td><?php echo $res['DURATION']; ?></td>
                                <td><?php echo $res['PHONE_NUMBER']; ?></td>
                                <td><?php echo $res['DESTINATION']; ?></td>
                                <td><?php echo $res['RETURN_DATE']; ?></td>
                                <td><?php echo $status; ?></td>
                                <td>
                                    <?php if ($status == 'UNDER PROCESSING') { ?>
                                        <div class="button-container">
                                            <button class="approve-btn">
                                                <a href="approve.php?id=<?php echo $book_id; ?>&email=<?php echo $email; ?>" class="book-button">Approve</a>
                                            </button>
                                            <button class="reject-btn">
                                                <a href="reject.php?id=<?php echo $book_id; ?>&email=<?php echo $email; ?>" class="book-button">Reject</a>
                                            </button>
                                        </div>
                                    <?php } elseif ($status == 'Approved') { ?>
                                        <button class="return-btn">
                                            <a href="adminreturn.php?id=<?php echo $res['CAR_ID']; ?>&bookid=<?php echo $book_id; ?>">Returned</a>
                                        </button>
                                    <?php } else { ?>
                                        <button class="returned-btn" disabled>Returned</button>
                                    <?php } ?>
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

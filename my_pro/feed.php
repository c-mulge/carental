<?php include('authentication.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Feedback</title>
    <link rel="stylesheet" href="style/adfeed.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <h2>Admin<span> Panel</span></h2>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="admindash.php">Dashboard</a></li>
                    <li><a href="adminvehicle.php">Vehicle Management</a></li>
                    <li><a href="adminusers.php">Users</a></li>
                    <li><a href="adminbook.php">Booking Requests</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="index.php">Logout</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-nav">
                <div class="user-profile">
                    <img src="images/admin-avatar.jpg" alt="Admin Profile">
                    <span>Admin</span>
                </div>
            </header>
            <section class="data-section">
                <h2>Feedback</h2>
                <br>
                <?php
                require_once('connection.php');
                $query = "SELECT * FROM feedback";
                $queryy = mysqli_query($con, $query);
                $num = mysqli_num_rows($queryy);
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Feedback ID</th>
                            <th>Email</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $feedback_id = 1;

                        while ($res = mysqli_fetch_array($queryy)) {
                        ?>
                            <tr class="active-row">
                                <td><?php echo $feedback_id++; ?></td>
                                <td><?php echo $res['EMAIL']; ?></td>
                                <td><?php echo $res['COMMENT']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>

</html>

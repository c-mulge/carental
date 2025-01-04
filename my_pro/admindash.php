<?php include('authentication.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style/addash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <h2>Admin<span>Panel</span></h2>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="admindash.php"> Dashboard</a></li>
                    <li><a href="adminvehicle.php"> Vehicle Management</a></li>
                    <li><a href="adminusers.php"> Users</a></li>
                    <li><a href="feed.php"> Feedback</a></li>
                    <li><a href="adminbook.php"> Booking Requests</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php"> Logout</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-nav">
                <div class="user-profile">
                    <img src="images/admin-avatar.jpg" alt="Admin Profile Picture">
                    <span>Admin</span>
                </div>
            </header>

            <section class="overview">
                <h1>Dashboard</h1>
                <div class="stats-container">
                    <div class="stat">
                        <h3>Total Users</h3>
                        <p id="total-users">...</p>
                    </div>
                    <div class="stat">
                        <h3>Active Vehicles</h3>
                        <p id="active-vehicles">...</p>
                    </div>
                    <div class="stat">
                        <h3>Feedback Received</h3>
                        <p id="feedback-received">...</p>
                    </div>
                    <div class="stat">
                        <h3>Pending Bookings</h3>
                        <p id="pending-bookings">...</p>
                    </div>
                </div>
            </section>

            <section class="details">
                <h2>Recent Activities</h2>
                <table id="recent-activities">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>User</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">...</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
        function fetchDashboardData() {
            $.ajax({
                url: 'fetch_dashboard_data.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#total-users').text(data.totalUsers);
                    $('#active-vehicles').text(data.activeVehicles);
                    $('#feedback-received').text(data.feedbackCount);
                    $('#pending-bookings').text(data.pendingBookings);
                    const activitiesTable = $('#recent-activities tbody');
                    activitiesTable.empty();
                    if (data.recentActivities.length > 0) {
                        data.recentActivities.forEach(activity => {
                            activitiesTable.append(`
                                <tr>
                                    <td>${activity.description}</td>
                                    <td>${activity.user}</td>
                                    <td>${activity.date}</td>
                                </tr>
                            `);
                        });
                    } else {
                        activitiesTable.append('<tr><td colspan="3">No recent activities</td></tr>');
                    }
                },
                error: function () {
                    alert('Failed to fetch dashboard data.');
                }
            });
        }

        $(document).ready(function () {
            fetchDashboardData();
            setInterval(fetchDashboardData, 60000); 
        });
    </script>
</body>

</html>

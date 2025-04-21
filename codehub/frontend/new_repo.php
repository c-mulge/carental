<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require '../connection.php'; // Update path if needed

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $repo_name = trim($_POST['repo_name']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    if (empty($repo_name)) {
        $error = "Repository name is required.";
    } else {
        // Check if user already has a repo with this name
        $stmt_check = $con->prepare("SELECT * FROM repositories WHERE user_id = ? AND name = ?");
        $stmt_check->bind_param("is", $user_id, $repo_name);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error = "Repository with this name already exists.";
        } else {
            // Insert new repo
            $stmt = $con->prepare("INSERT INTO repositories (user_id, name, description) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $repo_name, $description);

            if ($stmt->execute()) {
                $success = "Repository created successfully!";
            } else {
                $error = "Failed to create repository.";
            }
        }
    }
}

// Get user information
$user_id = $_SESSION['user_id'];
$stmt = $con->prepare("SELECT username FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$username = $user['username'] ?? 'User';
$role = $user['role'] ?? 'Developer';

// Get first letter of username for avatar
$avatar_letter = strtoupper(substr($username, 0, 1));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Repository | DevRepo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0066ff;
            --primary-dark: #0052cc;
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --body-color: #444;
            --body-bg: #fff;
            --border-color: #e9ecef;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--body-color);
            background-color: var(--light-color);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: var(--primary-color);
            transition: var(--transition);
        }

        a:hover {
            color: var(--primary-dark);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #0a2540 0%, #1a365d 100%);
            color: white;
            padding: 30px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo i {
            margin-right: 8px;
            font-size: 1.8rem;
        }

        .user-info {
            margin-top: 15px;
            text-align: center;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 2rem;
            color: white;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-role {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .nav-menu {
            list-style: none;
            padding: 0 10px;
        }

        .nav-menu li {
            margin-bottom: 5px;
        }

        .nav-menu a {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-menu a:hover, .nav-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
            transition: var(--transition);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 1.8rem;
            color: var(--dark-color);
        }

        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 25px;
            transition: var(--transition);
            margin-bottom: 30px;
        }

        .alert {
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Mobile responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header {
                padding: 0 10px 20px;
            }

            .logo span, .user-name, .user-role, .nav-menu span {
                display: none;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .nav-menu a {
                padding: 12px;
                justify-content: center;
            }

            .nav-menu i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Mobile menu toggle */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
            background-color: var(--primary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        @media (max-width: 576px) {
            .sidebar {
                left: -250px;
                width: 250px;
                z-index: 99;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
                padding-top: 70px;
            }

            .menu-toggle {
                display: flex;
            }

            .logo span, .user-name, .user-role, .nav-menu span {
                display: block;
            }

            .nav-menu a {
                padding: 12px 20px;
                justify-content: flex-start;
            }

            .nav-menu i {
                margin-right: 10px;
            }

            .user-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="dashboard.php" class="logo">
                    <i class="fas fa-code"></i>
                    <span>CodeHub</span>
                </a>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo $avatar_letter; ?>
                    </div>
                    <div class="user-name"><?php echo $username; ?></div>
                    <div class="user-role"><?php echo $role; ?></div>
                </div>
            </div>
            
            <ul class="nav-menu">
                <li>
                    <a href="../dashboard.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="repo.php">
                        <i class="fas fa-folder"></i>
                        <span>Repositories</span>
                    </a>
                </li>
                <li>
                    <a href="create_repository.php" class="active">
                        <i class="fas fa-plus-circle"></i>
                        <span>Create Repository</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="dashboard-header">
                <h1 class="page-title">Create New Repository</h1>
                <div class="dashboard-actions">
                    <a href="repositories.php" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to Repositories
                    </a>
                </div>
            </div>

            <div class="card">
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success; ?>
                    </div>
                <?php elseif ($error): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label for="repo_name" class="form-label">Repository Name:</label>
                        <input type="text" id="repo_name" name="repo_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description (optional):</label>
                        <textarea id="description" name="description" rows="4" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Create Repository
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
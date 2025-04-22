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
    <link rel="stylesheet" href="css/new_repo.css">
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
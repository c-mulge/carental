<?php
session_start();
require 'connection.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$repo_query = $con->prepare("SELECT name, description FROM repositories WHERE user_id = ?");
$repo_query->bind_param("i", $user_id);
$repo_query->execute();
$repo_result = $repo_query->get_result();

$repo_count = $repo_result->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CodeHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="frontend/css/dashboard.css">
</head>
<body>

    <div class="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dashboard-container">

        <div class="sidebar">
            <div class="sidebar-header">
                <a href="dashboard.php" class="logo">
                    <i class="fas fa-code"></i>
                    <span>CodeHub</span>
                </a>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo substr(htmlspecialchars($_SESSION['username']), 0, 1); ?>
                    </div>
                    <div class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                    <div class="user-role">Developer</div>
                </div>
            </div>
            <ul class="nav-menu">
                <li>
                    <a href="dashboard.php" class="active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="frontend/repo.php">
                        <i class="fas fa-folder"></i>
                        <span>Repositories</span>
                    </a>
                </li>
                <li>
                    <a href="frontend/upload_code.php">
                        <i class="fas fa-upload"></i>
                        <span>Upload Code</span>
                    </a>
                </li>
                <li>
                    <a href="projects.php">
                        <i class="fas fa-folder"></i>
                        <span>Projects</span>
                    </a>
                </li>
                <li>
                    <a href="snippets.php">
                        <i class="fas fa-code"></i>
                        <span>Snippets</span>
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

        <!-- Main Content -->
        <div class="main-content">
            <div class="dashboard-header">
                <h1 class="page-title">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                <div class="dashboard-actions">
                    <a href="frontend/upload_code.php" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Code
                    </a>
                    <a href="new-project.php" class="btn btn-outline">
                        <i class="fas fa-plus"></i> New Project
                    </a>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="dashboard-cards">

            <div class="card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fas fa-book"></i>
        </div>
        <div>
            <h3 class="card-title">Repositories</h3>
            <div class="card-subtitle">Your code repositories</div>
        </div>
    </div>
    <p>You have <strong><?php echo $repo_count; ?></strong> repositories</p>
    <div class="quick-actions">
        <a href="frontend/repo.php" class="quick-action-btn">
            <i class="fas fa-eye"></i> View All
        </a>
        <a href="frontend/new_repo.php" class="quick-action-btn">
            <i class="fas fa-plus"></i> New Repository
        </a>
    </div>
</div>


                <div class="card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div>
                            <h3 class="card-title">Your Snippets</h3>
                            <div class="card-subtitle">Quick access to your code</div>
                        </div>
                    </div>
                    <p>You have <strong>12</strong> saved code snippets</p>
                    <div class="quick-actions">
                        <a href="snippets.php" class="quick-action-btn">
                            <i class="fas fa-eye"></i> View All
                        </a>
                        <a href="snippets.php?new=true" class="quick-action-btn">
                            <i class="fas fa-plus"></i> New Snippet
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-folder"></i>
                        </div>
                        <div>
                            <h3 class="card-title">Projects</h3>
                            <div class="card-subtitle">Your current projects</div>
                        </div>
                    </div>
                    <p>You have <strong>3</strong> active projects</p>
                    <div class="quick-actions">
                        <a href="projects.php" class="quick-action-btn">
                            <i class="fas fa-eye"></i> View Projects
                        </a>
                        <a href="new-project.php" class="quick-action-btn">
                            <i class="fas fa-plus"></i> New Project
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h3 class="card-title">Featured</h3>
                            <div class="card-subtitle">Community highlights</div>
                        </div>
                    </div>
                    <p>Explore trending code from the community</p>
                    <div class="quick-actions">
                        <a href="explore.php" class="quick-action-btn">
                            <i class="fas fa-compass"></i> Explore
                        </a>
                        <a href="community.php" class="quick-action-btn">
                            <i class="fas fa-users"></i> Community
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h3 class="section-title">
                    <i class="fas fa-history"></i> Recent Activity
                </h3>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">You uploaded a new code snippet: <strong>CSS Animation Library</strong></div>
                            <div class="activity-meta">
                                <i class="far fa-clock"></i> 2 hours ago
                            </div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">You received a comment on <strong>JavaScript Utilities</strong></div>
                            <div class="activity-meta">
                                <i class="far fa-clock"></i> Yesterday
                            </div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">Your project <strong>React Dashboard</strong> was starred by <strong>5</strong> users</div>
                            <div class="activity-meta">
                                <i class="far fa-clock"></i> 3 days ago
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
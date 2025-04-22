<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require '../connection.php'; // Update the path if needed

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch repositories
$stmt = $con->prepare("SELECT * FROM repositories WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$repositories = [];
while ($row = $result->fetch_assoc()) {
    $repositories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Repositories - CodeHub</title>
    <link rel="stylesheet" href="../frontend/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-code"></i>
                    <span>CodeHub</span>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($username, 0, 1)); ?>
                    </div>
                    <div class="user-name"><?php echo htmlspecialchars($username); ?></div>
                    <div class="user-role">Developer</div>
                </div>
            </div>
            
            <ul class="nav-menu">
                <li>
                    <a href="../dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="repositories.php" class="active">
                        <i class="fas fa-folder"></i>
                        <span>Repositories</span>
                    </a>
                </li>
                <li>
                    <a href="projects.php">
                        <i class="fas fa-project-diagram"></i>
                        <span>Projects</span>
                    </a>
                </li>
                <li>
                    <a href="issues.php">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Issues</span>
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
            <!-- Mobile menu toggle button -->
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>

            <div class="dashboard-header">
                <h1 class="page-title"><i class="fas fa-folder"></i> Your Repositories</h1>
                
                <div class="dashboard-actions">
                    <a href="new-repository.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Repository
                    </a>
                </div>
            </div>

            <?php if (count($repositories) === 0): ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h2 class="card-title">No repositories yet</h2>
                            <p class="card-subtitle">Start by creating your first repository</p>
                        </div>
                    </div>
                    <div class="quick-actions">
                        <a href="new-repository.php" class="quick-action-btn">
                            <i class="fas fa-plus"></i> Create Repository
                        </a>
                        <a href="import-repository.php" class="quick-action-btn">
                            <i class="fas fa-cloud-download-alt"></i> Import Repository
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="dashboard-cards">
                    <?php foreach ($repositories as $repo): ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-code-branch"></i>
                                </div>
                                <div>
                                    <h2 class="card-title"><?php echo htmlspecialchars($repo['name']); ?></h2>
                                    <p class="card-subtitle">
                                        <i class="far fa-clock"></i> Created <?php echo date("M d, Y", strtotime($repo['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                            <p><?php echo htmlspecialchars($repo['description'] ?: "No description provided."); ?></p>
                            <div class="quick-actions">
                                <a href="view_repo.php?id=<?php echo $repo['repo_id']; ?>" class="quick-action-btn">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="edit-repository.php?id=<?php echo $repo['repo_id']; ?>" class="quick-action-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="clone-repository.php?id=<?php echo $repo['repo_id']; ?>" class="quick-action-btn">
                                    <i class="fas fa-clone"></i> Clone
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="recent-activity">
                <h2 class="section-title"><i class="fas fa-history"></i> Recent Activity</h2>
                <ul class="activity-list">
                    <?php 
                    // This would typically come from a database query
                    // These are just placeholder items
                    $activities = [
                        ['icon' => 'fas fa-code-commit', 'text' => 'Committed 3 changes to <strong>project-alpha</strong>', 'time' => '2 hours ago'],
                        ['icon' => 'fas fa-code-branch', 'text' => 'Created new branch <strong>feature/login</strong> in <strong>api-service</strong>', 'time' => '1 day ago'],
                        ['icon' => 'fas fa-plus', 'text' => 'Created new repository <strong>mobile-app</strong>', 'time' => '3 days ago']
                    ];
                    
                    foreach ($activities as $activity): 
                    ?>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="<?php echo $activity['icon']; ?>"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text"><?php echo $activity['text']; ?></div>
                            <div class="activity-meta">
                                <i class="far fa-clock"></i> <?php echo $activity['time']; ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
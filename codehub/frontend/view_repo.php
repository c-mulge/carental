<?php
session_start();
require '../connection.php'; // Update if needed

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Assuming username is stored in session

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid repository ID.";
    exit();
}

$repo_id = intval($_GET['id']);

// Fetch repository details
$repo_stmt = $con->prepare("SELECT name, description, created_at FROM repositories WHERE repo_id = ? AND user_id = ?");
$repo_stmt->bind_param("ii", $repo_id, $user_id);
$repo_stmt->execute();
$repo_result = $repo_stmt->get_result();

if ($repo_result->num_rows === 0) {
    echo "Repository not found.";
    exit();
}
$repo = $repo_result->fetch_assoc();

// Fetch snippets in this repo
$snippet_stmt = $con->prepare("SELECT snippet_id, title, language, created_at FROM snippets WHERE repo_id = ?");
$snippet_stmt->bind_param("i", $repo_id);
$snippet_stmt->execute();
$snippet_result = $snippet_stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($repo['name']); ?> - CodeHub</title>
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
                    <a href="dashboard.php">
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

            <!-- Repository Header -->
            <div class="dashboard-header">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-folder-open"></i> <?php echo htmlspecialchars($repo['name']); ?>
                    </h1>
                    <p><?php echo nl2br(htmlspecialchars($repo['description'])); ?></p>
                </div>
                
                <div class="dashboard-actions">
                    <a href="upload_code.php?repo_id=<?php echo $repo_id; ?>" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Snippet
                    </a>
                    <a href="repositories.php" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <!-- Repository Info Card -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <h2 class="card-title">Repository Details</h2>
                        <p class="card-subtitle">Information about this code repository</p>
                    </div>
                </div>

                <div class="activity-meta" style="margin-top: 15px;">
                    <i class="far fa-calendar-alt"></i> Created on <?php echo date("F j, Y, g:i a", strtotime($repo['created_at'])); ?>
                </div>

                <div class="quick-actions">
                    <a href="edit_repo.php?id=<?php echo $repo_id; ?>" class="quick-action-btn">
                        <i class="fas fa-edit"></i> Edit Repository
                    </a>
                    <a href="download_repo.php?id=<?php echo $repo_id; ?>" class="quick-action-btn">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <a href="share_repo.php?id=<?php echo $repo_id; ?>" class="quick-action-btn">
                        <i class="fas fa-share-alt"></i> Share
                    </a>
                </div>
            </div>

            <!-- Snippets Section -->
            <div class="recent-activity">
                <h2 class="section-title"><i class="fas fa-code"></i> Code Snippets</h2>
                
                <?php if ($snippet_result->num_rows > 0): ?>
                    <ul class="activity-list">
                        <?php while ($snippet = $snippet_result->fetch_assoc()): ?>
                            <li class="activity-item">
                                <div class="activity-icon">
                                    <?php 
                                    // Different icons based on language
                                    $icon = 'fas fa-code';
                                    $language = strtolower($snippet['language']);
                                    
                                    if (strpos($language, 'python') !== false) {
                                        $icon = 'fab fa-python';
                                    } elseif (strpos($language, 'java') !== false) {
                                        $icon = 'fab fa-java';
                                    } elseif (strpos($language, 'javascript') !== false || strpos($language, 'js') !== false) {
                                        $icon = 'fab fa-js';
                                    } elseif (strpos($language, 'php') !== false) {
                                        $icon = 'fab fa-php';
                                    } elseif (strpos($language, 'html') !== false) {
                                        $icon = 'fab fa-html5';
                                    } elseif (strpos($language, 'css') !== false) {
                                        $icon = 'fab fa-css3-alt';
                                    }
                                    ?>
                                    <i class="<?php echo $icon; ?>"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-text">
                                        <strong><?php echo htmlspecialchars($snippet['title']); ?></strong>
                                        <span class="badge" style="background-color: var(--primary-color); color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; margin-left: 10px;">
                                            <?php echo htmlspecialchars($snippet['language']); ?>
                                        </span>
                                    </div>
                                    <div class="activity-meta">
                                        <i class="far fa-clock"></i> Created on <?php echo date("M d, Y", strtotime($snippet['created_at'])); ?>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <a href="view_snippet.php?snippet_id=<?php echo $snippet['snippet_id']; ?>" class="quick-action-btn">
                                            <i class="fas fa-eye"></i> View Snippet
                                        </a>
                                        <a href="edit_snippet.php?id=<?php echo $snippet['snippet_id']; ?>" class="quick-action-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="copy_snippet.php?id=<?php echo $snippet['snippet_id']; ?>" class="quick-action-btn">
                                            <i class="fas fa-copy"></i> Copy
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <div class="card" style="margin-top: 20px;">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <h2 class="card-title">No Code Snippets Yet</h2>
                                <p class="card-subtitle">Start adding snippets to this repository</p>
                            </div>
                        </div>
                        <div class="quick-actions">
                            <a href="upload_code.php?repo_id=<?php echo $repo_id; ?>" class="quick-action-btn">
                                <i class="fas fa-upload"></i> Upload First Snippet
                            </a>
                            <a href="create_snippet.php?repo_id=<?php echo $repo_id; ?>" class="quick-action-btn">
                                <i class="fas fa-code"></i> Create New Snippet
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
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
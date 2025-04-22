<?php
session_start();
require '../connection.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Assuming username is stored in session

// Get snippet_id from URL
if (!isset($_GET['snippet_id'])) {
    echo "No snippet ID provided!";
    exit();
}

$snippet_id = intval($_GET['snippet_id']);

// Get snippet details
$stmt = $con->prepare("SELECT s.title, s.code, s.language, s.created_at, r.name AS repo_name, r.repo_id 
                        FROM snippets s 
                        JOIN repositories r ON s.repo_id = r.repo_id 
                        WHERE s.snippet_id = ?");
$stmt->bind_param("i", $snippet_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Snippet not found!";
    exit();
}

$snippet = $result->fetch_assoc();
$stmt->close();

// Get tags
$tags = [];
$tag_stmt = $con->prepare("SELECT t.name FROM tags t 
                            JOIN snippet_tags st ON t.tag_id = st.tag_id 
                            WHERE st.snippet_id = ?");
$tag_stmt->bind_param("i", $snippet_id);
$tag_stmt->execute();
$tag_result = $tag_stmt->get_result();
while ($row = $tag_result->fetch_assoc()) {
    $tags[] = $row['name'];
}
$tag_stmt->close();

// Get language for icon
$language_icon = 'fas fa-code';
$language = strtolower($snippet['language']);

if (strpos($language, 'python') !== false) {
    $language_icon = 'fab fa-python';
} elseif (strpos($language, 'java') !== false && strpos($language, 'script') === false) {
    $language_icon = 'fab fa-java';
} elseif (strpos($language, 'javascript') !== false || strpos($language, 'js') !== false) {
    $language_icon = 'fab fa-js';
} elseif (strpos($language, 'php') !== false) {
    $language_icon = 'fab fa-php';
} elseif (strpos($language, 'html') !== false) {
    $language_icon = 'fab fa-html5';
} elseif (strpos($language, 'css') !== false) {
    $language_icon = 'fab fa-css3-alt';
} elseif (strpos($language, 'ruby') !== false) {
    $language_icon = 'fas fa-gem';
} elseif (strpos($language, 'c#') !== false || strpos($language, 'c++') !== false || strpos($language, 'c') !== false) {
    $language_icon = 'fas fa-file-code';
}

// Define language-specific highlight classes
$language_class = 'language-' . strtolower($snippet['language']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Snippet - <?php echo htmlspecialchars($snippet['title']); ?></title>
    <link rel="stylesheet" href="../frontend/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/vs2015.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <link rel="stylesheet" href="css/view_snippet.css">
    <style>
        
    </style>
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

            <!-- Snippet Header -->
            <div class="dashboard-header">
                <div>
                    <h1 class="page-title">
                        <i class="<?php echo $language_icon; ?>"></i> <?php echo htmlspecialchars($snippet['title']); ?>
                    </h1>
                    <p>
                        <a href="view_repository.php?id=<?php echo $snippet['repo_id']; ?>">
                            <i class="fas fa-folder"></i> <?php echo htmlspecialchars($snippet['repo_name']); ?>
                        </a>
                    </p>
                </div>
                
                <div class="dashboard-actions">
                    <a href="edit_snippet.php?snippet_id=<?php echo $snippet_id; ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Snippet
                    </a>
                    <a href="view_repo.php?id=<?php echo $snippet['repo_id']; ?>" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to Repository
                    </a>
                </div>
            </div>

            <!-- Snippet Info -->
            <div class="snippet-info-grid">
                <div class="snippet-info-item">
                    <div class="snippet-info-label">LANGUAGE</div>
                    <div class="snippet-info-value">
                        <i class="<?php echo $language_icon; ?>"></i>
                        <?php echo htmlspecialchars($snippet['language']); ?>
                    </div>
                </div>
                
                <div class="snippet-info-item">
                    <div class="snippet-info-label">REPOSITORY</div>
                    <div class="snippet-info-value">
                        <i class="fas fa-folder"></i>
                        <?php echo htmlspecialchars($snippet['repo_name']); ?>
                    </div>
                </div>
                
                <div class="snippet-info-item">
                    <div class="snippet-info-label">CREATED</div>
                    <div class="snippet-info-value">
                        <i class="far fa-calendar-alt"></i>
                        <?php echo isset($snippet['created_at']) ? date("M d, Y", strtotime($snippet['created_at'])) : 'N/A'; ?>
                    </div>
                </div>
                
                <div class="snippet-info-item">
                    <div class="snippet-info-label">SIZE</div>
                    <div class="snippet-info-value">
                        <i class="fas fa-file-alt"></i>
                        <?php echo strlen($snippet['code']); ?> bytes
                    </div>
                </div>
            </div>

            <!-- Code Display -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="<?php echo $language_icon; ?>"></i>
                    </div>
                    <div>
                        <h2 class="card-title">Code Snippet</h2>
                        <p class="card-subtitle">Written in <?php echo htmlspecialchars($snippet['language']); ?></p>
                    </div>
                </div>
                
                <div class="code-container">
                    <div class="code-header">
                        <div class="language-badge">
                            <?php echo htmlspecialchars($snippet['language']); ?>
                        </div>
                        <div class="action-buttons">
                            <button class="action-button copy-btn" title="Copy code" onclick="copyCode()">
                                <i class="fas fa-copy"></i>
                            </button>
                            <button class="action-button" title="Download" onclick="downloadCode()">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                    <div class="code-body">
                        <pre><code class="<?php echo $language_class; ?>"><?php echo htmlspecialchars($snippet['code']); ?></code></pre>
                    </div>
                </div>
                
                <?php if (!empty($tags)): ?>
                <div style="margin-top: 20px;">
                    <h3 style="font-size: 1rem; margin-bottom: 10px;">Tags</h3>
                    <div class="tag-cloud">
                        <?php foreach ($tags as $tag): ?>
                            <span class="tag-item">
                                <i class="fas fa-tag"></i> <?php echo htmlspecialchars($tag); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="quick-actions">
                    <a href="edit_snippet.php?snippet_id=<?php echo $snippet_id; ?>" class="quick-action-btn">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="fork_snippet.php?snippet_id=<?php echo $snippet_id; ?>" class="quick-action-btn">
                        <i class="fas fa-code-branch"></i> Fork
                    </a>
                    <a href="share_snippet.php?snippet_id=<?php echo $snippet_id; ?>" class="quick-action-btn">
                        <i class="fas fa-share-alt"></i> Share
                    </a>
                    <a href="#" class="quick-action-btn" onclick="deleteSnippet(<?php echo $snippet_id; ?>)">
                        <i class="fas fa-trash-alt"></i> Delete
                    </a>
                </div>
            </div>
            
            <!-- Related Snippets (placeholder) -->
            <div class="recent-activity">
                <h2 class="section-title"><i class="fas fa-link"></i> Related Snippets</h2>
                <p style="padding: 15px;">No related snippets found based on tags and language.</p>
            </div>
        </div>
    </div>

    <script>
        // Initialize syntax highlighting
        document.addEventListener('DOMContentLoaded', function() {
            hljs.highlightAll();
        });
        
        // Mobile menu toggle
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Copy code function
        function copyCode() {
            const codeElement = document.querySelector('.code-body code');
            const textArea = document.createElement('textarea');
            textArea.value = codeElement.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            
            // Show feedback
            const copyBtn = document.querySelector('.copy-btn');
            const originalIcon = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(() => {
                copyBtn.innerHTML = originalIcon;
            }, 2000);
        }
        
        // Download code function
        function downloadCode() {
            const code = document.querySelector('.code-body code').textContent;
            const title = "<?php echo addslashes($snippet['title']); ?>";
            const language = "<?php echo addslashes($snippet['language']); ?>".toLowerCase();
            
            // Determine file extension based on language
            let extension = '.txt';
            if (language.includes('javascript') || language.includes('js')) {
                extension = '.js';
            } else if (language.includes('html')) {
                extension = '.html';
            } else if (language.includes('css')) {
                extension = '.css';
            } else if (language.includes('python')) {
                extension = '.py';
            } else if (language.includes('java')) {
                extension = '.java';
            } else if (language.includes('php')) {
                extension = '.php';
            } else if (language.includes('ruby')) {
                extension = '.rb';
            } else if (language.includes('c#')) {
                extension = '.cs';
            } else if (language.includes('c++')) {
                extension = '.cpp';
            } else if (language === 'c') {
                extension = '.c';
            }
            
            const filename = title.replace(/[^a-z0-9]/gi, '_').toLowerCase() + extension;
            
            const blob = new Blob([code], { type: 'text/plain' });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
        
        // Delete snippet (with confirmation)
        function deleteSnippet(snippetId) {
            if (confirm('Are you sure you want to delete this snippet? This action cannot be undone.')) {
                window.location.href = 'delete_snippet.php?snippet_id=' + snippetId;
            }
        }
    </script>
</body>
</html>
<?php
session_start();
require '../connection.php'; // DB connection

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $repo_id = $_POST['repo_id']; // From form (dropdown or hidden input)
    $title = trim($_POST['title']);
    $code = trim($_POST['code']);
    $language = trim($_POST['language']);
    $tags_input = trim($_POST['tags']); // Comma-separated

    // Basic validation
    if (empty($repo_id) || empty($code)) {
        echo "Repository and code are required!";
        exit();
    }

    // Insert snippet into `snippets`
    $stmt = $conn->prepare("INSERT INTO snippets (repo_id, title, code, language) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $repo_id, $title, $code, $language);
    
    if ($stmt->execute()) {
        $snippet_id = $stmt->insert_id;
        $stmt->close();

        // Handle tags
        if (!empty($tags_input)) {
            $tags = array_map('trim', explode(',', $tags_input));

            foreach ($tags as $tag) {
                if (empty($tag)) continue;

                // Check if tag already exists
                $tag_stmt = $conn->prepare("SELECT tag_id FROM tags WHERE name = ?");
                $tag_stmt->bind_param("s", $tag);
                $tag_stmt->execute();
                $tag_stmt->store_result();

                if ($tag_stmt->num_rows > 0) {
                    $tag_stmt->bind_result($tag_id);
                    $tag_stmt->fetch();
                } else {
                    // Insert new tag
                    $insert_tag = $conn->prepare("INSERT INTO tags (name) VALUES (?)");
                    $insert_tag->bind_param("s", $tag);
                    $insert_tag->execute();
                    $tag_id = $insert_tag->insert_id;
                    $insert_tag->close();
                }
                $tag_stmt->close();

                // Associate snippet with tag
                $link_stmt = $conn->prepare("INSERT INTO snippet_tags (snippet_id, tag_id) VALUES (?, ?)");
                $link_stmt->bind_param("ii", $snippet_id, $tag_id);
                $link_stmt->execute();
                $link_stmt->close();
            }
        }

        echo "Snippet uploaded successfully!";
    } else {
        echo "Failed to upload snippet!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Code - CodeHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/upload_code.css">
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <a href="../dashboard.php" class="logo">
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
                    <a href="../dashboard.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="upload_code.php" class="active">
                        <i class="fas fa-upload"></i>
                        <span>Upload Code</span>
                    </a>
                </li>
                <li>
                    <a href="../projects.php">
                        <i class="fas fa-folder"></i>
                        <span>Projects</span>
                    </a>
                </li>
                <li>
                    <a href="../snippets.php">
                        <i class="fas fa-code"></i>
                        <span>Snippets</span>
                    </a>
                </li>
                <li>
                    <a href="../settings.php">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Upload Code</h1>
                <div class="breadcrumb">
                    <a href="../dashboard.php">Dashboard</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Upload Code</span>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="tips-card">
                <div class="tips-title">
                    <i class="fas fa-lightbulb"></i>
                    <span>Tips for Sharing Code</span>
                </div>
                <div class="tips-content">
                    <p>To make your code snippet more useful to the community:</p>
                    <ul>
                        <li>Add clear, descriptive titles that indicate what your code does</li>
                        <li>Include comments in your code to explain complex logic</li>
                        <li>Provide a detailed description of how to use your code</li>
                        <li>Tag your code with the correct language for proper syntax highlighting</li>
                    </ul>
                </div>
            </div>

            <!-- Upload Form -->
            <div class="form-card">
                <div class="form-header">
                    <h2>Upload a New Code Snippet</h2>
                    <p>Share your code snippets with the CodeHub community</p>
                </div>
                <form action="upload_code.php" method="POST">
                    <div class="form-group">
                        <label for="title" class="form-label">Snippet Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter a descriptive title" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Explain what your code does and how to use it" rows="4"></textarea>
                    </div> -->

                    <div class="form-group">
                        <label for="language" class="form-label">Programming Language</label>
                        <select id="language" name="language" class="form-select" required>
                            <option value="">Select a language</option>
                            <option value="HTML">HTML</option>
                            <option value="CSS">CSS</option>
                            <option value="JavaScript">JavaScript</option>
                            <option value="PHP">PHP</option>
                            <option value="Python">Python</option>
                            <option value="C">C</option>
                            <option value="C++">C++</option>
                            <option value="Java">Java</option>
                            <option value="Ruby">Ruby</option>
                            <option value="Swift">Swift</option>
                            <option value="TypeScript">TypeScript</option>
                            <option value="Go">Go</option>
                            <option value="Rust">Rust</option>
                            <option value="SQL">SQL</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="code" class="form-label">Code</label>
                        <textarea id="code" name="code" class="form-control code-editor" placeholder="Paste your code here..." rows="12" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tags (Optional)</label>
                        <input type="text" class="form-control" name="tags" placeholder="Enter tags separated by commas (e.g., animation, responsive, utilities)">
                    </div>

                    <div class="form-footer">
                        <div class="form-footer-links">
                            <a href="../dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                            <a href="#" id="preview-btn"><i class="fas fa-eye"></i> Preview</a>
                        </div>
                        <div>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" name="upload" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Code
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Automatically adjust code editor height based on content
        const codeEditor = document.getElementById('code');
        codeEditor.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Preview button placeholder functionality (can be implemented with additional JS)
        document.getElementById('preview-btn').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Preview functionality would be implemented here!');
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeShare Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-code-branch"></i>
                    <span>CodeShare</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-category">Main</div>
                <div class="menu-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-code"></i>
                    <span>My Repositories</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-star"></i>
                    <span>Starred</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Organizations</span>
                </div>
                
                <div class="menu-category">Explore</div>
                <div class="menu-item">
                    <i class="fas fa-compass"></i>
                    <span>Discover</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Trending</span>
                </div>
                
                <div class="menu-category">Personal</div>
                <div class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Help</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search repositories...">
                </div>
                <div class="user-actions">
                    <div class="action-item">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="action-item">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-profile">
                        <div class="avatar">JS</div>
                        <span>John Smith</span>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>

                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>15</h3>
                            <p>Total Repositories</p>
                        </div>
                        <div class="stat-icon bg-blue">
                            <i class="fas fa-code-branch"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>247</h3>
                            <p>Contributions</p>
                        </div>
                        <div class="stat-icon bg-green">
                            <i class="fas fa-code-commit"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>48</h3>
                            <p>Stars Received</p>
                        </div>
                        <div class="stat-icon bg-purple">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>12</h3>
                            <p>Pull Requests</p>
                        </div>
                        <div class="stat-icon bg-orange">
                            <i class="fas fa-code-pull-request"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="activity-container">
                    <div class="section-header">
                        <h2>Recent Activity</h2>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-time">Today, 10:30 AM</div>
                                <div class="timeline-title">Pushed to main in e-commerce-app</div>
                                <div class="timeline-description">Fixed responsive layout issues in the product card component</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-time">Yesterday, 3:45 PM</div>
                                <div class="timeline-title">Created new repository task-manager-api</div>
                                <div class="timeline-description">A RESTful API built with PHP for managing tasks and projects</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-time">Mar 11, 2025, 1:20 PM</div>
                                <div class="timeline-title">Merged pull request in weather-dashboard</div>
                                <div class="timeline-description">Added dark mode support and fixed API integration issues</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-time">Mar 10, 2025, 9:15 AM</div>
                                <div class="timeline-title">Forked repository css-framework</div>
                                <div class="timeline-description">Lightweight CSS framework with utility classes and components</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Repositories -->
                <div class="repos-container">
                    <div class="section-header">
                        <h2>My Repositories</h2>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="repos-list">
                        <div class="repo-card">
                            <div class="repo-header">
                                <div class="repo-name">e-commerce-app</div>
                                <div class="repo-visibility">Public</div>
                            </div>
                            <div class="repo-description">
                                A full-featured e-commerce application with product listings, cart functionality, and checkout process.
                            </div>
                            <div class="repo-footer">
                                <div class="repo-language">
                                    <span class="language-dot dot-js"></span>
                                    JavaScript
                                </div>
                                <div class="repo-stats">
                                    <div class="repo-stat">
                                        <i class="fas fa-star"></i>
                                        14
                                    </div>
                                    <div class="repo-stat">
                                        <i class="fas fa-code-branch"></i>
                                        5
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="repo-card">
                            <div class="repo-header">
                                <div class="repo-name">task-manager-api</div>
                                <div class="repo-visibility">Public</div>
                            </div>
                            <div class="repo-description">
                                A RESTful API built with PHP for managing tasks and projects with user authentication.
                            </div>
                            <div class="repo-footer">
                                <div class="repo-language">
                                    <span class="language-dot dot-php"></span>
                                    PHP
                                </div>
                                <div class="repo-stats">
                                    <div class="repo-stat">
                                        <i class="fas fa-star"></i>
                                        8
                                    </div>
                                    <div class="repo-stat">
                                        <i class="fas fa-code-branch"></i>
                                        2
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="repo-card">
                            <div class="repo-header">
                                <div class="repo-name">weather-dashboard</div>
                                <div class="repo-visibility">Public</div>
                            </div>
                            <div class="repo-description">
                                A responsive weather dashboard that uses a weather API to display forecast data with charts.
                            </div>
                            <div class="repo-footer">
                                <div class="repo-language">
                                    <span class="language-dot dot-js"></span>
                                    JavaScript
                                </div>
                                <div class="repo-stats">
                                    <div class="repo-stat">
                                        <i class="fas fa-star"></i>
                                        11
                                    </div>
                                    <div class="repo-stat">
                                        <i class="fas fa-code-branch"></i>
                                        3
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="repo-card">
                            <div class="repo-header">
                                <div class="repo-name">portfolio-website</div>
                                <div class="repo-visibility">Public</div>
                            </div>
                            <div class="repo-description">
                                Personal portfolio website showcasing projects and skills with a clean, modern design.
                            </div>
                            <div class="repo-footer">
                                <div class="repo-language">
                                    <span class="language-dot dot-html"></span>
                                    HTML
                                </div>
                                <div class="repo-stats">
                                    <div class="repo-stat">
                                        <i class="fas fa-star"></i>
                                        6
                                    </div>
                                    <div class="repo-stat">
                                        <i class="fas fa-code-branch"></i>
                                        1
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Menu item active state
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
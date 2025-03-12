<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Repositories - CodeHub</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Additional repo listing styles */

        header {
            background: linear-gradient(135deg, #0a2540 0%, #1a365d 100%);
            color: white;
            padding-bottom: 10px;
        }

        .navbar {
            padding: 20px 0;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 8px;
            font-size: 1.8rem;
        }

        .nav-menu {
            display: flex;
            align-items: center;
        }

        .nav-menu li {
            margin-left: 30px;
        }

        .nav-menu a {
            color: white;
            font-weight: 500;
        }

        .nav-menu a:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin-bottom: 5px;
            border-radius: 2px;
        }

        .page-header {
            padding: 24px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .page-description {
            color: var(--secondary-color);
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            margin-bottom: 20px;
        }

        .search-box {
            flex-grow: 1;
            max-width: 500px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 0.9rem;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }

        .filter-options {
            display: flex;
            gap: 10px;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-dropdown select {
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background-color: white;
            font-size: 0.9rem;
            appearance: none;
            padding-right: 30px;
            cursor: pointer;
        }

        .filter-dropdown::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            pointer-events: none;
        }

        .create-new {
            margin-left: 10px;
        }

        .repo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .repo-card {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 20px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .repo-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-3px);
        }

        .repo-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .repo-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .repo-title a {
            max-width: 190px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .repo-visibility {
            padding: 2px 7px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 0.7rem;
            color: var(--secondary-color);
        }

        .repo-owner {
            display: flex;
            align-items: center;
            color: var(--secondary-color);
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .repo-owner img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .repo-description {
            color: var(--body-color);
            font-size: 0.9rem;
            margin-bottom: 15px;
            line-height: 1.5;
            flex-grow: 1;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .repo-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: auto;
        }

        .repo-language {
            display: flex;
            align-items: center;
            color: var(--secondary-color);
            font-size: 0.85rem;
        }

        .language-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .repo-stats {
            display: flex;
            gap: 10px;
        }

        .repo-stat {
            display: flex;
            align-items: center;
            color: var(--secondary-color);
            font-size: 0.85rem;
        }

        .repo-stat i {
            margin-right: 4px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            margin-bottom: 60px;
        }

        .pagination-item {
            padding: 8px 16px;
            border: 1px solid var(--border-color);
            margin: 0 5px;
            border-radius: var(--border-radius);
            color: var(--primary-color);
            transition: var(--transition);
        }

        .pagination-item:hover, .pagination-item.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-item.disabled {
            color: var(--secondary-color);
            pointer-events: none;
        }

        /* Language colors */
        .color-js { background-color: #f1e05a; }
        .color-php { background-color: #4F5D95; }
        .color-html { background-color: #e34c26; }
        .color-css { background-color: #563d7c; }
        .color-python { background-color: #3572A5; }
        .color-java { background-color: #b07219; }
        .color-go { background-color: #00ADD8; }
        .color-ruby { background-color: #701516; }
        .color-typescript { background-color: #2b7489; }
        .color-c { background-color: #555555; }

        @media (max-width: 768px) {
            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .search-box {
                max-width: 100%;
                width: 100%;
            }

            .filter-options {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 5px;
            }

            .repo-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="index.html" class="logo">
                    <i class="fa-solid fa-code-branch"></i>
                    CodeHub
                </a>
                <ul class="nav-menu">
                    <li><a href="#">Explore</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-plus"></i></a></li>
                    <li><a href="#"><img src="/api/placeholder/40/40" alt="User Avatar" style="border-radius: 50%; width: 32px; height: 32px;"></a></li>
                </ul>
                <div class="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container" style="padding-top: 30px; padding-bottom: 60px;">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">All Repositories</h1>
                <p class="page-description">Browse and discover repositories shared by the CodeHub community</p>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="search-box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Search repositories...">
                </div>
                <div class="filter-options">
                    <div class="filter-dropdown">
                        <select>
                            <option>Language: All</option>
                            <option>JavaScript</option>
                            <option>PHP</option>
                            <option>HTML</option>
                            <option>CSS</option>
                            <option>Python</option>
                            <option>Java</option>
                            <option>C#</option>
                            <option>Ruby</option>
                        </select>
                    </div>
                    <div class="filter-dropdown">
                        <select>
                            <option>Sort: Most Stars</option>
                            <option>Recently Updated</option>
                            <option>Newest</option>
                            <option>Oldest</option>
                            <option>Most Forks</option>
                        </select>
                    </div>
                    <div class="filter-dropdown">
                        <select>
                            <option>Type: All</option>
                            <option>Public</option>
                            <option>Private</option>
                            <option>Archived</option>
                        </select>
                    </div>
                    <button class="btn btn-primary create-new">
                        <i class="fa-solid fa-plus"></i> New
                    </button>
                </div>
            </div>

            <!-- Repository Grid -->
            <div class="repo-grid">
                <!-- Repository Card 1 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">awesome-javascript</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>johndoe</span>
                    </div>
                    <p class="repo-description">
                        A curated list of awesome JavaScript frameworks, libraries, and tools for modern web development.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-js"></span>
                            JavaScript
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 548
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 127
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 2 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">php-mvc-framework</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>sarahjones</span>
                    </div>
                    <p class="repo-description">
                        A lightweight MVC framework built with PHP for rapid application development.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-php"></span>
                            PHP
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 324
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 86
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 3 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">css-animation-library</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>alexwang</span>
                    </div>
                    <p class="repo-description">
                        A collection of CSS animations and transitions for modern web applications.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-css"></span>
                            CSS
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 287
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 64
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 4 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">react-dashboard-template</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>mikesmith</span>
                    </div>
                    <p class="repo-description">
                        A modern React dashboard template with responsive design and customizable components.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-js"></span>
                            JavaScript
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 432
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 109
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 5 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">data-visualization-toolkit</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>emilybrown</span>
                    </div>
                    <p class="repo-description">
                        A comprehensive toolkit for creating interactive data visualizations on the web.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-js"></span>
                            JavaScript
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 376
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 93
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 6 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">python-ml-examples</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>davidlee</span>
                    </div>
                    <p class="repo-description">
                        Practical examples of machine learning algorithms implemented in Python.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-python"></span>
                            Python
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 652
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 183
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 7 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">responsive-portfolio-template</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>amandakim</span>
                    </div>
                    <p class="repo-description">
                        A clean and modern portfolio template for developers and designers.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-html"></span>
                            HTML
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 218
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 75
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 8 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">laravel-ecommerce</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>robertjones</span>
                    </div>
                    <p class="repo-description">
                        A full-featured eCommerce platform built with Laravel and Vue.js.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-php"></span>
                            PHP
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 493
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 145
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Repository Card 9 -->
                <div class="repo-card">
                    <div class="repo-card-header">
                        <h3 class="repo-title">
                            <a href="#">go-microservices</a>
                        </h3>
                        <span class="repo-visibility">Public</span>
                    </div>
                    <div class="repo-owner">
                        <img src="/api/placeholder/20/20" alt="User Avatar">
                        <span>sophiazhang</span>
                    </div>
                    <p class="repo-description">
                        Examples of building scalable microservices architecture with Go.
                    </p>
                    <div class="repo-meta">
                        <div class="repo-language">
                            <span class="language-color color-go"></span>
                            Go
                        </div>
                        <div class="repo-stats">
                            <span class="repo-stat">
                                <i class="fa-regular fa-star"></i> 387
                            </span>
                            <span class="repo-stat">
                                <i class="fa-solid fa-code-fork"></i> 96
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="pagination-item disabled">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                <a href="#" class="pagination-item active">1</a>
                <a href="#" class="pagination-item">2</a>
                <a href="#" class="pagination-item">3</a>
                <a href="#" class="pagination-item">4</a>
                <a href="#" class="pagination-item">5</a>
                <a href="#" class="pagination-item">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="#">
                        <i class="fa-solid fa-code-branch"></i>
                        CodeHub
                    </a>
                    <p>A platform for developers to share and collaborate on code.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Product</h4>
                        <ul>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Enterprise</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Platform</h4>
                        <ul>
                            <li><a href="#">Developer API</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Atom</a></li>
                            <li><a href="#">Packages</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Community</a></li>
                            <li><a href="#">Training</a></li>
                            <li><a href="#">Status</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; 2025 CodeHub. All rights reserved.
                </div>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle mobile menu
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
        
        // Repository card hover effects
        const repoCards = document.querySelectorAll('.repo-card');
        
        repoCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.borderColor = 'var(--primary-color)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.borderColor = 'var(--border-color)';
            });
        });
        
        // Filter dropdowns interaction
        const filterDropdowns = document.querySelectorAll('.filter-dropdown select');
        
        filterDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', () => {
                // Here you would add AJAX code to refresh the repository list
                console.log('Filter changed:', dropdown.value);
            });
        });
        
        // Search functionality
        const searchInput = document.querySelector('.search-box input');
        
        searchInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                // Here you would add AJAX code to search repositories
                console.log('Searching for:', searchInput.value);
            }
        });
    </script>
</body>
</html>
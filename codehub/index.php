<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeHub - Store Your Code Snippets</title>
    <link rel="stylesheet" href="frontend/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="index.php" class="logo">
                    <i class="fas fa-code"></i> CodeHub
                </a>
                <div class="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-menu">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="frontend/login.php" class="btn btn-outline">Login</a></li>
                    <li><a href="frontend/register.php" class="btn btn-primary">Sign Up</a></li>
                </ul>
            </div>
        </nav>

        <div class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Store, Share, and Collaborate on Code</h1>
                    <p>CodeHub helps developers manage code snippets, repositories, and collaborate with teams efficiently.</p>
                    <div class="hero-buttons">
                        <a href="Frontend/register.php" class="btn btn-primary btn-large">Get Started - It's Free</a>
                        <a href="#demo" class="btn btn-secondary btn-large">Watch Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="features" class="features">
        <div class="container">
            <div class="section-header">
                <h2>Powerful Features for Developers</h2>
                <p>Everything you need to manage your code efficiently</p>
            </div>
            <div class="feature-cards">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-code-branch"></i>
                    </div>
                    <h3>Version Control</h3>
                    <p>Track changes, compare versions, and never lose your work with built-in version history.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Collaboration</h3>
                    <p>Share repositories with team members, control access permissions, and work together seamlessly.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Powerful Search</h3>
                    <p>Instantly find code snippets with advanced search functionality across all your repositories.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure Storage</h3>
                    <p>Keep your code safe with encrypted storage and customizable privacy settings.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>How CodeHub Works</h2>
                <p>Simple, intuitive, and powerful</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Create an Account</h3>
                        <p>Sign up for free and set up your personal profile in seconds.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Create Repositories</h3>
                        <p>Organize your code into repositories with custom visibility settings.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Add Code Snippets</h3>
                        <p>Upload files or create snippets directly with our powerful editor.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Collaborate and Share</h3>
                        <p>Invite teammates, manage permissions, and work together efficiently.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="demo" class="demo">
        <div class="container">
            <div class="demo-content">
                <h2>See CodeHub in Action</h2>
                <p>Watch how CodeHub can transform your development workflow</p>
                <div class="demo-video">
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-header">
                <h2>Simple, Transparent Pricing</h2>
                <p>Choose the plan that's right for you</p>
            </div>
            <div class="pricing-cards">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Free</h3>
                        <div class="pricing-price">
                            <span class="price">$0</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Unlimited public repositories</li>
                        <li><i class="fas fa-check"></i> 3 private repositories</li>
                        <li><i class="fas fa-check"></i> Basic collaboration tools</li>
                        <li><i class="fas fa-check"></i> 500MB storage</li>
                    </ul>
                    <a href="Frontend/register.php" class="btn btn-outline btn-block">Get Started</a>
                </div>
                <div class="pricing-card featured">
                    <div class="pricing-badge">Popular</div>
                    <div class="pricing-header">
                        <h3>Pro</h3>
                        <div class="pricing-price">
                            <span class="price">$9.99</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Unlimited public repositories</li>
                        <li><i class="fas fa-check"></i> Unlimited private repositories</li>
                        <li><i class="fas fa-check"></i> Advanced collaboration tools</li>
                        <li><i class="fas fa-check"></i> 10GB storage</li>
                        <li><i class="fas fa-check"></i> Priority support</li>
                    </ul>
                    <a href="Frontend/register.php?plan=pro" class="btn btn-primary btn-block">Get Started</a>
                </div>
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Team</h3>
                        <div class="pricing-price">
                            <span class="price">$29.99</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> All Pro features</li>
                        <li><i class="fas fa-check"></i> Team management dashboard</li>
                        <li><i class="fas fa-check"></i> Advanced permissions</li>
                        <li><i class="fas fa-check"></i> 100GB storage</li>
                        <li><i class="fas fa-check"></i> 24/7 dedicated support</li>
                    </ul>
                    <a href="Frontend/register.php?plan=team" class="btn btn-outline btn-block">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Get Started?</h2>
                <p>Join thousands of developers who trust CodeHub for their code management needs.</p>
                <a href="Frontend/register.php" class="btn btn-primary btn-large">Sign Up for Free</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php">
                        <i class="fas fa-code"></i> CodeHub
                    </a>
                    <p>Store, share, and collaborate on code snippets and repositories.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Product</h4>
                        <ul>
                            <li><a href="#features">Features</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">API</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Legal</h4>
                        <ul>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Security</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="social-links">
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                </div>
                <p>&copy; 2025 CodeHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
    }
    document.addEventListener('click', function(event) {
        if (navMenu && navMenu.classList.contains('active') && 
            !event.target.closest('.nav-menu') && 
            !event.target.closest('.menu-toggle')) {
            navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });

    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
   
                if (navMenu && navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
                
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    const demoVideo = document.querySelector('.demo-video');
    if (demoVideo) {
        demoVideo.addEventListener('click', function() {
            alert('Demo video would play here in a real implementation');
        });
    }
    

    const header = document.querySelector('header');
    const navbar = document.querySelector('.navbar');
    
    if (header && navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.classList.add('fixed');
            } else {
                navbar.classList.remove('fixed');
            }
        });
    }

    const animateElements = document.querySelectorAll('.feature-card, .step, .pricing-card');
    
    function checkScroll() {
        animateElements.forEach(element => {
            const elementPosition = element.getBoundingClientRect();
            const screenHeight = window.innerHeight;
            
            if (elementPosition.top < screenHeight * 0.9) {
                element.classList.add('animate');
            }
        });
    }
    

    window.addEventListener('load', checkScroll);
    

    window.addEventListener('scroll', checkScroll);
    

    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            
            if (emailInput && emailInput.value.trim() === '') {
                alert('Please enter your email address');
                return;
            }

            alert('Thank you for subscribing!');
            emailInput.value = '';
        });
    }
});
    </script>

</body>
</html>
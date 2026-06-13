<?php
require_once __DIR__ . '/error_handler.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Su Myat Noe - Software Developer Portfolio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Preconnect for faster loading -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="100">
    <!-- Skip Link for Accessibility -->
    <a href="#home" class="skip-link">Skip to main content</a>
    
    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
    </button>
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section d-flex align-items-center">
        <div class="hero-bg"></div>
        <div class="hero-particles" id="particles"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <p class="hero-greeting">Hello, I'm</p>
                        <h1 class="hero-name" id="typewriter"></h1>
                        <p class="hero-title">Software Developer</p>
                        <p class="hero-description">
                            Software Developer experienced in PHP, C#, .NET, SQL Server, and MySQL, with a strong interest in software architecture and problem-solving.
                        </p>
                        <div class="hero-buttons">
                            <a href="#projects" class="btn btn-primary btn-lg">View My Work</a>
                            <a href="#contact" class="btn btn-outline-light btn-lg">Get In Touch</a>
                            <a href="SuMyatNoe.pdf" class="btn btn-outline-light btn-lg" download><i class="fas fa-download me-2"></i>CV</a>
                        </div>
                        <div class="hero-social mt-4">
                            <a href="https://github.com/SuMyatNoe148" class="social-link" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="https://linkedin.com/in/su-myat-noe-399aa0415" class="social-link" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="mailto:sumyatnoe3878@gmail.com" class="social-link"><i class="fas fa-envelope"></i></a>
                            <a href="tel:+959782846436" class="social-link"><i class="fas fa-phone"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-wrapper">
                        <div class="hero-image">
                            <img src="su.png" alt="Su Myat Noe Profile" class="img-fluid">
                        </div>
                        <div class="floating-card card-1">
                            <i class="fas fa-code"></i>
                            <span>Clean Architecture</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fas fa-layer-group"></i>
                            <span>Full Stack Dev</span>
                        </div>
                        <div class="floating-card card-3">
                            <i class="fas fa-users"></i>
                            <span>Team Leader</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <a href="#about">
                <div class="mouse">
                    <div class="wheel"></div>
                </div>
                <span class="scroll-text">Scroll Down</span>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section section-padding">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-subtitle">Get To Know Me</span>
                <h2 class="section-title">About Me</h2>
                <div class="section-line"></div>
            </div>
            <div class="row align-items-center mt-5">
                <div class="col-lg-5 reveal-left">
                    <div class="about-image-wrapper">
                        <div class="about-image">
                            <img src="su.png" alt="Su Myat Noe" class="img-fluid">
                        </div>
                        <div class="experience-badge">
                            <span class="years">3+</span>
                            <span class="text">Years<br>Teaching</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-5 reveal-right">
                    <div class="about-content">
                        <h3>I'm a Software Developer with Passion for Clean Architecture</h3>
                        <p>
                            Software Developer experienced in PHP, C#, .NET, SQL Server, and MySQL, with a strong interest in 
                            software architecture and problem-solving. I specialize in building robust applications using 
                            Clean Architecture and Domain-Driven Design principles.
                        </p>
                        <p>
                            Throughout my academic journey and professional experience, I've served as Project Leader for 
                            software development projects and was an Executive Committee member throughout university years, 
                            demonstrating strong leadership and collaboration skills.
                        </p>
                        <div class="about-stats row">
                            <div class="col-4">
                                <div class="stat-item reveal-scale reveal-delay-1">
                                    <h4 class="counter" data-target="4">0</h4>
                                    <p>Projects Completed</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item reveal-scale reveal-delay-2">
                                    <h4 class="counter" data-target="3">0</h4>
                                    <p>Years Teaching</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item reveal-scale reveal-delay-3">
                                    <h4 class="counter" data-target="10">0</h4>
                                    <p>Technical Skills</p>
                                </div>
                            </div>
                        </div>
                        <a href="SuMyatNoe.pdf" class="btn btn-primary mt-4 reveal reveal-delay-4" download>Download CV <i class="fas fa-download ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills-section section-padding bg-light">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-subtitle">My Expertise</span>
                <h2 class="section-title">Skills & Technologies</h2>
                <div class="section-line"></div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 reveal-left">
                    <div class="skills-content">
                        <h3>Technical Proficiency</h3>
                        <p>
                            Proficient in backend development with PHP, C#, and .NET. Strong database skills with MySQL and SQL Server. 
                            Experienced in Clean Architecture, Domain-Driven Design (DDD), and MVC patterns. Passionate about 
                            writing clean, maintainable code.
                        </p>
                        <div class="skill-bars">
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name">PHP</span>
                                    <span class="skill-percent">90%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" data-width="90"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name">C# / .NET</span>
                                    <span class="skill-percent">85%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" data-width="85"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name">MySQL / SQL Server</span>
                                    <span class="skill-percent">88%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" data-width="88"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name">JavaScript</span>
                                    <span class="skill-percent">80%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" data-width="80"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal-right">
                    <div class="skills-grid">
                        <div class="skill-card reveal-scale reveal-delay-1">
                            <i class="fab fa-php"></i>
                            <span>PHP</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-2">
                            <i class="fas fa-code"></i>
                            <span>C#</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-3">
                            <i class="fab fa-microsoft"></i>
                            <span>.NET</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-4">
                            <i class="fas fa-database"></i>
                            <span>MySQL</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-5">
                            <i class="fas fa-server"></i>
                            <span>SQL Server</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-1">
                            <i class="fab fa-js"></i>
                            <span>JavaScript</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-2">
                            <i class="fab fa-git-alt"></i>
                            <span>Git & GitHub</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-3">
                            <i class="fas fa-layer-group"></i>
                            <span>MVC</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-4">
                            <i class="fas fa-sitemap"></i>
                            <span>Clean Architecture</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-5">
                            <i class="fas fa-project-diagram"></i>
                            <span>DDD</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-1">
                            <i class="fab fa-html5"></i>
                            <span>HTML5</span>
                        </div>
                        <div class="skill-card reveal-scale reveal-delay-2">
                            <i class="fab fa-css3-alt"></i>
                            <span>CSS3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience-section section-padding">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-subtitle">My Journey</span>
                <h2 class="section-title">Experience & Education</h2>
                <div class="section-line"></div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 reveal-left">
                    <div class="timeline-wrapper">
                        <h3 class="timeline-title"><i class="fas fa-briefcase"></i> Work Experience</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <span class="timeline-date">Present</span>
                                    <h4>IT Camp Trainee</h4>
                                    <p class="timeline-company">IT Vision Hub</p>
                                    <p>Participating in software development training. Enhancing programming and teamwork skills.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <span class="timeline-date">Previous</span>
                                    <h4>Computer Instructor</h4>
                                    <p class="timeline-company">Teaching Institute</p>
                                    <p>Taught computer fundamentals and software applications. Assisted students with practical learning activities.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <span class="timeline-date">3 Years</span>
                                    <h4>Teacher</h4>
                                    <p class="timeline-company">Educational Institution</p>
                                    <p>Delivered lessons and mentored students. Developed strong communication and leadership skills.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal-right">
                    <div class="timeline-wrapper">
                        <h3 class="timeline-title"><i class="fas fa-graduation-cap"></i> Education</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <span class="timeline-date">Current</span>
                                    <h4>Software Engineer Trainee</h4>
                                    <p class="timeline-company">IT Vision Hub</p>
                                    <p>Currently training in software development and enhancing programming skills.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <span class="timeline-date">Completed</span>
                                    <h4>Bachelor Of Computer Science</h4>
                                    <p class="timeline-company">Dagon University</p>
                                    <p>Graduated with focus on software development and computer science fundamentals.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <span class="timeline-date">University</span>
                                    <h4>Executive Committee Member</h4>
                                    <p class="timeline-company">Student Organization</p>
                                    <p>EC member throughout university years. Coordinated project planning, task management, and organized academic activities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects-section section-padding bg-light">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-subtitle">My Portfolio</span>
                <h2 class="section-title">Featured Projects</h2>
                <div class="section-line"></div>
            </div>
            <div class="project-filters text-center mt-4 reveal">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="web">Web App</button>
                <button class="filter-btn" data-filter="desktop">Desktop</button>
            </div>
            <div class="row project-grid mt-5">
                <div class="col-lg-4 col-md-6 project-item reveal" data-category="web">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="media_library.png" alt="Media Library System" class="img-fluid">
                            <div class="project-overlay">
                                <a href="https://github.com/SuMyatNoe148" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Web App</span>
                            <h4>Media Library System</h4>
                            <p>Digital media management platform with authentication, notifications, and Stripe payment integration. Built with PHP, MySQL, JavaScript.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 project-item reveal reveal-delay-1" data-category="web">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="EMS.png" alt="Employee Management System" class="img-fluid">
                            <div class="project-overlay">
                                <a href="https://github.com/SuMyatNoe148" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">ASP.Net</span>
                            <h4>Employee Management System</h4>
                            <p>Employee management platform with CRUD operations, user management, and reporting features. Built with ASP.NET, SQL Management Studio, JavaScript.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 project-item reveal reveal-delay-2" data-category="web">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="CSRB.png" alt="CS Reference Book" class="img-fluid">
                            <div class="project-overlay">
                                <a href="https://github.com/SuMyatNoe148" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Web App</span>
                            <h4>CS Reference Book</h4>
                            <p>Educational platform for organizing and accessing computer science learning resources. Built with PHP, MySQL.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 project-item reveal reveal-delay-3" data-category="desktop">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="https://via.placeholder.com/400x300/10b981/ffffff?text=IQ+Testing" alt="IQ Testing System" class="img-fluid">
                            <div class="project-overlay">
                                <a href="https://github.com/SuMyatNoe148" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Desktop App</span>
                            <h4>IQ Testing System</h4>
                            <p>Desktop application for timed IQ assessments, automatic scoring, and report generation. Built with C#, WinForms, SQL Server.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <!-- TODO: Add real client reviews later
    <section class="testimonials-section section-padding">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-subtitle">Client Feedback</span>
                <h2 class="section-title">What People Say</h2>
                <div class="section-line"></div>
            </div>
            <div class="row mt-5 justify-content-center reveal-scale">
                <div class="col-lg-8">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonial-card text-center">
                                    <div class="testimonial-image">
                                        <img src="https://via.placeholder.com/100x100/6366f1/ffffff?text=Client" alt="Client" class="rounded-circle">
                                    </div>
                                    <div class="testimonial-content">
                                        <p>"Exceptional work! The attention to detail and ability to understand our requirements made the project a huge success. Highly recommended!"</p>
                                        <h5>John Smith</h5>
                                        <span>CEO, Tech Startup</span>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card text-center">
                                    <div class="testimonial-image">
                                        <img src="https://via.placeholder.com/100x100/8b5cf6/ffffff?text=Client" alt="Client" class="rounded-circle">
                                    </div>
                                    <div class="testimonial-content">
                                        <p>"Working with this developer was a game-changer for our business. Professional, skilled, and always delivers on time."</p>
                                        <h5>Sarah Johnson</h5>
                                        <span>Marketing Director</span>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card text-center">
                                    <div class="testimonial-image">
                                        <img src="https://via.placeholder.com/100x100/ec4899/ffffff?text=Client" alt="Client" class="rounded-circle">
                                    </div>
                                    <div class="testimonial-content">
                                        <p>"The best developer we've worked with. Creative solutions, clean code, and excellent communication throughout the project."</p>
                                        <h5>Michael Chen</h5>
                                        <span>Product Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->

    <!-- Contact Section -->
    <section id="contact" class="contact-section section-padding bg-dark text-white">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-subtitle">Get In Touch</span>
                <h2 class="section-title text-white">Contact Me</h2>
                <div class="section-line bg-white"></div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 reveal-left">
                    <div class="contact-info">
                        <h3>Let's Talk About Your Project</h3>
                        <p>I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.</p>
                        <div class="contact-details">
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="info">
                                    <h5>Location</h5>
                                    <p>21/460, Aung Zay Yone St, Shwe Pauk Kan, Myanmar</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div class="info">
                                    <h5>Email</h5>
                                    <p>sumyatnoe3878@gmail.com</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-phone"></i></div>
                                <div class="info">
                                    <h5>Phone</h5>
                                    <p>+959 7828 46436</p>
                                </div>
                            </div>
                        </div>
                        <div class="social-links mt-4">
                            <a href="https://github.com/SuMyatNoe148" class="social-btn" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="https://linkedin.com/in/su-myat-noe-399aa0415" class="social-btn" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="mailto:sumyatnoe3878@gmail.com" class="social-btn"><i class="fas fa-envelope"></i></a>
                            <a href="tel:+959782846436" class="social-btn"><i class="fas fa-phone"></i></a>
                        </div>
                        <a href="SuMyatNoe.pdf" class="btn btn-outline-light mt-4" download><i class="fas fa-download me-2"></i>Download My CV</a>
                    </div>
                </div>
                <div class="col-lg-7 reveal-right">
                    <div class="contact-form-wrapper">
                        <form id="contactForm" class="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject" name="subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Your Message" name="message" required></textarea>
                            </div>
                            <div id="formMsg" class="mb-3" style="display:none;"></div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-darker text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 Su Myat Noe. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Built with <i class="fas fa-heart text-danger"></i> by Su Myat Noe</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>

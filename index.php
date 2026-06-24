<?php
require_once __DIR__ . '/error_handler.php';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/partials/social_links.php';
require_once __DIR__ . '/includes/partials/section_header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/includes/partials/head.php'; ?>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="100">
    <?php include __DIR__ . '/includes/partials/navbar.php'; ?>

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
                        <p class="hero-title"><?= htmlspecialchars($siteConfig['title']) ?></p>
                        <p class="hero-description">
                            Software Developer experienced in PHP, C#, .NET, SQL Server, and MySQL, with a strong interest in software architecture and problem-solving.
                        </p>
                        <div class="hero-buttons">
                            <a href="#projects" class="btn btn-primary btn-lg">View My Work</a>
                            <a href="#contact" class="btn btn-outline-light btn-lg">Get In Touch</a>
                            <a href="<?= htmlspecialchars($siteConfig['cv_file']) ?>" class="btn btn-outline-light btn-lg" download><i class="fas fa-download me-2"></i>CV</a>
                        </div>
                        <div class="hero-social mt-4">
                            <?= renderSocialLinks($socialLinks, 'social-link') ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-wrapper">
                        <div class="hero-image">
                            <img src="<?= htmlspecialchars($siteConfig['profile_image']) ?>" alt="<?= htmlspecialchars($siteConfig['name']) ?> Profile" class="img-fluid">
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
            <?= renderSectionHeader('Get To Know Me', 'About Me') ?>
            <div class="row align-items-center mt-5">
                <div class="col-lg-5 reveal-left">
                    <div class="about-image-wrapper">
                        <div class="about-image">
                            <img src="<?= htmlspecialchars($siteConfig['profile_image']) ?>" alt="<?= htmlspecialchars($siteConfig['name']) ?>" class="img-fluid">
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
                            <?php foreach ($stats as $i => $stat): ?>
                            <div class="col-4">
                                <div class="stat-item reveal-scale reveal-delay-<?= $i + 1 ?>">
                                    <h4 class="counter" data-target="<?= $stat['target'] ?>">0</h4>
                                    <p><?= htmlspecialchars($stat['label']) ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?= htmlspecialchars($siteConfig['cv_file']) ?>" class="btn btn-primary mt-4 reveal reveal-delay-4" download>Download CV <i class="fas fa-download ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills-section section-padding bg-light">
        <div class="container">
            <?= renderSectionHeader('My Expertise', 'Skills & Technologies') ?>
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
                            <?php foreach ($skills as $skill): ?>
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name"><?= htmlspecialchars($skill['name']) ?></span>
                                    <span class="skill-percent"><?= $skill['percent'] ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" data-width="<?= $skill['percent'] ?>"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal-right">
                    <div class="skills-grid">
                        <?php foreach ($skillCards as $i => $card): ?>
                        <div class="skill-card reveal-scale reveal-delay-<?= ($i % 5) + 1 ?>">
                            <i class="<?= htmlspecialchars($card['icon']) ?>"></i>
                            <span><?= htmlspecialchars($card['name']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience-section section-padding">
        <div class="container">
            <?= renderSectionHeader('My Journey', 'Experience & Education') ?>
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
            <?= renderSectionHeader('My Portfolio', 'Featured Projects') ?>
            <div class="project-filters text-center mt-4 reveal">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="web">Web App</button>
                <button class="filter-btn" data-filter="desktop">Desktop</button>
            </div>
            <div class="row project-grid mt-5">
                <?php foreach ($projects as $i => $project): ?>
                <div class="col-lg-4 col-md-6 project-item reveal<?= $i > 0 ? ' reveal-delay-' . $i : '' ?>" data-category="<?= htmlspecialchars($project['category']) ?>">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['alt']) ?>" class="img-fluid">
                            <div class="project-overlay">
                                <a href="<?= htmlspecialchars($project['link']) ?>" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category"><?= htmlspecialchars($project['label']) ?></span>
                            <h4><?= $project['title'] ?></h4>
                            <p><?= htmlspecialchars($project['desc']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section section-padding bg-dark text-white">
        <div class="container">
            <?= renderSectionHeader('Get In Touch', 'Contact Me', 'text-white') ?>
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
                                    <p><?= htmlspecialchars($siteConfig['address']) ?></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div class="info">
                                    <h5>Email</h5>
                                    <p><?= htmlspecialchars($siteConfig['email']) ?></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-phone"></i></div>
                                <div class="info">
                                    <h5>Phone</h5>
                                    <p><?= htmlspecialchars($siteConfig['phone_display']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="social-links mt-4">
                            <?= renderSocialLinks($socialLinks, 'social-btn') ?>
                        </div>
                        <a href="<?= htmlspecialchars($siteConfig['cv_file']) ?>" class="btn btn-outline-light mt-4" download><i class="fas fa-download me-2"></i>Download My CV</a>
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

    <?php include __DIR__ . '/includes/partials/footer.php'; ?>
</body>
</html>

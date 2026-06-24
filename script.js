// Portfolio Website JavaScript
// Modern, interactive functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initNavbar();
    initTypewriter();
    initParticles();
    initCounters();
    initSkillBars();
    initProjectFilter();
    initBackToTop();
    initSmoothScroll();
    initContactForm();
    initThemeToggle();
    initScrollReveal();
});

// Navbar scroll effect
function initNavbar() {
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// Typewriter effect for hero name
function initTypewriter() {
    const typewriterElement = document.getElementById('typewriter');
    const text = 'Su Myat Noe';
    let index = 0;
    
    function type() {
        if (index < text.length) {
            typewriterElement.textContent += text.charAt(index);
            index++;
            setTimeout(type, 100);
        }
    }
    
    // Start typing after a short delay
    setTimeout(type, 500);
}

// Create floating particles
function initParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 30;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 20 + 's';
        particle.style.animationDuration = (15 + Math.random() * 10) + 's';
        particle.style.opacity = Math.random() * 0.5;
        particle.style.width = (5 + Math.random() * 10) + 'px';
        particle.style.height = particle.style.width;
        particlesContainer.appendChild(particle);
    }
}

// Animate counters
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    
    const observerOptions = {
        threshold: 0.5
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                animateCounter(counter, target);
                observer.unobserve(counter);
            }
        });
    }, observerOptions);
    
    counters.forEach(counter => observer.observe(counter));
}

function animateCounter(element, target) {
    let current = 0;
    const increment = target / 50;
    
    const updateCounter = () => {
        if (current < target) {
            current += increment;
            element.textContent = Math.ceil(current) + '+';
            setTimeout(updateCounter, 30);
        } else {
            element.textContent = target + '+';
        }
    };
    
    updateCounter();
}

// Animate skill bars
function initSkillBars() {
    const skillBars = document.querySelectorAll('.progress-bar');
    
    const observerOptions = {
        threshold: 0.5
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const width = bar.getAttribute('data-width');
                bar.style.width = width + '%';
                observer.unobserve(bar);
            }
        });
    }, observerOptions);
    
    skillBars.forEach(bar => observer.observe(bar));
}

// Project filter functionality
function initProjectFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            projectItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.5s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}

// Back to top button
function initBackToTop() {
    const backToTopBtn = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 500) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    backToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Smooth scroll for anchor links
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Contact form handling
function initContactForm() {
    const contactForm = document.getElementById('contactForm');
    const formMsg = document.getElementById('formMsg');
    const submitBtn = contactForm.querySelector('button[type="submit"]');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        submitBtn.disabled = true;
        formMsg.style.display = 'none';

        const formData = new FormData(contactForm);

        fetch('contact.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            formMsg.style.display = 'block';
            if (data.success) {
                formMsg.className = 'mb-3 alert alert-success';
                formMsg.textContent = data.message;
                contactForm.reset();
            } else {
                formMsg.className = 'mb-3 alert alert-danger';
                formMsg.textContent = data.message;
            }
        })
        .catch(() => {
            formMsg.style.display = 'block';
            formMsg.className = 'mb-3 alert alert-danger';
            formMsg.textContent = 'Something went wrong. Please try again.';
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
}

// Theme Toggle functionality
function initThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const icon = themeToggle.querySelector('i');
    
    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        html.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme, icon);
    }
    
    themeToggle.addEventListener('click', function() {
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme, icon);
    });
}

function updateThemeIcon(theme, icon) {
    if (theme === 'dark') {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }
}

// Scroll Reveal Animation
function initScrollReveal() {
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
    
    const revealOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const revealObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                revealObserver.unobserve(entry.target);
            }
        });
    }, revealOptions);
    
    revealElements.forEach(el => revealObserver.observe(el));
}

// Add CSS animation for project filter
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);

// Export for testing (Node.js / Jest)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initNavbar,
        initTypewriter,
        initParticles,
        initCounters,
        animateCounter,
        initSkillBars,
        initProjectFilter,
        initBackToTop,
        initSmoothScroll,
        initContactForm,
        initThemeToggle,
        updateThemeIcon,
        initScrollReveal
    };
}

// Portfolio Website JavaScript
// Modern, interactive functionality

document.addEventListener('DOMContentLoaded', function() {
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

// Shared utility: observe elements and fire a one-shot callback on intersection
function observeOnce(selector, options, callback) {
    var elements = document.querySelectorAll(selector);
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                callback(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, options);
    elements.forEach(function(el) { observer.observe(el); });
}

// Navbar scroll effect
function initNavbar() {
    var navbar = document.querySelector('.navbar');
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
    var typewriterElement = document.getElementById('typewriter');
    var text = 'Su Myat Noe';
    var index = 0;

    function type() {
        if (index < text.length) {
            typewriterElement.textContent += text.charAt(index);
            index++;
            setTimeout(type, 100);
        }
    }

    setTimeout(type, 500);
}

// Create floating particles
function initParticles() {
    var particlesContainer = document.getElementById('particles');
    var particleCount = 30;

    for (var i = 0; i < particleCount; i++) {
        var particle = document.createElement('div');
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
    observeOnce('.counter', { threshold: 0.5 }, function(el) {
        var target = parseInt(el.getAttribute('data-target'));
        animateCounter(el, target);
    });
}

function animateCounter(element, target) {
    var current = 0;
    var increment = target / 50;

    var updateCounter = function() {
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
    observeOnce('.progress-bar', { threshold: 0.5 }, function(bar) {
        var width = bar.getAttribute('data-width');
        bar.style.width = width + '%';
    });
}

// Project filter functionality
function initProjectFilter() {
    var filterBtns = document.querySelectorAll('.filter-btn');
    var projectItems = document.querySelectorAll('.project-item');

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');

            var filter = this.getAttribute('data-filter');

            projectItems.forEach(function(item) {
                var category = item.getAttribute('data-category');
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
    var backToTopBtn = document.getElementById('backToTop');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 500) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });

    backToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Smooth scroll for anchor links
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                var offsetTop = target.offsetTop - 80;
                window.scrollTo({ top: offsetTop, behavior: 'smooth' });
            }
        });
    });
}

// Contact form handling
function initContactForm() {
    var contactForm = document.getElementById('contactForm');
    var formMsg = document.getElementById('formMsg');
    var submitBtn = contactForm.querySelector('button[type="submit"]');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        var originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        submitBtn.disabled = true;
        formMsg.style.display = 'none';

        var formData = new FormData(contactForm);

        fetch('contact.php', {
            method: 'POST',
            body: formData
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
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
        .catch(function() {
            formMsg.style.display = 'block';
            formMsg.className = 'mb-3 alert alert-danger';
            formMsg.textContent = 'Something went wrong. Please try again.';
        })
        .finally(function() {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
}

// Theme Toggle functionality
function initThemeToggle() {
    var themeToggle = document.getElementById('themeToggle');
    var html = document.documentElement;
    var icon = themeToggle.querySelector('i');

    var savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        html.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme, icon);
    }

    themeToggle.addEventListener('click', function() {
        var currentTheme = html.getAttribute('data-theme');
        var newTheme = currentTheme === 'dark' ? 'light' : 'dark';

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
    observeOnce('.reveal, .reveal-left, .reveal-right, .reveal-scale',
        { threshold: 0.15, rootMargin: '0px 0px -50px 0px' },
        function(el) { el.classList.add('active'); }
    );
}

// CSS animation for project filter
var style = document.createElement('style');
style.textContent = '\
    @keyframes fadeInUp {\
        from { opacity: 0; transform: translateY(20px); }\
        to   { opacity: 1; transform: translateY(0); }\
    }\
';
document.head.appendChild(style);

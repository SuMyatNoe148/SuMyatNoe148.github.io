/**
 * Unit tests for script.js — Portfolio Website JavaScript
 *
 * Covers every exported module:
 *   initNavbar, initTypewriter, initParticles, initCounters,
 *   animateCounter, initSkillBars, initProjectFilter, initBackToTop,
 *   initSmoothScroll, initContactForm, initThemeToggle,
 *   updateThemeIcon, initScrollReveal
 */

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------

/** Build a minimal DOM that satisfies every init* function. */
function buildDOM() {
    document.body.innerHTML = `
        <nav class="navbar"></nav>
        <span id="typewriter"></span>
        <div id="particles"></div>

        <span class="counter" data-target="100"></span>
        <span class="counter" data-target="50"></span>

        <div class="progress-bar" data-width="80"></div>
        <div class="progress-bar" data-width="60"></div>

        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="web">Web</button>
        <button class="filter-btn" data-filter="mobile">Mobile</button>
        <div class="project-item" data-category="web"></div>
        <div class="project-item" data-category="mobile"></div>
        <div class="project-item" data-category="web"></div>

        <a href="#" id="backToTop"></a>

        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <section id="about" style="position:relative;top:0;"></section>
        <section id="contact" style="position:relative;top:0;"></section>

        <form id="contactForm">
            <input name="name" value="Test" />
            <input name="email" value="test@example.com" />
            <textarea name="message">Hello</textarea>
            <button type="submit"><i class="fas fa-paper-plane me-2"></i>Send</button>
        </form>
        <div id="formMsg" style="display:none;"></div>

        <button id="themeToggle"><i class="fa-moon"></i></button>

        <div class="reveal"></div>
        <div class="reveal-left"></div>
        <div class="reveal-right"></div>
        <div class="reveal-scale"></div>
    `;
}

// ---------------------------------------------------------------------------
// Mock IntersectionObserver (jsdom doesn't support it)
// ---------------------------------------------------------------------------

let intersectionCallbacks = [];

class MockIntersectionObserver {
    constructor(callback, options) {
        this.callback = callback;
        this.options = options;
        this.elements = [];
        intersectionCallbacks.push(this);
    }
    observe(el) {
        this.elements.push(el);
    }
    unobserve() {}
    disconnect() {}
    /** Helper to simulate all observed elements becoming visible. */
    triggerAll() {
        const entries = this.elements.map(el => ({
            isIntersecting: true,
            target: el,
        }));
        this.callback(entries, this);
    }
}

beforeAll(() => {
    global.IntersectionObserver = MockIntersectionObserver;
});

// ---------------------------------------------------------------------------
// Load script.js (after DOM & mocks are ready)
// ---------------------------------------------------------------------------

let mod; // module exports

beforeEach(() => {
    jest.useFakeTimers();
    intersectionCallbacks = [];
    buildDOM();

    // localStorage mock (reset between tests)
    const store = {};
    jest.spyOn(Storage.prototype, 'getItem').mockImplementation(k => store[k] ?? null);
    jest.spyOn(Storage.prototype, 'setItem').mockImplementation((k, v) => { store[k] = v; });

    // Reset module cache so each test gets a fresh load
    jest.resetModules();
    mod = require('../script');
});

afterEach(() => {
    jest.useRealTimers();
    jest.restoreAllMocks();
});

// ======================= DOMContentLoaded bootstrap ========================

describe('DOMContentLoaded bootstrap', () => {
    test('calls all init functions when DOMContentLoaded fires', () => {
        // Re-build DOM fresh, then re-require so the top-level listener registers
        jest.resetModules();
        intersectionCallbacks = [];
        buildDOM();

        // Spy on init functions by intercepting the module load
        // The DOMContentLoaded listener calls all init* functions
        // We verify by dispatching the event and checking side effects

        // First, require the module (registers the listener)
        require('../script');

        // Dispatch DOMContentLoaded
        document.dispatchEvent(new Event('DOMContentLoaded'));

        // Verify side effects: particles should be created, observers registered, etc.
        expect(document.getElementById('particles').children.length).toBeGreaterThanOrEqual(30);
        // At least one IntersectionObserver should have been created
        expect(intersectionCallbacks.length).toBeGreaterThanOrEqual(1);
    });
});

// ============================= initNavbar ==================================

describe('initNavbar', () => {
    test('adds "scrolled" class when scrollY > 50', () => {
        mod.initNavbar();
        Object.defineProperty(window, 'scrollY', { value: 100, writable: true });
        window.dispatchEvent(new Event('scroll'));
        expect(document.querySelector('.navbar').classList.contains('scrolled')).toBe(true);
    });

    test('removes "scrolled" class when scrollY <= 50', () => {
        mod.initNavbar();
        const navbar = document.querySelector('.navbar');
        navbar.classList.add('scrolled');

        Object.defineProperty(window, 'scrollY', { value: 20, writable: true });
        window.dispatchEvent(new Event('scroll'));
        expect(navbar.classList.contains('scrolled')).toBe(false);
    });

    test('does not add "scrolled" at exactly 50', () => {
        mod.initNavbar();
        Object.defineProperty(window, 'scrollY', { value: 50, writable: true });
        window.dispatchEvent(new Event('scroll'));
        expect(document.querySelector('.navbar').classList.contains('scrolled')).toBe(false);
    });
});

// =========================== initTypewriter ================================

describe('initTypewriter', () => {
    test('types "Su Myat Noe" character by character', () => {
        mod.initTypewriter();
        const el = document.getElementById('typewriter');

        // Initial delay 500 ms
        jest.advanceTimersByTime(500);
        expect(el.textContent).toBe('S');

        // Each character takes 100 ms
        for (let i = 1; i < 11; i++) {
            jest.advanceTimersByTime(100);
        }
        expect(el.textContent).toBe('Su Myat Noe');
    });

    test('stops after full text is typed', () => {
        mod.initTypewriter();
        const el = document.getElementById('typewriter');
        jest.advanceTimersByTime(500 + 100 * 20); // way past full text
        expect(el.textContent).toBe('Su Myat Noe');
    });
});

// =========================== initParticles =================================

describe('initParticles', () => {
    test('creates 30 particle elements', () => {
        mod.initParticles();
        const container = document.getElementById('particles');
        expect(container.children.length).toBe(30);
    });

    test('each particle has the "particle" class', () => {
        mod.initParticles();
        const particles = document.getElementById('particles').children;
        Array.from(particles).forEach(p => {
            expect(p.classList.contains('particle')).toBe(true);
        });
    });

    test('sets randomised inline styles on particles', () => {
        mod.initParticles();
        const p = document.getElementById('particles').children[0];
        expect(p.style.left).toBeTruthy();
        expect(p.style.animationDelay).toBeTruthy();
        expect(p.style.animationDuration).toBeTruthy();
        expect(p.style.width).toBeTruthy();
        expect(p.style.height).toBe(p.style.width);
    });
});

// =========================== initCounters ==================================

describe('initCounters', () => {
    test('registers an IntersectionObserver for each .counter', () => {
        mod.initCounters();
        const obs = intersectionCallbacks.find(o => o.elements.length === 2);
        expect(obs).toBeDefined();
        expect(obs.options.threshold).toBe(0.5);
    });

    test('animates counters when they become visible', () => {
        mod.initCounters();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('counter'))
        );
        obs.triggerAll();
        jest.runAllTimers();

        const counters = document.querySelectorAll('.counter');
        expect(counters[0].textContent).toBe('100+');
        expect(counters[1].textContent).toBe('50+');
    });

    test('ignores non-intersecting entries', () => {
        mod.initCounters();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('counter'))
        );
        // Simulate a non-intersecting entry
        obs.callback([{ isIntersecting: false, target: obs.elements[0] }], obs);
        jest.runAllTimers();

        expect(obs.elements[0].textContent).toBe('');
    });
});

// =========================== animateCounter ================================

describe('animateCounter', () => {
    test('animates element text from 0 to target+"+"', () => {
        const el = document.createElement('span');
        mod.animateCounter(el, 100);

        // Run all pending timers to complete animation
        jest.runAllTimers();
        expect(el.textContent).toBe('100+');
    });

    test('works with small target value', () => {
        const el = document.createElement('span');
        mod.animateCounter(el, 5);
        jest.runAllTimers();
        expect(el.textContent).toBe('5+');
    });

    test('intermediate values include "+"', () => {
        const el = document.createElement('span');
        mod.animateCounter(el, 100);

        // After first tick (30 ms) we should have an intermediate value
        jest.advanceTimersByTime(30);
        expect(el.textContent).toMatch(/^\d+\+$/);
    });
});

// =========================== initSkillBars =================================

describe('initSkillBars', () => {
    test('registers observer for .progress-bar elements', () => {
        mod.initSkillBars();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('progress-bar'))
        );
        expect(obs).toBeDefined();
        expect(obs.elements.length).toBe(2);
    });

    test('sets width on intersection', () => {
        mod.initSkillBars();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('progress-bar'))
        );
        obs.triggerAll();
        expect(obs.elements[0].style.width).toBe('80%');
        expect(obs.elements[1].style.width).toBe('60%');
    });
});

// ========================== initProjectFilter ==============================

describe('initProjectFilter', () => {
    test('shows all items when "all" filter is clicked', () => {
        mod.initProjectFilter();
        const allBtn = document.querySelector('[data-filter="all"]');
        allBtn.click();
        document.querySelectorAll('.project-item').forEach(item => {
            expect(item.style.display).toBe('block');
        });
    });

    test('filters to "web" items only', () => {
        mod.initProjectFilter();
        const webBtn = document.querySelector('[data-filter="web"]');
        webBtn.click();

        const items = document.querySelectorAll('.project-item');
        expect(items[0].style.display).toBe('block');   // web
        expect(items[1].style.display).toBe('none');     // mobile
        expect(items[2].style.display).toBe('block');    // web
    });

    test('filters to "mobile" items only', () => {
        mod.initProjectFilter();
        const mobileBtn = document.querySelector('[data-filter="mobile"]');
        mobileBtn.click();

        const items = document.querySelectorAll('.project-item');
        expect(items[0].style.display).toBe('none');     // web
        expect(items[1].style.display).toBe('block');    // mobile
        expect(items[2].style.display).toBe('none');     // web
    });

    test('updates active class on filter buttons', () => {
        mod.initProjectFilter();
        const webBtn = document.querySelector('[data-filter="web"]');
        webBtn.click();

        expect(webBtn.classList.contains('active')).toBe(true);
        expect(document.querySelector('[data-filter="all"]').classList.contains('active')).toBe(false);
    });
});

// ============================ initBackToTop ================================

describe('initBackToTop', () => {
    test('shows button when scrollY > 500', () => {
        mod.initBackToTop();
        const btn = document.getElementById('backToTop');
        Object.defineProperty(window, 'scrollY', { value: 600, writable: true });
        window.dispatchEvent(new Event('scroll'));
        expect(btn.classList.contains('show')).toBe(true);
    });

    test('hides button when scrollY <= 500', () => {
        mod.initBackToTop();
        const btn = document.getElementById('backToTop');
        btn.classList.add('show');
        Object.defineProperty(window, 'scrollY', { value: 300, writable: true });
        window.dispatchEvent(new Event('scroll'));
        expect(btn.classList.contains('show')).toBe(false);
    });

    test('scrolls to top on click', () => {
        mod.initBackToTop();
        window.scrollTo = jest.fn();
        const btn = document.getElementById('backToTop');
        btn.click();
        expect(window.scrollTo).toHaveBeenCalledWith({ top: 0, behavior: 'smooth' });
    });
});

// ========================== initSmoothScroll ===============================

describe('initSmoothScroll', () => {
    test('scrolls to target section on anchor click', () => {
        mod.initSmoothScroll();
        window.scrollTo = jest.fn();
        const aboutLink = document.querySelector('a[href="#about"]');
        aboutLink.click();
        expect(window.scrollTo).toHaveBeenCalledWith(
            expect.objectContaining({ behavior: 'smooth' })
        );
    });

    test('does not throw for non-existent target', () => {
        // Add a link pointing to a missing section
        const bad = document.createElement('a');
        bad.href = '#nonexistent';
        document.body.appendChild(bad);

        mod.initSmoothScroll();
        expect(() => bad.click()).not.toThrow();
    });
});

// ========================== initContactForm ================================

// Helper: flush all pending microtasks (promises)
function flushPromises() {
    return new Promise(jest.requireActual('timers').setImmediate);
}

describe('initContactForm', () => {
    test('shows success message on successful submit', async () => {
        jest.useRealTimers();
        global.fetch = jest.fn().mockResolvedValue({
            json: () => Promise.resolve({ success: true, message: 'Sent!' }),
        });

        mod.initContactForm();
        document.getElementById('contactForm').dispatchEvent(new Event('submit', { cancelable: true }));

        await flushPromises();

        const msg = document.getElementById('formMsg');
        expect(msg.style.display).toBe('block');
        expect(msg.textContent).toBe('Sent!');
        expect(msg.className).toContain('alert-success');
    });

    test('shows error message on failed submit', async () => {
        jest.useRealTimers();
        global.fetch = jest.fn().mockResolvedValue({
            json: () => Promise.resolve({ success: false, message: 'Missing fields' }),
        });

        mod.initContactForm();
        document.getElementById('contactForm').dispatchEvent(new Event('submit', { cancelable: true }));

        await flushPromises();

        const msg = document.getElementById('formMsg');
        expect(msg.textContent).toBe('Missing fields');
        expect(msg.className).toContain('alert-danger');
    });

    test('shows generic error on network failure', async () => {
        jest.useRealTimers();
        global.fetch = jest.fn().mockRejectedValue(new Error('Network'));

        mod.initContactForm();
        document.getElementById('contactForm').dispatchEvent(new Event('submit', { cancelable: true }));

        await flushPromises();

        const msg = document.getElementById('formMsg');
        expect(msg.textContent).toBe('Something went wrong. Please try again.');
    });

    test('disables submit button while sending', () => {
        global.fetch = jest.fn().mockReturnValue(new Promise(() => {})); // never resolves

        mod.initContactForm();
        const btn = document.querySelector('#contactForm button[type="submit"]');
        document.getElementById('contactForm').dispatchEvent(new Event('submit', { cancelable: true }));

        expect(btn.disabled).toBe(true);
        expect(btn.innerHTML).toContain('Sending...');
    });

    test('re-enables submit button after completion', async () => {
        jest.useRealTimers();
        global.fetch = jest.fn().mockResolvedValue({
            json: () => Promise.resolve({ success: true, message: 'OK' }),
        });

        mod.initContactForm();
        const btn = document.querySelector('#contactForm button[type="submit"]');
        const original = btn.innerHTML;
        document.getElementById('contactForm').dispatchEvent(new Event('submit', { cancelable: true }));

        await flushPromises();

        expect(btn.disabled).toBe(false);
        expect(btn.innerHTML).toBe(original);
    });
});

// =========================== initThemeToggle ===============================

describe('initThemeToggle', () => {
    test('toggles theme from light to dark', () => {
        mod.initThemeToggle();
        const btn = document.getElementById('themeToggle');
        btn.click();

        expect(document.documentElement.getAttribute('data-theme')).toBe('dark');
        expect(localStorage.setItem).toHaveBeenCalledWith('theme', 'dark');
    });

    test('toggles theme from dark to light', () => {
        document.documentElement.setAttribute('data-theme', 'dark');
        mod.initThemeToggle();
        const btn = document.getElementById('themeToggle');
        btn.click();

        expect(document.documentElement.getAttribute('data-theme')).toBe('light');
    });

    test('restores saved theme from localStorage', () => {
        Storage.prototype.getItem.mockReturnValue('dark');
        mod.initThemeToggle();
        expect(document.documentElement.getAttribute('data-theme')).toBe('dark');
    });
});

// =========================== updateThemeIcon ===============================

describe('updateThemeIcon', () => {
    test('switches to sun icon for dark theme', () => {
        const icon = document.createElement('i');
        icon.classList.add('fa-moon');
        mod.updateThemeIcon('dark', icon);
        expect(icon.classList.contains('fa-sun')).toBe(true);
        expect(icon.classList.contains('fa-moon')).toBe(false);
    });

    test('switches to moon icon for light theme', () => {
        const icon = document.createElement('i');
        icon.classList.add('fa-sun');
        mod.updateThemeIcon('light', icon);
        expect(icon.classList.contains('fa-moon')).toBe(true);
        expect(icon.classList.contains('fa-sun')).toBe(false);
    });
});

// ========================== initScrollReveal ===============================

describe('initScrollReveal', () => {
    test('registers observer for reveal elements', () => {
        mod.initScrollReveal();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('reveal'))
        );
        expect(obs).toBeDefined();
        // 4 elements: .reveal, .reveal-left, .reveal-right, .reveal-scale
        expect(obs.elements.length).toBe(4);
    });

    test('adds "active" class on intersection', () => {
        mod.initScrollReveal();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('reveal'))
        );
        obs.triggerAll();
        obs.elements.forEach(el => {
            expect(el.classList.contains('active')).toBe(true);
        });
    });

    test('uses correct observer options', () => {
        mod.initScrollReveal();
        const obs = intersectionCallbacks.find(o =>
            o.elements.some(el => el.classList.contains('reveal'))
        );
        expect(obs.options.threshold).toBe(0.15);
        expect(obs.options.rootMargin).toBe('0px 0px -50px 0px');
    });
});

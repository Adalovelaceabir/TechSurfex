/**
 * TechSurfex Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper Slider
    if (document.querySelector('.breakingSwiper')) {
        new Swiper('.breakingSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'slide',
            speed: 800,
        });
    }
    
    // Dark/Light Mode Toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    
    // Check for saved user preference
    const savedMode = localStorage.getItem('techsurfex-dark-mode');
    if (savedMode === 'enabled') {
        body.classList.add('dark-mode');
    }
    
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('techsurfex-dark-mode', 'enabled');
            } else {
                localStorage.setItem('techsurfex-dark-mode', 'disabled');
            }
        });
    }
    
    // Lazy Loading Images Observer
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        lazyImages.forEach(img => img.classList.add('loaded'));
    }
    
    // Sticky Header Enhancement
    let lastScroll = 0;
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            lastScroll = currentScroll;
        });
    }
    
    // Mobile Menu Toggle (for responsive)
    const createMobileMenuToggle = () => {
        const nav = document.querySelector('.main-nav');
        if (window.innerWidth <= 768 && !document.querySelector('.mobile-menu-toggle')) {
            const toggle = document.createElement('button');
            toggle.className = 'mobile-menu-toggle';
            toggle.innerHTML = '☰';
            toggle.style.cssText = 'font-size: 24px; background: none; border: none; cursor: pointer;';
            toggle.setAttribute('aria-label', 'Menu');
            
            const headerActions = document.querySelector('.header-actions');
            if (headerActions) {
                headerActions.parentNode.insertBefore(toggle, headerActions);
            }
            
            toggle.addEventListener('click', () => {
                nav.classList.toggle('mobile-open');
                if (nav.classList.contains('mobile-open')) {
                    nav.style.display = 'block';
                } else {
                    nav.style.display = 'none';
                }
            });
            
            nav.style.display = 'none';
        } else if (window.innerWidth > 768) {
            const toggle = document.querySelector('.mobile-menu-toggle');
            if (toggle) toggle.remove();
            if (nav) nav.style.display = 'block';
        }
    };
    
    createMobileMenuToggle();
    window.addEventListener('resize', createMobileMenuToggle);
    
    // Newsletter Form Submission (AJAX)
    const newsletterForms = document.querySelectorAll('.newsletter-form');
    newsletterForms.forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = form.querySelector('input[type="email"]').value;
            const submitBtn = form.querySelector('button');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Subscribing...';
            submitBtn.disabled = true;
            
            // Simulate API call - Replace with actual Mailchimp/Newsletter API
            setTimeout(() => {
                alert('Thank you for subscribing! You will receive our newsletter soon.');
                form.reset();
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 1000);
            
            // Uncomment for actual AJAX implementation:
            /*
            const response = await fetch(techsurfex_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=subscribe_newsletter&email=${encodeURIComponent(email)}&nonce=${techsurfex_ajax.nonce}`
            });
            */
        });
    });
    
    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Performance: Defer offscreen images
    if ('requestIdleCallback' in window) {
        requestIdleCallback(() => {
            // Load additional resources if needed
        });
    }
});

// Preload critical resources
window.addEventListener('load', function() {
    // Register Service Worker for PWA (optional)
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js').catch(err => console.log('Service worker registration failed:', err));
    }
});

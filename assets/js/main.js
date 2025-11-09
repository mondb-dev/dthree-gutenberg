/**
 * Main JavaScript for DThree Gutenberg Theme
 * 
 * @package DThree_Gutenberg
 */

(function() {
    'use strict';

    /**
     * Initialize when DOM is ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize all components
        initSmoothScroll();
        initContactForms();
        initScrollToTop();
        initAOS();
        initAccessibility();
        
        // Bootstrap tooltips
        initTooltips();
        
        // Bootstrap popovers
        initPopovers();
    });

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Skip if it's just # or #0
                if (href === '#' || href === '#0') {
                    return;
                }
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    // Account for sticky header
                    const headerOffset = 100;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update focus for accessibility
                    target.focus();
                }
            });
        });
    }

    /**
     * Initialize contact forms with AJAX submission
     */
    function initContactForms() {
        const forms = document.querySelectorAll('.dthree-contact-form');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate form
                if (!form.checkValidity()) {
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }
                
                // Get form data
                const formData = new FormData(form);
                const submitButton = form.querySelector('button[type="submit"]');
                const messageDiv = form.querySelector('.form-message');
                
                // Disable submit button
                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...';
                
                // Send AJAX request
                fetch(dthreeData.ajaxurl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        messageDiv.className = 'form-message alert alert-success';
                        messageDiv.textContent = data.data.message;
                        messageDiv.classList.remove('d-none');
                        
                        // Reset form
                        form.reset();
                        form.classList.remove('was-validated');
                    } else {
                        // Show error message
                        messageDiv.className = 'form-message alert alert-danger';
                        messageDiv.textContent = data.data.message;
                        messageDiv.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    // Show error message
                    messageDiv.className = 'form-message alert alert-danger';
                    messageDiv.textContent = 'An error occurred. Please try again.';
                    messageDiv.classList.remove('d-none');
                })
                .finally(() => {
                    // Re-enable submit button
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButton.getAttribute('data-original-text') || 'Send Message';
                    
                    // Hide message after 5 seconds
                    setTimeout(() => {
                        messageDiv.classList.add('d-none');
                    }, 5000);
                });
            });
            
            // Store original button text
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.setAttribute('data-original-text', submitButton.textContent);
            }
        });
    }

    /**
     * Scroll to top button
     */
    function initScrollToTop() {
        // Create scroll to top button
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '<i class="bi bi-arrow-up" aria-hidden="true"></i>';
        scrollBtn.className = 'btn btn-primary rounded-circle position-fixed bottom-0 end-0 m-4 d-none';
        scrollBtn.style.width = '50px';
        scrollBtn.style.height = '50px';
        scrollBtn.style.zIndex = '1000';
        scrollBtn.setAttribute('aria-label', 'Scroll to top');
        scrollBtn.id = 'scrollToTop';
        
        document.body.appendChild(scrollBtn);
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.remove('d-none');
            } else {
                scrollBtn.classList.add('d-none');
            }
        });
        
        // Scroll to top on click
        scrollBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Initialize AOS (Animate On Scroll) library
     */
    function initAOS() {
        // Check if AOS should be enabled (can be controlled via customizer)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        }
    }

    /**
     * Initialize Bootstrap tooltips
     */
    function initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    /**
     * Initialize Bootstrap popovers
     */
    function initPopovers() {
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }

    /**
     * Accessibility enhancements
     */
    function initAccessibility() {
        // Keyboard navigation for custom elements
        const customButtons = document.querySelectorAll('[role="button"]');
        
        customButtons.forEach(button => {
            if (!button.hasAttribute('tabindex')) {
                button.setAttribute('tabindex', '0');
            }
            
            button.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
        
        // Add focus visible class for better keyboard navigation visibility
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });
        
        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });
    }

    /**
     * Handle responsive images with lazy loading
     */
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            // Browser supports native lazy loading
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        } else {
            // Fallback for browsers that don't support lazy loading
            // Use Intersection Observer
            if ('IntersectionObserver' in window) {
                const lazyImages = document.querySelectorAll('img[loading="lazy"]');
                
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                
                lazyImages.forEach(img => imageObserver.observe(img));
            }
        }
    }

    /**
     * Mobile menu enhancements
     */
    function initMobileMenu() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        if (navbarToggler && navbarCollapse) {
            // Close menu when clicking a link
            const navLinks = navbarCollapse.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                        if (bsCollapse) {
                            bsCollapse.hide();
                        }
                    }
                });
            });
        }
    }

    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize cookie consent
    initCookieConsent();

    // Re-initialize on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Re-initialize components that need it
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 250);
    });
    
    /**
     * Cookie Consent functionality
     */
    function initCookieConsent() {
        const consentBanner = document.getElementById('dthree-cookie-consent');
        
        if (!consentBanner) {
            return;
        }
        
        // Check if user has already made a choice
        const cookieConsent = getCookie('dthree_cookie_consent');
        
        if (!cookieConsent) {
            // Show banner after a short delay
            setTimeout(function() {
                consentBanner.style.display = 'block';
            }, 1000);
        }
        
        // Accept cookies
        const acceptBtn = document.getElementById('dthree-accept-cookies');
        if (acceptBtn) {
            acceptBtn.addEventListener('click', function() {
                setCookie('dthree_cookie_consent', 'accepted', 365);
                consentBanner.style.display = 'none';
            });
        }
        
        // Decline cookies
        const declineBtn = document.getElementById('dthree-decline-cookies');
        if (declineBtn) {
            declineBtn.addEventListener('click', function() {
                setCookie('dthree_cookie_consent', 'declined', 365);
                consentBanner.style.display = 'none';
            });
        }
    }
    
    /**
     * Set cookie
     */
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }
    
    /**
     * Get cookie
     */
    function getCookie(name) {
        const nameEQ = name + '=';
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }

})();

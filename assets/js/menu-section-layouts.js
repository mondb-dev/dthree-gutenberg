/**
 * DThree Design System - Menu & Section Layout JavaScript
 * Frontend interactions for menus and responsive behaviors
 *
 * @package DThree_Gutenberg
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // Initialize when DOM is ready
    $(document).ready(function() {
        initializeMenus();
        initializeSectionLayouts();
        initializeResponsiveBehaviors();
    });

    /**
     * Initialize menu functionality
     */
    function initializeMenus() {
        initializeDropdownMenus();
        initializeMegaMenus();
        initializeMobileMenu();
        initializeMenuAccessibility();
    }

    /**
     * Initialize dropdown menu behavior
     */
    function initializeDropdownMenus() {
        // Handle dropdown hover and click events
        $('.menu-item.has-dropdown').each(function() {
            const $menuItem = $(this);
            const $dropdown = $menuItem.find('.dropdown-menu');
            let hoverTimeout;

            // Mouse enter
            $menuItem.on('mouseenter', function() {
                clearTimeout(hoverTimeout);
                $dropdown.stop().fadeIn(200).css('opacity', 1);
                $menuItem.addClass('open');
            });

            // Mouse leave
            $menuItem.on('mouseleave', function() {
                hoverTimeout = setTimeout(function() {
                    $dropdown.stop().fadeOut(200);
                    $menuItem.removeClass('open');
                }, 100);
            });

            // Click handling for mobile
            $menuItem.on('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    $menuItem.toggleClass('open');
                    $dropdown.slideToggle(200);
                }
            });
        });
    }

    /**
     * Initialize mega menu functionality
     */
    function initializeMegaMenus() {
        $('.menu-item.has-mega').each(function() {
            const $menuItem = $(this);
            const $megaDropdown = $menuItem.find('.mega-dropdown');
            let hoverTimeout;

            // Mouse enter
            $menuItem.on('mouseenter', function() {
                clearTimeout(hoverTimeout);
                $megaDropdown.stop().slideDown(300).css('opacity', 1);
                $menuItem.addClass('mega-open');
            });

            // Mouse leave
            $menuItem.on('mouseleave', function() {
                hoverTimeout = setTimeout(function() {
                    $megaDropdown.stop().slideUp(300);
                    $menuItem.removeClass('mega-open');
                }, 150);
            });

            // Position mega dropdown
            positionMegaDropdown($megaDropdown);
        });

        // Reposition mega dropdowns on window resize
        $(window).on('resize', debounce(function() {
            $('.mega-dropdown').each(function() {
                positionMegaDropdown($(this));
            });
        }, 250));
    }

    /**
     * Position mega dropdown to fit viewport
     */
    function positionMegaDropdown($dropdown) {
        const $container = $dropdown.closest('.dthree-container, .container');
        if ($container.length) {
            const containerOffset = $container.offset();
            const containerWidth = $container.outerWidth();
            
            $dropdown.css({
                'left': -containerOffset.left,
                'width': containerWidth
            });
        }
    }

    /**
     * Initialize mobile menu functionality
     */
    function initializeMobileMenu() {
        const $hamburger = $('.hamburger-menu');
        const $mobileMenu = $('.mobile-menu');
        const $overlay = $('.mobile-menu-overlay');

        // Create overlay if it doesn't exist
        if ($overlay.length === 0) {
            $('body').append('<div class="mobile-menu-overlay"></div>');
        }

        // Hamburger click
        $hamburger.on('click', function() {
            toggleMobileMenu();
        });

        // Overlay click
        $(document).on('click', '.mobile-menu-overlay', function() {
            closeMobileMenu();
        });

        // Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $mobileMenu.hasClass('active')) {
                closeMobileMenu();
            }
        });

        // Close on window resize
        $(window).on('resize', function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });

        // Mobile submenu toggles
        $('.mobile-menu .menu-item.has-dropdown > a').on('click', function(e) {
            e.preventDefault();
            const $submenu = $(this).next('.dropdown-menu, .sub-menu');
            $(this).toggleClass('open');
            $submenu.slideToggle(200);
        });
    }

    /**
     * Toggle mobile menu state
     */
    function toggleMobileMenu() {
        const $hamburger = $('.hamburger-menu');
        const $mobileMenu = $('.mobile-menu');
        const $overlay = $('.mobile-menu-overlay');
        const $body = $('body');

        if ($mobileMenu.hasClass('active')) {
            closeMobileMenu();
        } else {
            $mobileMenu.addClass('active');
            $overlay.addClass('active');
            $hamburger.addClass('active');
            $body.addClass('mobile-menu-open').css('overflow', 'hidden');
            
            // Focus management
            $mobileMenu.find('a, button, input').first().focus();
        }
    }

    /**
     * Close mobile menu
     */
    function closeMobileMenu() {
        const $hamburger = $('.hamburger-menu');
        const $mobileMenu = $('.mobile-menu');
        const $overlay = $('.mobile-menu-overlay');
        const $body = $('body');

        $mobileMenu.removeClass('active');
        $overlay.removeClass('active');
        $hamburger.removeClass('active');
        $body.removeClass('mobile-menu-open').css('overflow', '');
        
        // Return focus to hamburger
        $hamburger.focus();
    }

    /**
     * Initialize menu accessibility features
     */
    function initializeMenuAccessibility() {
        // Add ARIA attributes
        $('.menu-item.has-dropdown > a').each(function() {
            $(this).attr({
                'aria-haspopup': 'true',
                'aria-expanded': 'false'
            });
        });

        // Keyboard navigation
        $('.menu-item > a').on('keydown', function(e) {
            const $this = $(this);
            const $parent = $this.parent();

            switch(e.key) {
                case 'Enter':
                case ' ':
                    if ($parent.hasClass('has-dropdown')) {
                        e.preventDefault();
                        $parent.toggleClass('open');
                        $this.attr('aria-expanded', $parent.hasClass('open'));
                    }
                    break;

                case 'Escape':
                    if ($parent.hasClass('open')) {
                        e.preventDefault();
                        $parent.removeClass('open');
                        $this.attr('aria-expanded', 'false');
                        $this.focus();
                    }
                    break;

                case 'ArrowDown':
                    if ($parent.hasClass('has-dropdown')) {
                        e.preventDefault();
                        $parent.addClass('open');
                        $this.attr('aria-expanded', 'true');
                        $parent.find('.dropdown-menu a').first().focus();
                    }
                    break;
            }
        });

        // Dropdown keyboard navigation
        $('.dropdown-menu a').on('keydown', function(e) {
            const $dropdown = $(this).closest('.dropdown-menu');
            const $items = $dropdown.find('a');
            const currentIndex = $items.index(this);

            switch(e.key) {
                case 'ArrowUp':
                    e.preventDefault();
                    if (currentIndex > 0) {
                        $items.eq(currentIndex - 1).focus();
                    } else {
                        $dropdown.prev('a').focus();
                    }
                    break;

                case 'ArrowDown':
                    e.preventDefault();
                    if (currentIndex < $items.length - 1) {
                        $items.eq(currentIndex + 1).focus();
                    }
                    break;

                case 'Escape':
                    e.preventDefault();
                    const $parentMenu = $dropdown.parent();
                    $parentMenu.removeClass('open');
                    $parentMenu.find('> a').attr('aria-expanded', 'false').focus();
                    break;
            }
        });
    }

    /**
     * Initialize section layout functionality
     */
    function initializeSectionLayouts() {
        // Add section layout classes based on viewport
        adjustSectionLayouts();
        
        // Reinitialize on window resize
        $(window).on('resize', debounce(adjustSectionLayouts, 250));

        // Initialize parallax effects for hero sections
        initializeParallaxSections();

        // Initialize lazy loading for section backgrounds
        initializeLazyBackgrounds();
    }

    /**
     * Adjust section layouts based on viewport size
     */
    function adjustSectionLayouts() {
        const viewportWidth = window.innerWidth;

        $('.dthree-section-custom').each(function() {
            const $section = $(this);
            
            // Adjust padding based on viewport
            if (viewportWidth <= 768) {
                $section.css('padding', 'var(--dthree-space-lg) var(--dthree-space-md)');
            } else if (viewportWidth <= 1024) {
                $section.css('padding', 'var(--dthree-space-xl) var(--dthree-space-lg)');
            } else {
                $section.css('padding', 'var(--dthree-space-2xl) var(--dthree-space-xl)');
            }
        });

        // Adjust container widths for full-width sections
        $('.dthree-section-full-width .dthree-container').each(function() {
            const $container = $(this);
            
            if (viewportWidth <= 768) {
                $container.css('max-width', '100%');
            } else {
                $container.css('max-width', 'var(--dthree-container-xl)');
            }
        });
    }

    /**
     * Initialize parallax effects for hero sections
     */
    function initializeParallaxSections() {
        if (!window.IntersectionObserver) return;

        const parallaxSections = document.querySelectorAll('.dthree-section-hero[data-parallax]');
        
        parallaxSections.forEach(section => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        window.addEventListener('scroll', () => updateParallax(entry.target));
                    }
                });
            });
            
            observer.observe(section);
        });
    }

    /**
     * Update parallax effect
     */
    function updateParallax(element) {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        element.style.transform = `translateY(${rate}px)`;
    }

    /**
     * Initialize lazy loading for section backgrounds
     */
    function initializeLazyBackgrounds() {
        if (!window.IntersectionObserver) return;

        const lazyBackgrounds = document.querySelectorAll('[data-bg-src]');
        
        const backgroundObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bgSrc = entry.target.dataset.bgSrc;
                    entry.target.style.backgroundImage = `url(${bgSrc})`;
                    entry.target.removeAttribute('data-bg-src');
                    backgroundObserver.unobserve(entry.target);
                }
            });
        });

        lazyBackgrounds.forEach(bg => {
            backgroundObserver.observe(bg);
        });
    }

    /**
     * Initialize responsive behaviors
     */
    function initializeResponsiveBehaviors() {
        // Handle responsive menu switching
        handleResponsiveMenus();
        
        // Initialize responsive images
        initializeResponsiveImages();

        // Handle viewport change events
        $(window).on('resize orientationchange', debounce(function() {
            handleResponsiveMenus();
            adjustSectionLayouts();
        }, 250));
    }

    /**
     * Handle responsive menu switching
     */
    function handleResponsiveMenus() {
        const $desktopMenu = $('.dthree-menu-horizontal, .dthree-menu-vertical, .dthree-menu-mega');
        const $mobileMenu = $('.mobile-menu');
        const breakpoint = 768;

        if (window.innerWidth <= breakpoint) {
            $desktopMenu.hide();
            $('.hamburger-menu').show();
        } else {
            $desktopMenu.show();
            $('.hamburger-menu').hide();
            closeMobileMenu(); // Close mobile menu if open
        }
    }

    /**
     * Initialize responsive images
     */
    function initializeResponsiveImages() {
        // Handle responsive image switching
        $('img[data-src-mobile], img[data-src-tablet], img[data-src-desktop]').each(function() {
            const $img = $(this);
            updateResponsiveImage($img);
        });

        $(window).on('resize', debounce(function() {
            $('img[data-src-mobile], img[data-src-tablet], img[data-src-desktop]').each(function() {
                updateResponsiveImage($(this));
            });
        }, 250));
    }

    /**
     * Update responsive image source
     */
    function updateResponsiveImage($img) {
        const viewportWidth = window.innerWidth;
        let newSrc = $img.attr('src');

        if (viewportWidth <= 768 && $img.data('src-mobile')) {
            newSrc = $img.data('src-mobile');
        } else if (viewportWidth <= 1024 && $img.data('src-tablet')) {
            newSrc = $img.data('src-tablet');
        } else if ($img.data('src-desktop')) {
            newSrc = $img.data('src-desktop');
        }

        if (newSrc !== $img.attr('src')) {
            $img.attr('src', newSrc);
        }
    }

    /**
     * Utility function for debouncing
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Utility function for throttling
     */
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }

    // Expose utilities globally
    window.DThreeMenus = {
        toggleMobileMenu: toggleMobileMenu,
        closeMobileMenu: closeMobileMenu,
        adjustSectionLayouts: adjustSectionLayouts,
        debounce: debounce,
        throttle: throttle
    };

})(jQuery);
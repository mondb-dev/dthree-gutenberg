/**
 * DThree Design System - Micro-interactions JavaScript
 * Generated on: <?php echo date( 'Y-m-d H:i:s' ); ?>
 *
 * @package DThree_Gutenberg
 */

(function($) {
    'use strict';

    // Design System Configuration
    const DThreeDesignSystem = {
        durations: {
<?php foreach ( $settings['animations']['duration'] as $duration_key => $duration_value ) : ?>
            <?php echo esc_js( $duration_key ); ?>: '<?php echo esc_js( $duration_value ); ?>',
<?php endforeach; ?>
        },
        easing: {
<?php foreach ( $settings['animations']['easing'] as $easing_key => $easing_value ) : ?>
            <?php echo esc_js( $easing_key ); ?>: '<?php echo esc_js( $easing_value ); ?>',
<?php endforeach; ?>
        },
        hoverEffects: {
<?php foreach ( $settings['animations']['hover_effects'] as $effect_key => $effect_value ) : ?>
            <?php echo esc_js( $effect_key ); ?>: '<?php echo esc_js( $effect_value ); ?>',
<?php endforeach; ?>
        }
    };

    // Initialize micro-interactions when DOM is ready
    $(document).ready(function() {
        initializeDesignSystem();
    });

    /**
     * Initialize all design system interactions
     */
    function initializeDesignSystem() {
        initButtonInteractions();
        initCardInteractions();
        initFormInteractions();
        initNavigationInteractions();
        initImageInteractions();
        initScrollAnimations();
        initTooltips();
        initModalInteractions();
    }

    /**
     * Enhanced Button Interactions
     */
    function initButtonInteractions() {
        // Add ripple effect to buttons
        $('[class*="btn-"], [class*="dthree-btn-"]').each(function() {
            const $button = $(this);
            
            // Add ripple container if it doesn't exist
            if (!$button.find('.ripple').length) {
                $button.append('<span class="ripple"></span>');
            }

            // Ripple effect on click
            $button.on('click', function(e) {
                const $ripple = $button.find('.ripple');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                $ripple.css({
                    width: size + 'px',
                    height: size + 'px',
                    left: x + 'px',
                    top: y + 'px',
                    transform: 'scale(0)',
                    opacity: '0.3'
                });

                // Trigger animation
                requestAnimationFrame(() => {
                    $ripple.css({
                        transform: 'scale(1)',
                        opacity: '0',
                        transition: `all ${DThreeDesignSystem.durations.normal} ${DThreeDesignSystem.easing.smooth}`
                    });
                });

                // Reset ripple
                setTimeout(() => {
                    $ripple.css({
                        transform: 'scale(0)',
                        opacity: '0',
                        transition: 'none'
                    });
                }, parseFloat(DThreeDesignSystem.durations.normal) * 1000);
            });

            // Enhanced hover effects
            $button.on('mouseenter', function() {
                $(this).css({
                    transform: 'translateY(-2px)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.bounce}`
                });
            }).on('mouseleave', function() {
                $(this).css({
                    transform: 'translateY(0)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
                });
            });
        });
    }

    /**
     * Card Interactions
     */
    function initCardInteractions() {
        $('.dthree-card, .card').each(function() {
            const $card = $(this);
            
            $card.on('mouseenter', function() {
                $(this).css({
                    transform: DThreeDesignSystem.hoverEffects.lift,
                    transition: `all ${DThreeDesignSystem.durations.normal} ${DThreeDesignSystem.easing.smooth}`
                });
                
                // Add subtle rotation to images inside cards
                $card.find('img').css({
                    transform: 'scale(1.05) rotate(1deg)',
                    transition: `all ${DThreeDesignSystem.durations.slow} ${DThreeDesignSystem.easing.smooth}`
                });
            }).on('mouseleave', function() {
                $(this).css({
                    transform: 'translateY(0)',
                    transition: `all ${DThreeDesignSystem.durations.normal} ${DThreeDesignSystem.easing.smooth}`
                });
                
                $card.find('img').css({
                    transform: 'scale(1) rotate(0deg)',
                    transition: `all ${DThreeDesignSystem.durations.slow} ${DThreeDesignSystem.easing.smooth}`
                });
            });

            // Parallax effect for card backgrounds
            if ($card.data('parallax') === true) {
                $card.on('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;

                    $(this).css({
                        transform: `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(0)`
                    });
                }).on('mouseleave', function() {
                    $(this).css({
                        transform: 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0)'
                    });
                });
            }
        });
    }

    /**
     * Form Interactions
     */
    function initFormInteractions() {
        // Enhanced input focus animations
        $('.dthree-input, .dthree-textarea, .dthree-select, input[type="text"], input[type="email"], input[type="password"], textarea, select').each(function() {
            const $input = $(this);
            
            $input.on('focus', function() {
                $(this).parent().addClass('focused');
                $(this).css({
                    transform: 'scale(1.02)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
                });
            }).on('blur', function() {
                $(this).parent().removeClass('focused');
                $(this).css({
                    transform: 'scale(1)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
                });
            });

            // Character count animation for textareas
            if ($input.is('textarea') && $input.attr('maxlength')) {
                const maxLength = parseInt($input.attr('maxlength'));
                const $counter = $('<span class="char-counter"></span>');
                $input.after($counter);

                $input.on('input', function() {
                    const remaining = maxLength - $(this).val().length;
                    $counter.text(`${$(this).val().length}/${maxLength}`);
                    
                    if (remaining < 20) {
                        $counter.addClass('warning');
                    } else {
                        $counter.removeClass('warning');
                    }
                });
            }
        });

        // Floating label effect
        $('.form-group.floating-label').each(function() {
            const $group = $(this);
            const $input = $group.find('input, textarea');
            const $label = $group.find('label');

            $input.on('focus blur', function() {
                const hasValue = $(this).val().length > 0;
                const isFocused = $(this).is(':focus');
                
                if (hasValue || isFocused) {
                    $label.addClass('floating');
                } else {
                    $label.removeClass('floating');
                }
            });
        });
    }

    /**
     * Navigation Interactions
     */
    function initNavigationInteractions() {
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $($(this).attr('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, DThreeDesignSystem.easing.smooth);
            }
        });

        // Sticky navigation with hide/show on scroll
        const $navbar = $('.navbar, .dthree-nav');
        let lastScrollTop = 0;
        
        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down
                $navbar.addClass('hidden');
            } else {
                // Scrolling up
                $navbar.removeClass('hidden');
            }
            
            lastScrollTop = scrollTop;
        });

        // Menu item hover effects
        $('.nav-item, .menu-item').each(function() {
            const $item = $(this);
            
            $item.on('mouseenter', function() {
                $(this).find('a').css({
                    transform: 'translateY(-2px)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.bounce}`
                });
            }).on('mouseleave', function() {
                $(this).find('a').css({
                    transform: 'translateY(0)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
                });
            });
        });
    }

    /**
     * Image Interactions
     */
    function initImageInteractions() {
        // Image hover zoom effect
        $('.dthree-img, .wp-post-image').each(function() {
            const $img = $(this);
            
            $img.on('mouseenter', function() {
                $(this).css({
                    transform: DThreeDesignSystem.hoverEffects.scale,
                    transition: `all ${DThreeDesignSystem.durations.slow} ${DThreeDesignSystem.easing.smooth}`
                });
            }).on('mouseleave', function() {
                $(this).css({
                    transform: 'scale(1)',
                    transition: `all ${DThreeDesignSystem.durations.slow} ${DThreeDesignSystem.easing.smooth}`
                });
            });
        });

        // Lazy loading with fade-in animation
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        img.classList.add('fade-in');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        // Reveal animations on scroll
        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal, .animate-on-scroll').forEach(el => {
                revealObserver.observe(el);
            });
        }

        // Parallax scrolling for elements
        $('.parallax-element').each(function() {
            const $element = $(this);
            const speed = $element.data('parallax-speed') || 0.5;
            
            $(window).on('scroll', function() {
                const scrolled = $(this).scrollTop();
                const offset = scrolled * speed;
                
                $element.css({
                    transform: `translateY(${offset}px)`
                });
            });
        });
    }

    /**
     * Tooltip Interactions
     */
    function initTooltips() {
        $('[data-tooltip]').each(function() {
            const $trigger = $(this);
            const tooltipText = $trigger.data('tooltip');
            const $tooltip = $(`<div class="dthree-tooltip">${tooltipText}</div>`);
            
            $('body').append($tooltip);
            
            $trigger.on('mouseenter', function(e) {
                const rect = this.getBoundingClientRect();
                const tooltipRect = $tooltip[0].getBoundingClientRect();
                
                $tooltip.css({
                    left: rect.left + (rect.width / 2) - (tooltipRect.width / 2) + 'px',
                    top: rect.top - tooltipRect.height - 10 + 'px',
                    opacity: '1',
                    transform: 'translateY(0)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
                });
            }).on('mouseleave', function() {
                $tooltip.css({
                    opacity: '0',
                    transform: 'translateY(10px)',
                    transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
                });
            });
        });
    }

    /**
     * Modal Interactions
     */
    function initModalInteractions() {
        // Modal open/close animations
        $('[data-modal-trigger]').on('click', function() {
            const targetModal = $(this).data('modal-trigger');
            const $modal = $(targetModal);
            
            $modal.css({
                display: 'flex',
                opacity: '0',
                transform: 'scale(0.7)'
            });
            
            requestAnimationFrame(() => {
                $modal.css({
                    opacity: '1',
                    transform: 'scale(1)',
                    transition: `all ${DThreeDesignSystem.durations.normal} ${DThreeDesignSystem.easing.bounce}`
                });
            });
        });

        $('.modal-close, .modal-backdrop').on('click', function() {
            const $modal = $(this).closest('.modal');
            
            $modal.css({
                opacity: '0',
                transform: 'scale(0.7)',
                transition: `all ${DThreeDesignSystem.durations.fast} ${DThreeDesignSystem.easing.smooth}`
            });
            
            setTimeout(() => {
                $modal.css('display', 'none');
            }, parseFloat(DThreeDesignSystem.durations.fast) * 1000);
        });
    }

    /**
     * Page transition effects
     */
    function initPageTransitions() {
        $('a:not([href^="#"]):not([target="_blank"]):not(.no-transition)').on('click', function(e) {
            const href = $(this).attr('href');
            
            if (href && !e.isDefaultPrevented()) {
                e.preventDefault();
                
                $('body').addClass('page-transitioning');
                
                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            }
        });
    }

    /**
     * Utility functions
     */
    const utils = {
        debounce: function(func, wait, immediate) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                const later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                const callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        },
        
        throttle: function(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        }
    };

    // Expose utilities globally
    window.DThreeDesignSystem = DThreeDesignSystem;
    window.DThreeUtils = utils;

})(jQuery);
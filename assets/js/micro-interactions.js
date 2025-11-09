/**
 * DThree Micro-interactions
 * Smooth and purposeful animations for enhanced user experience
 *
 * @package DThree_Gutenberg
 */

(function($) {
    'use strict';

    // Default micro-interaction settings
    const defaultSettings = {
        durations: {
            fast: '0.15s',
            normal: '0.3s',
            slow: '0.5s'
        },
        easing: {
            ease: 'ease',
            easeIn: 'ease-in',
            easeOut: 'ease-out',
            easeInOut: 'ease-in-out',
            bounce: 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
            smooth: 'cubic-bezier(0.4, 0, 0.2, 1)'
        },
        hoverEffects: {
            lift: 'translateY(-2px)',
            scale: 'scale(1.02)',
            rotate: 'rotate(2deg)'
        }
    };

    // Initialize when DOM is ready
    $(document).ready(function() {
        initializeMicroInteractions();
    });

    /**
     * Initialize all micro-interactions
     */
    function initializeMicroInteractions() {
        initializeButtonAnimations();
        initializeCardAnimations();
        initializeImageAnimations();
        initializeFormAnimations();
        initializeNavigationAnimations();
        initializeScrollAnimations();
        initializeLoadingAnimations();
        initializeTooltipAnimations();
        initializeModalAnimations();
        initializeTypingAnimations();
    }

    /**
     * Button Animations
     */
    function initializeButtonAnimations() {
        // Enhanced button hover effects
        $('button, .btn, .button, [role="button"], input[type="submit"], input[type="button"]').each(function() {
            const $button = $(this);
            
            // Skip if already initialized
            if ($button.hasClass('dthree-animated')) return;
            $button.addClass('dthree-animated');

            // Add ripple effect container
            if (!$button.find('.btn-ripple').length) {
                $button.append('<span class="btn-ripple"></span>');
            }

            // Hover animations
            $button.on('mouseenter', function() {
                $(this).css({
                    transform: defaultSettings.hoverEffects.lift,
                    transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });
            }).on('mouseleave', function() {
                $(this).css({
                    transform: 'translateY(0)',
                    transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });
            });

            // Click ripple effect
            $button.on('click', function(e) {
                const $ripple = $(this).find('.btn-ripple');
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
                    opacity: '0.3',
                    borderRadius: '50%',
                    background: 'rgba(255, 255, 255, 0.7)',
                    position: 'absolute',
                    pointerEvents: 'none',
                    zIndex: '1'
                });

                // Animate ripple
                requestAnimationFrame(() => {
                    $ripple.css({
                        transform: 'scale(1)',
                        opacity: '0',
                        transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`
                    });
                });

                // Reset after animation
                setTimeout(() => {
                    $ripple.css('transform', 'scale(0)');
                }, parseFloat(defaultSettings.durations.normal) * 1000);
            });

            // Focus states
            $button.on('focus', function() {
                $(this).css({
                    boxShadow: '0 0 0 3px rgba(13, 110, 253, 0.25)',
                    transition: `box-shadow ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });
            }).on('blur', function() {
                $(this).css({
                    boxShadow: 'none',
                    transition: `box-shadow ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });
            });
        });
    }

    /**
     * Card Animations
     */
    function initializeCardAnimations() {
        $('.card, .dthree-card, .post, article').each(function() {
            const $card = $(this);
            
            if ($card.hasClass('dthree-animated')) return;
            $card.addClass('dthree-animated');

            $card.on('mouseenter', function() {
                $(this).css({
                    transform: defaultSettings.hoverEffects.lift + ' ' + defaultSettings.hoverEffects.scale,
                    boxShadow: '0 15px 35px rgba(0, 0, 0, 0.15)',
                    transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`
                });

                // Animate images inside cards
                $card.find('img').css({
                    transform: 'scale(1.05)',
                    transition: `transform ${defaultSettings.durations.slow} ${defaultSettings.easing.smooth}`
                });
            }).on('mouseleave', function() {
                $(this).css({
                    transform: 'translateY(0) scale(1)',
                    boxShadow: '',
                    transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`
                });

                $card.find('img').css({
                    transform: 'scale(1)',
                    transition: `transform ${defaultSettings.durations.slow} ${defaultSettings.easing.smooth}`
                });
            });

            // 3D tilt effect for special cards
            if ($card.hasClass('tilt-effect')) {
                $card.on('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 8;
                    const rotateY = (centerX - x) / 8;

                    $(this).css({
                        transform: `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(0)`,
                        transition: 'none'
                    });
                }).on('mouseleave', function() {
                    $(this).css({
                        transform: 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0)',
                        transition: `transform ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`
                    });
                });
            }
        });
    }

    /**
     * Image Animations
     */
    function initializeImageAnimations() {
        $('img, .wp-post-image, .attachment-image').each(function() {
            const $img = $(this);
            
            if ($img.hasClass('dthree-animated')) return;
            $img.addClass('dthree-animated');

            // Hover zoom effect
            $img.on('mouseenter', function() {
                $(this).css({
                    transform: defaultSettings.hoverEffects.scale,
                    transition: `transform ${defaultSettings.durations.slow} ${defaultSettings.easing.smooth}`
                });
            }).on('mouseleave', function() {
                $(this).css({
                    transform: 'scale(1)',
                    transition: `transform ${defaultSettings.durations.slow} ${defaultSettings.easing.smooth}`
                });
            });

            // Lazy loading animation
            if ($img.attr('data-src') && !$img.hasClass('loaded')) {
                $img.css({
                    opacity: '0',
                    transform: 'scale(0.8)'
                });

                // Simulate loading (replace with actual lazy loading)
                const img = new Image();
                img.onload = function() {
                    $img.css({
                        opacity: '1',
                        transform: 'scale(1)',
                        transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`
                    }).addClass('loaded');
                };
                img.src = $img.attr('data-src');
            }
        });
    }

    /**
     * Form Animations
     */
    function initializeFormAnimations() {
        // Input focus animations
        $('input, textarea, select').each(function() {
            const $input = $(this);
            
            if ($input.hasClass('dthree-animated')) return;
            $input.addClass('dthree-animated');

            $input.on('focus', function() {
                $(this).css({
                    transform: 'scale(1.02)',
                    boxShadow: '0 0 0 3px rgba(13, 110, 253, 0.1)',
                    borderColor: '#0d6efd',
                    transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });

                // Animate label if exists
                const $label = $(`label[for="${$(this).attr('id')}"]`);
                if ($label.length) {
                    $label.css({
                        color: '#0d6efd',
                        transform: 'translateY(-2px)',
                        transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                    });
                }
            }).on('blur', function() {
                $(this).css({
                    transform: 'scale(1)',
                    boxShadow: 'none',
                    borderColor: '',
                    transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });

                const $label = $(`label[for="${$(this).attr('id')}"]`);
                if ($label.length) {
                    $label.css({
                        color: '',
                        transform: 'translateY(0)',
                        transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                    });
                }
            });

            // Typing animation for textareas
            if ($input.is('textarea')) {
                let typingTimer;
                $input.on('input', function() {
                    $(this).addClass('typing');
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        $input.removeClass('typing');
                    }, 1000);
                });
            }
        });

        // Form submission animation
        $('form').on('submit', function() {
            const $form = $(this);
            const $submitBtn = $form.find('input[type="submit"], button[type="submit"]');
            
            $submitBtn.css({
                transform: 'scale(0.98)',
                opacity: '0.8',
                transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
            });

            setTimeout(() => {
                $submitBtn.css({
                    transform: 'scale(1)',
                    opacity: '1'
                });
            }, 200);
        });
    }

    /**
     * Navigation Animations
     */
    function initializeNavigationAnimations() {
        // Menu item animations
        $('.menu-item a, .nav-item a, .navbar-nav a').each(function() {
            const $link = $(this);
            
            if ($link.hasClass('dthree-animated')) return;
            $link.addClass('dthree-animated');

            // Add underline effect element
            if (!$link.find('.nav-underline').length) {
                $link.append('<span class="nav-underline"></span>');
            }

            const $underline = $link.find('.nav-underline');
            $underline.css({
                position: 'absolute',
                bottom: '0',
                left: '50%',
                width: '0',
                height: '2px',
                background: '#0d6efd',
                transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`,
                transform: 'translateX(-50%)'
            });

            $link.css('position', 'relative');

            $link.on('mouseenter', function() {
                $underline.css('width', '100%');
                $(this).css({
                    transform: 'translateY(-2px)',
                    transition: `transform ${defaultSettings.durations.fast} ${defaultSettings.easing.bounce}`
                });
            }).on('mouseleave', function() {
                $underline.css('width', '0');
                $(this).css({
                    transform: 'translateY(0)',
                    transition: `transform ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });
            });
        });

        // Mobile menu toggle animation
        $('.menu-toggle, .navbar-toggler').on('click', function() {
            $(this).css({
                transform: 'rotate(90deg)',
                transition: `transform ${defaultSettings.durations.fast} ${defaultSettings.easing.bounce}`
            });

            setTimeout(() => {
                $(this).css({
                    transform: 'rotate(0deg)',
                    transition: `transform ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });
            }, 200);
        });
    }

    /**
     * Scroll Animations
     */
    function initializeScrollAnimations() {
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $($(this).attr('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'easeInOutCubic');
            }
        });

        // Scroll-triggered animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('dthree-visible');
                    }
                });
            }, observerOptions);

            // Observe elements for animation
            $('.animate-on-scroll, .fade-in-up, .slide-in').each(function() {
                observer.observe(this);
            });
        }

        // Back to top button
        if ($('#back-to-top').length === 0) {
            $('body').append('<button id="back-to-top" class="back-to-top">↑</button>');
        }

        const $backToTop = $('#back-to-top');
        $backToTop.css({
            position: 'fixed',
            bottom: '20px',
            right: '20px',
            width: '50px',
            height: '50px',
            borderRadius: '50%',
            background: '#0d6efd',
            color: '#fff',
            border: 'none',
            fontSize: '20px',
            cursor: 'pointer',
            opacity: '0',
            transform: 'scale(0)',
            transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.bounce}`,
            zIndex: '9999'
        });

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.css({
                    opacity: '1',
                    transform: 'scale(1)'
                });
            } else {
                $backToTop.css({
                    opacity: '0',
                    transform: 'scale(0)'
                });
            }
        });

        $backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    /**
     * Loading Animations
     */
    function initializeLoadingAnimations() {
        // Page loading animation
        $(window).on('load', function() {
            $('.page-loader').fadeOut(500);
            $('body').addClass('page-loaded');
        });

        // AJAX loading states
        $(document).ajaxStart(function() {
            $('body').addClass('ajax-loading');
        }).ajaxStop(function() {
            $('body').removeClass('ajax-loading');
        });

        // Button loading states
        $('.btn-loading').on('click', function() {
            const $btn = $(this);
            const originalText = $btn.text();
            
            $btn.prop('disabled', true)
                .html('<span class="loading-spinner"></span> Loading...')
                .css({
                    opacity: '0.8',
                    transform: 'scale(0.98)',
                    transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
                });

            // Reset after 3 seconds (adjust based on actual loading time)
            setTimeout(() => {
                $btn.prop('disabled', false)
                    .text(originalText)
                    .css({
                        opacity: '1',
                        transform: 'scale(1)'
                    });
            }, 3000);
        });
    }

    /**
     * Tooltip Animations
     */
    function initializeTooltipAnimations() {
        $('[data-tooltip]').each(function() {
            const $trigger = $(this);
            const tooltipText = $trigger.data('tooltip');
            const $tooltip = $(`<div class="dthree-tooltip">${tooltipText}</div>`);
            
            $tooltip.css({
                position: 'absolute',
                background: '#333',
                color: '#fff',
                padding: '8px 12px',
                borderRadius: '4px',
                fontSize: '14px',
                whiteSpace: 'nowrap',
                opacity: '0',
                transform: 'translateY(10px)',
                transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`,
                pointerEvents: 'none',
                zIndex: '9999'
            });

            $('body').append($tooltip);
            
            $trigger.on('mouseenter', function(e) {
                const rect = this.getBoundingClientRect();
                const tooltipRect = $tooltip[0].getBoundingClientRect();
                
                $tooltip.css({
                    left: rect.left + (rect.width / 2) - (tooltipRect.width / 2) + 'px',
                    top: rect.top - tooltipRect.height - 10 + 'px',
                    opacity: '1',
                    transform: 'translateY(0)'
                });
            }).on('mouseleave', function() {
                $tooltip.css({
                    opacity: '0',
                    transform: 'translateY(10px)'
                });
            });
        });
    }

    /**
     * Modal Animations
     */
    function initializeModalAnimations() {
        $('[data-modal]').on('click', function() {
            const modalId = $(this).data('modal');
            const $modal = $(modalId);
            
            $modal.css({
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                opacity: '0',
                background: 'rgba(0, 0, 0, 0)'
            });

            requestAnimationFrame(() => {
                $modal.css({
                    opacity: '1',
                    background: 'rgba(0, 0, 0, 0.5)',
                    transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth}`
                });

                $modal.find('.modal-content').css({
                    transform: 'scale(0.7)',
                    opacity: '0'
                });

                setTimeout(() => {
                    $modal.find('.modal-content').css({
                        transform: 'scale(1)',
                        opacity: '1',
                        transition: `all ${defaultSettings.durations.normal} ${defaultSettings.easing.bounce}`
                    });
                }, 50);
            });
        });

        $('.modal-close, .modal-backdrop').on('click', function() {
            const $modal = $(this).closest('.modal');
            
            $modal.css({
                opacity: '0',
                background: 'rgba(0, 0, 0, 0)',
                transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
            });

            $modal.find('.modal-content').css({
                transform: 'scale(0.7)',
                opacity: '0',
                transition: `all ${defaultSettings.durations.fast} ${defaultSettings.easing.smooth}`
            });

            setTimeout(() => {
                $modal.css('display', 'none');
            }, parseFloat(defaultSettings.durations.fast) * 1000);
        });
    }

    /**
     * Typing Animations
     */
    function initializeTypingAnimations() {
        $('.typewriter').each(function() {
            const $element = $(this);
            const text = $element.text();
            const speed = $element.data('typing-speed') || 100;
            
            $element.text('').css('border-right', '2px solid #0d6efd');
            
            let i = 0;
            const typeText = () => {
                if (i < text.length) {
                    $element.text($element.text() + text.charAt(i));
                    i++;
                    setTimeout(typeText, speed);
                } else {
                    // Blinking cursor effect
                    setInterval(() => {
                        $element.css('border-right', $element.css('border-right') === '2px solid rgb(13, 110, 253)' ? 
                                   '2px solid transparent' : '2px solid #0d6efd');
                    }, 500);
                }
            };
            
            setTimeout(typeText, 1000); // Start after 1 second
        });
    }

    // Add CSS for animations
    const animationCSS = `
        <style id="dthree-micro-interactions-css">
        .dthree-animated {
            transition: all ${defaultSettings.durations.normal} ${defaultSettings.easing.smooth};
        }
        
        .btn-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            pointer-events: none;
            transform: scale(0);
        }
        
        .dthree-tooltip {
            z-index: 9999;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .fade-in-up.dthree-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .slide-in {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s ease;
        }
        
        .slide-in.dthree-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .typing {
            border-right: 2px solid #0d6efd;
            animation: blink 1s linear infinite;
        }
        
        @keyframes blink {
            0%, 50% { border-color: #0d6efd; }
            51%, 100% { border-color: transparent; }
        }
        
        .ajax-loading * {
            pointer-events: none;
        }
        
        .back-to-top:hover {
            transform: scale(1.1) !important;
            background: #0056b3 !important;
        }
        </style>
    `;
    
    $('head').append(animationCSS);

    // Expose API for external use
    window.DThreeMicroInteractions = {
        reinitialize: initializeMicroInteractions,
        settings: defaultSettings
    };

})(jQuery);
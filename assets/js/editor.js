/**
 * Block Editor JavaScript
 * 
 * @package DThree_Gutenberg
 */

(function() {
    'use strict';

    const { __ } = wp.i18n;
    const { registerBlockType } = wp.blocks;
    const { ServerSideRender } = wp.serverSideRender || wp.components;
    const { InspectorControls, MediaUpload, MediaUploadCheck } = wp.blockEditor || wp.editor;
    const { PanelBody, TextControl, TextareaControl, RangeControl, SelectControl, Button, ColorPicker } = wp.components;

    /**
     * Register DThree custom blocks
     * These blocks are rendered server-side but need editor registration
     */
    
    // Hero Section Block
    registerBlockType('dthree/hero-section', {
        title: __('Hero Section', 'dthree-gutenberg'),
        description: __('A customizable hero section with image, heading, text and call-to-action button.', 'dthree-gutenberg'),
        icon: 'format-image',
        category: 'dthree-blocks',
        keywords: ['hero', 'banner', 'header'],
        supports: {
            align: ['wide', 'full'],
            anchor: true,
        },
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/hero-section',
                attributes: props.attributes
            });
        },
        save: function() {
            return null; // Server-side rendered
        }
    });

    // Features Block
    registerBlockType('dthree/features', {
        title: __('Features', 'dthree-gutenberg'),
        description: __('Display features in a grid layout.', 'dthree-gutenberg'),
        icon: 'grid-view',
        category: 'dthree-blocks',
        keywords: ['features', 'grid', 'services'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/features',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Call to Action Block
    registerBlockType('dthree/call-to-action', {
        title: __('Call to Action', 'dthree-gutenberg'),
        description: __('A customizable call-to-action section.', 'dthree-gutenberg'),
        icon: 'megaphone',
        category: 'dthree-blocks',
        keywords: ['cta', 'call', 'action', 'button'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/call-to-action',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Team Members Block
    registerBlockType('dthree/team-members', {
        title: __('Team Members', 'dthree-gutenberg'),
        description: __('Display team members in a grid.', 'dthree-gutenberg'),
        icon: 'groups',
        category: 'dthree-blocks',
        keywords: ['team', 'members', 'staff', 'people'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/team-members',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Testimonials Block
    registerBlockType('dthree/testimonials', {
        title: __('Testimonials', 'dthree-gutenberg'),
        description: __('Display customer testimonials.', 'dthree-gutenberg'),
        icon: 'testimonial',
        category: 'dthree-blocks',
        keywords: ['testimonials', 'reviews', 'feedback'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/testimonials',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Contact Form Block
    registerBlockType('dthree/contact-form', {
        title: __('Contact Form', 'dthree-gutenberg'),
        description: __('A simple contact form.', 'dthree-gutenberg'),
        icon: 'email',
        category: 'dthree-blocks',
        keywords: ['contact', 'form', 'email'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/contact-form',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Image Slider Block
    registerBlockType('dthree/image-slider', {
        title: __('Image Slider', 'dthree-gutenberg'),
        description: __('An image carousel/slider.', 'dthree-gutenberg'),
        icon: 'images-alt2',
        category: 'dthree-blocks',
        keywords: ['slider', 'carousel', 'images'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/image-slider',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Content Slider Block
    registerBlockType('dthree/content-slider', {
        title: __('Content Slider', 'dthree-gutenberg'),
        description: __('A slider for content sections.', 'dthree-gutenberg'),
        icon: 'slides',
        category: 'dthree-blocks',
        keywords: ['slider', 'carousel', 'content'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/content-slider',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Card Slider Block
    registerBlockType('dthree/card-slider', {
        title: __('Card Slider', 'dthree-gutenberg'),
        description: __('A slider with card layouts.', 'dthree-gutenberg'),
        icon: 'slides',
        category: 'dthree-blocks',
        keywords: ['slider', 'cards', 'carousel'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/card-slider',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Testimonial Slider Block
    registerBlockType('dthree/testimonial-slider', {
        title: __('Testimonial Slider', 'dthree-gutenberg'),
        description: __('A slider for testimonials.', 'dthree-gutenberg'),
        icon: 'slides',
        category: 'dthree-blocks',
        keywords: ['slider', 'testimonials', 'carousel'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/testimonial-slider',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Logo Slider Block
    registerBlockType('dthree/logo-slider', {
        title: __('Logo Slider', 'dthree-gutenberg'),
        description: __('A slider for logos.', 'dthree-gutenberg'),
        icon: 'slides',
        category: 'dthree-blocks',
        keywords: ['slider', 'logos', 'carousel'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/logo-slider',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Accordion Block
    registerBlockType('dthree/accordion', {
        title: __('Accordion', 'dthree-gutenberg'),
        description: __('Collapsible content sections.', 'dthree-gutenberg'),
        icon: 'list-view',
        category: 'dthree-blocks',
        keywords: ['accordion', 'collapse', 'faq'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/accordion',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Tabs Block
    registerBlockType('dthree/tabs', {
        title: __('Tabs', 'dthree-gutenberg'),
        description: __('Tabbed content sections.', 'dthree-gutenberg'),
        icon: 'table-col-before',
        category: 'dthree-blocks',
        keywords: ['tabs', 'tabbed', 'navigation'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/tabs',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Modal Block
    registerBlockType('dthree/modal', {
        title: __('Modal', 'dthree-gutenberg'),
        description: __('A popup modal dialog.', 'dthree-gutenberg'),
        icon: 'welcome-view-site',
        category: 'dthree-blocks',
        keywords: ['modal', 'popup', 'dialog'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/modal',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Progress Bars Block
    registerBlockType('dthree/progress-bars', {
        title: __('Progress Bars', 'dthree-gutenberg'),
        description: __('Animated progress bars.', 'dthree-gutenberg'),
        icon: 'chart-bar',
        category: 'dthree-blocks',
        keywords: ['progress', 'bars', 'skills'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/progress-bars',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Icon Boxes Block
    registerBlockType('dthree/icon-boxes', {
        title: __('Icon Boxes', 'dthree-gutenberg'),
        description: __('Display content in icon boxes.', 'dthree-gutenberg'),
        icon: 'screenoptions',
        category: 'dthree-blocks',
        keywords: ['icon', 'boxes', 'features'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/icon-boxes',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Pricing Tables Block
    registerBlockType('dthree/pricing-tables', {
        title: __('Pricing Tables', 'dthree-gutenberg'),
        description: __('Display pricing plans.', 'dthree-gutenberg'),
        icon: 'money-alt',
        category: 'dthree-blocks',
        keywords: ['pricing', 'tables', 'plans'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/pricing-tables',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Timeline Block
    registerBlockType('dthree/timeline', {
        title: __('Timeline', 'dthree-gutenberg'),
        description: __('Display events in a timeline.', 'dthree-gutenberg'),
        icon: 'backup',
        category: 'dthree-blocks',
        keywords: ['timeline', 'history', 'events'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/timeline',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Social Share Block
    registerBlockType('dthree/social-share', {
        title: __('Social Share', 'dthree-gutenberg'),
        description: __('Social media sharing buttons.', 'dthree-gutenberg'),
        icon: 'share',
        category: 'dthree-blocks',
        keywords: ['social', 'share', 'buttons'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/social-share',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Video Player Block
    registerBlockType('dthree/video-player', {
        title: __('Video Player', 'dthree-gutenberg'),
        description: __('Embed videos with custom player.', 'dthree-gutenberg'),
        icon: 'video-alt3',
        category: 'dthree-blocks',
        keywords: ['video', 'player', 'embed'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/video-player',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Charts Block
    registerBlockType('dthree/charts', {
        title: __('Charts', 'dthree-gutenberg'),
        description: __('Display data in charts.', 'dthree-gutenberg'),
        icon: 'chart-area',
        category: 'dthree-blocks',
        keywords: ['charts', 'graphs', 'data'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/charts',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Data Table Block
    registerBlockType('dthree/data-table', {
        title: __('Data Table', 'dthree-gutenberg'),
        description: __('Display data in tables.', 'dthree-gutenberg'),
        icon: 'list-view',
        category: 'dthree-blocks',
        keywords: ['table', 'data', 'grid'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/data-table',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    // Alerts Block
    registerBlockType('dthree/alerts', {
        title: __('Alerts', 'dthree-gutenberg'),
        description: __('Display alert messages.', 'dthree-gutenberg'),
        icon: 'warning',
        category: 'dthree-blocks',
        keywords: ['alerts', 'notifications', 'messages'],
        edit: function(props) {
            return wp.element.createElement(ServerSideRender, {
                block: 'dthree/alerts',
                attributes: props.attributes
            });
        },
        save: function() {
            return null;
        }
    });

    /**
     * Register block styles for core blocks
     */
    wp.domReady(function() {
        
        // Button block styles
        wp.blocks.registerBlockStyle('core/button', {
            name: 'bootstrap-primary',
            label: __('Bootstrap Primary', 'dthree-gutenberg'),
        });

        wp.blocks.registerBlockStyle('core/button', {
            name: 'bootstrap-outline',
            label: __('Bootstrap Outline', 'dthree-gutenberg'),
        });

        // Quote block styles
        wp.blocks.registerBlockStyle('core/quote', {
            name: 'bootstrap-blockquote',
            label: __('Bootstrap Style', 'dthree-gutenberg'),
        });

        // Image block styles
        wp.blocks.registerBlockStyle('core/image', {
            name: 'rounded',
            label: __('Rounded', 'dthree-gutenberg'),
        });

        wp.blocks.registerBlockStyle('core/image', {
            name: 'shadow',
            label: __('With Shadow', 'dthree-gutenberg'),
        });

    });

})();

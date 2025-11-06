/**
 * Block Editor JavaScript
 * 
 * @package DThree_Gutenberg
 */

(function() {
    'use strict';

    const { __ } = wp.i18n;

    /**
     * Register block styles
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

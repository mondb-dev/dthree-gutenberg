/**
 * DThree Design System - Generated CSS
 * Generated on: <?php echo date( 'Y-m-d H:i:s' ); ?>
 *
 * @package DThree_Gutenberg
 */

/* CSS Custom Properties (Variables) */
:root {
    /* Colors */
<?php foreach ( $settings['colors'] as $color_key => $color_value ) : ?>
    --dthree-color-<?php echo esc_attr( str_replace( '_', '-', $color_key ) ); ?>: <?php echo esc_attr( $color_value ); ?>;
<?php endforeach; ?>

    /* Color variations */
    --dthree-color-primary-light: color-mix(in srgb, var(--dthree-color-primary) 80%, white);
    --dthree-color-primary-dark: color-mix(in srgb, var(--dthree-color-primary) 80%, black);
    --dthree-color-secondary-light: color-mix(in srgb, var(--dthree-color-secondary) 80%, white);
    --dthree-color-secondary-dark: color-mix(in srgb, var(--dthree-color-secondary) 80%, black);

    /* Typography */
    --dthree-font-family-primary: '<?php echo esc_attr( $settings['typography']['font_family_primary']['family'] ); ?>', <?php echo esc_attr( $settings['typography']['font_family_primary']['fallbacks'] ); ?>;
    --dthree-font-family-secondary: '<?php echo esc_attr( $settings['typography']['font_family_secondary']['family'] ); ?>', <?php echo esc_attr( $settings['typography']['font_family_secondary']['fallbacks'] ); ?>;

    /* Font Sizes */
<?php foreach ( $settings['typography']['font_sizes'] as $size_key => $size_value ) : ?>
    --dthree-font-size-<?php echo esc_attr( str_replace( '_', '-', $size_key ) ); ?>: <?php echo esc_attr( $size_value ); ?>;
<?php endforeach; ?>

    /* Line Heights */
<?php foreach ( $settings['typography']['line_heights'] as $height_key => $height_value ) : ?>
    --dthree-line-height-<?php echo esc_attr( str_replace( '_', '-', $height_key ) ); ?>: <?php echo esc_attr( $height_value ); ?>;
<?php endforeach; ?>

    /* Spacing */
<?php foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
    --dthree-space-<?php echo esc_attr( str_replace( '_', '-', $space_key ) ); ?>: <?php echo esc_attr( $space_value ); ?>;
<?php endforeach; ?>

    /* Border Radius */
<?php foreach ( $settings['border_radius'] as $radius_key => $radius_value ) : ?>
    --dthree-radius-<?php echo esc_attr( str_replace( '_', '-', $radius_key ) ); ?>: <?php echo esc_attr( $radius_value ); ?>;
<?php endforeach; ?>

    /* Shadows */
<?php foreach ( $settings['shadows'] as $shadow_key => $shadow_value ) : ?>
    --dthree-shadow-<?php echo esc_attr( str_replace( '_', '-', $shadow_key ) ); ?>: <?php echo esc_attr( $shadow_value ); ?>;
<?php endforeach; ?>

    /* Animation Properties */
<?php foreach ( $settings['animations']['duration'] as $duration_key => $duration_value ) : ?>
    --dthree-duration-<?php echo esc_attr( str_replace( '_', '-', $duration_key ) ); ?>: <?php echo esc_attr( $duration_value ); ?>;
<?php endforeach; ?>

<?php foreach ( $settings['animations']['easing'] as $easing_key => $easing_value ) : ?>
    --dthree-easing-<?php echo esc_attr( str_replace( '_', '-', $easing_key ) ); ?>: <?php echo esc_attr( $easing_value ); ?>;
<?php endforeach; ?>
}

/* Base Typography */
body {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-base);
    line-height: var(--dthree-line-height-normal);
    color: var(--dthree-color-dark);
}

/* Heading Styles */
h1, .h1 {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-5xl);
    line-height: var(--dthree-line-height-tight);
    font-weight: 700;
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-lg);
}

h2, .h2 {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-4xl);
    line-height: var(--dthree-line-height-tight);
    font-weight: 600;
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-md);
}

h3, .h3 {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-3xl);
    line-height: var(--dthree-line-height-tight);
    font-weight: 600;
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-md);
}

h4, .h4 {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-2xl);
    line-height: var(--dthree-line-height-normal);
    font-weight: 500;
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-sm);
}

h5, .h5 {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-xl);
    line-height: var(--dthree-line-height-normal);
    font-weight: 500;
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-sm);
}

h6, .h6 {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-lg);
    line-height: var(--dthree-line-height-normal);
    font-weight: 500;
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-sm);
}

/* Paragraph and Text Styles */
p, .body-text {
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-base);
    line-height: var(--dthree-line-height-relaxed);
    color: var(--dthree-color-dark);
    margin-bottom: var(--dthree-space-md);
}

.lead {
    font-size: var(--dthree-font-size-lg);
    line-height: var(--dthree-line-height-relaxed);
    font-weight: 300;
    color: var(--dthree-color-secondary);
}

.caption, .small-text {
    font-size: var(--dthree-font-size-sm);
    line-height: var(--dthree-line-height-normal);
    color: var(--dthree-color-secondary);
}

/* Button Components */
<?php foreach ( $settings['buttons'] as $button_key => $button_config ) : ?>
.btn-<?php echo esc_attr( $button_key ); ?>,
.dthree-btn-<?php echo esc_attr( $button_key ); ?> {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: <?php echo esc_attr( $button_config['padding'] ); ?>;
    background: <?php echo esc_attr( $button_config['background'] ); ?>;
    color: <?php echo esc_attr( $button_config['color'] ); ?>;
    border: 2px solid <?php echo esc_attr( $button_config['border'] ); ?>;
    border-radius: <?php echo esc_attr( $button_config['border_radius'] ); ?>;
    font-weight: <?php echo esc_attr( $button_config['font_weight'] ); ?>;
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-base);
    text-decoration: none;
    cursor: pointer;
    transition: <?php echo esc_attr( $button_config['transition'] ); ?>;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-<?php echo esc_attr( $button_key ); ?>::before,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left var(--dthree-duration-fast) var(--dthree-easing-smooth);
    z-index: -1;
}

.btn-<?php echo esc_attr( $button_key ); ?>:hover,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>:hover {
    background: <?php echo esc_attr( $button_config['hover_background'] ?? $button_config['background'] ); ?>;
    <?php if ( isset( $button_config['hover_color'] ) ) : ?>
    color: <?php echo esc_attr( $button_config['hover_color'] ); ?>;
    <?php endif; ?>
    transform: var(--dthree-hover-lift, translateY(-1px));
    box-shadow: var(--dthree-shadow-md);
}

.btn-<?php echo esc_attr( $button_key ); ?>:hover::before,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>:hover::before {
    left: 100%;
}

.btn-<?php echo esc_attr( $button_key ); ?>:active,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>:active {
    transform: translateY(0);
    box-shadow: var(--dthree-shadow-sm);
}

.btn-<?php echo esc_attr( $button_key ); ?>:focus,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>:focus {
    outline: 2px solid var(--dthree-color-primary);
    outline-offset: 2px;
}

/* Button sizes */
.btn-<?php echo esc_attr( $button_key ); ?>.btn-sm,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>.btn-sm {
    padding: var(--dthree-space-xs) var(--dthree-space-md);
    font-size: var(--dthree-font-size-sm);
}

.btn-<?php echo esc_attr( $button_key ); ?>.btn-lg,
.dthree-btn-<?php echo esc_attr( $button_key ); ?>.btn-lg {
    padding: var(--dthree-space-lg) var(--dthree-space-2xl);
    font-size: var(--dthree-font-size-lg);
}

<?php endforeach; ?>

/* Card Components */
.dthree-card {
    background: var(--dthree-color-white);
    border-radius: var(--dthree-radius-lg);
    box-shadow: var(--dthree-shadow-base);
    padding: var(--dthree-space-xl);
    transition: all var(--dthree-duration-normal) var(--dthree-easing-smooth);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.dthree-card:hover {
    transform: <?php echo esc_attr( $settings['animations']['hover_effects']['lift'] ); ?>;
    box-shadow: var(--dthree-shadow-lg);
}

.dthree-card-header {
    padding-bottom: var(--dthree-space-md);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    margin-bottom: var(--dthree-space-md);
}

.dthree-card-title {
    margin: 0;
    font-size: var(--dthree-font-size-xl);
    font-weight: 600;
    color: var(--dthree-color-dark);
}

.dthree-card-body {
    color: var(--dthree-color-secondary);
    line-height: var(--dthree-line-height-relaxed);
}

/* Form Elements */
.dthree-input,
.dthree-textarea,
.dthree-select {
    width: 100%;
    padding: var(--dthree-space-sm) var(--dthree-space-md);
    border: 2px solid var(--dthree-color-light);
    border-radius: var(--dthree-radius-md);
    font-family: var(--dthree-font-family-primary);
    font-size: var(--dthree-font-size-base);
    line-height: var(--dthree-line-height-normal);
    color: var(--dthree-color-dark);
    background: var(--dthree-color-white);
    transition: all var(--dthree-duration-fast) var(--dthree-easing-smooth);
}

.dthree-input:focus,
.dthree-textarea:focus,
.dthree-select:focus {
    outline: none;
    border-color: var(--dthree-color-primary);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

.dthree-input:hover,
.dthree-textarea:hover,
.dthree-select:hover {
    border-color: var(--dthree-color-secondary);
}

/* Image Styles */
.dthree-img {
    max-width: 100%;
    height: auto;
    border-radius: var(--dthree-radius-md);
    transition: all var(--dthree-duration-normal) var(--dthree-easing-smooth);
}

.dthree-img-rounded {
    border-radius: var(--dthree-radius-full);
}

.dthree-img-square {
    border-radius: var(--dthree-radius-none);
}

.dthree-img:hover {
    transform: <?php echo esc_attr( $settings['animations']['hover_effects']['scale'] ); ?>;
    box-shadow: var(--dthree-shadow-lg);
}

/* Navigation Styles */
.dthree-nav {
    background: var(--dthree-color-white);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: all var(--dthree-duration-normal) var(--dthree-easing-smooth);
}

.dthree-nav-item {
    padding: var(--dthree-space-sm) var(--dthree-space-md);
    color: var(--dthree-color-dark);
    text-decoration: none;
    font-weight: 500;
    transition: all var(--dthree-duration-fast) var(--dthree-easing-smooth);
    position: relative;
}

.dthree-nav-item::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: var(--dthree-color-primary);
    transition: all var(--dthree-duration-normal) var(--dthree-easing-smooth);
    transform: translateX(-50%);
}

.dthree-nav-item:hover {
    color: var(--dthree-color-primary);
}

.dthree-nav-item:hover::after,
.dthree-nav-item.active::after {
    width: 100%;
}

/* Utility Classes */
.dthree-text-center { text-align: center; }
.dthree-text-left { text-align: left; }
.dthree-text-right { text-align: right; }

.dthree-color-primary { color: var(--dthree-color-primary); }
.dthree-color-secondary { color: var(--dthree-color-secondary); }
.dthree-color-success { color: var(--dthree-color-success); }
.dthree-color-danger { color: var(--dthree-color-danger); }
.dthree-color-warning { color: var(--dthree-color-warning); }
.dthree-color-info { color: var(--dthree-color-info); }

.dthree-bg-primary { background-color: var(--dthree-color-primary); color: var(--dthree-color-white); }
.dthree-bg-secondary { background-color: var(--dthree-color-secondary); color: var(--dthree-color-white); }
.dthree-bg-light { background-color: var(--dthree-color-light); color: var(--dthree-color-dark); }
.dthree-bg-dark { background-color: var(--dthree-color-dark); color: var(--dthree-color-white); }

/* Section Layout Components */
<?php foreach ( $settings['section_layouts']['container_types'] as $type_key => $container_type ) : ?>
.<?php echo esc_attr( $container_type['css_class'] ); ?> {
<?php if ( isset( $container_type['max_width'] ) && $container_type['max_width'] !== 'none' ) : ?>
    max-width: <?php echo esc_attr( $container_type['max_width'] ); ?>;
<?php endif; ?>
<?php if ( isset( $container_type['padding'] ) && $container_type['padding'] !== '0' ) : ?>
    padding: <?php echo esc_attr( $container_type['padding'] ); ?>;
<?php endif; ?>
<?php if ( isset( $container_type['margin'] ) ) : ?>
    margin: <?php echo esc_attr( $container_type['margin'] ); ?>;
<?php endif; ?>
    box-sizing: border-box;
}
<?php endforeach; ?>

<?php foreach ( $settings['section_layouts']['section_styles'] as $style_key => $section_style ) : ?>
.dthree-section-<?php echo esc_attr( $style_key ); ?> {
<?php if ( isset( $section_style['padding_y'] ) ) : ?>
    padding-top: <?php echo esc_attr( $section_style['padding_y'] ); ?>;
    padding-bottom: <?php echo esc_attr( $section_style['padding_y'] ); ?>;
<?php endif; ?>
<?php if ( isset( $section_style['background'] ) ) : ?>
    background: <?php echo esc_attr( $section_style['background'] ); ?>;
<?php endif; ?>
<?php if ( isset( $section_style['color'] ) ) : ?>
    color: <?php echo esc_attr( $section_style['color'] ); ?>;
<?php endif; ?>
<?php if ( isset( $section_style['border'] ) ) : ?>
    border: <?php echo esc_attr( $section_style['border'] ); ?>;
<?php endif; ?>
<?php if ( isset( $section_style['border_radius'] ) ) : ?>
    border-radius: <?php echo esc_attr( $section_style['border_radius'] ); ?>;
<?php endif; ?>
<?php if ( isset( $section_style['text_align'] ) ) : ?>
    text-align: <?php echo esc_attr( $section_style['text_align'] ); ?>;
<?php endif; ?>
}
<?php endforeach; ?>

/* Menu Components */
/* Base Menu Styles */
.dthree-menu-base,
[class*="dthree-menu-"] {
    font-family: <?php echo esc_attr( $settings['menu_builder']['typography']['font_family'] ?? 'var(--dthree-font-family-primary)' ); ?>;
    font-size: <?php echo esc_attr( $settings['menu_builder']['typography']['font_size'] ?? 'var(--dthree-font-size-base)' ); ?>;
    font-weight: <?php echo esc_attr( $settings['menu_builder']['typography']['font_weight'] ?? '500' ); ?>;
    text-transform: <?php echo esc_attr( $settings['menu_builder']['typography']['text_transform'] ?? 'none' ); ?>;
    letter-spacing: <?php echo esc_attr( $settings['menu_builder']['typography']['letter_spacing'] ?? '0' ); ?>;
}

<?php foreach ( $settings['menu_builder']['menu_styles'] as $menu_key => $menu_style ) : ?>
/* <?php echo esc_attr( $menu_style['label'] ); ?> Menu */
.<?php echo esc_attr( $menu_style['css_class'] ); ?> {
    display: <?php echo esc_attr( $menu_style['display'] ?? 'flex' ); ?>;
<?php if ( isset( $menu_style['flex_direction'] ) ) : ?>
    flex-direction: <?php echo esc_attr( $menu_style['flex_direction'] ); ?>;
<?php endif; ?>
<?php if ( isset( $menu_style['align_items'] ) ) : ?>
    align-items: <?php echo esc_attr( $menu_style['align_items'] ); ?>;
<?php endif; ?>
<?php if ( isset( $menu_style['justify_content'] ) ) : ?>
    justify-content: <?php echo esc_attr( $menu_style['justify_content'] ); ?>;
<?php endif; ?>
<?php if ( isset( $menu_style['gap'] ) ) : ?>
    gap: <?php echo esc_attr( $menu_style['gap'] ); ?>;
<?php endif; ?>
    list-style: none;
    margin: 0;
    padding: 0;
}

.<?php echo esc_attr( $menu_style['css_class'] ); ?> .menu-item {
    padding: <?php echo esc_attr( $settings['menu_builder']['menu_item_styles']['padding'] ?? 'var(--dthree-space-sm) var(--dthree-space-md)' ); ?>;
    border-radius: <?php echo esc_attr( $settings['menu_builder']['menu_item_styles']['border_radius'] ?? 'var(--dthree-radius-sm)' ); ?>;
    transition: <?php echo esc_attr( $settings['menu_builder']['menu_item_styles']['transition'] ?? 'all 0.2s ease' ); ?>;
    text-decoration: none;
    color: inherit;
    position: relative;
}

.<?php echo esc_attr( $menu_style['css_class'] ); ?> .menu-item:hover {
    background-color: <?php echo esc_attr( $settings['menu_builder']['menu_item_styles']['hover_background'] ?? 'rgba(13, 110, 253, 0.1)' ); ?>;
}

.<?php echo esc_attr( $menu_style['css_class'] ); ?> .menu-item.active,
.<?php echo esc_attr( $menu_style['css_class'] ); ?> .menu-item.current-menu-item {
    background-color: <?php echo esc_attr( $settings['menu_builder']['menu_item_styles']['active_background'] ?? 'var(--dthree-color-primary)' ); ?>;
    color: <?php echo esc_attr( $settings['menu_builder']['menu_item_styles']['active_color'] ?? 'var(--dthree-color-white)' ); ?>;
}
<?php endforeach; ?>

/* Dropdown Menu Styles */
.menu-item.has-dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.menu-item.has-dropdown:hover .dropdown-menu,
.menu-item.has-dropdown.open .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

<?php foreach ( $settings['menu_builder']['dropdown_styles'] as $dropdown_key => $dropdown_style ) : ?>
.dropdown-<?php echo esc_attr( $dropdown_key ); ?> {
    background: <?php echo esc_attr( $dropdown_style['background'] ?? 'var(--dthree-color-white)' ); ?>;
    border: <?php echo esc_attr( $dropdown_style['border'] ?? '1px solid var(--dthree-color-border)' ); ?>;
    border-radius: <?php echo esc_attr( $dropdown_style['border_radius'] ?? 'var(--dthree-radius-md)' ); ?>;
    box-shadow: <?php echo esc_attr( $dropdown_style['box_shadow'] ?? '0 4px 12px rgba(0,0,0,0.1)' ); ?>;
    padding: <?php echo esc_attr( $dropdown_style['padding'] ?? 'var(--dthree-space-sm)' ); ?>;
    min-width: <?php echo esc_attr( $dropdown_style['min_width'] ?? '200px' ); ?>;
<?php if ( isset( $dropdown_style['width'] ) ) : ?>
    width: <?php echo esc_attr( $dropdown_style['width'] ); ?>;
<?php endif; ?>
<?php if ( isset( $dropdown_style['max_width'] ) ) : ?>
    max-width: <?php echo esc_attr( $dropdown_style['max_width'] ); ?>;
<?php endif; ?>
}

.dropdown-<?php echo esc_attr( $dropdown_key ); ?> .dropdown-item {
    display: block;
    padding: var(--dthree-space-xs) var(--dthree-space-sm);
    color: var(--dthree-color-dark);
    text-decoration: none;
    border-radius: var(--dthree-radius-sm);
    transition: background-color 0.2s ease;
}

.dropdown-<?php echo esc_attr( $dropdown_key ); ?> .dropdown-item:hover {
    background-color: var(--dthree-color-light);
}
<?php endforeach; ?>

/* Mega Menu Specific Styles */
.mega-dropdown {
    position: static;
    width: 100%;
    display: grid;
    grid-template-columns: <?php echo esc_attr( $settings['menu_builder']['dropdown_styles']['mega']['columns'] ?? 'repeat(auto-fit, minmax(200px, 1fr))' ); ?>;
    gap: var(--dthree-space-lg);
    left: 0;
    right: 0;
}

.mega-column h5 {
    margin: 0 0 var(--dthree-space-sm) 0;
    font-size: var(--dthree-font-size-sm);
    font-weight: 600;
    color: var(--dthree-color-dark);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mega-column a {
    display: block;
    padding: var(--dthree-space-xs) 0;
    color: var(--dthree-color-secondary);
    text-decoration: none;
    font-size: var(--dthree-font-size-sm);
    transition: color 0.2s ease;
}

.mega-column a:hover {
    color: var(--dthree-color-primary);
}

/* Mobile Menu Styles */
.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: <?php echo esc_attr( $settings['menu_builder']['mobile_menu']['overlay_background'] ?? 'rgba(0,0,0,0.5)' ); ?>;
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
}

.mobile-menu {
    position: fixed;
    top: 0;
    width: <?php echo esc_attr( $settings['menu_builder']['mobile_menu']['width'] ?? '280px' ); ?>;
    height: 100%;
    background: <?php echo esc_attr( $settings['menu_builder']['mobile_menu']['background'] ?? 'var(--dthree-color-white)' ); ?>;
    z-index: 1000;
    transition: transform <?php echo esc_attr( $settings['menu_builder']['mobile_menu']['animation_duration'] ?? '0.3s' ); ?> ease;
    overflow-y: auto;
    padding: var(--dthree-space-lg);
}

.mobile-menu-left {
    left: 0;
    transform: translateX(-100%);
}

.mobile-menu-right {
    right: 0;
    transform: translateX(100%);
}

.mobile-menu-top {
    top: 0;
    left: 0;
    width: 100%;
    height: auto;
    max-height: 60vh;
    transform: translateY(-100%);
}

.mobile-menu.active.mobile-menu-left,
.mobile-menu.active.mobile-menu-right,
.mobile-menu.active.mobile-menu-top {
    transform: translate(0);
}

.mobile-menu-item {
    display: block;
    padding: var(--dthree-space-sm) var(--dthree-space-md);
    color: var(--dthree-color-dark);
    text-decoration: none;
    border-bottom: 1px solid var(--dthree-color-light);
    transition: background-color 0.2s ease;
}

.mobile-menu-item:hover {
    background-color: var(--dthree-color-light);
}

.mobile-menu-item:last-child {
    border-bottom: none;
}

/* Hamburger Menu Styles */
.hamburger-menu {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 24px;
    height: 24px;
    cursor: pointer;
    position: relative;
}

.hamburger-lines span {
    display: block;
    width: 100%;
    height: 2px;
    background: currentColor;
    margin: 3px 0;
    transition: all 0.3s ease;
}

.hamburger-lines.active span:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

.hamburger-lines.active span:nth-child(2) {
    opacity: 0;
}

.hamburger-lines.active span:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
}

.hamburger-dots span {
    display: block;
    width: 4px;
    height: 4px;
    background: currentColor;
    border-radius: 50%;
    margin: 2px 0;
    transition: all 0.3s ease;
}

.hamburger-arrow span {
    display: block;
    width: 100%;
    height: 2px;
    background: currentColor;
    margin: 2px 0;
    transition: all 0.3s ease;
}

.hamburger-arrow span:nth-child(1) {
    transform-origin: left top;
}

.hamburger-arrow span:nth-child(3) {
    transform-origin: left bottom;
}

.hamburger-arrow.active span:nth-child(1) {
    transform: rotate(45deg);
    width: 70%;
}

.hamburger-arrow.active span:nth-child(2) {
    width: 70%;
}

.hamburger-arrow.active span:nth-child(3) {
    transform: rotate(-45deg);
    width: 70%;
}

/* Spacing Utilities */
<?php foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
.dthree-m-<?php echo esc_attr( $space_key ); ?> { margin: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mt-<?php echo esc_attr( $space_key ); ?> { margin-top: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mb-<?php echo esc_attr( $space_key ); ?> { margin-bottom: <?php echo esc_attr( $space_value ); ?>; }
.dthree-ml-<?php echo esc_attr( $space_key ); ?> { margin-left: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mr-<?php echo esc_attr( $space_key ); ?> { margin-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mx-<?php echo esc_attr( $space_key ); ?> { margin-left: <?php echo esc_attr( $space_value ); ?>; margin-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-my-<?php echo esc_attr( $space_key ); ?> { margin-top: <?php echo esc_attr( $space_value ); ?>; margin-bottom: <?php echo esc_attr( $space_value ); ?>; }

.dthree-p-<?php echo esc_attr( $space_key ); ?> { padding: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pt-<?php echo esc_attr( $space_key ); ?> { padding-top: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pb-<?php echo esc_attr( $space_key ); ?> { padding-bottom: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pl-<?php echo esc_attr( $space_key ); ?> { padding-left: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pr-<?php echo esc_attr( $space_key ); ?> { padding-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-px-<?php echo esc_attr( $space_key ); ?> { padding-left: <?php echo esc_attr( $space_value ); ?>; padding-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-py-<?php echo esc_attr( $space_key ); ?> { padding-top: <?php echo esc_attr( $space_value ); ?>; padding-bottom: <?php echo esc_attr( $space_value ); ?>; }

<?php endforeach; ?>

/* Border Radius Utilities */
<?php foreach ( $settings['border_radius'] as $radius_key => $radius_value ) : ?>
.dthree-rounded-<?php echo esc_attr( $radius_key ); ?> { border-radius: <?php echo esc_attr( $radius_value ); ?>; }
<?php endforeach; ?>

/* Shadow Utilities */
<?php foreach ( $settings['shadows'] as $shadow_key => $shadow_value ) : ?>
.dthree-shadow-<?php echo esc_attr( $shadow_key ); ?> { box-shadow: <?php echo esc_attr( $shadow_value ); ?>; }
<?php endforeach; ?>

/* Animation Classes */
.dthree-animate {
    transition: all var(--dthree-duration-normal) var(--dthree-easing-smooth);
}

.dthree-animate-fast {
    transition: all var(--dthree-duration-fast) var(--dthree-easing-smooth);
}

.dthree-animate-slow {
    transition: all var(--dthree-duration-slow) var(--dthree-easing-smooth);
}

.dthree-hover-lift:hover {
    transform: <?php echo esc_attr( $settings['animations']['hover_effects']['lift'] ); ?>;
}

.dthree-hover-scale:hover {
    transform: <?php echo esc_attr( $settings['animations']['hover_effects']['scale'] ); ?>;
}

.dthree-hover-rotate:hover {
    transform: <?php echo esc_attr( $settings['animations']['hover_effects']['rotate'] ); ?>;
}

/* Responsive Design */
/* Mobile First Approach - Base styles are mobile */

/* Container and Grid System */
.dthree-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--dthree-space-md);
}

.dthree-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 calc(-1 * var(--dthree-space-sm));
}

.dthree-col {
    flex: 1;
    padding: 0 var(--dthree-space-sm);
    min-width: 0;
}

/* Mobile Grid Classes */
.dthree-col-12 { flex: 0 0 100%; max-width: 100%; }
.dthree-col-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
.dthree-col-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
.dthree-col-9 { flex: 0 0 75%; max-width: 75%; }
.dthree-col-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
.dthree-col-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
.dthree-col-6 { flex: 0 0 50%; max-width: 50%; }
.dthree-col-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
.dthree-col-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
.dthree-col-3 { flex: 0 0 25%; max-width: 25%; }
.dthree-col-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
.dthree-col-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }

/* Responsive Typography - Mobile Base */
.dthree-text-sm-left { text-align: left; }
.dthree-text-sm-center { text-align: center; }
.dthree-text-sm-right { text-align: right; }

/* Display utilities - Mobile */
.dthree-d-none { display: none; }
.dthree-d-block { display: block; }
.dthree-d-inline { display: inline; }
.dthree-d-inline-block { display: inline-block; }
.dthree-d-flex { display: flex; }

/* Flex utilities */
.dthree-flex-row { flex-direction: row; }
.dthree-flex-column { flex-direction: column; }
.dthree-flex-wrap { flex-wrap: wrap; }
.dthree-flex-nowrap { flex-wrap: nowrap; }
.dthree-justify-start { justify-content: flex-start; }
.dthree-justify-center { justify-content: center; }
.dthree-justify-end { justify-content: flex-end; }
.dthree-justify-between { justify-content: space-between; }
.dthree-align-start { align-items: flex-start; }
.dthree-align-center { align-items: center; }
.dthree-align-end { align-items: flex-end; }

/* Mobile Spacing Utilities */
<?php 
$breakpoints = array('sm' => '');
foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
/* Mobile spacing for <?php echo esc_attr( $space_key ); ?> */
.dthree-m-sm-<?php echo esc_attr( $space_key ); ?> { margin: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mt-sm-<?php echo esc_attr( $space_key ); ?> { margin-top: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mb-sm-<?php echo esc_attr( $space_key ); ?> { margin-bottom: <?php echo esc_attr( $space_value ); ?>; }
.dthree-ml-sm-<?php echo esc_attr( $space_key ); ?> { margin-left: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mr-sm-<?php echo esc_attr( $space_key ); ?> { margin-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-mx-sm-<?php echo esc_attr( $space_key ); ?> { margin-left: <?php echo esc_attr( $space_value ); ?>; margin-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-my-sm-<?php echo esc_attr( $space_key ); ?> { margin-top: <?php echo esc_attr( $space_value ); ?>; margin-bottom: <?php echo esc_attr( $space_value ); ?>; }

.dthree-p-sm-<?php echo esc_attr( $space_key ); ?> { padding: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pt-sm-<?php echo esc_attr( $space_key ); ?> { padding-top: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pb-sm-<?php echo esc_attr( $space_key ); ?> { padding-bottom: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pl-sm-<?php echo esc_attr( $space_key ); ?> { padding-left: <?php echo esc_attr( $space_value ); ?>; }
.dthree-pr-sm-<?php echo esc_attr( $space_key ); ?> { padding-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-px-sm-<?php echo esc_attr( $space_key ); ?> { padding-left: <?php echo esc_attr( $space_value ); ?>; padding-right: <?php echo esc_attr( $space_value ); ?>; }
.dthree-py-sm-<?php echo esc_attr( $space_key ); ?> { padding-top: <?php echo esc_attr( $space_value ); ?>; padding-bottom: <?php echo esc_attr( $space_value ); ?>; }
<?php endforeach; ?>

/* Tablet Breakpoint (768px and up) */
@media (min-width: 768px) {
    .dthree-container {
        padding: 0 var(--dthree-space-lg);
    }
    
    /* Tablet Grid Classes */
    .dthree-col-md-12 { flex: 0 0 100%; max-width: 100%; }
    .dthree-col-md-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
    .dthree-col-md-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
    .dthree-col-md-9 { flex: 0 0 75%; max-width: 75%; }
    .dthree-col-md-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
    .dthree-col-md-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
    .dthree-col-md-6 { flex: 0 0 50%; max-width: 50%; }
    .dthree-col-md-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
    .dthree-col-md-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
    .dthree-col-md-3 { flex: 0 0 25%; max-width: 25%; }
    .dthree-col-md-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
    .dthree-col-md-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
    
    /* Tablet Display */
    .dthree-d-md-none { display: none; }
    .dthree-d-md-block { display: block; }
    .dthree-d-md-inline { display: inline; }
    .dthree-d-md-inline-block { display: inline-block; }
    .dthree-d-md-flex { display: flex; }
    
    /* Tablet Typography */
    .dthree-text-md-left { text-align: left; }
    .dthree-text-md-center { text-align: center; }
    .dthree-text-md-right { text-align: right; }
    
    /* Tablet Flex */
    .dthree-flex-md-row { flex-direction: row; }
    .dthree-flex-md-column { flex-direction: column; }
    .dthree-justify-md-start { justify-content: flex-start; }
    .dthree-justify-md-center { justify-content: center; }
    .dthree-justify-md-end { justify-content: flex-end; }
    .dthree-justify-md-between { justify-content: space-between; }
    
    /* Tablet Spacing */
    <?php foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
    .dthree-m-md-<?php echo esc_attr( $space_key ); ?> { margin: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-mt-md-<?php echo esc_attr( $space_key ); ?> { margin-top: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-mb-md-<?php echo esc_attr( $space_key ); ?> { margin-bottom: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-p-md-<?php echo esc_attr( $space_key ); ?> { padding: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-pt-md-<?php echo esc_attr( $space_key ); ?> { padding-top: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-pb-md-<?php echo esc_attr( $space_key ); ?> { padding-bottom: <?php echo esc_attr( $space_value ); ?>; }
    <?php endforeach; ?>
}

/* Desktop Breakpoint (1024px and up) */
@media (min-width: 1024px) {
    .dthree-container {
        padding: 0 var(--dthree-space-xl);
    }
    
    /* Desktop Grid Classes */
    .dthree-col-lg-12 { flex: 0 0 100%; max-width: 100%; }
    .dthree-col-lg-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
    .dthree-col-lg-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
    .dthree-col-lg-9 { flex: 0 0 75%; max-width: 75%; }
    .dthree-col-lg-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
    .dthree-col-lg-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
    .dthree-col-lg-6 { flex: 0 0 50%; max-width: 50%; }
    .dthree-col-lg-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
    .dthree-col-lg-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
    .dthree-col-lg-3 { flex: 0 0 25%; max-width: 25%; }
    .dthree-col-lg-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
    .dthree-col-lg-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
    
    /* Desktop Display */
    .dthree-d-lg-none { display: none; }
    .dthree-d-lg-block { display: block; }
    .dthree-d-lg-inline { display: inline; }
    .dthree-d-lg-inline-block { display: inline-block; }
    .dthree-d-lg-flex { display: flex; }
    
    /* Desktop Typography */
    .dthree-text-lg-left { text-align: left; }
    .dthree-text-lg-center { text-align: center; }
    .dthree-text-lg-right { text-align: right; }
    
    /* Desktop Flex */
    .dthree-flex-lg-row { flex-direction: row; }
    .dthree-flex-lg-column { flex-direction: column; }
    .dthree-justify-lg-start { justify-content: flex-start; }
    .dthree-justify-lg-center { justify-content: center; }
    .dthree-justify-lg-end { justify-content: flex-end; }
    .dthree-justify-lg-between { justify-content: space-between; }
    
    /* Desktop Spacing */
    <?php foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
    .dthree-m-lg-<?php echo esc_attr( $space_key ); ?> { margin: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-mt-lg-<?php echo esc_attr( $space_key ); ?> { margin-top: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-mb-lg-<?php echo esc_attr( $space_key ); ?> { margin-bottom: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-p-lg-<?php echo esc_attr( $space_key ); ?> { padding: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-pt-lg-<?php echo esc_attr( $space_key ); ?> { padding-top: <?php echo esc_attr( $space_value ); ?>; }
    .dthree-pb-lg-<?php echo esc_attr( $space_key ); ?> { padding-bottom: <?php echo esc_attr( $space_value ); ?>; }
    <?php endforeach; ?>
}

/* Large Desktop Breakpoint (1200px and up) */
@media (min-width: 1200px) {
    /* Extra Large Grid Classes */
    .dthree-col-xl-12 { flex: 0 0 100%; max-width: 100%; }
    .dthree-col-xl-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
    .dthree-col-xl-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
    .dthree-col-xl-9 { flex: 0 0 75%; max-width: 75%; }
    .dthree-col-xl-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
    .dthree-col-xl-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
    .dthree-col-xl-6 { flex: 0 0 50%; max-width: 50%; }
    .dthree-col-xl-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
    .dthree-col-xl-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
    .dthree-col-xl-3 { flex: 0 0 25%; max-width: 25%; }
    .dthree-col-xl-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
    .dthree-col-xl-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
    
    /* XL Display */
    .dthree-d-xl-none { display: none; }
    .dthree-d-xl-block { display: block; }
    .dthree-d-xl-inline { display: inline; }
    .dthree-d-xl-inline-block { display: inline-block; }
    .dthree-d-xl-flex { display: flex; }
}

/* Small Mobile Breakpoint (max-width: 480px) */
@media (max-width: 480px) {
    :root {
        /* Adjust spacing for small screens */
        --dthree-space-xs: 0.125rem;
        --dthree-space-sm: 0.25rem;
        --dthree-space-md: 0.75rem;
        --dthree-space-lg: 1rem;
        --dthree-space-xl: 1.25rem;
    }
    
    h1, .h1 { 
        font-size: var(--dthree-font-size-2xl); 
        line-height: var(--dthree-line-height-tight);
        margin-bottom: var(--dthree-space-sm);
    }
    h2, .h2 { 
        font-size: var(--dthree-font-size-xl); 
        margin-bottom: var(--dthree-space-sm);
    }
    h3, .h3 { 
        font-size: var(--dthree-font-size-lg); 
        margin-bottom: var(--dthree-space-xs);
    }
    h4, .h4 { 
        font-size: var(--dthree-font-size-base); 
        margin-bottom: var(--dthree-space-xs);
    }
    h5, .h5, h6, .h6 { 
        font-size: var(--dthree-font-size-sm); 
        margin-bottom: var(--dthree-space-xs);
    }
    
    .dthree-card {
        padding: var(--dthree-space-md);
        margin-bottom: var(--dthree-space-md);
        border-radius: var(--dthree-radius-md);
    }
    
    /* Button adjustments for small screens */
    [class*="btn-"], [class*="dthree-btn-"] {
        padding: var(--dthree-space-sm) var(--dthree-space-md);
        font-size: var(--dthree-font-size-sm);
        min-height: 44px; /* Touch target size */
        min-width: 44px;
    }
    
    .btn-lg {
        padding: var(--dthree-space-md) var(--dthree-space-lg);
        font-size: var(--dthree-font-size-base);
    }
    
    /* Form elements touch-friendly */
    .dthree-input, .dthree-textarea, .dthree-select,
    input, textarea, select {
        min-height: 44px;
        font-size: 16px; /* Prevents zoom on iOS */
    }
    
    /* Navigation adjustments */
    .dthree-nav-item {
        padding: var(--dthree-space-md);
        min-height: 44px;
        display: flex;
        align-items: center;
    }
}

/* Medium Mobile Breakpoint (481px to 767px) */
@media (min-width: 481px) and (max-width: 767px) {
    h1, .h1 { font-size: var(--dthree-font-size-3xl); }
    h2, .h2 { font-size: var(--dthree-font-size-2xl); }
    h3, .h3 { font-size: var(--dthree-font-size-xl); }
    
    .dthree-card {
        padding: var(--dthree-space-lg);
    }
    
    .btn-lg {
        padding: var(--dthree-space-md) var(--dthree-space-xl);
        font-size: var(--dthree-font-size-base);
    }
}

/* Responsive Images */
.dthree-img-responsive {
    max-width: 100%;
    height: auto;
    display: block;
}

/* Responsive Embeds */
.dthree-embed-responsive {
    position: relative;
    display: block;
    width: 100%;
    padding: 0;
    overflow: hidden;
}

.dthree-embed-responsive::before {
    content: "";
    display: block;
    padding-top: 56.25%; /* 16:9 aspect ratio */
}

.dthree-embed-responsive-16by9::before { padding-top: 56.25%; }
.dthree-embed-responsive-4by3::before { padding-top: 75%; }
.dthree-embed-responsive-1by1::before { padding-top: 100%; }

.dthree-embed-responsive iframe,
.dthree-embed-responsive embed,
.dthree-embed-responsive object,
.dthree-embed-responsive video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

/* Responsive Tables */
.dthree-table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.dthree-table-responsive table {
    min-width: 100%;
    margin-bottom: 0;
}

/* Print Responsive */
@media print {
    .dthree-d-print-none { display: none !important; }
    .dthree-d-print-block { display: block !important; }
    .dthree-d-print-inline { display: inline !important; }
    .dthree-d-print-inline-block { display: inline-block !important; }
    
    /* Print spacing adjustments */
    .dthree-card {
        break-inside: avoid;
        margin-bottom: var(--dthree-space-md);
    }
    
    /* Print typography */
    h1, h2, h3, h4, h5, h6 {
        break-after: avoid;
    }
    
    p, .dthree-card-body {
        orphans: 3;
        widows: 3;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .dthree-auto-dark {
        --dthree-color-white: #1a1a1a;
        --dthree-color-light: #2a2a2a;
        --dthree-color-dark: #f8f9fa;
        --dthree-color-secondary: #adb5bd;
    }
    
    .dthree-auto-dark .dthree-card {
        background: var(--dthree-color-white);
        border-color: rgba(255, 255, 255, 0.1);
    }
}

/* Print styles */
@media print {
    .dthree-animate,
    .dthree-animate-fast,
    .dthree-animate-slow {
        transition: none !important;
    }
    
    .dthree-card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
    }
}
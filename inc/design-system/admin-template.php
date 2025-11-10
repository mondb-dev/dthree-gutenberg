<?php
/**
 * Design System Admin Template
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Handle form submission
if ( isset( $_POST['submit'] ) && check_admin_referer( 'dthree_design_system_save', 'dthree_design_system_nonce' ) ) {
    $posted_settings = $_POST['dthree_design_system'] ?? array();
    $instance = DThree_Design_System::get_instance();
    $instance->save_settings( $posted_settings );
    echo '<div class="notice notice-success"><p>' . __( 'Design System settings saved!', 'dthree-gutenberg' ) . '</p></div>';
    $settings = $instance->get_settings(); // Refresh settings
}
?>

<div class="wrap dthree-design-system-admin">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-admin-customizer"></span>
        <?php echo esc_html__( 'Design System', 'dthree-gutenberg' ); ?>
    </h1>
    
    <p class="description">
        <?php echo esc_html__( 'Create and manage your website\'s design system with components, typography, colors, and micro-interactions.', 'dthree-gutenberg' ); ?>
    </p>

    <div class="dthree-design-system-header">
        <div class="dthree-actions">
            <button type="button" class="button button-secondary" id="dthree-import-btn">
                <span class="dashicons dashicons-upload"></span>
                <?php esc_html_e( 'Import Design System', 'dthree-gutenberg' ); ?>
            </button>
            
            <button type="button" class="button button-secondary" id="dthree-export-btn">
                <span class="dashicons dashicons-download"></span>
                <?php esc_html_e( 'Export Design System', 'dthree-gutenberg' ); ?>
            </button>
            
            <button type="button" class="button button-primary" id="dthree-build-assets">
                <span class="dashicons dashicons-hammer"></span>
                <?php esc_html_e( 'Build Assets', 'dthree-gutenberg' ); ?>
            </button>
        </div>
    </div>

    <div class="dthree-admin-container">
        <div class="dthree-admin-main">
            <form method="post" action="">
                <?php wp_nonce_field( 'dthree_design_system_save', 'dthree_design_system_nonce' ); ?>
                
                <div class="dthree-tabs">
                    <nav class="nav-tab-wrapper">
                        <a href="#colors" class="nav-tab nav-tab-active" data-tab="colors">
                            <span class="dashicons dashicons-art"></span>
                            <?php esc_html_e( 'Colors', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#typography" class="nav-tab" data-tab="typography">
                            <span class="dashicons dashicons-editor-textcolor"></span>
                            <?php esc_html_e( 'Typography', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#spacing" class="nav-tab" data-tab="spacing">
                            <span class="dashicons dashicons-grid-view"></span>
                            <?php esc_html_e( 'Spacing', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#components" class="nav-tab" data-tab="components">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <?php esc_html_e( 'Components', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#sections" class="nav-tab" data-tab="sections">
                            <span class="dashicons dashicons-layout"></span>
                            <?php esc_html_e( 'Section Layouts', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#menus" class="nav-tab" data-tab="menus">
                            <span class="dashicons dashicons-menu-alt3"></span>
                            <?php esc_html_e( 'Menu Builder', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#animations" class="nav-tab" data-tab="animations">
                            <span class="dashicons dashicons-controls-play"></span>
                            <?php esc_html_e( 'Micro-interactions', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#responsive" class="nav-tab" data-tab="responsive">
                            <span class="dashicons dashicons-smartphone"></span>
                            <?php esc_html_e( 'Responsive', 'dthree-gutenberg' ); ?>
                        </a>
                    </nav>

                    <!-- Colors Tab -->
                    <div class="tab-content active" id="colors">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Color Palette', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Define your brand colors and theme palette.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-color-grid">
                                <?php foreach ( $settings['colors'] as $color_key => $color_value ) : ?>
                                <div class="dthree-color-item">
                                    <label for="color_<?php echo esc_attr( $color_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $color_key ) ) ); ?>
                                    </label>
                                    <div class="color-input-wrapper">
                                        <input type="text" 
                                               id="color_<?php echo esc_attr( $color_key ); ?>"
                                               name="dthree_design_system[colors][<?php echo esc_attr( $color_key ); ?>]" 
                                               value="<?php echo esc_attr( $color_value ); ?>" 
                                               class="color-picker" />
                                        <div class="color-preview" style="background-color: <?php echo esc_attr( $color_value ); ?>"></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Typography Tab -->
                    <div class="tab-content" id="typography">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Typography', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure font families, sizes, and spacing for consistent typography.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-typography-controls">
                                <h3><?php esc_html_e( 'Font Families', 'dthree-gutenberg' ); ?></h3>
                                
                                <div class="font-family-group">
                                    <h4><?php esc_html_e( 'Primary Font', 'dthree-gutenberg' ); ?></h4>
                                    <label><?php esc_html_e( 'Font Family', 'dthree-gutenberg' ); ?></label>
                                    <input type="text" 
                                           name="dthree_design_system[typography][font_family_primary][family]"
                                           value="<?php echo esc_attr( $settings['typography']['font_family_primary']['family'] ); ?>"
                                           placeholder="Inter" />
                                    
                                    <label><?php esc_html_e( 'Fallbacks', 'dthree-gutenberg' ); ?></label>
                                    <input type="text" 
                                           name="dthree_design_system[typography][font_family_primary][fallbacks]"
                                           value="<?php echo esc_attr( $settings['typography']['font_family_primary']['fallbacks'] ); ?>"
                                           placeholder="system-ui, -apple-system, sans-serif" />
                                </div>

                                <div class="font-family-group">
                                    <h4><?php esc_html_e( 'Secondary Font', 'dthree-gutenberg' ); ?></h4>
                                    <label><?php esc_html_e( 'Font Family', 'dthree-gutenberg' ); ?></label>
                                    <input type="text" 
                                           name="dthree_design_system[typography][font_family_secondary][family]"
                                           value="<?php echo esc_attr( $settings['typography']['font_family_secondary']['family'] ); ?>"
                                           placeholder="Georgia" />
                                    
                                    <label><?php esc_html_e( 'Fallbacks', 'dthree-gutenberg' ); ?></label>
                                    <input type="text" 
                                           name="dthree_design_system[typography][font_family_secondary][fallbacks]"
                                           value="<?php echo esc_attr( $settings['typography']['font_family_secondary']['fallbacks'] ); ?>"
                                           placeholder="serif" />
                                </div>

                                <h3><?php esc_html_e( 'Font Sizes', 'dthree-gutenberg' ); ?></h3>
                                <div class="dthree-size-grid">
                                    <?php foreach ( $settings['typography']['font_sizes'] as $size_key => $size_value ) : ?>
                                    <div class="size-item">
                                        <label for="font_size_<?php echo esc_attr( $size_key ); ?>">
                                            <?php echo esc_html( strtoupper( $size_key ) ); ?>
                                        </label>
                                        <input type="text" 
                                               id="font_size_<?php echo esc_attr( $size_key ); ?>"
                                               name="dthree_design_system[typography][font_sizes][<?php echo esc_attr( $size_key ); ?>]" 
                                               value="<?php echo esc_attr( $size_value ); ?>" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <h3><?php esc_html_e( 'Line Heights', 'dthree-gutenberg' ); ?></h3>
                                <div class="dthree-size-grid">
                                    <?php foreach ( $settings['typography']['line_heights'] as $height_key => $height_value ) : ?>
                                    <div class="size-item">
                                        <label for="line_height_<?php echo esc_attr( $height_key ); ?>">
                                            <?php echo esc_html( ucfirst( $height_key ) ); ?>
                                        </label>
                                        <input type="text" 
                                               id="line_height_<?php echo esc_attr( $height_key ); ?>"
                                               name="dthree_design_system[typography][line_heights][<?php echo esc_attr( $height_key ); ?>]" 
                                               value="<?php echo esc_attr( $height_value ); ?>" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Spacing Tab -->
                    <div class="tab-content" id="spacing">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Spacing & Layout', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Define consistent spacing, border radius, and shadow values.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Spacing Scale', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
                                <div class="size-item">
                                    <label for="spacing_<?php echo esc_attr( $space_key ); ?>">
                                        <?php echo esc_html( strtoupper( $space_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="spacing_<?php echo esc_attr( $space_key ); ?>"
                                           name="dthree_design_system[spacing][scale][<?php echo esc_attr( $space_key ); ?>]" 
                                           value="<?php echo esc_attr( $space_value ); ?>" />
                                    <div class="spacing-preview" style="width: <?php echo esc_attr( $space_value ); ?>; height: <?php echo esc_attr( $space_value ); ?>;"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Border Radius', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['border_radius'] as $radius_key => $radius_value ) : ?>
                                <div class="size-item">
                                    <label for="border_radius_<?php echo esc_attr( $radius_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $radius_key ) ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="border_radius_<?php echo esc_attr( $radius_key ); ?>"
                                           name="dthree_design_system[border_radius][<?php echo esc_attr( $radius_key ); ?>]" 
                                           value="<?php echo esc_attr( $radius_value ); ?>" />
                                    <div class="radius-preview" style="border-radius: <?php echo esc_attr( $radius_value ); ?>;"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Shadows', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-shadow-grid">
                                <?php foreach ( $settings['shadows'] as $shadow_key => $shadow_value ) : ?>
                                <div class="shadow-item">
                                    <label for="shadow_<?php echo esc_attr( $shadow_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $shadow_key ) ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="shadow_<?php echo esc_attr( $shadow_key ); ?>"
                                           name="dthree_design_system[shadows][<?php echo esc_attr( $shadow_key ); ?>]" 
                                           value="<?php echo esc_attr( $shadow_value ); ?>" />
                                    <div class="shadow-preview" style="box-shadow: <?php echo esc_attr( $shadow_value ); ?>;"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Components Tab -->
                    <div class="tab-content" id="components">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Component Library', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure button styles and other component variations.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Button Variations', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-component-builder">
                                <?php foreach ( $settings['buttons'] as $button_key => $button_settings ) : ?>
                                <div class="component-variation">
                                    <h4><?php echo esc_html( ucfirst( $button_key ) . ' Button' ); ?></h4>
                                    
                                    <div class="component-controls">
                                        <?php foreach ( $button_settings as $property => $value ) : ?>
                                        <div class="control-group">
                                            <label><?php echo esc_html( ucfirst( str_replace( '_', ' ', $property ) ) ); ?></label>
                                            <?php if ( strpos( $property, 'color' ) !== false || $property === 'background' || $property === 'border' ) : ?>
                                                <input type="text" 
                                                       name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][<?php echo esc_attr( $property ); ?>]"
                                                       value="<?php echo esc_attr( $value ); ?>"
                                                       class="color-picker" />
                                            <?php else : ?>
                                                <input type="text" 
                                                       name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][<?php echo esc_attr( $property ); ?>]"
                                                       value="<?php echo esc_attr( $value ); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <div class="component-preview">
                                        <button type="button" class="btn-preview btn-<?php echo esc_attr( $button_key ); ?>">
                                            <?php echo esc_html( ucfirst( $button_key ) . ' Button' ); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Section Layouts Tab -->
                    <div class="tab-content" id="sections">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Section Layout Options', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure different section container types and styles for flexible page layouts.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Container Types', 'dthree-gutenberg' ); ?></h3>
                                <div class="container-types-grid">
                                    <?php foreach ( $settings['section_layouts']['container_types'] as $type_key => $container_type ) : ?>
                                    <div class="container-type-item">
                                        <div class="container-type-header">
                                            <label>
                                                <input type="radio" 
                                                       name="dthree_design_system[section_layouts][default_container]" 
                                                       value="<?php echo esc_attr( $type_key ); ?>"
                                                       <?php checked( $settings['section_layouts']['default_container'] ?? 'boxed', $type_key ); ?>>
                                                <strong><?php echo esc_html( $container_type['label'] ); ?></strong>
                                            </label>
                                            <p class="container-description"><?php echo esc_html( $container_type['description'] ); ?></p>
                                        </div>
                                        
                                        <?php if ( $type_key === 'custom' ) : ?>
                                        <div class="custom-container-settings">
                                            <label><?php esc_html_e( 'Max Width', 'dthree-gutenberg' ); ?></label>
                                            <input type="text" 
                                                   name="dthree_design_system[section_layouts][container_types][custom][max_width]"
                                                   value="<?php echo esc_attr( $container_type['max_width'] ); ?>"
                                                   placeholder="1200px">
                                            
                                            <label><?php esc_html_e( 'Padding', 'dthree-gutenberg' ); ?></label>
                                            <input type="text" 
                                                   name="dthree_design_system[section_layouts][container_types][custom][padding]"
                                                   value="<?php echo esc_attr( $container_type['padding'] ); ?>"
                                                   placeholder="0 20px">
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="container-preview">
                                            <div class="preview-container <?php echo esc_attr( $container_type['css_class'] ); ?>">
                                                <div class="preview-content">Sample Content</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Section Styles', 'dthree-gutenberg' ); ?></h3>
                                <div class="section-styles-grid">
                                    <?php foreach ( $settings['section_layouts']['section_styles'] as $style_key => $section_style ) : ?>
                                    <div class="section-style-item">
                                        <label>
                                            <input type="checkbox" 
                                                   name="dthree_design_system[section_layouts][enabled_styles][]" 
                                                   value="<?php echo esc_attr( $style_key ); ?>"
                                                   <?php checked( in_array( $style_key, $settings['section_layouts']['enabled_styles'] ?? array_keys( $settings['section_layouts']['section_styles'] ) ) ); ?>>
                                            <strong><?php echo esc_html( $section_style['label'] ); ?></strong>
                                        </label>
                                        <div class="section-style-preview dthree-section-<?php echo esc_attr( $style_key ); ?>">
                                            <h4>Section Title</h4>
                                            <p>This is how a section with the <?php echo esc_html( strtolower( $section_style['label'] ) ); ?> style will appear.</p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Usage Examples', 'dthree-gutenberg' ); ?></h3>
                                <div class="usage-examples">
                                    <div class="code-example">
                                        <h4><?php esc_html_e( 'HTML Usage', 'dthree-gutenberg' ); ?></h4>
                                        <pre><code>&lt;section class="dthree-section-boxed dthree-section-padded"&gt;
    &lt;div class="dthree-container"&gt;
        &lt;h2&gt;Section Title&lt;/h2&gt;
        &lt;p&gt;Section content here...&lt;/p&gt;
    &lt;/div&gt;
&lt;/section&gt;</code></pre>
                                    </div>
                                    
                                    <div class="code-example">
                                        <h4><?php esc_html_e( 'WordPress Block Usage', 'dthree-gutenberg' ); ?></h4>
                                        <pre><code>&lt;!-- wp:group {"className":"dthree-section-full-width dthree-section-hero"} --&gt;
&lt;div class="wp-block-group dthree-section-full-width dthree-section-hero"&gt;
    &lt;!-- wp:heading --&gt;
    &lt;h2&gt;Hero Section&lt;/h2&gt;
    &lt;!-- /wp:heading --&gt;
&lt;/div&gt;
&lt;!-- /wp:group --&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Builder Tab -->
                    <div class="tab-content" id="menus">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Menu Builder & Styles', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Create advanced menu layouts including mega menus, dropdown styles, and mobile navigation.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Menu Layout Styles', 'dthree-gutenberg' ); ?></h3>
                                <div class="menu-styles-grid">
                                    <?php foreach ( $settings['menu_builder']['menu_styles'] as $menu_key => $menu_style ) : ?>
                                    <div class="menu-style-item">
                                        <label>
                                            <input type="radio" 
                                                   name="dthree_design_system[menu_builder][default_style]" 
                                                   value="<?php echo esc_attr( $menu_key ); ?>"
                                                   <?php checked( $settings['menu_builder']['default_style'] ?? 'horizontal', $menu_key ); ?>>
                                            <strong><?php echo esc_html( $menu_style['label'] ); ?></strong>
                                        </label>
                                        <p class="menu-description"><?php echo esc_html( $menu_style['description'] ); ?></p>
                                        
                                        <div class="menu-preview <?php echo esc_attr( $menu_style['css_class'] ); ?>">
                                            <?php if ( $menu_key === 'mega' ) : ?>
                                                <div class="menu-item has-dropdown">
                                                    <span>Products</span>
                                                    <div class="mega-dropdown">
                                                        <div class="mega-column">
                                                            <h5>Category 1</h5>
                                                            <a href="#">Item 1</a>
                                                            <a href="#">Item 2</a>
                                                        </div>
                                                        <div class="mega-column">
                                                            <h5>Category 2</h5>
                                                            <a href="#">Item 3</a>
                                                            <a href="#">Item 4</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php elseif ( $menu_key === 'split' ) : ?>
                                                <div class="menu-left">
                                                    <span class="menu-item">Home</span>
                                                    <span class="menu-item">About</span>
                                                </div>
                                                <div class="menu-logo">LOGO</div>
                                                <div class="menu-right">
                                                    <span class="menu-item">Services</span>
                                                    <span class="menu-item">Contact</span>
                                                </div>
                                            <?php else : ?>
                                                <span class="menu-item">Home</span>
                                                <span class="menu-item">About</span>
                                                <span class="menu-item">Services</span>
                                                <span class="menu-item">Contact</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Dropdown Styles', 'dthree-gutenberg' ); ?></h3>
                                <div class="dropdown-styles-grid">
                                    <?php foreach ( $settings['menu_builder']['dropdown_styles'] as $dropdown_key => $dropdown_style ) : ?>
                                    <div class="dropdown-style-item">
                                        <label>
                                            <input type="radio" 
                                                   name="dthree_design_system[menu_builder][default_dropdown]" 
                                                   value="<?php echo esc_attr( $dropdown_key ); ?>"
                                                   <?php checked( $settings['menu_builder']['default_dropdown'] ?? 'simple', $dropdown_key ); ?>>
                                            <strong><?php echo esc_html( $dropdown_style['label'] ); ?></strong>
                                        </label>
                                        
                                        <div class="dropdown-preview">
                                            <div class="dropdown-trigger">Services ↓</div>
                                            <div class="dropdown-menu dropdown-<?php echo esc_attr( $dropdown_key ); ?>">
                                                <a href="#" class="dropdown-item">Web Design</a>
                                                <a href="#" class="dropdown-item">Development</a>
                                                <a href="#" class="dropdown-item">Consulting</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Mobile Menu Settings', 'dthree-gutenberg' ); ?></h3>
                                <div class="mobile-menu-settings">
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Mobile Menu Style', 'dthree-gutenberg' ); ?></label>
                                        <select name="dthree_design_system[menu_builder][mobile_menu][style]">
                                            <option value="slide_in" <?php selected( $settings['menu_builder']['mobile_menu']['style'] ?? 'slide_in', 'slide_in' ); ?>><?php esc_html_e( 'Slide In', 'dthree-gutenberg' ); ?></option>
                                            <option value="overlay" <?php selected( $settings['menu_builder']['mobile_menu']['style'], 'overlay' ); ?>><?php esc_html_e( 'Overlay', 'dthree-gutenberg' ); ?></option>
                                            <option value="push" <?php selected( $settings['menu_builder']['mobile_menu']['style'], 'push' ); ?>><?php esc_html_e( 'Push Content', 'dthree-gutenberg' ); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Menu Position', 'dthree-gutenberg' ); ?></label>
                                        <select name="dthree_design_system[menu_builder][mobile_menu][position]">
                                            <option value="left" <?php selected( $settings['menu_builder']['mobile_menu']['position'] ?? 'left', 'left' ); ?>><?php esc_html_e( 'Left Side', 'dthree-gutenberg' ); ?></option>
                                            <option value="right" <?php selected( $settings['menu_builder']['mobile_menu']['position'], 'right' ); ?>><?php esc_html_e( 'Right Side', 'dthree-gutenberg' ); ?></option>
                                            <option value="top" <?php selected( $settings['menu_builder']['mobile_menu']['position'], 'top' ); ?>><?php esc_html_e( 'Top', 'dthree-gutenberg' ); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Hamburger Style', 'dthree-gutenberg' ); ?></label>
                                        <select name="dthree_design_system[menu_builder][mobile_menu][hamburger_style]">
                                            <option value="lines" <?php selected( $settings['menu_builder']['mobile_menu']['hamburger_style'] ?? 'lines', 'lines' ); ?>><?php esc_html_e( 'Three Lines', 'dthree-gutenberg' ); ?></option>
                                            <option value="dots" <?php selected( $settings['menu_builder']['mobile_menu']['hamburger_style'], 'dots' ); ?>><?php esc_html_e( 'Three Dots', 'dthree-gutenberg' ); ?></option>
                                            <option value="arrow" <?php selected( $settings['menu_builder']['mobile_menu']['hamburger_style'], 'arrow' ); ?>><?php esc_html_e( 'Arrow', 'dthree-gutenberg' ); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="mobile-menu-preview">
                                        <div class="mobile-preview-device">
                                            <div class="mobile-header">
                                                <span class="mobile-logo">LOGO</span>
                                                <div class="hamburger-menu hamburger-<?php echo esc_attr( $settings['menu_builder']['mobile_menu']['hamburger_style'] ?? 'lines' ); ?>">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div class="mobile-menu mobile-menu-<?php echo esc_attr( $settings['menu_builder']['mobile_menu']['position'] ?? 'left' ); ?>">
                                                <a href="#" class="mobile-menu-item">Home</a>
                                                <a href="#" class="mobile-menu-item">About</a>
                                                <a href="#" class="mobile-menu-item">Services</a>
                                                <a href="#" class="mobile-menu-item">Contact</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Menu Typography & Styling', 'dthree-gutenberg' ); ?></h3>
                                <div class="menu-typography-settings">
                                    <div class="setting-row">
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Font Size', 'dthree-gutenberg' ); ?></label>
                                            <input type="text" 
                                                   name="dthree_design_system[menu_builder][typography][font_size]"
                                                   value="<?php echo esc_attr( $settings['menu_builder']['typography']['font_size'] ?? 'var(--dthree-font-size-base)' ); ?>"
                                                   placeholder="16px">
                                        </div>
                                        
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Font Weight', 'dthree-gutenberg' ); ?></label>
                                            <select name="dthree_design_system[menu_builder][typography][font_weight]">
                                                <option value="300" <?php selected( $settings['menu_builder']['typography']['font_weight'] ?? '500', '300' ); ?>><?php esc_html_e( 'Light', 'dthree-gutenberg' ); ?></option>
                                                <option value="400" <?php selected( $settings['menu_builder']['typography']['font_weight'], '400' ); ?>><?php esc_html_e( 'Normal', 'dthree-gutenberg' ); ?></option>
                                                <option value="500" <?php selected( $settings['menu_builder']['typography']['font_weight'] ?? '500', '500' ); ?>><?php esc_html_e( 'Medium', 'dthree-gutenberg' ); ?></option>
                                                <option value="600" <?php selected( $settings['menu_builder']['typography']['font_weight'], '600' ); ?>><?php esc_html_e( 'Semi Bold', 'dthree-gutenberg' ); ?></option>
                                                <option value="700" <?php selected( $settings['menu_builder']['typography']['font_weight'], '700' ); ?>><?php esc_html_e( 'Bold', 'dthree-gutenberg' ); ?></option>
                                            </select>
                                        </div>
                                        
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Text Transform', 'dthree-gutenberg' ); ?></label>
                                            <select name="dthree_design_system[menu_builder][typography][text_transform]">
                                                <option value="none" <?php selected( $settings['menu_builder']['typography']['text_transform'] ?? 'none', 'none' ); ?>><?php esc_html_e( 'None', 'dthree-gutenberg' ); ?></option>
                                                <option value="uppercase" <?php selected( $settings['menu_builder']['typography']['text_transform'], 'uppercase' ); ?>><?php esc_html_e( 'Uppercase', 'dthree-gutenberg' ); ?></option>
                                                <option value="lowercase" <?php selected( $settings['menu_builder']['typography']['text_transform'], 'lowercase' ); ?>><?php esc_html_e( 'Lowercase', 'dthree-gutenberg' ); ?></option>
                                                <option value="capitalize" <?php selected( $settings['menu_builder']['typography']['text_transform'], 'capitalize' ); ?>><?php esc_html_e( 'Capitalize', 'dthree-gutenberg' ); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Usage Examples', 'dthree-gutenberg' ); ?></h3>
                                <div class="usage-examples">
                                    <div class="code-example">
                                        <h4><?php esc_html_e( 'Basic Menu HTML', 'dthree-gutenberg' ); ?></h4>
                                        <pre><code>&lt;nav class="dthree-menu-horizontal"&gt;
    &lt;a href="#" class="menu-item"&gt;Home&lt;/a&gt;
    &lt;a href="#" class="menu-item has-dropdown"&gt;
        Services
        &lt;div class="dropdown-menu"&gt;
            &lt;a href="#" class="dropdown-item"&gt;Web Design&lt;/a&gt;
            &lt;a href="#" class="dropdown-item"&gt;Development&lt;/a&gt;
        &lt;/div&gt;
    &lt;/a&gt;
&lt;/nav&gt;</code></pre>
                                    </div>
                                    
                                    <div class="code-example">
                                        <h4><?php esc_html_e( 'Mega Menu HTML', 'dthree-gutenberg' ); ?></h4>
                                        <pre><code>&lt;nav class="dthree-menu-mega"&gt;
    &lt;a href="#" class="menu-item has-mega"&gt;
        Products
        &lt;div class="mega-dropdown"&gt;
            &lt;div class="mega-column"&gt;
                &lt;h5&gt;Web Services&lt;/h5&gt;
                &lt;a href="#"&gt;Design&lt;/a&gt;
                &lt;a href="#"&gt;Development&lt;/a&gt;
            &lt;/div&gt;
            &lt;div class="mega-column"&gt;
                &lt;h5&gt;Marketing&lt;/h5&gt;
                &lt;a href="#"&gt;SEO&lt;/a&gt;
                &lt;a href="#"&gt;Social Media&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/a&gt;
&lt;/nav&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Animations Tab -->
                    <div class="tab-content" id="animations">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Micro-interactions', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Define smooth and purposeful animations for enhanced user experience.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Animation Durations', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['animations']['duration'] as $duration_key => $duration_value ) : ?>
                                <div class="size-item">
                                    <label for="duration_<?php echo esc_attr( $duration_key ); ?>">
                                        <?php echo esc_html( ucfirst( $duration_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="duration_<?php echo esc_attr( $duration_key ); ?>"
                                           name="dthree_design_system[animations][duration][<?php echo esc_attr( $duration_key ); ?>]" 
                                           value="<?php echo esc_attr( $duration_value ); ?>" />
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Easing Functions', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['animations']['easing'] as $easing_key => $easing_value ) : ?>
                                <div class="size-item">
                                    <label for="easing_<?php echo esc_attr( $easing_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $easing_key ) ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="easing_<?php echo esc_attr( $easing_key ); ?>"
                                           name="dthree_design_system[animations][easing][<?php echo esc_attr( $easing_key ); ?>]" 
                                           value="<?php echo esc_attr( $easing_value ); ?>" />
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Hover Effects', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['animations']['hover_effects'] as $effect_key => $effect_value ) : ?>
                                <div class="size-item">
                                    <label for="hover_effect_<?php echo esc_attr( $effect_key ); ?>">
                                        <?php echo esc_html( ucfirst( $effect_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="hover_effect_<?php echo esc_attr( $effect_key ); ?>"
                                           name="dthree_design_system[animations][hover_effects][<?php echo esc_attr( $effect_key ); ?>]" 
                                           value="<?php echo esc_attr( $effect_value ); ?>" />
                                    <div class="effect-preview" data-effect="<?php echo esc_attr( $effect_key ); ?>">
                                        <div class="effect-demo"></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Tab -->
                    <div class="tab-content" id="responsive">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Responsive Design', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure breakpoints, container widths, and responsive typography settings.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Breakpoints', 'dthree-gutenberg' ); ?></h3>
                            <p class="description"><?php esc_html_e( 'Define screen sizes where responsive styles take effect.', 'dthree-gutenberg' ); ?></p>
                            <div class="dthree-breakpoint-grid">
                                <?php 
                                $breakpoint_labels = array(
                                    'sm' => 'Small (Mobile)',
                                    'md' => 'Medium (Tablet)', 
                                    'lg' => 'Large (Desktop)',
                                    'xl' => 'Extra Large',
                                    'xxl' => 'XXL'
                                );
                                foreach ( $settings['breakpoints'] as $bp_key => $bp_value ) : ?>
                                <div class="breakpoint-item">
                                    <label for="breakpoint_<?php echo esc_attr( $bp_key ); ?>">
                                        <?php echo esc_html( $breakpoint_labels[$bp_key] ?? ucfirst( $bp_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="breakpoint_<?php echo esc_attr( $bp_key ); ?>"
                                           name="dthree_design_system[breakpoints][<?php echo esc_attr( $bp_key ); ?>]" 
                                           value="<?php echo esc_attr( $bp_value ); ?>" 
                                           placeholder="768px" />
                                    <small class="description">Min-width for <?php echo esc_html( strtolower( $breakpoint_labels[$bp_key] ?? $bp_key ) ); ?></small>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <h3><?php esc_html_e( 'Container Max Widths', 'dthree-gutenberg' ); ?></h3>
                            <p class="description"><?php esc_html_e( 'Maximum width of containers at different screen sizes.', 'dthree-gutenberg' ); ?></p>
                            <div class="dthree-container-grid">
                                <?php foreach ( $settings['containers'] as $container_key => $container_value ) : ?>
                                <div class="container-item">
                                    <label for="container_<?php echo esc_attr( $container_key ); ?>">
                                        <?php echo esc_html( ucfirst( $container_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="container_<?php echo esc_attr( $container_key ); ?>"
                                           name="dthree_design_system[containers][<?php echo esc_attr( $container_key ); ?>]" 
                                           value="<?php echo esc_attr( $container_value ); ?>" 
                                           placeholder="1140px" />
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <h3><?php esc_html_e( 'Responsive Typography', 'dthree-gutenberg' ); ?></h3>
                            <p class="description"><?php esc_html_e( 'How typography scales across different devices.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="responsive-typography-controls">
                                <h4><?php esc_html_e( 'Font Scale Factors', 'dthree-gutenberg' ); ?></h4>
                                <p class="description"><?php esc_html_e( 'Multiplier for font sizes on different screen sizes (1.0 = 100%, 0.875 = 87.5%).', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="scale-factor-grid">
                                    <?php foreach ( $settings['responsive_typography']['scale_factor'] as $device => $factor ) : ?>
                                    <div class="scale-factor-item">
                                        <label for="scale_factor_<?php echo esc_attr( $device ); ?>">
                                            <?php echo esc_html( ucfirst( $device ) ); ?>
                                        </label>
                                        <input type="number" 
                                               class="scale-factor-input"
                                               id="scale_factor_<?php echo esc_attr( $device ); ?>"
                                               name="dthree_design_system[responsive_typography][scale_factor][<?php echo esc_attr( $device ); ?>]" 
                                               value="<?php echo esc_attr( $factor ); ?>" 
                                               step="0.01"
                                               min="0.5" 
                                               max="2" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <h4><?php esc_html_e( 'Line Height Adjustments', 'dthree-gutenberg' ); ?></h4>
                                <p class="description"><?php esc_html_e( 'Line height values optimized for different screen sizes.', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="line-height-grid">
                                    <?php foreach ( $settings['responsive_typography']['line_height_adjustments'] as $device => $height ) : ?>
                                    <div class="line-height-item">
                                        <label for="line_height_<?php echo esc_attr( $device ); ?>">
                                            <?php echo esc_html( ucfirst( $device ) ); ?>
                                        </label>
                                        <input type="number" 
                                               id="line_height_<?php echo esc_attr( $device ); ?>"
                                               name="dthree_design_system[responsive_typography][line_height_adjustments][<?php echo esc_attr( $device ); ?>]" 
                                               value="<?php echo esc_attr( $height ); ?>" 
                                               step="0.01"
                                               min="1" 
                                               max="3" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="responsive-preview-section">
                                <h3><?php esc_html_e( 'Responsive Preview', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'See how your design system responds to different screen sizes.', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="device-preview-controls">
                                    <button type="button" class="device-btn active" data-device="mobile">
                                        <span class="dashicons dashicons-smartphone"></span> Mobile
                                    </button>
                                    <button type="button" class="device-btn" data-device="tablet">
                                        <span class="dashicons dashicons-tablet"></span> Tablet
                                    </button>
                                    <button type="button" class="device-btn" data-device="desktop">
                                        <span class="dashicons dashicons-desktop"></span> Desktop
                                    </button>
                                </div>
                                
                                <div class="responsive-preview-frame">
                                    <div class="preview-device mobile active" data-device="mobile">
                                        <div class="preview-content">
                                            <h3>Mobile Preview</h3>
                                            <p>This is how your design system looks on mobile devices.</p>
                                            <button class="btn-primary">Primary Button</button>
                                            <div class="sample-card">
                                                <h4>Sample Card</h4>
                                                <p>Card content adapts to mobile screens.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="preview-device tablet" data-device="tablet">
                                        <div class="preview-content">
                                            <h3>Tablet Preview</h3>
                                            <p>This is how your design system looks on tablet devices.</p>
                                            <button class="btn-primary">Primary Button</button>
                                            <div class="sample-card">
                                                <h4>Sample Card</h4>
                                                <p>Card content optimized for tablet screens.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="preview-device desktop" data-device="desktop">
                                        <div class="preview-content">
                                            <h3>Desktop Preview</h3>
                                            <p>This is how your design system looks on desktop screens.</p>
                                            <button class="btn-primary">Primary Button</button>
                                            <div class="sample-card">
                                                <h4>Sample Card</h4>
                                                <p>Card content at full desktop size.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="responsive-utilities-info">
                                <h3><?php esc_html_e( 'Available Responsive Utilities', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'Use these CSS classes for responsive design in your templates.', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="utility-examples">
                                    <div class="utility-group">
                                        <h4>Grid Classes</h4>
                                        <code>.dthree-col-12</code> - Full width (mobile)<br>
                                        <code>.dthree-col-md-6</code> - Half width on tablet+<br>
                                        <code>.dthree-col-lg-4</code> - Third width on desktop+
                                    </div>
                                    
                                    <div class="utility-group">
                                        <h4>Display Classes</h4>
                                        <code>.dthree-d-none</code> - Hidden on all screens<br>
                                        <code>.dthree-d-md-block</code> - Show on tablet+<br>
                                        <code>.dthree-d-lg-flex</code> - Flex on desktop+
                                    </div>
                                    
                                    <div class="utility-group">
                                        <h4>Spacing Classes</h4>
                                        <code>.dthree-p-sm-md</code> - Medium padding on mobile<br>
                                        <code>.dthree-mb-md-lg</code> - Large margin-bottom on tablet+<br>
                                        <code>.dthree-px-lg-xl</code> - X-large horizontal padding on desktop+
                                    </div>
                                    
                                    <div class="utility-group">
                                        <h4>Typography Classes</h4>
                                        <code>.dthree-text-sm-center</code> - Center on mobile<br>
                                        <code>.dthree-text-md-left</code> - Left-align on tablet+<br>
                                        <code>.dthree-text-lg-right</code> - Right-align on desktop+
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dthree-form-actions">
                    <?php submit_button( __( 'Save Design System', 'dthree-gutenberg' ), 'primary', 'submit', false ); ?>
                    
                    <button type="button" class="button button-secondary" id="dthree-preview-btn">
                        <span class="dashicons dashicons-visibility"></span>
                        <?php esc_html_e( 'Preview Changes', 'dthree-gutenberg' ); ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="dthree-admin-sidebar">
            <div class="dthree-panel">
                <h3><?php esc_html_e( 'Live Preview', 'dthree-gutenberg' ); ?></h3>
                <div id="dthree-live-preview">
                    <div class="preview-components">
                        <div class="preview-section">
                            <h4><?php esc_html_e( 'Typography', 'dthree-gutenberg' ); ?></h4>
                            <h1>Heading 1</h1>
                            <h2>Heading 2</h2>
                            <h3>Heading 3</h3>
                            <p>This is a paragraph of body text to show typography styles.</p>
                        </div>
                        
                        <div class="preview-section">
                            <h4><?php esc_html_e( 'Buttons', 'dthree-gutenberg' ); ?></h4>
                            <div class="button-group">
                                <button class="btn-preview btn-primary">Primary</button>
                                <button class="btn-preview btn-secondary">Secondary</button>
                                <button class="btn-preview btn-outline">Outline</button>
                                <button class="btn-preview btn-ghost">Ghost</button>
                            </div>
                        </div>
                        
                        <div class="preview-section">
                            <h4><?php esc_html_e( 'Colors', 'dthree-gutenberg' ); ?></h4>
                            <div class="color-swatches">
                                <div class="swatch primary-swatch"></div>
                                <div class="swatch secondary-swatch"></div>
                                <div class="swatch success-swatch"></div>
                                <div class="swatch warning-swatch"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="dthree-panel">
                <h3><?php esc_html_e( 'Build Status', 'dthree-gutenberg' ); ?></h3>
                <div id="dthree-build-status">
                    <p class="description"><?php esc_html_e( 'Click "Build Assets" to generate optimized CSS, JS, and templates.', 'dthree-gutenberg' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="dthree-import-modal" class="dthree-modal" style="display: none;">
    <div class="dthree-modal-content">
        <span class="dthree-modal-close">&times;</span>
        <h2><?php esc_html_e( 'Import Design System', 'dthree-gutenberg' ); ?></h2>
        <p><?php esc_html_e( 'Upload a JSON file to import design system settings.', 'dthree-gutenberg' ); ?></p>
        <input type="file" id="dthree-import-file" accept=".json" />
        <button type="button" class="button button-primary" id="dthree-import-confirm">
            <?php esc_html_e( 'Import', 'dthree-gutenberg' ); ?>
        </button>
    </div>
</div>
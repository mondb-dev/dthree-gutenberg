<?php
/**
 * Theme Defaults - Default styling and content setup
 * Based on Dthree Digital brand aesthetic
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Set up default theme options on activation
 */
function dthree_set_default_theme_options() {
    // Set default customizer values
    $defaults = array(
        // Colors (based on dthree.com.ph)
        'primary_color'       => '#2563eb',  // Modern blue
        'secondary_color'     => '#1e40af',  // Deeper blue
        'accent_color'        => '#3b82f6',  // Light blue
        'text_color'          => '#1f2937',  // Dark gray
        'background_color'    => '#ffffff',  // White
        'section_bg_color'    => '#f8fafc',  // Light gray
        
        // Typography
        'heading_font'        => 'Inter',
        'body_font'          => 'Inter',
        'font_size_base'     => '16',
        'line_height_base'   => '1.6',
        
        // Layout
        'container_width'    => '1200',
        'sidebar_width'      => '300',
        'header_style'       => 'modern',
        'footer_style'       => 'corporate',
        
        // Business Info
        'company_tagline'    => 'High-Performance Websites. Designed and Built for Growth.',
        'company_description' => 'We help organizations, companies, and teams launch strategy-driven websites that deliver results and scale with your brand.',
        'contact_email'      => 'hello@yourcompany.com',
        'contact_phone'      => '+63 917 XXX XXXX',
        'contact_address'    => 'Metro Manila, Philippines',
        
        // Social Media
        'facebook_url'       => '',
        'instagram_url'      => '',
        'linkedin_url'       => '',
        'twitter_url'        => '',
        
        // SEO
        'enable_seo'         => true,
        'enable_ai_features' => true,
        'google_analytics'   => '',
        
        // Performance
        'enable_lazy_loading' => true,
        'minify_css'         => false,
        'minify_js'          => false,
    );
    
    foreach ( $defaults as $key => $value ) {
        if ( get_theme_mod( $key ) === false ) {
            set_theme_mod( $key, $value );
        }
    }
}

/**
 * Create default pages with professional content
 */
function dthree_create_default_pages() {
    // Check if we've already created default pages
    if ( get_option( 'dthree_default_pages_created' ) ) {
        return;
    }
    
    // Home Page Content
    $home_content = '<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding-top:0;padding-bottom:0">

<!-- wp:dthree/hero-section {"title":"High-Performance Websites. Designed and Built for Growth.","subtitle":"We help organizations, companies, and teams launch strategy-driven websites that deliver results and scale with your brand.","buttonText":"View Our Work","buttonLink":"#featured-work","backgroundImage":"","style":"modern","alignment":"center","height":"large"} -->
<div class="dthree-hero-section modern center large">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">High-Performance Websites. Designed and Built for Growth.</h1>
            <p class="hero-subtitle">We help organizations, companies, and teams launch strategy-driven websites that deliver results and scale with your brand.</p>
            <a href="#featured-work" class="btn btn-primary btn-lg">View Our Work</a>
        </div>
    </div>
</div>
<!-- /wp:dthree/hero-section -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"backgroundColor":"section-bg","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-section-bg-background-color has-background" style="padding-top:5rem;padding-bottom:5rem">

<!-- wp:dthree/features {"title":"Our Website Solutions","subtitle":"From planning to post-launch support, we offer end-to-end website services tailored for results.","features":[{"title":"Custom Interface Design","description":"We design websites following brand aesthetic guidelines to build professional products.","icon":"design"},{"title":"Front-end Development","description":"Responsive, SEO-friendly code development for all devices and platforms.","icon":"code"},{"title":"WordPress Development","description":"Fast, scalable, and optimized websites with the reliable WordPress CMS.","icon":"wordpress"},{"title":"Webflow Development","description":"World-class websites built with the powerful Webflow content management system.","icon":"webflow"},{"title":"Maintenance & Support","description":"Routine support to maintain optimal speed, performance, and security.","icon":"support"},{"title":"Website Consulting","description":"Strategic guidance for website builds ideal for your business needs.","icon":"consulting"}],"layout":"grid","columns":"3"} -->
<div class="dthree-features grid columns-3">
    <div class="container">
        <div class="features-header text-center mb-5">
            <h2>Our Website Solutions</h2>
            <p class="lead">From planning to post-launch support, we offer end-to-end website services tailored for results.</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon design mb-3"></div>
                    <h3>Custom Interface Design</h3>
                    <p>We design websites following brand aesthetic guidelines to build professional products.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon code mb-3"></div>
                    <h3>Front-end Development</h3>
                    <p>Responsive, SEO-friendly code development for all devices and platforms.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon wordpress mb-3"></div>
                    <h3>WordPress Development</h3>
                    <p>Fast, scalable, and optimized websites with the reliable WordPress CMS.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon webflow mb-3"></div>
                    <h3>Webflow Development</h3>
                    <p>World-class websites built with the powerful Webflow content management system.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon support mb-3"></div>
                    <h3>Maintenance & Support</h3>
                    <p>Routine support to maintain optimal speed, performance, and security.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon consulting mb-3"></div>
                    <h3>Website Consulting</h3>
                    <p>Strategic guidance for website builds ideal for your business needs.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /wp:dthree/features -->

</div>
<!-- /wp:group -->

<!-- wp:group {"anchor":"featured-work","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div id="featured-work" class="wp-block-group has-white-background-color has-background" style="padding-top:5rem;padding-bottom:5rem">

<!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">Featured Work</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
<p class="has-text-align-center" style="margin-bottom:3rem">We build websites with purpose. Every project is grounded in strategy, design, and functionality.</p>
<!-- /wp:paragraph -->

<!-- wp:dthree/card-slider {"cards":[{"title":"E-commerce Platform","description":"Modern online store with advanced features and seamless user experience.","image":"","link":"#","category":"E-commerce"},{"title":"Corporate Website","description":"Professional corporate presence with custom design and CMS integration.","image":"","link":"#","category":"Corporate"},{"title":"Educational Portal","description":"Comprehensive learning platform with user management and course delivery.","image":"","link":"#","category":"Education"},{"title":"Non-profit Website","description":"Mission-driven website optimized for donations and community engagement.","image":"","link":"#","category":"Non-profit"}],"autoplay":true,"speed":"medium","showDots":true,"showArrows":true} -->
<div class="dthree-card-slider autoplay medium">
    <div class="container">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card h-100">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">E-commerce</span>
                            <h5 class="card-title">E-commerce Platform</h5>
                            <p class="card-text">Modern online store with advanced features and seamless user experience.</p>
                            <a href="#" class="btn btn-outline-primary">View Project</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card h-100">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Corporate</span>
                            <h5 class="card-title">Corporate Website</h5>
                            <p class="card-text">Professional corporate presence with custom design and CMS integration.</p>
                            <a href="#" class="btn btn-outline-primary">View Project</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card h-100">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Education</span>
                            <h5 class="card-title">Educational Portal</h5>
                            <p class="card-text">Comprehensive learning platform with user management and course delivery.</p>
                            <a href="#" class="btn btn-outline-primary">View Project</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card h-100">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Non-profit</span>
                            <h5 class="card-title">Non-profit Website</h5>
                            <p class="card-text">Mission-driven website optimized for donations and community engagement.</p>
                            <a href="#" class="btn btn-outline-primary">View Project</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<!-- /wp:dthree/card-slider -->

</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"backgroundColor":"section-bg","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-section-bg-background-color has-background" style="padding-top:5rem;padding-bottom:5rem">

<!-- wp:dthree/call-to-action {"title":"Let\'s Build Your Next Website, Together.","description":"Partner with a team that understands digital growth, business outcomes, and user experience.","buttonText":"Contact Us Now","buttonLink":"/contact","style":"centered","backgroundType":"color","backgroundColor":"transparent"} -->
<div class="dthree-cta centered color transparent">
    <div class="container">
        <div class="cta-content text-center">
            <h2>Let\'s Build Your Next Website, Together.</h2>
            <p>Partner with a team that understands digital growth, business outcomes, and user experience.</p>
            <a href="/contact" class="btn btn-primary btn-lg">Contact Us Now</a>
        </div>
    </div>
</div>
<!-- /wp:dthree/call-to-action -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->';

    // About Page Content
    $about_content = '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:3rem;padding-bottom:3rem">

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">About Our Company</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size">Years of Quality Service</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"2rem","bottom":"3rem"}}}} -->
<p class="has-text-align-center" style="margin-top:2rem;margin-bottom:3rem">We\'re a website consultancy and development team helping brands launch purposeful, high-performing websites. With expertise across multiple industries, we combine strategy, UX, SEO, and expert support to deliver real digital results.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"4rem"}}}} -->
<div class="wp-block-columns" style="margin-top:4rem">
<!-- wp:column -->
<div class="wp-block-column">

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center">Strategy Comes First</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Your website is your brand\'s first impression. We design with purpose - combining strategy, structure, and creativity to build meaningful user journeys.</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center">User-Focused Design</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">From smart user flows to well-crafted content and optimized performance, we help brands create websites that connect and convert.</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center">Results-Driven</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Our work is rooted in clarity, user-focused design, and sustainable execution that delivers measurable business outcomes.</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->';

    // Services Page Content
    $services_content = '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:3rem;padding-bottom:5rem">

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">Our Website Solutions</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"4rem"}}}} -->
<p class="has-text-align-center" style="margin-bottom:4rem">From planning to post-launch support, we offer end-to-end website services tailored for results.</p>
<!-- /wp:paragraph -->

<!-- wp:dthree/pricing-tables {"tables":[{"title":"Website Design","price":"Starting at $2,500","period":"per project","features":["Custom Interface Design","Responsive Layout","Brand Integration","User Experience Focus","Mobile Optimization","Design System"],"buttonText":"Get Quote","buttonLink":"/contact","featured":false},{"title":"Website Development","price":"Starting at $3,500","period":"per project","features":["Front-end Development","WordPress/CMS Integration","Performance Optimization","SEO Implementation","Testing & QA","Launch Support"],"buttonText":"Get Quote","buttonLink":"/contact","featured":true},{"title":"Full Website Package","price":"Starting at $5,500","period":"per project","features":["Complete Design & Development","CMS Setup & Training","SEO Optimization","Performance Tuning","6 Months Support","Analytics Setup"],"buttonText":"Get Quote","buttonLink":"/contact","featured":false}],"style":"cards","columns":"3"} -->
<div class="dthree-pricing-tables cards columns-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="pricing-table">
                    <div class="pricing-header">
                        <h3>Website Design</h3>
                        <div class="price">Starting at $2,500<span class="period">per project</span></div>
                    </div>
                    <ul class="features-list">
                        <li>Custom Interface Design</li>
                        <li>Responsive Layout</li>
                        <li>Brand Integration</li>
                        <li>User Experience Focus</li>
                        <li>Mobile Optimization</li>
                        <li>Design System</li>
                    </ul>
                    <a href="/contact" class="btn btn-outline-primary">Get Quote</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-table featured">
                    <div class="featured-badge">Most Popular</div>
                    <div class="pricing-header">
                        <h3>Website Development</h3>
                        <div class="price">Starting at $3,500<span class="period">per project</span></div>
                    </div>
                    <ul class="features-list">
                        <li>Front-end Development</li>
                        <li>WordPress/CMS Integration</li>
                        <li>Performance Optimization</li>
                        <li>SEO Implementation</li>
                        <li>Testing & QA</li>
                        <li>Launch Support</li>
                    </ul>
                    <a href="/contact" class="btn btn-primary">Get Quote</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-table">
                    <div class="pricing-header">
                        <h3>Full Website Package</h3>
                        <div class="price">Starting at $5,500<span class="period">per project</span></div>
                    </div>
                    <ul class="features-list">
                        <li>Complete Design & Development</li>
                        <li>CMS Setup & Training</li>
                        <li>SEO Optimization</li>
                        <li>Performance Tuning</li>
                        <li>6 Months Support</li>
                        <li>Analytics Setup</li>
                    </ul>
                    <a href="/contact" class="btn btn-outline-primary">Get Quote</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /wp:dthree/pricing-tables -->

</div>
<!-- /wp:group -->';

    // Contact Page Content
    $contact_content = '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:3rem;padding-bottom:5rem">

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">Contact Us</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"4rem"}}}} -->
<p class="has-text-align-center" style="margin-bottom:4rem">We\'re happy to assist. Reach out and we\'ll walk you through the next steps.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%">

<!-- wp:dthree/contact-form {"fields":[{"type":"text","label":"Full Name","placeholder":"Your full name","required":true},{"type":"email","label":"Email Address","placeholder":"your@email.com","required":true},{"type":"tel","label":"Phone Number","placeholder":"+63 XXX XXX XXXX","required":false},{"type":"select","label":"Service Interested","options":["Website Design","Website Development","WordPress Development","Website Maintenance","Consulting","Other"],"required":true},{"type":"textarea","label":"Project Details","placeholder":"Tell us about your project...","required":true}],"submitText":"Send Message","style":"modern"} -->
<form class="dthree-contact-form modern">
    <div class="mb-3">
        <label for="full-name" class="form-label">Full Name *</label>
        <input type="text" class="form-control" id="full-name" placeholder="Your full name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address *</label>
        <input type="email" class="form-control" id="email" placeholder="your@email.com" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" id="phone" placeholder="+63 XXX XXX XXXX">
    </div>
    <div class="mb-3">
        <label for="service" class="form-label">Service Interested *</label>
        <select class="form-control" id="service" required>
            <option value="">Select a service</option>
            <option value="Website Design">Website Design</option>
            <option value="Website Development">Website Development</option>
            <option value="WordPress Development">WordPress Development</option>
            <option value="Website Maintenance">Website Maintenance</option>
            <option value="Consulting">Consulting</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="details" class="form-label">Project Details *</label>
        <textarea class="form-control" id="details" rows="5" placeholder="Tell us about your project..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send Message</button>
</form>
<!-- /wp:dthree/contact-form -->

</div>
<!-- /wp:column -->

<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%">

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Get in Touch</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Email:</strong><br>hello@yourcompany.com</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Phone:</strong><br>+63 917 XXX XXXX</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Address:</strong><br>Metro Manila, Philippines</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Business Hours</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM<br><strong>Saturday:</strong> 9:00 AM - 1:00 PM<br><strong>Sunday:</strong> Closed</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->';

    // Create pages
    $pages = array(
        array(
            'post_title'   => 'Home',
            'post_content' => $home_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'home'
        ),
        array(
            'post_title'   => 'About',
            'post_content' => $about_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'about'
        ),
        array(
            'post_title'   => 'Services',
            'post_content' => $services_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'services'
        ),
        array(
            'post_title'   => 'Contact',
            'post_content' => $contact_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'contact'
        ),
    );

    foreach ( $pages as $page ) {
        // Check if page already exists
        $existing_page = get_page_by_path( $page['post_name'] );
        if ( ! $existing_page ) {
            $page_id = wp_insert_post( $page );
            
            // Set homepage as front page
            if ( $page['post_name'] === 'home' && $page_id ) {
                update_option( 'page_on_front', $page_id );
                update_option( 'show_on_front', 'page' );
            }
        }
    }

    // Mark as completed
    update_option( 'dthree_default_pages_created', true );
}

/**
 * Create default menu items
 */
function dthree_create_default_menus() {
    // Check if we've already created default menus
    if ( get_option( 'dthree_default_menus_created' ) ) {
        return;
    }

    // Create main navigation menu
    $menu_name = 'Main Navigation';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // Add menu items
        $menu_items = array(
            array(
                'menu-item-title'  => 'Home',
                'menu-item-url'    => home_url( '/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
            array(
                'menu-item-title'  => 'About',
                'menu-item-url'    => home_url( '/about/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
            array(
                'menu-item-title'  => 'Services',
                'menu-item-url'    => home_url( '/services/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
            array(
                'menu-item-title'  => 'Contact',
                'menu-item-url'    => home_url( '/contact/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
        );

        foreach ( $menu_items as $item ) {
            wp_update_nav_menu_item( $menu_id, 0, $item );
        }

        // Assign to location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    // Create footer menu
    $footer_menu_name = 'Footer Links';
    $footer_menu_exists = wp_get_nav_menu_object( $footer_menu_name );

    if ( ! $footer_menu_exists ) {
        $footer_menu_id = wp_create_nav_menu( $footer_menu_name );

        $footer_items = array(
            array(
                'menu-item-title'  => 'Privacy Policy',
                'menu-item-url'    => home_url( '/privacy-policy/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
            array(
                'menu-item-title'  => 'Terms of Service',
                'menu-item-url'    => home_url( '/terms/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
            array(
                'menu-item-title'  => 'Support',
                'menu-item-url'    => home_url( '/support/' ),
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom'
            ),
        );

        foreach ( $footer_items as $item ) {
            wp_update_nav_menu_item( $footer_menu_id, 0, $item );
        }

        // Assign to footer location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['footer'] = $footer_menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    // Mark as completed
    update_option( 'dthree_default_menus_created', true );
}

/**
 * Create default posts with sample content
 */
function dthree_create_default_posts() {
    // Check if we've already created default posts
    if ( get_option( 'dthree_default_posts_created' ) ) {
        return;
    }

    $sample_posts = array(
        array(
            'post_title'   => 'The Future of Web Design: Trends to Watch in 2024',
            'post_content' => '<p>Web design continues to evolve rapidly, driven by changing user expectations, new technologies, and emerging design philosophies. As we move forward, several key trends are shaping the future of how we create digital experiences.</p>

<h2>1. AI-Powered Design Tools</h2>
<p>Artificial intelligence is revolutionizing the design process, enabling designers to create more personalized and efficient user experiences. From automated layout generation to intelligent color palette suggestions, AI tools are becoming indispensable.</p>

<h2>2. Sustainable Web Design</h2>
<p>Environmental consciousness is driving a new approach to web development. Lightweight code, optimized images, and efficient hosting solutions are becoming priorities for responsible brands.</p>

<h2>3. Voice User Interface Integration</h2>
<p>With the rise of smart speakers and voice assistants, websites are beginning to incorporate voice navigation and interaction capabilities, making digital experiences more accessible and intuitive.</p>

<p>These trends represent just the beginning of a fundamental shift in how we approach web design and development. Organizations that embrace these changes will be better positioned to create meaningful connections with their audiences.</p>',
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_excerpt' => 'Explore the latest web design trends shaping digital experiences in 2024, from AI-powered tools to sustainable development practices.',
        ),
        array(
            'post_title'   => 'Why Every Business Needs a Professional Website',
            'post_content' => '<p>In today\'s digital-first world, your website serves as the foundation of your business\'s online presence. It\'s often the first point of contact between your brand and potential customers, making it crucial to get it right.</p>

<h2>First Impressions Matter</h2>
<p>Studies show that users form opinions about websites within milliseconds of loading. A professional, well-designed website builds immediate credibility and trust with your audience.</p>

<h2>24/7 Business Representation</h2>
<p>Unlike physical storefronts, your website works around the clock, providing information about your services, answering common questions, and generating leads even while you sleep.</p>

<h2>Competitive Advantage</h2>
<p>A superior web presence can differentiate your business from competitors, especially in crowded markets. Professional design and user experience can be the deciding factor for potential customers.</p>

<h2>Measurable Results</h2>
<p>Digital platforms provide unprecedented insight into user behavior, allowing you to optimize your approach based on real data and achieve better business outcomes.</p>

<p>Investing in professional web design and development isn\'t just about having an online presence—it\'s about creating a powerful tool for business growth.</p>',
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_excerpt' => 'Discover why professional web design is essential for business success and how it impacts credibility, growth, and competitive advantage.',
        ),
        array(
            'post_title'   => 'The Complete Guide to Website Performance Optimization',
            'post_content' => '<p>Website performance directly impacts user experience, search engine rankings, and business outcomes. This comprehensive guide covers the essential strategies for optimizing your website\'s speed and performance.</p>

<h2>Understanding Core Web Vitals</h2>
<p>Google\'s Core Web Vitals have become critical ranking factors. These metrics measure loading performance, interactivity, and visual stability—all crucial for user experience.</p>

<h3>Largest Contentful Paint (LCP)</h3>
<p>Measures loading performance. Aim for LCP to occur within 2.5 seconds of when the page first starts loading.</p>

<h3>First Input Delay (FID)</h3>
<p>Measures interactivity. Pages should have a FID of 100 milliseconds or less.</p>

<h3>Cumulative Layout Shift (CLS)</h3>
<p>Measures visual stability. Pages should maintain a CLS of 0.1 or less.</p>

<h2>Optimization Strategies</h2>

<h3>Image Optimization</h3>
<p>Use modern image formats like WebP, implement responsive images, and leverage lazy loading to reduce initial page weight.</p>

<h3>Code Minification</h3>
<p>Remove unnecessary characters from CSS, JavaScript, and HTML files to reduce file sizes and improve loading times.</p>

<h3>Caching Implementation</h3>
<p>Implement browser caching and server-side caching to reduce server load and improve repeat visit performance.</p>

<h2>Monitoring and Testing</h2>
<p>Regular performance monitoring using tools like Google PageSpeed Insights, GTmetrix, and WebPageTest ensures your optimizations remain effective over time.</p>

<p>Performance optimization is an ongoing process that requires continuous attention and refinement. The investment in speed pays dividends through improved user engagement and business results.</p>',
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_excerpt' => 'Learn essential strategies for optimizing website performance, including Core Web Vitals, image optimization, and caching techniques.',
        ),
    );

    foreach ( $sample_posts as $post ) {
        // Check if similar post exists
        $existing_post = get_page_by_title( $post['post_title'], OBJECT, 'post' );
        if ( ! $existing_post ) {
            wp_insert_post( $post );
        }
    }

    // Mark as completed
    update_option( 'dthree_default_posts_created', true );
}

/**
 * Setup widgets in default areas
 */
function dthree_setup_default_widgets() {
    // Check if we've already set up widgets
    if ( get_option( 'dthree_default_widgets_setup' ) ) {
        return;
    }

    // Footer widgets
    $footer_1 = array(
        'text-1' => array(
            'title' => 'About Our Company',
            'text'  => 'We help organizations, companies, and teams launch strategy-driven websites that deliver results and scale with your brand. Contact us today to discuss your project.',
        ),
    );

    $footer_2 = array(
        'nav_menu-1' => array(
            'title' => 'Quick Links',
            'nav_menu' => 'Footer Links',
        ),
    );

    $footer_3 = array(
        'text-2' => array(
            'title' => 'Contact Info',
            'text'  => '<p><strong>Email:</strong> hello@yourcompany.com</p><p><strong>Phone:</strong> +63 917 XXX XXXX</p><p><strong>Address:</strong> Metro Manila, Philippines</p>',
        ),
    );

    update_option( 'widget_text', $footer_1 );
    update_option( 'widget_nav_menu', $footer_2 );
    update_option( 'widget_text', array_merge( get_option( 'widget_text', array() ), $footer_3 ) );

    // Sidebar setup
    $sidebars_widgets = array(
        'footer-1' => array( 'text-1' ),
        'footer-2' => array( 'nav_menu-1' ),
        'footer-3' => array( 'text-2' ),
        'sidebar-1' => array(),
    );

    update_option( 'sidebars_widgets', $sidebars_widgets );

    // Mark as completed
    update_option( 'dthree_default_widgets_setup', true );
}

/**
 * Run all default setup functions
 */
function dthree_run_default_setup() {
    dthree_set_default_theme_options();
    // Removed: Default pages, menus, posts, and widgets
    // Theme focuses on Gutenberg block library and components
    
    // Set flag that defaults have been applied
    update_option( 'dthree_defaults_applied', true );
}

/**
 * Add admin notice for applying defaults
 */
function dthree_default_setup_admin_notice() {
    if ( get_option( 'dthree_defaults_applied' ) ) {
        return;
    }

    $screen = get_current_screen();
    if ( $screen->id !== 'themes' ) {
        return;
    }
    ?>
    <div class="notice notice-info is-dismissible">
        <p>
            <strong>DThree Gutenberg Theme:</strong> 
            Would you like to apply default styling and settings to get started?
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=dthree-setup' ) ); ?>" class="button button-primary" style="margin-left: 10px;">
                Apply Defaults
            </a>
        </p>
    </div>
    <?php
}
add_action( 'admin_notices', 'dthree_default_setup_admin_notice' );

/**
 * Add setup page to admin menu
 */
function dthree_add_setup_page() {
    add_theme_page(
        'Theme Setup',
        'Theme Setup',
        'manage_options',
        'dthree-setup',
        'dthree_setup_page_content'
    );
}
add_action( 'admin_menu', 'dthree_add_setup_page' );

/**
 * Setup page content
 */
function dthree_setup_page_content() {
    if ( isset( $_POST['apply_defaults'] ) && wp_verify_nonce( $_POST['dthree_setup_nonce'], 'dthree_setup' ) ) {
        dthree_run_default_setup();
        echo '<div class="notice notice-success"><p>Default theme settings have been applied successfully!</p></div>';
    }
    
    $defaults_applied = get_option( 'dthree_defaults_applied' );
    ?>
    <div class="wrap">
        <h1>DThree Gutenberg Theme Setup</h1>
        
        <?php if ( ! $defaults_applied ) : ?>
            <div class="card">
                <h2>Quick Start Setup</h2>
                <p>Apply default styling based on Dthree Digital's professional aesthetic. This will:</p>
                <ul>
                    <li>✅ Set professional color scheme (modern blues and grays)</li>
                    <li>✅ Configure typography (Inter font family)</li>
                    <li>✅ Apply spacing and design system settings</li>
                    <li>✅ Configure theme customizer defaults</li>
                </ul>
                
                <form method="post" action="">
                    <?php wp_nonce_field( 'dthree_setup', 'dthree_setup_nonce' ); ?>
                    <p>
                        <input type="submit" name="apply_defaults" class="button button-primary" value="Apply Default Settings">
                        <span style="margin-left: 10px; color: #666;">You can customize all settings later via Appearance → Customize.</span>
                    </p>
                </form>
            </div>
        <?php else : ?>
            <div class="notice notice-info">
                <p><strong>Setup Complete!</strong> Default theme settings have been applied.</p>
            </div>
            
            <div class="card">
                <h2>Next Steps</h2>
                <ul>
                    <li><strong><a href="<?php echo admin_url( 'customize.php' ); ?>">Customize Appearance</a></strong> - Adjust colors, fonts, and layout</li>
                    <li><strong><a href="<?php echo admin_url( 'post-new.php?post_type=page' ); ?>">Create Pages</a></strong> - Build pages using the 21 custom blocks</li>
                    <li><strong><a href="<?php echo admin_url( 'nav-menus.php' ); ?>">Manage Menus</a></strong> - Create your navigation structure</li>
                    <li><strong>Use Gutenberg Blocks</strong> - Access all 21 custom blocks in the block inserter (+) when editing pages</li>
                </ul>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <h2>21 Custom Gutenberg Blocks</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                <div>
                    <h3>📄 Core Blocks (6)</h3>
                    <ul style="margin: 10px 0 0 20px;">
                        <li>Hero Section</li>
                        <li>Features Grid</li>
                        <li>Call to Action</li>
                        <li>Team Members</li>
                        <li>Testimonials</li>
                        <li>Contact Form</li>
                    </ul>
                </div>
                <div>
                    <h3>🎠 Sliders (5)</h3>
                    <ul style="margin: 10px 0 0 20px;">
                        <li>Image Slider</li>
                        <li>Content Slider</li>
                        <li>Logo Slider</li>
                        <li>Card Slider</li>
                        <li>Testimonial Slider</li>
                    </ul>
                </div>
                <div>
                    <h3>🧩 Components (10)</h3>
                    <ul style="margin: 10px 0 0 20px;">
                        <li>Tabs</li>
                        <li>Accordion</li>
                        <li>Pricing Tables</li>
                        <li>Progress Bars</li>
                        <li>Timeline</li>
                        <li>Modal</li>
                        <li>Video Player</li>
                        <li>Alerts</li>
                        <li>Icon Boxes</li>
                        <li>Social Share</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h2>Additional Features</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                <div>
                    <h3>🎨 Design System</h3>
                    <p>Professional color schemes, typography, and spacing based on modern design principles.</p>
                </div>
                <div>
                    <h3>🚀 Performance Optimized</h3>
                    <p>Core Web Vitals compliant with lazy loading, script deferral, and optimized assets.</p>
                </div>
                <div>
                    <h3>🔍 SEO Ready</h3>
                    <p>Built-in SEO optimization with schema markup and meta tag management.</p>
                </div>
                <div>
                    <h3>🤖 AI-Friendly</h3>
                    <p>Optimized for AI crawlers with enhanced content structure and metadata.</p>
                </div>
                <div>
                    <h3>� Import/Export</h3>
                    <p>Save and share theme settings across installations.</p>
                </div>
                <div>
                    <h3>🖼️ Lightbox</h3>
                    <p>Beautiful image galleries with automatic lightbox functionality.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Auto-apply defaults on theme activation (optional)
 */
function dthree_maybe_auto_apply_defaults() {
    // Only run on theme activation, not every page load
    if ( get_option( 'dthree_activation_flag' ) !== get_template() ) {
        update_option( 'dthree_activation_flag', get_template() );
        
        // Uncomment the line below if you want defaults to apply automatically
        // dthree_run_default_setup();
    }
}
add_action( 'after_setup_theme', 'dthree_maybe_auto_apply_defaults' );
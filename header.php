<?php
/**
 * The header template
 *
 * @package DThree_Gutenberg
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'dthree-gutenberg' ); ?></a>

<header id="masthead" class="site-header sticky-top bg-white shadow-sm" role="banner">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <div class="container-fluid">
            <?php if ( has_custom_logo() ) : ?>
                <div class="navbar-brand">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'dthree-gutenberg' ); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav ms-auto',
                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'         => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
            </div>
        </div>
    </nav>
</header>

<div id="content" class="site-content">

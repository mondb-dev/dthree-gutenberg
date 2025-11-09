<?php
/**
 * The footer template
 *
 * @package DThree_Gutenberg
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer bg-dark text-white pt-5 pb-3" role="contentinfo">
    <div class="container">
        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <hr class="my-4 bg-white opacity-25">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">
                    &copy; <?php echo esc_html( date( 'Y' ) ); ?> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white text-decoration-none">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    <?php esc_html_e( 'All rights reserved.', 'dthree-gutenberg' ); ?>
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <?php
                // Display social media links
                dthree_display_social_links( array(
                    'size'  => 'normal',
                    'class' => 'd-inline-block mb-3 mb-md-0',
                ) );
                ?>
                
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'list-inline mb-0',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ) );
                ?>
            </div>
        </div>
        
        <!-- Theme Credit -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="mb-0 small text-white-50">
                    <?php
                    printf(
                        /* translators: %s: Theme developer link */
                        esc_html__( 'Theme built by %s', 'dthree-gutenberg' ),
                        '<a href="https://dthree.com.ph" target="_blank" rel="noopener" class="text-white text-decoration-none fw-semibold">Dthree Digital</a>'
                    );
                    ?>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

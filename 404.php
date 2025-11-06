<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package DThree_Gutenberg
 */

get_header();
?>

<main id="main" class="site-main container py-5" role="main">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <section class="error-404 not-found text-center">
                <header class="page-header mb-5">
                    <h1 class="page-title display-1 fw-bold text-primary">404</h1>
                    <p class="lead"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'dthree-gutenberg' ); ?></p>
                </header>

                <div class="page-content">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching?', 'dthree-gutenberg' ); ?></p>

                    <div class="mb-5">
                        <?php get_search_form(); ?>
                    </div>

                    <div class="row g-4 text-start">
                        <div class="col-md-4">
                            <div class="widget">
                                <h3 class="widget-title h5"><?php esc_html_e( 'Recent Posts', 'dthree-gutenberg' ); ?></h3>
                                <ul class="list-unstyled">
                                    <?php
                                    $recent_posts = wp_get_recent_posts( array(
                                        'numberposts' => 5,
                                        'post_status' => 'publish',
                                    ) );
                                    foreach ( $recent_posts as $recent ) :
                                        ?>
                                        <li class="mb-2">
                                            <a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>">
                                                <?php echo esc_html( $recent['post_title'] ); ?>
                                            </a>
                                        </li>
                                        <?php
                                    endforeach;
                                    wp_reset_postdata();
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="widget">
                                <h3 class="widget-title h5"><?php esc_html_e( 'Categories', 'dthree-gutenberg' ); ?></h3>
                                <ul class="list-unstyled">
                                    <?php
                                    wp_list_categories( array(
                                        'orderby'    => 'count',
                                        'order'      => 'DESC',
                                        'show_count' => true,
                                        'title_li'   => '',
                                        'number'     => 5,
                                    ) );
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="widget">
                                <h3 class="widget-title h5"><?php esc_html_e( 'Archives', 'dthree-gutenberg' ); ?></h3>
                                <ul class="list-unstyled">
                                    <?php
                                    wp_get_archives( array(
                                        'type'  => 'monthly',
                                        'limit' => 5,
                                    ) );
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-house-door me-2" aria-hidden="true"></i>
                            <?php esc_html_e( 'Go to Homepage', 'dthree-gutenberg' ); ?>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php
get_footer();

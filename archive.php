<?php
/**
 * The template for displaying archive pages
 *
 * @package DThree_Gutenberg
 */

get_header();
?>

<main id="main" class="site-main container py-5" role="main">
    <div class="row">
        <div class="col-lg-8">
            <?php if ( have_posts() ) : ?>

                <header class="page-header mb-5">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header>

                <?php
                // Start the Loop
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile;

                // Pagination
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&laquo; Previous', 'dthree-gutenberg' ),
                    'next_text' => __( 'Next &raquo;', 'dthree-gutenberg' ),
                ) );

            else :
                get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</main>

<?php
get_footer();

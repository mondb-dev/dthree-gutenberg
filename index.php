<?php
/**
 * The main template file
 *
 * @package DThree_Gutenberg
 */

get_header();
?>

<main id="main" class="site-main container py-5" role="main">
    <?php
    if ( have_posts() ) :
        
        if ( is_home() && ! is_front_page() ) :
            ?>
            <header class="page-header mb-5">
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

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
            'class'     => 'pagination justify-content-center',
        ) );

    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
</main>

<?php
get_sidebar();
get_footer();

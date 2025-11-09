<?php
/**
 * The template for displaying all single posts
 *
 * @package DThree_Gutenberg
 */

get_header();
?>

<main id="main" class="site-main container py-5" role="main">
    <div class="row">
        <div class="col-lg-8">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );
                
                // Related Posts
                if ( get_theme_mod( 'dthree_show_related_posts', true ) ) {
                    dthree_related_posts();
                }

                // Author bio
                if ( is_singular( 'post' ) && get_the_author_meta( 'description' ) ) :
                    ?>
                    <div class="author-bio card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'rounded-circle' ) ); ?>
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="h5 mb-2"><?php echo esc_html( get_the_author() ); ?></h3>
                                    <p class="mb-0"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;

                // Post navigation
                the_post_navigation( array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'dthree-gutenberg' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'dthree-gutenberg' ) . '</span> <span class="nav-title">%title</span>',
                ) );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile;
            ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</main>

<?php
get_footer();

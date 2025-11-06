<?php
/**
 * Template part for displaying search results
 *
 * @package DThree_Gutenberg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-4 pb-4 border-bottom' ); ?>>
    <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title h4"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta text-muted small mb-2">
                <span class="posted-on">
                    <?php echo esc_html( get_the_date() ); ?>
                </span>
                <span class="byline">
                    <?php esc_html_e( ' by ', 'dthree-gutenberg' ); ?>
                    <?php echo esc_html( get_the_author() ); ?>
                </span>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
</article>

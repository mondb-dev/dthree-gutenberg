<?php
/**
 * Template part for displaying posts
 *
 * @package DThree_Gutenberg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5' ); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>

        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <i class="bi bi-calendar3" aria-hidden="true"></i>
                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                        <?php echo esc_html( get_the_date() ); ?>
                    </time>
                </span>
                <span class="byline ms-3">
                    <i class="bi bi-person" aria-hidden="true"></i>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php echo esc_html( get_the_author() ); ?>
                    </a>
                </span>
                <?php if ( get_theme_mod( 'dthree_show_reading_time', true ) ) : ?>
                    <span class="reading-time ms-3">
                        <i class="bi bi-clock" aria-hidden="true"></i>
                        <?php echo esc_html( dthree_get_reading_time() ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( is_singular() ) : ?>
                    <span class="post-views ms-3">
                        <?php dthree_display_post_views(); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
        <div class="post-thumbnail mb-3">
            <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail( 'dthree-featured', array( 'class' => 'img-fluid rounded' ) ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            the_content();
            
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dthree-gutenberg' ),
                'after'  => '</div>',
            ) );
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                <?php esc_html_e( 'Read More', 'dthree-gutenberg' ); ?>
                <i class="bi bi-arrow-right ms-2" aria-hidden="true"></i>
            </a>
            <?php
        endif;
        ?>
    </div>

    <?php if ( is_singular() ) : ?>
        <footer class="entry-footer">
            <?php
            $categories_list = get_the_category_list( ', ' );
            if ( $categories_list ) :
                ?>
                <div class="cat-links mb-2">
                    <i class="bi bi-folder" aria-hidden="true"></i>
                    <span class="screen-reader-text"><?php esc_html_e( 'Categories:', 'dthree-gutenberg' ); ?></span>
                    <?php echo wp_kses_post( $categories_list ); ?>
                </div>
                <?php
            endif;

            $tags_list = get_the_tag_list( '', ', ' );
            if ( $tags_list ) :
                ?>
                <div class="tags-links">
                    <i class="bi bi-tags" aria-hidden="true"></i>
                    <span class="screen-reader-text"><?php esc_html_e( 'Tags:', 'dthree-gutenberg' ); ?></span>
                    <?php echo wp_kses_post( $tags_list ); ?>
                </div>
                <?php
            endif;
            ?>
        </footer>
    <?php endif; ?>
</article>

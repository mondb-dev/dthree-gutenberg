<?php
/**
 * The template for displaying comments
 *
 * @package DThree_Gutenberg
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area mt-5">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title h4 mb-4">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'dthree-gutenberg' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'dthree-gutenberg' ) ),
                    number_format_i18n( $comment_count ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list list-unstyled">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments alert alert-info">
                <?php esc_html_e( 'Comments are closed.', 'dthree-gutenberg' ); ?>
            </p>
            <?php
        endif;

    endif;

    comment_form( array(
        'class_form'           => 'comment-form',
        'class_submit'         => 'btn btn-primary',
        'title_reply'          => __( 'Leave a Comment', 'dthree-gutenberg' ),
        'title_reply_to'       => __( 'Leave a Reply to %s', 'dthree-gutenberg' ),
        'cancel_reply_link'    => __( 'Cancel Reply', 'dthree-gutenberg' ),
        'label_submit'         => __( 'Post Comment', 'dthree-gutenberg' ),
        'comment_field'        => '<div class="mb-3"><label for="comment" class="form-label">' . _x( 'Comment', 'noun', 'dthree-gutenberg' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" class="form-control" rows="5" required></textarea></div>',
        'fields'               => array(
            'author' => '<div class="row g-3 mb-3"><div class="col-md-4"><label for="author" class="form-label">' . __( 'Name', 'dthree-gutenberg' ) . ' <span class="required">*</span></label><input id="author" name="author" type="text" class="form-control" required /></div>',
            'email'  => '<div class="col-md-4"><label for="email" class="form-label">' . __( 'Email', 'dthree-gutenberg' ) . ' <span class="required">*</span></label><input id="email" name="email" type="email" class="form-control" required /></div>',
            'url'    => '<div class="col-md-4"><label for="url" class="form-label">' . __( 'Website', 'dthree-gutenberg' ) . '</label><input id="url" name="url" type="url" class="form-control" /></div></div>',
        ),
    ) );
    ?>

</div>

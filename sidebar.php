<?php
/**
 * The sidebar template
 *
 * @package DThree_Gutenberg
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area col-lg-4" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'dthree-gutenberg' ); ?>">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>

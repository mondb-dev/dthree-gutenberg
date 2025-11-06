<?php
/**
 * The searchform template
 *
 * @package DThree_Gutenberg
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-form-<?php echo esc_attr( wp_rand() ); ?>">
        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'dthree-gutenberg' ); ?></span>
    </label>
    <div class="input-group">
        <input type="search" 
               id="search-form-<?php echo esc_attr( wp_rand() ); ?>" 
               class="search-field form-control" 
               placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'dthree-gutenberg' ); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               required />
        <button type="submit" class="search-submit btn btn-primary">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Search', 'dthree-gutenberg' ); ?></span>
        </button>
    </div>
</form>

<?php
/**
 * Pricing Tables Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Pricing Tables Block
 */
function dthree_register_pricing_tables_block() {
    register_block_type( 'dthree/pricing-tables', array(
        'api_version' => 2,
        'title'       => __( 'Pricing Tables', 'dthree-gutenberg' ),
        'description' => __( 'Showcase pricing plans and packages', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'money-alt',
        'keywords'    => array( 'pricing', 'price', 'plans', 'tables', 'packages' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'plans'          => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'name'        => __( 'Basic', 'dthree-gutenberg' ),
                        'price'       => '9',
                        'period'      => __( 'month', 'dthree-gutenberg' ),
                        'description' => __( 'Perfect for individuals', 'dthree-gutenberg' ),
                        'features'    => array(
                            __( '5 Projects', 'dthree-gutenberg' ),
                            __( '5GB Storage', 'dthree-gutenberg' ),
                            __( 'Basic Support', 'dthree-gutenberg' ),
                        ),
                        'buttonText'  => __( 'Get Started', 'dthree-gutenberg' ),
                        'buttonUrl'   => '#',
                        'featured'    => false,
                        'ribbon'      => '',
                    ),
                    array(
                        'name'        => __( 'Professional', 'dthree-gutenberg' ),
                        'price'       => '29',
                        'period'      => __( 'month', 'dthree-gutenberg' ),
                        'description' => __( 'Best for professionals', 'dthree-gutenberg' ),
                        'features'    => array(
                            __( 'Unlimited Projects', 'dthree-gutenberg' ),
                            __( '50GB Storage', 'dthree-gutenberg' ),
                            __( 'Priority Support', 'dthree-gutenberg' ),
                            __( 'Advanced Features', 'dthree-gutenberg' ),
                        ),
                        'buttonText'  => __( 'Get Started', 'dthree-gutenberg' ),
                        'buttonUrl'   => '#',
                        'featured'    => true,
                        'ribbon'      => __( 'Popular', 'dthree-gutenberg' ),
                    ),
                    array(
                        'name'        => __( 'Enterprise', 'dthree-gutenberg' ),
                        'price'       => '99',
                        'period'      => __( 'month', 'dthree-gutenberg' ),
                        'description' => __( 'For large organizations', 'dthree-gutenberg' ),
                        'features'    => array(
                            __( 'Unlimited Everything', 'dthree-gutenberg' ),
                            __( 'Unlimited Storage', 'dthree-gutenberg' ),
                            __( '24/7 Premium Support', 'dthree-gutenberg' ),
                            __( 'Custom Solutions', 'dthree-gutenberg' ),
                        ),
                        'buttonText'  => __( 'Contact Us', 'dthree-gutenberg' ),
                        'buttonUrl'   => '#',
                        'featured'    => false,
                        'ribbon'      => '',
                    ),
                ),
            ),
            'currency'       => array(
                'type'    => 'string',
                'default' => '$',
            ),
            'columns'        => array(
                'type'    => 'number',
                'default' => 3,
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'card', // card, minimal, bordered
            ),
        ),
        'render_callback' => 'dthree_render_pricing_tables_block',
    ) );
}
add_action( 'init', 'dthree_register_pricing_tables_block' );

/**
 * Render Pricing Tables Block
 */
function dthree_render_pricing_tables_block( $attributes ) {
    $plans = isset( $attributes['plans'] ) ? $attributes['plans'] : array();
    $currency = isset( $attributes['currency'] ) ? $attributes['currency'] : '$';
    $columns = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'card';
    
    if ( empty( $plans ) ) {
        return '<div class="alert alert-info">' . __( 'Add pricing plans to display', 'dthree-gutenberg' ) . '</div>';
    }
    
    $col_class = 'col-lg-' . ( 12 / min( $columns, count( $plans ) ) );
    
    ob_start();
    ?>
    <div class="dthree-pricing-tables dthree-pricing-<?php echo esc_attr( $style ); ?>">
        <div class="row g-4">
            <?php foreach ( $plans as $plan ) : 
                $is_featured = isset( $plan['featured'] ) && $plan['featured'];
                $features = isset( $plan['features'] ) ? $plan['features'] : array();
            ?>
                <div class="<?php echo esc_attr( $col_class ); ?>">
                    <div class="pricing-plan <?php echo $is_featured ? 'featured' : ''; ?>">
                        <?php if ( ! empty( $plan['ribbon'] ) ) : ?>
                            <div class="pricing-ribbon">
                                <?php echo esc_html( $plan['ribbon'] ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="pricing-header">
                            <h3 class="plan-name"><?php echo esc_html( $plan['name'] ); ?></h3>
                            <?php if ( ! empty( $plan['description'] ) ) : ?>
                                <p class="plan-description"><?php echo esc_html( $plan['description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="pricing-price">
                            <span class="currency"><?php echo esc_html( $currency ); ?></span>
                            <span class="amount"><?php echo esc_html( $plan['price'] ); ?></span>
                            <?php if ( ! empty( $plan['period'] ) ) : ?>
                                <span class="period">/<?php echo esc_html( $plan['period'] ); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ( ! empty( $features ) ) : ?>
                            <ul class="pricing-features">
                                <?php foreach ( $features as $feature ) : ?>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span><?php echo esc_html( $feature ); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        
                        <div class="pricing-footer">
                            <a href="<?php echo esc_url( $plan['buttonUrl'] ?? '#' ); ?>" 
                               class="btn <?php echo $is_featured ? 'btn-primary' : 'btn-outline-primary'; ?> w-100">
                                <?php echo esc_html( $plan['buttonText'] ?? __( 'Get Started', 'dthree-gutenberg' ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

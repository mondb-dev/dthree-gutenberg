<?php
/**
 * Team Members Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Team Members Block
 */
function dthree_register_team_members_block() {
    register_block_type( 'dthree/team-members', array(
        'api_version' => 2,
        'title'       => __( 'Team Members', 'dthree-gutenberg' ),
        'description' => __( 'Showcase your team members with photos and social links.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'groups',
        'keywords'    => array( 'team', 'members', 'staff', 'people' ),
        'supports'    => array(
            'align'  => array( 'wide', 'full' ),
            'anchor' => true,
        ),
        'attributes'  => array(
            'sectionTitle'   => array(
                'type'    => 'string',
                'default' => __( 'Meet Our Team', 'dthree-gutenberg' ),
            ),
            'sectionSubtitle' => array(
                'type'    => 'string',
                'default' => __( 'The people behind our success', 'dthree-gutenberg' ),
            ),
            'members'        => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'name'     => __( 'John Doe', 'dthree-gutenberg' ),
                        'role'     => __( 'CEO & Founder', 'dthree-gutenberg' ),
                        'image'    => '',
                        'bio'      => __( 'Passionate about creating amazing experiences.', 'dthree-gutenberg' ),
                        'twitter'  => '',
                        'linkedin' => '',
                        'email'    => '',
                    ),
                    array(
                        'name'     => __( 'Jane Smith', 'dthree-gutenberg' ),
                        'role'     => __( 'Creative Director', 'dthree-gutenberg' ),
                        'image'    => '',
                        'bio'      => __( 'Designing beautiful and functional interfaces.', 'dthree-gutenberg' ),
                        'twitter'  => '',
                        'linkedin' => '',
                        'email'    => '',
                    ),
                    array(
                        'name'     => __( 'Mike Johnson', 'dthree-gutenberg' ),
                        'role'     => __( 'Lead Developer', 'dthree-gutenberg' ),
                        'image'    => '',
                        'bio'      => __( 'Building scalable and performant solutions.', 'dthree-gutenberg' ),
                        'twitter'  => '',
                        'linkedin' => '',
                        'email'    => '',
                    ),
                ),
            ),
            'columns'        => array(
                'type'    => 'number',
                'default' => 3,
            ),
        ),
        'render_callback' => 'dthree_render_team_members_block',
    ) );
}
add_action( 'init', 'dthree_register_team_members_block' );

/**
 * Render Team Members Block
 */
function dthree_render_team_members_block( $attributes ) {
    $section_title    = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $section_subtitle = isset( $attributes['sectionSubtitle'] ) ? $attributes['sectionSubtitle'] : '';
    $members          = isset( $attributes['members'] ) ? $attributes['members'] : array();
    $columns          = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;

    $col_class = 'col-md-' . ( 12 / $columns );

    ob_start();
    ?>
    <section class="dthree-team-section py-5">
        <div class="container">
            <?php if ( ! empty( $section_subtitle ) || ! empty( $section_title ) ) : ?>
                <div class="text-center mb-5">
                    <?php if ( ! empty( $section_subtitle ) ) : ?>
                        <p class="text-muted text-uppercase mb-2" data-aos="fade-up">
                            <?php echo wp_kses_post( $section_subtitle ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $section_title ) ) : ?>
                        <h2 class="display-5 fw-bold mb-0" data-aos="fade-up" data-aos-delay="100">
                            <?php echo wp_kses_post( $section_title ); ?>
                        </h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <?php foreach ( $members as $index => $member ) : ?>
                    <div class="<?php echo esc_attr( $col_class ); ?>" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>">
                        <div class="team-member-card text-center">
                            <?php if ( ! empty( $member['image'] ) ) : ?>
                                <div class="member-image mb-3">
                                    <img src="<?php echo esc_url( $member['image'] ); ?>" 
                                         alt="<?php echo esc_attr( $member['name'] ); ?>" 
                                         class="rounded-circle img-fluid"
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                            <?php else : ?>
                                <div class="member-image-placeholder rounded-circle mx-auto mb-3 bg-light d-flex align-items-center justify-content-center"
                                     style="width: 200px; height: 200px;">
                                    <i class="bi bi-person fs-1 text-muted" aria-hidden="true"></i>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $member['name'] ) ) : ?>
                                <h3 class="h5 mb-1"><?php echo wp_kses_post( $member['name'] ); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $member['role'] ) ) : ?>
                                <p class="text-primary mb-2"><?php echo wp_kses_post( $member['role'] ); ?></p>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $member['bio'] ) ) : ?>
                                <p class="text-muted mb-3"><?php echo wp_kses_post( $member['bio'] ); ?></p>
                            <?php endif; ?>
                            
                            <?php
                            $has_social = ! empty( $member['twitter'] ) || ! empty( $member['linkedin'] ) || ! empty( $member['email'] );
                            if ( $has_social ) :
                            ?>
                                <div class="member-social d-flex gap-2 justify-content-center">
                                    <?php if ( ! empty( $member['twitter'] ) ) : ?>
                                        <a href="<?php echo esc_url( $member['twitter'] ); ?>" 
                                           class="btn btn-sm btn-outline-secondary rounded-circle" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           aria-label="<?php echo esc_attr( sprintf( __( '%s on Twitter', 'dthree-gutenberg' ), $member['name'] ) ); ?>">
                                            <i class="bi bi-twitter" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ( ! empty( $member['linkedin'] ) ) : ?>
                                        <a href="<?php echo esc_url( $member['linkedin'] ); ?>" 
                                           class="btn btn-sm btn-outline-secondary rounded-circle" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           aria-label="<?php echo esc_attr( sprintf( __( '%s on LinkedIn', 'dthree-gutenberg' ), $member['name'] ) ); ?>">
                                            <i class="bi bi-linkedin" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ( ! empty( $member['email'] ) ) : ?>
                                        <a href="mailto:<?php echo esc_attr( $member['email'] ); ?>" 
                                           class="btn btn-sm btn-outline-secondary rounded-circle"
                                           aria-label="<?php echo esc_attr( sprintf( __( 'Email %s', 'dthree-gutenberg' ), $member['name'] ) ); ?>">
                                            <i class="bi bi-envelope" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

<?php
/**
 * Contact Form Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Contact Form Block
 */
function dthree_register_contact_form_block() {
    register_block_type( 'dthree/contact-form', array(
        'api_version' => 2,
        'title'       => __( 'Contact Form', 'dthree-gutenberg' ),
        'description' => __( 'A secure contact form with validation and spam protection.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'email',
        'keywords'    => array( 'contact', 'form', 'email' ),
        'supports'    => array(
            'align'  => array( 'wide', 'full' ),
            'anchor' => true,
        ),
        'attributes'  => array(
            'sectionTitle'   => array(
                'type'    => 'string',
                'default' => __( 'Get In Touch', 'dthree-gutenberg' ),
            ),
            'sectionSubtitle' => array(
                'type'    => 'string',
                'default' => __( 'Contact us', 'dthree-gutenberg' ),
            ),
            'submitButtonText' => array(
                'type'    => 'string',
                'default' => __( 'Send Message', 'dthree-gutenberg' ),
            ),
            'recipientEmail' => array(
                'type'    => 'string',
                'default' => get_option( 'admin_email' ),
            ),
        ),
        'render_callback' => 'dthree_render_contact_form_block',
    ) );
}
add_action( 'init', 'dthree_register_contact_form_block' );

/**
 * Render Contact Form Block
 */
function dthree_render_contact_form_block( $attributes ) {
    $section_title    = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $section_subtitle = isset( $attributes['sectionSubtitle'] ) ? $attributes['sectionSubtitle'] : '';
    $button_text      = isset( $attributes['submitButtonText'] ) ? $attributes['submitButtonText'] : __( 'Send Message', 'dthree-gutenberg' );
    
    $form_id = 'dthree-contact-form-' . wp_rand( 1000, 9999 );

    ob_start();
    ?>
    <section class="dthree-contact-form-section py-5">
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

            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <form id="<?php echo esc_attr( $form_id ); ?>" 
                          class="dthree-contact-form needs-validation" 
                          method="post" 
                          novalidate>
                        
                        <?php wp_nonce_field( 'dthree_contact_form', 'dthree_contact_nonce' ); ?>
                        
                        <input type="hidden" 
                               name="action" 
                               value="dthree_submit_contact_form">
                        
                        <input type="hidden" 
                               name="recipient_email" 
                               value="<?php echo esc_attr( isset( $attributes['recipientEmail'] ) ? $attributes['recipientEmail'] : get_option( 'admin_email' ) ); ?>">
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="<?php echo esc_attr( $form_id ); ?>-name" class="form-label">
                                    <?php esc_html_e( 'Name', 'dthree-gutenberg' ); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="<?php echo esc_attr( $form_id ); ?>-name" 
                                       name="contact_name" 
                                       required 
                                       aria-required="true">
                                <div class="invalid-feedback">
                                    <?php esc_html_e( 'Please enter your name.', 'dthree-gutenberg' ); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="<?php echo esc_attr( $form_id ); ?>-email" class="form-label">
                                    <?php esc_html_e( 'Email', 'dthree-gutenberg' ); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="<?php echo esc_attr( $form_id ); ?>-email" 
                                       name="contact_email" 
                                       required 
                                       aria-required="true">
                                <div class="invalid-feedback">
                                    <?php esc_html_e( 'Please enter a valid email address.', 'dthree-gutenberg' ); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="<?php echo esc_attr( $form_id ); ?>-subject" class="form-label">
                                <?php esc_html_e( 'Subject', 'dthree-gutenberg' ); ?> <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="<?php echo esc_attr( $form_id ); ?>-subject" 
                                   name="contact_subject" 
                                   required 
                                   aria-required="true">
                            <div class="invalid-feedback">
                                <?php esc_html_e( 'Please enter a subject.', 'dthree-gutenberg' ); ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="<?php echo esc_attr( $form_id ); ?>-message" class="form-label">
                                <?php esc_html_e( 'Message', 'dthree-gutenberg' ); ?> <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="<?php echo esc_attr( $form_id ); ?>-message" 
                                      name="contact_message" 
                                      rows="5" 
                                      required 
                                      aria-required="true"></textarea>
                            <div class="invalid-feedback">
                                <?php esc_html_e( 'Please enter your message.', 'dthree-gutenberg' ); ?>
                            </div>
                        </div>
                        
                        <!-- Honeypot field for spam protection -->
                        <input type="text" 
                               name="contact_website" 
                               style="display:none !important" 
                               tabindex="-1" 
                               autocomplete="off" 
                               aria-hidden="true">
                        
                        <div class="form-message alert d-none" role="alert"></div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <?php echo esc_html( $button_text ); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Handle contact form submission
 */
function dthree_handle_contact_form_submission() {
    // Verify nonce
    if ( ! isset( $_POST['dthree_contact_nonce'] ) || 
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dthree_contact_nonce'] ) ), 'dthree_contact_form' ) ) {
        wp_send_json_error( array( 'message' => __( 'Security check failed.', 'dthree-gutenberg' ) ) );
    }

    // Check honeypot (spam protection)
    if ( ! empty( $_POST['contact_website'] ) ) {
        wp_send_json_error( array( 'message' => __( 'Spam detected.', 'dthree-gutenberg' ) ) );
    }

    // Sanitize and validate inputs
    $name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';
    $to      = isset( $_POST['recipient_email'] ) ? sanitize_email( wp_unslash( $_POST['recipient_email'] ) ) : get_option( 'admin_email' );

    // Validate required fields
    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'dthree-gutenberg' ) ) );
    }

    // Validate email
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'dthree-gutenberg' ) ) );
    }

    // Prepare email
    $email_subject = sprintf( __( '[Contact Form] %s', 'dthree-gutenberg' ), $subject );
    $email_body    = sprintf(
        __( "Name: %s\nEmail: %s\n\nMessage:\n%s", 'dthree-gutenberg' ),
        $name,
        $email,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    // Send email
    $sent = wp_mail( $to, $email_subject, $email_body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => __( 'Thank you! Your message has been sent successfully.', 'dthree-gutenberg' ) ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'Sorry, there was an error sending your message. Please try again later.', 'dthree-gutenberg' ) ) );
    }
}
add_action( 'wp_ajax_dthree_submit_contact_form', 'dthree_handle_contact_form_submission' );
add_action( 'wp_ajax_nopriv_dthree_submit_contact_form', 'dthree_handle_contact_form_submission' );

<?php
/**
 * AI-Friendly Features
 * Makes content easily ingestible by AI crawlers and LLMs
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add AI-readable meta tags
 */
function dthree_ai_meta_tags() {
    if ( is_singular() ) {
        global $post;
        
        // Content type
        echo '<meta name="content-type" content="' . esc_attr( get_post_type() ) . '">' . "\n";
        
        // Reading time
        $reading_time = dthree_calculate_reading_time( $post->post_content );
        echo '<meta name="reading-time" content="' . esc_attr( $reading_time . ' minutes' ) . '">' . "\n";
        
        // Word count
        $word_count = str_word_count( wp_strip_all_tags( $post->post_content ) );
        echo '<meta name="word-count" content="' . esc_attr( $word_count ) . '">' . "\n";
        
        // Content language
        echo '<meta name="content-language" content="' . esc_attr( get_bloginfo( 'language' ) ) . '">' . "\n";
        
        // Last updated
        echo '<meta name="last-updated" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";
        
        // Content freshness indicator
        $days_old = floor( ( time() - get_post_time( 'U' ) ) / DAY_IN_SECONDS );
        $freshness = $days_old < 30 ? 'fresh' : ( $days_old < 90 ? 'recent' : 'dated' );
        echo '<meta name="content-freshness" content="' . esc_attr( $freshness ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'dthree_ai_meta_tags', 5 );

/**
 * Add structured content outline in meta tag
 */
function dthree_content_outline_meta() {
    if ( is_singular() ) {
        global $post;
        
        // Extract headings
        preg_match_all( '/<h([2-6])>(.*?)<\/h[2-6]>/i', $post->post_content, $headings );
        
        if ( ! empty( $headings[2] ) ) {
            $outline = array();
            foreach ( $headings[2] as $index => $heading ) {
                $level = $headings[1][$index];
                $clean_heading = wp_strip_all_tags( $heading );
                $outline[] = str_repeat( '  ', $level - 2 ) . $clean_heading;
            }
            
            $outline_json = wp_json_encode( $outline );
            echo '<meta name="content-outline" content=\'' . esc_attr( $outline_json ) . '\'>' . "\n";
        }
    }
}
add_action( 'wp_head', 'dthree_content_outline_meta', 6 );

/**
 * Add AI-specific JSON-LD with enhanced data
 */
function dthree_ai_json_ld() {
    if ( is_singular( 'post' ) ) {
        global $post;
        
        $schema = array(
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'description'   => dthree_get_meta_description(),
            'articleBody'   => wp_strip_all_tags( $post->post_content ),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'wordCount'     => str_word_count( wp_strip_all_tags( $post->post_content ) ),
            'timeRequired'  => 'PT' . dthree_calculate_reading_time( $post->post_content ) . 'M',
            'author'        => array(
                '@type'       => 'Person',
                'name'        => get_the_author_meta( 'display_name', $post->post_author ),
                'url'         => get_author_posts_url( $post->post_author ),
                'description' => get_the_author_meta( 'description', $post->post_author ),
            ),
            'publisher'     => array(
                '@type' => 'Organization',
                'name'  => get_bloginfo( 'name' ),
                'url'   => home_url( '/' ),
            ),
        );
        
        // Add image
        $image = dthree_get_featured_image_url();
        if ( $image ) {
            $schema['image'] = $image;
        }
        
        // Add categories
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $schema['articleSection'] = array();
            foreach ( $categories as $category ) {
                $schema['articleSection'][] = $category->name;
            }
        }
        
        // Add tags as keywords
        $tags = get_the_tags();
        if ( $tags ) {
            $schema['keywords'] = array();
            foreach ( $tags as $tag ) {
                $schema['keywords'][] = $tag->name;
            }
        }
        
        // Add TOC if exists
        $toc = dthree_generate_toc( $post->post_content );
        if ( ! empty( $toc ) ) {
            $schema['hasPart'] = array();
            foreach ( $toc as $item ) {
                $schema['hasPart'][] = array(
                    '@type'    => 'WebPageElement',
                    'name'     => $item['text'],
                    'position' => $item['level'],
                );
            }
        }
        
        echo '<script type="application/ld+json" id="ai-enhanced-schema">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) . "\n";
        echo '</script>' . "\n";
    }
}
add_action( 'wp_head', 'dthree_ai_json_ld', 7 );

/**
 * Generate table of contents from content
 */
function dthree_generate_toc( $content ) {
    $toc = array();
    preg_match_all( '/<h([2-6])>(.*?)<\/h[2-6]>/i', $content, $headings );
    
    if ( ! empty( $headings[2] ) ) {
        foreach ( $headings[2] as $index => $heading ) {
            $toc[] = array(
                'level' => intval( $headings[1][$index] ),
                'text'  => wp_strip_all_tags( $heading ),
                'slug'  => sanitize_title( $heading ),
            );
        }
    }
    
    return $toc;
}

/**
 * Add semantic HTML5 article structure
 */
function dthree_semantic_article_wrapper( $content ) {
    if ( is_singular( 'post' ) && is_main_query() && in_the_loop() ) {
        // Add article wrapper with semantic attributes
        $article_attrs = array(
            'role'           => 'article',
            'itemscope'      => '',
            'itemtype'       => 'https://schema.org/Article',
            'data-word-count' => str_word_count( wp_strip_all_tags( $content ) ),
            'data-reading-time' => dthree_calculate_reading_time( $content ),
        );
        
        $attrs_string = '';
        foreach ( $article_attrs as $key => $value ) {
            $attrs_string .= $value ? ' ' . $key . '="' . esc_attr( $value ) . '"' : ' ' . $key;
        }
        
        // Wrap content in semantic sections
        $structured_content = '<div class="article-content"' . $attrs_string . '>';
        
        // Add summary if excerpt exists
        if ( has_excerpt() ) {
            $structured_content .= '<div class="article-summary" itemprop="description">';
            $structured_content .= '<p class="lead">' . get_the_excerpt() . '</p>';
            $structured_content .= '</div>';
        }
        
        // Main content
        $structured_content .= '<div class="article-body" itemprop="articleBody">';
        $structured_content .= $content;
        $structured_content .= '</div>';
        
        $structured_content .= '</div>';
        
        return $structured_content;
    }
    
    return $content;
}
add_filter( 'the_content', 'dthree_semantic_article_wrapper', 20 );

/**
 * Add AI-readable data attributes to images
 */
function dthree_ai_image_attributes( $attr, $attachment, $size ) {
    // Add descriptive attributes
    $metadata = wp_get_attachment_metadata( $attachment->ID );
    
    if ( $metadata ) {
        // Add dimensions
        if ( isset( $metadata['width'] ) && isset( $metadata['height'] ) ) {
            $attr['data-width'] = $metadata['width'];
            $attr['data-height'] = $metadata['height'];
            $attr['data-aspect-ratio'] = round( $metadata['width'] / $metadata['height'], 2 );
        }
        
        // Add file size
        if ( isset( $metadata['filesize'] ) ) {
            $attr['data-filesize'] = size_format( $metadata['filesize'] );
        }
    }
    
    // Add context
    $attr['data-context'] = is_singular() ? get_the_title() : get_bloginfo( 'name' );
    
    // Ensure alt text exists
    if ( empty( $attr['alt'] ) ) {
        $attr['alt'] = get_the_title( $attachment->ID );
    }
    
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'dthree_ai_image_attributes', 10, 3 );

/**
 * Add robots.txt enhancements for AI crawlers
 */
function dthree_robots_txt( $output ) {
    $additions = "
# AI Crawler Specific Rules
User-agent: GPTBot
User-agent: ChatGPT-User
User-agent: CCBot
User-agent: anthropic-ai
User-agent: Claude-Web
Allow: /

# Crawl-delay for AI bots (be respectful)
Crawl-delay: 1

# Sitemap
Sitemap: " . home_url( '/wp-sitemap.xml' ) . "
";
    
    return $output . $additions;
}
add_filter( 'robots_txt', 'dthree_robots_txt' );

/**
 * Add custom HTTP headers for AI crawlers
 */
function dthree_ai_http_headers() {
    if ( is_singular() ) {
        header( 'X-Content-Type: article' );
        header( 'X-Reading-Time: ' . dthree_calculate_reading_time( get_post_field( 'post_content', get_the_ID() ) ) . ' minutes' );
        header( 'X-Last-Updated: ' . get_the_modified_date( 'c' ) );
        header( 'X-AI-Friendly: true' );
    }
}
add_action( 'send_headers', 'dthree_ai_http_headers' );

/**
 * Generate AI-optimized sitemap enhancement
 */
function dthree_ai_sitemap_additions( $sitemap ) {
    // Add change frequency and priority hints for AI crawlers
    $sitemap = str_replace(
        '<urlset',
        '<urlset xmlns:ai="https://schema.org/AIAssistant"',
        $sitemap
    );
    
    return $sitemap;
}
add_filter( 'wp_sitemaps_posts_entry', 'dthree_add_ai_sitemap_data', 10, 2 );

function dthree_add_ai_sitemap_data( $sitemap_entry, $post ) {
    // Add reading time
    $sitemap_entry['reading_time'] = dthree_calculate_reading_time( $post->post_content );
    
    // Add content type
    $sitemap_entry['content_type'] = $post->post_type;
    
    // Add word count
    $sitemap_entry['word_count'] = str_word_count( wp_strip_all_tags( $post->post_content ) );
    
    return $sitemap_entry;
}

/**
 * Add machine-readable FAQ schema for AI
 */
function dthree_faq_schema_detection( $content ) {
    // Auto-detect FAQ patterns in content
    if ( is_singular() && ( strpos( $content, '<h2>' ) !== false || strpos( $content, '<h3>' ) !== false ) ) {
        preg_match_all( '/<h([23])>(.*?)<\/h[23]>(.*?)(?=<h[23]>|$)/is', $content, $matches, PREG_SET_ORDER );
        
        $faqs = array();
        foreach ( $matches as $match ) {
            $question = wp_strip_all_tags( $match[2] );
            $answer = wp_strip_all_tags( $match[3] );
            
            // Check if it looks like a question
            if ( preg_match( '/\?|^(what|how|why|when|where|who|can|is|are|do|does)/i', $question ) ) {
                $faqs[] = array(
                    '@type'          => 'Question',
                    'name'           => $question,
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => trim( $answer ),
                    ),
                );
            }
        }
        
        if ( count( $faqs ) >= 2 ) {
            $schema = array(
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $faqs,
            );
            
            echo '<script type="application/ld+json" id="auto-detected-faq">' . "\n";
            echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) . "\n";
            echo '</script>' . "\n";
        }
    }
}
add_action( 'wp_footer', 'dthree_faq_schema_detection' );

/**
 * Add AI training opt-out meta tag (if needed)
 */
function dthree_ai_training_control() {
    // Add option to customizer to control AI training
    $allow_ai_training = get_theme_mod( 'dthree_allow_ai_training', true );
    
    if ( ! $allow_ai_training ) {
        echo '<meta name="robots" content="noai, noimageai">' . "\n";
        echo '<meta name="ai-training" content="opt-out">' . "\n";
    }
}
add_action( 'wp_head', 'dthree_ai_training_control', 1 );

/**
 * Add content summary for AI at the end of posts
 */
function dthree_add_ai_content_summary( $content ) {
    if ( is_singular( 'post' ) && is_main_query() && in_the_loop() ) {
        // Generate extractive summary
        $paragraphs = explode( '</p>', wp_strip_all_tags( $content, '<p>' ) );
        $first_paragraph = isset( $paragraphs[0] ) ? trim( strip_tags( $paragraphs[0] ) ) : '';
        
        if ( $first_paragraph ) {
            $summary = '<div class="ai-content-summary" style="display:none;" data-purpose="ai-extraction">';
            $summary .= '<meta itemprop="abstract" content="' . esc_attr( $first_paragraph ) . '">';
            $summary .= '<p class="summary-text">' . esc_html( $first_paragraph ) . '</p>';
            
            // Add key topics
            $categories = get_the_category();
            if ( $categories ) {
                $summary .= '<meta itemprop="about" content="' . esc_attr( $categories[0]->name ) . '">';
            }
            
            $summary .= '</div>';
            
            $content .= $summary;
        }
    }
    
    return $content;
}
add_filter( 'the_content', 'dthree_add_ai_content_summary', 25 );

/**
 * Add customizer option for AI features
 */
function dthree_ai_customizer_settings( $wp_customize ) {
    // Add AI section
    $wp_customize->add_section( 'dthree_ai_settings', array(
        'title'    => __( 'AI & Search Settings', 'dthree-gutenberg' ),
        'priority' => 160,
    ) );
    
    // Allow AI training
    $wp_customize->add_setting( 'dthree_allow_ai_training', array(
        'default'           => true,
        'sanitize_callback' => 'absint',
    ) );
    
    $wp_customize->add_control( 'dthree_allow_ai_training', array(
        'label'       => __( 'Allow AI Training', 'dthree-gutenberg' ),
        'description' => __( 'Allow AI models to train on your content', 'dthree-gutenberg' ),
        'section'     => 'dthree_ai_settings',
        'type'        => 'checkbox',
    ) );
    
    // Add enhanced metadata
    $wp_customize->add_setting( 'dthree_enhanced_metadata', array(
        'default'           => true,
        'sanitize_callback' => 'absint',
    ) );
    
    $wp_customize->add_control( 'dthree_enhanced_metadata', array(
        'label'       => __( 'Enhanced Metadata', 'dthree-gutenberg' ),
        'description' => __( 'Add extra metadata for AI and search engines', 'dthree-gutenberg' ),
        'section'     => 'dthree_ai_settings',
        'type'        => 'checkbox',
    ) );
}
add_action( 'customize_register', 'dthree_ai_customizer_settings' );

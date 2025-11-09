# Social Media Integration Guide

## Overview

The DThree Gutenberg theme includes comprehensive social media integration with support for 15+ platforms and multiple display options.

## Supported Platforms

1. **Facebook** - `bi-facebook`
2. **Twitter** - `bi-twitter`
3. **Instagram** - `bi-instagram`
4. **LinkedIn** - `bi-linkedin`
5. **YouTube** - `bi-youtube`
6. **GitHub** - `bi-github`
7. **TikTok** - `bi-tiktok`
8. **Pinterest** - `bi-pinterest`
9. **WhatsApp** - `bi-whatsapp`
10. **Telegram** - `bi-telegram`
11. **Discord** - `bi-discord`
12. **Snapchat** - `bi-snapchat`
13. **Reddit** - `bi-reddit`
14. **Medium** - `bi-medium`
15. **Twitch** - `bi-twitch`

## Configuration

### Step 1: Add Social Media URLs

Navigate to **Appearance → Customize → DThree Theme Options → Social Media Links**

Add URLs for each social platform you want to display:
- Facebook URL: `https://facebook.com/yourpage`
- Twitter URL: `https://twitter.com/yourhandle`
- Instagram URL: `https://instagram.com/yourprofile`
- etc.

### Step 2: Display Options

The theme automatically displays social links in the **footer** by default.

## Display Functions

### Basic Display

Use the `dthree_display_social_links()` function to display social links anywhere in your theme:

```php
<?php dthree_display_social_links(); ?>
```

### Display with Options

Customize the appearance with various options:

```php
<?php
dthree_display_social_links( array(
    'show_labels' => false,     // Show platform names
    'size'        => 'normal',  // Size: small, normal, large
    'style'       => 'default', // Style: default, rounded, square
    'class'       => '',        // Additional CSS classes
) );
?>
```

#### Size Options

**Small:**
```php
dthree_display_social_links( array( 'size' => 'small' ) );
```

**Normal (default):**
```php
dthree_display_social_links( array( 'size' => 'normal' ) );
```

**Large:**
```php
dthree_display_social_links( array( 'size' => 'large' ) );
```

#### Style Options

**Default (no background):**
```php
dthree_display_social_links( array( 'style' => 'default' ) );
```

**Rounded (circular background):**
```php
dthree_display_social_links( array( 'style' => 'rounded' ) );
```

**Square (rounded square background):**
```php
dthree_display_social_links( array( 'style' => 'square' ) );
```

#### Show Labels

Display platform names next to icons:

```php
dthree_display_social_links( array( 'show_labels' => true ) );
```

### Complete Example

```php
<?php
dthree_display_social_links( array(
    'show_labels' => true,
    'size'        => 'large',
    'style'       => 'rounded',
    'class'       => 'my-custom-class mt-4',
) );
?>
```

## Usage in Templates

### Header (header.php)

Add social links to the header navigation:

```php
<div class="collapse navbar-collapse" id="navbarNav">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'navbar-nav ms-auto',
        'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
        'walker'         => new WP_Bootstrap_Navwalker(),
    ) );
    
    // Add social links
    dthree_display_social_links( array(
        'size'  => 'small',
        'class' => 'ms-3',
    ) );
    ?>
</div>
```

### Footer (footer.php)

Already included by default:

```php
<div class="col-md-6 text-md-end">
    <?php
    dthree_display_social_links( array(
        'size'  => 'normal',
        'class' => 'd-inline-block mb-3 mb-md-0',
    ) );
    ?>
</div>
```

### Sidebar (sidebar.php)

Add a social widget to the sidebar:

```php
<aside class="widget widget-social">
    <h3 class="widget-title">Follow Us</h3>
    <?php
    dthree_display_social_links( array(
        'style' => 'rounded',
        'size'  => 'normal',
    ) );
    ?>
</aside>
```

### Single Post (single.php)

Add social sharing buttons below post content:

```php
<article>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    
    <?php
    // Social share buttons
    dthree_social_share_buttons();
    ?>
</article>
```

## Social Share Buttons

The theme includes a built-in social share function for blog posts:

```php
<?php dthree_social_share_buttons(); ?>
```

This displays share buttons for:
- Facebook
- Twitter
- LinkedIn
- Pinterest
- WhatsApp

### Example Output

```html
<div class="dthree-social-share">
    <h6>Share this post:</h6>
    <div class="d-flex gap-2">
        <a href="..." class="btn btn-sm btn-outline-primary">
            <i class="bi bi-facebook"></i> Facebook
        </a>
        <!-- More buttons... -->
    </div>
</div>
```

## Programmatic Access

### Get Social Links Array

```php
<?php
$social_links = dthree_get_social_links();

foreach ( $social_links as $network => $data ) {
    echo '<a href="' . esc_url( $data['url'] ) . '">';
    echo '<i class="bi ' . esc_attr( $data['icon'] ) . '"></i>';
    echo esc_html( $data['label'] );
    echo '</a>';
}
?>
```

### Check if Social Links Exist

```php
<?php
$social_links = dthree_get_social_links();

if ( ! empty( $social_links ) ) {
    // Display social links
    dthree_display_social_links();
}
?>
```

### Get Specific Platform URL

```php
<?php
$facebook_url = get_theme_mod( 'dthree_social_facebook', '' );

if ( ! empty( $facebook_url ) ) {
    echo '<a href="' . esc_url( $facebook_url ) . '">Visit us on Facebook</a>';
}
?>
```

## Custom Styling

### CSS Classes

All social links have the following classes:

```css
/* Container */
.dthree-social-links { }

/* Individual link */
.social-link { }

/* Network-specific */
.social-link-facebook { }
.social-link-twitter { }
/* etc... */

/* Rounded style */
.social-link.rounded-circle { }

/* Square style */
.social-link.rounded-1 { }
```

### Custom CSS Examples

**Change hover color:**

```css
.dthree-social-links .social-link:hover {
    color: #ff0000;
}
```

**Larger icons:**

```css
.dthree-social-links .social-link i {
    font-size: 2rem;
}
```

**Add borders:**

```css
.dthree-social-links .social-link.rounded-circle {
    border: 2px solid currentColor;
}
```

**Custom spacing:**

```css
.dthree-social-links {
    gap: 1rem;
}
```

## Brand Colors

The theme includes brand color hover effects:

- **Facebook**: `#1877f2`
- **Twitter**: `#1da1f2`
- **Instagram**: `#e4405f`
- **LinkedIn**: `#0a66c2`
- **YouTube**: `#ff0000`
- **GitHub**: `#333333`
- **TikTok**: `#000000`
- **Pinterest**: `#e60023`
- **WhatsApp**: `#25d366`
- **Telegram**: `#0088cc`
- **Discord**: `#5865f2`
- **Snapchat**: `#fffc00`
- **Reddit**: `#ff4500`
- **Medium**: `#00ab6c`
- **Twitch**: `#9146ff`

### Disable Brand Colors

Add this to your child theme or custom CSS:

```css
.social-link-facebook:hover,
.social-link-twitter:hover,
.social-link-instagram:hover,
/* ... other platforms ... */ {
    color: inherit !important;
}
```

## Widget Area Example

Create a custom widget for social links:

```php
// In functions.php or custom plugin
function dthree_register_social_widget() {
    register_sidebar( array(
        'name'          => __( 'Social Links', 'dthree-gutenberg' ),
        'id'            => 'social-links',
        'description'   => __( 'Add social media widgets here', 'dthree-gutenberg' ),
        'before_widget' => '<div class="widget-social">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'dthree_register_social_widget' );
```

## Shortcode (Optional)

Add a shortcode for use in posts and pages:

```php
// In functions.php
function dthree_social_links_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'size'        => 'normal',
        'style'       => 'default',
        'show_labels' => false,
    ), $atts );
    
    ob_start();
    dthree_display_social_links( $atts );
    return ob_get_clean();
}
add_shortcode( 'social_links', 'dthree_social_links_shortcode' );
```

**Usage in posts:**

```
[social_links size="large" style="rounded"]
```

## Best Practices

1. **Don't overload** - Only add platforms you actively use
2. **Consistent placement** - Place social links in expected locations (header or footer)
3. **Accessibility** - The theme includes proper ARIA labels automatically
4. **Mobile friendly** - Social links are responsive by default
5. **Test links** - Verify all URLs open correctly
6. **Use brand guidelines** - Follow each platform's brand guidelines for icons

## Troubleshooting

### Icons not showing

Ensure Bootstrap Icons are loaded. The theme loads them via CDN, but if there's an issue:

```html
<!-- Add to header.php if needed -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
```

### Links not appearing

1. Check that URLs are added in Customizer
2. Clear browser cache
3. Verify the function is called in the template

### Styling issues

Check CSS specificity. You may need to use `!important` or more specific selectors:

```css
.site-footer .dthree-social-links .social-link {
    /* Your styles */
}
```

## Support

For issues or questions about social media integration, check:
- Theme documentation
- WordPress Customizer settings
- Browser console for errors
- CSS inspector for styling issues

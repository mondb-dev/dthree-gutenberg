# DThree Gutenberg Theme - Technical Documentation

## Architecture Overview

The DThree Gutenberg theme is a modern WordPress theme built with extensibility, security, and best practices in mind. It leverages WordPress's block editor (Gutenberg) to provide reusable, customizable components.

## File Structure

```
dthree-gutenberg/
├── assets/                     # Theme assets
│   ├── css/
│   │   ├── custom.css         # Custom theme styles
│   │   └── editor-style.css   # Gutenberg editor styles
│   └── js/
│       ├── main.js            # Main theme JavaScript
│       └── editor.js          # Block editor JavaScript
├── inc/                        # Include files
│   ├── blocks/                # Custom Gutenberg blocks
│   │   ├── hero-section.php
│   │   ├── features.php
│   │   ├── call-to-action.php
│   │   ├── team-members.php
│   │   ├── testimonials.php
│   │   └── contact-form.php
│   ├── customizer.php         # Theme customizer options
│   ├── security.php           # Security functions
│   └── template-functions.php # Template helper functions
├── template-parts/            # Template partials
│   ├── content.php
│   ├── content-page.php
│   ├── content-search.php
│   └── content-none.php
├── languages/                 # Translation files
├── functions.php             # Main theme functions
├── style.css                 # Main stylesheet
├── theme.json               # Theme configuration
└── [template files]         # WordPress templates

```

## Core Features

### 1. Custom Gutenberg Blocks

#### Hero Section Block (`dthree/hero-section`)
- **Purpose**: Full-width hero banners for landing pages
- **Features**:
  - Background image with overlay
  - Customizable text alignment
  - Adjustable minimum height
  - Call-to-action button
  - Text color customization
- **Attributes**: title, subtitle, description, buttonText, buttonUrl, backgroundImage, overlayOpacity, textAlignment, minHeight, textColor

#### Features Block (`dthree/features`)
- **Purpose**: Display services or features in a grid
- **Features**:
  - Multiple feature items
  - Bootstrap Icons support
  - Customizable column count
  - Background color options
- **Attributes**: sectionTitle, sectionSubtitle, features (array), columns, backgroundColor

#### Call-to-Action Block (`dthree/call-to-action`)
- **Purpose**: Compelling conversion sections
- **Features**:
  - Primary and secondary buttons
  - Customizable colors
  - Full-width or contained layouts
- **Attributes**: title, description, primaryButtonText, primaryButtonUrl, secondaryButtonText, secondaryButtonUrl, backgroundColor, textColor

#### Team Members Block (`dthree/team-members`)
- **Purpose**: Showcase team members
- **Features**:
  - Member photos
  - Social media links (Twitter, LinkedIn, Email)
  - Responsive grid layout
- **Attributes**: sectionTitle, sectionSubtitle, members (array), columns

#### Testimonials Block (`dthree/testimonials`)
- **Purpose**: Display customer reviews
- **Features**:
  - Star ratings
  - Customer photos
  - Responsive cards
- **Attributes**: sectionTitle, sectionSubtitle, testimonials (array), columns, backgroundColor

#### Contact Form Block (`dthree/contact-form`)
- **Purpose**: Secure contact form
- **Features**:
  - AJAX submission
  - Server-side validation
  - Honeypot spam protection
  - Bootstrap 5 styling
- **Attributes**: sectionTitle, sectionSubtitle, submitButtonText, recipientEmail

### 2. Bootstrap 5 Integration

The theme uses Bootstrap 5 via CDN for:
- Responsive grid system
- Components (navbar, cards, forms)
- Utilities (spacing, colors, typography)
- JavaScript components (modals, dropdowns, collapse)

**Files**:
- Loaded in `functions.php` via `dthree_enqueue_scripts()`
- Bootstrap Icons for iconography

### 3. Security Implementation

Located in `inc/security.php`:

#### Input Sanitization
- Text fields: `sanitize_text_field()`
- Textareas: `sanitize_textarea_field()`
- Emails: `sanitize_email()`
- URLs: `esc_url_raw()`
- HTML content: `wp_kses_post()`

#### Output Escaping
- URLs: `esc_url()`
- HTML: `esc_html()`
- Attributes: `esc_attr()`
- JavaScript: `esc_js()`

#### Nonce Verification
- Contact form: `wp_verify_nonce()`
- AJAX requests: `dthree_verify_ajax_nonce()`

#### Security Headers
- X-Frame-Options: SAMEORIGIN
- X-Content-Type-Options: nosniff
- X-XSS-Protection: 1; mode=block
- Referrer-Policy: strict-origin-when-cross-origin

#### Additional Security
- Login attempt limiting (5 attempts per 15 minutes)
- WordPress version removal
- XML-RPC disabled
- File editing disabled
- Query string removal from static resources

### 4. SEO Optimization

Located in `functions.php`:

#### Meta Tags (`dthree_add_seo_meta()`)
- Description meta tag (from excerpt)
- Open Graph tags (title, description, type, url, image)
- Twitter Card tags

#### Structured Data (`dthree_add_schema_markup()`)
- Schema.org JSON-LD
- Article markup for blog posts
- Author information
- Published/modified dates

#### SEO Best Practices
- Semantic HTML5 markup
- Proper heading hierarchy
- Alt text support for images
- Clean URL structure
- Breadcrumb navigation

### 5. Accessibility Features

#### WCAG Compliance
- ARIA labels throughout
- Skip links for keyboard navigation
- Focus indicators
- Screen reader text
- Keyboard-accessible dropdowns

#### Implementation
- Located in `style.css` and `assets/css/custom.css`
- JavaScript enhancements in `assets/js/main.js`
- Support for reduced motion
- High contrast mode support

#### Specific Features
- `.screen-reader-text` class
- Skip to content link
- Keyboard navigation support
- Focus visible states
- ARIA landmarks (role="main", role="banner", etc.)

### 6. Theme Customizer

Located in `inc/customizer.php`:

#### Settings Available
1. **Header Settings**
   - Sticky header toggle
   
2. **Footer Settings**
   - Copyright text customization
   
3. **Social Media Links**
   - Facebook, Twitter, Instagram, LinkedIn, YouTube
   
4. **Layout Settings**
   - Container width adjustment
   
5. **Typography**
   - Base font size adjustment
   
6. **Performance**
   - Animation toggle (AOS)
   
7. **SEO Settings**
   - Schema.org markup toggle

### 7. JavaScript Functionality

Located in `assets/js/main.js`:

#### Features
- Smooth scrolling for anchor links
- Contact form AJAX submission
- Scroll-to-top button
- AOS (Animate On Scroll) initialization
- Bootstrap component initialization
- Accessibility enhancements
- Mobile menu improvements
- Lazy loading support

#### Event Handling
- Form validation
- AJAX error handling
- Keyboard navigation
- Window resize handling

### 8. Template System

#### Main Templates
- `index.php` - Blog/archive listing
- `single.php` - Single post view
- `page.php` - Page template
- `archive.php` - Archive pages
- `search.php` - Search results
- `404.php` - Not found page

#### Template Parts
- `content.php` - Post content
- `content-page.php` - Page content
- `content-search.php` - Search result item
- `content-none.php` - No content message

#### Headers & Footers
- `header.php` - Site header with navigation
- `footer.php` - Site footer with widgets
- `sidebar.php` - Sidebar widget area

### 9. Navigation System

#### Bootstrap Navwalker
Located in `inc/template-functions.php`:
- `WP_Bootstrap_Navwalker` class
- Converts WordPress menus to Bootstrap 5 markup
- Supports dropdown menus
- Responsive mobile menu

#### Menu Locations
- Primary (Header)
- Footer

### 10. Widget Areas

Registered in `functions.php`:
- Sidebar (sidebar-1)
- Footer 1 (footer-1)
- Footer 2 (footer-2)
- Footer 3 (footer-3)

## Performance Considerations

### Optimization Techniques
1. **CDN Usage**: Bootstrap loaded from CDN
2. **Minimal Dependencies**: No jQuery
3. **Lazy Loading**: Image lazy loading support
4. **Caching**: Query string removal for better caching
5. **Efficient Loading**: Scripts loaded in footer

### Recommended Plugins
- **Caching**: WP Super Cache or W3 Total Cache
- **Image Optimization**: Smush or ShortPixel
- **Minification**: Autoptimize
- **CDN**: Cloudflare

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari 12+, Chrome Mobile)

## WordPress Requirements

- WordPress 6.0+
- PHP 7.4+
- MySQL 5.6+ or MariaDB 10.1+

## Extending the Theme

### Adding Custom Blocks

1. Create a new file in `inc/blocks/your-block.php`
2. Register the block using `register_block_type()`
3. Include the file in `functions.php`

Example:
```php
require_once DTHREE_THEME_DIR . '/inc/blocks/your-block.php';
```

### Adding Customizer Options

Add settings in `inc/customizer.php`:
```php
$wp_customize->add_setting( 'your_setting', array(
    'default'           => 'value',
    'sanitize_callback' => 'sanitize_text_field',
) );
```

### Custom Template Functions

Add helper functions in `inc/template-functions.php`:
```php
function dthree_your_function() {
    // Your code here
}
```

## Security Best Practices Applied

1. ✅ Input Validation & Sanitization
2. ✅ Output Escaping
3. ✅ Nonce Verification
4. ✅ SQL Injection Prevention (using WP APIs)
5. ✅ XSS Protection
6. ✅ CSRF Protection
7. ✅ Secure File Uploads
8. ✅ Rate Limiting (login attempts)
9. ✅ Security Headers
10. ✅ Version Information Removal

## WordPress Coding Standards

The theme follows:
- WordPress PHP Coding Standards
- WordPress HTML Coding Standards
- WordPress CSS Coding Standards
- WordPress JavaScript Coding Standards
- WordPress Accessibility Coding Standards

## Testing Checklist

- [ ] Install on fresh WordPress installation
- [ ] Test all custom blocks
- [ ] Verify contact form functionality
- [ ] Check mobile responsiveness
- [ ] Test keyboard navigation
- [ ] Validate HTML/CSS
- [ ] Check browser compatibility
- [ ] Test with screen readers
- [ ] Verify SEO meta tags
- [ ] Check security headers
- [ ] Test form spam protection
- [ ] Verify customizer options

## Known Limitations

1. **AOS Library**: Not included by default (can be added via CDN if needed)
2. **Screenshot**: Placeholder needed for theme thumbnail
3. **Language Files**: .pot file needs to be generated for translations

## Future Enhancements

Potential additions for future versions:
- WooCommerce integration
- Additional custom blocks
- More customizer options
- Pattern library
- Block variations
- Dark mode support
- Additional templates (full-width, sidebar-left, etc.)

## Maintenance

### Regular Updates
- Keep WordPress core updated
- Update Bootstrap CDN links when new versions release
- Review and update security functions
- Test with new WordPress versions

### Monitoring
- Check error logs regularly
- Monitor contact form submissions
- Review security logs
- Test performance regularly

## License

GNU General Public License v2 or later

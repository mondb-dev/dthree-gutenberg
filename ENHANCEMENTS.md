# Theme Enhancements Guide

## Overview

The DThree Gutenberg theme now includes 8 powerful enhancements to improve user experience, engagement, and compliance. All features are fully customizable through the WordPress Customizer.

---

## ✅ Features Added

### 1. 📊 Reading Time Estimator
**Status:** ✅ Implemented

Displays estimated reading time for blog posts (e.g., "5 min read").

**Features:**
- Automatic calculation based on word count
- Average reading speed: 200 words per minute
- Displays with clock icon
- Can be toggled on/off in Customizer

**Usage:**
```php
// Display reading time
<?php dthree_display_reading_time(); ?>

// Get reading time string
<?php echo dthree_get_reading_time(); ?>
```

**Configuration:**
`Appearance → Customize → DThree Theme Options → Content Settings → Show Reading Time`

**Where it appears:**
- Blog post meta area
- Archive/listing pages

---

### 2. 🔗 Related Posts Section
**Status:** ✅ Implemented

Displays 3 related posts at the end of single blog posts based on categories.

**Features:**
- Automatic category matching
- Randomized selection for variety
- Responsive grid layout (3 columns)
- Optional thumbnails, excerpts, and dates
- "Read More" buttons

**Usage:**
```php
// Display related posts with default settings
<?php dthree_related_posts(); ?>

// Custom configuration
<?php
dthree_related_posts( array(
    'posts_per_page' => 4,
    'show_thumbnail' => true,
    'show_excerpt'   => true,
    'show_date'      => true,
    'title'          => 'You Might Also Like',
) );
?>
```

**Configuration:**
`Appearance → Customize → DThree Theme Options → Content Settings → Show Related Posts`

**Where it appears:**
- End of single blog posts (before comments)

---

### 3. 📖 Table of Contents Generator
**Status:** ✅ Implemented

Auto-generates a table of contents from H2 and H3 headings in blog posts.

**Features:**
- Automatically extracts headings from content
- Creates clickable links with smooth scroll
- Only shows if 3+ headings exist
- Styled card design
- Hierarchical structure (H2 primary, H3 sub-items)
- Auto-inserts after first paragraph

**Configuration:**
`Appearance → Customize → DThree Theme Options → Content Settings → Enable Table of Contents`

**CSS Classes:**
- `.table-of-contents` - Container card
- `.toc-title` - Title heading
- `.toc-list` - Ordered list
- `.toc-subitem` - H3 sub-items

**How it works:**
When enabled, the filter scans post content for headings, generates IDs, creates a linked list, and inserts it after the first paragraph.

---

### 4. 👁️ Post View Counter
**Status:** ✅ Implemented

Tracks and displays the number of views for each post.

**Features:**
- Automatic view tracking on single posts
- Doesn't count admin views (optional)
- Displays with eye icon
- Stored in post meta
- Used by Popular Posts widget

**Usage:**
```php
// Display view count
<?php dthree_display_post_views(); ?>

// Get view count number
<?php $views = dthree_get_post_views(); ?>

// Manually set views
<?php dthree_set_post_views( $post_id ); ?>
```

**Where it appears:**
- Single post meta area
- Popular Posts widget

---

### 5. 🍪 Cookie Consent Notice
**Status:** ✅ Implemented

GDPR-compliant cookie consent banner with customizable message.

**Features:**
- Fixed bottom position
- Accept/Decline buttons
- Customizable message text
- Link to Privacy Policy
- Stores user preference for 365 days
- Slide-in animation
- Responsive design
- JavaScript-based (no page reload)

**Configuration:**
```
Appearance → Customize → DThree Theme Options → Privacy & Compliance
- Enable Cookie Consent Notice
- Cookie Consent Message (customizable text)
```

**Cookie Behavior:**
- **Accepted:** Sets `dthree_cookie_consent=accepted` cookie
- **Declined:** Sets `dthree_cookie_consent=declined` cookie
- **Duration:** 365 days
- Banner only shows if no choice has been made

**Customize Message:**
Default: "We use cookies to ensure you get the best experience on our website. By continuing to browse, you agree to our use of cookies."

**CSS Classes:**
- `.cookie-consent` - Main container
- `.cookie-consent-content` - Content wrapper
- `.cookie-consent-text` - Message text
- `.cookie-consent-link` - Privacy policy link
- `.cookie-consent-actions` - Button container

---

### 6. 🧭 Breadcrumb Navigation
**Status:** ✅ Enhanced

Added shortcode support to existing breadcrumb function.

**Features:**
- Automatic breadcrumb generation
- Schema.org markup
- Responsive design
- Bootstrap styling

**Usage:**
```php
// In templates
<?php dthree_breadcrumbs(); ?>

// Shortcode (in content)
[breadcrumbs]
```

**Where it appears:**
- Can be placed anywhere via function call or shortcode
- Not shown on homepage

---

### 7. 📧 Newsletter Signup Widget
**Status:** ✅ Implemented

Widget for email subscriptions (integrates with Mailchimp, ConvertKit, etc.).

**Features:**
- Customizable title and description
- Email validation
- Honeypot spam protection
- Submit button text customization
- Form action URL configuration
- Full-width button
- Bootstrap styling

**Setup:**
1. Go to `Appearance → Widgets`
2. Add "DThree - Newsletter Signup" widget to desired area
3. Configure:
   - **Title:** e.g., "Subscribe to Newsletter"
   - **Description:** e.g., "Get updates delivered to your inbox"
   - **Form Action URL:** Your email service form endpoint
   - **Button Text:** e.g., "Subscribe"

**Compatible Services:**
- Mailchimp
- ConvertKit
- MailerLite
- Sendinblue
- Any service with form POST support

**Mailchimp Example:**
Form Action URL: `https://yourlist.us1.list-manage.com/subscribe/post?u=xxxxx&id=xxxxx`

---

### 8. 🔥 Popular Posts Widget
**Status:** ✅ Implemented

Displays most viewed posts based on view counter.

**Features:**
- Customizable number of posts
- Optional post thumbnails
- Optional view count display
- Date display
- Responsive thumbnail grid
- Sorted by views (highest first)

**Setup:**
1. Go to `Appearance → Widgets`
2. Add "DThree - Popular Posts" widget
3. Configure:
   - **Title:** e.g., "Popular Posts"
   - **Number of posts:** 1-10
   - **Show thumbnails:** Yes/No
   - **Show view count:** Yes/No

**Note:** Requires Post View Counter to be active to track views.

---

### 9. 🖨️ Print Stylesheet
**Status:** ✅ Implemented

Optimized print styles for blog posts and pages.

**Features:**
- Clean, print-optimized layout
- Hides navigation, widgets, and interactive elements
- Shows full URLs for links
- Proper page breaks
- Professional typography
- Black & white optimization
- A4 page size with margins
- Preserves content structure

**Automatically Applied:**
Print stylesheet is automatically loaded with `media="print"` attribute.

**What gets hidden:**
- Header/Footer
- Navigation menus
- Sidebar
- Comments
- Social share buttons
- Cookie consent
- Related posts
- Table of contents

**What gets optimized:**
- Typography (serif fonts, proper sizes)
- Images (contained, no breaks)
- Links (URLs displayed after link text)
- Headings (proper page break handling)
- Tables and code blocks (contained)

**Manual Print:**
Users can print via `Ctrl+P` / `Cmd+P` or browser print function.

---

## 📍 Customizer Settings

All new features can be controlled from:
**`Appearance → Customize → DThree Theme Options`**

### Content Settings Section
- ✅ Enable Table of Contents
- ✅ Show Reading Time
- ✅ Show Related Posts

### Privacy & Compliance Section
- ✅ Enable Cookie Consent Notice
- ✅ Cookie Consent Message (textarea)

---

## 🎨 CSS Classes Reference

### Related Posts
```css
.related-posts              /* Container */
.related-posts-title        /* Section title */
.related-post              /* Individual post card */
.related-post-thumbnail    /* Thumbnail link */
.related-post-title        /* Post title */
.related-post-meta         /* Date/meta info */
.related-post-excerpt      /* Excerpt text */
```

### Table of Contents
```css
.table-of-contents         /* Card container */
.toc-title                 /* TOC heading */
.toc-list                  /* Ordered list */
.toc-subitem              /* H3 sub-items */
```

### Cookie Consent
```css
.cookie-consent            /* Fixed banner */
.cookie-consent-content    /* Content wrapper */
.cookie-consent-text       /* Message text */
.cookie-consent-link       /* Privacy link */
.cookie-consent-actions    /* Button container */
```

### Post Meta
```css
.reading-time             /* Reading time display */
.post-views               /* View count display */
```

### Widgets
```css
.popular-posts-list       /* Popular posts container */
.popular-post-item        /* Individual item */
.newsletter-form          /* Newsletter form */
```

---

## 🔧 Developer Hooks & Filters

### Customize Related Posts
```php
add_filter( 'dthree_related_posts_args', function( $args ) {
    $args['posts_per_page'] = 6;
    return $args;
} );
```

### Customize TOC
```php
add_filter( 'the_content', function( $content ) {
    // Your TOC customization
    return $content;
}, 5 ); // Before TOC filter at priority 10
```

### Customize View Tracking
```php
// Disable tracking for specific posts
add_action( 'wp_head', function() {
    if ( is_single( 123 ) ) {
        remove_action( 'wp_head', 'dthree_track_post_views' );
    }
}, 5 );
```

---

## 📊 Performance Considerations

### Post View Counter
- Uses WordPress post meta (efficient)
- Single database query per page view
- Cached by WordPress object cache

### Related Posts
- Randomized selection (varies on each page load)
- Cached by page caching plugins
- Limit to 3-4 posts for best performance

### Table of Contents
- Processes content via filter (no database queries)
- Minimal performance impact
- Only activates on posts with 3+ headings

### Cookie Consent
- Pure JavaScript (no server requests)
- localStorage for user preference
- Minimal DOM manipulation

---

## 🔍 Troubleshooting

### Related Posts Not Showing
- Check that posts have categories
- Verify setting is enabled in Customizer
- Clear cache if using caching plugin

### TOC Not Appearing
- Enable in Customizer: Content Settings → Enable Table of Contents
- Ensure post has at least 3 H2 or H3 headings
- Check heading structure is valid HTML

### View Counter Not Tracking
- Check you're not logged in as admin
- View post in incognito/private window
- Allow time for counts to accumulate

### Cookie Banner Not Showing
- Check it's enabled in Customizer
- Clear browser cookies
- Check JavaScript console for errors

### Print Styles Not Working
- Use browser print preview
- Clear browser cache
- Verify print.css is loaded

---

## 🚀 Quick Start Checklist

### Initial Setup
1. ✅ Go to `Appearance → Customize → DThree Theme Options`
2. ✅ Enable desired features in Content Settings
3. ✅ Configure Cookie Consent in Privacy & Compliance
4. ✅ Add Popular Posts widget to sidebar
5. ✅ Add Newsletter widget to footer
6. ✅ Test features on live blog post

### Recommended Configuration
```
Content Settings:
✅ Enable Table of Contents: Yes (for long-form posts)
✅ Show Reading Time: Yes
✅ Show Related Posts: Yes

Privacy & Compliance:
✅ Enable Cookie Consent: Yes
✅ Customize consent message if needed
```

---

## 📝 Best Practices

### Reading Time
- Works best with posts 300+ words
- Automatically adjusts for all post lengths
- Helps users decide to engage with content

### Related Posts
- Ensure posts are properly categorized
- Use specific categories for better matching
- Keep to 3-4 posts for best UX

### Table of Contents
- Best for posts 1000+ words
- Use proper heading hierarchy (H2, H3)
- Keep heading text concise and descriptive

### Cookie Consent
- Update message to match your privacy policy
- Keep message clear and concise
- Link to detailed privacy policy page

### Post Views
- Allow time for views to accumulate
- Use Popular Posts widget to showcase trending content
- Don't display views on every post (can be toggling in template)

### Newsletter
- Integrate with professional email service
- Test form submission before going live
- Keep description benefit-focused

---

## 🎯 Feature Summary

| Feature | Location | Customizable | Widget | Shortcode |
|---------|----------|--------------|--------|-----------|
| Reading Time | Post Meta | ✅ Yes | ❌ No | ❌ No |
| Related Posts | End of Post | ✅ Yes | ❌ No | ❌ No |
| Table of Contents | In Content | ✅ Yes | ❌ No | ❌ No |
| Post Views | Post Meta | ❌ No | ✅ Yes | ❌ No |
| Cookie Consent | Footer | ✅ Yes | ❌ No | ❌ No |
| Breadcrumbs | Template/Content | ❌ No | ❌ No | ✅ Yes |
| Newsletter | Widgets | ✅ Yes | ✅ Yes | ❌ No |
| Popular Posts | Widgets | ✅ Yes | ✅ Yes | ❌ No |
| Print Styles | Automatic | ❌ No | ❌ No | ❌ No |

---

## 🔗 Additional Resources

- [WordPress Customizer Documentation](https://developer.wordpress.org/themes/customize-api/)
- [WordPress Widgets](https://developer.wordpress.org/themes/functionality/widgets/)
- [GDPR Compliance Guide](https://wordpress.org/about/privacy/)
- [Print CSS Best Practices](https://www.smashingmagazine.com/2011/11/how-to-set-up-a-print-style-sheet/)

---

## 💡 Future Enhancements

Potential additions for future versions:
- Dark mode toggle
- Social sharing counters
- Advanced search filters
- Progressive Web App (PWA) support
- Reading progress bar
- Estimated time to complete forms
- PDF export for posts
- Email this article feature

---

## 📧 Support

For issues or questions about theme enhancements:
1. Check this documentation
2. Review Customizer settings
3. Clear all caches (browser + plugin)
4. Check browser console for JavaScript errors
5. Test in default WordPress theme to isolate issue

---

**Last Updated:** November 9, 2025
**Theme Version:** 1.0.0
**Compatible With:** WordPress 6.0+

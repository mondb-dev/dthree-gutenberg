# Lightbox Implementation Guide

## Overview

DThree Gutenberg includes a modern, accessible, and feature-rich lightbox implementation for displaying images in an elegant overlay. Built with vanilla JavaScript and CSS, it requires no additional libraries.

## Features

### 🎨 **Core Features**
- ✅ Full-screen image viewing
- ✅ Gallery navigation (prev/next)
- ✅ Thumbnail strip for quick navigation
- ✅ Image zoom (up to 3x) with pan/drag
- ✅ Image captions
- ✅ Image counter (1/10)
- ✅ Smooth animations
- ✅ Loading state indicator

### ♿ **Accessibility**
- ✅ Keyboard navigation (arrows, ESC, +/-, 0)
- ✅ ARIA labels and roles
- ✅ Focus management
- ✅ Screen reader support
- ✅ Reduced motion support

### 📱 **Responsive**
- ✅ Mobile-optimized controls
- ✅ Touch/swipe support (via Bootstrap)
- ✅ Adaptive UI elements
- ✅ Works on all screen sizes

### ⚡ **Performance**
- ✅ Lazy loading
- ✅ Hardware-accelerated animations
- ✅ Minimal DOM manipulation
- ✅ No external dependencies

---

## Installation

The lightbox is **automatically enabled** when you activate the theme. No configuration needed!

### Files
```
/assets/css/lightbox.css     ← Styles
/assets/js/lightbox.js       ← JavaScript
/inc/lightbox.php            ← PHP helpers
```

---

## Automatic Detection

The lightbox automatically works with:

### 1. WordPress Galleries
Any gallery created with WordPress (block editor or classic):
```html
<!-- WordPress Gallery Block -->
<figure class="wp-block-gallery">
    <img src="image.jpg" alt="Photo" />
    <!-- Lightbox automatically enabled -->
</figure>
```

### 2. Image Sliders
All DThree slider components:
```html
<!-- Image Slider, Content Slider, etc. -->
<div class="dthree-image-slider">
    <img src="image.jpg" alt="Slide" />
    <!-- Lightbox automatically enabled -->
</div>
```

### 3. Content Images
Images in post/page content:
```html
<!-- In blog post content -->
<img src="photo.jpg" alt="Blog photo" />
<!-- Lightbox automatically added -->
```

### 4. Manual Trigger
Add `data-lightbox` attribute:
```html
<img src="image.jpg" 
     alt="Photo" 
     data-lightbox="true"
     data-full-url="image-full.jpg"
     data-caption="My awesome photo" />
```

---

## Usage Methods

### Method 1: Data Attributes (Recommended)

```html
<img src="thumbnail.jpg" 
     alt="Image description"
     data-lightbox="true"
     data-full-url="full-size.jpg"
     data-caption="Photo caption text" />
```

**Attributes:**
- `data-lightbox="true"` - Enables lightbox
- `data-full-url` - Full-size image URL (optional)
- `data-caption` - Caption text (optional)

### Method 2: Shortcode (Simple Image)

```
[lightbox src="full-image.jpg" thumb="thumbnail.jpg" caption="My Photo" alt="Photo description"]
```

**Parameters:**
- `src` - Full-size image URL (required)
- `thumb` - Thumbnail URL (optional, uses `src` if not provided)
- `caption` - Image caption (optional)
- `alt` - Alt text (optional)
- `class` - Additional CSS classes (optional)

### Method 3: Shortcode (Gallery)

```
[lightbox_gallery ids="15,23,42,67" columns="3" size="medium"]
```

**Parameters:**
- `ids` - Comma-separated attachment IDs (required)
- `columns` - Number of columns (default: 3)
- `size` - Thumbnail size: thumbnail, medium, large (default: medium)

### Method 4: PHP Function

```php
<?php
// Display single lightbox image
echo dthree_get_lightbox_image( 
    123,           // Attachment ID
    'large',       // Image size
    array(         // Additional attributes
        'class' => 'my-custom-class'
    )
);
?>
```

### Method 5: WordPress Gallery

Just create a gallery in the block editor:
1. Add Gallery block
2. Select images
3. Publish
4. Lightbox automatically enabled!

---

## Customization

### Disable for Specific Images

Add `no-lightbox` class:
```html
<img src="logo.jpg" class="no-lightbox" alt="Logo" />
```

### Enable on Featured Images

Uncomment in `/inc/lightbox.php`:
```php
// Line ~183
add_filter( 'post_thumbnail_html', 'dthree_add_lightbox_to_featured_image', 10, 3 );
```

### Custom Styling

Add to Customizer → Additional CSS:

```css
/* Change overlay darkness */
.dthree-lightbox {
    background: rgba(0, 0, 0, 0.98); /* Darker */
}

/* Change button colors */
.dthree-lightbox-close,
.dthree-lightbox-prev,
.dthree-lightbox-next {
    background: rgba(255, 100, 100, 0.3);
    border-color: rgba(255, 100, 100, 0.6);
}

/* Customize caption */
.dthree-lightbox-caption {
    background: linear-gradient(to top, rgba(0, 0, 100, 0.9), transparent);
    font-size: 18px;
}

/* Hide thumbnails */
.dthree-lightbox-thumbnails {
    display: none;
}

/* Hide zoom controls */
.dthree-lightbox-zoom {
    display: none;
}
```

---

## Controls

### Mouse/Touch
- **Click image** - Open lightbox
- **Click outside** - Close lightbox
- **Click arrows** - Navigate
- **Click X** - Close
- **Click thumbnail** - Jump to image
- **Drag (when zoomed)** - Pan image

### Keyboard
- **ESC** - Close lightbox
- **←** (Left Arrow) - Previous image
- **→** (Right Arrow) - Next image
- **+** or **=** - Zoom in
- **-** - Zoom out
- **0** - Reset zoom
- **Tab** - Navigate controls

### Zoom
- **+ button** - Zoom in (max 3x)
- **- button** - Zoom out
- **↺ button** - Reset zoom
- **Drag** - Pan when zoomed

---

## Advanced Usage

### Programmatic Control

```javascript
// Get lightbox instance
const lightbox = new DThreeLightbox();

// Open specific gallery
lightbox.open([
    {
        src: 'thumb1.jpg',
        full: 'full1.jpg',
        alt: 'Image 1',
        caption: 'First image'
    },
    {
        src: 'thumb2.jpg',
        full: 'full2.jpg',
        alt: 'Image 2',
        caption: 'Second image'
    }
], 0); // Start at index 0

// Close lightbox
lightbox.close();

// Navigate
lightbox.next();
lightbox.prev();
lightbox.showImage(2); // Go to specific index

// Zoom
lightbox.zoomIn();
lightbox.zoomOut();
lightbox.resetZoom();
```

### Custom Gallery

```html
<div class="my-custom-gallery">
    <img src="img1.jpg" data-lightbox="gallery" data-full-url="img1-full.jpg" />
    <img src="img2.jpg" data-lightbox="gallery" data-full-url="img2-full.jpg" />
    <img src="img3.jpg" data-lightbox="gallery" data-full-url="img3-full.jpg" />
</div>

<script>
// Lightbox automatically detects and groups them
</script>
```

### Dynamic Images

```javascript
// Add lightbox to dynamically loaded images
document.addEventListener('DOMContentLoaded', function() {
    // Your AJAX code here
    
    // After images load, reinitialize
    if (window.DThreeLightbox) {
        new DThreeLightbox();
    }
});
```

---

## Integration Examples

### With Image Slider

```php
<?php
// Image Slider automatically has lightbox enabled
// No additional code needed!
?>
```

### With ACF Gallery Field

```php
<?php
$images = get_field('gallery'); // ACF gallery field

if( $images ): ?>
    <div class="custom-gallery row">
        <?php foreach( $images as $image ): ?>
            <div class="col-md-4">
                <?php echo dthree_get_lightbox_image( 
                    $image['ID'], 
                    'medium'
                ); ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
```

### With WooCommerce Product Gallery

```php
// Add to child theme functions.php
add_filter( 'woocommerce_single_product_image_thumbnail_html', function( $html ) {
    // Add lightbox data attributes
    $html = str_replace( '<img', '<img data-lightbox="true"', $html );
    return $html;
});
```

### With Portfolio Grid

```html
<div class="portfolio-grid row">
    <div class="col-md-4">
        <img src="project1.jpg" 
             alt="Project 1"
             data-lightbox="true"
             data-full-url="project1-full.jpg"
             data-caption="Website Design for Client A" />
    </div>
    <div class="col-md-4">
        <img src="project2.jpg" 
             alt="Project 2"
             data-lightbox="true"
             data-full-url="project2-full.jpg"
             data-caption="Branding for Client B" />
    </div>
    <!-- More projects -->
</div>
```

---

## Styling Examples

### Minimalist Lightbox

```css
.dthree-lightbox {
    background: rgba(255, 255, 255, 0.95);
}

.dthree-lightbox-close,
.dthree-lightbox-prev,
.dthree-lightbox-next {
    background: transparent;
    border: 2px solid #000;
    color: #000;
}

.dthree-lightbox-caption {
    color: #000;
    background: transparent;
}
```

### Colorful Theme

```css
.dthree-lightbox {
    background: linear-gradient(135deg, rgba(142, 45, 226, 0.95), rgba(74, 0, 224, 0.95));
}

.dthree-lightbox-close,
.dthree-lightbox-prev,
.dthree-lightbox-next {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.8);
}

.dthree-lightbox-counter {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}
```

### Square Buttons

```css
.dthree-lightbox-close,
.dthree-lightbox-prev,
.dthree-lightbox-next,
.dthree-lightbox-zoom-btn {
    border-radius: 4px;
}
```

---

## Troubleshooting

### Lightbox Not Opening

**Check:**
1. JavaScript loaded? (View source, look for `lightbox.js`)
2. Images have `data-lightbox` attribute?
3. No JavaScript errors in console?
4. CSS loaded? (Look for `lightbox.css`)

**Fix:**
```html
<!-- Verify this attribute exists -->
<img src="image.jpg" data-lightbox="true" />
```

### Images Not Full Screen

**Issue:** Images using thumbnail instead of full size

**Fix:**
```html
<!-- Add data-full-url attribute -->
<img src="thumb.jpg" 
     data-lightbox="true"
     data-full-url="full-size.jpg" />
```

### Caption Not Showing

**Fix:**
```html
<!-- Add data-caption attribute -->
<img src="image.jpg" 
     data-lightbox="true"
     data-caption="Your caption text here" />
```

### Lightbox Opens But Image Missing

**Check:**
- Image URL is correct
- Image file exists on server
- No 404 errors in network tab

### Navigation Not Working

**Check:**
- Multiple images in gallery?
- All images have `data-lightbox` attribute?
- JavaScript errors in console?

### Zoom Not Working

**Check:**
- Zoom buttons visible?
- Image loaded successfully?
- Browser console for errors?

---

## Browser Support

| Browser | Version | Support |
|---------|---------|---------|
| Chrome | Latest 2 | ✅ Full |
| Firefox | Latest 2 | ✅ Full |
| Safari | Latest 2 | ✅ Full |
| Edge | Latest 2 | ✅ Full |
| iOS Safari | iOS 13+ | ✅ Full |
| Chrome Mobile | Latest | ✅ Full |

---

## Performance Tips

### Optimize Images

```
Thumbnails: 400x300px, 50-100KB
Full Size:  1920x1440px, 200-400KB
Format:     WebP (with JPG fallback)
```

### Lazy Load Lightbox

Lightbox JavaScript loads on page load but only initializes when first image is clicked.

### Limit Gallery Size

For best performance:
- Maximum 20 images per gallery
- Use pagination for larger galleries

---

## Accessibility Checklist

- ✅ Keyboard navigation
- ✅ Focus trap (locks focus in lightbox when open)
- ✅ ARIA labels on all controls
- ✅ Screen reader announcements
- ✅ Focus restoration (returns to trigger element)
- ✅ Reduced motion support
- ✅ Color contrast (WCAG AA)
- ✅ Clear close button

---

## API Reference

### HTML Attributes

```html
data-lightbox="true"          <!-- Enable lightbox -->
data-full-url="image.jpg"     <!-- Full-size image URL -->
data-caption="Text"           <!-- Caption text -->
```

### PHP Functions

```php
// Add lightbox to image by ID
dthree_get_lightbox_image( $attachment_id, $size, $attr );

// Enable on featured images (in inc/lightbox.php)
add_filter( 'post_thumbnail_html', 'dthree_add_lightbox_to_featured_image', 10, 3 );
```

### JavaScript Class

```javascript
const lightbox = new DThreeLightbox();

// Methods
lightbox.open(images, index);    // Open with image array
lightbox.close();                // Close lightbox
lightbox.next();                 // Next image
lightbox.prev();                 // Previous image
lightbox.showImage(index);       // Go to specific image
lightbox.zoomIn();               // Zoom in
lightbox.zoomOut();              // Zoom out
lightbox.resetZoom();            // Reset zoom to 1x
```

---

## Shortcode Reference

### Single Image
```
[lightbox src="image.jpg" thumb="thumb.jpg" caption="Caption" alt="Alt text" class="custom-class"]
```

### Gallery
```
[lightbox_gallery ids="1,2,3,4,5" columns="3" size="medium"]
```

---

## Examples Collection

See `LIGHTBOX-EXAMPLES.md` for more examples including:
- Photography portfolio
- Product showcases
- Before/after comparisons
- Case study galleries
- Testimonial photos
- Team member profiles
- And more!

---

## Version & License

**Version:** 1.1.0  
**License:** GPL-2.0+  
**Compatibility:** WordPress 6.0+, PHP 7.4+  

---

## Support

- 📖 Full documentation: This file
- 💡 Examples: LIGHTBOX-EXAMPLES.md
- 🐛 Report issues: Theme repository
- 💬 Support: WordPress forums

# Slider Components Guide

## Overview

DThree Gutenberg includes 5 professional slider/carousel components built with Bootstrap 5's carousel functionality. Each slider is optimized for different use cases and comes with extensive customization options.

## Available Slider Components

### 1. Image Slider
**Block Name:** `dthree/image-slider`  
**Icon:** Images  
**Best For:** Image galleries, photo showcases, product displays

**Features:**
- Add multiple images with captions
- Slide or fade transition effects
- Autoplay with customizable interval
- Optional navigation controls
- Optional indicator dots
- Adjustable height
- Responsive image scaling

**Attributes:**
```php
images          // Array of image objects (url, alt, caption)
autoplay        // Boolean - auto-advance slides
interval        // Number - milliseconds between slides (default: 5000)
showControls    // Boolean - show prev/next arrows
showIndicators  // Boolean - show dot indicators
transitionEffect // String - 'slide' or 'fade'
height          // Number - slider height in pixels (default: 500)
```

**Usage:**
1. Add Image Slider block to your page
2. Upload images or select from media library
3. Add captions for each image (optional)
4. Configure autoplay and transition settings
5. Adjust height to match your design

---

### 2. Content Slider
**Block Name:** `dthree/content-slider`  
**Icon:** Slides  
**Best For:** Hero sections, feature highlights, marketing banners

**Features:**
- Full-width content slides with images and text
- Call-to-action buttons on each slide
- Background image with overlay control
- Text alignment options (left, center, right)
- Fade transition effect
- Responsive typography
- AOS animation support

**Attributes:**
```php
slides           // Array of slide objects (title, description, buttonText, buttonUrl, imageUrl, imageId)
autoplay         // Boolean - auto-advance slides
interval         // Number - milliseconds between slides (default: 7000)
height           // Number - slider height in pixels (default: 600)
overlayOpacity   // Number - background overlay darkness 0-100 (default: 50)
textAlignment    // String - 'left', 'center', 'right'
```

**Usage:**
1. Add Content Slider block
2. Configure slides with titles, descriptions, and CTAs
3. Upload background images for each slide
4. Adjust overlay opacity for text readability
5. Set text alignment preference

**Default Slide Structure:**
```php
array(
    'title'       => 'Slide Title',
    'description' => 'Slide description text',
    'buttonText'  => 'Learn More',
    'buttonUrl'   => '#',
    'imageUrl'    => '',
    'imageId'     => 0,
)
```

---

### 3. Logo Slider
**Block Name:** `dthree/logo-slider`  
**Icon:** Images Alt  
**Best For:** Client logos, partner brands, certifications, awards

**Features:**
- Multiple logos per slide
- Grayscale effect with color on hover
- Configurable items per slide (2-6 logos)
- Optional logo linking
- Autoplay functionality
- Responsive grid layout

**Attributes:**
```php
sectionTitle // String - heading above slider
logos        // Array of logo objects (url, alt, link)
autoplay     // Boolean - auto-advance slides
interval     // Number - milliseconds between slides (default: 3000)
itemsToShow  // Number - logos per slide (default: 5)
grayscale    // Boolean - apply grayscale filter
```

**Usage:**
1. Add Logo Slider block
2. Set section title (e.g., "Our Clients")
3. Upload logos (recommended: SVG or PNG with transparent background)
4. Optionally add links to each logo
5. Choose how many logos to display per slide
6. Enable grayscale for professional look

**Logo Object Structure:**
```php
array(
    'url'  => 'https://example.com/logo.png',
    'alt'  => 'Company Name',
    'link' => 'https://company.com', // Optional
)
```

---

### 4. Card Slider
**Block Name:** `dthree/card-slider`  
**Icon:** Screen Options  
**Best For:** Products, services, portfolio items, blog posts

**Features:**
- Horizontal scrolling card layout
- Image, title, description, and CTA per card
- Configurable cards per view (1-4)
- Optional autoplay
- Card hover effects
- Responsive columns
- Bottom-aligned navigation buttons

**Attributes:**
```php
sectionTitle    // String - main heading
sectionSubtitle // String - optional subtitle
cards           // Array of card objects
cardsPerView    // Number - cards shown per slide (1-4, default: 3)
autoplay        // Boolean - auto-advance slides
```

**Usage:**
1. Add Card Slider block
2. Set section title and subtitle
3. Add cards with images, titles, descriptions, and CTAs
4. Choose cards per view (1-4)
5. Configure autoplay if desired

**Card Object Structure:**
```php
array(
    'title'       => 'Card Title',
    'description' => 'Card description text',
    'imageUrl'    => '',
    'buttonText'  => 'Learn More',
    'buttonUrl'   => '#',
)
```

**Responsive Breakpoints:**
- 1 card: Full width on all devices
- 2 cards: 1 on mobile, 2 on desktop
- 3 cards: 1 on mobile, 2 on tablet, 3 on desktop
- 4 cards: 1 on mobile, 2 on small tablet, 3 on tablet, 4 on desktop

---

### 5. Testimonial Slider
**Block Name:** `dthree/testimonial-slider`  
**Icon:** Format Quote  
**Best For:** Customer reviews, testimonials, social proof

**Features:**
- Three display styles: Centered, Cards, Minimal
- Star rating system (1-5 stars)
- Author photo, name, and role
- Fade transition effect
- Quote formatting
- Dot indicators at bottom

**Attributes:**
```php
sectionTitle   // String - heading above testimonials
testimonials   // Array of testimonial objects
autoplay       // Boolean - auto-advance slides
interval       // Number - milliseconds between slides (default: 6000)
showRating     // Boolean - display star ratings
style          // String - 'centered', 'cards', 'minimal'
```

**Usage:**
1. Add Testimonial Slider block
2. Set section title
3. Add testimonials with content, name, role, and photo
4. Choose display style
5. Toggle star ratings on/off
6. Configure autoplay settings

**Testimonial Object Structure:**
```php
array(
    'name'     => 'Customer Name',
    'role'     => 'Position, Company',
    'content'  => 'Testimonial text goes here...',
    'imageUrl' => '',
    'rating'   => 5, // 1-5 stars
)
```

**Display Styles:**

**Centered** (Default)
- Large centered text
- Circular author photo above name
- Perfect for landing pages
- Min height: 400px

**Cards**
- Card-based layout with shadow
- Horizontal author info
- Great for multiple short reviews
- More compact design

**Minimal**
- Clean, simple text-only style
- Author name inline with role
- Best for elegant, minimalist designs
- Transparent background

---

## Global Slider Features

### Accessibility
- ARIA labels on all navigation elements
- Keyboard navigation support
- Screen reader announcements
- Focus indicators on controls

### Performance
- Lazy loading images (browser native)
- CSS-based transitions
- Hardware-accelerated animations
- Optimized rendering

### Responsive Design
- Mobile-first approach
- Touch/swipe support (Bootstrap 5 built-in)
- Breakpoint-specific layouts
- Scaled typography and spacing

---

## Customization

### CSS Classes

Each slider has specific class names for styling:

```css
/* Image Slider */
.dthree-image-slider
.dthree-image-slider .carousel-caption
.dthree-image-slider .carousel-indicators button

/* Content Slider */
.dthree-content-slider
.dthree-content-slider .carousel-item
.dthree-content-slider .carousel-caption

/* Logo Slider */
.dthree-logo-slider-section
.dthree-logo-slider .logo-item
.dthree-logo-slider .logo-image
.dthree-logo-slider.logo-grayscale

/* Card Slider */
.dthree-card-slider-section
.dthree-slider-card
.dthree-slider-card:hover

/* Testimonial Slider */
.dthree-testimonial-slider-section
.testimonial-style-centered
.testimonial-style-cards
.testimonial-style-minimal
.testimonial-rating
.testimonial-content
.testimonial-author
```

### Custom Styling Example

Add to your child theme or Custom CSS:

```css
/* Make image slider rounded corners more prominent */
.dthree-image-slider {
    border-radius: 16px;
}

/* Change content slider overlay color */
.dthree-content-slider .carousel-item-overlay {
    background: rgba(0, 100, 200, 0.7) !important;
}

/* Customize logo slider background */
.dthree-logo-slider-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Add shadow to cards */
.dthree-slider-card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Style testimonial ratings */
.testimonial-rating i {
    font-size: 1.5rem;
    color: #ffc107;
}
```

---

## JavaScript Control

### Manual Control via JavaScript

```javascript
// Get carousel element
const carousel = document.querySelector('#dthree-carousel-1234');

// Create Bootstrap carousel instance
const bsCarousel = new bootstrap.Carousel(carousel, {
    interval: 3000,
    wrap: true,
    keyboard: true
});

// Manual controls
bsCarousel.next();      // Go to next slide
bsCarousel.prev();      // Go to previous slide
bsCarousel.to(2);       // Go to specific slide (0-indexed)
bsCarousel.pause();     // Pause autoplay
bsCarousel.cycle();     // Resume autoplay
```

### Events

```javascript
const carousel = document.querySelector('#dthree-carousel-1234');

// Before slide changes
carousel.addEventListener('slide.bs.carousel', function (event) {
    console.log('Sliding from', event.from, 'to', event.to);
});

// After slide changes
carousel.addEventListener('slid.bs.carousel', function (event) {
    console.log('Now on slide', event.to);
});
```

---

## Best Practices

### Image Slider
- Use consistent image dimensions
- Optimize images (compress before upload)
- Recommended size: 1920x1080px for full-width
- Use JPG for photos, PNG for graphics

### Content Slider
- Limit to 3-5 slides for best UX
- Keep text concise (headline + 1-2 sentences)
- Use high-contrast text over images
- Test on mobile devices

### Logo Slider
- Use SVG logos when possible
- Keep logos similar in size/aspect ratio
- Use transparent backgrounds
- Maximum 6 logos per slide

### Card Slider
- Maintain consistent card heights
- Use square images (1:1 ratio)
- Keep descriptions similar length
- Test different cards-per-view options

### Testimonial Slider
- Limit testimonials to 3-5 per slider
- Keep quotes under 200 characters
- Use real customer photos
- Include full name and company/role

---

## Troubleshooting

### Slider Not Auto-Playing
- Check that `autoplay` attribute is `true`
- Ensure `interval` is set (milliseconds)
- Verify Bootstrap JS is loaded
- Check browser console for errors

### Images Not Displaying
- Verify image URLs are correct
- Check file permissions
- Ensure images are uploaded to media library
- Look for 404 errors in network tab

### Controls Not Working
- Confirm Bootstrap bundle.js is enqueued
- Check for JavaScript conflicts
- Verify carousel ID is unique
- Test in different browsers

### Responsive Issues
- Test on actual devices, not just browser resize
- Check CSS for conflicting styles
- Verify viewport meta tag is present
- Use browser developer tools

---

## Advanced Features

### Programmatic Block Registration

All sliders can be extended or modified in child themes:

```php
// Modify image slider attributes
add_filter('dthree_image_slider_attributes', function($attributes) {
    $attributes['maxImages'] = array(
        'type' => 'number',
        'default' => 10,
    );
    return $attributes;
});

// Change default interval
add_filter('dthree_slider_default_interval', function($interval, $slider_type) {
    if ($slider_type === 'testimonial') {
        return 8000; // 8 seconds
    }
    return $interval;
}, 10, 2);
```

### Custom Render Callbacks

Create custom slider variations:

```php
// Register custom slider variant
function my_custom_slider_block() {
    register_block_type('mytheme/custom-slider', array(
        'render_callback' => 'my_custom_slider_render',
        // ... other properties
    ));
}
add_action('init', 'my_custom_slider_block');
```

---

## Browser Support

All sliders support:
- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

Legacy browser support requires Bootstrap 5 polyfills.

---

## Performance Tips

1. **Lazy Load Images**: Enable browser lazy loading
2. **Limit Slides**: Keep total slides under 10
3. **Optimize Images**: Use appropriate file formats and compression
4. **Preload First Slide**: Load first slide image in `<head>`
5. **Debounce Events**: If adding custom event listeners
6. **Use CDN**: For external images when possible

---

## Accessibility Checklist

- ✅ Keyboard navigation (arrow keys, tab)
- ✅ Screen reader announcements
- ✅ ARIA labels on controls
- ✅ Pause button or hover-to-pause
- ✅ Sufficient color contrast
- ✅ Alternative text on images
- ✅ Focus indicators visible

---

## Support & Resources

- **Bootstrap 5 Carousel Documentation**: https://getbootstrap.com/docs/5.3/components/carousel/
- **WordPress Block API**: https://developer.wordpress.org/block-editor/
- **Theme Documentation**: See README.md
- **Issues**: Report bugs in theme repository

---

## Version History

**v1.0.0** - Initial release
- Image Slider
- Content Slider
- Logo Slider
- Card Slider
- Testimonial Slider

---

## License

All slider components are part of DThree Gutenberg theme and follow the same GPL-2.0+ license.

# DThree Gutenberg WordPress Theme

A modern, highly customizable WordPress theme built on Gutenberg with reusable blocks, Bootstrap 5, and best practices for UI/UX, security, and SEO.

## Features

### Custom Gutenberg Blocks
- **Hero Section**: Full-width hero banners with background images, overlays, and call-to-action buttons
- **Features Section**: Showcase services or features in a responsive grid layout with icons
- **Call-to-Action**: Compelling CTA sections with customizable buttons
- **Team Members**: Display team members with photos, bios, and social links
- **Testimonials**: Customer reviews with ratings and photos
- **Contact Form**: Secure contact form with spam protection and validation

### Slider Components (NEW!)
- **Image Slider**: Photo galleries and image showcases with captions
- **Content Slider**: Hero banners with text, images, and CTAs
- **Logo Slider**: Client/partner logo carousels with grayscale effects
- **Card Slider**: Horizontal scrolling cards for products/services
- **Testimonial Slider**: Rotating customer reviews with star ratings

📖 **[View Slider Documentation](SLIDER-COMPONENTS.md)** | 🚀 **[Quick Reference](SLIDER-QUICK-REFERENCE.md)**

### Lightbox (NEW!)
- **Full-screen Image Viewer**: Modern, accessible lightbox for all images
- **Gallery Navigation**: Browse through image collections with ease
- **Zoom & Pan**: Up to 3x zoom with drag-to-pan functionality
- **Auto-Detection**: Works automatically with galleries, sliders, and content images
- **Keyboard Controls**: Full keyboard and screen reader support

📖 **[View Lightbox Documentation](LIGHTBOX.md)** | 🚀 **[Quick Reference](LIGHTBOX-QUICK-REFERENCE.md)**

### UI Components (NEW!)
- **Tabs**: Organize content in tabbed sections with 3 visual styles
- **Accordion**: Collapsible content sections for FAQs and expandable content
- **Pricing Tables**: Showcase pricing plans with featured highlighting and ribbons
- **Progress Bars**: Display skills, stats, or progress with animated bars
- **Timeline**: Show chronological events in vertical, horizontal, or alternating layouts
- **Modal**: Popup windows for forms, videos, and announcements
- **Video Player**: Embed YouTube, Vimeo, or self-hosted videos
- **Alerts**: Contextual feedback messages in 8 color variants
- **Icon Boxes**: Feature grids with icons and descriptions
- **Social Share**: Share buttons for 8+ social platforms

📖 **[View Components Documentation](COMPONENTS.md)** | 🚀 **[Quick Reference](COMPONENTS-QUICK-REFERENCE.md)**

### Design & UI/UX
- Built with Bootstrap 5 for responsive, mobile-first design
- Customizable through theme.json and WordPress Customizer
- Smooth scroll animations with AOS library support
- Accessible design with ARIA labels and keyboard navigation
- High contrast mode and reduced motion support
- Custom scrollbar styling

### Security Features
- Input sanitization and validation
- Nonce verification for forms and AJAX requests
- XSS and CSRF protection
- Rate limiting for login attempts
- Security headers (X-Frame-Options, X-Content-Type-Options, etc.)
- Honeypot spam protection for forms

### SEO Optimized
- Schema.org structured data markup
- Open Graph and Twitter Card meta tags
- Semantic HTML5 markup
- Optimized meta descriptions
- Clean, semantic URLs
- Fast loading times

### Performance
- Minimal dependencies (Bootstrap and vanilla JavaScript only)
- Lazy loading support for images
- Optimized asset loading
- Browser caching support
- No jQuery dependency

## Installation

1. Download the theme files
2. Upload to `/wp-content/themes/dthree-gutenberg/`
3. Activate the theme through WordPress admin
4. Customize through **Appearance > Customize**

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher

## Customization

### Theme Options
Access customization options through **Appearance > Customize**:
- Header settings (sticky header)
- Footer copyright text
- Social media links
- Layout settings (container width)
- Typography (base font size)
- Performance (animations toggle)
- SEO settings

### Custom Blocks
All custom blocks can be found in the Gutenberg editor under the "DThree Blocks" category:
1. Add a new block (+)
2. Browse to "DThree Blocks"
3. Select your desired block
4. Customize using the block settings panel

### Widget Areas
- Sidebar
- Footer 1
- Footer 2
- Footer 3

### Navigation Menus
- Primary Menu (Header)
- Footer Menu

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## License

This theme is licensed under the GNU General Public License v2 or later.

## Credits

- Bootstrap 5: https://getbootstrap.com/
- Bootstrap Icons: https://icons.getbootstrap.com/
- WordPress: https://wordpress.org/

## Changelog

### 1.1.0
- Added 5 professional slider components
- Image Slider with captions and transitions
- Content Slider for hero sections
- Logo Slider with grayscale effects
- Card Slider for horizontal content
- Testimonial Slider with multiple styles
- Added modern lightbox implementation
- Full-screen image viewing with zoom
- Gallery navigation and thumbnails
- Auto-detection for galleries and sliders
- Comprehensive documentation for sliders and lightbox

### 1.0.0
- Initial release
- Custom Gutenberg blocks (Hero, Features, CTA, Team, Testimonials, Contact)
- Bootstrap 5 integration
- Customizer options
- Security features
- SEO optimization
- Accessibility improvements
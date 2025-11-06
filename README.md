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

### 1.0.0
- Initial release
- Custom Gutenberg blocks (Hero, Features, CTA, Team, Testimonials, Contact)
- Bootstrap 5 integration
- Customizer options
- Security features
- SEO optimization
- Accessibility improvements
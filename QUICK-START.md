# DThree Gutenberg Theme - Quick Start Guide

## Installation

1. **Upload the theme**
   - Download or clone this repository
   - Upload the entire `dthree-gutenberg` folder to `/wp-content/themes/`
   - Or upload as a ZIP file through **Appearance > Themes > Add New > Upload Theme**

2. **Activate the theme**
   - Go to **Appearance > Themes**
   - Find "DThree Gutenberg" and click **Activate**

## Initial Setup

### 1. Configure Basic Settings

Navigate to **Appearance > Customize**:

- **Site Identity**: Set your site title, tagline, and upload a logo
- **Colors**: Customize the color scheme (uses Bootstrap colors by default)
- **Header Settings**: Enable/disable sticky header
- **Footer Settings**: Customize copyright text
- **Social Media Links**: Add your social media URLs

### 2. Create Navigation Menus

1. Go to **Appearance > Menus**
2. Create a menu for the header:
   - Name it "Primary Menu"
   - Assign to "Primary Menu" location
3. Create a menu for the footer:
   - Name it "Footer Menu"
   - Assign to "Footer Menu" location

### 3. Configure Widgets

Go to **Appearance > Widgets** and add widgets to:
- **Sidebar**: Displays on blog posts and archives
- **Footer 1, 2, 3**: Three columns in the footer

## Using Custom Blocks

### Adding Blocks to Pages

1. Create or edit a page/post
2. Click the **+** button to add a block
3. Find **DThree Blocks** category
4. Choose from 6 custom blocks:
   - Hero Section
   - Features
   - Call to Action
   - Team Members
   - Testimonials
   - Contact Form

### Block Configuration Examples

#### Hero Section
Perfect for landing pages:
```
- Title: "Welcome to Our Website"
- Subtitle: "We create amazing experiences"
- Description: "Discover our services..."
- Button Text: "Get Started"
- Button URL: Link to your service page
- Background Image: Upload a high-quality image (1920x1080px recommended)
- Overlay Opacity: 50% (adjust for readability)
```

#### Features Section
Showcase your services:
```
- Section Title: "Our Services"
- Section Subtitle: "What we offer"
- Add features with icons (use Bootstrap Icons):
  - Icon: bi-lightning-charge
  - Title: "Fast Performance"
  - Description: "Lightning-fast load times..."
- Columns: 3 (for 3 features per row)
```

#### Team Members
Introduce your team:
```
- Add team members:
  - Name, role, bio
  - Upload photo (square images work best)
  - Add social links (Twitter, LinkedIn, Email)
- Columns: 3 or 4 work best
```

#### Contact Form
The contact form automatically:
- Validates all fields
- Sends email to admin email (or custom recipient)
- Has spam protection built-in
- Shows success/error messages

## Recommended Page Structure

### Homepage
1. Hero Section (full width)
2. Features Section
3. Team Members Section
4. Testimonials Section
5. Call to Action Section

### About Page
1. Hero Section (with about image)
2. Content blocks (paragraphs, images)
3. Team Members Section

### Contact Page
1. Hero Section (small)
2. Contact Form Block

## Customization Tips

### Using Bootstrap Icons

In the Features and Team blocks, you can use any Bootstrap Icon:
- Visit: https://icons.getbootstrap.com/
- Find an icon you like
- Copy the class name (e.g., `bi-heart-fill`)
- Paste it in the icon field

### Color Customization

The theme uses Bootstrap 5 colors:
- Primary: Blue (#0d6efd)
- Secondary: Gray (#6c757d)
- Success: Green (#198754)
- Danger: Red (#dc3545)
- Warning: Yellow (#ffc107)
- Info: Cyan (#0dcaf0)

Customize these in `theme.json` or through the customizer.

### Responsive Design

All blocks are fully responsive:
- Desktop: Full features
- Tablet: Adjusted layouts
- Mobile: Stacked layout for better readability

## Best Practices

### Images
- Hero images: 1920x1080px
- Featured images: 800x600px
- Team member photos: 400x400px (square)
- Compress images before uploading

### Content
- Use clear, concise headings
- Keep paragraphs short (2-4 sentences)
- Add alt text to all images
- Use relevant keywords naturally

### SEO
The theme automatically adds:
- Meta descriptions (from post excerpt)
- Open Graph tags
- Schema.org markup
- Optimized HTML structure

### Performance
- Use a caching plugin (WP Super Cache or W3 Total Cache)
- Optimize images with a plugin (Smush or ShortPixel)
- Use a CDN for better global performance

## Troubleshooting

### Blocks Not Showing
1. Clear your browser cache
2. Clear WordPress cache (if using a caching plugin)
3. Make sure theme is activated
4. Check PHP version (7.4+ required)

### Contact Form Not Sending
1. Check your server can send emails
2. Install WP Mail SMTP plugin for better email delivery
3. Check spam folder
4. Verify recipient email in block settings

### Styling Issues
1. Clear all caches
2. Check for plugin conflicts (deactivate plugins one by one)
3. Ensure no other theme files are interfering

## Support

For issues or questions:
- Check the README.md file
- Review WordPress documentation
- Check theme code comments for details

## Next Steps

1. ✅ Install and activate the theme
2. ✅ Configure basic settings
3. ✅ Create navigation menus
4. ✅ Build your homepage with custom blocks
5. ✅ Add content to other pages
6. ✅ Configure SEO settings
7. ✅ Test on mobile devices
8. ✅ Launch your site!

Enjoy your new WordPress theme! 🎉

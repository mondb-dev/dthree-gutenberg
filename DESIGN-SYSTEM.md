# DThree Design System

A comprehensive design system for WordPress themes that provides a unified visual language, consistent components, and smooth micro-interactions for creating beautiful, optimized websites.

## 🌟 Features

### Core Components
- **Typography System**: Consistent font scales, line heights, and font families
- **Color Palette**: Brand colors with automatic variations and accessibility support
- **Spacing Scale**: Harmonious spacing system for layouts and components
- **Button Variations**: 4 distinct button styles (Primary, Secondary, Outline, Ghost)
- **Interactive Components**: Cards, forms, navigation, images with hover states
- **Utility Classes**: Comprehensive set of CSS utilities for rapid development

### Micro-interactions
- **Purposeful Animations**: Smooth, performance-optimized transitions
- **Hover Effects**: Lift, scale, rotate, and custom transform effects
- **Button Interactions**: Ripple effects, focus states, and loading animations
- **Form Enhancements**: Input focus animations, floating labels, typing indicators
- **Scroll Animations**: Reveal animations, parallax effects, smooth scrolling

### Admin Interface
- **Visual Editor**: Intuitive interface for customizing all design system components
- **Live Preview**: Real-time preview of changes before applying
- **Export/Import**: Save and share design system configurations
- **Asset Building**: Generate optimized CSS, JavaScript, and HTML templates

## 🚀 Getting Started

### Accessing the Design System

1. **Navigate to WordPress Admin**
   - Go to `Appearance > Design System`
   - The interface provides tabs for different configuration areas

2. **Configuration Tabs**
   - **Colors**: Define your brand color palette
   - **Typography**: Set font families, sizes, and line heights
   - **Spacing**: Configure spacing scale and layout properties
   - **Components**: Customize button styles and component variations
   - **Micro-interactions**: Set animation durations, easing, and hover effects

### Basic Usage

#### Using CSS Variables
All design system values are available as CSS custom properties:

```css
.my-component {
    color: var(--dthree-color-primary);
    padding: var(--dthree-space-md);
    border-radius: var(--dthree-radius-lg);
    font-size: var(--dthree-font-size-lg);
}
```

#### Using Utility Classes
Apply design system styles directly with utility classes:

```html
<!-- Spacing -->
<div class="dthree-p-lg dthree-mb-xl">Content with padding and margin</div>

<!-- Colors -->
<p class="dthree-color-primary dthree-bg-light">Colored text on light background</p>

<!-- Animations -->
<div class="dthree-hover-lift dthree-animate">Hover to lift</div>
```

#### Button Components
Multiple button styles are available:

```html
<button class="dthree-btn-primary">Primary Button</button>
<button class="dthree-btn-secondary">Secondary Button</button>
<button class="dthree-btn-outline">Outline Button</button>
<button class="dthree-btn-ghost">Ghost Button</button>

<!-- With sizes -->
<button class="dthree-btn-primary btn-sm">Small Button</button>
<button class="dthree-btn-primary btn-lg">Large Button</button>
```

#### Card Components
Create consistent card layouts:

```html
<div class="dthree-card">
    <div class="dthree-card-header">
        <h3 class="dthree-card-title">Card Title</h3>
    </div>
    <div class="dthree-card-body">
        <p>Card content goes here...</p>
    </div>
</div>
```

## 🎨 Design Tokens

### Color System
```css
/* Primary brand colors */
--dthree-color-primary: #0d6efd;
--dthree-color-secondary: #6c757d;
--dthree-color-success: #198754;
--dthree-color-danger: #dc3545;
--dthree-color-warning: #ffc107;
--dthree-color-info: #0dcaf0;

/* Neutral colors */
--dthree-color-light: #f8f9fa;
--dthree-color-dark: #212529;
--dthree-color-white: #ffffff;
--dthree-color-black: #000000;
```

### Typography Scale
```css
/* Font sizes */
--dthree-font-size-xs: 0.75rem;    /* 12px */
--dthree-font-size-sm: 0.875rem;   /* 14px */
--dthree-font-size-base: 1rem;     /* 16px */
--dthree-font-size-lg: 1.125rem;   /* 18px */
--dthree-font-size-xl: 1.25rem;    /* 20px */
--dthree-font-size-2xl: 1.5rem;    /* 24px */
--dthree-font-size-3xl: 1.875rem;  /* 30px */
--dthree-font-size-4xl: 2.25rem;   /* 36px */
--dthree-font-size-5xl: 3rem;      /* 48px */
--dthree-font-size-6xl: 3.75rem;   /* 60px */
```

### Spacing Scale
```css
/* Spacing scale */
--dthree-space-xs: 0.25rem;   /* 4px */
--dthree-space-sm: 0.5rem;    /* 8px */
--dthree-space-md: 1rem;      /* 16px */
--dthree-space-lg: 1.5rem;    /* 24px */
--dthree-space-xl: 2rem;      /* 32px */
--dthree-space-2xl: 3rem;     /* 48px */
--dthree-space-3xl: 4rem;     /* 64px */
--dthree-space-4xl: 6rem;     /* 96px */
--dthree-space-5xl: 8rem;     /* 128px */
```

## ⚡ Micro-interactions

### Animation Settings
```css
/* Duration */
--dthree-duration-fast: 0.15s;
--dthree-duration-normal: 0.3s;
--dthree-duration-slow: 0.5s;

/* Easing */
--dthree-easing-smooth: cubic-bezier(0.4, 0, 0.2, 1);
--dthree-easing-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
```

### Available Animations
- **Hover Effects**: `dthree-hover-lift`, `dthree-hover-scale`, `dthree-hover-rotate`
- **Scroll Animations**: `fade-in-up`, `slide-in`, `animate-on-scroll`
- **Button Effects**: Automatic ripple effects, focus states
- **Form Interactions**: Input focus animations, floating labels
- **Navigation**: Smooth scrolling, menu hover effects

## 🛠️ Building Assets

### Automatic Building
When you make changes in the Design System admin:

1. **Click "Build Assets"** - Generates optimized CSS and JavaScript
2. **Assets are created in**:
   - `/assets/css/generated/design-system.css`
   - `/assets/js/micro-interactions.js`
3. **Files are automatically enqueued** on the frontend

### Manual Integration
If you need to manually integrate the design system:

```php
// Enqueue design system assets
wp_enqueue_style('dthree-design-system', 
    get_template_directory_uri() . '/assets/css/generated/design-system.css'
);

wp_enqueue_script('dthree-micro-interactions',
    get_template_directory_uri() . '/assets/js/micro-interactions.js',
    array('jquery')
);
```

## 📱 Responsive Design

The design system uses a mobile-first approach with comprehensive responsive utilities:

### Breakpoints
- **Small (sm)**: `480px+` - Landscape phones
- **Medium (md)**: `768px+` - Tablets
- **Large (lg)**: `1024px+` - Desktops
- **Extra Large (xl)**: `1200px+` - Large desktops

### Responsive Grid System
```html
<!-- Responsive columns -->
<div class="dthree-container">
    <div class="dthree-row">
        <div class="dthree-col-12 dthree-col-md-6 dthree-col-lg-4">
            Full width on mobile, half on tablet, third on desktop
        </div>
        <div class="dthree-col-12 dthree-col-md-6 dthree-col-lg-8">
            Full width on mobile, half on tablet, two-thirds on desktop
        </div>
    </div>
</div>
```

### Container Sizes
```html
<!-- Fluid container (full width) -->
<div class="dthree-container-fluid">...</div>

<!-- Fixed width container (responsive max-widths) -->
<div class="dthree-container">...</div>

<!-- Small container -->
<div class="dthree-container-sm">...</div>
```

### Responsive Utilities
```html
<!-- Display utilities -->
<div class="dthree-d-none dthree-d-md-block">Hidden on mobile, visible on tablet+</div>
<div class="dthree-d-block dthree-d-lg-none">Visible on mobile/tablet, hidden on desktop</div>

<!-- Text alignment -->
<p class="dthree-text-center dthree-text-md-left">Centered on mobile, left-aligned on tablet+</p>

<!-- Responsive spacing -->
<div class="dthree-p-2 dthree-p-md-4 dthree-p-lg-6">Responsive padding</div>
<div class="dthree-mb-3 dthree-mb-lg-5">Responsive bottom margin</div>

<!-- Responsive typography -->
<h1 class="dthree-text-2xl dthree-text-lg-4xl">Scales from 2xl to 4xl</h1>
```

### Responsive Typography
Typography automatically scales based on screen size:
```css
/* Font sizes adjust based on breakpoints */
h1 { font-size: clamp(2rem, 4vw, 3rem); }
h2 { font-size: clamp(1.5rem, 3vw, 2.25rem); }
```

### Admin Configuration
Configure responsive settings in the **Responsive** tab:
- **Breakpoint Values**: Customize breakpoint pixels
- **Container Sizes**: Set max-width for each container type
- **Typography Scaling**: Adjust font size scaling per breakpoint
- **Device Preview**: Test responsive behavior in admin

## 🌙 Dark Mode Support

The design system includes automatic dark mode support:

```css
@media (prefers-color-scheme: dark) {
    .dthree-auto-dark {
        --dthree-color-white: #1a1a1a;
        --dthree-color-light: #2a2a2a;
        --dthree-color-dark: #f8f9fa;
    }
}
```

Add the `dthree-auto-dark` class to enable automatic dark mode switching.

## 🔧 Customization

### Adding Custom Components
Extend the design system by creating new components:

```css
.my-custom-component {
    background: var(--dthree-color-primary);
    padding: var(--dthree-space-lg);
    border-radius: var(--dthree-radius-md);
    transition: all var(--dthree-duration-normal) var(--dthree-easing-smooth);
}

.my-custom-component:hover {
    transform: var(--dthree-hover-lift);
    box-shadow: var(--dthree-shadow-lg);
}
```

### Creating Custom Animations
Add your own micro-interactions:

```javascript
// Use the exposed micro-interactions API
DThreeMicroInteractions.reinitialize();

// Access animation settings
const { durations, easing } = DThreeMicroInteractions.settings;
```

## 📦 Export & Import

### Exporting Your Design System
1. Go to `Appearance > Design System`
2. Click "Export Design System"
3. Save the JSON file for backup or sharing

### Importing a Design System
1. Click "Import Design System"
2. Select your JSON file
3. Click "Import" to apply the settings
4. Click "Build Assets" to generate new files

## 🎯 Best Practices

### Performance
- **Use CSS Custom Properties**: Leverage browser optimization
- **Minimize Animations**: Only animate transform and opacity when possible
- **Leverage Hardware Acceleration**: Use `transform3d()` for smooth animations

### Accessibility
- **Focus States**: All interactive elements have proper focus indicators
- **Color Contrast**: Built-in color system ensures WCAG compliance
- **Reduced Motion**: Respects `prefers-reduced-motion` user preference
- **Semantic HTML**: Components encourage proper markup structure

### Development
- **Consistent Naming**: Use BEM-like naming with `dthree-` prefix
- **Mobile First**: Design system is mobile-first responsive
- **Progressive Enhancement**: Core functionality works without JavaScript

## 🐛 Troubleshooting

### Common Issues

**Assets Not Loading**
- Check that "Build Assets" was clicked after changes
- Verify file permissions in `/assets/` directory
- Clear any caching plugins

**Animations Not Working**
- Ensure jQuery is loaded
- Check browser console for JavaScript errors
- Verify micro-interactions.js is enqueued

**Styles Not Applying**
- Check CSS specificity conflicts
- Ensure design-system.css loads after other stylesheets
- Verify custom properties are supported (IE11 needs polyfill)

## 🚀 Advanced Usage

### JavaScript API
Access design system functionality programmatically:

```javascript
// Build assets programmatically
DThreeDesignSystemAdmin.buildAssets();

// Show notifications
DThreeDesignSystemAdmin.showNotification('Success!', 'success');

// Reinitialize micro-interactions
DThreeMicroInteractions.reinitialize();
```

### PHP API
Use the design system in PHP:

```php
// Get design system instance
$design_system = DThree_Design_System::get_instance();

// Get current settings
$settings = $design_system->get_settings();

// Save new settings
$design_system->save_settings($new_settings);

// Build assets
$design_system->build_assets();
```

## 📐 Section Layouts

Create flexible page layouts with different container types and section styles.

### Container Types

Configure section containers in **Appearance → Design System → Section Layouts**:

```html
<!-- Full Width Section -->
<section class="dthree-section-full-width">
    <div class="content">Content spans entire viewport width</div>
</section>

<!-- Boxed Section -->
<section class="dthree-section-boxed">
    <div class="content">Content within max-width bounds</div>
</section>

<!-- Narrow Section -->
<section class="dthree-section-narrow">
    <div class="content">Content in narrow, centered container</div>
</section>

<!-- Wide Section -->
<section class="dthree-section-wide">
    <div class="content">Content in extended container</div>
</section>

<!-- Custom Section -->
<section class="dthree-section-custom">
    <div class="content">User-defined container settings</div>
</section>
```

### Section Styles

```html
<!-- Minimal Section -->
<section class="dthree-section-minimal">
    <h2>Minimal Section</h2>
    <p>Basic padding, transparent background</p>
</section>

<!-- Padded Section -->
<section class="dthree-section-padded">
    <h2>Padded Section</h2>
    <p>Extra padding for breathing room</p>
</section>

<!-- Featured Section -->
<section class="dthree-section-featured">
    <h2>Featured Section</h2>
    <p>Light background with border accent</p>
</section>

<!-- Hero Section -->
<section class="dthree-section-hero">
    <h1>Hero Section</h1>
    <p>Full-width hero with gradient background</p>
</section>
```

### Combining Section Layouts

```html
<!-- Combined container type and section style -->
<section class="dthree-section-boxed dthree-section-featured">
    <div class="dthree-container">
        <h2>Featured Content</h2>
        <p>Boxed container with featured styling</p>
    </div>
</section>

<!-- WordPress Block Usage -->
<!-- wp:group {"className":"dthree-section-full-width dthree-section-hero"} -->
<div class="wp-block-group dthree-section-full-width dthree-section-hero">
    <!-- wp:heading {"level":1} -->
    <h1>Hero Title</h1>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->
```

## 🍔 Menu Builder

Create advanced navigation systems with multiple layout options.

### Basic Menu Layouts

Configure menu styles in **Appearance → Design System → Menu Builder**:

```html
<!-- Horizontal Menu -->
<nav class="dthree-menu-horizontal">
    <a href="#" class="menu-item">Home</a>
    <a href="#" class="menu-item">About</a>
    <a href="#" class="menu-item has-dropdown">
        Services
        <div class="dropdown-menu dropdown-simple">
            <a href="#" class="dropdown-item">Web Design</a>
            <a href="#" class="dropdown-item">Development</a>
        </div>
    </a>
    <a href="#" class="menu-item">Contact</a>
</nav>

<!-- Vertical Menu -->
<nav class="dthree-menu-vertical">
    <a href="#" class="menu-item">Home</a>
    <a href="#" class="menu-item">About</a>
    <a href="#" class="menu-item">Services</a>
    <a href="#" class="menu-item">Contact</a>
</nav>

<!-- Centered Menu -->
<nav class="dthree-menu-centered">
    <a href="#" class="menu-item">Home</a>
    <a href="#" class="menu-item">About</a>
    <a href="#" class="menu-item">Services</a>
    <a href="#" class="menu-item">Contact</a>
</nav>
```

### Split Menu Layout

```html
<!-- Split Menu with Logo in Center -->
<nav class="dthree-menu-split">
    <div class="menu-left">
        <a href="#" class="menu-item">Home</a>
        <a href="#" class="menu-item">About</a>
    </div>
    <div class="menu-logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="menu-right">
        <a href="#" class="menu-item">Services</a>
        <a href="#" class="menu-item">Contact</a>
    </div>
</nav>
```

### Mega Menu

```html
<!-- Mega Menu with Multiple Columns -->
<nav class="dthree-menu-mega">
    <a href="#" class="menu-item has-mega">
        Products
        <div class="mega-dropdown dropdown-mega">
            <div class="mega-column">
                <h5>Web Services</h5>
                <a href="#">Website Design</a>
                <a href="#">E-commerce</a>
                <a href="#">Landing Pages</a>
            </div>
            <div class="mega-column">
                <h5>Development</h5>
                <a href="#">Custom Development</a>
                <a href="#">WordPress</a>
                <a href="#">React Apps</a>
            </div>
            <div class="mega-column">
                <h5>Marketing</h5>
                <a href="#">SEO Services</a>
                <a href="#">Social Media</a>
                <a href="#">Content Strategy</a>
            </div>
            <div class="mega-column">
                <h5>Support</h5>
                <a href="#">Maintenance</a>
                <a href="#">Hosting</a>
                <a href="#">Training</a>
            </div>
        </div>
    </a>
</nav>
```

### Mobile Menu

```html
<!-- Mobile Menu Structure -->
<div class="mobile-menu-container">
    <!-- Hamburger Button -->
    <button class="hamburger-menu hamburger-lines">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <!-- Mobile Menu -->
    <nav class="mobile-menu mobile-menu-left">
        <a href="#" class="mobile-menu-item">Home</a>
        <a href="#" class="mobile-menu-item">About</a>
        <a href="#" class="mobile-menu-item has-dropdown">
            Services
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item">Web Design</a>
                <a href="#" class="dropdown-item">Development</a>
            </div>
        </a>
        <a href="#" class="mobile-menu-item">Contact</a>
    </nav>
    
    <!-- Overlay -->
    <div class="mobile-menu-overlay"></div>
</div>
```

### JavaScript Integration

```javascript
// Initialize menu functionality
$(document).ready(function() {
    // Toggle mobile menu
    $('.hamburger-menu').on('click', function() {
        DThreeMenus.toggleMobileMenu();
    });
    
    // Close mobile menu on overlay click
    $('.mobile-menu-overlay').on('click', function() {
        DThreeMenus.closeMobileMenu();
    });
    
    // Dropdown hover behavior
    $('.menu-item.has-dropdown').hover(
        function() {
            $(this).find('.dropdown-menu').fadeIn(200);
        },
        function() {
            $(this).find('.dropdown-menu').fadeOut(200);
        }
    );
});
```

### Menu Accessibility Features

The menu builder includes full keyboard navigation and ARIA support:

- **Tab Navigation**: Navigate through menu items with Tab key
- **Arrow Keys**: Navigate dropdowns with Up/Down arrows  
- **Enter/Space**: Open dropdowns and activate links
- **Escape**: Close open dropdowns and return focus
- **Screen Reader Support**: Full ARIA labels and announcements

## 🚀 Usage Examples

### Complete Page with Sections and Menus

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DThree Design System Example</title>
    <link rel="stylesheet" href="assets/css/generated/design-system.min.css">
</head>
<body>
    <!-- Header with Menu -->
    <header class="dthree-section-boxed">
        <div class="dthree-container">
            <nav class="dthree-menu-split">
                <div class="menu-left">
                    <a href="#" class="menu-item">Home</a>
                    <a href="#" class="menu-item">About</a>
                </div>
                <div class="menu-logo">
                    <img src="logo.png" alt="Company Logo">
                </div>
                <div class="menu-right">
                    <a href="#" class="menu-item has-dropdown">
                        Services
                        <div class="dropdown-menu dropdown-card">
                            <a href="#" class="dropdown-item">Web Design</a>
                            <a href="#" class="dropdown-item">Development</a>
                            <a href="#" class="dropdown-item">Consulting</a>
                        </div>
                    </a>
                    <a href="#" class="menu-item">Contact</a>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Hero Section -->
    <section class="dthree-section-full-width dthree-section-hero">
        <div class="dthree-container">
            <h1 class="dthree-text-4xl dthree-text-center">Welcome to Our Website</h1>
            <p class="dthree-text-xl dthree-text-center">Creating amazing digital experiences</p>
            <div class="dthree-text-center dthree-mt-lg">
                <button class="dthree-btn dthree-btn-primary dthree-mr-md">Get Started</button>
                <button class="dthree-btn dthree-btn-outline">Learn More</button>
            </div>
        </div>
    </section>
    
    <!-- Featured Content -->
    <section class="dthree-section-boxed dthree-section-featured">
        <div class="dthree-container">
            <div class="dthree-row">
                <div class="dthree-col-12 dthree-col-md-4">
                    <div class="dthree-card">
                        <div class="dthree-card-body">
                            <h3>Service 1</h3>
                            <p>Description of our amazing service</p>
                        </div>
                    </div>
                </div>
                <div class="dthree-col-12 dthree-col-md-4">
                    <div class="dthree-card">
                        <div class="dthree-card-body">
                            <h3>Service 2</h3>
                            <p>Description of another great service</p>
                        </div>
                    </div>
                </div>
                <div class="dthree-col-12 dthree-col-md-4">
                    <div class="dthree-card">
                        <div class="dthree-card-body">
                            <h3>Service 3</h3>
                            <p>Description of our third service</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu-container">
        <button class="hamburger-menu hamburger-lines">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="mobile-menu mobile-menu-left">
            <a href="#" class="mobile-menu-item">Home</a>
            <a href="#" class="mobile-menu-item">About</a>
            <a href="#" class="mobile-menu-item">Services</a>
            <a href="#" class="mobile-menu-item">Contact</a>
        </nav>
        <div class="mobile-menu-overlay"></div>
    </div>
    
    <script src="assets/js/generated/design-system.min.js"></script>
    <script src="assets/js/menu-section-layouts.js"></script>
</body>
</html>
```

## 🤝 Contributing

To extend or modify the design system:

1. **Modify Core Files**: Edit files in `/inc/design-system/`
2. **Update Generators**: Modify `css-generator.php` and `js-generator.php`
3. **Test Changes**: Use the admin interface to test modifications
4. **Build Assets**: Always rebuild after making changes

## 📝 License

This design system is part of the DThree Gutenberg theme and follows the same licensing terms.

---

**Happy designing!** 🎨 Create beautiful, consistent, and performant websites with the DThree Design System.
# Theme Defaults & Quick Setup Guide

Complete guide to the DThree Gutenberg theme's default styling and content system, based on Dthree Digital's professional aesthetic.

## 🚀 Quick Setup

### Option 1: Auto-Setup (Recommended)

1. **Activate Theme** - The theme will show a setup notice
2. **Click "Set Up Defaults"** - Or go to Appearance → Theme Setup
3. **Apply Default Setup** - One click to configure everything
4. **Customize** - Adjust colors, content, and settings as needed

### Option 2: Manual Setup

Configure individual components through:
- **Appearance → Customize** - Colors, fonts, layout
- **Pages → Add New** - Create content using blocks
- **Appearance → Menus** - Set up navigation
- **Appearance → Widgets** - Configure footer/sidebar

---

## 🎨 Default Design System

### Color Palette (Based on dthree.com.ph)

```css
Primary Blue:    #2563eb  /* Main brand color */
Secondary Blue:  #1e40af  /* Darker variant */
Light Blue:      #3b82f6  /* Lighter variant */
Accent Cyan:     #06b6d4  /* Highlight color */
Text Primary:    #1f2937  /* Main text */
Text Secondary:  #4b5563  /* Secondary text */
Background:      #ffffff  /* Main background */
Section BG:      #f8fafc  /* Alternate sections */
```

### Typography

- **Font Family:** Inter (Google Font)
- **Base Size:** 16px (1rem)
- **Line Height:** 1.6 (relaxed reading)
- **Headings:** Bold weights (600-700)
- **Body:** Regular weight (400)

### Spacing System

```css
XS: 0.25rem  (4px)   /* Tight spacing */
SM: 0.5rem   (8px)   /* Small gaps */
MD: 1rem     (16px)  /* Standard spacing */
LG: 1.5rem   (24px)  /* Large gaps */
XL: 2rem     (32px)  /* Section padding */
2XL: 3rem    (48px)  /* Major sections */
3XL: 4rem    (64px)  /* Hero sections */
```

---

## 📄 Default Content Structure

### Homepage Template

```
┌─ Hero Section ────────────────┐
│ "High-Performance Websites    │
│  Designed and Built for       │
│  Growth"                      │
│ [Call-to-Action Button]       │
└───────────────────────────────┘

┌─ Features Grid ───────────────┐
│ ┌─────┐ ┌─────┐ ┌─────┐       │
│ │Icon │ │Icon │ │Icon │       │
│ │Feat │ │Feat │ │Feat │       │
│ └─────┘ └─────┘ └─────┘       │
│ ┌─────┐ ┌─────┐ ┌─────┐       │
│ │Icon │ │Icon │ │Icon │       │
│ │Feat │ │Feat │ │Feat │       │
│ └─────┘ └─────┘ └─────┘       │
└───────────────────────────────┘

┌─ Featured Work Slider ───────┐
│ → [Project 1] [Project 2] →  │
└───────────────────────────────┘

┌─ Call-to-Action ─────────────┐
│ "Let's Build Your Next       │
│  Website, Together"          │
│ [Contact Button]             │
└───────────────────────────────┘
```

### Created Pages

1. **Home** - Complete landing page with hero, features, portfolio
2. **About** - Company information and team details
3. **Services** - Pricing tables and service descriptions
4. **Contact** - Contact form and business information

### Sample Blog Posts

1. **"The Future of Web Design: Trends to Watch in 2024"**
2. **"Why Every Business Needs a Professional Website"**
3. **"The Complete Guide to Website Performance Optimization"**

---

## 🧩 Default Components Used

### Hero Section Block
```
Title: "High-Performance Websites..."
Subtitle: "We help organizations..."
Button: "View Our Work"
Style: Modern (Blue gradient)
Size: Large
Alignment: Center
```

### Features Block
```
Layout: 3-column grid
Icons: Custom business icons
Style: Clean cards with hover effects
Services: Design, Development, WordPress, etc.
```

### Card Slider Block
```
Content: Portfolio projects
Autoplay: Enabled
Navigation: Dots + arrows
Speed: Medium
Cards: 4 sample projects
```

### Pricing Tables Block
```
Plans: 3 pricing tiers
Style: Modern cards
Featured: Middle plan highlighted
Features: Comprehensive lists
```

### Contact Form Block
```
Fields: Name, Email, Phone, Service, Details
Style: Modern with validation
Submission: WordPress default handling
```

---

## ⚙️ Theme Configuration

### Customizer Settings Applied

```php
// Colors
'primary_color'       => '#2563eb'
'secondary_color'     => '#1e40af'
'accent_color'        => '#3b82f6'
'text_color'          => '#1f2937'
'background_color'    => '#ffffff'
'section_bg_color'    => '#f8fafc'

// Typography
'heading_font'        => 'Inter'
'body_font'          => 'Inter'
'font_size_base'     => '16'
'line_height_base'   => '1.6'

// Layout
'container_width'    => '1200'
'header_style'       => 'modern'
'footer_style'       => 'corporate'

// Business Info
'company_tagline'    => 'High-Performance Websites...'
'company_description' => 'We help organizations...'
'contact_email'      => 'hello@yourcompany.com'
'contact_phone'      => '+63 917 XXX XXXX'

// Features
'enable_seo'         => true
'enable_ai_features' => true
'enable_lazy_loading' => true
```

### Navigation Menus

**Main Navigation:**
- Home
- About  
- Services
- Contact

**Footer Links:**
- Privacy Policy
- Terms of Service
- Support

### Widget Areas

**Footer 1:** About company text
**Footer 2:** Quick links menu  
**Footer 3:** Contact information
**Sidebar:** Available for blog pages

---

## 📱 Responsive Design

### Breakpoints

```css
Mobile:     < 768px   /* Single column, stacked */
Tablet:     768-1024px /* 2 columns, adjusted */
Desktop:    > 1024px   /* Full 3+ columns */
```

### Mobile Optimizations

- **Hero Text:** Scales down for mobile screens
- **Navigation:** Hamburger menu on mobile
- **Features:** Single column stack
- **Cards:** Full-width on mobile
- **Buttons:** Full-width on small screens
- **Spacing:** Reduced padding on mobile

---

## 🎯 Professional Standards

### Based on Dthree Digital's Approach

1. **Strategy First** - Content structure guides design
2. **User Experience** - Clear navigation and CTAs
3. **Performance** - Optimized images and code
4. **SEO Ready** - Proper markup and meta tags
5. **Conversion Focus** - Strategic button placement
6. **Professional Aesthetic** - Clean, modern design
7. **Accessibility** - Proper contrast and structure

### Industry Best Practices

- **Above-the-fold CTA** - Primary action visible immediately
- **Social Proof** - Client logos and testimonials
- **Clear Value Proposition** - Benefits over features
- **Contact Information** - Multiple ways to reach you
- **Mobile-First** - Responsive design from start
- **Fast Loading** - Optimized assets and code

---

## 🔧 Customization Guide

### Quick Customizations

#### Change Colors
```
Appearance → Customize → Colors → Primary Color
```

#### Update Business Info
```
Appearance → Customize → Site Identity → Tagline
Pages → Edit "Contact" → Update details
```

#### Modify Content
```
Pages → Edit "Home" → Update blocks
Posts → Add New → Create blog content
```

#### Add Logo
```
Appearance → Customize → Site Identity → Logo
```

### Advanced Customizations

#### Custom CSS
```css
/* Add to Appearance → Customize → Additional CSS */

/* Change primary color */
:root {
    --dthree-primary: #your-color;
}

/* Adjust hero height */
.hero-section {
    min-height: 80vh;
}

/* Custom button style */
.btn-custom {
    background: linear-gradient(45deg, #667eea, #764ba2);
}
```

#### Content Blocks

Replace default blocks with your own:
- Hero: Update title, subtitle, image
- Features: Change icons, text, layout
- Portfolio: Add real project images
- Testimonials: Add client feedback
- Contact: Update form fields

---

## 🚀 Going Live Checklist

### Content Updates
- [ ] Replace "hello@yourcompany.com" with real email
- [ ] Update phone number and address
- [ ] Add real company logo
- [ ] Replace sample project images
- [ ] Write custom about page content
- [ ] Add real testimonials
- [ ] Set up Google Analytics

### SEO Setup
- [ ] Configure site title and tagline
- [ ] Add meta descriptions to all pages
- [ ] Submit sitemap to Google Search Console
- [ ] Set up Google My Business
- [ ] Configure social media links

### Performance
- [ ] Optimize images (WebP format)
- [ ] Enable caching plugin
- [ ] Configure CDN (optional)
- [ ] Test mobile performance
- [ ] Run PageSpeed Insights

### Testing
- [ ] Test contact form submissions
- [ ] Check all internal links
- [ ] Verify responsive design
- [ ] Test in multiple browsers
- [ ] Check accessibility compliance

---

## 💡 Tips for Success

### Content Strategy

1. **Lead with Benefits** - What results do you deliver?
2. **Show Credibility** - Client logos, testimonials, case studies
3. **Clear CTAs** - Make next steps obvious
4. **Professional Photos** - High-quality team and office images
5. **Regular Updates** - Keep blog content fresh

### Design Consistency

1. **Stick to Color Palette** - Use defined brand colors
2. **Consistent Spacing** - Use theme's spacing system  
3. **Typography Hierarchy** - Proper heading structure
4. **Button Styles** - Use consistent button classes
5. **Image Quality** - High-resolution, professional photos

### Technical Excellence

1. **Fast Loading** - Optimize all images and assets
2. **Mobile Perfect** - Test on real devices
3. **SEO Optimized** - Proper meta tags and structure
4. **Security Updated** - Keep WordPress and plugins current
5. **Backup System** - Regular automated backups

---

## 📞 Support Resources

### Theme Documentation
- [SEO & AI Features Guide](./SEO-AI-FEATURES.md)
- [Components Documentation](./COMPONENTS.md)
- [Technical Documentation](./TECHNICAL-DOCUMENTATION.md)

### WordPress Resources
- [WordPress Codex](https://codex.wordpress.org/)
- [Block Editor Guide](https://wordpress.org/support/article/wordpress-editor/)
- [Customizer Documentation](https://developer.wordpress.org/themes/customize-api/)

### Design Inspiration
- [Dthree Digital Portfolio](https://dthree.com.ph/projects)
- [Modern Web Design Trends](https://dthree.com.ph/blog)

---

**Theme Version:** 1.2.0+  
**Last Updated:** November 9, 2025  
**Built by:** [Dthree Digital](https://dthree.com.ph)
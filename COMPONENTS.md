# UI Components Guide

Complete reference for all UI component blocks in the DThree Gutenberg theme.

## 📋 Table of Contents

1. [Tabs](#tabs)
2. [Accordion](#accordion)
3. [Pricing Tables](#pricing-tables)
4. [Progress Bars](#progress-bars)
5. [Timeline](#timeline)
6. [Modal](#modal)
7. [Video Player](#video-player)
8. [Alerts](#alerts)
9. [Icon Boxes](#icon-boxes)
10. [Social Share](#social-share)

---

## Tabs

Organize content in tabbed sections.

### Features
- ✅ 3 visual styles (Pills, Underline, Boxed)
- ✅ Flexible alignment (left, center, right)
- ✅ Optional icons
- ✅ Default tab selection
- ✅ Smooth transitions
- ✅ Full accessibility

### Attributes
```php
'tabs' => array(
    array(
        'id'      => 'tab-1',
        'title'   => 'Tab Title',
        'content' => 'Tab content...',
        'icon'    => 'star-fill', // Bootstrap icon name
    ),
),
'style'      => 'pills',  // pills, underline, boxed
'alignment'  => 'left',   // left, center, right
'defaultTab' => 0,        // Index of active tab
```

### Styles

**Pills** (Default)
- Rounded pill-shaped tabs
- Colored active state
- Best for primary navigation

**Underline**
- Clean underline indicator
- Minimal design
- Great for content sections

**Boxed**
- Individual bordered boxes
- Modern look
- Excellent for feature comparison

---

## Accordion

Collapsible content sections for FAQs and expandable content.

### Features
- ✅ 3 visual styles (Default, Bordered, Flush)
- ✅ Multiple or single open items
- ✅ Optional icons
- ✅ Icon position control
- ✅ Smooth animations
- ✅ ARIA compliant

### Attributes
```php
'items' => array(
    array(
        'id'      => 'item-1',
        'title'   => 'Accordion Title',
        'content' => 'Accordion content...',
        'icon'    => 'question-circle',
        'open'    => true,
    ),
),
'style'          => 'default',  // default, bordered, flush
'allowMultiple'  => false,      // Allow multiple open items
'iconPosition'   => 'right',    // left, right
```

### Use Cases
- FAQ sections
- Product specifications
- Feature details
- Help documentation
- Terms and conditions

---

## Pricing Tables

Showcase pricing plans and packages.

### Features
- ✅ Flexible column layout (1-6 columns)
- ✅ Featured plan highlighting
- ✅ Ribbon badges
- ✅ Custom currency symbols
- ✅ Feature lists with icons
- ✅ Call-to-action buttons
- ✅ 3 visual styles

### Attributes
```php
'plans' => array(
    array(
        'name'        => 'Basic',
        'price'       => '9',
        'period'      => 'month',
        'description' => 'Perfect for individuals',
        'features'    => array( '5 Projects', '5GB Storage' ),
        'buttonText'  => 'Get Started',
        'buttonUrl'   => '#',
        'featured'    => false,
        'ribbon'      => '',
    ),
),
'currency' => '$',
'columns'  => 3,
'style'    => 'card',  // card, minimal, bordered
```

### Best Practices
- Keep feature lists consistent across plans
- Use featured for recommended plan
- Limit to 3-4 plans for clarity
- Make pricing prominent
- Clear CTA buttons

---

## Progress Bars

Display skills, stats, or progress with animated bars.

### Features
- ✅ Animated on scroll
- ✅ 3 size options
- ✅ Striped and animated variants
- ✅ Custom colors
- ✅ Optional percentage display
- ✅ Labeled bars

### Attributes
```php
'bars' => array(
    array(
        'label'      => 'WordPress',
        'percentage' => 90,
        'color'      => 'primary', // Bootstrap color
    ),
),
'style'          => 'default',  // default, striped, animated
'height'         => 'medium',   // small, medium, large
'showPercentage' => true,
'animateOnView'  => true,       // Animate when scrolled into view
```

### Colors Available
- `primary`, `secondary`, `success`, `danger`
- `warning`, `info`, `light`, `dark`

---

## Timeline

Display events in chronological order.

### Features
- ✅ 3 layout styles (Vertical, Horizontal, Alternating)
- ✅ Custom icons
- ✅ Icon shapes (circle, square, none)
- ✅ Responsive design
- ✅ Clean visual flow

### Attributes
```php
'events' => array(
    array(
        'date'        => '2024',
        'title'       => 'Event Title',
        'description' => 'Event description...',
        'icon'        => 'star-fill',
    ),
),
'style'     => 'vertical',    // vertical, horizontal, alternating
'iconStyle' => 'circle',      // circle, square, none
```

### Layout Styles

**Vertical**
- Linear top-to-bottom flow
- Best for chronological history
- Mobile-friendly

**Alternating**
- Left/right alternating items
- Balanced visual design
- Great for desktop viewing

**Horizontal**
- Side-scrolling timeline
- Modern presentation
- Perfect for roadmaps

---

## Modal

Display content in popup modal windows.

### Features
- ✅ 4 size options
- ✅ Centered or top positioning
- ✅ Custom backdrop behavior
- ✅ Multiple footer buttons
- ✅ Fully accessible
- ✅ Smooth animations

### Attributes
```php
'modalId'     => 'my-modal',
'title'       => 'Modal Title',
'content'     => 'Modal content...',
'buttonText'  => 'Open Modal',
'buttonStyle' => 'primary',
'size'        => 'medium',     // small, medium, large, extra-large
'centered'    => true,
'backdrop'    => 'true',       // true, static, false
'footerButtons' => array(
    array(
        'text'   => 'Close',
        'style'  => 'secondary',
        'action' => 'close',
    ),
),
```

### Use Cases
- Login/signup forms
- Video embeds
- Image galleries
- Announcements
- Terms acceptance
- Detailed information

---

## Video Player

Embed YouTube, Vimeo, or self-hosted videos.

### Features
- ✅ YouTube support
- ✅ Vimeo support
- ✅ Self-hosted videos
- ✅ 4 aspect ratios
- ✅ Autoplay, loop, mute options
- ✅ Responsive embedding
- ✅ Custom thumbnails

### Attributes
```php
'videoType'   => 'youtube',    // youtube, vimeo, self-hosted
'videoUrl'    => 'https://...',
'videoId'     => 'dQw4w9WgXcQ',
'aspectRatio' => '16x9',       // 16x9, 4x3, 21x9, 1x1
'autoplay'    => false,
'controls'    => true,
'muted'       => false,
'loop'        => false,
'thumbnail'   => '',           // For self-hosted
'title'       => 'Video title',
```

### Supported URLs
- YouTube: `youtube.com/watch?v=ID` or `youtu.be/ID`
- Vimeo: `vimeo.com/ID`
- Self-hosted: Direct MP4 URL

---

## Alerts

Display contextual feedback messages.

### Features
- ✅ 8 color variants
- ✅ Optional icons
- ✅ Dismissible option
- ✅ Custom or default icons
- ✅ Title support
- ✅ Rich content

### Attributes
```php
'type'        => 'info',      // primary, secondary, success, danger, warning, info, light, dark
'title'       => 'Alert Title',
'content'     => 'Alert message...',
'icon'        => 'info-circle-fill',
'dismissible' => false,
'showIcon'    => true,
```

### Alert Types

**Success** - Positive confirmation
**Info** - Helpful information
**Warning** - Important notice
**Danger** - Error or critical message
**Primary/Secondary** - General purpose

---

## Icon Boxes

Showcase features or services with icon boxes.

### Features
- ✅ Flexible grid layout (1-4 columns)
- ✅ 4 visual styles
- ✅ Icon shapes (circle, square, none)
- ✅ Icon positioning (top, left)
- ✅ Text alignment
- ✅ Optional links
- ✅ Hover effects

### Attributes
```php
'boxes' => array(
    array(
        'icon'        => 'lightning-fill',
        'title'       => 'Fast Performance',
        'description' => 'Lightning fast loading speeds',
        'link'        => '',
    ),
),
'columns'      => 3,
'style'        => 'card',      // card, minimal, bordered, hover
'iconStyle'    => 'circle',    // circle, square, none
'iconPosition' => 'top',       // top, left
'textAlign'    => 'center',    // left, center
```

### Styles

**Card** - Bordered with shadow, hover lift
**Minimal** - Clean, no borders
**Bordered** - Strong borders, color on hover
**Hover** - Subtle effects on interaction

---

## Social Share

Share buttons for social media platforms.

### Features
- ✅ 8 social platforms
- ✅ 3 visual styles
- ✅ 3 size options
- ✅ Optional labels
- ✅ Share counts (optional)
- ✅ Auto URL detection
- ✅ Flexible alignment

### Attributes
```php
'platforms'  => array( 'facebook', 'twitter', 'linkedin', 'email' ),
'style'      => 'buttons',    // buttons, icons, minimal
'size'       => 'medium',     // small, medium, large
'alignment'  => 'left',       // left, center, right
'showLabels' => true,
'showCounts' => false,
```

### Supported Platforms
- Facebook
- Twitter (X)
- LinkedIn
- Pinterest
- Reddit
- WhatsApp
- Telegram
- Email

---

## Component Combinations

### Example 1: FAQ Section
```
Tabs (Questions by category)
└── Accordion (Individual Q&A pairs)
```

### Example 2: Product Page
```
Tabs (Product details, specs, reviews)
├── Icon Boxes (Key features)
├── Progress Bars (Ratings)
└── Social Share (Share product)
```

### Example 3: Company About Page
```
Timeline (Company history)
├── Icon Boxes (Values)
└── Modal (Team member details)
```

### Example 4: Service Showcase
```
Pricing Tables (Service tiers)
├── Accordion (FAQ per tier)
└── Alert (Special offer)
```

---

## Performance Tips

1. **Lazy Load Videos** - Use thumbnail images
2. **Limit Animations** - Don't overuse progress bar animations
3. **Minimize Modals** - Use sparingly per page
4. **Optimize Icons** - Use Bootstrap Icons (already loaded)
5. **Tab Content** - Keep content reasonable size

## Accessibility

All components include:
- ✅ ARIA labels and roles
- ✅ Keyboard navigation
- ✅ Focus management
- ✅ Screen reader support
- ✅ Semantic HTML
- ✅ Color contrast compliance

## Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers

## Next Steps

1. Explore individual component examples
2. Check Bootstrap 5 documentation for additional customization
3. Use theme customizer for global color schemes
4. Combine components for rich page layouts
5. Test accessibility with screen readers

---

**Theme Version:** 1.2.0  
**Components:** 10 professional blocks  
**Bootstrap:** 5.3.2  
**License:** GPL v2 or later

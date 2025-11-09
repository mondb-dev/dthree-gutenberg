# Components Quick Reference

Fast lookup guide for all UI components.

## 🎯 Quick Component Selection

| Need | Use This Component |
|------|-------------------|
| Organize related content | **Tabs** or **Accordion** |
| Show pricing/plans | **Pricing Tables** |
| Display skills/stats | **Progress Bars** |
| Show chronological events | **Timeline** |
| Popup content | **Modal** |
| Embed videos | **Video Player** |
| Show notifications | **Alerts** |
| Feature grid | **Icon Boxes** |
| Social sharing | **Social Share** |

---

## 📦 Component Attributes Quick Reference

### Tabs
```php
dthree/tabs
├── tabs: array
├── style: pills|underline|boxed
├── alignment: left|center|right
└── defaultTab: number
```

### Accordion
```php
dthree/accordion
├── items: array
├── style: default|bordered|flush
├── allowMultiple: boolean
└── iconPosition: left|right
```

### Pricing Tables
```php
dthree/pricing-tables
├── plans: array
├── currency: string
├── columns: number (1-6)
└── style: card|minimal|bordered
```

### Progress Bars
```php
dthree/progress-bars
├── bars: array
├── style: default|striped|animated
├── height: small|medium|large
├── showPercentage: boolean
└── animateOnView: boolean
```

### Timeline
```php
dthree/timeline
├── events: array
├── style: vertical|horizontal|alternating
└── iconStyle: circle|square|none
```

### Modal
```php
dthree/modal
├── modalId: string
├── title: string
├── content: string
├── buttonText: string
├── buttonStyle: primary|secondary|...
├── size: small|medium|large|extra-large
├── centered: boolean
├── backdrop: true|static|false
└── footerButtons: array
```

### Video Player
```php
dthree/video-player
├── videoType: youtube|vimeo|self-hosted
├── videoUrl: string
├── videoId: string
├── aspectRatio: 16x9|4x3|21x9|1x1
├── autoplay: boolean
├── controls: boolean
├── muted: boolean
├── loop: boolean
├── thumbnail: string
└── title: string
```

### Alerts
```php
dthree/alerts
├── type: primary|secondary|success|danger|warning|info|light|dark
├── title: string
├── content: string
├── icon: string
├── dismissible: boolean
└── showIcon: boolean
```

### Icon Boxes
```php
dthree/icon-boxes
├── boxes: array
├── columns: number (1-4)
├── style: card|minimal|bordered|hover
├── iconStyle: circle|square|none
├── iconPosition: top|left
└── textAlign: left|center
```

### Social Share
```php
dthree/social-share
├── platforms: array
├── style: buttons|icons|minimal
├── size: small|medium|large
├── alignment: left|center|right
├── showLabels: boolean
└── showCounts: boolean
```

---

## 🎨 Available Bootstrap Colors

All color-based attributes support:
- `primary` - Theme primary color
- `secondary` - Theme secondary color
- `success` - Green/positive
- `danger` - Red/error
- `warning` - Yellow/caution
- `info` - Blue/information
- `light` - Light gray
- `dark` - Dark gray

---

## 🔧 Common Bootstrap Icons

Use these in icon attributes:

### General
- `star-fill`, `star`
- `heart-fill`, `heart`
- `check-circle-fill`, `check-circle`
- `info-circle-fill`, `info-circle`
- `exclamation-circle-fill`
- `question-circle-fill`

### Business
- `briefcase-fill`
- `trophy-fill`
- `award-fill`
- `graph-up-arrow`
- `currency-dollar`

### Technology
- `lightning-fill`
- `cpu-fill`
- `phone-fill`
- `laptop-fill`
- `cloud-fill`

### Social
- `facebook`, `twitter-x`, `linkedin`
- `instagram`, `youtube`, `tiktok`
- `github`, `discord`, `slack`

### UI
- `arrow-right`, `arrow-left`
- `chevron-down`, `chevron-up`
- `plus-circle-fill`
- `x-circle-fill`

[Full icon list](https://icons.getbootstrap.com/)

---

## 💡 Usage Examples

### Simple Tab Section
```php
// In Gutenberg editor, add dthree/tabs block
[
  {
    id: 'overview',
    title: 'Overview',
    content: 'Product overview content...',
    icon: 'info-circle-fill'
  },
  {
    id: 'features',
    title: 'Features',
    content: 'Feature list...',
    icon: 'star-fill'
  }
]
```

### FAQ Accordion
```php
// Add dthree/accordion block
[
  {
    id: 'faq-1',
    title: 'What is included?',
    content: 'All features are included...',
    icon: 'question-circle',
    open: true
  },
  {
    id: 'faq-2',
    title: 'How does billing work?',
    content: 'Billing is monthly...',
    icon: 'question-circle',
    open: false
  }
]
```

### 3-Tier Pricing
```php
// Add dthree/pricing-tables block
Plans: Basic ($9/mo), Pro ($29/mo, featured), Enterprise ($99/mo)
Columns: 3
Style: card
Currency: $
```

### Progress Showcase
```php
// Add dthree/progress-bars block
[
  { label: 'WordPress', percentage: 95, color: 'primary' },
  { label: 'PHP', percentage: 90, color: 'success' },
  { label: 'JavaScript', percentage: 85, color: 'info' }
]
Style: animated
Height: medium
ShowPercentage: true
AnimateOnView: true
```

### Company Timeline
```php
// Add dthree/timeline block
[
  {
    date: '2024',
    title: 'Expansion',
    description: 'Opened 5 new offices...',
    icon: 'trophy-fill'
  },
  {
    date: '2023',
    title: 'Product Launch',
    description: 'Released version 2.0...',
    icon: 'rocket-fill'
  }
]
Style: alternating
IconStyle: circle
```

### YouTube Embed
```php
// Add dthree/video-player block
VideoType: youtube
VideoUrl: https://youtube.com/watch?v=dQw4w9WgXcQ
AspectRatio: 16x9
Controls: true
Autoplay: false
```

### Success Alert
```php
// Add dthree/alerts block
Type: success
Title: 'Success!'
Content: 'Your form has been submitted.'
Icon: check-circle-fill
Dismissible: true
```

### Feature Grid
```php
// Add dthree/icon-boxes block
[
  {
    icon: 'lightning-fill',
    title: 'Fast',
    description: 'Blazing fast performance',
    link: '/features/speed'
  },
  {
    icon: 'shield-fill-check',
    title: 'Secure',
    description: 'Enterprise security',
    link: '/features/security'
  },
  {
    icon: 'phone-fill',
    title: 'Responsive',
    description: 'Works on all devices',
    link: '/features/responsive'
  }
]
Columns: 3
Style: card
IconStyle: circle
```

### Share Buttons
```php
// Add dthree/social-share block
Platforms: facebook, twitter, linkedin, email
Style: buttons
Size: medium
ShowLabels: true
Alignment: left
```

---

## 📱 Responsive Behavior

| Component | Mobile | Tablet | Desktop |
|-----------|--------|--------|---------|
| Tabs | Stacked | Wrapped | Inline |
| Accordion | Full width | Full width | Full width |
| Pricing | 1 column | 2 columns | 3+ columns |
| Progress | Full width | Full width | Full width |
| Timeline | Vertical | Vertical/Alt | All styles |
| Modal | Full height | Centered | Centered |
| Video | 16:9 ratio | 16:9 ratio | 16:9 ratio |
| Alerts | Full width | Full width | Full width |
| Icon Boxes | 1 column | 2 columns | 3-4 columns |
| Social Share | Stacked | Wrapped | Inline |

---

## ⚡ Performance Tips

1. **Tabs**: Limit to 5-7 tabs maximum
2. **Accordion**: Use for 3+ collapsible items
3. **Pricing**: Show 3-4 plans for clarity
4. **Progress**: Animate on view for better UX
5. **Timeline**: Use horizontal for 5+ events
6. **Modal**: One per page interaction
7. **Video**: Use thumbnails for lazy load
8. **Alerts**: Limit to 1-2 per page
9. **Icon Boxes**: 3-column layout optimal
10. **Social Share**: 4-6 platforms maximum

---

## 🔍 SEO Considerations

| Component | SEO Impact | Best Practice |
|-----------|------------|---------------|
| Tabs | Medium | Use descriptive tab titles |
| Accordion | High | Include keywords in titles |
| Pricing | Medium | Schema markup for offers |
| Progress | Low | Descriptive labels |
| Timeline | High | Chronological structure |
| Modal | Low | Non-critical content only |
| Video | High | Add transcripts/captions |
| Alerts | Low | Keep important content out |
| Icon Boxes | Medium | Descriptive headings |
| Social Share | Medium | Encourage engagement |

---

## 🎯 Accessibility Checklist

All components include:
- ✅ Proper heading hierarchy
- ✅ ARIA labels and roles
- ✅ Keyboard navigation
- ✅ Focus indicators
- ✅ Screen reader text
- ✅ Color contrast (WCAG AA)
- ✅ Semantic HTML

---

## 🚀 Getting Started

1. Open WordPress admin
2. Edit any page/post
3. Click `+` to add block
4. Search for component name
5. Configure attributes
6. Preview and publish

---

**Need more details?** See [COMPONENTS.md](COMPONENTS.md) for full documentation.

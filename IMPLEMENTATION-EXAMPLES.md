# Component Implementation Examples

Real-world examples showing how to use all components together.

## 🏢 Example 1: SaaS Landing Page

### Layout Structure
```
┌─────────────────────────────────────┐
│ Header (Sticky Navigation)          │
├─────────────────────────────────────┤
│ Hero Section                         │
│ - Full-width background             │
│ - Headline + subheadline            │
│ - CTA buttons                       │
├─────────────────────────────────────┤
│ Icon Boxes (3 columns)              │
│ - Lightning: Fast Performance       │
│ - Shield: Secure                    │
│ - Graph: Analytics                  │
├─────────────────────────────────────┤
│ Features Section                     │
│ - Grid layout with icons            │
│ - Feature descriptions              │
├─────────────────────────────────────┤
│ Video Player                         │
│ - Product demo video                │
│ - 16:9 aspect ratio                 │
├─────────────────────────────────────┤
│ Pricing Tables (3 plans)            │
│ - Basic, Pro (featured), Enterprise │
│ - Feature comparison                │
├─────────────────────────────────────┤
│ Testimonial Slider                   │
│ - Customer reviews                  │
│ - 5-star ratings                    │
│ - Auto-rotate                       │
├─────────────────────────────────────┤
│ Accordion FAQ                        │
│ - Common questions                  │
│ - Collapsible answers               │
├─────────────────────────────────────┤
│ Call-to-Action                       │
│ - Final conversion prompt           │
│ - Sign-up button                    │
├─────────────────────────────────────┤
│ Footer with Social Share            │
└─────────────────────────────────────┘
```

### Component Configuration

**Hero Section**
```
Background: Gradient or image
Heading: "Transform Your Business"
Subheading: "The all-in-one platform..."
Buttons: "Start Free Trial" + "Watch Demo"
```

**Icon Boxes**
```
Columns: 3
Style: card
IconPosition: top
Icons: lightning-fill, shield-fill-check, graph-up-arrow
```

**Pricing Tables**
```
Plans:
  - Basic: $9/month (5 features)
  - Pro: $29/month (10 features, featured, "Popular" ribbon)
  - Enterprise: $99/month (unlimited features)
Currency: $
Style: card
```

**Accordion FAQ**
```
Items: 5-8 common questions
Style: default
AllowMultiple: false
IconPosition: right
```

---

## 📚 Example 2: Documentation Site

### Layout Structure
```
┌─────────────────────────────────────┐
│ Alert: "New version available!"     │
├─────────────────────────────────────┤
│ Tabs (Main Sections)                │
│ ├── Getting Started                 │
│ ├── Installation                    │
│ ├── Configuration                   │
│ └── API Reference                   │
│                                     │
│ Tab Content:                        │
│   ├── Accordion (Sub-sections)      │
│   ├── Code examples                 │
│   ├── Video Player (tutorial)       │
│   └── Alerts (notes/warnings)       │
├─────────────────────────────────────┤
│ Progress Bars                        │
│ - Setup completion tracker          │
├─────────────────────────────────────┤
│ Timeline                             │
│ - Version history                   │
│ - Release notes                     │
├─────────────────────────────────────┤
│ Social Share                         │
│ - Share documentation               │
└─────────────────────────────────────┘
```

### Component Configuration

**Tabs**
```
Style: underline
Alignment: left
Tabs:
  - Getting Started (icon: play-fill)
  - Installation (icon: download)
  - Configuration (icon: gear-fill)
  - API Reference (icon: code-slash)
```

**Accordion (within tabs)**
```
Style: flush
Items: Multiple sub-topics
AllowMultiple: true
Open: First item by default
```

**Progress Bars**
```
Bars:
  - Installation: 100% (success)
  - Configuration: 75% (info)
  - First App: 25% (warning)
Style: striped
AnimateOnView: true
```

**Timeline**
```
Style: vertical
Events: Version releases with dates
IconStyle: circle
Icons: trophy-fill, star-fill, rocket-fill
```

---

## 🎨 Example 3: Portfolio Website

### Layout Structure
```
┌─────────────────────────────────────┐
│ Content Slider (Portfolio Hero)     │
│ - Multiple project highlights       │
│ - Text overlays with CTAs           │
├─────────────────────────────────────┤
│ Icon Boxes (Services)               │
│ - Web Design                        │
│ - Branding                          │
│ - Photography                       │
├─────────────────────────────────────┤
│ Image Slider with Lightbox          │
│ - Portfolio gallery                 │
│ - Click to zoom                     │
├─────────────────────────────────────┤
│ Timeline (Career/Projects)          │
│ - Alternating layout                │
│ - Chronological achievements        │
├─────────────────────────────────────┤
│ Progress Bars (Skills)              │
│ - Photoshop: 95%                    │
│ - Illustrator: 90%                  │
│ - UI/UX Design: 85%                 │
├─────────────────────────────────────┤
│ Testimonial Slider                   │
│ - Client reviews                    │
│ - Card style                        │
├─────────────────────────────────────┤
│ Modal (Project Details)             │
│ - Triggered from image slider       │
│ - Full project info                 │
├─────────────────────────────────────┤
│ Contact Form                         │
│ - Get in touch                      │
└─────────────────────────────────────┘
```

### Component Configuration

**Content Slider**
```
Slides: 3-5 featured projects
Transition: fade
Interval: 5000ms
Each slide: Background image + title + description + "View Project" button
```

**Image Slider + Lightbox**
```
Images: 12-20 portfolio pieces
Transition: slide
Captions: enabled
Lightbox: Auto-enabled
```

**Timeline**
```
Style: alternating
Events:
  - 2024: Studio Founded
  - 2023: Award Winner
  - 2022: 100+ Projects
IconStyle: circle
```

**Progress Bars**
```
Height: large
ShowPercentage: true
AnimateOnView: true
Colors: Mix of primary, success, info
```

---

## 🛍️ Example 4: E-commerce Product Page

### Layout Structure
```
┌─────────────────────────────────────┐
│ Alert: "Free shipping over $50!"    │
├─────────────────────────────────────┤
│ Image Slider (Product Photos)       │
│ - Multiple angles                   │
│ - Lightbox enabled                  │
├─────────────────────────────────────┤
│ Tabs (Product Info)                 │
│ ├── Description                     │
│ ├── Specifications                  │
│ ├── Reviews                         │
│ └── Shipping                        │
├─────────────────────────────────────┤
│ Progress Bars (Features)            │
│ - Quality: 95%                      │
│ - Value: 90%                        │
│ - Durability: 88%                   │
├─────────────────────────────────────┤
│ Icon Boxes (Benefits)               │
│ - Free Returns                      │
│ - Warranty                          │
│ - Support                           │
├─────────────────────────────────────┤
│ Accordion (FAQ)                      │
│ - Common product questions          │
├─────────────────────────────────────┤
│ Video Player                         │
│ - Product demo/unboxing             │
├─────────────────────────────────────┤
│ Card Slider (Related Products)      │
│ - Horizontal scroll                 │
├─────────────────────────────────────┤
│ Social Share                         │
│ - Share product                     │
└─────────────────────────────────────┘
```

### Component Configuration

**Tabs**
```
Style: pills
Alignment: center
Tabs:
  - Description
  - Specifications (with accordion for details)
  - Reviews (testimonial slider inside)
  - Shipping (accordion with options)
```

**Progress Bars**
```
Context: Customer ratings breakdown
Bars:
  - 5 Stars: 75% (success)
  - 4 Stars: 20% (info)
  - 3 Stars: 5% (warning)
Style: default
ShowPercentage: true
```

**Card Slider**
```
Cards: 8-12 related products
CardsPerView: 4
Responsive: 1 on mobile, 2 on tablet, 4 on desktop
```

---

## 🎓 Example 5: Online Course Platform

### Layout Structure
```
┌─────────────────────────────────────┐
│ Hero Section (Course Overview)      │
├─────────────────────────────────────┤
│ Alert: "Early bird discount!"       │
├─────────────────────────────────────┤
│ Tabs (Course Content)               │
│ ├── Curriculum                      │
│ ├── Instructor                      │
│ ├── Reviews                         │
│ └── FAQ                             │
│                                     │
│ Curriculum Tab Content:             │
│   └── Accordion (Modules)           │
│       ├── Module 1 (Video list)     │
│       ├── Module 2 (Video list)     │
│       └── Module 3 (Video list)     │
├─────────────────────────────────────┤
│ Progress Bars (Skills Gained)       │
│ - JavaScript: 90%                   │
│ - React: 85%                        │
│ - Node.js: 80%                      │
├─────────────────────────────────────┤
│ Video Player (Preview)              │
│ - First lesson free                 │
├─────────────────────────────────────┤
│ Icon Boxes (Course Benefits)        │
│ - Lifetime Access                   │
│ - Certificate                       │
│ - 1-on-1 Support                    │
├─────────────────────────────────────┤
│ Timeline (Learning Path)            │
│ - Week by week breakdown            │
├─────────────────────────────────────┤
│ Testimonial Slider (Student Reviews)│
├─────────────────────────────────────┤
│ Pricing Tables                       │
│ - Self-paced vs Mentored            │
├─────────────────────────────────────┤
│ Modal (Enrollment Form)             │
│ - Triggered by CTA buttons          │
└─────────────────────────────────────┘
```

### Component Configuration

**Tabs + Accordion Combination**
```
Tabs:
  - Curriculum tab contains:
    Accordion with modules (AllowMultiple: true)
    Each accordion item: Module title + lesson list
```

**Timeline**
```
Style: vertical
Events: Week-by-week milestones
Icons: Different icon per week
Description: Topics covered that week
```

**Modal**
```
ModalId: enrollment-form
Size: large
Centered: true
Content: Enrollment form fields
FooterButtons:
  - Close (secondary)
  - Enroll Now (primary)
```

---

## 🏥 Example 6: Healthcare/Medical Site

### Layout Structure
```
┌─────────────────────────────────────┐
│ Alert: "COVID-19 updates"           │
├─────────────────────────────────────┤
│ Hero Section (Emergency contact)    │
├─────────────────────────────────────┤
│ Icon Boxes (Services)               │
│ - Emergency Care                    │
│ - Primary Care                      │
│ - Specialists                       │
├─────────────────────────────────────┤
│ Tabs (Departments)                  │
│ - Each department info              │
├─────────────────────────────────────┤
│ Team Members (Doctors)              │
│ - Photo + specialty                 │
│ - Click opens Modal with full bio   │
├─────────────────────────────────────┤
│ Accordion (Patient Info)            │
│ - Insurance                         │
│ - First Visit                       │
│ - Billing                           │
├─────────────────────────────────────┤
│ Timeline (Hospital History)         │
├─────────────────────────────────────┤
│ Video Player (Virtual Tour)         │
├─────────────────────────────────────┤
│ Contact Form (Appointments)         │
└─────────────────────────────────────┘
```

---

## 🍕 Example 7: Restaurant Website

### Layout Structure
```
┌─────────────────────────────────────┐
│ Content Slider (Food Photos)        │
│ - Signature dishes                  │
├─────────────────────────────────────┤
│ Alert: "New menu items!"            │
├─────────────────────────────────────┤
│ Tabs (Menu Categories)              │
│ ├── Appetizers                      │
│ ├── Main Courses                    │
│ ├── Desserts                        │
│ └── Drinks                          │
├─────────────────────────────────────┤
│ Image Slider (Gallery)              │
│ - Restaurant ambiance               │
│ - Lightbox enabled                  │
├─────────────────────────────────────┤
│ Icon Boxes (Features)               │
│ - Outdoor Seating                   │
│ - Private Events                    │
│ - Catering                          │
├─────────────────────────────────────┤
│ Video Player                         │
│ - Chef's story                      │
├─────────────────────────────────────┤
│ Testimonial Slider (Reviews)        │
├─────────────────────────────────────┤
│ Timeline (Restaurant Journey)       │
├─────────────────────────────────────┤
│ Modal (Reservation Form)            │
├─────────────────────────────────────┤
│ Social Share                         │
└─────────────────────────────────────┘
```

---

## 💡 Best Practices

### Component Spacing
```css
Between sections: 4-6rem
Within sections: 2-3rem
Component margins: 1.5-2rem
```

### Color Usage
- Primary: Main brand color
- Success: Positive actions/states
- Info: Helpful information
- Warning: Important notices
- Danger: Errors/critical items

### Typography Hierarchy
```
H1: Page title (Hero)
H2: Major sections
H3: Subsections (Tabs, Accordion titles)
H4: Icon box titles
H5: Card titles
Body: Descriptions
```

### Mobile Considerations
- Stack columns on mobile
- Reduce slider items
- Simplify timelines to vertical
- Full-width components
- Larger tap targets

### Performance Tips
1. Limit sliders per page: 2-3 max
2. Optimize images before upload
3. Use video thumbnails
4. Lazy load below fold
5. Minimize simultaneous animations

---

## 🎯 Quick Decision Matrix

**Choose Tabs when:**
- Content is equally important
- Users need to switch frequently
- Space is limited

**Choose Accordion when:**
- Content is hierarchical
- Users scan for specific items
- Good for FAQs

**Choose Slider when:**
- Visual content showcase
- Limited space, multiple items
- Automatic rotation desired

**Choose Modal when:**
- Secondary content
- Forms/dialogs
- Don't navigate away

**Choose Timeline when:**
- Chronological information
- History or process flow
- Milestone tracking

---

## 📦 Component Combinations

### High-Converting CTA Section
```
Hero Section
  └── Alert (limited time offer)
  └── Pricing Tables
  └── Modal (sign-up form)
```

### Comprehensive FAQ
```
Tabs (categories)
  └── Accordion (questions)
  └── Video Player (tutorial)
```

### Portfolio Showcase
```
Image Slider (main work)
  └── Lightbox (detailed view)
  └── Modal (project details)
  └── Tabs (project info)
```

### Product Comparison
```
Pricing Tables (plans)
  └── Accordion (detailed features)
  └── Icon Boxes (benefits)
  └── Progress Bars (ratings)
```

---

**Ready to build?** Check the [Quick Reference](COMPONENTS-QUICK-REFERENCE.md) for syntax and [Full Documentation](COMPONENTS.md) for details!

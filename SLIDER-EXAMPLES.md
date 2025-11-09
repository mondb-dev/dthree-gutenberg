# Slider Components - Usage Examples

## Real-World Implementation Examples

### Example 1: Photography Portfolio Homepage

**Goal**: Showcase a photographer's best work with an elegant image gallery.

**Implementation**:
```
1. Add Image Slider block
2. Upload 8-10 high-quality portfolio images (1920x1080)
3. Settings:
   - Height: 700px
   - Transition: Fade
   - Autoplay: Yes
   - Interval: 4000ms (4 seconds)
   - Show Controls: Yes
   - Show Indicators: Yes
4. Add captions: Project name + client
```

**Result**: Full-width, auto-playing portfolio showcase with smooth fade transitions.

---

### Example 2: SaaS Product Landing Page

**Goal**: Create an engaging hero section that highlights product features.

**Implementation**:
```
1. Add Content Slider block
2. Create 3 slides:
   
   Slide 1:
   - Title: "Boost Your Productivity"
   - Description: "Manage tasks, track time, collaborate seamlessly"
   - Button: "Start Free Trial" → /signup
   - Background: Team working on laptops
   - Overlay: 60%
   
   Slide 2:
   - Title: "Trusted by 10,000+ Teams"
   - Description: "From startups to enterprises"
   - Button: "See Case Studies" → /customers
   - Background: Happy customers
   - Overlay: 50%
   
   Slide 3:
   - Title: "Affordable Plans for Everyone"
   - Description: "Starting at just $9/month"
   - Button: "View Pricing" → /pricing
   - Background: Workspace setup
   - Overlay: 55%

3. Settings:
   - Height: 600px
   - Autoplay: Yes
   - Interval: 7000ms
   - Text Alignment: Center
```

**Result**: Professional hero carousel with compelling CTAs.

---

### Example 3: Agency Client Showcase

**Goal**: Display client logos to build credibility.

**Implementation**:
```
1. Add Logo Slider block
2. Section Title: "Trusted by Leading Brands"
3. Upload 15 client logos (SVG format, monochrome)
4. Settings:
   - Items to Show: 5
   - Grayscale: Yes
   - Autoplay: Yes
   - Interval: 3000ms
   - No links (just visual)
```

**Result**: Rotating logo carousel with hover color effect, 5 logos per slide, 3 slides total.

---

### Example 4: E-Commerce Product Showcase

**Goal**: Display featured products in an engaging way.

**Implementation**:
```
1. Add Card Slider block
2. Section Title: "Featured Products"
3. Section Subtitle: "Handpicked just for you"
4. Add 9 product cards:
   
   Card structure:
   - Image: Product photo (square, 800x800)
   - Title: Product name
   - Description: 2-3 sentence overview
   - Button: "Shop Now" → /product/slug
   
5. Settings:
   - Cards Per View: 3
   - Autoplay: No (user controlled)
```

**Result**: 3 product cards visible at once, 3 pages total, manual navigation.

**Responsive**:
- Mobile: 1 card per view
- Tablet: 2 cards per view  
- Desktop: 3 cards per view

---

### Example 5: Service Business Testimonials

**Goal**: Build trust with customer testimonials and reviews.

**Implementation**:
```
1. Add Testimonial Slider block
2. Section Title: "What Our Clients Say"
3. Add 5 testimonials:

   Testimonial 1:
   - Name: "Sarah Johnson"
   - Role: "Marketing Director, TechCorp"
   - Content: "Working with this team transformed our digital presence. Highly recommended!"
   - Image: Professional headshot
   - Rating: 5 stars
   
   Testimonial 2:
   - Name: "Michael Chen"
   - Role: "Founder, StartupXYZ"
   - Content: "Exceptional service and attention to detail. They exceeded our expectations."
   - Image: Professional headshot
   - Rating: 5 stars
   
   [... 3 more similar testimonials]

4. Settings:
   - Style: Centered
   - Show Rating: Yes
   - Autoplay: Yes
   - Interval: 6000ms
```

**Result**: Large, centered testimonials with star ratings, rotating every 6 seconds.

---

### Example 6: Blog Post with Image Gallery

**Goal**: Add a photo gallery to a travel blog post.

**Implementation**:
```
1. Within blog post content, add Image Slider block
2. Upload 6 vacation photos
3. Add descriptive captions:
   - "Sunset at Santorini, Greece"
   - "Traditional Greek taverna"
   - "Blue-domed churches of Oia"
   - etc.
4. Settings:
   - Height: 500px
   - Transition: Slide
   - Autoplay: Yes
   - Interval: 5000ms
   - Show Controls: Yes
   - Show Indicators: Yes
```

**Result**: Interactive photo gallery embedded in blog post.

---

### Example 7: Restaurant Menu Highlights

**Goal**: Showcase signature dishes visually.

**Implementation**:
```
1. Add Card Slider block
2. Section Title: "Chef's Signature Dishes"
3. Add 8 cards (2 per course):
   
   Appetizers:
   - Card 1: "Truffle Risotto"
   - Card 2: "Seared Scallops"
   
   Main Courses:
   - Card 3: "Wagyu Ribeye"
   - Card 4: "Pan-Seared Salmon"
   
   Desserts:
   - Card 5: "Chocolate Lava Cake"
   - Card 6: "Crème Brûlée"
   
   Drinks:
   - Card 7: "Signature Cocktail"
   - Card 8: "House Wine Selection"

4. Settings:
   - Cards Per View: 4
   - Autoplay: No
   - Each card: Image + Title + Description + "Order Now" button
```

**Result**: 4 dishes visible at once, 2 pages of menu items.

---

### Example 8: Educational Platform Course Preview

**Goal**: Highlight available courses with engaging visuals.

**Implementation**:
```
1. Add Content Slider block
2. Create 4 course slides:

   Slide 1 - Web Development:
   - Title: "Full-Stack Web Development"
   - Description: "Learn React, Node.js, and MongoDB"
   - Button: "Enroll Now" → /courses/web-dev
   - Background: Code on screen
   
   Slide 2 - Design:
   - Title: "UI/UX Design Masterclass"
   - Description: "From wireframes to prototypes"
   - Button: "Learn More" → /courses/design
   - Background: Design workspace
   
   [... 2 more courses]

3. Settings:
   - Height: 550px
   - Overlay: 50%
   - Text Alignment: Left
   - Autoplay: Yes
   - Interval: 8000ms
```

**Result**: Professional course carousel with left-aligned text.

---

## Combining Multiple Sliders

### Homepage Layout Example:

```
[Header]

[Content Slider - Hero]
→ 3 slides showcasing main value propositions

[Features Section Block]
→ Static 3-column feature grid

[Card Slider - Services]
→ 6 service cards, 3 per view

[Logo Slider - Clients]
→ Client logos, 5 per slide

[Testimonial Slider - Reviews]
→ Customer testimonials, centered style

[Call-to-Action Block]
→ Static CTA section

[Footer]
```

This creates a dynamic, engaging homepage with variety while maintaining performance.

---

## Performance Optimization Tips

### Image Optimization
```
Before Upload:
1. Resize images to appropriate dimensions
   - Image Slider: 1920x1080
   - Content Slider: 1920x1200
   - Logo Slider: 500x300 max
   - Card Slider: 800x800
   - Testimonials: 300x300

2. Compress images:
   - Use tools like TinyPNG or ImageOptim
   - Target: < 200KB per image
   - Format: JPG for photos, PNG for graphics, SVG for logos

3. Use WebP format when possible for modern browsers
```

### Slider Optimization
```
Best Practices:
- Limit to 3-8 slides per slider
- Use autoplay strategically (not on every slider)
- Set appropriate intervals (5000-8000ms)
- Don't stack multiple auto-playing sliders
- Use lazy loading for images
```

---

## Common Layouts

### Full-Width Homepage Slider
```css
/* Remove container padding */
.wp-block-dthree-content-slider {
    margin-left: -15px;
    margin-right: -15px;
}

@media (min-width: 768px) {
    .wp-block-dthree-content-slider {
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
    }
}
```

### Centered Logo Slider
```css
.dthree-logo-slider-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 4rem 2rem;
}
```

### Sidebar Testimonial Widget
```
1. Go to Appearance → Widgets
2. Add Testimonial Slider to Sidebar
3. Configure with 3 short testimonials
4. Style: Minimal
5. Narrow width optimized
```

---

## Accessibility Examples

### Adding Screen Reader Text
```php
// In your child theme functions.php
add_filter('dthree_slider_controls_text', function($text, $direction) {
    return sprintf(
        __('Navigate to %s testimonial', 'your-theme'),
        $direction === 'next' ? __('next', 'your-theme') : __('previous', 'your-theme')
    );
}, 10, 2);
```

### Keyboard Navigation Enhancement
```javascript
// Add custom keyboard controls
document.addEventListener('keydown', function(e) {
    const slider = document.querySelector('.dthree-content-slider');
    if (!slider) return;
    
    if (e.key === 'ArrowLeft') {
        bootstrap.Carousel.getInstance(slider).prev();
    } else if (e.key === 'ArrowRight') {
        bootstrap.Carousel.getInstance(slider).next();
    } else if (e.key === ' ') {
        e.preventDefault();
        const instance = bootstrap.Carousel.getInstance(slider);
        instance._isPaused ? instance.cycle() : instance.pause();
    }
});
```

---

## Mobile-First Example

### Responsive Card Slider
```
Desktop (1200px+): 4 cards per view
Tablet (768-1199px): 3 cards per view
Mobile Landscape (576-767px): 2 cards per view
Mobile Portrait (<576px): 1 card per view

Implementation:
- Set "Cards Per View" to 4
- Bootstrap automatically adjusts for smaller screens
- Test on actual devices
```

---

## Integration with Other Blocks

### Example: Combined Landing Page Section
```
[Content Slider]
→ Hero with 3 slides

[Spacer - 60px]

[Heading]
→ "Why Choose Us"

[Card Slider]
→ 6 benefit cards

[Spacer - 60px]

[Testimonial Slider]
→ Customer reviews

[Spacer - 60px]

[Call-to-Action Block]
→ Final conversion CTA
```

This creates a complete landing page flow with variety and engagement.

---

## Need Help?

For more examples and support:
- 📖 Full Documentation: `SLIDER-COMPONENTS.md`
- 🚀 Quick Reference: `SLIDER-QUICK-REFERENCE.md`
- 🎨 Design System: See `DESIGN-SYSTEM.md`
- 💬 Support: Create an issue in the theme repository

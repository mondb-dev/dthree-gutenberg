# Slider Components - Quick Reference

## At a Glance

| Slider | Best For | Key Features | Default Interval |
|--------|----------|--------------|------------------|
| **Image Slider** | Photo galleries, portfolios | Captions, slide/fade effects | 5s |
| **Content Slider** | Hero sections, banners | Text + CTA + images | 7s |
| **Logo Slider** | Client/partner logos | Grayscale hover effect | 3s |
| **Card Slider** | Products, services | Cards with CTAs | Manual |
| **Testimonial Slider** | Reviews, social proof | 3 styles, star ratings | 6s |

## Quick Setup Examples

### Image Slider
```
1. Add "Image Slider" block
2. Click "Add Images" → Select 3-5 photos
3. Add captions (optional)
4. Toggle autoplay ON
5. Publish!
```

### Content Slider
```
1. Add "Content Slider" block
2. Edit first slide:
   - Title: "Welcome to Our Site"
   - Description: "Discover amazing features"
   - Button: "Get Started" → /contact
   - Upload background image
3. Add 2-3 more slides
4. Adjust overlay opacity: 50%
5. Publish!
```

### Logo Slider
```
1. Add "Logo Slider" block
2. Set title: "Trusted By"
3. Upload 5-10 client logos
4. Enable grayscale effect
5. Set 5 logos per slide
6. Publish!
```

### Card Slider
```
1. Add "Card Slider" block
2. Title: "Our Services"
3. Add 6 cards:
   - Upload card image
   - Title + short description
   - CTA button
4. Set 3 cards per view
5. Publish!
```

### Testimonial Slider
```
1. Add "Testimonial Slider" block
2. Title: "What Clients Say"
3. Add 3-5 testimonials:
   - Customer name + role
   - Quote text
   - Photo (optional)
   - 5-star rating
4. Choose style: "Centered"
5. Publish!
```

## Common Settings

### All Sliders
- **Autoplay**: ON/OFF
- **Interval**: Milliseconds (3000 = 3 seconds)
- **Alignment**: Wide, Full Width

### Image & Content Sliders
- **Height**: Pixels (500-800 recommended)
- **Controls**: Show/hide arrows
- **Indicators**: Show/hide dots

### Logo Slider
- **Items to Show**: 2-6 logos per slide
- **Grayscale**: ON/OFF

### Card Slider
- **Cards Per View**: 1-4
- **Section Title**: Optional heading
- **Section Subtitle**: Optional subheading

### Testimonial Slider
- **Style**: Centered, Cards, Minimal
- **Show Rating**: ON/OFF (star display)

## Responsive Behavior

| Screen Size | Image/Content | Logo (5 items) | Cards (3 per view) | Testimonials |
|-------------|---------------|----------------|---------------------|--------------|
| Mobile      | Full width    | 2-3 logos      | 1 card             | Full width   |
| Tablet      | Full width    | 4 logos        | 2 cards            | Full width   |
| Desktop     | Full width    | 5 logos        | 3 cards            | Centered     |

## CSS Quick Tweaks

### Change Slider Border Radius
```css
.dthree-image-slider,
.dthree-content-slider {
    border-radius: 20px;
}
```

### Adjust Logo Size
```css
.dthree-logo-slider .logo-image {
    max-height: 100px;
    max-width: 200px;
}
```

### Card Hover Effect Speed
```css
.dthree-slider-card {
    transition: transform 0.5s ease;
}
```

### Testimonial Background
```css
.dthree-testimonial-slider-section {
    background: #f0f0f0;
}
```

## Keyboard Shortcuts

- **←** (Left Arrow): Previous slide
- **→** (Right Arrow): Next slide
- **Tab**: Navigate to controls
- **Enter/Space**: Activate button

## Common Issues & Fixes

### Issue: Autoplay not working
**Fix**: Enable autoplay in block settings, set interval to 3000+

### Issue: Images different sizes
**Fix**: Crop all images to same aspect ratio before upload

### Issue: Text hard to read on Content Slider
**Fix**: Increase overlay opacity to 60-80%

### Issue: Too many logos per slide
**Fix**: Reduce "Items to Show" to 3-4 for better mobile view

### Issue: Testimonials too long
**Fix**: Keep quotes under 200 characters, break into multiple testimonials

## Pro Tips

✅ **Image Slider**: Use 16:9 ratio images (1920x1080)  
✅ **Content Slider**: Max 5 slides for best UX  
✅ **Logo Slider**: SVG logos look best at any size  
✅ **Card Slider**: Keep descriptions similar length  
✅ **Testimonial Slider**: Real photos build more trust  

## Block Names (for developers)

- `dthree/image-slider`
- `dthree/content-slider`
- `dthree/logo-slider`
- `dthree/card-slider`
- `dthree/testimonial-slider`

## File Locations

```
/inc/blocks/image-slider.php
/inc/blocks/content-slider.php
/inc/blocks/logo-slider.php
/inc/blocks/card-slider.php
/inc/blocks/testimonial-slider.php
/assets/css/sliders.css
```

## Need More Help?

📖 Full Documentation: `SLIDER-COMPONENTS.md`  
🔧 Technical Docs: `TECHNICAL-DOCUMENTATION.md`  
🚀 Quick Start: `QUICK-START.md`

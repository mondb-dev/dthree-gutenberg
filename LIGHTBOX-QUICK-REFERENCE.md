# Lightbox - Quick Reference

## Instant Setup ✨

Lightbox is **already enabled** - just add images and it works automatically!

---

## Quick Start (30 seconds)

### WordPress Gallery
```
1. Add Gallery block
2. Select 3-5 images
3. Publish
4. Click any image → Lightbox opens!
```

### Single Image with Lightbox
```html
<img src="photo.jpg" data-lightbox="true" alt="My Photo" />
```

### Gallery Shortcode
```
[lightbox_gallery ids="12,34,56" columns="3"]
```

---

## Common Use Cases

### Photography Portfolio
```
✓ Create Gallery block
✓ Upload 10-20 photos
✓ Lightbox auto-enables
✓ Click photo to view full-screen
```

### Product Images
```html
<img src="product.jpg" 
     data-lightbox="true"
     data-full-url="product-hd.jpg"
     data-caption="Premium Widget - $99" />
```

### Blog Post Images
```
✓ Add images to post content
✓ Lightbox automatically added
✓ No coding required!
```

---

## Keyboard Shortcuts

| Key | Action |
|-----|--------|
| **ESC** | Close lightbox |
| **←** | Previous image |
| **→** | Next image |
| **+** | Zoom in |
| **-** | Zoom out |
| **0** | Reset zoom |

---

## HTML Attributes

```html
data-lightbox="true"              ← Enable lightbox
data-full-url="full-image.jpg"    ← Full-size URL
data-caption="Photo caption"      ← Caption text
```

---

## Shortcodes

### Single Image
```
[lightbox src="image.jpg" caption="My Photo"]
```

### Gallery
```
[lightbox_gallery ids="1,2,3" columns="3"]
```

**Parameters:**
- `ids` - Comma-separated image IDs
- `columns` - 2, 3, 4, or 6
- `size` - thumbnail, medium, large

---

## Disable Lightbox

### For Single Image
```html
<img src="logo.jpg" class="no-lightbox" />
```

### For Entire Page
```php
// In template file
<style>.dthree-lightbox { display: none !important; }</style>
```

---

## Styling Cheat Sheet

### Dark Overlay
```css
.dthree-lightbox {
    background: rgba(0, 0, 0, 0.98);
}
```

### Light Overlay
```css
.dthree-lightbox {
    background: rgba(255, 255, 255, 0.95);
}
```

### Hide Zoom Controls
```css
.dthree-lightbox-zoom {
    display: none;
}
```

### Hide Thumbnails
```css
.dthree-lightbox-thumbnails {
    display: none;
}
```

### Custom Button Colors
```css
.dthree-lightbox-close,
.dthree-lightbox-prev,
.dthree-lightbox-next {
    background: rgba(255, 0, 0, 0.3);
    border-color: rgba(255, 0, 0, 0.6);
}
```

---

## Troubleshooting

### Issue: Lightbox not opening
**Fix:** Add `data-lightbox="true"` to image

### Issue: Low resolution image
**Fix:** Add `data-full-url="hires.jpg"`

### Issue: No caption
**Fix:** Add `data-caption="Text here"`

### Issue: Specific image shouldn't have lightbox
**Fix:** Add class `no-lightbox`

---

## PHP Function (Advanced)

```php
<?php
echo dthree_get_lightbox_image( 
    123,      // Image ID
    'large'   // Size
);
?>
```

---

## Auto-Enabled On

✅ WordPress Gallery blocks  
✅ Classic galleries  
✅ Image sliders  
✅ Post content images  
✅ Images with `data-lightbox`  

---

## Browser Support

✅ Chrome, Firefox, Safari, Edge  
✅ Mobile browsers (iOS, Android)  
✅ Touch/swipe support  

---

## Features at a Glance

✅ Full-screen viewing  
✅ Gallery navigation  
✅ Image zoom (up to 3x)  
✅ Drag to pan  
✅ Thumbnail strip  
✅ Captions  
✅ Counter (1/10)  
✅ Keyboard navigation  
✅ Accessible (ARIA, screen readers)  
✅ Responsive  
✅ Fast (no dependencies)  

---

## 5 Quick Examples

### Example 1: Simple Gallery
```
[lightbox_gallery ids="10,20,30,40,50" columns="5"]
```

### Example 2: With Caption
```html
<img src="sunset.jpg" 
     data-lightbox="true" 
     data-caption="Beautiful sunset in Malibu" />
```

### Example 3: High-Res Preview
```html
<img src="thumb.jpg" 
     data-lightbox="true"
     data-full-url="8k-image.jpg" />
```

### Example 4: Portfolio Grid
```html
<div class="row">
    <div class="col-md-4">
        <img src="project1.jpg" data-lightbox="true" />
    </div>
    <div class="col-md-4">
        <img src="project2.jpg" data-lightbox="true" />
    </div>
    <div class="col-md-4">
        <img src="project3.jpg" data-lightbox="true" />
    </div>
</div>
```

### Example 5: Blog Post Gallery
```
1. In post editor, add Gallery block
2. Upload 6 photos
3. Set columns to 3
4. Publish → Lightbox works!
```

---

## Performance Tips

✅ Optimize images (compress before upload)  
✅ Use appropriate sizes (don't upload 10MB photos)  
✅ Max 20 images per gallery  
✅ WebP format recommended  

**Recommended Sizes:**
- Thumbnail: 400×300, ~50KB
- Full-size: 1920×1440, ~200KB

---

## Next Steps

📖 **Full docs:** LIGHTBOX.md  
💡 **Examples:** LIGHTBOX-EXAMPLES.md  
🎨 **Styling:** Custom CSS in Customizer  

---

## Quick Help

**Not working?** Check browser console for errors  
**Need custom style?** Use Customizer → Additional CSS  
**Want more control?** See LIGHTBOX.md  
**Report bug?** GitHub issues  

---

**That's it! Lightbox is ready to use. Just add images! 🎉**

# Performance Optimization Guide

Complete guide to achieving excellent Core Web Vitals scores and optimal page loading speed with DThree Gutenberg theme.

## 🎯 Core Web Vitals Targets

### What Are Core Web Vitals?

Google's Core Web Vitals are essential metrics for measuring user experience:

| Metric | Target | What It Measures |
|--------|--------|------------------|
| **LCP** (Largest Contentful Paint) | < 2.5s | Loading performance |
| **FID** (First Input Delay) | < 100ms | Interactivity |
| **CLS** (Cumulative Layout Shift) | < 0.1 | Visual stability |
| **INP** (Interaction to Next Paint) | < 200ms | Responsiveness |

### Why They Matter

- **SEO Rankings** - Google uses Core Web Vitals as ranking factors
- **User Experience** - Faster sites = higher engagement
- **Conversion Rates** - 1 second delay = 7% reduction in conversions
- **Mobile Performance** - Critical for mobile-first indexing

---

## ✅ Built-In Optimizations

### Automatically Applied

The theme includes these optimizations out-of-the-box:

#### 1. **Critical CSS Inlining**
```
✓ Inlines essential styles in <head>
✓ Eliminates render-blocking CSS
✓ Improves First Contentful Paint (FCP)
✓ Reduces LCP by ~300-500ms
```

#### 2. **Script Deferral**
```
✓ Defers non-critical JavaScript
✓ Reduces Total Blocking Time (TBT)
✓ Improves First Input Delay (FID)
✓ Pages interactive 40% faster
```

#### 3. **Native Lazy Loading**
```
✓ Images load only when visible
✓ Reduces initial page weight by 50-70%
✓ Saves bandwidth for users
✓ Improves LCP for below-fold content
```

#### 4. **Image Dimension Attributes**
```
✓ Automatic width/height on all images
✓ Prevents layout shifts (CLS = 0)
✓ Browser reserves space before loading
✓ Critical for mobile performance
```

#### 5. **Resource Optimization**
```
✓ Removes emoji scripts (-15KB)
✓ Disables WordPress embeds
✓ Removes unnecessary <head> tags
✓ Optimizes Heartbeat API
✓ Limits post revisions
```

#### 6. **Smart Preloading**
```
✓ DNS prefetch for external resources
✓ Preconnect to font providers
✓ Preload hero images
✓ Resource hints for faster loading
```

---

## ⚙️ Optional Optimizations

### Enable in Customizer

Go to **Appearance → Customize → Performance Optimization**

#### 1. **HTML Minification**
```
Effect: Reduces HTML file size by ~10%
Speed Gain: 50-100ms faster download
Trade-off: Harder to debug (disable for development)
Recommendation: Enable for production sites
```

#### 2. **CSS Combination**
```
Effect: Combines multiple CSS files into one
Speed Gain: Reduces HTTP requests by 4-5
Trade-off: May increase initial payload slightly
Recommendation: Test with your specific content
```

#### 3. **Web Vitals Monitoring**
```
Effect: Logs Core Web Vitals to browser console
Speed Gain: None (for monitoring only)
Trade-off: Small JavaScript overhead
Recommendation: Enable only during development
```

---

## 🚀 Recommended Plugin Stack

### Essential Plugins

#### **1. Caching Plugin** (Choose One)

**WP Rocket** (Premium - $59/year)
```
✓ Page caching (2-3x faster)
✓ GZIP compression
✓ Database optimization
✓ CDN integration
✓ Lazy loading boost

Speed Gain: 200-400% improvement
Setup Time: 5 minutes
Recommendation: Best overall performance
```

**W3 Total Cache** (Free)
```
✓ Page caching
✓ Browser caching
✓ Object caching
✓ Minification

Speed Gain: 150-300% improvement
Setup Time: 15-20 minutes
Recommendation: Best free option
```

**WP Super Cache** (Free)
```
✓ Simple page caching
✓ Easy configuration
✓ Reliable

Speed Gain: 100-200% improvement
Setup Time: 2 minutes
Recommendation: Easiest to set up
```

#### **2. Image Optimization** (Choose One)

**ShortPixel** (Freemium)
```
✓ Automatic WebP conversion
✓ Lossy/lossless compression
✓ Bulk optimization
✓ 100 images/month free

File Size Reduction: 40-60%
Speed Gain: 300-600ms LCP improvement
```

**Smush** (Free)
```
✓ Lossless compression
✓ Lazy loading
✓ Bulk optimization
✓ 50 images at a time

File Size Reduction: 25-35%
Speed Gain: 200-400ms LCP improvement
```

**Imagify** (Freemium)
```
✓ WebP conversion
✓ Three optimization levels
✓ Bulk optimization
✓ 20MB/month free

File Size Reduction: 35-50%
Speed Gain: 250-500ms LCP improvement
```

#### **3. CDN (Content Delivery Network)**

**Cloudflare** (Free tier available)
```
✓ Global CDN (200+ locations)
✓ DDoS protection
✓ SSL certificate
✓ Free tier: Unlimited bandwidth

Speed Gain: 30-50% improvement for global users
TTFB Improvement: 100-300ms
Recommendation: Essential for international sites
```

**StackPath** (Paid - from $10/month)
```
✓ Premium CDN
✓ Edge computing
✓ Better support

Speed Gain: 40-60% improvement
Recommendation: For high-traffic sites
```

---

## 📊 Performance Checklist

### Pre-Launch Optimization

#### Images
- [ ] Convert all images to WebP format
- [ ] Compress images to <200KB each
- [ ] Add width/height to all `<img>` tags
- [ ] Use appropriate image sizes (no 4000px for 400px display)
- [ ] Enable lazy loading (automatic in theme)

#### CSS
- [ ] Remove unused CSS from plugins
- [ ] Inline critical CSS (automatic in theme)
- [ ] Enable CSS minification (optional setting)
- [ ] Combine CSS files (optional setting)

#### JavaScript
- [ ] Defer non-critical scripts (automatic in theme)
- [ ] Remove unused JavaScript
- [ ] Minimize third-party scripts (Google Analytics, Facebook Pixel)
- [ ] Use async/defer attributes

#### Fonts
- [ ] Limit to 2 font families maximum
- [ ] Use only needed font weights
- [ ] Preload font files (automatic in theme)
- [ ] Consider system fonts for body text

#### Server
- [ ] Enable GZIP compression
- [ ] Set up browser caching (.htaccess rules provided)
- [ ] Enable HTTP/2
- [ ] Use PHP 8.0+ (20-30% faster than PHP 7.4)

#### WordPress
- [ ] Install caching plugin
- [ ] Optimize database (WP-Optimize)
- [ ] Remove unused plugins
- [ ] Limit post revisions (automatic in theme)
- [ ] Clean up media library

---

## 🧪 Testing & Monitoring

### Testing Tools

#### **1. Google PageSpeed Insights**
```
URL: https://pagespeed.web.dev/
Tests: Desktop + Mobile
Metrics: All Core Web Vitals
Recommendations: Specific optimization tips
```

#### **2. GTmetrix**
```
URL: https://gtmetrix.com/
Tests: Performance + Structure
Metrics: LCP, TBT, CLS, Speed Index
Waterfall: Detailed resource loading
```

#### **3. WebPageTest**
```
URL: https://webpagetest.org/
Tests: Multi-location, multi-device
Metrics: Detailed filmstrip view
Advanced: Custom scripts, throttling
```

#### **4. Chrome DevTools**
```
Access: F12 → Lighthouse tab
Tests: Performance, Accessibility, SEO
Metrics: All Core Web Vitals
Live: Real-time performance monitoring
```

### Target Scores

| Tool | Target Score | Excellent Score |
|------|--------------|-----------------|
| PageSpeed Insights | 90+ | 95+ |
| GTmetrix | A | A |
| WebPageTest | B+ | A |
| Lighthouse | 90+ | 95+ |

### Testing Workflow

1. **Test Baseline**
   - Run PageSpeed Insights before optimization
   - Document current scores
   - Identify bottlenecks

2. **Apply Optimizations**
   - Enable caching
   - Optimize images
   - Configure CDN
   - Test after each major change

3. **Re-test**
   - Clear cache before testing
   - Test multiple pages (home, blog, single)
   - Test on mobile and desktop
   - Test from different locations

4. **Monitor Ongoing**
   - Weekly PageSpeed tests
   - Monthly GTmetrix reports
   - Check Search Console Core Web Vitals

---

## 📈 Expected Performance

### With Theme Defaults Only

```
PageSpeed Score: 75-85
LCP: 2.5-3.5s
FID: 50-100ms
CLS: 0.05-0.15
Page Size: 800KB-1.2MB
Requests: 25-35
Load Time: 2-3s
```

### With Caching Plugin

```
PageSpeed Score: 85-92
LCP: 1.5-2.5s
FID: 20-50ms
CLS: 0.02-0.08
Page Size: 600KB-900KB
Requests: 20-30
Load Time: 1-2s
```

### With Full Optimization Stack

```
PageSpeed Score: 92-98
LCP: 0.8-1.5s
FID: 10-30ms
CLS: 0.01-0.05
Page Size: 300KB-600KB
Requests: 15-20
Load Time: 0.5-1s
```

---

## 🔧 Advanced Optimizations

### .htaccess Rules

Add to your `.htaccess` file (Apache servers):

```apache
# GZIP Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/css text/javascript application/javascript application/json
</IfModule>

# Browser Caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>

# Cache-Control Headers
<IfModule mod_headers.c>
    <FilesMatch "\.(webp|jpg|png|gif)$">
        Header set Cache-Control "max-age=31536000, public"
    </FilesMatch>
</IfModule>
```

### Database Optimization

Run these SQL queries (backup first!):

```sql
-- Clean post revisions
DELETE FROM wp_posts WHERE post_type = 'revision';

-- Clean auto-drafts
DELETE FROM wp_posts WHERE post_status = 'auto-draft';

-- Clean spam comments
DELETE FROM wp_comments WHERE comment_approved = 'spam';

-- Optimize tables
OPTIMIZE TABLE wp_posts, wp_postmeta, wp_comments, wp_options;
```

### PHP Configuration

Add to `wp-config.php`:

```php
// Increase PHP memory limit
define( 'WP_MEMORY_LIMIT', '256M' );

// Limit post revisions
define( 'WP_POST_REVISIONS', 3 );

// Set autosave interval (seconds)
define( 'AUTOSAVE_INTERVAL', 300 );

// Enable object caching (with Redis/Memcached)
define( 'WP_CACHE', true );
```

---

## 🐛 Troubleshooting

### Common Issues

#### **Issue: High LCP (> 4 seconds)**
```
Causes:
- Large hero image (> 500KB)
- Render-blocking CSS
- Slow server response

Solutions:
✓ Compress hero image to <200KB WebP
✓ Use CDN for images
✓ Enable page caching
✓ Preload hero image
```

#### **Issue: Poor CLS (> 0.25)**
```
Causes:
- Images without width/height
- Ads/embeds loading late
- Web fonts causing FOIT

Solutions:
✓ Add dimensions to all images (automatic)
✓ Reserve space for ads
✓ Use font-display: swap
✓ Avoid inject content above fold
```

#### **Issue: High FID (> 300ms)**
```
Causes:
- Large JavaScript bundles
- Long-running scripts
- Third-party scripts blocking

Solutions:
✓ Defer non-critical scripts (automatic)
✓ Remove unused plugins
✓ Minimize third-party scripts
✓ Use async for analytics
```

#### **Issue: Large Page Size (> 2MB)**
```
Causes:
- Unoptimized images
- Multiple sliders
- Too many fonts

Solutions:
✓ Compress all images
✓ Limit sliders to 5-7 slides
✓ Use 1-2 font families
✓ Remove unused CSS
```

---

## 📚 Additional Resources

### Documentation
- [Google Web Vitals Guide](https://web.dev/vitals/)
- [WordPress Performance Best Practices](https://developer.wordpress.org/advanced-administration/performance/)
- [Image Optimization Guide](https://web.dev/fast/#optimize-your-images)

### Tools
- [WebP Converter](https://squoosh.app/)
- [CSS Minifier](https://cssminifier.com/)
- [JavaScript Minifier](https://javascript-minifier.com/)

### WordPress Plugins
- [Query Monitor](https://wordpress.org/plugins/query-monitor/) - Debug performance issues
- [WP-Optimize](https://wordpress.org/plugins/wp-optimize/) - Database optimization
- [Asset CleanUp](https://wordpress.org/plugins/wp-asset-clean-up/) - Remove unused CSS/JS

---

## ✅ Performance Maintenance

### Weekly Tasks
- [ ] Test homepage speed (PageSpeed Insights)
- [ ] Check for broken images
- [ ] Clear expired transients
- [ ] Review slow queries (Query Monitor)

### Monthly Tasks
- [ ] Full site speed audit (GTmetrix)
- [ ] Database optimization
- [ ] Remove unused media files
- [ ] Update plugins/themes
- [ ] Check Core Web Vitals in Search Console

### Quarterly Tasks
- [ ] Re-optimize all images
- [ ] Review and remove unused plugins
- [ ] Test on latest browsers/devices
- [ ] Evaluate CDN performance
- [ ] Review caching configuration

---

**Remember:** Performance is ongoing. Test regularly, optimize incrementally, and monitor Core Web Vitals in Google Search Console.

**Theme Version:** 1.2.0+  
**Last Updated:** November 9, 2025  
**Built by:** [Dthree Digital](https://dthree.com.ph)
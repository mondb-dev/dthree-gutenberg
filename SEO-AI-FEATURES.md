# SEO & AI Features Documentation

Complete guide to the advanced on-page SEO and AI-friendly features in DThree Gutenberg theme.

## 📋 Table of Contents

1. [On-Page SEO Features](#on-page-seo-features)
2. [AI-Friendly Features](#ai-friendly-features)
3. [Custom SEO Meta Box](#custom-seo-meta-box)
4. [Schema.org Structured Data](#schemaorg-structured-data)
5. [AI Crawler Control](#ai-crawler-control)
6. [Best Practices](#best-practices)

---

## On-Page SEO Features

### Automatic Meta Tags

The theme automatically generates comprehensive meta tags for every page:

#### Basic Meta Tags
- **Meta Description**: Auto-generated from excerpt or content (160 chars max)
- **Canonical URL**: Prevents duplicate content issues
- **Robots Meta**: Controls indexing behavior
- **Content Language**: Specifies page language

#### Open Graph Tags (Facebook)
```html
<meta property="og:type" content="article">
<meta property="og:title" content="Page Title">
<meta property="og:description" content="Description">
<meta property="og:url" content="https://...">
<meta property="og:image" content="https://...">
<meta property="og:site_name" content="Site Name">
```

#### Twitter Cards
```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Page Title">
<meta name="twitter:description" content="Description">
<meta name="twitter:image" content="https://...">
```

#### Article-Specific Tags
```html
<meta property="article:published_time" content="2024-01-01T10:00:00+00:00">
<meta property="article:modified_time" content="2024-01-15T15:30:00+00:00">
<meta property="article:author" content="Author Name">
<meta property="article:section" content="Category">
<meta property="article:tag" content="Tag1, Tag2">
```

### Title Tag Optimization

Automatically optimized title tags:
- **Posts**: `Post Title | Site Name`
- **Pages**: `Page Title | Site Name`
- **Home**: `Site Name | Site Description`
- **Custom**: Override via SEO meta box

### Canonical URLs

Prevents duplicate content issues:
- Automatically added to all pages
- Points to the original URL
- Helps search engines understand primary version

---

## AI-Friendly Features

### Enhanced Meta Tags for AI

#### Content Metrics
```html
<meta name="content-type" content="post">
<meta name="reading-time" content="5 minutes">
<meta name="word-count" content="1200">
<meta name="content-freshness" content="fresh">
```

#### Content Outline
```html
<meta name="content-outline" content='["Introduction", "Main Topic", "Conclusion"]'>
```

### AI-Specific HTTP Headers

```http
X-Content-Type: article
X-Reading-Time: 5 minutes
X-Last-Updated: 2024-01-15T15:30:00+00:00
X-AI-Friendly: true
```

### Semantic HTML5 Structure

Content is wrapped in semantic HTML with microdata:

```html
<article role="article" 
         itemscope 
         itemtype="https://schema.org/Article"
         data-word-count="1200"
         data-reading-time="5">
  
  <div class="article-summary" itemprop="description">
    <!-- Excerpt -->
  </div>
  
  <div class="article-body" itemprop="articleBody">
    <!-- Main content -->
  </div>
  
  <div class="ai-content-summary" data-purpose="ai-extraction">
    <!-- Extractive summary for AI -->
  </div>
</article>
```

### Image Data Attributes

Every image gets AI-helpful attributes:

```html
<img src="image.jpg"
     alt="Descriptive alt text"
     data-width="1200"
     data-height="800"
     data-aspect-ratio="1.5"
     data-filesize="245 KB"
     data-context="Article Title">
```

### Content Analysis Features

#### Auto-Generated Table of Contents
Extracted from H2-H6 headings and included in:
- JSON-LD schema
- Meta tags
- Data attributes

#### FAQ Detection
Automatically detects FAQ patterns and generates FAQPage schema:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is this?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "This is the answer..."
      }
    }
  ]
}
</script>
```

---

## Custom SEO Meta Box

### Location

Edit any post or page → Scroll to **SEO Settings** meta box

### Fields

#### 1. Meta Title (Optional)
- **Max Length**: 60 characters
- **Character Counter**: Real-time feedback
- **Default**: Uses post title if empty
- **Purpose**: Customize title tag for search results

```
Example:
Custom Title: "Best WordPress Themes 2024 - Complete Guide"
(Shows as: Best WordPress Themes 2024 - Complete Guide | Site Name)
```

#### 2. Meta Description
- **Recommended Length**: 150-160 characters
- **Character Counter**: Visual warning when approaching limit
- **Default**: Auto-generated from excerpt/content
- **Purpose**: Appears in search engine results

```
Example:
"Discover the top 10 WordPress themes for 2024. Compare features, 
pricing, and performance to find the perfect theme for your website."
```

#### 3. Focus Keyword
- **Purpose**: Track main keyword for the content
- **Usage**: Helps maintain topical focus
- **AI Benefit**: Helps AI understand primary topic

```
Example:
Focus Keyword: "wordpress themes 2024"
```

#### 4. No-Index Checkbox
- **Purpose**: Prevent search engines from indexing
- **Use Cases**:
  - Thank you pages
  - Private content
  - Duplicate content
  - Test pages

### How to Use

1. Create/edit a post or page
2. Scroll to "SEO Settings" meta box
3. Fill in custom meta title (optional)
4. Write compelling meta description
5. Add focus keyword
6. Check no-index if needed
7. Save/update post

---

## Schema.org Structured Data

### Article Schema

Automatically added to all posts:

```json
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Post Title",
  "description": "Post description",
  "articleBody": "Full text content",
  "datePublished": "2024-01-01T10:00:00+00:00",
  "dateModified": "2024-01-15T15:30:00+00:00",
  "wordCount": 1200,
  "timeRequired": "PT5M",
  "author": {
    "@type": "Person",
    "name": "Author Name",
    "url": "https://..."
  },
  "publisher": {
    "@type": "Organization",
    "name": "Site Name"
  },
  "image": "https://...",
  "articleSection": ["Category1", "Category2"],
  "keywords": ["tag1", "tag2", "tag3"],
  "hasPart": [
    {
      "@type": "WebPageElement",
      "name": "Section 1",
      "position": 2
    }
  ]
}
```

### WebPage Schema

Automatically added to pages:

```json
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Page Title",
  "description": "Page description",
  "url": "https://..."
}
```

### WebSite Schema

Added to homepage:

```json
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Site Name",
  "url": "https://...",
  "description": "Site tagline",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "https://.../?s={search_term_string}"
    }
  }
}
```

### Organization Schema

Added to all pages:

```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Site Name",
  "url": "https://...",
  "logo": "https://.../logo.png",
  "sameAs": [
    "https://facebook.com/...",
    "https://twitter.com/...",
    "https://linkedin.com/..."
  ]
}
```

### Breadcrumb Schema

Added to singular pages:

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://..."
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Category",
      "item": "https://..."
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Current Page"
    }
  ]
}
```

### FAQ Schema

Auto-detected from content with question patterns:

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Question text?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Answer text"
      }
    }
  ]
}
```

---

## AI Crawler Control

### Robots.txt Enhancements

Specific rules for AI crawlers:

```
# AI Crawler Specific Rules
User-agent: GPTBot
User-agent: ChatGPT-User
User-agent: CCBot
User-agent: anthropic-ai
User-agent: Claude-Web
Allow: /

Crawl-delay: 1

Sitemap: https://yoursite.com/wp-sitemap.xml
```

### AI Training Control

Control whether AI can train on your content:

**Location**: Appearance → Customize → AI & Search Settings

#### Allow AI Training (Default: ON)
- When **enabled**: AI crawlers can use your content for training
- When **disabled**: Adds `noai` and `noimageai` robots meta tags

```html
<!-- When disabled -->
<meta name="robots" content="noai, noimageai">
<meta name="ai-training" content="opt-out">
```

### Sitemap Enhancements

WordPress sitemap entries enhanced with AI-useful data:

```xml
<url>
  <loc>https://...</loc>
  <lastmod>2024-01-15</lastmod>
  <reading_time>5</reading_time>
  <content_type>post</content_type>
  <word_count>1200</word_count>
</url>
```

---

## Best Practices

### Writing Meta Descriptions

✅ **Good Meta Description:**
```
"Learn how to optimize WordPress for speed with our 2024 guide. 
Discover 15 proven techniques to reduce load times by up to 50%."
```

❌ **Bad Meta Description:**
```
"This post talks about WordPress speed. Click here to read more."
```

**Tips:**
- Include target keyword naturally
- Be specific and actionable
- Keep 150-160 characters
- Make it compelling
- Avoid keyword stuffing
- Don't duplicate title

### Optimizing for AI

#### 1. Use Clear Headings
```html
<!-- Good -->
<h2>How to Install WordPress</h2>
<h3>Step 1: Download WordPress</h3>

<!-- Bad -->
<h2>Getting Started</h2>
<h3>First Thing</h3>
```

#### 2. Write Clear Questions for FAQs
```html
<!-- Good -->
<h3>What is WordPress?</h3>
<p>WordPress is a content management system...</p>

<!-- Bad -->
<h3>About WordPress</h3>
<p>WordPress...</p>
```

#### 3. Add Excerpts
Always write custom excerpts for posts:
- More accurate than auto-generated
- Used in meta description
- Appears in AI summaries

#### 4. Use Descriptive Alt Text
```html
<!-- Good -->
<img alt="WordPress dashboard showing plugin installation screen">

<!-- Bad -->
<img alt="screenshot">
```

### SEO Checklist

#### Before Publishing

- [ ] Write compelling title (under 60 chars)
- [ ] Write meta description (150-160 chars)
- [ ] Add focus keyword
- [ ] Add custom excerpt
- [ ] Choose relevant category
- [ ] Add 3-5 relevant tags
- [ ] Add featured image (1200x630px)
- [ ] Use clear H2-H6 headings
- [ ] Add alt text to all images
- [ ] Internal link to related content
- [ ] Check content is 300+ words
- [ ] Proofread for errors

#### After Publishing

- [ ] Test in Google Search Console
- [ ] Check mobile-friendliness
- [ ] Verify Open Graph preview
- [ ] Test Twitter Card
- [ ] Check structured data (Rich Results Test)
- [ ] Verify sitemap inclusion
- [ ] Monitor indexing status

### Common Mistakes to Avoid

1. **Duplicate Meta Descriptions**
   - Each page needs unique description
   - Don't copy-paste from other pages

2. **Keyword Stuffing**
   - Use keywords naturally
   - Focus on readability first

3. **Missing Alt Text**
   - All images need descriptive alt text
   - Important for accessibility and SEO

4. **Thin Content**
   - Aim for 300+ words minimum
   - Provide comprehensive information

5. **Ignoring Mobile**
   - Test on mobile devices
   - Ensure responsive images

6. **No Internal Links**
   - Link to related content
   - Helps users and search engines

---

## Technical Details

### Files Involved

- `/inc/seo.php` - On-page SEO features
- `/inc/ai-features.php` - AI-friendly enhancements
- `/functions.php` - Includes both files

### Functions Reference

#### SEO Functions

- `dthree_seo_meta_tags()` - Generates all meta tags
- `dthree_get_meta_description()` - Gets optimized description
- `dthree_get_featured_image_url()` - Gets OG image
- `dthree_json_ld_schema()` - Generates JSON-LD
- `dthree_breadcrumb_schema()` - Breadcrumb schema
- `dthree_robots_meta()` - Robots meta tag
- `dthree_add_seo_meta_box()` - Custom meta box
- `dthree_save_seo_meta_box()` - Saves custom fields

#### AI Functions

- `dthree_ai_meta_tags()` - AI-specific meta tags
- `dthree_content_outline_meta()` - Content structure
- `dthree_ai_json_ld()` - Enhanced JSON-LD for AI
- `dthree_generate_toc()` - Auto table of contents
- `dthree_semantic_article_wrapper()` - Semantic HTML
- `dthree_ai_image_attributes()` - Image data attrs
- `dthree_robots_txt()` - AI crawler rules
- `dthree_ai_http_headers()` - Custom headers
- `dthree_faq_schema_detection()` - Auto FAQ schema
- `dthree_add_ai_content_summary()` - AI summary

### Customizer Settings

**Location**: Appearance → Customize → AI & Search Settings

Settings:
- Allow AI Training (checkbox)
- Enhanced Metadata (checkbox)

### Filter Hooks

```php
// Customize meta description
add_filter( 'dthree_meta_description', function( $description ) {
    // Your custom logic
    return $description;
} );

// Modify SEO title parts
add_filter( 'document_title_parts', function( $title ) {
    // Your custom logic
    return $title;
} );

// Customize robots.txt
add_filter( 'robots_txt', function( $output ) {
    // Your custom additions
    return $output;
} );
```

---

## Testing Your SEO

### Tools

1. **Google Search Console**
   - Monitor indexing
   - Check mobile usability
   - View search analytics

2. **Google Rich Results Test**
   - Test structured data
   - Verify schema markup
   - Preview search appearance

3. **Facebook Sharing Debugger**
   - Test Open Graph tags
   - Clear Facebook cache
   - Preview link sharing

4. **Twitter Card Validator**
   - Test Twitter Cards
   - Preview tweet appearance

5. **PageSpeed Insights**
   - Test performance
   - Mobile-first indexing
   - Core Web Vitals

### Validation

Visit these URLs to test your structured data:

```
https://search.google.com/test/rich-results
https://validator.schema.org/
https://developers.facebook.com/tools/debug/
https://cards-dev.twitter.com/validator
```

---

## FAQ

**Q: Will this conflict with SEO plugins?**
A: The theme's SEO features are designed to work standalone. If using Yoast SEO or Rank Math, you may want to disable the theme's SEO meta box to avoid duplication.

**Q: How do I disable AI training on my content?**
A: Go to Appearance → Customize → AI & Search Settings → Uncheck "Allow AI Training"

**Q: Can I customize the meta description length?**
A: Yes, the meta box allows up to 160 characters, which is the recommended limit.

**Q: Do I need to submit a sitemap?**
A: WordPress automatically generates a sitemap at `/wp-sitemap.xml`. Submit it to Google Search Console.

**Q: How often should I update content?**
A: Search engines favor fresh content. Update posts every 6-12 months with new information.

**Q: What's the ideal post length for SEO?**
A: Aim for 300+ words minimum, but comprehensive posts (1000-2000 words) often perform better.

---

## Additional Resources

- [Google SEO Starter Guide](https://developers.google.com/search/docs/beginner/seo-starter-guide)
- [Schema.org Documentation](https://schema.org/)
- [Open Graph Protocol](https://ogp.me/)
- [Twitter Cards Documentation](https://developer.twitter.com/en/docs/twitter-for-websites/cards)
- [Google Search Central](https://developers.google.com/search)

---

**Version:** 1.3.0  
**Last Updated:** November 9, 2025  
**License:** GPL v2 or later

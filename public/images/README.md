# Image Assets for Student Management Portal

## Required Images

### 1. hero.jpg (Hero Image)
- **Location**: `public/images/hero.jpg`
- **Purpose**: Displayed on the landing page hero section
- **Recommended Size**: 1200x600px or similar wide format
- **Format**: JPG, PNG, or WebP
- **Suggestions**:
  - Professional school/university image
  - Students in classroom setting
  - Graduation/academic themed photo
  - Custom graphic related to education

### 2. logo.png (Application Logo)
- **Location**: `public/images/logo.png`
- **Purpose**: Displayed in navbar and/or landing page
- **Recommended Size**: 48x48px to 200x200px (will be displayed at various sizes)
- **Format**: PNG (with transparency recommended)
- **Suggestions**:
  - Gordon College logo or crest
  - Simple graduation cap icon
  - "GC" initials in a circle/badge
  - Book or education-themed icon
  - Custom school branding

## How to Add Images

1. Save your hero image as `hero.jpg` in this directory
2. Save your logo as `logo.png` in this directory
3. The images will automatically be referenced via `{{ asset('images/hero.jpg') }}` and `{{ asset('images/logo.png') }}` in the Blade templates

## Quick Tips

- Keep images optimized for web (compress if needed)
- Use consistent color schemes that match your group's assigned palette
- Ensure hero image has good contrast with text overlays
- Logo should be recognizable at small sizes (favicon-size)

## Image Generation Tools (Free)

- **Canva**: https://www.canva.com (easy templates)
- **Figma**: https://www.figma.com (design tool)
- **Adobe Express**: https://www.adobe.com/express (simple graphics)
- **Pixlr**: https://pixlr.com (online editor)
- **Remove.bg**: For background removal if needed

# 🎨 Quick CSS Reference Guide

## Color System

```css
Primary Blue:     var(--color-primary)        #1e40af
Light Blue:       var(--color-primary-light) #3b82f6
White:            var(--color-white)         #ffffff
Gray:             var(--color-gray)          #e5e7eb
Text Dark:        var(--color-text-dark)    #1f2937
Text Light:       var(--color-text-light)   #4b5563
Success:          var(--color-success)       #10b981
Error:            var(--color-error)         #ef4444
Warning:          var(--color-warning)       #f59e0b
```

## Spacing Scale

```css
xs: 0.25rem (4px)
sm: 0.5rem  (8px)
1:  1rem    (16px)
2:  1.5rem  (24px)
3:  2rem    (32px)
4:  2.5rem  (40px)
5:  3rem    (48px)
6:  3.5rem  (56px)
8:  4rem    (64px)
10: 5rem    (80px)
12: 6rem    (96px)
16: 8rem    (128px)
```

## Typography

```css
Text XS:  0.75rem   (12px)
Text SM:  0.875rem  (14px)
Text Base: 1rem     (16px)
Text LG:   1.125rem (18px)
Text XL:   1.25rem  (20px)
Text 2XL:  1.5rem   (24px)
Text 3XL:  1.875rem (30px)
Text 4XL:  2.25rem  (36px)
Text 5XL:  3rem     (48px)
```

## Transitions

```css
Fast:   150ms var(--ease-out)
Normal: 300ms var(--ease-out)
Slow:   500ms var(--ease-in-out)
```

## Buttons

```html
<!-- Primary (Blue) -->
<button class="btn btn-primary">Click</button>

<!-- Secondary (White) -->
<button class="btn btn-secondary">Click</button>

<!-- Outline -->
<button class="btn btn-outline">Click</button>

<!-- Ghost -->
<button class="btn btn-ghost">Click</button>

<!-- Success -->
<button class="btn btn-success">Click</button>

<!-- Danger -->
<button class="btn btn-danger">Click</button>

<!-- Sizes -->
<button class="btn btn-sm">Small</button>
<button class="btn btn-lg">Large</button>
<button class="btn btn-block">Full Width</button>

<!-- Disabled -->
<button class="btn btn-primary" disabled>Disabled</button>
```

## Cards

```html
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Title</h3>
  </div>
  <div class="card-body">
    <!-- Content -->
  </div>
  <div class="card-footer">
    <button class="btn btn-primary">Save</button>
  </div>
</div>

<!-- Glass Effect -->
<div class="card card-glass">
  <!-- Content -->
</div>
```

## Inputs

```html
<div class="input-group">
  <label class="input-label">Email</label>
  <input type="email" class="input-field" placeholder="Enter email" />
  <span class="input-help">Helper text</span>
</div>

<!-- With Error -->
<input class="input-field input-error" value="Invalid" />

<!-- Disabled -->
<input class="input-field" disabled placeholder="Disabled" />

<!-- Textarea -->
<textarea class="input-field"></textarea>

<!-- Select -->
<select class="input-field">
  <option>Option 1</option>
  <option>Option 2</option>
</select>
```

## Badges

```html
<!-- Primary -->
<span class="badge badge-primary">New</span>

<!-- Success -->
<span class="badge badge-success">Approved</span>

<!-- Warning -->
<span class="badge badge-warning">Pending</span>

<!-- Error -->
<span class="badge badge-error">Failed</span>
```

## Alerts

```html
<!-- Success -->
<div class="alert alert-success">
  <div class="alert-icon">✓</div>
  <div class="alert-content">
    <h4>Success!</h4>
    <p>Your changes have been saved</p>
  </div>
</div>

<!-- Error -->
<div class="alert alert-error">
  <div class="alert-icon">✕</div>
  <div class="alert-content">
    <h4>Error!</h4>
    <p>Something went wrong</p>
  </div>
</div>

<!-- Warning -->
<div class="alert alert-warning">
  <div class="alert-icon">⚠</div>
  <div class="alert-content">...</div>
</div>

<!-- Info -->
<div class="alert alert-info">
  <div class="alert-icon">ℹ</div>
  <div class="alert-content">...</div>
</div>
```

## Animations

```html
<!-- Fade In -->
<div class="animate-fade-in">Fades in</div>

<!-- Fade In Up -->
<div class="animate-fade-in-up">Slides up & fades</div>

<!-- Fade In Down -->
<div class="animate-fade-in-down">Slides down & fades</div>

<!-- Slide In Left -->
<div class="animate-slide-in-left">Slides from left</div>

<!-- Slide In Right -->
<div class="animate-slide-in-right">Slides from right</div>

<!-- Scale In -->
<div class="animate-scale-in">Grows in</div>

<!-- Pulse -->
<div class="animate-pulse">Breathing effect</div>

<!-- Float -->
<div class="animate-float">Floats around</div>

<!-- Scroll Reveal -->
<div class="fade-in-view">Shows on scroll</div>
```

## Flexbox Utilities

```html
<!-- Basic Flex -->
<div class="flex">
  <div>Item 1</div>
  <div>Item 2</div>
</div>

<!-- Column -->
<div class="flex flex-col">
  <div>Item 1</div>
  <div>Item 2</div>
</div>

<!-- Alignment -->
<div class="flex items-center justify-between">...</div>

<!-- Gap -->
<div class="flex gap-3">
  <div>Item 1</div>
  <div>Item 2</div>
</div>
```

## Responsive Design

```css
/* Mobile First (Default) */
.element {
  width: 100%;
}

/* Tablet and up (768px) */
@media (min-width: 768px) {
  .element {
    width: 50%;
  }
}

/* Desktop and up (1024px) */
@media (min-width: 1024px) {
  .element {
    width: 33.333%;
  }
}

/* 4K and up (1280px) */
@media (min-width: 1280px) {
  .element {
    width: 25%;
  }
}

/* Mobile only */
@media (max-width: 767px) {
  .element {
    display: block;
  }
}
```

## Common Patterns

### Page Header

```html
<div class="page-header">
  <div class="page-header-content">
    <span class="page-kicker">Section</span>
    <h1 class="page-title">Page Title</h1>
    <p class="page-description">Description here</p>
  </div>
</div>
```

### Grid Layout

```html
<div
  class="grid"
  style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--space-4);"
>
  <div class="card">Item 1</div>
  <div class="card">Item 2</div>
  <div class="card">Item 3</div>
</div>
```

### Form Card

```html
<div class="form-card">
  <div class="form-card-header">
    <h3 class="form-card-title">Form Title</h3>
  </div>
  <div class="form-grid">
    <div class="form-group-admin">
      <label>Field</label>
      <input class="input-field" type="text" />
    </div>
  </div>
  <div class="form-actions">
    <button class="btn btn-primary">Submit</button>
  </div>
</div>
```

### Data Table

```html
<div class="table-container">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>john@example.com</td>
        <td class="table-actions">
          <a href="#" class="action-btn action-btn-edit">Edit</a>
          <button class="action-btn action-btn-delete">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
```

## CSS Files to Load

### Public Pages

```html
<link rel="stylesheet" href="/public/css/user/base.css" />
<link rel="stylesheet" href="/public/css/user/components.css" />
<link rel="stylesheet" href="/public/css/user/main.css" />
<link rel="stylesheet" href="/public/css/user/home-modern.css" />
<link rel="stylesheet" href="/public/css/user/pages-modern.css" />
```

### Admin Pages

```html
<link rel="stylesheet" href="/public/css/user/base.css" />
<link rel="stylesheet" href="/public/css/user/components.css" />
<link rel="stylesheet" href="/public/css/admin/admin-modern.css" />
```

## Responsive Text Sizes

```html
<!-- Automatically scales with viewport -->
<h1 style="font-size: clamp(1.5rem, 5vw, 3rem);">Responsive Title</h1>
<p style="font-size: clamp(1rem, 2vw, 1.25rem);">Responsive text</p>
```

Format: `clamp(minimum, preferred, maximum)`

- Minimum: Smallest allowed size
- Preferred: Scales with viewport width (vw)
- Maximum: Largest allowed size

---

**Remember**: Always use CSS variables and components for consistency! 💙

# Website Settings Management Implementation

## Overview

A complete admin panel page to manage website settings including logo, title, colors, and other details that can be edited by administrators.

## Files Created

### 1. Database Migration

- **File**: `database/migrations/002_website_settings.sql`
- **Purpose**: Creates the `website_settings` table with columns for:
  - Website title and description
  - Logo and favicon paths
  - Footer information (copyright, email, phone, address)
  - Social media links (Facebook, Twitter, Instagram, LinkedIn, YouTube)
  - Color scheme (primary, secondary, accent colors)

### 2. Model

- **File**: `app/Models/WebsiteSettingsModel.php`
- **Class**: `WebsiteSettingsModel`
- **Methods**:
  - `get()`: Retrieves all website settings
  - `update(array $data)`: Updates website settings

### 3. Controller

- **File**: `app/Controllers/AdminSettingsController.php`
- **Class**: `AdminSettingsController`
- **Methods**:
  - `index()`: Display the settings edit page
  - `update()`: Handle form submission and updates
  - `handleUpload()`: Private method to handle file uploads

### 4. View

- **File**: `views/admin/settings/show.php`
- **Sections**:
  - General Settings (Title, Description)
  - Logo & Favicon (with image preview)
  - Color Scheme (Primary, Secondary, Accent with color picker)
  - Footer Information (Copyright, Email, Phone, Address)
  - Social Media Links (Facebook, Twitter, Instagram, LinkedIn, YouTube)
- **Features**:
  - Responsive form layout
  - File upload handling
  - Color picker with text input synchronization
  - Success/error message alerts
  - CSS styling included

### 5. Routes

- **File**: `index.php`
- Added routes:
  - `GET /admin/settings` → Display settings page
  - `POST /admin/settings/update` → Handle settings update
  - New controller instantiation: `$adminSettings`
  - New controller import: `use App\Controllers\AdminSettingsController;`

### 6. Navigation

- **File**: `views/admin/layouts/admin.php`
- Added:
  - "Website Settings" menu item in the Account section
  - Settings CSS mapping (uses forms.css)
  - Gear icon for settings link

## Features

✅ **Upload Logo**: Support for JPG, PNG, GIF, SVG formats
✅ **Upload Favicon**: Dedicated favicon upload
✅ **Edit Website Title**: Main website title
✅ **Edit Description**: Website description for SEO
✅ **Color Customization**: Primary, secondary, and accent colors with color picker
✅ **Footer Management**: Copyright text, email, phone, address
✅ **Social Media Links**: Facebook, Twitter, Instagram, LinkedIn, YouTube
✅ **Form Validation**: CSRF protection
✅ **Error Handling**: Try-catch blocks and user-friendly messages
✅ **Image Preview**: Shows current uploaded images
✅ **Responsive Design**: Mobile-friendly interface

## Database Schema

```sql
CREATE TABLE website_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    website_title VARCHAR(255),
    website_description TEXT,
    logo_path VARCHAR(255),
    logo_alt_text VARCHAR(255),
    favicon_path VARCHAR(255),
    footer_copyright_text VARCHAR(255),
    footer_email VARCHAR(255),
    footer_phone VARCHAR(20),
    footer_address TEXT,
    social_facebook VARCHAR(255),
    social_twitter VARCHAR(255),
    social_instagram VARCHAR(255),
    social_linkedin VARCHAR(255),
    social_youtube VARCHAR(255),
    primary_color VARCHAR(7),
    secondary_color VARCHAR(7),
    accent_color VARCHAR(7),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Usage

1. **Access the Settings Page**:
   - Navigate to `/admin/settings`
   - Or click "Website Settings" in the admin sidebar

2. **Upload Logo/Favicon**:
   - Click on the file input
   - Select an image (JPG, PNG, GIF, SVG)
   - Current image preview will be shown

3. **Edit Colors**:
   - Click on the color picker
   - Select or enter hex color code
   - Value auto-syncs with text input

4. **Save Changes**:
   - Fill in all desired fields
   - Click "Save Settings" button
   - Success message will appear

## Installation Steps

1. **Run Migration**:

   ```bash
   php database/migrate.php
   ```

2. **Access Admin Panel**:
   - Log in to admin panel
   - Navigate to Settings from sidebar

3. **Start Managing**:
   - Update website title, logo, colors, and other details
   - All changes are saved to the database

## Security Features

- CSRF token validation on form submission
- HTML entity encoding for output
- File type validation for uploads
- Admin authentication requirement
- Proper error handling

## File Paths for Uploads

- **Logos**: `/public/images/logos/`
- **Favicons**: `/public/images/favicons/`

These directories are created automatically if they don't exist.

## Next Steps (Optional)

You can further enhance this by:

1. Using these settings in the public-facing website (header, footer, etc.)
2. Adding CSS file generation based on color settings
3. Creating a settings API for frontend access
4. Adding more branding options (fonts, spacing, etc.)
5. Creating settings export/import functionality

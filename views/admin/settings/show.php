<?php
/**
 * Admin Website Settings Page
 * Manage logo, title, colors, and other website settings
 */
?>

<div class="admin-container">
    <div class="page-header">
        <h1>Website Settings</h1>
        <p>Manage your website title, logo, colors, and footer information</p>
    </div>

    <!-- Success/Error Messages -->
    <?php if ($success): ?>
        <div class="alert alert-success">
            ✓ <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            ✗ <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="/admin/settings/update" method="POST" enctype="multipart/form-data" class="settings-form">
        <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars($csrfToken); ?>">

        <!-- General Settings -->
        <fieldset class="form-section">
            <legend>General Settings</legend>

            <div class="form-group">
                <label for="website_title">Website Title</label>
                <input 
                    type="text" 
                    id="website_title"
                    name="website_title" 
                    value="<?php echo htmlspecialchars($settings['website_title'] ?? ''); ?>"
                    required
                    placeholder="Enter website title"
                >
                <small>This appears in browser tabs and search results</small>
            </div>

            <div class="form-group">
                <label for="website_description">Website Description</label>
                <textarea 
                    id="website_description"
                    name="website_description"
                    rows="3"
                    placeholder="Enter a brief description of your website"
                ><?php echo htmlspecialchars($settings['website_description'] ?? ''); ?></textarea>
                <small>Use this for SEO meta description</small>
            </div>
        </fieldset>

        <!-- Logo & Favicon -->
        <fieldset class="form-section">
            <legend>Logo & Favicon</legend>

            <div class="form-group">
                <label for="logo">Website Logo 📷</label>
                <div class="requirement-box">
                    <strong>📋 Requirements:</strong>
                    <ul>
                        <li>Minimum size: <strong>200x50 pixels</strong></li>
                        <li>Recommended size: <strong>400x150 pixels</strong> or <strong>600x200 pixels</strong></li>
                        <li>Aspect ratio: Between 1:1 and 4:1 (width:height)</li>
                        <li>Maximum file size: <strong>2MB</strong></li>
                        <li>Format: JPG, PNG, GIF, or SVG</li>
                    </ul>
                </div>
                <?php if (!empty($settings['logo_path'])): ?>
                    <div class="image-preview">
                        <img src="<?php echo url('/public/' . htmlspecialchars($settings['logo_path'])); ?>" alt="Current Logo" class="preview-logo">
                        <small>✓ Current Logo</small>
                    </div>
                <?php endif; ?>
                <input 
                    type="file" 
                    id="logo"
                    name="logo"
                    accept="image/*"
                    class="file-input"
                >
                <small class="help-text">⚠️ If image doesn't meet requirements, it will not be uploaded. Please ensure your image meets all the requirements above.</small>
            </div>

            <div class="form-group">
                <label for="logo_alt_text">Logo Alt Text (for accessibility)</label>
                <input 
                    type="text" 
                    id="logo_alt_text"
                    name="logo_alt_text"
                    value="<?php echo htmlspecialchars($settings['logo_alt_text'] ?? ''); ?>"
                    placeholder="e.g., Kottramulla United Welfare Society Logo"
                >
            </div>

            <div class="form-group">
                <label for="favicon">Favicon 🔗</label>
                <div class="requirement-box">
                    <strong>📋 Requirements:</strong>
                    <ul>
                        <li>Size: <strong>Must be square</strong> (same width and height)</li>
                        <li>Minimum size: <strong>64x64 pixels</strong></li>
                        <li>Recommended size: <strong>256x256 pixels</strong> or <strong>512x512 pixels</strong></li>
                        <li>Maximum file size: <strong>512KB</strong></li>
                        <li>Format: PNG or ICO (SVG supported)</li>
                    </ul>
                </div>
                <?php if (!empty($settings['favicon_path'])): ?>
                    <div class="image-preview">
                        <img src="<?php echo url('/public/' . htmlspecialchars($settings['favicon_path'])); ?>" alt="Current Favicon" class="preview-favicon">
                        <small>✓ Current Favicon</small>
                    </div>
                <?php endif; ?>
                <input 
                    type="file" 
                    id="favicon"
                    name="favicon"
                    accept="image/*"
                    class="file-input"
                >
                <small class="help-text">⚠️ Favicon must be square! If image doesn't meet requirements, it will not be uploaded.</small>
            </div>
        </fieldset>

        <!-- Color Settings -->
        <fieldset class="form-section">
            <legend>Color Scheme</legend>

            <div class="form-group">
                <label for="primary_color">Primary Color</label>
                <div class="color-input-group">
                    <input 
                        type="color" 
                        id="primary_color"
                        name="primary_color"
                        value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#1e40af'); ?>"
                    >
                    <input 
                        type="text" 
                        name="primary_color_text"
                        value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#1e40af'); ?>"
                        readonly
                        class="color-text-input"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="secondary_color">Secondary Color</label>
                <div class="color-input-group">
                    <input 
                        type="color" 
                        id="secondary_color"
                        name="secondary_color"
                        value="<?php echo htmlspecialchars($settings['secondary_color'] ?? '#7c3aed'); ?>"
                    >
                    <input 
                        type="text"
                        name="secondary_color_text"
                        value="<?php echo htmlspecialchars($settings['secondary_color'] ?? '#7c3aed'); ?>"
                        readonly
                        class="color-text-input"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="accent_color">Accent Color</label>
                <div class="color-input-group">
                    <input 
                        type="color" 
                        id="accent_color"
                        name="accent_color"
                        value="<?php echo htmlspecialchars($settings['accent_color'] ?? '#f59e0b'); ?>"
                    >
                    <input 
                        type="text"
                        name="accent_color_text"
                        value="<?php echo htmlspecialchars($settings['accent_color'] ?? '#f59e0b'); ?>"
                        readonly
                        class="color-text-input"
                    >
                </div>
            </div>
        </fieldset>

        <!-- Footer Information -->
        <fieldset class="form-section">
            <legend>Footer Information</legend>

            <div class="form-group">
                <label for="footer_copyright_text">Copyright Text</label>
                <input 
                    type="text" 
                    id="footer_copyright_text"
                    name="footer_copyright_text"
                    value="<?php echo htmlspecialchars($settings['footer_copyright_text'] ?? ''); ?>"
                    placeholder="© 2024 Your Organization. All rights reserved."
                >
            </div>

            <div class="form-group">
                <label for="footer_email">Contact Email</label>
                <input 
                    type="email" 
                    id="footer_email"
                    name="footer_email"
                    value="<?php echo htmlspecialchars($settings['footer_email'] ?? ''); ?>"
                    placeholder="contact@example.com"
                >
            </div>

            <div class="form-group">
                <label for="footer_phone">Contact Phone</label>
                <input 
                    type="tel" 
                    id="footer_phone"
                    name="footer_phone"
                    value="<?php echo htmlspecialchars($settings['footer_phone'] ?? ''); ?>"
                    placeholder="+1 (555) 123-4567"
                >
            </div>

            <div class="form-group">
                <label for="footer_address">Address</label>
                <textarea 
                    id="footer_address"
                    name="footer_address"
                    rows="3"
                    placeholder="Enter your organization address"
                ><?php echo htmlspecialchars($settings['footer_address'] ?? ''); ?></textarea>
            </div>
        </fieldset>

        <!-- Social Media Links -->
        <fieldset class="form-section">
            <legend>Social Media Links</legend>

            <div class="form-group">
                <label for="social_facebook">Facebook URL</label>
                <input 
                    type="url" 
                    id="social_facebook"
                    name="social_facebook"
                    value="<?php echo htmlspecialchars($settings['social_facebook'] ?? ''); ?>"
                    placeholder="https://facebook.com/yourpage"
                >
            </div>

            <div class="form-group">
                <label for="social_twitter">Twitter/X URL</label>
                <input 
                    type="url" 
                    id="social_twitter"
                    name="social_twitter"
                    value="<?php echo htmlspecialchars($settings['social_twitter'] ?? ''); ?>"
                    placeholder="https://twitter.com/yourhandle"
                >
            </div>

            <div class="form-group">
                <label for="social_instagram">Instagram URL</label>
                <input 
                    type="url" 
                    id="social_instagram"
                    name="social_instagram"
                    value="<?php echo htmlspecialchars($settings['social_instagram'] ?? ''); ?>"
                    placeholder="https://instagram.com/yourprofile"
                >
            </div>

            <div class="form-group">
                <label for="social_linkedin">LinkedIn URL</label>
                <input 
                    type="url" 
                    id="social_linkedin"
                    name="social_linkedin"
                    value="<?php echo htmlspecialchars($settings['social_linkedin'] ?? ''); ?>"
                    placeholder="https://linkedin.com/company/yourcompany"
                >
            </div>

            <div class="form-group">
                <label for="social_youtube">YouTube URL</label>
                <input 
                    type="url" 
                    id="social_youtube"
                    name="social_youtube"
                    value="<?php echo htmlspecialchars($settings['social_youtube'] ?? ''); ?>"
                    placeholder="https://youtube.com/yourchannel"
                >
            </div>
        </fieldset>

        <fieldset class="form-section">
            <legend>Public Page Detail Content</legend>
            <div class="form-group">
                <label for="projects_insight3_title">Projects Insight Card 3 Title</label>
                <input type="text" id="projects_insight3_title" name="projects_insight3_title" value="<?php echo htmlspecialchars($settings['projects_insight3_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="projects_insight3_body">Projects Insight Card 3 Description</label>
                <textarea id="projects_insight3_body" name="projects_insight3_body" rows="2"><?php echo htmlspecialchars($settings['projects_insight3_body'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="gallery_overview1_title">Gallery Overview Card 1 Title</label>
                <input type="text" id="gallery_overview1_title" name="gallery_overview1_title" value="<?php echo htmlspecialchars($settings['gallery_overview1_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="gallery_overview1_body">Gallery Overview Card 1 Description</label>
                <textarea id="gallery_overview1_body" name="gallery_overview1_body" rows="2"><?php echo htmlspecialchars($settings['gallery_overview1_body'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="gallery_overview3_title">Gallery Overview Card 3 Title</label>
                <input type="text" id="gallery_overview3_title" name="gallery_overview3_title" value="<?php echo htmlspecialchars($settings['gallery_overview3_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="gallery_overview3_body">Gallery Overview Card 3 Description</label>
                <textarea id="gallery_overview3_body" name="gallery_overview3_body" rows="2"><?php echo htmlspecialchars($settings['gallery_overview3_body'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="members_overview2_title">Members Overview Card 2 Title</label>
                <input type="text" id="members_overview2_title" name="members_overview2_title" value="<?php echo htmlspecialchars($settings['members_overview2_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="members_overview2_body">Members Overview Card 2 Description</label>
                <textarea id="members_overview2_body" name="members_overview2_body" rows="2"><?php echo htmlspecialchars($settings['members_overview2_body'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="members_overview3_title">Members Overview Card 3 Title</label>
                <input type="text" id="members_overview3_title" name="members_overview3_title" value="<?php echo htmlspecialchars($settings['members_overview3_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="members_overview3_body">Members Overview Card 3 Description</label>
                <textarea id="members_overview3_body" name="members_overview3_body" rows="2"><?php echo htmlspecialchars($settings['members_overview3_body'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="contact_assurance1_title">Contact Assurance Card 1 Title</label>
                <input type="text" id="contact_assurance1_title" name="contact_assurance1_title" value="<?php echo htmlspecialchars($settings['contact_assurance1_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="contact_assurance1_body">Contact Assurance Card 1 Description</label>
                <textarea id="contact_assurance1_body" name="contact_assurance1_body" rows="2"><?php echo htmlspecialchars($settings['contact_assurance1_body'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="contact_assurance2_title">Contact Assurance Card 2 Title</label>
                <input type="text" id="contact_assurance2_title" name="contact_assurance2_title" value="<?php echo htmlspecialchars($settings['contact_assurance2_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="contact_assurance2_body">Contact Assurance Card 2 Description</label>
                <textarea id="contact_assurance2_body" name="contact_assurance2_body" rows="2"><?php echo htmlspecialchars($settings['contact_assurance2_body'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="contact_assurance3_title">Contact Assurance Card 3 Title</label>
                <input type="text" id="contact_assurance3_title" name="contact_assurance3_title" value="<?php echo htmlspecialchars($settings['contact_assurance3_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="contact_assurance3_body">Contact Assurance Card 3 Description</label>
                <textarea id="contact_assurance3_body" name="contact_assurance3_body" rows="2"><?php echo htmlspecialchars($settings['contact_assurance3_body'] ?? ''); ?></textarea>
            </div>
        </fieldset>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                💾 Save Settings
            </button>
            <a href="/admin" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
    .settings-form {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-section {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 24px;
        background: #f9fafb;
    }

    .form-section legend {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 16px;
        padding: 0 8px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #374151;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="url"],
    .form-group input[type="file"],
    .form-group textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
    }

    .form-group input[type="file"] {
        border: 2px dashed #d1d5db;
        padding: 12px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group small {
        display: block;
        margin-top: 4px;
        font-size: 12px;
        color: #6b7280;
    }

    .color-input-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .color-input-group input[type="color"] {
        width: 60px;
        height: 40px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
    }

    .color-input-group .color-text-input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-family: monospace;
        font-size: 13px;
    }

    .image-preview {
        margin-bottom: 12px;
        padding: 12px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 200px;
        margin-bottom: 8px;
        border-radius: 4px;
        object-fit: contain;
    }

    .image-preview img.preview-logo {
        width: min(280px, 100%);
        max-height: 72px;
        display: block;
    }

    .image-preview img.preview-favicon {
        width: 64px;
        height: 64px;
        display: block;
    }

    .image-preview small {
        display: block;
        color: #6b7280;
        font-size: 12px;
    }

    .requirement-box {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        border-radius: 6px;
        padding: 14px;
        margin-bottom: 14px;
        font-size: 13px;
        color: #92400e;
    }

    .requirement-box strong {
        display: block;
        margin-bottom: 8px;
        color: #b45309;
        font-size: 14px;
    }

    .requirement-box ul {
        list-style: disc;
        padding-left: 20px;
        margin: 0;
    }

    .requirement-box li {
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .help-text {
        display: block !important;
        background: #fee2e2;
        color: #7f1d1d;
        padding: 8px 10px;
        border-radius: 4px;
        margin-top: 8px;
        font-size: 12px;
        border-left: 3px solid #ef4444;
    }

    .file-input {
        border: 2px dashed #d1d5db !important;
        background: #f9fafb !important;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-input:hover {
        border-color: #60a5fa !important;
        background: #eff6ff !important;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 32px;
    }

    .btn {
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #1e40af;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1e3a8a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }

    .btn-secondary {
        background-color: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #7f1d1d;
        border-left: 4px solid #ef4444;
    }

    .page-header {
        margin-bottom: 32px;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #6b7280;
        font-size: 14px;
    }
</style>

<script>
    // Sync color picker with text input
    document.getElementById('primary_color')?.addEventListener('input', function() {
        document.querySelector('input[name="primary_color_text"]').value = this.value;
    });

    document.getElementById('secondary_color')?.addEventListener('input', function() {
        document.querySelector('input[name="secondary_color_text"]').value = this.value;
    });

    document.getElementById('accent_color')?.addEventListener('input', function() {
        document.querySelector('input[name="accent_color_text"]').value = this.value;
    });
</script>

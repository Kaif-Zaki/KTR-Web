<link rel="stylesheet" href="<?= url('/public/css/admin/members.css') ?>">
<link rel="stylesheet" href="<?= url('/public/css/admin/forms.css') ?>">

<div class="admin-page-header">
    <div class="admin-page-title">
        <p>Community</p>
        <h1><?= e($heading) ?></h1>
    </div>
    <a href="<?= url('/admin/members') ?>" class="btn-secondary-admin">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back to Members
    </a>
</div>

<div class="admin-card">
    <form method="post" action="<?= e($action) ?>" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <div style="display: grid; grid-template-columns: 240px 1fr; gap: 40px;">
            <!-- Left: Avatar Upload -->
            <div>
                <label class="admin-label">Profile Image</label>
                <div style="width: 200px; height: 200px; border-radius: 20px; background: #f8fafc; border: 2px dashed #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 16px;">
                    <?php if ($member && $member['image_path']): ?>
                        <img id="avatar-preview" src="<?= url('/public/images/members/' . $member['image_path']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <div id="avatar-placeholder" style="color: #94a3b8; text-align: center;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <p style="font-size: 11px; margin-top: 8px;">No Photo</p>
                        </div>
                    <?php endif; ?>
                </div>
                <input type="file" name="image" class="admin-input" accept="image/*" onchange="previewImage(this)">
            </div>

            <!-- Right: Details -->
            <div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div class="admin-form-group">
                        <label class="admin-label">Full Name</label>
                        <input type="text" name="name" class="admin-input" value="<?= e($member['name'] ?? '') ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-label">Occupation</label>
                        <input type="text" name="occupation" class="admin-input" value="<?= e($member['occupation'] ?? '') ?>" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div class="admin-form-group">
                        <label class="admin-label">Email Address</label>
                        <input type="email" name="email" class="admin-input" value="<?= e($member['email'] ?? '') ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-label">Date of Birth</label>
                        <input type="date" name="dob" class="admin-input" value="<?= e($member['dob'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">WhatsApp Number (Optional)</label>
                    <input type="text" name="whatsapp" class="admin-input" value="<?= e($member['whatsapp'] ?? '') ?>" placeholder="e.g. +94 77 123 4567">
                </div>
            </div>
        </div>

        <!-- Social Links Manager -->
        <div style="margin-top: 40px; border-top: 1px solid var(--border-color); padding-top: 32px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--navy-900);">Social Profiles</h3>
                <button type="button" class="btn-secondary-admin" onclick="addSocialLink()">+ Add Link</button>
            </div>
            
            <div id="social-links-container" style="display: flex; flex-direction: column; gap: 12px;">
                <?php 
                    $links = json_decode($member['social_links'] ?? '[]', true);
                    if (empty($links)) $links = [['platform' => 'facebook', 'url' => '']];
                    foreach ($links as $index => $link):
                ?>
                    <div class="social-link-row" style="display: grid; grid-template-columns: 160px 1fr 44px; gap: 12px;">
                        <select name="platforms[]" class="admin-select">
                            <option value="facebook" <?= $link['platform'] === 'facebook' ? 'selected' : '' ?>>Facebook</option>
                            <option value="instagram" <?= $link['platform'] === 'instagram' ? 'selected' : '' ?>>Instagram</option>
                            <option value="twitter" <?= $link['platform'] === 'twitter' ? 'selected' : '' ?>>Twitter/X</option>
                            <option value="linkedin" <?= $link['platform'] === 'linkedin' ? 'selected' : '' ?>>LinkedIn</option>
                            <option value="other" <?= $link['platform'] === 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                        <input type="url" name="urls[]" class="admin-input" value="<?= e($link['url']) ?>" placeholder="https://...">
                        <button type="button" class="btn-danger-admin" onclick="this.parentElement.remove()" style="padding: 0; width: 44px; height: 44px; justify-content: center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div style="margin-top: 40px; padding-top: 32px; border-top: 1px solid var(--border-color);">
            <button type="submit" class="btn-primary-admin" style="padding: 14px 40px; font-size: 1rem;">
                Save Member Record
            </button>
        </div>
    </form>
</div>

<template id="social-link-template">
    <div class="social-link-row" style="display: grid; grid-template-columns: 160px 1fr 44px; gap: 12px; margin-top: 12px;">
        <select name="platforms[]" class="admin-select">
            <option value="facebook">Facebook</option>
            <option value="instagram">Instagram</option>
            <option value="twitter">Twitter/X</option>
            <option value="linkedin">LinkedIn</option>
            <option value="other">Other</option>
        </select>
        <input type="url" name="urls[]" class="admin-input" placeholder="https://...">
        <button type="button" class="btn-danger-admin" onclick="this.parentElement.remove()" style="padding: 0; width: 44px; height: 44px; justify-content: center;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>
</template>

<script>
    function addSocialLink() {
        const container = document.getElementById('social-links-container');
        const template = document.getElementById('social-link-template');
        container.appendChild(template.content.cloneNode(true));
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('avatar-preview');
                if (!preview) {
                    const placeholder = document.getElementById('avatar-placeholder');
                    const parent = placeholder.parentElement;
                    placeholder.remove();
                    preview = document.createElement('img');
                    preview.id = 'avatar-preview';
                    preview.style.width = '100%';
                    preview.style.height = '100%';
                    preview.style.objectFit = 'cover';
                    parent.appendChild(preview);
                }
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

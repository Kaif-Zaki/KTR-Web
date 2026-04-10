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
            <div style="display: flex; flex-direction: column; gap: 24px;">
                <div class="admin-form-group">
                    <label class="admin-label">Full Name</label>
                    <input type="text" name="name" class="admin-input" value="<?= e($member['name'] ?? '') ?>" required placeholder="e.g. John Doe">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Position</label>
                    <input type="text" name="occupation" class="admin-input" value="<?= e($member['occupation'] ?? '') ?>" required placeholder="e.g. Board Member, Volunteer">
                </div>
            </div>
        </div>

        <div style="margin-top: 40px; padding-top: 32px; border-top: 1px solid var(--border-color);">
            <button type="submit" class="btn-primary-admin" style="padding: 14px 40px; font-size: 1rem;">
                Save Member Record
            </button>
        </div>
    </form>
</div>

<script>
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

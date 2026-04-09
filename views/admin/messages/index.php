<!-- styles moved to public/css/app.css -->

<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Communications</p>
        <h1 class="proj-title">Contact Messages</h1>
    </div>
</div>

<div class="msg-layout">
    <div class="msg-inbox-panel">
        <div class="msg-panel-head">
            <span class="msg-panel-title">Inbox</span>
            <?php 
                $unread = array_filter($rows, fn($r) => (int)$r['is_read'] === 0);
                if (count($unread) > 0): 
            ?>
                <span class="msg-unread-badge"><?= count($unread) ?> New</span>
            <?php endif; ?>
        </div>

        <div class="msg-list">
            <?php if (empty($rows)): ?>
                <div class="msg-no-selection" style="padding: 2rem;">
                    <p>No messages found.</p>
                </div>
            <?php endif; ?>
            <?php foreach ($rows as $row): ?>
                <?php $isUnread = (int) $row['is_read'] === 0; ?>
                <a href="<?= url('/admin/messages?id=' . (int) $row['id']) ?>"
                   class="msg-item <?= ($selected && (int)$selected['id'] === (int)$row['id']) ? 'msg-item--active' : '' ?>">
                    <div class="msg-item-avatar">
                        <?= mb_strtoupper(mb_substr(e($row['name']), 0, 1)) ?>
                    </div>
                    <div class="msg-item-body">
                        <div class="msg-item-row">
                            <span class="msg-item-name"><?= e($row['name']) ?></span>
                            <span class="msg-item-date"><?= e(date('M j', strtotime($row['created_at']))) ?></span>
                        </div>
                        <div class="msg-item-subject"><?= e((string) ($row['subject'] ?: 'No subject')) ?></div>
                    </div>
                    <?php if ($isUnread): ?>
                        <span class="msg-dot"></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="msg-detail-panel">
        <?php if ($selected === null): ?>
            <div class="msg-no-selection">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.3;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <p>Select a message to read the conversation</p>
            </div>
        <?php else: ?>
            <div class="msg-detail-head">
                <div class="msg-detail-avatar">
                    <?= mb_strtoupper(mb_substr(e($selected['name']), 0, 1)) ?>
                </div>
                <div>
                    <div class="msg-detail-name"><?= e($selected['name']) ?></div>
                    <div class="msg-detail-email"><?= e($selected['email']) ?></div>
                </div>
                <div class="msg-detail-meta-right">
                    <span class="msg-subject-chip"><?= e($selected['subject'] ?: 'General Inquiry') ?></span>
                    <div class="msg-item-date"><?= e(date('F j, Y, g:i a', strtotime($selected['created_at']))) ?></div>
                </div>
            </div>

            <p class="msg-section-label">Original Message</p>
            <div class="msg-body-card">
                <?= nl2br(e($selected['message'])) ?>
            </div>

            <div class="msg-reply-form-wrap">
                <p class="msg-section-label">Quick Response</p>
                <textarea id="external_reply_message" class="msg-reply-ta" rows="6" placeholder="Type your reply here..."></textarea>
                
                <div style="text-align: right;">
                    <button type="button" class="btn-send-reply" onclick="handleMailtoReply()">
                        Send
                    </button>
                </div>
            </div>

            <script>
            function handleMailtoReply() {
                const recipient = "<?= e($selected['email']) ?>";
                const subject = "Re: <?= e($selected['subject'] ?: 'Your Inquiry') ?>";
                const bodyText = document.getElementById('external_reply_message').value;

                if (!bodyText.trim()) {
                    alert("Please write a message before sending.");
                    return;
                }
                
                const mailtoUrl = `mailto:${recipient}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(bodyText)}`;
                window.location.href = mailtoUrl;
            }
            </script>
        <?php endif; ?>
    </div>
</div>
<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Messages</p>
        <h1 class="proj-title">Contact Messages</h1>
    </div>
</div>

<?php if (!empty($success)): ?>
    <div class="alert success"><?= e($success) ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="msg-layout">

    <div class="msg-inbox-panel">
        <div class="msg-panel-head">
            <span class="msg-panel-title">Inbox</span>
            <?php $unread = array_filter($rows, fn($r) => (int)$r['is_read'] === 0); ?>
            <?php if (count($unread) > 0): ?>
                <span class="msg-unread-badge"><?= count($unread) ?> new</span>
            <?php endif; ?>
        </div>

        <div class="msg-list">
            <?php if (empty($rows)): ?>
                <div class="msg-empty">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <p>No messages yet.</p>
                </div>
            <?php endif; ?>
            <?php foreach ($rows as $row): ?>
                <?php $isUnread = (int) $row['is_read'] === 0; ?>
                <a href="<?= url('/admin/messages?id=' . (int) $row['id']) ?>"
                   class="msg-item <?= $isUnread ? 'msg-item--unread' : '' ?> <?= ($selected && (int)$selected['id'] === (int)$row['id']) ? 'msg-item--active' : '' ?>">
                    <div class="msg-item-avatar">
                        <?= mb_strtoupper(mb_substr(e($row['name']), 0, 1)) ?>
                    </div>
                    <div class="msg-item-body">
                        <div class="msg-item-row">
                            <span class="msg-item-name"><?= e($row['name']) ?></span>
                            <span class="msg-item-date"><?= e(date('M j', strtotime($row['created_at']))) ?></span>
                        </div>
                        <div class="msg-item-subject"><?= e((string) ($row['subject'] ?: 'No subject')) ?></div>
                        <div class="msg-item-email"><?= e($row['email']) ?></div>
                    </div>
                    <?php if ($isUnread): ?>
                        <span class="msg-dot" aria-label="Unread"></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="msg-detail-panel">
        <?php if ($selected === null): ?>
            <div class="msg-no-selection">
                <div class="msg-no-sel-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <p>Select a message from the inbox to read and reply.</p>
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
                    <?php if (!empty($selected['subject'])): ?>
                        <span class="msg-subject-chip"><?= e($selected['subject']) ?></span>
                    <?php endif; ?>
                    <span class="msg-detail-date"><?= e($selected['created_at']) ?></span>
                </div>
            </div>

            <div class="msg-body-card">
                <p><?= nl2br(e($selected['message'])) ?></p>
            </div>

            <?php if (!empty($replies)): ?>
                <div class="msg-replies">
                    <p class="msg-section-label">Reply History</p>
                    <?php foreach ($replies as $reply): ?>
                        <div class="msg-reply-item">
                            <div class="msg-reply-head">
                                <span class="msg-reply-who"><?= e($reply['admin_name']) ?></span>
                                <span class="msg-reply-status <?= $reply['sent_at'] ? 'msg-reply-status--sent' : 'msg-reply-status--fail' ?>">
                                    <?= $reply['sent_at'] ? 'Email sent' : 'Send failed' ?>
                                </span>
                                <span class="msg-reply-ts"><?= e((string) ($reply['sent_at'] ?: $reply['created_at'])) ?></span>
                            </div>
                            <p class="msg-reply-body"><?= nl2br(e($reply['reply_message'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="msg-reply-form-wrap">
                <p class="msg-section-label">Quick Reply via Email</p>
                <div class="msg-reply-form">
                    <textarea 
                        id="external_reply_message" 
                        class="pf-input pf-textarea msg-reply-ta" 
                        rows="5" 
                        required 
                        placeholder="Type your message here, then click the button to open your email app..."
                    ></textarea>
                    
                    <button type="button" class="pf-btn-save" onclick="handleMailtoReply()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Send Reply
                    </button>
                </div>
            </div>

            <script>
            function handleMailtoReply() {
                const recipient = "<?= e($selected['email']) ?>";
                const subject = "Re: <?= e($selected['subject'] ?: 'Your Message') ?>";
                const bodyText = document.getElementById('external_reply_message').value;

                if (!bodyText.trim()) {
                    alert("Please enter a message before sending.");
                    return;
                }

                // Construct the mailto URI
                // encodeURIComponent is essential to handle spaces, line breaks, and special chars
                const mailtoUrl = `mailto:${recipient}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(bodyText)}`;

                // Trigger the email client
                window.location.href = mailtoUrl;
            }
            </script>

        <?php endif; ?>
    </div>
</div>
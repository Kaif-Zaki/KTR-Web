<section class="card">
    <h2>Contact Messages</h2>
    <p class="subtle">Review incoming messages and reply to users by email.</p>

    <?php if (!empty($success)): ?>
        <div class="alert success"><?= e($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>
</section>

<section class="message-layout">
    <article class="card">
        <h3>Inbox</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr class="<?= (int) $row['is_read'] === 0 ? 'unread-row' : '' ?>">
                        <td><a href="/admin/messages?id=<?= (int) $row['id'] ?>"><?= e($row['name']) ?></a></td>
                        <td><?= e($row['email']) ?></td>
                        <td><?= e((string) ($row['subject'] ?: '-')) ?></td>
                        <td><?= (int) $row['is_read'] === 0 ? 'New' : 'Read' ?></td>
                        <td><?= e($row['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </article>

    <article class="card">
        <h3>Message Details</h3>

        <?php if ($selected === null): ?>
            <p>Select a message from inbox to view and reply.</p>
        <?php else: ?>
            <div class="message-meta">
                <p><strong>From:</strong> <?= e($selected['name']) ?> (<?= e($selected['email']) ?>)</p>
                <p><strong>Subject:</strong> <?= e((string) ($selected['subject'] ?: '-')) ?></p>
                <p><strong>Received:</strong> <?= e($selected['created_at']) ?></p>
            </div>
            <div class="card message-body">
                <p><?= nl2br(e($selected['message'])) ?></p>
            </div>

            <h4>Send Reply</h4>
            <form method="post" action="/admin/messages/reply" class="stack-form">
                <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
                <input type="hidden" name="message_id" value="<?= (int) $selected['id'] ?>">

                <label>Reply Message</label>
                <textarea name="reply_message" rows="6" required></textarea>

                <button type="submit" class="btn-primary">Send Reply</button>
            </form>

            <h4>Reply History</h4>
            <?php if (empty($replies)): ?>
                <p>No replies yet.</p>
            <?php else: ?>
                <?php foreach ($replies as $reply): ?>
                    <div class="card reply-item">
                        <p><strong>Admin:</strong> <?= e($reply['admin_name']) ?></p>
                        <p><strong>Status:</strong> <?= $reply['sent_at'] ? 'Email sent' : 'Send failed' ?></p>
                        <p><strong>At:</strong> <?= e((string) ($reply['sent_at'] ?: $reply['created_at'])) ?></p>
                        <p><?= nl2br(e($reply['reply_message'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </article>
</section>

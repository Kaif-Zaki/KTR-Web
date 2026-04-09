<section class="card">
    <h2>Subscriptions</h2>
    <p class="subtle">Review incoming subscription requests and manage status changes.</p>

    <?php if (!empty($success)): ?>
        <div class="alert success"><?= e($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="get" action="/admin/subscriptions" class="filters">
        <input type="hidden" name="id" value="<?= (int) ($selected['id'] ?? 0) ?>">
        <select name="status">
            <option value="">All statuses</option>
            <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="active" <?= $statusFilter === 'active' ? 'selected' : '' ?>>Active</option>
            <option value="paused" <?= $statusFilter === 'paused' ? 'selected' : '' ?>>Paused</option>
            <option value="cancelled" <?= $statusFilter === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        <button type="submit" class="btn-primary">Filter</button>
    </form>
</section>

<section class="message-layout">
    <article class="card">
        <h3>Requests</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Plan</th>
                        <th>Cycle</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr class="<?= $row['status'] === 'pending' ? 'unread-row' : '' ?>">
                        <td><a href="/admin/subscriptions?id=<?= (int) $row['id'] ?>&status=<?= e((string) ($statusFilter ?? '')) ?>"><?= e($row['full_name']) ?></a></td>
                        <td><?= e($row['email']) ?></td>
                        <td><?= e($row['plan_name']) ?></td>
                        <td><?= e(ucfirst((string) $row['billing_cycle'])) ?></td>
                        <td><span class="status-pill status-<?= e((string) $row['status']) ?>"><?= e(ucfirst((string) $row['status'])) ?></span></td>
                        <td><?= e($row['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </article>

    <article class="card">
        <h3>Details</h3>

        <?php if ($selected === null): ?>
            <p>Select a subscription to review and update.</p>
        <?php else: ?>
            <div class="message-meta">
                <p><strong>Name:</strong> <?= e($selected['full_name']) ?></p>
                <p><strong>Email:</strong> <?= e($selected['email']) ?></p>
                <p><strong>Phone:</strong> <?= e((string) ($selected['phone'] ?: '-')) ?></p>
                <p><strong>Plan:</strong> <?= e($selected['plan_name']) ?> (<?= e($selected['plan_code']) ?>)</p>
                <p><strong>Cycle:</strong> <?= e(ucfirst((string) $selected['billing_cycle'])) ?></p>
                <p><strong>Amount:</strong> LKR <?= number_format((float) $selected['amount_lkr'], 2) ?></p>
                <p><strong>Start Date:</strong> <?= e((string) $selected['start_date']) ?></p>
                <p><strong>Next Billing:</strong> <?= e((string) ($selected['next_billing_date'] ?: '-')) ?></p>
                <p><strong>Status:</strong> <span class="status-pill status-<?= e((string) $selected['status']) ?>"><?= e(ucfirst((string) $selected['status'])) ?></span></p>
                <p><strong>Note:</strong> <?= nl2br(e((string) ($selected['notes'] ?: '-'))) ?></p>
            </div>

            <h4>Update Status</h4>
            <form method="post" action="/admin/subscriptions/status" class="stack-form">
                <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
                <input type="hidden" name="id" value="<?= (int) $selected['id'] ?>">

                <label>Status</label>
                <select name="status" required>
                    <option value="pending" <?= $selected['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="active" <?= $selected['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="paused" <?= $selected['status'] === 'paused' ? 'selected' : '' ?>>Paused</option>
                    <option value="cancelled" <?= $selected['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>

                <label>Admin Note (optional)</label>
                <textarea name="admin_note" rows="4"><?= e((string) ($selected['admin_note'] ?? '')) ?></textarea>

                <button type="submit" class="btn-primary">Save</button>
            </form>
        <?php endif; ?>
    </article>
</section>

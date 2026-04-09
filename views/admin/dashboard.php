<div class="dash-welcome-banner">
    <div class="dash-welcome-content">
        <p class="dash-eyebrow">Dashboard Overview</p>
        <h1 class="dash-heading">Welcome back, <?= e((string) $admin['name']) ?>!</h1>
        <p class="dash-sub">Here is what's happening with the Kottramulla United Welfare Society today.</p>
        
        <div class="dash-quick-actions">
            <a href="<?= url('/admin/projects') ?>" class="btn-primary-admin">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                New Project
            </a>
            <?php if ((int) $unreadMessages > 0): ?>
                <a href="<?= url('/admin/messages') ?>" class="btn-secondary-admin highlight-action">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    Review Messages (<?= (int)$unreadMessages ?>)
                </a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="dash-welcome-gfx">
        <div class="gfx-circle gfx-circle-1"></div>
        <div class="gfx-circle gfx-circle-2"></div>
        <svg class="gfx-icon" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
            <path d="M2 17l10 5 10-5"></path>
            <path d="M2 12l10 5 10-5"></path>
        </svg>
    </div>
</div>

<div class="dash-grid-layout">
    
    <!-- LEFT COLUMN: Metrics -->
    <div class="dash-metrics-area">
        <h2 class="dash-section-title">Key Metrics</h2>
        
        <div class="dash-stats">
            <!-- Projects Stat -->
            <a href="<?= url('/admin/projects') ?>" class="dash-stat-card interactive-card">
                <div class="dash-stat-header">
                    <div class="dash-stat-icon dash-stat-icon--teal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <div class="dash-stat-trend positive">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
                        <span>Active</span>
                    </div>
                </div>
                <div class="dash-stat-body">
                    <div class="dash-stat-value"><?= (int) $projectCount ?></div>
                    <div class="dash-stat-label">Total Projects</div>
                </div>
                <div class="dash-stat-footer">Manage projects and categories →</div>
            </a>

            <!-- Members Stat -->
            <a href="<?= url('/admin/members') ?>" class="dash-stat-card interactive-card">
                <div class="dash-stat-header">
                    <div class="dash-stat-icon dash-stat-icon--blue">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                     <span class="dash-stat-trend neutral">Community</span>
                </div>
                <div class="dash-stat-body">
                    <div class="dash-stat-value"><?= (int) $memberCount ?></div>
                    <div class="dash-stat-label">Registered Members</div>
                </div>
                <div class="dash-stat-footer">View member directory →</div>
            </a>

            <!-- Gallery Stat -->
            <a href="<?= url('/admin/gallery') ?>" class="dash-stat-card interactive-card">
                <div class="dash-stat-header">
                    <div class="dash-stat-icon dash-stat-icon--purple">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                </div>
                <div class="dash-stat-body">
                    <div class="dash-stat-value"><?= (int) $galleryCount ?></div>
                    <div class="dash-stat-label">Gallery Images</div>
                </div>
                <div class="dash-stat-footer">Organize photo albums →</div>
            </a>

            <!-- Messages Stat -->
            <a href="<?= url('/admin/messages') ?>" class="dash-stat-card interactive-card <?= ((int)$unreadMessages > 0) ? 'attention-card' : '' ?>">
                <div class="dash-stat-header">
                    <div class="dash-stat-icon dash-stat-icon--indigo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                     <?php if ((int) $unreadMessages > 0): ?>
                        <div class="dash-stat-trend warning">Action required</div>
                    <?php else: ?>
                        <div class="dash-stat-trend positive">All caught up</div>
                    <?php endif; ?>
                </div>
                <div class="dash-stat-body">
                    <div class="dash-stat-value"><?= (int) $unreadMessages ?></div>
                    <div class="dash-stat-label">Unread Messages</div>
                </div>
                <div class="dash-stat-footer">Open Inbox →</div>
            </a>
        </div>
    </div>

    <!-- RIGHT COLUMN: Recent Activity -->
    <div class="dash-activity-area">
        <div class="dash-card recent-messages-card">
            <div class="dash-card-header">
                <h3 class="dash-card-title">Recent Inquiries</h3>
                <a href="<?= url('/admin/messages') ?>" class="dash-card-action">View All</a>
            </div>
            
            <div class="dash-card-body">
                <?php if (empty($recentMessages)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">Inbox</div>
                        <p>No recent messages to display.</p>
                    </div>
                <?php else: ?>
                    <div class="recent-list">
                        <?php foreach ($recentMessages as $msg): ?>
                            <?php $isUnread = (int)$msg['is_read'] === 0; ?>
                            <a href="<?= url('/admin/messages?id=' . $msg['id']) ?>" class="recent-item <?= $isUnread ? 'unread' : '' ?>">
                                <div class="recent-avatar">
                                    <?= mb_strtoupper(mb_substr(e($msg['name']), 0, 1)) ?>
                                </div>
                                <div class="recent-details">
                                    <div class="recent-top-row">
                                        <span class="recent-name"><?= e($msg['name']) ?></span>
                                        <span class="recent-time"><?= e(date('M j, Y', strtotime($msg['created_at']))) ?></span>
                                    </div>
                                    <div class="recent-subject">
                                        <?= $isUnread ? '<span class="status-dot"></span>' : '' ?>
                                        <?= e($msg['subject'] ?: 'No Subject') ?>
                                    </div>
                                </div>
                                <div class="recent-chevron">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="dash-card system-status-card">
            <div class="dash-card-header">
                <h3 class="dash-card-title">System Overview</h3>
            </div>
            <div class="dash-card-body p-0">
                <div class="status-list">
                    <div class="status-item">
                        <div class="status-info">
                            <span class="status-label">Categories Directory</span>
                            <span class="status-value"><?= count($categories) ?> Configured</span>
                        </div>
                        <div class="status-indicator good"></div>
                    </div>
                    <div class="status-item">
                        <div class="status-info">
                            <span class="status-label">Server Status</span>
                            <span class="status-value">Online & Healthy</span>
                        </div>
                        <div class="status-indicator good"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

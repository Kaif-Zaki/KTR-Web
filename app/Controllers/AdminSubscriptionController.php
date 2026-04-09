<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\SubscriptionModel;
use DateInterval;
use DateTimeImmutable;
use Throwable;

class AdminSubscriptionController
{
    private SubscriptionModel $subscriptions;

    public function __construct()
    {
        $this->subscriptions = new SubscriptionModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();

        $allowedStatuses = ['pending', 'active', 'paused', 'cancelled'];
        $status = trim((string) ($_GET['status'] ?? ''));
        $statusFilter = in_array($status, $allowedStatuses, true) ? $status : null;
        $selectedId = (int) ($_GET['id'] ?? 0);
        $selected = $selectedId > 0 ? $this->subscriptions->find($selectedId) : null;

        View::render('admin/subscriptions/index', [
            'rows' => $this->subscriptions->all($statusFilter),
            'selected' => $selected,
            'statusFilter' => $statusFilter,
            'csrfToken' => Csrf::token(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function updateStatus(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/subscriptions');
        }

        $id = (int) ($_POST['id'] ?? 0);
        $status = trim((string) ($_POST['status'] ?? ''));
        $adminNote = trim((string) ($_POST['admin_note'] ?? ''));

        if ($id <= 0) {
            Session::flash('error', 'Invalid subscription selected.');
            redirect('/admin/subscriptions');
        }

        if (!in_array($status, ['pending', 'active', 'paused', 'cancelled'], true)) {
            Session::flash('error', 'Invalid status selected.');
            redirect('/admin/subscriptions?id=' . $id);
        }

        $existing = $this->subscriptions->find($id);
        if ($existing === null) {
            Session::flash('error', 'Subscription not found.');
            redirect('/admin/subscriptions');
        }

        $nextBillingDate = $existing['next_billing_date'];
        if ($status === 'active' && empty($nextBillingDate)) {
            $nextBillingDate = $this->calculateNextBillingDate(
                (string) $existing['start_date'],
                (string) $existing['billing_cycle']
            );
        }

        if ($status === 'cancelled') {
            $nextBillingDate = null;
        }

        $this->subscriptions->updateStatus(
            $id,
            $status,
            $adminNote === '' ? null : $adminNote,
            $nextBillingDate
        );

        Session::flash('success', 'Subscription status updated.');
        redirect('/admin/subscriptions?id=' . $id);
    }

    private function calculateNextBillingDate(string $startDate, string $billingCycle): ?string
    {
        try {
            $start = new DateTimeImmutable($startDate);
            $interval = $billingCycle === 'yearly'
                ? new DateInterval('P1Y')
                : new DateInterval('P1M');

            return $start->add($interval)->format('Y-m-d');
        } catch (Throwable) {
            return null;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\EmailJsMailer;
use App\Core\Session;
use App\Core\View;
use App\Models\SubscriptionModel;
use DateInterval;
use DateTimeImmutable;
use Throwable;

class SubscriptionController
{
    private const PLAN_DEFINITIONS = [
        'community' => [
            'name' => 'Community Support',
            'monthly' => 1000.00,
            'yearly' => 11000.00,
        ],
        'family' => [
            'name' => 'Family Circle',
            'monthly' => 2500.00,
            'yearly' => 27000.00,
        ],
        'patron' => [
            'name' => 'Patron Plus',
            'monthly' => 5000.00,
            'yearly' => 54000.00,
        ],
    ];

    public function showForm(): void
    {
        View::render('user/subscription/index', [
            'plans' => self::PLAN_DEFINITIONS,
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
            'csrfToken' => Csrf::token(),
            'activePage' => 'subscription',
        ]);
    }

    public function submit(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token. Please try again.');
            redirect('/subscription');
        }

        $name = trim((string) ($_POST['full_name'] ?? ''));
        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        $planCode = trim((string) ($_POST['plan_code'] ?? ''));
        $billingCycle = trim((string) ($_POST['billing_cycle'] ?? ''));
        $notes = trim((string) ($_POST['notes'] ?? ''));

        if ($name === '' || $email === '' || $planCode === '' || $billingCycle === '') {
            Session::flash('error', 'Name, email, subscription plan, and billing cycle are required.');
            redirect('/subscription');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            redirect('/subscription');
        }

        if (!isset(self::PLAN_DEFINITIONS[$planCode])) {
            Session::flash('error', 'Invalid subscription plan selected.');
            redirect('/subscription');
        }

        if (!in_array($billingCycle, ['monthly', 'yearly'], true)) {
            Session::flash('error', 'Invalid billing cycle selected.');
            redirect('/subscription');
        }

        $model = new SubscriptionModel();

        if ($model->hasPendingOrActiveByEmail($email)) {
            Session::flash('error', 'A pending or active subscription already exists for this email.');
            redirect('/subscription');
        }

        $plan = self::PLAN_DEFINITIONS[$planCode];
        $amount = (float) $plan[$billingCycle];
        $startDate = new DateTimeImmutable('today');
        $nextBillingDate = $this->calculateNextBillingDate($startDate, $billingCycle);

        $model->create([
            'full_name' => $name,
            'email' => $email,
            'phone' => $phone === '' ? null : $phone,
            'plan_code' => $planCode,
            'plan_name' => $plan['name'],
            'billing_cycle' => $billingCycle,
            'amount_lkr' => $amount,
            'start_date' => $startDate->format('Y-m-d'),
            'next_billing_date' => $nextBillingDate,
            'notes' => $notes === '' ? null : $notes,
        ]);

        $adminEmail = (string) config('mail.contact_admin_email');
        if ($adminEmail !== '') {
            $message = "New subscription request\n"
                . "Name: {$name}\n"
                . "Email: {$email}\n"
                . "Phone: " . ($phone === '' ? '-' : $phone) . "\n"
                . "Plan: {$plan['name']}\n"
                . "Cycle: {$billingCycle}\n"
                . "Amount: LKR {$amount}\n"
                . "Notes: " . ($notes === '' ? '-' : $notes);

            (new EmailJsMailer())->sendContactEmail(
                $adminEmail,
                'New Subscription Request',
                $message,
                $name,
                $email
            );
        }

        Session::flash('success', 'Your subscription request has been received. We will contact you shortly.');
        redirect('/subscription');
    }

    private function calculateNextBillingDate(DateTimeImmutable $startDate, string $billingCycle): ?string
    {
        try {
            $interval = $billingCycle === 'yearly'
                ? new DateInterval('P1Y')
                : new DateInterval('P1M');

            return $startDate->add($interval)->format('Y-m-d');
        } catch (Throwable) {
            return null;
        }
    }
}

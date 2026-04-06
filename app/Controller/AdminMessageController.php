<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\EmailJsMailer;
use App\Core\Session;
use App\Core\View;
use App\Model\ContactMessageModel;

class AdminMessageController
{
    private ContactMessageModel $messages;

    public function __construct()
    {
        $this->messages = new ContactMessageModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();

        $selectedId = (int) ($_GET['id'] ?? 0);
        $selected = null;
        $replies = [];

        if ($selectedId > 0) {
            $selected = $this->messages->find($selectedId);

            if ($selected !== null) {
                $this->messages->markRead($selectedId);
                $selected = $this->messages->find($selectedId);
                $replies = $this->messages->repliesForMessage($selectedId);
            }
        }

        View::render('admin/messages/index', [
            'rows' => $this->messages->all(),
            'selected' => $selected,
            'replies' => $replies,
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
            'csrfToken' => Csrf::token(),
        ], 'layouts/admin');
    }

    public function reply(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/messages');
        }

        $messageId = (int) ($_POST['message_id'] ?? 0);
        $replyMessage = trim((string) ($_POST['reply_message'] ?? ''));

        if ($messageId <= 0 || $replyMessage === '') {
            Session::flash('error', 'Message and reply are required.');
            redirect('/admin/messages');
        }

        $contact = $this->messages->find($messageId);

        if ($contact === null) {
            Session::flash('error', 'Contact message not found.');
            redirect('/admin/messages');
        }

        $admin = Auth::admin();
        $mailer = new EmailJsMailer();
        $sent = $mailer->sendContactEmail(
            (string) $contact['email'],
            'Reply: ' . (string) ($contact['subject'] ?: 'Your contact message'),
            $replyMessage,
            (string) ($admin['name'] ?? 'Admin'),
            (string) config('mail.from_email')
        );

        $this->messages->addReply(
            $messageId,
            (int) $admin['id'],
            $replyMessage,
            $sent
        );

        if ($sent) {
            Session::flash('success', 'Reply sent to user email and saved.');
        } else {
            Session::flash('error', 'Reply saved, but email could not be sent. Check EmailJS settings.');
        }

        redirect('/admin/messages?id=' . $messageId);
    }
}

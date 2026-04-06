<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\EmailJsMailer;
use App\Core\Session;
use App\Models\ContactMessageModel;

class PublicContactController
{
    public function submit(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token. Please try again.');
            redirect('/contact');
        }

        $name = trim((string) ($_POST['name'] ?? ''));
        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        $subject = trim((string) ($_POST['subject'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));

        if ($name === '' || $email === '' || $message === '') {
            Session::flash('error', 'Name, email, and message are required.');
            redirect('/contact');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            redirect('/contact');
        }

        $messageModel = new ContactMessageModel();
        $messageModel->create($name, $email, $subject === '' ? null : $subject, $message);

        $adminEmail = (string) config('mail.contact_admin_email');

        if ($adminEmail !== '') {
            $mailer = new EmailJsMailer();
            $mailer->sendContactEmail(
                $adminEmail,
                $subject === '' ? 'New Contact Message' : $subject,
                $message,
                $name,
                $email
            );
        }

        Session::flash('success', 'Your message has been sent. We will contact you soon.');
        redirect('/contact');
    }
}

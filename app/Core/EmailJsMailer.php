<?php

declare(strict_types=1);

namespace App\Core;

class EmailJsMailer
{
    private string $lastError = '';

    public function getLastError(): string
    {
        return $this->lastError;
    }

    public function sendPasswordResetCode(string $toEmail, string $code, int $expiresMinutes = 15): bool
    {
        $this->lastError = '';
        return $this->sendUsingTemplate((string) config('mail.emailjs.template_id'), [
            'to_email' => $toEmail,
            'email' => $toEmail,
            'reset_code' => $code,
            'reset_token' => $code,
            'expires_in_minutes' => $expiresMinutes,
            'app_name' => (string) config('app.name'),
            'from_email' => (string) config('mail.from_email'),
            'from_name' => (string) config('mail.from_name'),
            'title' => 'Admin Password Reset',
            'name' => 'Admin',
            'message' => 'Your password reset code is: ' . $code . '. It expires in ' . $expiresMinutes . ' minutes.',
            'time' => date('Y-m-d H:i:s'),
        ]);
    }

    public function sendContactEmail(string $toEmail, string $subject, string $message, string $fromName, string $fromEmail): bool
    {
        $templateId = (string) config('mail.emailjs.contact_template_id');

        if ($templateId === '') {
            $templateId = (string) config('mail.emailjs.template_id');
        }

        return $this->sendUsingTemplate($templateId, [
            'to_email' => $toEmail,
            'email' => $fromEmail,
            'reply_to' => $fromEmail,
            'title' => $subject,
            'subject' => $subject,
            'name' => $fromName,
            'from_name' => $fromName,
            'from_email' => $fromEmail,
            'message' => $message,
            'app_name' => (string) config('app.name'),
            'time' => date('Y-m-d H:i:s'),
        ]);
    }

    private function sendUsingTemplate(string $templateId, array $templateParams): bool
    {
        $config = config('mail');

        if (!(bool) ($config['enabled'] ?? false)) {
            $this->lastError = 'Mail is disabled. Set MAIL_ENABLED=true in .env.';
            error_log($this->lastError);
            return false;
        }

        if (($config['driver'] ?? '') !== 'emailjs') {
            $this->lastError = 'Unsupported mail driver. Expected: emailjs.';
            error_log($this->lastError);
            return false;
        }

        $emailJs = $config['emailjs'] ?? [];
        $endpoint = (string) ($emailJs['endpoint'] ?? '');
        $serviceId = (string) ($emailJs['service_id'] ?? '');
        $publicKey = (string) ($emailJs['public_key'] ?? '');
        $privateKey = (string) ($emailJs['private_key'] ?? '');
        $timeout = (int) ($emailJs['timeout'] ?? 12);

        if ($endpoint === '' || $serviceId === '' || $templateId === '' || $publicKey === '') {
            $this->lastError = 'EmailJS config missing required values.';
            error_log($this->lastError);
            return false;
        }

        if (!function_exists('curl_init')) {
            $this->lastError = 'cURL extension is required to send EmailJS requests.';
            error_log($this->lastError);
            return false;
        }

        $payload = [
            'service_id' => $serviceId,
            'template_id' => $templateId,
            'user_id' => $publicKey,
            'template_params' => $templateParams,
        ];

        $payloadWithAccess = $payload;
        if ($privateKey !== '') {
            $payloadWithAccess['accessToken'] = $privateKey;
        }

        [$ok, $status, $error, $result] = $this->dispatchRequest($endpoint, $payloadWithAccess, $timeout);

        if (!$ok && $privateKey !== '' && $status === 400) {
            [$ok, $status, $error, $result] = $this->dispatchRequest($endpoint, $payload, $timeout);
        }

        if (!$ok) {
            $this->lastError = 'EmailJS send failed. HTTP: ' . $status . ' Error: ' . $error . ' Response: ' . (string) $result;
            error_log($this->lastError);
            return false;
        }

        return true;
    }

    private function dispatchRequest(string $endpoint, array $payload, int $timeout): array
    {
        $ch = curl_init($endpoint);
        if ($ch === false) {
            return [false, 0, 'Unable to initialize cURL', null];
        }

        $json = json_encode($payload, JSON_UNESCAPED_UNICODE);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS => $json === false ? '{}' : $json,
            CURLOPT_TIMEOUT => $timeout,
        ]);

        $result = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = (string) curl_error($ch);

        $ok = $result !== false && $status >= 200 && $status < 300;

        return [$ok, $status, $error, $result];
    }
}

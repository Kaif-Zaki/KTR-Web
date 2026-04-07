# Kottramulla Website (PHP + MySQL)

## What is built
- Public website with separate pages: Home, About, Projects, Contact.
- Contact form saves to MySQL and sends email notifications.
- Admin-only authentication (login, forgot password, reset password).
- Admin profile updates (email and password).
- Admin dashboard with project management (create, edit, delete).
- Admin messages inbox with unread count and email replies to users.
- MySQL migrations + seed data based on provided `.docx` content.

## Routes
- Public:
  - `/` Home
  - `/about` About page
  - `/projects` Projects page
  - `/contact` Contact page
  - `POST /contact` Submit contact form
- Admin auth:
  - `/admin/login`
  - `/admin/forgot-password`
  - `/admin/reset-password`
- Admin panel:
  - `/admin` Dashboard
  - `/admin/projects` Project management
  - `/admin/messages` Contact inbox and replies
  - `/admin/profile` Profile and credentials

## Setup
1. Create your environment file:
   ```bash
   cp .env.example .env
   ```
2. Update DB credentials in `.env`.
   ```env
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kottramulla_website
   DB_USERNAME=your_user
   DB_PASSWORD=your_password
   ```
3. Configure EmailJS and contact email settings in `.env`.
   ```env
   MAIL_ENABLED=true
   MAIL_DRIVER=emailjs
   CONTACT_ADMIN_EMAIL=admin@yourdomain.com
   MAIL_FROM_EMAIL=noreply@yourdomain.com
   MAIL_FROM_NAME="Kottramulla United Welfare Society"
   EMAILJS_ENDPOINT=https://api.emailjs.com/api/v1.0/email/send
   EMAILJS_SERVICE_ID=service_xxxxx
   EMAILJS_TEMPLATE_ID=template_xxxxx
   EMAILJS_CONTACT_TEMPLATE_ID=template_xxxxx
   EMAILJS_PUBLIC_KEY=your_public_key
   EMAILJS_PRIVATE_KEY=your_private_key
   EMAILJS_TIMEOUT=12
   ```
4. Run migrations:
   ```bash
   php database/migrate.php
   ```
5. Start PHP server:
   ```bash
   php -S localhost:8000
   ```
6. Open `http://localhost:8000`

## Default Admin
- Email: `admin@kottramulla.org`
- Password: `admin123`

Change this password after first login from `/admin/profile`.

## EmailJS Template Params
Your EmailJS templates should support these params (as needed):
- `to_email`
- `email`
- `title`
- `subject`
- `name`
- `message`
- `reset_code`
- `reset_token`
- `expires_in_minutes`
- `from_email`
- `from_name`
- `app_name`

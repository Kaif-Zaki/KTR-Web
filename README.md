# Kottramulla Website (PHP + MySQL)

## What is built
- Public website for users (no login required).
- Admin-only login and session authentication.
- Admin dashboard with project management (create, edit, delete).
- MySQL migration + seed data based on provided `.docx` content.

## Routes
- `/` Public site (About + Projects)
- `/admin/login` Admin login
- `/admin/forgot-password` Request reset code
- `/admin/reset-password` Reset password using code
- `/admin` Admin dashboard
- `/admin/projects` Admin project management

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
3. Configure EmailJS for password reset emails in `.env`.
   ```env
   MAIL_ENABLED=true
   MAIL_DRIVER=emailjs
   MAIL_FROM_EMAIL=noreply@yourdomain.com
   MAIL_FROM_NAME="Kottramulla United Welfare Society"
   EMAILJS_ENDPOINT=https://api.emailjs.com/api/v1.0/email/send
   EMAILJS_SERVICE_ID=service_xxxxx
   EMAILJS_TEMPLATE_ID=template_xxxxx
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

Change this password after first login by updating the `admins` table with a new `password_hash`.

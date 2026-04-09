# Kottramulla Website

Modern PHP + MySQL web application for **Kottramulla United Welfare Society** with a public site, donation and membership workflows, and a complete admin panel.


![KTR Banner](./kottramulla-website/public/images/home/banner.png)

---

## Highlights
- Public pages: Home, About, Projects, Project Details, Gallery, Donate, Membership, Contact.
- Donation requests with admin-side inbox and unread indicators.
- Membership applications with admin review and status management.
- Contact form with admin inbox view.
- Admin authentication:
  - Login
  - Forgot password
  - Reset password
- Admin management:
  - Dashboard
  - Projects (CRUD)
  - Gallery (upload/edit/delete)
  - Messages
  - Donations
  - Memberships
  - Profile (email/password update)
- Responsive UI for both user and admin areas.

## Tech Stack
- PHP 8+
- MySQL 8+ (or compatible MariaDB)
- Vanilla JS + CSS
- EmailJS integration for outbound mail events

## Project Structure
```text
.
├── app/                 # Controllers, Models, Core, Support
├── config/              # App, DB, Mail config
├── database/
│   ├── migrations/      # Incremental SQL migrations
│   ├── full_setup.sql   # One-shot DB + tables + seed setup
│   └── migrate.php      # Migration runner
├── public/
│   ├── css/
│   └── images/
├── views/               # User + Admin templates
├── index.php            # Router/front controller
└── router.php           # Local PHP server router
```

## Quick Start

### 1) Prerequisites
- PHP 8.x
- MySQL running locally

### 2) Configure Environment
Create `.env` in project root with your local values:

```env
APP_NAME="Kottramulla United Welfare Society"
APP_URL="http://localhost:8000"
APP_TIMEZONE="Asia/Colombo"

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kottramulla_website
DB_USERNAME=root
DB_PASSWORD=your_password
DB_CHARSET=utf8mb4

MAIL_ENABLED=true
MAIL_DRIVER=emailjs
CONTACT_ADMIN_EMAIL=admin@example.com
MAIL_FROM_EMAIL=noreply@example.com
MAIL_FROM_NAME="Kottramulla United Welfare Society"
EMAILJS_ENDPOINT=https://api.emailjs.com/api/v1.0/email/send
EMAILJS_SERVICE_ID=service_xxxxx
EMAILJS_TEMPLATE_ID=template_xxxxx
EMAILJS_CONTACT_TEMPLATE_ID=template_xxxxx
EMAILJS_PUBLIC_KEY=your_public_key
EMAILJS_PRIVATE_KEY=your_private_key
EMAILJS_TIMEOUT=12
```

### 3) Create Database (Choose One)
1. Migration flow (recommended for development):
```bash
php database/migrate.php
```

2. One-shot SQL setup (Workbench):
- Open `database/full_setup.sql`
- Execute entire script

### 4) Run Locally
```bash
php -S localhost:8000 router.php
```

Open: `http://localhost:8000`

## Default Admin Login
- Email: `admin@kottramulla.org`
- Password: `admin123`

After first login, change credentials from `/admin/profile`.

## Main Routes

### Public
- `GET /`
- `GET /home`
- `GET /about`
- `GET /projects`
- `GET /project-details?id={id}`
- `GET /project-details/{id}`
- `GET /gallery`
- `GET /donate`
- `POST /donate`
- `GET /membership`
- `POST /membership`
- `GET /contact`
- `POST /contact`

### Admin
- `GET /admin/login`
- `POST /admin/login`
- `GET /admin/forgot-password`
- `POST /admin/forgot-password`
- `GET /admin/reset-password`
- `POST /admin/reset-password`
- `POST /admin/logout`
- `GET /admin`
- `GET /admin/projects`
- `GET|POST /admin/projects/create`
- `GET|POST /admin/projects/edit?id={id}`
- `POST /admin/projects/delete?id={id}`
- `GET /admin/gallery`
- `GET|POST /admin/gallery/create`
- `GET|POST /admin/gallery/edit?id={id}`
- `POST /admin/gallery/delete?id={id}`
- `GET /admin/messages`
- `POST /admin/messages/reply`
- `GET /admin/donations`
- `GET /admin/memberships`
- `POST /admin/memberships/status`
- `GET /admin/profile`
- `POST /admin/profile/email`
- `POST /admin/profile/password`

## EmailJS Template Params
Use these params in your EmailJS templates as needed:
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

## Troubleshooting
- `404 on routes`: ensure server started with `router.php`.
- `DB connection failed`: verify `.env` DB values and MySQL service status.
- `Migration already applied`: expected; migration runner skips applied files.
- `Email not sending`: verify EmailJS IDs/keys and endpoint in `.env`.

## Security Notes
- Do not commit real `.env` secrets.
- Rotate exposed keys/passwords before production deployment.
- Use HTTPS and secure production DB credentials.

CREATE TABLE IF NOT EXISTS migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL UNIQUE,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS about_sections (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    quote TEXT NULL,
    volunteer_count INT UNSIGNED DEFAULT 0,
    established_year SMALLINT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS project_categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    description TEXT NULL,
    sort_order INT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    photo_status VARCHAR(80) DEFAULT 'NO Photos',
    amount_lkr DECIMAL(12,2) NULL,
    project_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_projects_category FOREIGN KEY (category_id) REFERENCES project_categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS admin_password_resets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_id INT UNSIGNED NOT NULL,
    token_hash CHAR(64) NOT NULL,
    expires_at DATETIME NOT NULL,
    used_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_admin_password_resets_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
    INDEX idx_admin_reset_lookup (admin_id, token_hash, used_at, expires_at)
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL,
    subject VARCHAR(200) NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_message_replies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    contact_message_id BIGINT UNSIGNED NOT NULL,
    admin_id INT UNSIGNED NOT NULL,
    reply_message TEXT NOT NULL,
    sent_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_contact_reply_message FOREIGN KEY (contact_message_id) REFERENCES contact_messages(id) ON DELETE CASCADE,
    CONSTRAINT fk_contact_reply_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS gallery (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    project_id INT UNSIGNED NULL,
    image_path VARCHAR(255) NOT NULL,
    caption VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_gallery_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS members (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    occupation VARCHAR(255) NOT NULL,
    social_links TEXT NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    whatsapp VARCHAR(20) NULL,
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS home_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hero_kicker VARCHAR(255) DEFAULT 'Society of Hope',
    hero_title TEXT,
    hero_subtitle TEXT,
    hero_lead TEXT,
    legacy_kicker VARCHAR(255) DEFAULT 'Our Legacy',
    legacy_title TEXT,
    legacy_body TEXT,
    legacy_image VARCHAR(255) NULL,
    stat1_num VARCHAR(50) DEFAULT '250+',
    stat1_label VARCHAR(100) DEFAULT 'Active Members',
    stat2_num VARCHAR(50) DEFAULT '40+',
    stat2_label VARCHAR(100) DEFAULT 'Projects Done',
    initiatives_kicker VARCHAR(255) DEFAULT 'Focus Areas',
    initiatives_title VARCHAR(255) DEFAULT 'Strategic Initiatives',
    initiatives_lead TEXT,
    cta_title VARCHAR(255) DEFAULT 'Ready to make a difference?',
    cta_body TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS home_features (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    title VARCHAR(255),
    description TEXT,
    sort_order INT DEFAULT 0
);

-- Seed default admin
INSERT INTO admins (name, email, password_hash)
SELECT * FROM (
    SELECT 'Main Admin', 'admin@kottramulla.org', '$2y$12$keqKPMEGazhE/Y1p5NUl6uBAc2/7Nyf0AZJA6bVzszi4nlhgE.b5.'
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM admins WHERE email = 'admin@kottramulla.org'
) LIMIT 1;

-- Seed about section
INSERT INTO about_sections (title, body, quote, volunteer_count, established_year)
SELECT * FROM (
    SELECT
        'Kottramulla United Welfare Society',
        'The Kottramulla United Welfare Society was established in March 2016. We are a dedicated volunteer team driven by compassion and community service. Every member gives time and expertise to support welfare initiatives and help families in need. We continue to grow through collective support from our community.',
        'Together, we can create lasting change and inspire others to lend a helping hand.',
        250,
        2016
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM about_sections
) LIMIT 1;

-- Seed project categories
INSERT INTO project_categories (name, slug, description, sort_order)
VALUES
('Emergency Relief', 'emergency-relief', 'Rapid response support during disasters and crisis periods.', 1),
('Livelihood', 'livelihood', 'Income recovery, business support, and vocational empowerment.', 2),
('Education', 'education', 'Education-focused projects and student support.', 3),
('Health', 'health', 'Medical assistance and healthcare-focused support.', 4),
('Water & Sanitation', 'water-sanitation', 'Clean water and sanitation projects.', 5)
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Seed home settings (required for homepage render)
INSERT INTO home_settings (
    id,
    hero_kicker,
    hero_title,
    hero_subtitle,
    hero_lead,
    legacy_kicker,
    legacy_title,
    legacy_body,
    stat1_num,
    stat1_label,
    stat2_num,
    stat2_label,
    initiatives_kicker,
    initiatives_title,
    initiatives_lead,
    cta_title,
    cta_body
)
SELECT * FROM (
    SELECT
        1,
        'Society of Hope',
        'Together for a Better Kottramulla',
        'Service with Compassion',
        'We unite volunteers, families, and donors to create sustainable support for people in need.',
        'Our Legacy',
        'A Community Built on Care',
        'Since 2016, Kottramulla United Welfare Society has worked hand in hand with residents to support education, health, and emergency relief.',
        '250+',
        'Active Members',
        '40+',
        'Projects Done',
        'Focus Areas',
        'Strategic Initiatives',
        'We focus on urgent relief, long-term livelihoods, and opportunities for youth and families.',
        'Ready to make a difference?',
        'Join our efforts by volunteering, donating, or partnering with us on upcoming community projects.'
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM home_settings WHERE id = 1
) LIMIT 1;

-- Seed default home features
INSERT INTO home_features (icon, title, description, sort_order)
VALUES
('heart', 'Community Support', 'Direct support programs for families who need immediate assistance.', 1),
('book', 'Education First', 'Scholarships, supplies, and mentoring for students and young learners.', 2),
('shield', 'Health & Welfare', 'Health-related aid and welfare initiatives for vulnerable groups.', 3)
ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    description = VALUES(description);

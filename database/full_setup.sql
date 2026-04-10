-- Kottramulla Website: Full Database Setup (Updated)
-- Execute this entire script in MySQL Workbench.

CREATE DATABASE IF NOT EXISTS `kottramulla_website`
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE `kottramulla_website`;

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
    mission_title VARCHAR(255) DEFAULT 'Our Mission',
    mission_body TEXT NULL,
    vision_title VARCHAR(255) DEFAULT 'Our Vision',
    vision_body TEXT NULL,
    values_title VARCHAR(255) DEFAULT 'Our Core Values',
    values_item1 VARCHAR(255) DEFAULT 'Compassion in action',
    values_item2 VARCHAR(255) DEFAULT 'Transparency in every initiative',
    values_item3 VARCHAR(255) DEFAULT 'Unity through volunteerism',
    timeline_kicker VARCHAR(255) DEFAULT 'Progress Timeline',
    timeline_title VARCHAR(255) DEFAULT 'Important milestones in our journey',
    timeline_item1_year VARCHAR(60) DEFAULT '2016',
    timeline_item1_body TEXT NULL,
    timeline_item2_year VARCHAR(60) DEFAULT '2020',
    timeline_item2_body TEXT NULL,
    timeline_item3_year VARCHAR(60) DEFAULT 'Today',
    timeline_item3_body TEXT NULL,
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
    occupation VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS home_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hero_kicker VARCHAR(255) DEFAULT 'Society of Hope',
    hero_title TEXT,
    hero_subtitle TEXT,
    hero_lead TEXT,
    hero_image VARCHAR(255) NULL,
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
    journey_kicker VARCHAR(255) DEFAULT 'Journey Highlights',
    journey_title VARCHAR(255) DEFAULT 'How our community story keeps growing',
    journey_lead TEXT NULL,
    journey_item1_year VARCHAR(60) DEFAULT '2016',
    journey_item1_title VARCHAR(255) DEFAULT 'Society Formation',
    journey_item1_body TEXT NULL,
    journey_item2_year VARCHAR(60) DEFAULT '2019',
    journey_item2_title VARCHAR(255) DEFAULT 'Structured Programs',
    journey_item2_body TEXT NULL,
    journey_item3_year VARCHAR(60) DEFAULT 'Today',
    journey_item3_title VARCHAR(255) DEFAULT 'Long-Term Impact',
    journey_item3_body TEXT NULL,
    approach_kicker VARCHAR(255) DEFAULT 'Our Approach',
    approach_title VARCHAR(255) DEFAULT 'A transparent model for meaningful outcomes',
    approach_item1_title VARCHAR(255) DEFAULT 'Listen First',
    approach_item1_body TEXT NULL,
    approach_item2_title VARCHAR(255) DEFAULT 'Mobilize Fast',
    approach_item2_body TEXT NULL,
    approach_item3_title VARCHAR(255) DEFAULT 'Measure & Improve',
    approach_item3_body TEXT NULL,
    approach_item4_title VARCHAR(255) DEFAULT 'Active Focus Areas',
    approach_item4_body TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS home_features (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    title VARCHAR(255),
    description TEXT,
    sort_order INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS website_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    website_title VARCHAR(255) NOT NULL DEFAULT 'Kottramulla United Welfare Society',
    website_description TEXT,
    logo_path VARCHAR(255) DEFAULT NULL,
    logo_alt_text VARCHAR(255) DEFAULT 'Kottramulla Logo',
    favicon_path VARCHAR(255) DEFAULT NULL,
    footer_copyright_text VARCHAR(255) DEFAULT '© 2024 Kottramulla United Welfare Society. All rights reserved.',
    footer_email VARCHAR(255) DEFAULT NULL,
    footer_phone VARCHAR(20) DEFAULT NULL,
    footer_address TEXT DEFAULT NULL,
    social_facebook VARCHAR(255) DEFAULT NULL,
    social_twitter VARCHAR(255) DEFAULT NULL,
    social_instagram VARCHAR(255) DEFAULT NULL,
    social_linkedin VARCHAR(255) DEFAULT NULL,
    social_youtube VARCHAR(255) DEFAULT NULL,
    primary_color VARCHAR(7) DEFAULT '#1e40af',
    secondary_color VARCHAR(7) DEFAULT '#7c3aed',
    accent_color VARCHAR(7) DEFAULT '#f59e0b',
    projects_insight3_title VARCHAR(255) DEFAULT 'Transparent',
    projects_insight3_body TEXT NULL,
    gallery_overview1_title VARCHAR(255) DEFAULT 'Living archive of service',
    gallery_overview1_body TEXT NULL,
    gallery_overview3_title VARCHAR(255) DEFAULT 'People-centered stories',
    gallery_overview3_body TEXT NULL,
    members_overview2_title VARCHAR(255) DEFAULT 'Volunteer-led',
    members_overview2_body TEXT NULL,
    members_overview3_title VARCHAR(255) DEFAULT 'Open to all',
    members_overview3_body TEXT NULL,
    contact_assurance1_title VARCHAR(255) DEFAULT 'Quick Response',
    contact_assurance1_body TEXT NULL,
    contact_assurance2_title VARCHAR(255) DEFAULT 'Meaningful Guidance',
    contact_assurance2_body TEXT NULL,
    contact_assurance3_title VARCHAR(255) DEFAULT 'Community First',
    contact_assurance3_body TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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

-- Seed website settings
INSERT INTO website_settings (
    id,
    website_title,
    website_description,
    logo_alt_text,
    footer_copyright_text,
    primary_color,
    secondary_color,
    accent_color
)
SELECT * FROM (
    SELECT
        1,
        'Kottramulla United Welfare Society',
        'A dedicated volunteer-driven organization serving communities with compassion and sustainable welfare initiatives.',
        'Kottramulla Logo',
        '© 2024 Kottramulla United Welfare Society. All rights reserved.',
        '#1e40af',
        '#7c3aed',
        '#f59e0b'
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM website_settings WHERE id = 1
) LIMIT 1;

-- Seed fallback text for page-detail text fields
UPDATE home_settings
SET
    journey_lead = COALESCE(NULLIF(journey_lead, ''), 'From the first volunteer circle to today, every milestone reflects consistent grassroots action and trusted partnerships.'),
    journey_item1_body = COALESCE(NULLIF(journey_item1_body, ''), 'KUWS started with local volunteers focused on urgent household support and shared welfare activities.'),
    journey_item2_body = COALESCE(NULLIF(journey_item2_body, ''), 'We expanded into recurring education, relief, and family assistance programs with clearer planning cycles.'),
    journey_item3_body = COALESCE(NULLIF(journey_item3_body, ''), 'Our team now balances immediate aid and sustainable initiatives to build resilience across the community.'),
    approach_item1_body = COALESCE(NULLIF(approach_item1_body, ''), 'We assess needs directly with families and neighbors before planning any intervention.'),
    approach_item2_body = COALESCE(NULLIF(approach_item2_body, ''), 'Volunteers, donors, and partners coordinate quickly to ensure support reaches people on time.'),
    approach_item3_body = COALESCE(NULLIF(approach_item3_body, ''), 'Each cycle is reviewed so future programs deliver stronger and more sustainable community results.'),
    approach_item4_body = COALESCE(NULLIF(approach_item4_body, ''), 'Key initiative areas are currently active with recurring community engagement.')
WHERE id = 1;

UPDATE about_sections
SET
    mission_body = COALESCE(NULLIF(mission_body, ''), 'To uplift vulnerable families through consistent welfare support, dignity-focused outreach, and long-term community empowerment.'),
    vision_body = COALESCE(NULLIF(vision_body, ''), 'To build a compassionate, resilient society where every household has access to care, opportunity, and collective strength.'),
    timeline_item1_body = COALESCE(NULLIF(timeline_item1_body, ''), 'KUWS established in Kottramulla with an initial volunteer-driven welfare network.'),
    timeline_item2_body = COALESCE(NULLIF(timeline_item2_body, ''), 'Expanded recurring support programs for education, emergency relief, and family assistance.'),
    timeline_item3_body = COALESCE(NULLIF(timeline_item3_body, ''), 'Growing partnerships and stronger community coordination to scale sustainable social impact.')
WHERE id = (SELECT id FROM (SELECT id FROM about_sections ORDER BY id ASC LIMIT 1) AS t);

UPDATE website_settings
SET
    projects_insight3_body = COALESCE(NULLIF(projects_insight3_body, ''), 'Each project card includes status context and quick access to full details.'),
    gallery_overview1_body = COALESCE(NULLIF(gallery_overview1_body, ''), 'Every image captures volunteer effort, community participation, and progress across initiatives.'),
    gallery_overview3_body = COALESCE(NULLIF(gallery_overview3_body, ''), 'Captions and tags help connect each photo to the welfare journey behind it.'),
    members_overview2_body = COALESCE(NULLIF(members_overview2_body, ''), 'Our initiatives are organized and delivered through collaborative volunteer leadership.'),
    members_overview3_body = COALESCE(NULLIF(members_overview3_body, ''), 'We welcome compassionate people who want to contribute skills, time, or guidance.'),
    contact_assurance1_body = COALESCE(NULLIF(contact_assurance1_body, ''), 'We review incoming messages regularly and reply as fast as possible.'),
    contact_assurance2_body = COALESCE(NULLIF(contact_assurance2_body, ''), 'Whether you want to donate, volunteer, or partner, we guide you to the right next step.'),
    contact_assurance3_body = COALESCE(NULLIF(contact_assurance3_body, ''), 'Every conversation is handled with care, respect, and a practical action mindset.')
WHERE id = 1;

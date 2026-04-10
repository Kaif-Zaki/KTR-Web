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
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed default settings
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

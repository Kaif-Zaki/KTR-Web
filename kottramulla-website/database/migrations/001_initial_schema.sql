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

INSERT INTO admins (name, email, password_hash)
SELECT * FROM (
    SELECT 'Main Admin', 'admin@kottramulla.org', '$2y$12$keqKPMEGazhE/Y1p5NUl6uBAc2/7Nyf0AZJA6bVzszi4nlhgE.b5.'
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM admins WHERE email = 'admin@kottramulla.org'
) LIMIT 1;

INSERT INTO about_sections (title, body, volunteer_count, established_year)
SELECT * FROM (
    SELECT
        'About Kottramulla United Welfare Society',
        'Kottramulla United Welfare Society was established in March 2016 with a vision to make a difference. We are a dedicated team of volunteers committed to serving our community.',
        28,
        2016
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM about_sections
) LIMIT 1;

INSERT INTO project_categories (name, slug, description, sort_order)
VALUES
('Emergency Relief', 'emergency-relief', 'Rapid response support during disasters and crisis periods.', 1),
('Livelihood', 'livelihood', 'Income recovery, business support, and vocational empowerment.', 2),
('Education', 'education', 'Education-focused projects and student support.', 3),
('Health', 'health', 'Medical assistance and healthcare-focused support.', 4),
('Water & Sanitation', 'water-sanitation', 'Clean water and sanitation projects.', 5)
ON DUPLICATE KEY UPDATE name = VALUES(name);

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
        'Kottramulla United Welfare Society was established in March 2016 with a vision to make a difference. We are a dedicated team of 28 volunteers driven by passion to serve our community. We operate on a subscription-based model where members contribute monthly to support initiatives. We are grateful for NGOs, well-wishers, and donors whose support helps us serve those in need and create lasting change.',
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
('Education (School)', 'education-school', 'School-focused projects and student support.', 3),
('Education (Madrasa)', 'education-madrasa', 'Religious and madrasa education support projects.', 4),
('Construction & Development', 'construction-development', 'Community infrastructure and development projects.', 5),
('Seasonal Projects', 'seasonal-projects', 'Ramadan and special seasonal support activities.', 6),
('Health', 'health', 'Medical assistance and healthcare-focused support.', 7),
('Orphans Caring', 'orphans-caring', 'Support initiatives for fatherless children and orphans.', 8),
('Shelter & Infrastructure', 'shelter-infrastructure', 'Household and utility infrastructure support.', 9),
('Water & Sanitation', 'water-sanitation', 'Clean water and sanitation projects.', 10),
('Funding Activities', 'funding-activities', 'Fundraising and sustainability events.', 11),
('Other Activities', 'other-activities', 'Meetings, training, and community-wide support activities.', 12)
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO projects (category_id, title, description, photo_status, amount_lkr)
SELECT c.id, 'Supporting COVID-19 relief with dry food donations', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Distributing Dry Food Packs for flood victims', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Distribution of Dry Foods for Flood Victims (Muslim Hands)', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Free Water Supply Amidst Flood Crisis', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Providing Cooked Meals for Flood Victims', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Distributing 400 packs of dry food for flood victims', 'Reported value: Rs. 2,000,000', 'NO Photos', 2000000 FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Donation to distribute dry food during COVID period', 'Donation to trustees in June 2021', 'NO Photos', 85000 FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Donation to trustees during flood', NULL, 'NO Photos', 54000 FROM project_categories c WHERE c.slug = 'emergency-relief'
UNION ALL SELECT c.id, 'Sewing machine support', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Donation of industrial equipment', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Merchandise offerings support', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Donation of motorcycle', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Donation of cattle', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Repairing business premises', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Business assistance / support', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Microfinance livelihood support', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Livelihood ADP and recovery support', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Women rehabilitation and skill training', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Vocational training initiatives', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'livelihood'
UNION ALL SELECT c.id, 'Facilitating electricity connection fee for playground lighting', NULL, 'NO Photos', 5000 FROM project_categories c WHERE c.slug = 'education-school'
UNION ALL SELECT c.id, 'Sponsoring certificates for athletic meet in 2021', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-school'
UNION ALL SELECT c.id, 'Granting scholarships to Grade 11 students at JMC Institute', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-school'
UNION ALL SELECT c.id, 'Tree plantation initiative', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'education-school'
UNION ALL SELECT c.id, 'Sponsoring certificates in 2024', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-school'
UNION ALL SELECT c.id, 'Presented 2nd place prize to Al-Hira M.M.V OBA', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-school'
UNION ALL SELECT c.id, 'Donated 20 LED bulbs to Minhajiyya Arabic college', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Sponsoring Ramzan Iftar', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Light bulb donation', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Student dinner arrangement', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Donation for Kidu meal', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Coconut tree planting', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Contribution for land purchase', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'education-madrasa'
UNION ALL SELECT c.id, 'Flagpole installation at Urban Development building', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'construction-development'
UNION ALL SELECT c.id, 'Donation for lavatory at Thakkiya Mosque', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'construction-development'
UNION ALL SELECT c.id, 'Donation for Grand Mosque Mimber construction', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'construction-development'
UNION ALL SELECT c.id, 'Contributing sand at burial ground', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'construction-development'
UNION ALL SELECT c.id, 'Sponsoring Ramadan porridge', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'seasonal-projects'
UNION ALL SELECT c.id, 'Zakathul Fithr distribution', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'seasonal-projects'
UNION ALL SELECT c.id, 'Free eye surgery in collaboration with Muslim Hand NGO', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'health'
UNION ALL SELECT c.id, 'Procurement of wheelchair and medical equipment', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'health'
UNION ALL SELECT c.id, 'Monthly allowance support for fatherless children', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'orphans-caring'
UNION ALL SELECT c.id, 'Facilitating complimentary electricity connections', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'shelter-infrastructure'
UNION ALL SELECT c.id, 'Tube well construction', NULL, 'Photos Pending', NULL FROM project_categories c WHERE c.slug = 'water-sanitation'
UNION ALL SELECT c.id, 'Organizing Elle tournament to generate income', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'funding-activities'
UNION ALL SELECT c.id, 'Project planning discussion with NGO', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'other-activities'
UNION ALL SELECT c.id, 'Supporting Maulavi family contribution', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'other-activities'
UNION ALL SELECT c.id, 'Distribution of Fitra rice to widows', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'other-activities'
UNION ALL SELECT c.id, 'National flag stage support', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'other-activities'
UNION ALL SELECT c.id, 'NIC distribution one-day workshop support', NULL, 'Photos sent', NULL FROM project_categories c WHERE c.slug = 'other-activities'
UNION ALL SELECT c.id, 'MFCD meeting and training', NULL, 'NO Photos', NULL FROM project_categories c WHERE c.slug = 'other-activities';

-- Add editable content fields for newly added public page detail sections.

-- Home page detail fields
SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_kicker') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_kicker VARCHAR(255) DEFAULT ''Journey Highlights'' AFTER cta_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_title VARCHAR(255) DEFAULT ''How our community story keeps growing'' AFTER journey_kicker',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_lead') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_lead TEXT AFTER journey_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item1_year') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item1_year VARCHAR(60) DEFAULT ''2016'' AFTER journey_lead',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item1_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item1_title VARCHAR(255) DEFAULT ''Society Formation'' AFTER journey_item1_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item1_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item1_body TEXT AFTER journey_item1_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item2_year') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item2_year VARCHAR(60) DEFAULT ''2019'' AFTER journey_item1_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item2_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item2_title VARCHAR(255) DEFAULT ''Structured Programs'' AFTER journey_item2_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item2_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item2_body TEXT AFTER journey_item2_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item3_year') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item3_year VARCHAR(60) DEFAULT ''Today'' AFTER journey_item2_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item3_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item3_title VARCHAR(255) DEFAULT ''Long-Term Impact'' AFTER journey_item3_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'journey_item3_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN journey_item3_body TEXT AFTER journey_item3_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_kicker') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_kicker VARCHAR(255) DEFAULT ''Our Approach'' AFTER journey_item3_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_title VARCHAR(255) DEFAULT ''A transparent model for meaningful outcomes'' AFTER approach_kicker',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item1_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item1_title VARCHAR(255) DEFAULT ''Listen First'' AFTER approach_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item1_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item1_body TEXT AFTER approach_item1_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item2_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item2_title VARCHAR(255) DEFAULT ''Mobilize Fast'' AFTER approach_item1_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item2_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item2_body TEXT AFTER approach_item2_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item3_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item3_title VARCHAR(255) DEFAULT ''Measure & Improve'' AFTER approach_item2_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item3_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item3_body TEXT AFTER approach_item3_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item4_title') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item4_title VARCHAR(255) DEFAULT ''Active Focus Areas'' AFTER approach_item3_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'home_settings' AND COLUMN_NAME = 'approach_item4_body') = 0,
    'ALTER TABLE home_settings ADD COLUMN approach_item4_body TEXT AFTER approach_item4_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

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

-- About page detail fields
SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'mission_title') = 0,
    'ALTER TABLE about_sections ADD COLUMN mission_title VARCHAR(255) DEFAULT ''Our Mission'' AFTER established_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'mission_body') = 0,
    'ALTER TABLE about_sections ADD COLUMN mission_body TEXT AFTER mission_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'vision_title') = 0,
    'ALTER TABLE about_sections ADD COLUMN vision_title VARCHAR(255) DEFAULT ''Our Vision'' AFTER mission_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'vision_body') = 0,
    'ALTER TABLE about_sections ADD COLUMN vision_body TEXT AFTER vision_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'values_title') = 0,
    'ALTER TABLE about_sections ADD COLUMN values_title VARCHAR(255) DEFAULT ''Our Core Values'' AFTER vision_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'values_item1') = 0,
    'ALTER TABLE about_sections ADD COLUMN values_item1 VARCHAR(255) DEFAULT ''Compassion in action'' AFTER values_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'values_item2') = 0,
    'ALTER TABLE about_sections ADD COLUMN values_item2 VARCHAR(255) DEFAULT ''Transparency in every initiative'' AFTER values_item1',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'values_item3') = 0,
    'ALTER TABLE about_sections ADD COLUMN values_item3 VARCHAR(255) DEFAULT ''Unity through volunteerism'' AFTER values_item2',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_kicker') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_kicker VARCHAR(255) DEFAULT ''Progress Timeline'' AFTER values_item3',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_title') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_title VARCHAR(255) DEFAULT ''Important milestones in our journey'' AFTER timeline_kicker',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_item1_year') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_item1_year VARCHAR(60) DEFAULT ''2016'' AFTER timeline_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_item1_body') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_item1_body TEXT AFTER timeline_item1_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_item2_year') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_item2_year VARCHAR(60) DEFAULT ''2020'' AFTER timeline_item1_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_item2_body') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_item2_body TEXT AFTER timeline_item2_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_item3_year') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_item3_year VARCHAR(60) DEFAULT ''Today'' AFTER timeline_item2_body',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'about_sections' AND COLUMN_NAME = 'timeline_item3_body') = 0,
    'ALTER TABLE about_sections ADD COLUMN timeline_item3_body TEXT AFTER timeline_item3_year',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

UPDATE about_sections
SET
    mission_body = COALESCE(NULLIF(mission_body, ''), 'To uplift vulnerable families through consistent welfare support, dignity-focused outreach, and long-term community empowerment.'),
    vision_body = COALESCE(NULLIF(vision_body, ''), 'To build a compassionate, resilient society where every household has access to care, opportunity, and collective strength.'),
    timeline_item1_body = COALESCE(NULLIF(timeline_item1_body, ''), 'KUWS established in Kottramulla with an initial volunteer-driven welfare network.'),
    timeline_item2_body = COALESCE(NULLIF(timeline_item2_body, ''), 'Expanded recurring support programs for education, emergency relief, and family assistance.'),
    timeline_item3_body = COALESCE(NULLIF(timeline_item3_body, ''), 'Growing partnerships and stronger community coordination to scale sustainable social impact.')
WHERE id = (SELECT id FROM (SELECT id FROM about_sections ORDER BY id ASC LIMIT 1) as t);

-- Website settings fields for projects/gallery/members/contact detail cards
SET @sql = IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'website_settings' AND COLUMN_NAME = 'projects_insight3_title') = 0,
    'ALTER TABLE website_settings
        ADD COLUMN projects_insight3_title VARCHAR(255) DEFAULT ''Transparent'' AFTER accent_color,
        ADD COLUMN projects_insight3_body TEXT AFTER projects_insight3_title,
        ADD COLUMN gallery_overview1_title VARCHAR(255) DEFAULT ''Living archive of service'' AFTER projects_insight3_body,
        ADD COLUMN gallery_overview1_body TEXT AFTER gallery_overview1_title,
        ADD COLUMN gallery_overview3_title VARCHAR(255) DEFAULT ''People-centered stories'' AFTER gallery_overview1_body,
        ADD COLUMN gallery_overview3_body TEXT AFTER gallery_overview3_title,
        ADD COLUMN members_overview2_title VARCHAR(255) DEFAULT ''Volunteer-led'' AFTER gallery_overview3_body,
        ADD COLUMN members_overview2_body TEXT AFTER members_overview2_title,
        ADD COLUMN members_overview3_title VARCHAR(255) DEFAULT ''Open to all'' AFTER members_overview2_body,
        ADD COLUMN members_overview3_body TEXT AFTER members_overview3_title,
        ADD COLUMN contact_assurance1_title VARCHAR(255) DEFAULT ''Quick Response'' AFTER members_overview3_body,
        ADD COLUMN contact_assurance1_body TEXT AFTER contact_assurance1_title,
        ADD COLUMN contact_assurance2_title VARCHAR(255) DEFAULT ''Meaningful Guidance'' AFTER contact_assurance1_body,
        ADD COLUMN contact_assurance2_body TEXT AFTER contact_assurance2_title,
        ADD COLUMN contact_assurance3_title VARCHAR(255) DEFAULT ''Community First'' AFTER contact_assurance2_body,
        ADD COLUMN contact_assurance3_body TEXT AFTER contact_assurance3_title',
    'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

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

-- 1. Create and Use Database
CREATE DATABASE IF NOT EXISTS kottramulla_db;
USE kottramulla_db;


CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(100) NOT NULL, 
    description TEXT,
    status ENUM('planned', 'ongoing', 'completed') DEFAULT 'planned',
    date DATE,
    budget_used DECIMAL(10,2) DEFAULT NULL, 
    photos JSON DEFAULT NULL, 
    ngo_partner VARCHAR(150) DEFAULT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_name VARCHAR(100) NOT NULL,
    email VARCHAR(150),
    amount DECIMAL(10,2) NOT NULL, 
    type ENUM('one-time', 'monthly') DEFAULT 'one-time', 
    project_id INT DEFAULT NULL,
    message TEXT,
    date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
);


CREATE TABLE IF NOT EXISTS gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT DEFAULT NULL,
    image_path VARCHAR(255) NOT NULL, 
    caption VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);
-- Run this in phpMyAdmin (XAMPP) or MySQL before using the site.

CREATE DATABASE IF NOT EXISTS pixel_dice_cafe;
USE pixel_dice_cafe;

CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    plan VARCHAR(50) NOT NULL,
    message TEXT,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample members so the table is not empty on first run.
-- All sample passwords are the hashed form of "password123".
INSERT IGNORE INTO members (id, name, email, password, plan, message, registered_at) VALUES
(1, 'Amara Otieno', 'amara.otieno@example.com', '$2y$10$CA3OyQgarXN9zjD6YltxX..b4r7HjR/C9MazBuRbMtB00XINKQevi', 'Student (Free)', 'Love strategy games, especially Catan.', '2026-08-03 10:15:00'),
(2, 'Brian Mwangi', 'brian.mwangi@example.com', '$2y$10$CA3OyQgarXN9zjD6YltxX..b4r7HjR/C9MazBuRbMtB00XINKQevi', 'Regular', 'Can I book a table for six on Friday?', '2026-08-04 16:40:00'),
(3, 'Chloe Baptiste', 'chloe.baptiste@example.com', '$2y$10$CA3OyQgarXN9zjD6YltxX..b4r7HjR/C9MazBuRbMtB00XINKQevi', 'Student (Free)', 'New to board games and looking for beginner nights.', '2026-08-06 12:05:00'),
(4, 'Daniel Kimani', 'daniel.kimani@example.com', '$2y$10$CA3OyQgarXN9zjD6YltxX..b4r7HjR/C9MazBuRbMtB00XINKQevi', 'Regular', '', '2026-08-07 18:22:00'),
(5, 'Elena Rossi', 'elena.rossi@example.com', '$2y$10$CA3OyQgarXN9zjD6YltxX..b4r7HjR/C9MazBuRbMtB00XINKQevi', 'Regular', 'Do you host tournaments for Ticket to Ride?', '2026-08-09 09:30:00'),
(6, 'Farid Hassan', 'farid.hassan@example.com', '$2y$10$CA3OyQgarXN9zjD6YltxX..b4r7HjR/C9MazBuRbMtB00XINKQevi', 'Student (Free)', 'Great coffee and friendly staff.', '2026-08-11 20:10:00');

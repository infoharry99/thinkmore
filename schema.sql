-- =========================================================
-- ThinkClear Application Complete MySQL Database DDL Schema
-- Compatible with MySQL 5.7+ / MySQL 8.0+ / MariaDB
-- =========================================================

CREATE DATABASE IF NOT EXISTS `thinkclear_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `thinkclear_db`;

-- Disable Foreign Key checks temporarily for clean setup
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `certificates`;
DROP TABLE IF EXISTS `subscriptions`;
DROP TABLE IF EXISTS `foundation_feedbacks`;
DROP TABLE IF EXISTS `progress_checks`;
DROP TABLE IF EXISTS `reflections`;
DROP TABLE IF EXISTS `cases`;
DROP TABLE IF EXISTS `personal_access_tokens`;
DROP TABLE IF EXISTS `users`;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------
-- 1. Users Table
-- ---------------------------------------------------------
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'user',
  `current_day` INT NOT NULL DEFAULT 1,
  `phase` INT NOT NULL DEFAULT 0,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 2. Personal Access Tokens Table (Laravel Sanctum API Auth)
-- ---------------------------------------------------------
CREATE TABLE `personal_access_tokens` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tokenable_type` VARCHAR(255) NOT NULL,
  `tokenable_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `token` VARCHAR(64) NOT NULL UNIQUE,
  `abilities` TEXT NULL DEFAULT NULL,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL,
  `expires_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 3. Cases Table (60-Day Scenario Library & 6-Step Framework)
-- ---------------------------------------------------------
CREATE TABLE `cases` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `case_id` VARCHAR(50) NOT NULL UNIQUE,
  `domain` VARCHAR(100) NOT NULL,
  `phase_target` INT NOT NULL DEFAULT 1,
  `trap_target` JSON NOT NULL,
  `opening_scenario` TEXT NOT NULL,
  `step1_detect` JSON NULL DEFAULT NULL,
  `step2_decode` JSON NULL DEFAULT NULL,
  `step3_reality_check` JSON NULL DEFAULT NULL,
  `step4_reframe` JSON NULL DEFAULT NULL,
  `step5_intervention` JSON NULL DEFAULT NULL,
  `step6_internalize` JSON NULL DEFAULT NULL,
  `recurrence_case_id` VARCHAR(50) NULL DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 4. Reflections Table (Minimal Retention Rule)
-- ---------------------------------------------------------
CREATE TABLE `reflections` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `case_id` BIGINT UNSIGNED NOT NULL,
  `day_number` INT NOT NULL,
  `internalize_text` VARCHAR(280) NOT NULL,
  `submitted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_reflections_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reflections_case` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 5. Progress Checks Table (Days 3, 7, 12, 17, 60 Comparison)
-- ---------------------------------------------------------
CREATE TABLE `progress_checks` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `case_id` BIGINT UNSIGNED NOT NULL,
  `day_number` INT NOT NULL,
  `fact_line` TEXT NOT NULL,
  `story_line` TEXT NOT NULL,
  `trap_selected` VARCHAR(100) NULL DEFAULT NULL,
  `user_reframe` TEXT NULL DEFAULT NULL,
  `user_action` TEXT NULL DEFAULT NULL,
  `submitted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_progress_checks_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_progress_checks_case` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 6. Foundation Feedbacks Table (60-Day Survey PDF 1 Spec)
-- ---------------------------------------------------------
CREATE TABLE `foundation_feedbacks` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `judgment_impact_score` TINYINT UNSIGNED NOT NULL,
  `technique_applied` ENUM('multiple', 'once_or_twice', 'not_yet', 'dont_remember') NOT NULL,
  `recommend_score` TINYINT UNSIGNED NOT NULL,
  `testimonial_text` VARCHAR(280) NULL DEFAULT NULL,
  `improvement_feedback` VARCHAR(280) NULL DEFAULT NULL,
  `submitted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_foundation_feedbacks_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 7. Subscriptions Table
-- ---------------------------------------------------------
CREATE TABLE `subscriptions` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `plan_type` ENUM('free', 'monthly', 'annual', '100_day') NOT NULL DEFAULT 'free',
  `status` ENUM('active', 'expired', 'canceled') NOT NULL DEFAULT 'active',
  `starts_at` TIMESTAMP NULL DEFAULT NULL,
  `ends_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_subscriptions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 8. Certificates Table (TCJP Certification)
-- ---------------------------------------------------------
CREATE TABLE `certificates` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `program_type` ENUM('foundation', 'advanced') NOT NULL DEFAULT 'foundation',
  `verification_code` VARCHAR(100) NOT NULL UNIQUE,
  `qr_code_url` VARCHAR(555) NULL DEFAULT NULL,
  `pdf_url` VARCHAR(555) NULL DEFAULT NULL,
  `issued_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_certificates_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* INITIAL SEED DATA */

-- Seed Admin User (Password: password123)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `current_day`, `phase`) VALUES
(1, 'Dr. Arun R. Mishra (Admin)', 'admin@thinkclear.co.in', '$2y$12$R94i8w.9u5.R5y7N.j2Sg.N8qJ6K3M5N8O8P8Q8R8S8T8U8V8W8X8Y', 'admin', 60, 3);

-- Seed Sample Student User (Password: password123)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `current_day`, `phase`) VALUES
(2, 'Arun Mishra', 'arun@example.com', '$2y$12$R94i8w.9u5.R5y7N.j2Sg.N8qJ6K3M5N8O8P8Q8R8S8T8U8V8W8X8Y', 'user', 7, 1);

-- Seed Reference Case Study P1-001 ("The Silent Evening")
INSERT INTO `cases` (`id`, `case_id`, `domain`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `is_active`) VALUES
(1, 'P1-001', 'Relationships/Family', 1, 
'["Mind Reading", "Emotional Reasoning"]', 
'Rohan gets home from work, says a quick "hi," goes to the bedroom, and doesn\'t say much through dinner. His wife, Priya, notices he\'s been unusually quiet for two hours.',
'{"fact": "Rohan said little for about two hours after coming home.", "story": "He\'s upset with me. Something\'s wrong between us.", "prompt": "Before you go further — write the fact in one line, and the story in one line."}',
'{"trap": "Mind Reading + Emotional Reasoning", "explanation": "Assuming his internal state and treating her own anxiety as proof something is wrong."}',
'{"q1": "Is quietness after work normal for him on some days, or is this new?", "q2": "What happened today that has nothing to do with her?", "q3": "Has he actually said or done anything pointed at her?", "q4": "If a friend described this exact scene, would she assume the same thing?", "q5": "What\'s the actual evidence he\'s upset with her?"}',
'{"option1": "He had a rough day at work and is decompressing.", "option2": "He\'s mentally stuck on a problem and hasn\'t switched contexts yet."}',
'{"action": "Instead of asking \"What\'s wrong with you?\" she says: \"You\'ve been quiet — long day?\""}',
'{"principle": "Silence is not a message. It\'s a blank I fill in — check before I fill it with the worst option."}',
1);

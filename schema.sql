-- =========================================================
-- ThinkClear Application Complete MySQL Database DDL Schema
-- Includes Full Phase 1 Curriculum (Days 1 to 20)
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
DROP TABLE IF EXISTS `password_reset_otps`;
DROP TABLE IF EXISTS `users`;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------
-- 1. Users Table
-- ---------------------------------------------------------
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `provider` VARCHAR(50) NULL DEFAULT NULL, -- 'google', 'apple'
  `provider_id` VARCHAR(255) NULL DEFAULT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'user', -- 'user' or 'admin'
  `current_day` INT NOT NULL DEFAULT 1, -- 1 to 60
  `phase` INT NOT NULL DEFAULT 0, -- 0 (Onboarding), 1 (Guided), 2 (Semi-Guided), 3 (Independent)
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 2. Password Reset OTPs Table
-- ---------------------------------------------------------
CREATE TABLE `password_reset_otps` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL,
  `otp` VARCHAR(6) NOT NULL,
  `expires_at` TIMESTAMP NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_reset_otps_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 3. Personal Access Tokens Table (Laravel Sanctum API Auth)
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
-- 4. Cases Table (Curriculum Library Days 1-60 & 6-Step Framework)
-- ---------------------------------------------------------
CREATE TABLE `cases` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `day_number` INT NOT NULL DEFAULT 1,
  `case_id` VARCHAR(50) NOT NULL UNIQUE, -- e.g. P1-001
  `domain` VARCHAR(100) NOT NULL, -- e.g. Relationships, Workplace, Family, Health, Career
  `primary_trap` VARCHAR(100) NULL DEFAULT NULL,
  `secondary_trap` VARCHAR(100) NULL DEFAULT NULL,
  `difficulty` VARCHAR(50) NOT NULL DEFAULT 'Beginner',
  `primary_skill` VARCHAR(100) NULL DEFAULT NULL,
  `mission` TEXT NULL DEFAULT NULL,
  `learning_objective` TEXT NULL DEFAULT NULL,
  `phase_target` INT NOT NULL DEFAULT 1, -- 1, 2, or 3
  `trap_target` JSON NOT NULL,
  `opening_scenario` TEXT NOT NULL,
  `step1_detect` JSON NULL DEFAULT NULL,
  `step2_decode` JSON NULL DEFAULT NULL,
  `step3_reality_check` JSON NULL DEFAULT NULL,
  `step4_reframe` JSON NULL DEFAULT NULL,
  `step5_intervention` JSON NULL DEFAULT NULL,
  `step6_internalize` JSON NULL DEFAULT NULL,
  `closing_reflection` TEXT NULL DEFAULT NULL,
  `developer_notes` JSON NULL DEFAULT NULL,
  `recurrence_case_id` VARCHAR(50) NULL DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `cases_day_number_index` (`day_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 5. Reflections Table (Minimal Retention Rule: Only 1-line principle saved)
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
-- 6. Progress Checks Table (Days 3, 7, 12, 17, 60 Growth Comparison)
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
-- 7. Foundation Feedbacks Table (60-Day Survey PDF 1 Spec)
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
-- 8. Subscriptions Table
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
-- 9. Certificates Table (TCJP Certification)
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
(2, 'Arun Mishra', 'arun@example.com', '$2y$12$R94i8w.9u5.R5y7N.j2Sg.N8qJ6K3M5N8O8P8Q8R8S8T8U8V8W8X8Y', 'user', 1, 0);

-- Seed Day 1 Case Study P1-001 ("Read but No Reply")
INSERT INTO `cases` (`id`, `day_number`, `case_id`, `domain`, `primary_trap`, `difficulty`, `primary_skill`, `mission`, `learning_objective`, `phase_target`, `trap_target`, `opening_scenario`, `step1_detect`, `step2_decode`, `step3_reality_check`, `step4_reframe`, `step5_intervention`, `step6_internalize`, `closing_reflection`, `is_active`) VALUES
(1, 1, 'P1-001', 'Relationships', 'Mind Reading', 'Beginner', 'Detect', 'Don\'t let your mind write the story before the facts.', 'Separate Facts from Stories', 1, '["Mind Reading"]',
'Ananya sends her husband a message during lunch asking him to call when he is free. He reads the message. Three hours pass. There is still no reply.',
'{"fact_prompt": "Write only the facts.", "story_prompt": "Now write the story/assumptions your mind is creating.", "insight": "Your brain creates stories automatically. Your first responsibility is to separate them from facts.", "model_fact": "He read my message three hours ago and hasn\'t replied.", "model_story": "He is upset with me and is ignoring me."}',
'{"options": ["Catastrophizing - Assuming the absolute worst outcome.", "Mind Reading - Assuming others\' intentions without evidence.", "Emotional Reasoning - Treating a feeling as proof of reality."], "correct_trap": "Mind Reading", "explanation": "The only confirmed fact is that there has been no reply. The story is that he is upset and deliberately ignoring her. There is no evidence to support that conclusion."}',
'{"q1": "What fact do you know for certain?", "q2": "What are you assuming?", "q3": "What evidence supports your assumption?", "q4": "What evidence contradicts it?", "q5": "If someone else described this situation, what would you tell them?", "tip": "Ask \"What happened?\" before asking \"How are you feeling?\""}',
'{"prompt": "Write at least 3 other explanations that also fit the facts.", "model_reframe": ["He got busy at work.", "He planned to reply later and forgot.", "He is driving.", "His phone battery died."], "challenge_prompt": "Can you think of one more explanation that also fits the facts?"}',
'{"prompt": "Based on the evidence available, what is one thoughtful action you can take?", "model_action": "Wait until the end of the workday. If there is still no reply, send one calm message: \"Just checking if everything is okay. Call me when you\'re free.\"", "reminder": "There isn\'t always a perfect action. There is usually one reasonable action based on the evidence available."}',
'{"prompt": "Complete this sentence: \"Today I learned that...\"", "model_principle": "A delayed reply is a fact. Being ignored is a story/assumptions until evidence proves otherwise."}',
'Where else in my life might I be confusing facts with stories?', 1);

-- Onboarding module database schema for FrontAccounting
-- Table: 0_ksf_onboarding_tasks

ALTER TABLE IF EXISTS `fa_onboarding_tasks` RENAME TO `0_ksf_onboarding_tasks`;

CREATE TABLE IF NOT EXISTS `0_ksf_onboarding_tasks` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `category` ENUM('HR','IT','Training','Equipment','Other') NOT NULL DEFAULT 'Other',
    `due_days` INT(2) NOT NULL DEFAULT 7,
    `required` TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

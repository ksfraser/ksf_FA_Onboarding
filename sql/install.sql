-- Onboarding module database schema for FrontAccounting

CREATE TABLE IF NOT EXISTS `fa_onboarding_tasks` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `category` ENUM('HR','IT','Training','Equipment','Other') NOT NULL DEFAULT 'Other',
    `due_days` INT(2) NOT NULL DEFAULT 7,
    `required` TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `fa_onboarding_plans` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `employee_id` INT(11) NOT NULL,
    `start_date` DATE NOT NULL,
    `status` ENUM('Planned','In Progress','Completed') NOT NULL DEFAULT 'Planned',
    `created_by` INT(11) DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `fa_onboarding_checklist` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `plan_id` INT(11) NOT NULL,
    `task_id` INT(11) NOT NULL,
    `status` ENUM('Pending','Completed') NOT NULL DEFAULT 'Pending',
    `completed_by` INT(11) DEFAULT NULL,
    `completed_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `plan_id` (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `fa_modules` (`name`, `version`, `enabled`, `installed`) VALUES ('Onboarding', '1.0.0', 1, NOW()) ON DUPLICATE KEY UPDATE `version` = '1.0.0';
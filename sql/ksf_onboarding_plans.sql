-- Onboarding module database schema for FrontAccounting
-- Table: 0_ksf_onboarding_plans

ALTER TABLE IF EXISTS `fa_onboarding_plans` RENAME TO `0_ksf_onboarding_plans`;

CREATE TABLE IF NOT EXISTS `0_ksf_onboarding_plans` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `employee_id` INT(11) NOT NULL,
    `start_date` DATE NOT NULL,
    `status` ENUM('Planned','In Progress','Completed') NOT NULL DEFAULT 'Planned',
    `created_by` INT(11) DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

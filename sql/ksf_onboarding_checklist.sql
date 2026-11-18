-- Onboarding module database schema for FrontAccounting
-- Table: 0_ksf_onboarding_checklist

ALTER TABLE IF EXISTS `fa_onboarding_checklist` RENAME TO `0_ksf_onboarding_checklist`;

CREATE TABLE IF NOT EXISTS `0_ksf_onboarding_checklist` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `plan_id` INT(11) NOT NULL,
    `task_id` INT(11) NOT NULL,
    `status` ENUM('Pending','Completed') NOT NULL DEFAULT 'Pending',
    `completed_by` INT(11) DEFAULT NULL,
    `completed_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `plan_id` (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

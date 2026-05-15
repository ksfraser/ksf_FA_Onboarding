<?php
/**
 * FA_Onboarding Module Hooks for FrontAccounting
 */

define('SS_ONBOARDING', 124 << 8);

class hooks_fa_onboarding extends hooks {
    var $module_name = 'fa_onboarding';
    var $version = '1.0.0';

    function install_options($app) {
        global $path_to_root;

        switch($app->id) {
            case 'HR':
                $app->add_lapp_function(0, _("Onboarding Plans"),
                    $path_to_root."/modules/".$this->module_name."/plans.php", 'SA_ONBOARDINGVIEW', MENU_ENTRY);
                $app->add_lapp_function(1, _("Create Plan"),
                    $path_to_root."/modules/".$this->module_name."/create.php", 'SA_ONBOARDINGCREATE', MENU_ENTRY);
                $app->add_lapp_function(2, _("Checklist"),
                    $path_to_root."/modules/".$this->module_name."/checklist.php", 'SA_ONBOARDINGMANAGE', MENU_ENTRY);
                break;
        }
    }

    function install_access() {
        $security_sections[SS_ONBOARDING] = _("Employee Onboarding");
        $security_areas['SA_ONBOARDINGVIEW'] = array(SS_ONBOARDING | 1, _("View Plans"));
        $security_areas['SA_ONBOARDINGCREATE'] = array(SS_ONBOARDING | 2, _("Create Plans"));
        $security_areas['SA_ONBOARDINGMANAGE'] = array(SS_ONBOARDING | 3, _("Manage Tasks"));
        return array($security_areas, $security_sections);
    }

    function activate_extension($company, $check_only=true) {
        $updates = array('sql/update.sql' => array($this->module_name));
        $ok = $this->update_databases($company, $updates, $check_only);
        if ($check_only || !$ok) {
            return $ok;
        }
        $this->ensure_onboarding_schema();
        return $ok;
    }

    private function table_exists($table) {
        $sql = "SHOW TABLES LIKE " . db_escape($table);
        $res = db_query($sql, 'Failed checking table existence');
        return db_num_rows($res) > 0;
    }

    private function ensure_onboarding_schema() {
        $tables = array(
            TB_PREF . "fa_onboarding_plans" => "
                CREATE TABLE IF NOT EXISTS `" . TB_PREF . "fa_onboarding_plans` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `plan_name` VARCHAR(100) NOT NULL,
                    `description` TEXT,
                    `duration_days` INT(11) DEFAULT 7,
                    `is_active` TINYINT(1) DEFAULT 1,
                    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",

            TB_PREF . "fa_onboarding_tasks" => "
                CREATE TABLE IF NOT EXISTS `" . TB_PREF . "fa_onboarding_tasks` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `plan_id` INT(11) NOT NULL,
                    `task_name` VARCHAR(100) NOT NULL,
                    `description` TEXT,
                    `task_order` INT(11) DEFAULT 0,
                    `assigned_role` VARCHAR(50) DEFAULT NULL,
                    `is_required` TINYINT(1) DEFAULT 1,
                    PRIMARY KEY (`id`),
                    KEY `idx_plan` (`plan_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",

            TB_PREF . "fa_onboarding_checklist" => "
                CREATE TABLE IF NOT EXISTS `" . TB_PREF . "fa_onboarding_checklist` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `employee_id` VARCHAR(100) NOT NULL,
                    `plan_id` INT(11) NOT NULL,
                    `task_id` INT(11) NOT NULL,
                    `status` VARCHAR(20) DEFAULT 'Pending',
                    `completed_at` DATETIME DEFAULT NULL,
                    `completed_by` VARCHAR(100) DEFAULT NULL,
                    `notes` TEXT,
                    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `idx_employee` (`employee_id`),
                    KEY `idx_task` (`task_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );

        foreach ($tables as $table_name => $sql) {
            db_query($sql, "Could not create Onboarding table: $table_name");
        }
    }

    function db_prevoid($trans_type, $trans_no) {
        // Handle voiding if needed
    }
}
?>

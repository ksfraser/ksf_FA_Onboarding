<?php
$module_id = 'Onboarding';
$module_version = '1.0.0';
$module_name = 'Employee Onboarding';
$module_description = 'New employee onboarding task management';
$module_tables = ['fa_onboarding_tasks', 'fa_onboarding_plans', 'fa_onboarding_checklist'];
$module_capabilities = ['SA_ONBOARDINGVIEW'=>'View Plans','SA_ONBOARDINGCREATE'=>'Create Plans','SA_ONBOARDINGMANAGE'=>'Manage Tasks'];
function onboarding_install():bool{return install_module_sql('Onboarding');}function onboarding_enable():bool{return enable_module('Onboarding');}function onboarding_disable():bool{return disable_module('Onboarding');}function onboarding_remove():bool{return remove_module_sql('Onboarding');}
add_module($module_name,$module_version,$module_description);
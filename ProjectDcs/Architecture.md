# FA_Onboarding Technical Architecture

## Document Information
- **Module**: FA_Onboarding (Employee Onboarding)
- **Version**: 1.0.0
- **Date**: 2024-04-25
- **Status**: Planning
- **Author**: KSFII Development Team

## 1. Architecture Overview

### 1.1 Design Principles
The FA_Onboarding module follows these architectural principles:

1. **Modularity**: Clean separation between UI, business logic, and data layers
2. **Extensibility**: Hooks and events for integration with other modules
3. **Compatibility**: WebERP-style functions for FA integration
4. **Type Safety**: PHP 8.0+ features with type declarations
5. **Workflow-Driven**: Core workflow management capabilities

### 1.2 Technology Stack
- **PHP**: 8.0+ with strict typing
- **Database**: MySQL 5.7+ / MariaDB 10.0+
- **Frontend**: Bootstrap 5.x (via FA)
- **Integration**: PSR-14 Event Dispatcher
- **Container**: PSR-11 Container

## 2. Directory Structure

```
ksf_FA_Onboarding/
├── FA_Onboarding_Module.php     # Module registration & hooks
├── hooks.php                 # Install/activate/deactivate hooks
├── onboarding.php            # Main module entry
├── README.md               # Module documentation
├── _init/
│   └── init.inc            # Module initialization
├── includes/
│   ├── onboarding_db.inc   # Database functions
│   ├── onboarding_ui.inc  # UI components
│   └── OnboardingService.php  # Business logic service
├── pages/
│   ├── dashboard.php      # Onboarding dashboard
│   ├── new_hires.php     # New hire management
│   ├── tasks.php         # Task management
│   ├── documents.php    # Document tracking
│   ├── training.php      # Training management
│   ├── reports.php      # Analytics & reports
│   └── settings.php     # Module settings
├── sql/
│   ├── install.sql       # Database schema
│   └── uninstall.sql    # Schema removal
├── src/                  # Additional source files
├── tests/                # Unit and integration tests
│   └── Unit/
└── ProjectDcs/           # Project documentation
```

## 3. Database Architecture

### 3.1 Core Tables

#### fa_onboarding_new_hires
Primary table storing new hire onboarding information.

```sql
CREATE TABLE `@TB_PREF@fa_onboarding_new_hires` (
    `onboarding_id` VARCHAR(20) NOT NULL,
    `employee_id` VARCHAR(20) DEFAULT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `personal_email` VARCHAR(100) DEFAULT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `start_date` DATE NOT NULL,
    `department_id` VARCHAR(20) DEFAULT NULL,
    `position` VARCHAR(100) DEFAULT NULL,
    `manager_id` VARCHAR(20) DEFAULT NULL,
    `buddy_id` VARCHAR(20) DEFAULT NULL,
    `workflow_template_id` VARCHAR(20) DEFAULT NULL,
    `status` VARCHAR(30) DEFAULT 'Not Started',
    `notes` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`onboarding_id`),
    KEY `idx_status` (`status`),
    KEY `idx_start_date` (`start_date`),
    KEY `idx_department` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### fa_onboarding_workflow_templates
Templates defining onboarding workflows.

```sql
CREATE TABLE `@TB_PREF@fa_onboarding_workflow_templates` (
    `template_id` VARCHAR(20) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `duration_days` INT(11) DEFAULT 30,
    `inactive` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`template_id`),
    KEY `idx_inactive` (`inactive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### fa_onboarding_tasks
Tasks assigned during onboarding.

```sql
CREATE TABLE `@TB_PREF@fa_onboarding_tasks` (
    `task_id` VARCHAR(20) NOT NULL,
    `onboarding_id` VARCHAR(20) NOT NULL,
    `template_id` VARCHAR(20) DEFAULT NULL,
    `task_name` VARCHAR(100) NOT NULL,
    `task_description` TEXT,
    `assigned_to` VARCHAR(50) DEFAULT 'HR',
    `due_date` DATE DEFAULT NULL,
    `due_relative` VARCHAR(20) DEFAULT NULL,
    `status` VARCHAR(30) DEFAULT 'Not Started',
    `priority` VARCHAR(20) DEFAULT 'Medium',
    `completed_by` VARCHAR(20) DEFAULT NULL,
    `completed_date` DATETIME DEFAULT NULL,
    `notes` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`task_id`),
    KEY `idx_onboarding` (`onboarding_id`),
    KEY `idx_status` (`status`),
    KEY `idx_assignee` (`assigned_to`),
    CONSTRAINT `fk_task_onboarding` FOREIGN KEY (`onboarding_id`) 
        REFERENCES `@TB_PREF@fa_onboarding_new_hires` (`onboarding_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### fa_onboarding_documents
Document tracking for onboarding.

```sql
CREATE TABLE `@TB_PREF@fa_onboarding_documents` (
    `document_id` VARCHAR(20) NOT NULL,
    `onboarding_id` VARCHAR(20) NOT NULL,
    `document_type` VARCHAR(50) NOT NULL,
    `document_name` VARCHAR(100) DEFAULT NULL,
    `status` VARCHAR(30) DEFAULT 'Pending',
    `submission_date` DATE DEFAULT NULL,
    `verified_by` VARCHAR(20) DEFAULT NULL,
    `verification_date` DATETIME DEFAULT NULL,
    `expiration_date` DATE DEFAULT NULL,
    `notes` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`document_id`),
    KEY `idx_onboarding` (`onboarding_id`),
    KEY `idx_status` (`status`),
    CONSTRAINT `fk_document_onboarding` FOREIGN KEY (`onboarding_id`) 
        REFERENCES `@TB_PREF@fa_onboarding_new_hires` (`onboarding_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### fa_onboarding_training
Training plan assignments.

```sql
CREATE TABLE `@TB_PREF@fa_onboarding_training` (
    `training_id` VARCHAR(20) NOT NULL,
    `onboarding_id` VARCHAR(20) NOT NULL,
    `training_name` VARCHAR(100) NOT NULL,
    `training_type` VARCHAR(50) NOT NULL,
    `due_date` DATE DEFAULT NULL,
    `completion_date` DATETIME DEFAULT NULL,
    `status` VARCHAR(30) DEFAULT 'Assigned',
    `score` DECIMAL(5,2) DEFAULT NULL,
    `certificate_path` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`training_id`),
    KEY `idx_onboarding` (`onboarding_id`),
    KEY `idx_status` (`status`),
    CONSTRAINT `fk_training_onboarding` FOREIGN KEY (`onboarding_id`) 
        REFERENCES `@TB_PREF@fa_onboarding_new_hires` (`onboarding_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### fa_onboarding_activity_log
Audit trail for onboarding activities.

```sql
CREATE TABLE `@TB_PREF@fa_onboarding_activity_log` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `onboarding_id` VARCHAR(20) NOT NULL,
    `activity_type` VARCHAR(30) NOT NULL,
    `user_id` VARCHAR(100) DEFAULT NULL,
    `action` VARCHAR(50) NOT NULL,
    `details` TEXT,
    `old_values` TEXT,
    `new_values` TEXT,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_onboarding` (`onboarding_id`),
    KEY `idx_user` (`user_id`),
    KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 3.2 Reference Data

Initial workflow templates:

```sql
INSERT INTO `@TB_PREF@fa_onboarding_workflow_templates` 
    (`template_id`, `name`, `description`, `duration_days`) VALUES
('DEFAULT', 'Standard', 'Standard 30-day onboarding', 30),
('EXECUTIVE', 'Executive', 'Executive 60-day onboarding', 60),
('TEMPORARY', 'Seasonal/Temp', 'Short-term 7-day onboarding', 7),
('INTERN', 'Intern', 'Intern 90-day onboarding', 90);
```

## 4. Module Architecture

### 4.1 Module Registration

```php
// FA_Onboarding_Module.php
$module_name = 'FA_Onboarding';
$module_version = '1.0.0';
$module_description = 'Employee Onboarding for FrontAccounting';
$module_category = 'HR';
$module_min_required_version = '2.4.0';
```

### 4.2 PHP Class Structure

```
FA_Onboarding_Module
├── Service Layer (OnboardingService)
│   ├── createOnboarding()
│   ├── updateOnboarding()
│   ├── completeTask()
│   ├── verifyDocument()
│   └── calculateProgress()
│
├── Data Access Layer (onboarding_db.inc)
│   ├── get_onboarding_list()
│   ├── insert_onboarding()
│   ├── update_onboarding_task()
│   └── get_onboarding_progress()
│
└── UI Layer (onboarding_ui.inc)
    ├── display_dashboard()
    ├── display_task_checklist()
    └── display_progress()
```

### 4.3 Dependency Injection Container

```php
// OnboardingContainer extends FAContainer
services:
  - DatabaseAdapterInterface
  - EmployeeServiceInterface
  - DepartmentServiceInterface
  - EventDispatcherInterface
  - LoggerInterface
```

## 5. Integration Points

### 5.1 Employee Module Integration

- Create employee from onboarding completion
- Sync employee data changes
- Link to department records

### 5.2 HRM Module Integration

- Access employee records
- Link to benefits enrollment
- Integration with leave management

### 5.3 Event Integration

Events dispatched:
- `onboarding.created`
- `onboarding.completed`
- `task.completed`
- `document.verified`
- `training.completed`

## 6. Security Architecture

### 6.1 Access Control

- Role-based permission system
- Permission constants defined in module
- Menu access controlled by permissions

### 6.2 Input Validation

- Prepared statements for all queries
- Form validation on all inputs
- CSRF protection on forms

### 6.3 Data Validation

- Required field validation
- Date format validation
- Email validation

## 7. Performance Architecture

### 7.1 Database Optimization

- Indexed columns for frequent queries
- Proper foreign key constraints
- Optimized join queries

### 7.2 Caching Strategy

- Dashboard statistics cached
- Template definitions cached

## 8. Extension Points

### 8.1 Hooks

- `onboarding_extra_fields` - Display extra fields
- `onboarding_validate` - Custom validation
- `onboarding_complete` - Completion hook

### 8.2 Custom Fields

- Support for custom fields via extension
- Custom document types
- Custom training types

---

*Document Version: 1.0.0*
*Last Updated: 2024-04-25*

# ksf_FA_Onboarding - Employee Onboarding Module

FA module for managing new employee onboarding workflows, documentation, and orientation processes.

## Overview

The Onboarding module provides comprehensive functionality for managing the employee onboarding lifecycle including:
- New hire profile setup and initialization
- Document collection and verification
- Training plan assignment and tracking
- Orientation scheduling and management
- Onboarding task checklists
- Progress tracking and milestones
- Department buddy/mentor assignment

## Features

### Core Features

#### Onboarding Workflow Management
- **Workflow Templates**: Define reusable onboarding workflow templates
- **Milestone Tracking**: Track progress through onboarding phases
- **Task Checklists**: Assign and track completion of onboarding tasks
- **Status Management**: Not Started, In Progress, Completed, On Hold

#### New Hire Management
- **Profile Setup**: Create and manage new hire information
- **Personal Information**: Emergency contacts, banking details
- **Employment Details**: Start date, department, position, manager
- **IT Setup Requests**: System access, equipment requests

#### Document Management
- **Required Documents**: I-9, W-4, direct deposit, NDA, etc.
- **Document Collection**: Track submitted documents
- **Verification Status**: Pending, Verified, Rejected
- **Expiration Tracking**: Track document renewals

#### Training & Orientation
- **Training Plans**: Assign required training courses
- **Orientation Sessions**: Schedule orientation events
- **Completion Tracking**: Track training completion status
- **Certification Management**: Track certifications earned

#### Task Management
- **Pre-boarding Tasks**: Tasks before start date
- **First Day Tasks**: First day onboarding activities
- **First Week Tasks**: Week 1 activities
- **First Month Tasks**: 30-day check-in tasks
- **Task Assignments**: Assign tasks to HR, IT, Managers

#### Integration Features
- **Employee Integration**: Link to FA employee records
- **Department Integration**: Link to FA departments
- **HRM Integration**: Connect with other HR modules
- **Event-Driven Architecture**: PSR-14 event dispatcher

## Quick Start

### Installation

```bash
# Install via composer (once package is published)
composer require ksfraser/ksf-onboarding

# Copy module to FA
cp -r ksf_FA_Onboarding /path/to/frontaccounting/modules/

# Activate via FA Admin → Setup → Modules
```

### Basic Usage

```php
use Ksfraser\Onboarding\OnboardingService;

// Create a new hire onboarding record
$onboardingData = [
    'onboarding_id' => 'ONB-2024-001',
    'employee_id' => 'EMP-001',
    'department_id' => 'DEPT-001',
    'position' => 'Software Developer',
    'manager_id' => 'EMP-100',
    'start_date' => '2024-02-01',
    'workflow_template_id' => 'DEFAULT',
    'buddy_id' => 'EMP-050'
];

$onboardingId = create_onboarding($onboardingData);

// Get onboarding details
$onboarding = get_onboarding('ONB-2024-001');

// Update task status
update_onboarding_task([
    'onboarding_id' => 'ONB-2024-001',
    'task_id' => 'TASK-001',
    'status' => 'Completed',
    'completed_by' => 'EMP-001',
    'completed_date' => '2024-01-28'
]);

// Get onboarding progress
$progress = get_onboarding_progress('ONB-2024-001');
```

## Database Tables

The module expects the following database tables:

### fa_onboarding_new_hires
| Column | Type | Description |
|--------|------|-------------|
| onboarding_id | VARCHAR(20) | Primary key |
| employee_id | VARCHAR(20) | FK to employees |
| first_name | VARCHAR(50) | First name |
| last_name | VARCHAR(50) | Last name |
| email | VARCHAR(100) | Email address |
| personal_email | VARCHAR(100) | Personal email |
| phone | VARCHAR(20) | Phone number |
| start_date | DATE | Employment start date |
| department_id | VARCHAR(20) | FK to departments |
| position | VARCHAR(100) | Job position |
| manager_id | VARCHAR(20) | FK to employees |
| buddy_id | VARCHAR(20) | Assigned buddy/mentor |
| workflow_template_id | VARCHAR(20) | FK to workflow templates |
| status | VARCHAR(30) | Not Started/In Progress/Completed/On Hold |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Last update time |

### fa_onboarding_workflow_templates
| Column | Type | Description |
|--------|------|-------------|
| template_id | VARCHAR(20) | Primary key |
| name | VARCHAR(100) | Template name |
| description | TEXT | Template description |
| duration_days | INT(11) | Default duration in days |
| inactive | TINYINT(1) | Active flag |
| created_at | TIMESTAMP | Record creation time |

### fa_onboarding_tasks
| Column | Type | Description |
|--------|------|-------------|
| task_id | VARCHAR(20) | Primary key |
| onboarding_id | VARCHAR(20) | FK to new hires |
| template_id | VARCHAR(20) | FK to task templates |
| task_name | VARCHAR(100) | Task name |
| task_description | TEXT | Task details |
| assigned_to | VARCHAR(50) | HR/IT/Manager/Buddy/Employee |
| due_date | DATE | Task due date |
| due_relative | VARCHAR(20) | Relative due (-1, +1, +7 days) |
| status | VARCHAR(30) | Not Started/In Progress/Completed/Skipped |
| priority | VARCHAR(20) | Low/Medium/High |
| completed_by | VARCHAR(20) | Completed by employee |
| completed_date | DATETIME | Completion timestamp |
| notes | TEXT | Task notes |
| created_at | TIMESTAMP | Record creation time |

### fa_onboarding_documents
| Column | Type | Description |
|--------|------|-------------|
| document_id | VARCHAR(20) | Primary key |
| onboarding_id | VARCHAR(20) | FK to new hires |
| document_type | VARCHAR(50) | Document type |
| document_name | VARCHAR(100) | Document name |
| status | VARCHAR(30) | Pending/Submitted/Verified/Rejected |
| submission_date | DATE | Date submitted |
| verified_by | VARCHAR(20) | Verified by user |
| verification_date | DATETIME | Verification timestamp |
| expiration_date | DATE | Document expiration |
| notes | TEXT | Verification notes |
| created_at | TIMESTAMP | Record creation time |

### fa_onboarding_training
| Column | Type | Description |
|--------|------|-------------|
| training_id | VARCHAR(20) | Primary key |
| onboarding_id | VARCHAR(20) | FK to new hires |
| training_name | VARCHAR(100) | Training name |
| training_type | VARCHAR(50) | Orientation/Technical/Compliance |
| due_date | DATE | Due date |
| completion_date | DATETIME | Completion timestamp |
| status | VARCHAR(30) | Assigned/In Progress/Completed |
| score | DECIMAL(5,2) | Test score if applicable |
| certificate_path | VARCHAR(255) | Certificate file path |
| created_at | TIMESTAMP | Record creation time |

### fa_onboarding_activity_log
| Column | Type | Description |
|--------|------|-------------|
| id | INT(11) | Primary key |
| onboarding_id | VARCHAR(20) | FK to new hires |
| activity_type | VARCHAR(30) | Activity category |
| user_id | VARCHAR(100) | User who performed action |
| action | VARCHAR(50) | Action performed |
| details | TEXT | Detailed description |
| old_values | TEXT | Previous values (JSON) |
| new_values | TEXT | New values (JSON) |
| ip_address | VARCHAR(45) | Client IP |
| created_at | TIMESTAMP | Activity timestamp |

## Permissions

### Role-Based Access Control

| Permission | Description |
|------------|-------------|
| ONB_VIEW_ONBOARDING | View onboarding list and details |
| ONB_MANAGE_ONBOARDING | Create, edit, delete onboarding records |
| ONB_VIEW_TASKS | View assigned tasks |
| ONB_MANAGE_TASKS | Create, edit, complete tasks |
| ONB_VIEW_DOCUMENTS | View submitted documents |
| ONB_VERIFY_DOCUMENTS | Verify/reject documents |
| ONB_VIEW_TRAINING | View training assignments |
| ONB_MANAGE_TRAINING | Manage training plans |
| ONB_REPORTS | View onboarding reports |
| ONB_ADMIN | Full administrative access |

## API Reference

### Database Functions (onboarding_db.inc)

```php
// New Hires
get_onboarding_list(string $search = '', string $status = ''): object|false
get_onboarding(string $onboardingId): ?array
get_onboarding_count(string $status = ''): int
insert_onboarding(array $data): string
update_onboarding(string $onboardingId, array $data): bool
delete_onboarding(string $onboardingId): bool

// Tasks
get_onboarding_tasks(string $onboardingId = ''): object|false
get_onboarding_task(string $taskId): ?array
update_onboarding_task(array $data): bool
get_onboarding_progress(string $onboardingId): array
get_pending_tasks(string $assignedTo, string $date = ''): array

// Documents
get_onboarding_documents(string $onboardingId = ''): object|false
update_document_status(string $documentId, string $status, string $notes): bool

// Training
get_onboarding_training(string $onboardingId = ''): object|false
update_training_status(string $trainingId, string $status, string $score = ''): bool

// Activity
get_onboarding_activities(string $onboardingId, int $limit = 10): array
```

### UI Functions (onboarding_ui.inc)

```php
// Navigation
onboarding_navigation_menu(): void

// Display
display_onboarding_dashboard_stats(array $stats): void
display_onboarding_stat_cell(string $label, int $value, string $type): void
display_onboarding_progress(array $progress): void
display_onboarding_task_checklist(string $onboardingId, array $tasks): void

// Select Helpers
sel_onboarding_status(string $selected = ''): string
sel_task_status(string $selected = ''): string
sel_document_status(string $selected = ''): string
sel_training_status(string $selected = ''): string
sel_priority(string $selected = 'Medium'): string

// Status Helpers
get_onboarding_status_class(string $status): string
get_task_status_class(string $status): string
get_priority_class(string $priority): string
```

### Configuration

#### Onboarding Status Flow

```
Not Started → In Progress → Completed
Not Started → In Progress → On Hold → In Progress
In Progress → Completed → On Hold
```

#### Default Task Phases

1. Pre-boarding (Before start date)
   - Send welcome email
   - Prepare workstation
   - Create system accounts
   - Order equipment

2. First Day
   - Complete paperwork
   - Office tour
   - Team introduction
   - IT systems setup

3. First Week
   - Complete compliance training
   - Review policies
   - Meet with manager
   - Initial project assignment

4. First Month
   - Complete role-specific training
   - 30-day check-in meeting
   - Feedback collection

## Testing

Run unit tests:

```bash
./vendor/bin/phpunit
```

## Module Structure

```
ksf_FA_Onboarding/
├── composer.json
├── FA_Onboarding_Module.php
├── hooks.php
├── README.md
├── _init/
│   └── init.inc
├── includes/
│   ├── onboarding_db.inc
│   ├── onboarding_ui.inc
│   └── OnboardingService.php
├── pages/
│   ├── dashboard.php
│   ├── new_hires.php
│   ├── tasks.php
│   ├── documents.php
│   ├── training.php
│   ├── reports.php
│   └── settings.php
├── sql/
│   ├── install.sql
│   └── uninstall.sql
├── tests/
│   └── Unit/
│       └── OnboardingTest.php
└── ProjectDcs/
    ├── Architecture.md
    ├── Business Requirements.md
    ├── Functional Requirements.md
    ├── RTM.md
    ├── Test Plan.md
    ├── UAT Plan.md
    └── Use Case.md
```

## Dependencies

- FrontAccounting 2.4.0+
- PHP 8.0+
- ksfraser/ksf-common (common utilities)
- ksfraser/ksf-hrm (HRM integration)

## License

Proprietary - KS Fraser Application Framework

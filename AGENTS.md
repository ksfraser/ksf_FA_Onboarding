# AGENTS.md - ksf_FA_Onboarding#

## Architecture Overview#

**FA Module** for Employee Onboarding - checklists, tasks, and progress tracking linked to HRM.

### Core Principles#
- **SOLID**, **DRY**, **TDD**, **DI**, **SRP**#

## Repository Structure#

```
ksf_FA_Onboarding/
├── sql/#
│   ├── fa_onboarding_plans.sql#
│   ├── fa_onboarding_tasks.sql#
│   └── fa_onboarding_checklist.sql#
├── includes/#
│   ├── plans_db.inc#
│   ├── tasks_db.inc#
│   └── checklist_db.inc#
├── pages/#
├── hooks.php#
├── composer.json#
└── ProjectDocs/#
```

## Dependencies#

- **ksf_FA_Onboarding_Core** (business logic)#
- **ksf_FA_HRM** (link to new employees)#
- **ksf_FA_Recruitment** (onboard from recruitment)#
- **FrontAccounting 2.4+**#

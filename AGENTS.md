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

## Development Workflow

All development is done in the **devel tree** (`~/Documents/ksf_FA_Onboarding`). Do **not** edit files in the UAT bind point directly.

### Workflow Steps
1. **Develop** in this repo (feature branches preferred)
2. **Test**: run repo-appropriate tests
3. **Lint**: `php -l` on modified PHP files (no syntax errors)
4. **Commit** and **Push** branch to GitHub
5. **Merge** to `master` when ready
6. **Push** `master` to GitHub
7. **Deploy** to UAT by pulling in the Infrastructure bind point:

   ```
   cd ~/ksf_Infrastructure/fa_modules/ksf_FA_Onboarding
   git stash -u
   git pull origin master
   git stash pop
   ```

### UAT Bind Point
| Path | Purpose |
|------|---------|
| `~/Documents/ksf_FA_Onboarding` | Devel tree — all development, testing, commits |
| `~/ksf_Infrastructure/fa_modules/ksf_FA_Onboarding` | UAT bind point — deployment target, integration testing (if mirrored) |


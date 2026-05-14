# FA Onboarding Module - Access Control Specification

## Document Information

| Field | Value |
|-------|-------|
| Document Title | Access Control Specification |
| Module | ksf_FA_Onboarding |
| Version | 1.0.0 |
| Author | KSF Development Team |
| Last Updated | May 2026 |

---

## 1. Access Control Overview

### 1.1 Purpose

Access control for ksf_FA_Onboarding:
- **HR Admin** creates and manages onboarding workflows
- **Hiring Manager** tracks onboarding for new hires
- **New Employee** completes own onboarding tasks
- **IT/Admin** completes assigned setup tasks

### 1.2 Key Principles

| Principle | Description |
|-----------|-------------|
| Self-Service | New hires complete assigned tasks |
| Manager Tracking | Managers monitor onboarding progress |
| Task Assignment | IT/HR complete system setup tasks |
| Completion Tracking | All stakeholders see status |

---

## 2. Role Definitions

| Role | Access Level |
|------|--------------|
| New Employee | Own onboarding tasks only |
| Hiring Manager | Team's onboarding progress |
| HR Admin | All onboarding + workflow config |
| Task Assignee (IT, etc.) | Assigned tasks only |

---

## 3. Record-Level Access

### 3.1 Onboarding Task

| Field | New Employee | Manager | HR Admin |
|-------|--------------|---------|----------|
| Task Name | Read | Read | Read/Write |
| Description | Read | Read | Read/Write |
| Status | Read/Write (own) | Read (team) | Read/Write |
| Due Date | Read | Read | Read/Write |
| Assigned To | Read | Read | Read/Write |
| Completion Notes | Read/Write (own) | Read | Read/Write |
| Verification | Hidden | Read | Read/Write |

### 3.2 New Hire Profile

| Field | New Employee | Manager | HR Admin |
|-------|--------------|---------|----------|
| Personal Info | Read (own) | Read | Read/Write |
| Emergency Contact | Write (own) | Hidden | Read |
| Tax Forms | Read (own) | Hidden | Read |
| Equipment Assigned | Read (own) | Read | Read/Write |
| Account Setup | Hidden | Read | Read/Write |

---

## 4. Manager Visibility

### 4.1 Team Onboarding View

Managers see:
1. List of new hires in their team
2. Overall progress percentage
3. Overdue tasks
4. Cannot see detailed task content (privacy)

### 4.2 Escalation

- Task overdue 3+ days: Manager notified
- Task overdue 7+ days: HR Admin notified
- Completion rate < 50% by day 3: Escalation

---

## 5. Task Assignment Workflow

### 5.1 Automatic Assignment

```
New Hire Created
    │
    ├── IT ──▶ Equipment Setup
    ├── HR ──▶ Document Collection
    ├── Manager ──▶ Welcome Meeting
    └── System ──▶ Training Enrollment
```

### 5.2 Access by Task Type

| Task Type | Visibility |
|-----------|------------|
| Document (tax, I-9) | New Employee + HR Admin |
| Equipment Request | New Employee + IT Admin |
| Training | New Employee + HR Admin + Manager |
| Meeting | New Employee + Manager |
| System Access | New Employee + IT Admin |

---

## 6. Family Company Considerations

### 6.1 Family Members

| Scenario | Access |
|----------|--------|
| Family member as new hire | Normal onboarding access |
| Family member as manager | Normal team access |
| Family member as IT/HR | Normal task assignment access |

### 6.2 Gift Flag

Onboarding completion bonuses or welcome gifts:
- Normal visibility for eligibility
- With `gift_flag=true`: Only HR Admin可见

---

## 7. WordPress Customer Portal

### 7.1 Employee Self-Service

Via ksf_WP_ESS, new employees access:
- View assigned tasks
- Complete document uploads
- Schedule meetings
- View onboarding progress

---

## 8. Revision History

| Version | Date | Author | Changes |
|---------|------|--------|---------|
| 1.0.0 | May 2026 | KSF Development Team | Initial specification |
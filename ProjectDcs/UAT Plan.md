# FA_Onboarding UAT Plan

## Document Information
- **Module**: FA_Onboarding (Employee Onboarding)
- **Version**: 1.0.0
- **Date**: 2024-04-25
- **Status**: Planning
- **Author**: KSFII Development Team

## 1. Introduction

### 1.1 Purpose
This UAT Plan defines the user acceptance test cases for the FA_Onboarding module. These tests verify that the module meets business requirements from an end-user perspective.

### 1.2 Scope
- New hire onboarding creation
- Task management
- Document collection
- Training management
- Dashboard and reporting
- Settings and configuration

### 1.3 Test Environment
- **Platform**: FrontAccounting 2.4.x
- **Browser**: Chrome/Firefox latest
- **PHP**: 8.0+
- **Database**: MySQL 5.7+

### 1.4 Stakeholders
- HR Managers
- HR Administrators
- IT Staff
- Department Managers
- New Hires

## 2. UAT Test Cases

### 2.1 Onboarding Management (UAT-ON)

#### UAT-ON-001: Create New Hire Onboarding
**Objective**: Verify HR can create a new hire onboarding record

**Test Scenario**:
1. Login as HR Manager
2. Navigate to Onboarding → New Hires
3. Click "Add New"
4. Enter new hire information:
   - First Name: John
   - Last Name: Smith
   - Email: john.smith@company.com
   - Start Date: 2024-02-01
   - Department: Engineering
   - Position: Software Developer
   - Manager: Jane Doe
5. Select "Standard" workflow template
6. Click Save

**Expected Result**: New onboarding record created with tasks generated

**Acceptance Criteria**:
- [ ] Onboarding record saved to database
- [ ] Auto-generated ID assigned (e.g., ONB-2024-001)
- [ ] Tasks generated from workflow template
- [ ] Redirect to onboarding detail page

---

#### UAT-ON-002: View Onboarding List
**Objective**: Verify user can view list of all onboardings

**Test Scenario**:
1. Navigate to Onboarding → New Hires
2. View list with all columns

**Expected Result**: All onboardings displayed with correct information

**Acceptance Criteria**:
- [ ] Name, Start Date, Department visible
- [ ] Status shown with color coding
- [ ] Search works correctly
- [ ] Filter by status works
- [ ] Pagination works

---

#### UAT-ON-003: Edit Onboarding Details
**Objective**: Verify user can edit onboarding details

**Test Scenario**:
1. Open existing onboarding record
2. Click Edit
3. Change position to "Senior Software Developer"
4. Change start date
5. Save

**Expected Result**: Fields updated successfully

**Acceptance Criteria**:
- [ ] Position changed in database
- [ ] Start date updated
- [ ] Activity logged

---

#### UAT-ON-004: Delete Onboarding
**Objective**: Verify user can delete onboarding record

**Test Scenario**:
1. Open onboarding record
2. Click Delete
3. Confirm deletion

**Expected Result**: Record and related data deleted

**Acceptance Criteria**:
- [ ] Onboarding record removed
- [ ] Related tasks removed
- [ ] Related documents removed
- [ ] Related training removed

---

### 2.2 Task Management (UAT-TK)

#### UAT-TK-001: View Task Checklist
**Objective**: Verify user can view onboarding task checklist

**Test Scenario**:
1. Open onboarding record
2. Navigate to Tasks tab

**Expected Result**: All tasks displayed grouped by phase

**Acceptance Criteria**:
- [ ] Tasks organized by phase
- [ ] Status icons display correctly
- [ ] Due dates shown
- [ ] Assigned to displayed

---

#### UAT-TK-002: Complete Task
**Objective**: Verify user can mark task as completed

**Test Scenario**:
1. Open task detail
2. Click "Start" to begin
3. Add work notes
4. Click "Complete"

**Expected Result**: Task marked complete with timestamp

**Acceptance Criteria**:
- [ ] Status changed to Completed
- [ ] Completed_by field populated
- [ ] Completed_date timestamp set
- [ ] Notes saved

---

#### UAT-TK-003: View Progress
**Objective**: Verify progress calculation displays correctly

**Test Scenario**:
1. Open onboarding detail
2. View progress indicator

**Expected Result**: Progress percentage accurate

**Acceptance Criteria**:
- [ ] Progress = (Completed Tasks / Total Tasks) × 100
- [ ] Progress bar displays
- [ ] Updates on task completion

---

#### UAT-TK-004: Filter Tasks by Status
**Objective**: Verify tasks can be filtered

**Test Scenario**:
1. Go to Tasks page
2. Filter by "Not Started"
3. Filter by "Completed"

**Expected Result**: Tasks filtered correctly

**Acceptance Criteria**:
- [ ] Only matching tasks displayed
- [ ] Count accurate

---

### 2.3 Document Management (UAT-DO)

#### UAT-DO-001: View Document List
**Objective**: Verify user can view required documents

**Test Scenario**:
1. Open onboarding
2. Navigate to Documents tab

**Expected Result**: All required documents displayed

**Acceptance Criteria**:
- [ ] All document types listed
- [ ] Status shown for each
- [ ] Links work

---

#### UAT-DO-002: Verify Document
**Objective**: Verify HR can verify submitted document

**Test Scenario**:
1. Open submitted document
2. Review document details
3. Click "Verify"
4. Add verification notes

**Expected Result**: Document verified

**Acceptance Criteria**:
- [ ] Status changes to Verified
- [ ] Verified_by populated
- [ ] Verification_date timestamp set
- [ ] Notes saved

---

#### UAT-DO-003: Reject Document
**Objective**: Verify HR can reject invalid document

**Test Scenario**:
1. Open submitted document
2. Click "Reject"
3. Enter rejection reason

**Expected Result**: Document rejected with reason

**Acceptance Criteria**:
- [ ] Status changes to Rejected
- [ ] Rejection reason displayed

---

### 2.4 Training Management (UAT-TR)

#### UAT-TR-001: View Training List
**Objective**: Verify user can view assigned training

**Test Scenario**:
1. Open onboarding
2. Navigate to Training tab

**Expected Result**: All training items displayed

**Acceptance Criteria**:
- [ ] Training listed with type
- [ ] Status shown
- [ ] Due dates visible

---

#### UAT-TR-002: Complete Training
**Objective**: Verify training completion tracking

**Test Scenario**:
1. Open training item
2. Mark as Completed
3. Add score
4. Add certificate

**Expected Result**: Training marked complete

**Acceptance Criteria**:
- [ ] Status changed to Completed
- [ ] Completion date set
- [ ] Score saved
- [ ] Certificate path stored

---

### 2.5 Dashboard (UAT-DB)

#### UAT-DB-001: View Dashboard
**Objective**: Verify dashboard statistics display correctly

**Test Scenario**:
1. Navigate to Onboarding Dashboard
2. View statistics

**Expected Result**: Accurate statistics displayed

**Acceptance Criteria**:
- [ ] Total active onboardings count correct
- [ ] Tasks pending count accurate
- [ ] Documents pending count accurate
- [ ] Recent activities listed

---

#### UAT-DB-002: View Reports
**Objective**: Verify reporting functions work

**Test Scenario**:
1. Navigate to Reports
2. Generate status report

**Expected Result**: Report displays data

**Acceptance Criteria**:
- [ ] Data accurate
- [ ] Export works

---

### 2.6 Settings (UAT-ST)

#### UAT-ST-001: Manage Workflow Templates
**Objective**: Verify workflow template management

**Test Scenario**:
1. Navigate to Settings → Workflow Templates
2. Add new template
3. Add tasks to template

**Expected Result**: Template created

**Acceptance Criteria**:
- [ ] Template saved
- [ ] Tasks configurable

---

## 3. Integration Test Cases

### 3.1 Employee Integration (UAT-INT-001)
**Objective**: Verify employee record created on completion

**Test Scenario**:
1. Complete all onboarding tasks
2. Complete all documents verified
3. Complete onboarding
4. Trigger employee creation

**Expected Result**: Employee record created in FA

**Acceptance Criteria**:
- [ ] Employee exists in FA
- [ ] Department assigned
- [ ] Manager linked

---

## 4. Test Data

### 4.1 Test Users

| User | Email | Role | Permissions |
|------|-------|------|------------|
| hr.admin@company.com | hr.admin | HR Admin | All |
| hr.manager@company.com | hr.manager | HR Manager | ONB_VIEW, ONB_MANAGE, ONB_ADMIN |
| it.staff@company.com | it.staff | IT Staff | ONB_MANAGE_TASKS |
| dept.manager@company.com | dept.manager | Manager | ONB_VIEW |

### 4.2 Test Onboardings

| Name | Start Date | Department | Status |
|------|-----------|------------|---------|
| John Smith | 2024-02-01 | Engineering | In Progress |
| Jane Doe | 2024-02-15 | Marketing | Not Started |
| Bob Wilson | 2024-01-15 | Sales | Completed |

## 5. Sign-Off Criteria

### 5.1 Core Functionality
- [ ] Create new hire onboarding
- [ ] View onboarding list
- [ ] Edit onboarding details
- [ ] Delete onboarding record

### 5.2 Task Management
- [ ] View task checklist
- [ ] Complete tasks
- [ ] View progress

### 5.3 Document Management
- [ ] View documents
- [ ] Verify documents
- [ ] Reject documents

### 5.4 Training
- [ ] View training
- [ ] Mark training complete

### 5.5 Dashboard
- [ ] View statistics
- [ ] Generate reports

---

## 6. Known Issues / Notes

_TODO: Document any known issues discovered during UAT_

---

*Document Version: 1.0.0*
*Last Updated: 2024-04-25*

# FA_Onboarding Test Plan

## Document Information
- **Module**: FA_Onboarding (Employee Onboarding)
- **Version**: 1.0.0
- **Date**: 2024-04-25
- **Status**: Planning
- **Author**: KSFII Development Team

## 1. Introduction

### 1.1 Purpose
This test plan defines the testing strategy and approach for the FA_Onboarding module, ensuring all functional requirements are met and the module functions correctly within the FrontAccounting framework.

### 1.2 Scope
- Unit testing of core functions
- Integration testing with FA framework
- UI component testing
- Database operation testing
- Document management testing
- Training tracking testing

### 1.3 Test Environment
- **PHP Version**: 8.0+
- **Database**: MySQL 5.7+ / MariaDB 10.0+
- **FA Version**: 2.4.0+
- **Testing Framework**: PHPUnit

## 2. Testing Strategy

### 2.1 Test Levels

#### Unit Testing
Testing individual functions and methods in isolation.

#### Integration Testing
Testing the module's interaction with FA core components.

#### System Testing
End-to-end testing of complete workflows.

### 2.2 Test Types

| Type | Description | Coverage |
|------|-------------|----------|
| Functional | Verify features work as specified | 100% |
| Regression | Ensure no existing features broken | 100% |
| Performance | Verify acceptable response times | Selected |
| Security | Verify input validation | Critical paths |

## 3. Test Cases by Module

### 3.1 Onboarding Management (TC-ON)

#### TC-ON-001: Create New Hire Onboarding Record
**Preconditions**: 
- User has ONB_MANAGE_ONBOARDING permission
- Workflow template exists

**Test Steps**:
1. Navigate to New Hires
2. Click Add New
3. Fill in required fields:
   - First name, Last name
   - Email address
   - Start date
   - Department
   - Position
   - Manager
4. Select workflow template
5. Save

**Expected Result**: Onboarding record created with system-generated ID

**Priority**: High

---

#### TC-ON-002: Update Onboarding Record
**Preconditions**: 
- Onboarding record exists

**Test Steps**:
1. Open onboarding record
2. Update fields (e.g., start date, position)
3. Save

**Expected Result**: All fields updated correctly in database

**Priority**: High

---

#### TC-ON-003: View Onboarding List
**Preconditions**: 
- User has ONB_VIEW_ONBOARDING permission
- Multiple onboarding records exist

**Test Steps**:
1. Navigate to New Hires list
2. Verify all columns display correctly
3. Test filtering by status
4. Test search functionality

**Expected Result**: List displays with correct data and filtering works

**Priority**: High

---

#### TC-ON-004: Delete Onboarding Record
**Preconditions**: 
- Onboarding record exists
- User has ONB_MANAGE_ONBOARDING permission

**Test Steps**:
1. Open onboarding record
2. Click Delete
3. Confirm deletion

**Expected Result**: Record and related tasks/documents/training deleted

**Priority**: High

---

### 3.2 Task Management (TC-TK)

#### TC-TK-001: View Task Checklist
**Preconditions**: 
- Onboarding record exists with tasks

**Test Steps**:
1. Open onboarding record
2. Navigate to Tasks tab
3. View task checklist

**Expected Result**: All tasks display grouped by phase

**Priority**: High

---

#### TC-TK-002: Update Task Status
**Preconditions**: 
- Task exists in onboarding

**Test Steps**:
1. Open task detail
2. Change status to "In Progress"
3. Add completion notes
4. Mark as "Completed"

**Expected Result**: Task status updates correctly with timestamp

**Priority**: High

---

#### TC-TK-003: Calculate Progress
**Preconditions**: 
- Onboarding has multiple tasks with varying statuses

**Test Steps**:
1. Get progress for onboarding
2. Verify calculation formula

**Expected Result**: Progress = (Completed Tasks / Total Tasks) × 100

**Priority**: High

---

#### TC-TK-004: Task Assignment
**Preconditions**: 
- Task exists

**Test Steps**:
1. Edit task
2. Change assigned_to
3. Save

**Expected Result**: Task reassigned to new role

**Priority**: Medium

---

### 3.3 Document Management (TC-DO)

#### TC-DO-001: View Document List
**Preconditions**: 
- Onboarding record exists

**Test Steps**:
1. Open onboarding
2. Navigate to Documents tab
3. View document list

**Expected Result**: All required documents displayed with status

**Priority**: High

---

#### TC-DO-002: Submit Document
**Preconditions**: 
- Onboarding record exists

**Test Steps**:
1. Open document
2. Mark as Submitted
3. Add submission date

**Expected Result**: Document status changes to Submitted

**Priority**: High

---

#### TC-DO-003: Verify Document
**Preconditions**: 
- Document submitted
- User has ONB_VERIFY_DOCUMENTS permission

**Test Steps**:
1. Open submitted document
2. Verify document
3. Add verification notes

**Expected Result**: Document verified with timestamp

**Priority**: High

---

#### TC-DO-004: Reject Document
**Preconditions**: 
- Document submitted
- User has ONB_VERIFY_DOCUMENTS permission

**Test Steps**:
1. Open submitted document
2. Reject with reason

**Expected Result**: Document rejected with notes

**Priority**: High

---

### 3.4 Training Management (TC-TR)

#### TC-TR-001: View Training List
**Preconditions**: 
- Onboarding record exists with training

**Test Steps**:
1. Open onboarding
2. Navigate to Training tab
3. View training list

**Expected Result**: All training items displayed

**Priority**: Medium

---

#### TC-TR-002: Mark Training Complete
**Preconditions**: 
- Training exists

**Test Steps**:
1. Open training item
2. Mark as Completed
3. Add completion date and score

**Expected Result**: Training status updated

**Priority**: Medium

---

#### TC-TR-003: Track Certification
**Preconditions**: 
- Completed training with certificate

**Test Steps**:
1. Edit training
2. Add certificate path

**Expected Result**: Certificate stored and viewable

**Priority**: Medium

---

### 3.5 Workflow Templates (TC-WF)

#### TC-WF-001: Create Workflow Template
**Preconditions**: 
- User has ONB_ADMIN permission

**Test Steps**:
1. Navigate to Settings → Workflow Templates
2. Add new template
3. Define name, description, duration
4. Save

**Expected Result**: Template created

**Priority**: High

---

#### TC-WF-002: Apply Workflow Template
**Preconditions**: 
- Workflow template exists

**Test Steps**:
1. Create new onboarding with template
2. Verify tasks auto-created

**Expected Result**: Tasks generated from template

**Priority**: High

---

### 3.6 Dashboard & Reporting (TC-DB)

#### TC-DB-001: View Dashboard
**Preconditions**: 
- User has ONB_VIEW_ONBOARDING permission

**Test Steps**:
1. Navigate to Onboarding Dashboard
2. View statistics

**Expected Result**: Dashboard shows correct statistics

**Priority**: High

---

#### TC-DB-002: View Reports
**Preconditions**: 
- User has ONB_REPORTS permission

**Test Steps**:
1. Navigate to Reports
2. Generate report

**Expected Result**: Report displays accurate data

**Priority**: Medium

---

### 3.7 Integration (TC-INT)

#### TC-INT-001: Employee Creation
**Preconditions**: 
- OnboardingCompleted
- Employee record linked

**Test Steps**:
1. Complete onboarding process
2. Trigger employee creation

**Expected Result**: Employee record created in FA

**Priority**: High

---

## 4. Test Data Management

### 4.1 Test Users

| User | Role | Permissions |
|------|------|------------|
| admin | Administrator | All |
| hr_manager | HR Manager | ONB_ADMIN |
| hr_staff | HR Staff | ONB_MANAGE_ONBOARDING, ONB_VIEW_TASKS |
| it_staff | IT Staff | ONB_MANAGE_TASKS, ONB_VERIFY_DOCUMENTS |
| manager | Department Manager | ONB_VIEW_ONBOARDING |

### 4.2 Test Data Sets

- 5 new hire onboarding records
- 2 workflow templates
- Various task statuses
- Mixed document statuses
- Training records

## 5. Acceptance Criteria

### 5.1 Functional Criteria

| Criteria | Test Case | Pass Condition |
|----------|-----------|----------------|
| Create onboarding | TC-ON-001 | Record created in DB |
| Update onboarding | TC-ON-002 | Fields updated |
| Delete onboarding | TC-ON-004 | All related data deleted |
| Task completion | TC-TK-002 | Status and timestamp recorded |
| Document verification | TC-DO-003 | Verified status applied |
| Progress calculation | TC-TK-003 | Correct percentage |

### 5.2 Non-Functional Criteria

| Criteria | Test Case | Pass Condition |
|----------|-----------|----------------|
| Page load | All | < 3 seconds |
| Security | All | No SQL injection |
| UX | All | Intuitive flow |

---

*Document Version: 1.0.0*
*Last Updated: 2024-04-25*

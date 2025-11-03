<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info<?php $this->endSection()?>
<?php $this->section('main')?>
<?php $validation = \Config\Services::validation(); ?>
<?php $this->section('pageStyles')?>
<style>
.main-title {
  color: #004c99;
  font-weight: 700;
  margin-bottom: 5px;
}

.sub-title {
  color: #6c757d;
  font-weight: 400;
  font-size: 1rem;
  margin-bottom: 25px;
  border-bottom: 1px solid #dee2e6;
  padding-bottom: 15px;
}

.section-header {
  color: #007bff;
  font-weight: 600;
  margin-top: 10px;
  margin-bottom: 20px;
  background-color: #f8f9fa;
  padding: 10px 15px;
  border-left: 5px solid #007bff;
  border-radius: 0.5rem;
}

.btn-submit {
  background-color: #004c99;
  border-color: #004c99;
  border-radius: 0.5rem;
  padding: 12px 30px;
  font-size: 1.1rem;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #003366;
  border-color: #003366;
}

.form-control,
.form-select {
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
}

#previousTrainingDetails {
  border: 1px solid #ffc107;
  background-color: #fffbe6;
}

.table-responsive {
  max-width: 100%;
  overflow-x: auto;
}

.preview-label {
  font-weight: 600;
  color: #495057;
}

.preview-value {
  color: #212529;
  font-size: 0.95rem;
  /* Smaller for long file names */
}
</style>
<?php $this->endSection()?>
<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h3 class="main-title text-center">HONORARIUM APPLICATION</h3>
    <p class="sub-title text-center">(Bill of Non-Governmental Trainees Allowances)</p>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
      <?=session()->getFlashdata('success')?>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
      <?=session()->getFlashdata('error')?>
    </div>
    <?php endif; ?>

    <?php
        $applicationExists = true;
    if (!$applicationExists): ?>
    <div class="alert alert-danger fw-bold" role="alert">
      <span class="text-danger"> Training application not found! Please apply before submit the bill form. For apply
      </span><a class="text-success" href="<?=base_url('trainings/training-application')?>">Click Here</a>
    </div>
    <?php else: ?>
    <form action="#" method="post" id="honorariumForm" novalidate onsubmit="return false;">
      <!-- ========================================================= -->
      <!-- FORM ENTRY SECTION (Visible by default) -->
      <!-- ========================================================= -->
      <div id="formContent">

        <!-- Section A: General Information (1-9) -->
        <h4 class="section-header">A) General Information</h4>
        <div class="row g-4 mb-5">

          <!-- Field 1: Name of the Trainee -->
          <div class="col-md-12">
            <label for="traineeName" class="form-label">1) Name of the Trainee (In capital letters as per NID
              card)</label>
            <input type="text" class="form-control" id="traineeName" name="traineeName"
              placeholder="E.g., DR. SHAFIQUL ISLAM" oninput="this.value = this.value.toUpperCase()" required>
          </div>

          <!-- Field 2: Specialty -->
          <div class="col-md-6">
            <label for="specialty" class="form-label">2) Specialty</label>
            <select id="specialty" name="specialty" class="form-select" required>
              <option value="" disabled selected>Select Please</option>
              <option value="Anaesthesiology">Anaesthesiology</option>
              <option value="Biochemistry">Biochemistry</option>
              <option value="Cardiology">Cardiology</option>
              <option value="Cardiovascular Surgery">Cardiovascular Surgery</option>
              <option value="Conservative Dentistry & Endodontics">Conservative Dentistry & Endodontics</option>
              <option value="Ophthalmology">Ophthalmology</option>
            </select>
          </div>

          <!-- Field 3: FCPS Part-I Passed Session/Year -->
          <div class="col-md-6 row g-3">
            <label class="form-label mb-2">3) FCPS Part-I Passed Session/Year</label>
            <div class="col-6">
              <select id="fcpsSession" name="fcpsSession" class="form-select" required>
                <option value="" disabled selected>Select Session</option>
                <option value="January">January</option>
                <option value="July">July</option>
              </select>
            </div>
            <div class="col-6">
              <select id="fcpsYear" name="fcpsYear" class="form-select" required>
                <option value="" disabled selected>Select Year</option>
                <!-- Years will be dynamically populated by JS -->
              </select>
            </div>
          </div>

          <!-- Field 4: BCPS Reg. No. -->
          <div class="col-md-6">
            <label for="bcpsRegNo" class="form-label">4) BCPS Reg. No. (10 Digit after passing FCPS Part-I)</label>
            <input type="text" class="form-control" id="bcpsRegNo" name="bcpsRegNo" placeholder="Enter 10-digit number"
              pattern="\d{10}" maxlength="10" required>
          </div>

          <!-- Field 5: National Identity Card No. -->
          <div class="col-md-6">
            <label for="nidNo" class="form-label">5) National Identity Card No.</label>
            <input type="text" class="form-control" id="nidNo" name="nidNo" placeholder="Enter NID number" required>
          </div>

          <!-- Field 6: Date of Birth -->
          <div class="col-md-6">
            <label for="dob" class="form-label">6) Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required title="Format: YYYY-MM-DD">
          </div>

          <!-- Field 7: Gender -->
          <div class="col-md-6">
            <label class="form-label">7) Gender</label>
            <div class="d-flex align-items-center h-100 pt-1">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" required>
                <label class="form-check-label" for="genderMale">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female">
                <label class="form-check-label" for="genderFemale">Female</label>
              </div>
            </div>
          </div>

          <!-- Field 8: Mobile Number -->
          <div class="col-md-6">
            <label for="mobileNo" class="form-label">8) Mobile Number (Personal)</label>
            <input type="tel" class="form-control" id="mobileNo" name="mobileNo" placeholder="e.g., 01XXXXXXXXX"
              pattern="[0-9]{11}" required>
          </div>

          <!-- Field 9: Email -->
          <div class="col-md-6">
            <label for="email" class="form-label">9) Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
          </div>
        </div>

        <!-- Section B: Applicant's Training Information (10-14) -->
        <h4 class="section-header">B) Applicant's Training Information</h4>
        <div class="row g-4 mb-5">

          <!-- Field 10: Institute Name -->
          <div class="col-md-6">
            <label for="instituteName" class="form-label">10) Institute Name</label>
            <select id="instituteName" name="instituteName" class="form-select" required>
              <option value="" disabled selected>Select Please</option>
              <!-- Options populated by JS -->
            </select>
          </div>

          <!-- Field 11: Department -->
          <div class="col-md-6">
            <label for="department" class="form-label">11) Department</label>
            <select id="department" name="department" class="form-select" required>
              <option value="" disabled selected>Select Please</option>
              <!-- Options populated by JS -->
            </select>
          </div>

          <!-- Field 12: Period of Training (Year) -->
          <div class="col-md-6">
            <label for="trainingPeriodYear" class="form-label">12) Period of Training (Year)</label>
            <select id="trainingPeriodYear" name="trainingPeriodYear" class="form-select" required>
              <option value="" disabled selected>Select Please</option>
              <!-- Years will be populated by JS -->
            </select>
          </div>

          <!-- Field 14: Applying for honorarium (Months) -->
          <div class="col-md-6">
            <label for="honorariumMonths" class="form-label">14) Applying for Honorarium (Months)</label>
            <select id="honorariumMonths" name="honorariumMonths" class="form-select" required>
              <option value="" disabled selected>Select</option>
              <option value="1">1 Month</option>
              <option value="2">2 Months</option>
              <option value="3">3 Months</option>
              <option value="4">4 Months</option>
            </select>
          </div>

          <!-- Field 13: Total Previous Training with Course (In Month) - Dynamic Section Trigger -->
          <div class="col-md-12">
            <label for="previousTrainingMonths" class="form-label">
              13) Total Previous Training with Course (In Month) ** Except Current Period of Training
            </label>
            <select id="previousTrainingMonths" name="previousTrainingMonths" class="form-select"
              onchange="togglePreviousTrainingDetails(this.value)" required>
              <option value="" disabled selected>Select</option>
              <option value="0">0 (None)</option>
              <option value="1">1 Month</option>
              <option value="2">2 Months</option>
              <option value="3">3 Months</option>
              <option value="4">4 Months</option>
              <option value="5">5 Months</option>
              <option value="6">6 Months or More</option>
            </select>
          </div>

          <!-- DYNAMIC TABLE SECTION (Field 13 Details) -->
          <div class="col-md-12 mt-4 p-3 rounded" id="previousTrainingDetails" style="display: none;">
            <p class="text-warning-emphasis fw-bold mb-3">
              <i class="fas fa-exclamation-triangle me-2"></i> Please provide details for previous training periods (1
              to 3 Months).
            </p>

            <div class="table-responsive">
              <table class="table table-bordered table-striped align-middle">
                <thead class="table-warning">
                  <tr>
                    <th class="text-nowrap">From Date</th>
                    <th class="text-nowrap">To Date</th>
                    <th class="text-nowrap">Subject</th>
                    <th class="text-nowrap">Institute</th>
                    <th class="text-center text-nowrap">Honorarium Taken</th>
                    <th class="text-center text-nowrap">Action</th>
                  </tr>
                </thead>
                <tbody id="dynamicTrainingRows">
                  <!-- Dynamic rows will be inserted here -->
                </tbody>
              </table>
            </div>

            <button type="button" onclick="addTrainingRow()" class="btn btn-sm btn-success mt-2">
              <i class="fas fa-plus me-1"></i> Add Record
            </button>
          </div>
        </div>

        <!-- Section C: Applicant's Personal Bank Information (15-19) -->
        <h4 class="section-header">C) Applicant's Personal Bank Information</h4>
        <div class="row g-4 mb-5">

          <!-- Field 15: Name in block letters (Online & Personal) -->
          <div class="col-md-12">
            <label for="bankAccountHolderName" class="form-label">15) Name in block letters (Online & Personal)</label>
            <input type="text" class="form-control" id="bankAccountHolderName" name="bankAccountHolderName"
              placeholder="E.g., DR. SHAFIQUL ISLAM" oninput="this.value = this.value.toUpperCase()" required>
          </div>

          <!-- Field 16: Name of the Bank -->
          <div class="col-md-6">
            <label for="bankName" class="form-label">16) Name of the Bank</label>
            <select id="bankName" name="bankName" class="form-select" required>
              <option value="" disabled selected>Select Please</option>
              <!-- Options populated by JS -->
            </select>
          </div>

          <!-- Field 17: Name of the Branch -->
          <div class="col-md-6">
            <label for="branchName" class="form-label">17) Name of the Branch</label>
            <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Enter branch name"
              required>
          </div>

          <!-- Field 18: Account Number (Online & Personal) -->
          <div class="col-md-6">
            <label for="accountNumber" class="form-label">18) Account Number (Online & Personal)</label>
            <input type="text" class="form-control" id="accountNumber" name="accountNumber"
              placeholder="Enter account number" required>
          </div>

          <!-- Field 19: Routing Number -->
          <div class="col-md-6">
            <label for="routingNumber" class="form-label">19) Routing Number</label>
            <input type="text" class="form-control" id="routingNumber" name="routingNumber"
              placeholder="Enter 9-digit routing number" pattern="\d{9}" maxlength="9" required>
          </div>
        </div>

        <!-- ========================================================= -->
        <!-- Section D: Enclosures (File Uploads) -->
        <!-- ========================================================= -->
        <h4 class="section-header">D) Enclosures: (The applicants have to scan and upload the following documents)</h4>
        <div class="row g-4 mb-5">

          <!-- Document 1: Provisional training certificate -->
          <div class="col-md-12">
            <label for="enclosure1" class="form-label">
              1) Provisional training certificate Signature and seal of Supervisor and Director (Hospital)/
              Superintendent (Hospital)/ Principal for Basic Subject:
            </label>
            <input type="file" class="form-control" id="enclosure1" name="enclosure1" accept=".pdf,.jpg,.jpeg,.png"
              required>
            <div class="form-text">Accepted formats: PDF, JPG/JPEG, PNG.</div>
          </div>

          <!-- Document 2: A page of the Bank Cheque book -->
          <div class="col-md-12">
            <label for="enclosure2" class="form-label">
              2) A page of the **Bank Cheque book** of the applicant:
            </label>
            <input type="file" class="form-control" id="enclosure2" name="enclosure2" accept=".pdf,.jpg,.jpeg,.png"
              required>
          </div>

          <!-- Document 3: Recent Passport size color Photograph -->
          <div class="col-md-6">
            <label for="enclosure3" class="form-label">
              3) Recent Passport size color **Photograph**:
            </label>
            <input type="file" class="form-control" id="enclosure3" name="enclosure3" accept="image/jpeg,image/png"
              required>
            <div class="form-text">Resolution: 300x300 pixels, Size: below 300 kb. Accepted formats: JPG/PNG.</div>
          </div>

          <!-- Document 4: Applicant’s Signature -->
          <div class="col-md-6">
            <label for="enclosure4" class="form-label">
              4) Applicant’s **Signature**:
            </label>
            <input type="file" class="form-control" id="enclosure4" name="enclosure4" accept="image/jpeg,image/png"
              required>
            <div class="form-text">Resolution: 300x80 pixels, Size: below 300 kb. Accepted formats: JPG/PNG.</div>
          </div>

          <!-- Document 5: National Identity Card (NID/Smart Card) -->
          <div class="col-md-12">
            <label for="enclosure5" class="form-label">
              5) National Identity Card (**NID/Smart Card**):
            </label>
            <input type="file" class="form-control" id="enclosure5" name="enclosure5" accept=".pdf,.jpg,.jpeg,.png"
              required multiple>
            <div class="form-text">Upload front and back if required (use Ctrl/Cmd key). Accepted formats: PDF, JPG/PNG.
            </div>
          </div>
        </div>

        <!-- Preview Button -->
        <div class="d-grid gap-2">
          <button type="button" onclick="handlePreview()" class="btn btn-submit">
            <i class="fas fa-file-invoice me-2"></i> Review & Proceed to Submission
          </button>
        </div>
      </div>
    </form>
    <!-- ========================================================= -->
    <!-- PREVIEW SECTION (Hidden by default) -->
    <!-- ========================================================= -->
    <div id="previewContent" style="display: none;">
      <h4 class="section-header">Review & Confirm Information</h4>
      <p class="mb-4 text-muted">Please check the details below carefully before final submission.</p>

      <div id="previewData" class="mb-5">
        <!-- Preview data will be rendered here -->
      </div>

      <div class="d-flex justify-content-between gap-3">
        <button type="button" onclick="editForm()" class="btn btn-outline-secondary w-50">
          <i class="fas fa-edit me-2"></i> Go Back and Edit
        </button>
        <button type="button" onclick="confirmSubmission()" class="btn btn-success w-50">
          <i class="fas fa-check-circle me-2"></i> Confirm & Submit Claim
        </button>
      </div>
      <div id="submissionMessage" class="mt-3 text-center" style="display: none;"></div>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$(document).ready(function() {
  $('#dob').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });
});

let trainingRowCount = 0;

// --- Utility Functions for Dynamic Table ---

function togglePreviousTrainingDetails(value) {
  const container = document.getElementById('previousTrainingDetails');
  const count = parseInt(value);

  container.style.display = 'none';
  document.getElementById('dynamicTrainingRows').innerHTML = '';
  trainingRowCount = 0;
  setDynamicFieldsRequired(false);

  if (count >= 1 && count <= 3) {
    container.style.display = 'block';
    for (let i = 0; i < count; i++) {
      addTrainingRow(true);
    }
  }
}

function setDynamicFieldsRequired(isRequired) {
  const rows = document.querySelectorAll('#dynamicTrainingRows input, #dynamicTrainingRows select');
  rows.forEach(field => {
    if (field.type !== 'checkbox') {
      field.required = isRequired;
    }
  });
}

function createTrainingRowHTML(id) {
  const instituteOptions = MOCK_INSTITUTES.map(inst => `<option value="${inst}">${inst}</option>`).join('');
  const subjectOptions = MOCK_SUBJECTS.map(subj => `<option value="${subj}">${subj}</option>`).join('');

  return `
            <tr data-row-id="${id}">
                <td class="p-2">
                    <input type="date" name="from_date_${id}" class="form-control form-control-sm" required title="Format: YYYY-MM-DD">
                </td>
                <td class="p-2">
                    <input type="date" name="to_date_${id}" class="form-control form-control-sm" required title="Format: YYYY-MM-DD">
                </td>
                <td class="p-2">
                    <select name="subject_${id}" class="form-select form-select-sm" required>
                        <option value="" disabled selected>Select Subject</option>
                        ${subjectOptions}
                    </select>
                </td>
                <td class="p-2">
                    <select name="institute_${id}" class="form-select form-select-sm" required>
                        <option value="" disabled selected>Select Institute</option>
                        ${instituteOptions}
                    </select>
                </td>
                <td class="p-2 text-center">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="honorarium_taken_${id}" class="form-check-input">
                    </div>
                </td>
                <td class="p-2 text-center">
                    <button type="button" onclick="removeTrainingRow(${id})" class="btn btn-sm btn-danger p-1">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        `;
}

window.addTrainingRow = function() {
  trainingRowCount++;
  const tableBody = document.getElementById('dynamicTrainingRows');
  tableBody.insertAdjacentHTML('beforeend', createTrainingRowHTML(trainingRowCount));
  setDynamicFieldsRequired(true);
}

window.removeTrainingRow = function(id) {
  const row = document.querySelector(`#dynamicTrainingRows [data-row-id="${id}"]`);
  if (row) {
    row.remove();
  }
}
</script>
<?php $this->endSection()?>
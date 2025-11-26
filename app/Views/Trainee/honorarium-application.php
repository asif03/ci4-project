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

    <form action="#" method="post" id="honorariumForm" novalidate onsubmit="return false;">
      <!-- ========================================================= -->
      <!-- FORM ENTRY SECTION (Visible by default) -->
      <!-- ========================================================= -->
      <div id="formContent">
        <div class="row g-4 mb-5">
          <!-- BMDC Reg. No. -->
          <div class="col-md-2">
            <label for="bmdcRegNo" class="form-label">BMDC Reg. No.</label>
            <input type="text" class="form-control" id="bmdcRegNo" name="bmdcRegNo"
              value="<?=esc($applicantInfo['bmdc_reg_no'])?>" placeholder="E.g., " disabled>
          </div>
          <div class="col-md-2">
            <label for="bmdcValidity" class="form-label">BMDC Reg. Validity</label>
            <input type="text" class="form-control text-center" id="bmdcValidity" name="bmdcValidity"
              value="<?=esc($applicantInfo['bmdc_validity'])?>" placeholder="E.g.,YYYY-MM-DD">
          </div>
          <div class=" col-md-4">
            <label for="bmdcValidity" class="form-label text-center">Training Type</label>
            <div class="d-flex align-items-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="trainingType" id="coreTraining" value="Core"
                  onchange="changeTrainingType(this.value)" required />
                <label class="form-check-label" for="coreTraining">
                  Core
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="trainingType" id="advanceTraining" value="Advance"
                  onchange="changeTrainingType(this.value)" required />
                <label class="form-check-label" for="advanceTraining">
                  Advance
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <label for="bmdcValidity" class="form-label">Have you seat for Mid-Term Exam?</label>
            <div class="d-flex align-items-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="midTermAppeared" id="midTermAppeared"
                  onchange="changeMidTerm()" />
                <label class="form-check-label" for="midTermAppeared">
                  Yes
                </label>
              </div>
            </div>
          </div>
        </div>
        <!-- Section A: General Information (1-9) -->
        <h4 class="section-header">A) General Information</h4>
        <div class="row g-4 mb-5">
          <!-- Field 1: Name of the Trainee -->
          <div class="col-md-12">
            <label for="traineeName" class="form-label">1) Name of the Trainee (In capital letters as per NID
              card)</label>
            <input type="text" class="form-control text-uppercase" id="traineeName" name="traineeName"
              value="<?=esc($applicantInfo['name'])?>" placeholder="E.g., DR. SHAFIQUL ISLAM" disabled>
          </div>

          <!-- Field 2: Specialty -->
          <div class="col-md-6">
            <label for="specialty" class="form-label">2) Specialty</label>
            <select id="fcpsSpecialty" class="form-select" disabled>
              <option selected disabled value="">Select a Subject...</option>
              <?php foreach ($specialities as $subject): ?>
              <option value="<?=esc($subject['speciality_id'])?>"
                <?=($subject['speciality_id'] === $basicInfo['subject_id']) ? 'selected' : ''?>>
                <?=esc($subject['name'])?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Field 3: FCPS Part-I Passed Session/Year -->
          <div class="col-md-6 row mt-4">
            <label class="form-label mb-2">3) FCPS Part-I Passed Session/Year</label>
            <div class="col-6">
              <select id="fcpsSession" class="form-select" disabled>
                <option value="" disabled selected>Select Session</option>
                <option value="January" <?=('January' === $basicInfo['fcps_part_one_session']) ? 'selected' : ''?>>
                  January
                </option>
                <option value="July" <?=('July' === $basicInfo['fcps_part_one_session']) ? 'selected' : ''?>>
                  July</option>
              </select>
            </div>
            <div class="col-6">
              <select id="fcpsPassYear" name="fcpsPassYear" class="form-select" disabled>
                <option value="" selected disabled>
                  Select Year
                </option>
                <?php
                    $current_year = date('Y');
                for ($year = 1990; $year <= $current_year; $year++) {?>
                <option value="<?=esc($year)?>" <?=($year == $basicInfo['fcps_part_one_year']) ? 'selected' : ''?>>
                  <?=esc($year)?>
                </option>
                <?php }?>
              </select>
            </div>
          </div>

          <!-- Field 4: BCPS Reg. No. -->
          <div class="col-md-6">
            <label for="bcpsRegNo" class="form-label">4) BCPS Reg. No. (10 Digit after passing FCPS Part-I)</label>
            <input type="text" value="<?=esc($basicInfo['reg_no'])?>" class="form-control" id="bcpsRegNo"
              name="bcpsRegNo" placeholder="Enter 10-digit number" pattern="\d{10}" maxlength="10" disabled>
          </div>

          <!-- Field 5: National Identity Card No. -->
          <div class="col-md-6">
            <label for="nidNo" class="form-label">5) National Identity Card No.</label>
            <input type="text" value="<?=esc($applicantInfo['nid'])?>" class="form-control" id="nidNo" name="nidNo"
              placeholder="Enter NID number" required>
          </div>

          <!-- Field 6: Date of Birth -->
          <div class="col-md-6">
            <label for="dob" class="form-label">6) Date of Birth</label>
            <input type="text" value="<?=esc($applicantInfo['date_of_birth'])?>" class="form-control" id="dob"
              name="dob" required title="Format: YYYY-MM-DD">
          </div>

          <!-- Field 7: Gender -->
          <div class="col-md-6">
            <label class="form-label">7) Gender</label>
            <div class="d-flex align-items-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male"
                  <?=$applicantInfo['gander'] == 'Male' ? 'checked' : '';?> required>
                <label class="form-check-label" for="genderMale">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female"
                  <?=$applicantInfo['gander'] == 'Female' ? 'checked' : '';?> required>
                <label class="form-check-label" for="genderFemale">Female</label>
              </div>
            </div>
          </div>

          <!-- Field 8: Mobile Number -->
          <div class="col-md-6">
            <label for="mobileNo" class="form-label">8) Mobile Number (Personal)</label>
            <input type="tel" value="<?=esc($applicantInfo['mobile'])?>" class="form-control" id="mobileNo"
              name="mobileNo" placeholder="e.g., 01XXXXXXXXX" pattern="[0-9]{11}" required>
          </div>

          <!-- Field 9: Email -->
          <div class="col-md-6">
            <label for="email" class="form-label">9) Email</label>
            <input type="email" value="<?=esc($applicantInfo['email'])?>" class="form-control" id="email" name="email"
              placeholder="you@example.com" required>
          </div>
        </div>

        <!-- Section B: Applicant's Training Information (10-14) -->
        <h4 class="section-header">B) Applicant's Training Information</h4>
        <div class="row g-4 mb-5">
          <!-- Field 10: Institute Name -->
          <div class="col-md-6">
            <label for="currentTrainingInstitute" class="form-label">10) Institute Name</label>
            <select name="currentTrainingInstitute" id="currentTrainingInstitute" class="form-select" required>
              <option value="" disabled selected>Select Current Training Institute</option>
              <?php foreach ($trainingInstitutes as $institute): ?>
              <option value="<?=esc($institute['institute_id'])?>">
                <?=esc($institute['name'])?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Field 11: Department -->
          <div class="col-md-6">
            <label for="currentDepartment" class="form-label">11) Department</label>
            <select name="currentDepartment" id="currentDepartment" class="form-select" required>
              <option value="" disabled selected>Select Current Department</option>
              <?php foreach ($departments as $department): ?>
              <option value="<?=esc($department['speciality_id'])?>">
                <?=esc($department['name'])?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Field 12: Period of Training (Year) -->
          <div class="col-md-6">
            <label for="trainingPeriodYear" class="form-label">12) Period of Training</label>
            <div class="d-flex gap-3">
              <select name="honorariumPeriod" id="honorariumPeriod" class="form-select" required>
                <option value="">Select Please</option>
                <?php foreach ($slots as $slot) {?>
                <option value="<?php echo $slot['id']; ?>"<?php if (date('m') <= 6 && $slot['id'] == 1) {
        echo 'selected';
    } elseif (date('m') > 6 && $slot['id'] == 2) {
    echo 'selected';
}?>>
                  <?php echo $slot['slot_name']; ?></option>
                <?php }?>
              </select>
              <select name="honorariumYear" id="honorariumYear" class="form-select" required>
                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
              </select>
            </div>
          </div>
          <!-- Field 13: Total Previous Training with Course (In Month) - Dynamic Section Trigger -->
          <div class="col-md-6">
            <label for="previousTrainingMonths" class="form-label">
              13) Total Previous Training (accredited by BCPS) with Course (In Month) [Except Current Period of
              Training]
            </label>
            <select name="coursePeriod" id="coursePeriod" class="form-select"
              onchange="togglePreviousTrainingDetails(this.value)" required>
              <option value="" disabled selected>Select</option>
              <?php
                  for ($cnt = 0; $cnt <= 54; $cnt = $cnt + 6) {
                  ?>
              <option value="<?php echo $cnt; ?>"<?php if ((count($totalTrainings) * 6) == $cnt) {
            echo 'selected';
    }
    ?>>
                <?php echo $cnt; ?></option>
              <?php
                  }
              ?>
            </select>
          </div>

          <!-- DYNAMIC TABLE SECTION (Field 13 Details) -->
          <div class="col-md-12 mt-3 rounded" id="previousTrainingDetails" style="display: none;">
            <p class="text-warning-emphasis fw-bold mb-3">
              <i class="fas fa-exclamation-triangle me-2"></i> Please provide details in <strong>Ascending
                Order</strong> for
              previous training
              periods.
            </p>
            <div class="table-responsive">
              <table class="table table-bordered table-striped align-middle">
                <thead class="table-warning">
                  <tr>
                    <th class="text-nowrap">Training Slot</th>
                    <th class="text-nowrap">From Date</th>
                    <th class="text-nowrap">To Date</th>
                    <th class="text-nowrap">Name of Department</th>
                    <th class="text-nowrap">Name of Institute</th>
                    <th class="text-nowrap">Training Category</th>
                    <th class="text-center text-nowrap">Honorarium Taken from BCPS?</th>
                    <!-- <th class="text-center text-nowrap">Action</th> -->
                  </tr>
                </thead>
                <tbody id="dynamicTrainingRows">
                  <!-- Dynamic rows will be inserted here -->
                </tbody>
              </table>
            </div>

            <!-- <button type="button" onclick="addTrainingRow()" class="btn btn-sm btn-success mt-2">
                <i class="fas fa-plus me-1"></i> Add Record
              </button> -->
          </div>
          <!-- Field 14: Applying for honorarium (Months) -->
          <div class="col-md-6">
            <label for="honorariumPosition" class="form-label">14) Applying for Honorarium</label>
            <select name="honorariumPosition" id="honorariumPosition" class="form-select"
              onchange="changeTrainigPeriod(this.value)" required
              <?php if ($honorarium->maxHonorariumCnt + 1 > 1) {echo 'disabled';}?>>
              <option value="" disabled selected>Select Honorarium</option>
              <?php
                  for ($cnt = 1; $cnt <= 10; $cnt++) {
                  ?>
              <option value="<?php echo $cnt; ?>"<?php if ($honorarium->maxHonorariumCnt + 1 == $cnt) {
            echo 'selected';
    }
    ?>>
                <?php echo $cnt ?><?php if ($cnt == 1) {
            echo 'st';
        } elseif ($cnt == 2) {
            echo 'nd';
        } elseif ($cnt == 3) {
            echo 'rd';
        } else {
        echo 'th';
    }?></option>
              <?php
                  }
              ?>
            </select>
          </div>
          <div class="col-md-12 mt-2" style="<?php if ($honorarium->maxHonorariumCnt + 1 > 4) {
                                                     echo 'display: block;';
                                                 } else {
                                                     echo 'display: none';
                                             }
                                             ?>" id="midTermExam">
            <label for="midTerm" class="form-label text-danger">** Mid-Term Exam Info:</label>
            <div class="row g-3">
              <div class="col-sm-2">
                <select name="midTermExamSession" class="form-select"
                  <?=$honorarium->maxHonorariumCnt + 1 > 4 ? 'required' : ''?>>
                  <option value="" disabled selected>Select Session</option>
                  <option value="January">January</option>
                  <option value="July">July</option>
                </select>
              </div>
              <div class="col-sm-2">
                <select name="midTermExamYear" class="form-select"
                  <?=$honorarium->maxHonorariumCnt + 1 > 4 ? 'required' : ''?>>
                  <option value="" disabled selected>Select Year</option>
                  <?php
                      for ($year = date('Y'); $year >= date('Y') - 5; $year--) {
                      ?>
                  <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                  <?php
                      }
                  ?>
                </select>
              </div>
              <div class="col-sm-2">
                <select name="midTermExamResult" class="form-select"
                  <?=$honorarium->maxHonorariumCnt + 1 > 4 ? 'required' : ''?>>
                  <option value="" disabled selected>Select Result</option>
                  <option value="Pass">Pass</option>
                  <option value="Fail">Fail</option>
                </select>
              </div>
              <div class="col-sm-2">
                <input type="text" name="midTermExamRollNo" id="midTermExamRollNo" class="form-control"
                  placeholder="Roll No." <?=$honorarium->maxHonorariumCnt + 1 > 4 ? 'required' : ''?> />
              </div>
            </div>
          </div>
        </div>

        <!-- Section C: Applicant's Personal Bank Information (15-19) -->
        <h4 class="section-header">C) Applicant's Personal Bank Information</h4>
        <div class="row g-4 mb-5">
          <!-- Field 15: Name in block letters (Online & Personal) -->
          <div class="col-md-12">
            <label for="bankAccountHolderName" class="form-label">15) Name in block letters (Online &
              Personal)</label>
            <input type="text" class="form-control" id="bankAccountHolderName" name="bankAccountHolderName"
              placeholder="E.g., DR. SHAFIQUL ISLAM" value="<?=esc($applicantInfo['name'])?>" disabled>
          </div>

          <!-- Field 16: Name of the Bank -->
          <div class="col-md-6">
            <label for="bankName" class="form-label">16) Name of the Bank</label>
            <select name="bankName" id="bankName" class="form-select"
              <?php if ($honorarium->maxHonorariumCnt != 0) {echo 'disabled';} else {echo 'required';}?>>
              <option value="" disabled selected>Select Please</option>
              <?php foreach ($banks as $bank) {?>
              <option value="<?php echo $bank['id']; ?>"<?php if ($applicantInfo['bank_id'] == $bank['id']) {
        echo 'selected';
}
    ?>><?php echo $bank['bank_name']; ?></option>
              <?php }?>
            </select>
          </div>

          <!-- Field 17: Name of the Branch -->
          <div class="col-md-6">
            <label for="branchName" class="form-label">17) Name of the Branch</label>
            <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Enter branch name"
              value="<?=esc($applicantInfo['branch_name'])?>"
              <?php if ($honorarium->maxHonorariumCnt != 0) {echo 'disabled';} else {echo 'required';}?>>
          </div>

          <!-- Field 18: Account Number (Online & Personal) -->
          <div class="col-md-6">
            <label for="accountNumber" class="form-label">18) Account Number (Online & Personal)</label>
            <input type="text" class="form-control" id="accountNumber" name="accountNumber"
              placeholder="Enter account number" value="<?=esc($applicantInfo['account_no'])?>"
              <?php if ($honorarium->maxHonorariumCnt != 0) {echo 'disabled';} else {echo 'required';}?>>
          </div>

          <!-- Field 19: Routing Number -->
          <div class="col-md-6">
            <label for="routingNumber" class="form-label">19) Routing Number</label>
            <input type="text" class="form-control" id="routingNumber" name="routingNumber"
              placeholder="Enter 9-digit routing number" pattern="\d{9}" maxlength="9"
              value="<?=esc($applicantInfo['routing_number'])?>"
              <?php if ($honorarium->maxHonorariumCnt != 0) {echo 'disabled';} else {echo 'required';}?>>
          </div>
        </div>

        <!-- ========================================================= -->
        <!-- Section D: Enclosures (File Uploads) -->
        <!-- ========================================================= -->
        <h4 class="section-header">D) Enclosures: (The applicants have to scan and upload the following documents)
        </h4>
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
            <div class="form-text">Upload front and back if required (use Ctrl/Cmd key). Accepted formats: PDF,
              JPG/PNG.
            </div>
          </div>

        </div>

        <!-- Preview Button -->
        <div class="d-grid gap-2">
          <button type="button" onclick="handlePreview()" class="btn btn-submit text-white">
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
          <i class="fas fa-check-circle me-2"></i> Confirm & Submit Bill
        </button>
      </div>
      <div id="submissionMessage" class="mt-3 text-center" style="display: none;"></div>
    </div>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$(document).ready(function() {

  // Initialize any existing datepickers on page load
  initDatepicker();

  // When new rows are added dynamically
  $(document).on('focus', '.datepicker', function() {
    if (!$(this).hasClass('hasDatepicker')) {
      $(this).datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom'
      }).addClass('hasDatepicker');
    }
  });

  $('#dob').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#bmdcValidity').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  <?php if (count($totalTrainings) > 0) {?>
  togglePreviousTrainingDetails(<?=count($totalTrainings) * 6?>);
  <?php }?>
});

// Helper function to initialize existing datepickers
function initDatepicker() {
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    orientation: 'bottom'
  });
}

function changeMidTerm() {

  const value = $('#midTermAppeared').is(':checked') ? '1' : '0';
  const checkedOption = document.querySelector('input[name="trainingType"]:checked');
  const trainingTypeSelection = checkedOption ? checkedOption.value : null;

  if (value == '1') {
    alert('You have selected that you have appeared for the Mid-Term Exam.');
    $('#advanceTraining').prop('checked', true);
    $('#midTermExam').show();
  } else {
    $('#midTermExam').hide();
  }

  if (trainingTypeSelection == 'Advance') {
    $('#midTermAppeared').prop('checked', true);
    $('#midTermExam').show();
  }
}

function changeTrainingType(value) {
  if (value == 'Advance') {
    $('#midTermAppeared').prop('checked', true);
    $('#midTermExam').show();
  } else {
    $('#midTermAppeared').prop('checked', false);
    $('#midTermExam').hide();
  }
}

function changeTrainigPeriod(value) {
  //var period = (parseInt(value) - 1) * 6;
  //$('#coursePeriod').val(period);

  var style = value >= 5 ? 'block' : 'none';

  if (value < 5 && $('#midTermAppeared').is(':checked')) {
    style = 'block';
  }

  document.getElementById('midTermExam').style.display = style;

  if (value >= 5) {
    $('#midTermAppeared').prop('checked', true);
    $('#midTermExam select').attr('required', true);
    $('#midTermExamRollNo').attr('required', true);
  } else {
    $('#midTermExam select').removeAttr('required');
    $('#midTermExamRollNo').removeAttr('required');
  }
}

let trainingRowCount = 0;

// --- Utility Functions for Dynamic Table ---

function togglePreviousTrainingDetails(value) {

  const container = document.getElementById('previousTrainingDetails');
  const count = parseInt(value / 6);

  container.style.display = 'none';
  document.getElementById('dynamicTrainingRows').innerHTML = '';
  trainingRowCount = 0;
  setDynamicFieldsRequired(false);

  if (count >= 1 && count <= 10) {
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

  const rowId = id - 1;
  const prevHonorariumTrainings = <?=json_encode($totalTrainings)?>;

  return `
            <tr data-row-id="${id}">
                <td class="p-2">
                    <select name="prevTrainingSlot[${id}]" class="form-select" required>
                        <option value="" disabled selected>Select Slot</option>
                        <?php for ($cnt = 1; $cnt <= 10; $cnt++) {?>
                        <option value="<?php echo $cnt; ?>" ${prevHonorariumTrainings[rowId]?.slot_sl_no ==<?php echo $cnt; ?> ? 'selected' : ''}>
                          <?php echo $cnt ?><?php if ($cnt == 1) {
        echo 'st';
    } elseif ($cnt == 2) {
        echo 'nd';
    } elseif ($cnt == 3) {
        echo 'rd';
    } else {
        echo 'th';
}?>
                        </option>
                        <?php }?>
                    </select>
                </td>
                <td class="p-2">
                    <input type="text" name="prevTrainingFromDt[${id}]" class="form-control text-center datepicker" value="${prevHonorariumTrainings[rowId]?.training_from ?? ''}" required />
                </td>
                <td class="p-2">
                    <input type="text" name="prevTrainingToDt[${id}]" class="form-control text-center datepicker" value="${prevHonorariumTrainings[rowId]?.training_to ?? ''}" required />
                </td>
                <td class="p-2">
                    <select name="prevTrainingDepartment[${id}]" class="form-select" required>
                        <option value="" disabled selected>Select Department</option>
                        <?php foreach ($specialities as $speciality) {?>
                        <option value="<?php echo $speciality['speciality_id']; ?>" ${prevHonorariumTrainings[rowId]?.speciality_id ==<?php echo $speciality['speciality_id']; ?> ? 'selected' : ''}>
                          <?php echo $speciality['name']; ?>
                        </option>
                        <?php }?>
                    </select>
                </td>
                <td class="p-2">
                    <select name="prevTrainingInstitute[${id}]" class="form-select" required>
                        <option value="" disabled selected>Select Institute</option>
                        <?php foreach ($prevTrainingInstitutes as $prevTrainingInstitute) {?>
                        <option value="<?php echo $prevTrainingInstitute['institute_id']; ?>" ${prevHonorariumTrainings[rowId]?.training_institute_id ==<?php echo $prevTrainingInstitute['institute_id']; ?> ? 'selected' : ''}><?php echo $prevTrainingInstitute['name']; ?></option>
                        <?php }?>
                    </select>
                </td>
                <td class="p-2">
                    <select name="prevTrainingCategory[${id}]" class="form-select" required>
                        <option value="" disabled selected>Select Training Category</option>
                        <?php foreach ($trainingCategories as $category) {?>
                        <option value="<?php echo $category['id']; ?>" ${prevHonorariumTrainings[rowId]?.training_category_id ==<?php echo $category['id']; ?> ? 'selected' : ''}><?php echo $category['training_category_title']; ?></option>
                        <?php }?>
                    </select>
                </td>
                <td class="p-2 d-flex justify-content-center">
                    <div class="form-check form-check-inline text-center">
                        <input type="checkbox" name="prevTrainingHonorariumTaken[${id}]" class="form-check-input" ${prevHonorariumTrainings[rowId]?.honorarium_taken == 1 ? 'checked' : ''} />
                        <label class="form-check-label">Yes</label>
                    </div>
                </td>
            </tr>`;
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


// --- Preview & Submission Logic ---
let collectedData = {};

/**
 * Helper to get file names for preview display.
 */
function getFileNamesForPreview(id, isMultiple = false) {
  const input = document.getElementById(id);
  if (!input || input.files.length === 0) {
    return 'No file selected';
  }
  if (isMultiple) {
    const fileNames = Array.from(input.files).map(f => f.name);
    return `${input.files.length} file(s) uploaded: ${fileNames.join(', ')}`;
  }
  return input.files[0].name;
}

/**
 * Step 1: Validates the form and transitions to the preview page.
 */
handlePreview = function() {

  const form = document.getElementById('honorariumForm');

  if (!form.checkValidity()) {
    form.classList.add('was-validated');
    return;
  }

  // 1. Collect all non-file form data
  const formData = new FormData(form);
  const data = {};
  // A. Iterate over all form elements explicitly to handle checkboxes
  const formElements = form.elements;

  for (let i = 0; i < formElements.length; i++) {
    const element = formElements[i];
    if (element.type === 'checkbox') {
      // **CRITICAL CHANGE HERE:**
      // Manually set the value for the checkbox.
      // We can use a boolean or a specific string value ('true'/'false').
      data[element.name] = element.checked; // Stores true or false
      // If you prefer string values: data[element.name] = element.checked ? 'accepted' : 'not_accepted';

    } else if (element.type === 'radio') {
      // FormData handles checked radio buttons correctly, but we need to ensure we only capture the checked one in our manual loop
      if (element.checked) {
        data[element.name] = element.value;
      }

    }
  }

  formData.forEach((value, key) => {
    // Only store non-file values initially. We process files separately below.
    if (document.getElementById(key) && document.getElementById(key).type !== 'file') {
      data[key] = value;
    } else if (!document.getElementById(key)) {
      // This handles unchecked radio buttons which might not appear in FormData
      data[key] = value;
    }
  });

  // 2. Collect dynamic training data
  const dynamicRowsData = [];
  const dynamicRows = document.querySelectorAll('#dynamicTrainingRows tr');

  if (dynamicRows.length > 0) {
    dynamicRows.forEach(row => {
      const id = row.getAttribute('data-row-id');
      const rowData = {
        slot: form.querySelector(`[name="prevTrainingSlot[${id}]"]`).value,
        fromDate: form.querySelector(`[name="prevTrainingFromDt[${id}]"]`).value,
        toDate: form.querySelector(`[name="prevTrainingToDt[${id}]"]`).value,
        subject: form.querySelector(`[name="prevTrainingDepartment[${id}]"]`).value,
        institute: form.querySelector(`[name="prevTrainingInstitute[${id}]"]`).value,
        category: form.querySelector(`[name="prevTrainingCategory[${id}]"]`).value,
        honorariumTaken: form.querySelector(`[name="prevTrainingHonorariumTaken[${id}]"]`) ? form
          .querySelector(
            `[name="prevTrainingHonorariumTaken[${id}]"]`).checked : false // Check if element exists
      };

      dynamicRowsData.push(rowData);
    });

    data.previousTrainingDetails = dynamicRowsData;
  }

  // 3. Collect File Upload Information (names only for preview)
  data.enclosure1Name = getFileNamesForPreview('enclosure1');
  data.enclosure2Name = getFileNamesForPreview('enclosure2');
  data.enclosure3Name = getFileNamesForPreview('enclosure3');
  data.enclosure4Name = getFileNamesForPreview('enclosure4');
  data.enclosure5Name = getFileNamesForPreview('enclosure5', true); // NID is multiple

  collectedData = data; // Store data globally

  // 4. Render and show preview
  renderPreview(data);

  //alert(JSON.stringify(data)); // For debugging purposes
  document.getElementById('formContent').style.display = 'none';
  document.getElementById('previewContent').style.display = 'block';
}

/**
 * Populates the preview content with collected data.
 */
function renderPreview(data) {

  //console.log('Rendering preview with data:', data);

  const previewDiv = document.getElementById('previewData');
  let html = '';

  <?php $instituteList = array_column($trainingInstitutes, 'name', 'institute_id'); ?>
  const instituteList = <?=json_encode($instituteList);?>;

  <?php $deptList = array_column($departments, 'name', 'speciality_id'); ?>
  const deptList = <?=json_encode($deptList);?>;

  <?php $slotList = array_column($slots, 'slot_name', 'id'); ?>
  const slotList = <?=json_encode($slotList);?>;

  <?php $prevTrainingInstituteList = array_column($prevTrainingInstitutes, 'name', 'institute_id'); ?>
  const prevTrainingInstituteList = <?=json_encode($prevTrainingInstituteList);?>;

  <?php $prevTrainingCategoryList = array_column($trainingCategories, 'training_category_title', 'id'); ?>
  const prevTrainingCategoryList = <?=json_encode($prevTrainingCategoryList);?>;

  <?php $bankList = array_column($banks, 'bank_name', 'id'); ?>
  const bankList = <?=json_encode($bankList);?>;

  data.honorariumPosition = data.honorariumPosition ? data.honorariumPosition :
    <?=esc($honorarium->maxHonorariumCnt + 1)?>;


  data.branchName = data.branchName ? data.branchName : '<?=esc($applicantInfo['branch_name'])?>';
  data.accountNumber = data.accountNumber ? data.accountNumber : '<?=esc($applicantInfo['account_no'])?>';
  data.routingNumber = data.routingNumber ? data.routingNumber : '<?=esc($applicantInfo['routing_number'])?>';


  html += '<dl class="row">';
  html +=
    `<dt class="col-sm-5 preview-label">BMDC Reg. No.:</dt><dd class="col-sm-7 preview-value"><?=esc($applicantInfo['bmdc_reg_no'])?></dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">BMDC Validity:</dt><dd class="col-sm-7 preview-value">${data.bmdcValidity}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">Training Type:</dt><dd class="col-sm-7 preview-value">${data.trainingType}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">Have you seat for Mid-Term Exam:</dt><dd class="col-sm-7 preview-value">${data.midTermAppeared ? 'Yes' : 'No'}</dd>`;
  html += '</dl>';

  // --- General Information Preview (Section A) ---
  html += '<h5 class="text-primary mt-3">A) General Information</h5>';
  html += '<dl class="row">';
  html +=
    `<dt class="col-sm-5 preview-label">1) Name of the Trainee (In capital letters as per NID card):</dt><dd class="col-sm-7 preview-value"><?=esc($applicantInfo['name'])?></dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">2) Specialty:</dt><dd class="col-sm-7 preview-value"><?=esc($basicInfo['subject_name'])?></dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">3) FCPS Part-I Passed:</dt><dd class="col-sm-7 preview-value"><?=esc($basicInfo['fcps_part_one_session'])?> <?=esc($basicInfo['fcps_part_one_year'])?></dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">4)  BCPS Reg. No. (10 Digit after passing FCPS Part-I):</dt><dd class="col-sm-7 preview-value"><?=esc($basicInfo['reg_no'])?></dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">5) National Identity Card No.:</dt><dd class="col-sm-7 preview-value">${data.nidNo || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">6) Date of Birth:</dt><dd class="col-sm-7 preview-value">${data.dob || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">7) Gender:</dt><dd class="col-sm-7 preview-value">${data.gender || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">8) Mobile Number (Personal):</dt><dd class="col-sm-7 preview-value">${data.mobileNo || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">9) Email:</dt><dd class="col-sm-7 preview-value">${data.email || 'N/A'}</dd>`;
  html += '</dl>';

  // --- Training Information Preview (Section B) ---
  html += '<h5 class="text-primary mt-4">B) Applicant\'s Training Information</h5>';
  html += '<dl class="row">';
  html +=
    `<dt class="col-sm-5 preview-label">10) Institute Name:</dt><dd class="col-sm-7 preview-value">${instituteList[data.currentTrainingInstitute]}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">11) Department:</dt><dd class="col-sm-7 preview-value">${deptList[data.currentDepartment]}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">12) Period of Training:</dt><dd class="col-sm-7 preview-value">${slotList[data.honorariumPeriod]}, ${data.honorariumYear}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">13) Total Previous Training (Months):</dt><dd class="col-sm-7 preview-value">${data.coursePeriod}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">14) Applying for Honorarium:</dt><dd class="col-sm-7 preview-value">${data.honorariumPosition} (st/nd/rd/th)</dd>`;
  html += '</dl>';

  // --- Dynamic Previous Training Details Preview ---
  if (data.previousTrainingDetails && data.previousTrainingDetails.length > 0) {
    html += '<h6 class="text-muted fw-bold mt-2">Previous Training Details (Detailed)</h6>';
    html += '<div class="table-responsive">';
    html += '<table class="table table-sm table-bordered table-striped">';
    html +=
      '<thead class="table-info"><tr><th>Slot</th><th>From</th><th>To</th><th>Subject</th><th>Institute</th><th>Training Category</th><th>Honorarium Taken?</th></tr></thead>';
    html += '<tbody>';
    data.previousTrainingDetails.forEach(row => {
      const honorariumStatus = row.honorariumTaken ? '<i class="fas fa-check-circle text-success"></i> Yes' :
        '<i class="fas fa-times-circle text-danger"></i> No';
      html += `<tr>
                    <td>${row.slot}</td>
                    <td>${row.fromDate}</td>
                    <td>${row.toDate}</td>
                    <td>${deptList[row.subject]}</td>
                    <td>${prevTrainingInstituteList[row.institute]}</td>
                    <td>${prevTrainingCategoryList[row.category]}</td>
                    <td class="text-center">${honorariumStatus}</td>
                </tr>`;
    });
    html += '</tbody></table></div>';
  }

  if (data.midTermAppeared) {
    html += '<h6 class="text-muted fw-bold mt-2">Mid-Term Exam Information</h6>';
    html += '<dl class="row">';
    html +=
      `<dt class="col-sm-5 preview-label">Session:</dt><dd class="col-sm-7 preview-value">${data.midTermExamSession || 'N/A' }</dd>`;
    html +=
      `<dt class="col-sm-5 preview-label">Year:</dt><dd class="col-sm-7 preview-value">${data.midTermExamYear || 'N/A'}</dd>`;
    html +=
      `<dt class="col-sm-5 preview-label">Result:</dt><dd class="col-sm-7 preview-value">${data.midTermExamResult || 'N/A'}</dd>`;
    html +=
      `<dt class="col-sm-5 preview-label">Roll No.:</dt><dd class="col-sm-7 preview-value">${data.midTermExamRollNo || 'N/A'}</dd>`;
    html += '</dl>';
  }

  // --- Bank Information Preview (Section C) ---
  html += '<h5 class="text-primary mt-4">C) Applicants Personal Bank Information</h5>';
  html += '<dl class="row">';
  html +=
    `<dt class="col-sm-5 preview-label">15) Name (Online & Personal):</dt><dd class="col-sm-7 preview-value"><?=esc($applicantInfo['name'])?></dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">16) Name of the Bank:</dt><dd class="col-sm-7 preview-value">${bankList[data.bankName]? bankList[data.bankName]: '<?=esc($applicantInfo['bank_name'])?>'}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">17) Name of the Branch:</dt><dd class="col-sm-7 preview-value">${data.branchName}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">18) Account Number:</dt><dd class="col-sm-7 preview-value">${data.accountNumber}</dd>`;
  html +=
    `<dt class="col-sm-5 preview-label">19) Routing Number:</dt><dd class="col-sm-7 preview-value">${data.routingNumber}</dd>`;
  html += '</dl>';

  // --- Enclosures Preview (Section D) ---
  html += '<h5 class="text-primary mt-4">D) Enclosures (Uploaded Documents)</h5>';
  html += '<dl class="row">';
  html +=
    `<dt class="col-sm-8 preview-label">1) Provisional training certificate:</dt><dd class="col-sm-4 preview-value text-break">${data.enclosure1Name || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-8 preview-label">2) A page of the Bank Cheque book:</dt><dd class="col-sm-4 preview-value text-break">${data.enclosure2Name || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-8 preview-label">3) Recent Passport size Photograph:</dt><dd class="col-sm-4 preview-value text-break">${data.enclosure3Name || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-8 preview-label">4) Applicant’s Signature:</dt><dd class="col-sm-4 preview-value text-break">${data.enclosure4Name || 'N/A'}</dd>`;
  html +=
    `<dt class="col-sm-8 preview-label">5) National Identity Card (NID/Smart Card):</dt><dd class="col-sm-4 preview-value text-break">${data.enclosure5Name || 'N/A'}</dd>`;
  html += '</dl>';

  previewDiv.innerHTML = html;
}

/**
 * Step 2: Hides the preview and shows the form content again.
 */
window.editForm = function() {
  document.getElementById('formContent').style.display = 'block';
  document.getElementById('previewContent').style.display = 'none';
  document.getElementById('submissionMessage').style.display = 'none';
  document.getElementById('honorariumForm').classList.remove('was-validated');
}

/**
 * Step 3: Executes the final submission logic.
 */
window.confirmSubmission = function() {
  //console.log(JSON.stringify(collectedData, null, 2));

  const messageDiv = document.getElementById('submissionMessage');

  // Display a loading message while AJAX is running
  messageDiv.innerHTML =
    '<div class="alert alert-info mt-4" role="alert"><i class="fas fa-spinner fa-spin me-2"></i> Submitting & uploading files...</div>';
  messageDiv.style.display = 'block';

  const formData = new FormData();

  formData.append('collectedDataJson', JSON.stringify(collectedData));

  const file1Input = document.getElementById('enclosure1');
  if (file1Input && file1Input.files.length > 0) {
    formData.append('enclosure1', file1Input.files[0]);
  }

  const file2Input = document.getElementById('enclosure2');
  if (file2Input && file2Input.files.length > 0) {
    formData.append('enclosure2', file2Input.files[0]);
  }

  const file3Input = document.getElementById('enclosure3');
  if (file2Input && file2Input.files.length > 0) {
    formData.append('enclosure3', file2Input.files[0]);
  }

  const file4Input = document.getElementById('enclosure4');
  if (file2Input && file2Input.files.length > 0) {
    formData.append('enclosure4', file2Input.files[0]);
  }

  const file5Input = document.getElementById('enclosure5');
  if (file2Input && file2Input.files.length > 0) {
    formData.append('enclosure5', file2Input.files[0]);
  }

  // AJAX request
  $.ajax({
    url: '<?=base_url('trainings/honorarium-bill-application')?>',
    type: 'POST',
    data: formData, // Send the FormData object
    dataType: 'json',
    // CRITICAL FOR FILE UPLOADS: Prevent jQuery from processing the data and setting the content type
    processData: false,
    contentType: false,
    success: function(response) {
      if (response.status == 'success') {
        Swal.fire({
          title: "Success!",
          text: response.message,
          icon: "success"
        });

        // Display success message
        messageDiv.innerHTML =
          '<div class="alert alert-success mt-4" role="alert"><i class="fas fa-check-circle me-2"></i> ' +
          response.message +
          'To download .pdf click <a href="<?=base_url('trainings/honorarium-bill-application')?>">Here</a></div>';

        // Disable buttons after final submission
        document.querySelector('#previewContent .btn-success').disabled = true;
        document.querySelector('#previewContent .btn-outline-secondary').disabled = true;
      } else {
        Swal.fire({
          title: "Error!",
          text: response.message,
          icon: "error"
        });

        // Display error message
        messageDiv.innerHTML =
          '<div class="alert alert-danger mt-4" role="alert"><i class="fas fa-times-circle me-2"></i> **Submission Failed!** ' +
          response.message + '</div>';

      }
    },
    error: function(xhr, status, error) {
      //console.error('Error:', error);
      // Display general AJAX error
      messageDiv.innerHTML =
        '<div class="alert alert-danger mt-4" role="alert"><i class="fas fa-times-circle me-2"></i> **Submission Failed!** Server or network error.</div>';

    }
  });
}
</script>
<?php $this->endSection()?>
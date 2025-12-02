<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info<?php $this->endSection()?>
<?php $this->section('main')?>
<?php $validation = \Config\Services::validation(); ?>
<?php $this->section('pageStyles')?>
<style>
.registration-card {
  border: none;
  border-radius: 1rem;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  padding: 20px;
}

.section-header {
  color: #1a4521;
  font-weight: 600;
  margin-top: 10px;
  margin-bottom: 10px;
}

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

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  border-radius: 0.5rem;
  padding: 10px 25px;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}

.form-select {
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
}

.training-row {
  padding: 20px;
  border: 1px solid #dee2e6;
  border-radius: 0.75rem;
  margin-bottom: 20px;
  background-color: #ffffff;
  position: relative;
}

.remove-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  z-index: 10;
}

.file-constraint {
  font-size: 0.85rem;
  color: #6c757d;
  margin-top: 5px;
}

.declaration-box {
  border: 1px solid #ffc107;
  /* Warning color border */
  border-radius: 0.75rem;
  padding: 20px;
  background-color: #fff3cd;
  /* Light warning background */
}

/* Styling for the tab bar navigation */
.nav-pills .nav-link {
  background-color: #e9ecef;
  color: #6c757d;
  border-radius: 0.75rem;
  font-weight: 500;
  margin: 3px;
  padding: 10px 10px;
  text-align: center;
  font-size: 1rem;
}

.nav-pills .nav-link.active {
  background-color: #007bff;
  color: white;
  font-weight: 600;
}

.nav-pills .nav-link.complete {
  background-color: #218838;
  /* Green for completed steps */
  color: white;
}

/* Ensure tab panes start hidden but the first one is visible */
.tab-content .tab-pane {
  display: none;
}

.tab-content .tab-pane.active {
  display: block;
}
</style>
<?php $this->endSection()?>

<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h3 class="main-title text-center">APPLICATION FORM</h3>
    <p class="sub-title text-center">(Training allowances for the FCPS Part-II honorary trainees)</p>

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

    <?php if (session('errors')): ?>
    <div class="alert alert-danger">
      <?php foreach (session('errors') as $err): ?>
      <div class="text-danger"><?=esc($err)?></div>
      <?php endforeach?>
    </div>
    <?php endif; ?>

    <?php
    if ($response['isError']): ?>
    <div class="alert alert-danger fw-bold text-center" role="alert">
      <span class="text-danger"><?=esc($response['message'])?></span>
    </div>
    <?php else: ?>
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card registration-card">
          <h6 class="text-center fw-bold p-2 text-warning"><i class='fas fa-exclamation-triangle'></i> Auto fill
            inforamation can't be changed. Any changes reqired,
            please
            contact
            with BCPS. Please fill up the
            form below and submit.</h6>
          <form action="<?=base_url('trainings/training-application')?>" method="post" id="registrationForm"
            enctype="multipart/form-data" novalidate>
            <?=csrf_field()?>

            <!-- ========================================================= -->
            <!-- TAB NAVIGATION BAR (9 Steps) -->
            <!-- ========================================================= -->
            <ul class="nav nav-pills nav-justified mb-4 flex-column flex-md-row" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill"
                  data-bs-target="#tab-step-1" type="button" role="tab" aria-controls="tab-step-1"
                  aria-selected="true">1. General Info</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-2" type="button" role="tab" aria-controls="tab-step-2"
                  aria-selected="false">2. FCPS Part-I</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-3" type="button" role="tab" aria-controls="tab-step-3"
                  aria-selected="false">3. Qualification</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-4" type="button" role="tab" aria-controls="tab-step-4"
                  aria-selected="false">4. Current Training</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-5" type="button" role="tab" aria-controls="tab-step-5"
                  aria-selected="false">5. Previous FCPS</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-6" type="button" role="tab" aria-controls="tab-step-6"
                  aria-selected="false">6. Future Choices</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-7" type="button" role="tab" aria-controls="tab-step-7"
                  aria-selected="false">7. Bank Info</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-8" type="button" role="tab" aria-controls="tab-step-8"
                  aria-selected="false">8. Documents</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                  data-bs-target="#tab-step-9" type="button" role="tab" aria-controls="tab-step-9"
                  aria-selected="false">9. Declaration</button></li>
            </ul>

            <!-- ========================================================= -->
            <!-- TAB CONTENT -->
            <!-- ========================================================= -->
            <div class="tab-content" id="pills-tabContent">

              <!-- STEP 1: General Information -->
              <div class="tab-pane fade show active" id="tab-step-1" role="tabpanel" aria-labelledby="pills-step-1-tab">
                <h4 class="section-header text-center pb-2 fw-bold">General Information</h4>
                <div class="row g-3 mb-4">

                  <div class="col-md-6">
                    <label for="applicantName" class="form-label">Applicant’s Name (Block Letters)</label>
                    <input type="text" class="form-control text-uppercase" id="applicantName"
                      value="<?=esc($generalInfo['applicant_name'])?>" placeholder="E.g., DR. MUHAMMAD ALI" disabled>
                  </div>

                  <div class="col-md-6">
                    <label for="fatherSpouseName" class="form-label">Father’s/Spouse Name (Block Letters)</label>
                    <input type="text" class="form-control text-uppercase" id="fatherSpouseName"
                      value="<?=esc($generalInfo['father_name'])?>" disabled>
                  </div>

                  <div class="col-md-6">
                    <label for="motherName" class="form-label">Mother’s Name (Block Letters)</label>
                    <input type="text" class="form-control text-uppercase" id="motherName"
                      value="<?=esc($generalInfo['mother_name'])?>" disabled>
                  </div>

                  <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="text" class="form-control <?=session('errors.dob') ? 'border-danger' : ''?>" id="dob"
                      name="dob" value="<?=old('dob', $generalInfo['date_of_birth'] ?? '')?>">
                  </div>

                  <div class="col-md-6">
                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control <?=session('errors.nationality') ? 'border-danger' : ''?>"
                      id="nationality" name="nationality" value="<?=old('dob', $generalInfo['nationality'] ?? '')?>">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <div class="d-flex align-items-center">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input <?=session('errors.gender') ? 'border-danger' : ''?>"
                          type="radio" name="gender" id="genderMale" value="Male"
                          <?=old('gender') == 'Male' ? 'checked' : ''?> required>
                        <label class="form-check-label" for="genderMale">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female"
                          <?=old('gender') == 'Female' ? 'checked' : ''?> required>
                        <label class="form-check-label" for="genderFemale">Female</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="religion" class="form-label">Religion</label>
                    <select id="religion" name="religion"
                      class="form-select <?=session('errors.religion') ? 'border-danger' : ''?>" required>
                      <option value="">Select Religion</option>
                      <option value="Islam" <?=old('religion') == 'Islam' ? 'selected' : ''?>>Islam</option>
                      <option value="Hinduism" <?=old('religion') == 'Hinduism' ? 'selected' : ''?>>Hinduism</option>
                      <option value="Buddhism" <?=old('religion') == 'Buddhism' ? 'selected' : ''?>>Buddhism</option>
                      <option value="Christianity" <?=old('religion') == 'Christianity' ? 'selected' : ''?>>Christianity
                      </option>
                      <option value="Other" <?=old('religion') == 'Other' ? 'selected' : ''?>>Other</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="nationalID" class="form-label">National ID No</label>
                    <input type="text" class="form-control <?=session('errors.nationalID') ? 'border-danger' : ''?>"
                      id="nationalID" name="nationalID" value="<?=old('dob', $generalInfo['national_id'] ?? '')?>"
                      placeholder="e.g., 19901234567890123" required>
                  </div>
                  <div class="col-md-6">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="tel" class="form-control <?=$validation->hasError('mobile') ? 'border-danger' : ''?>"
                      id="mobile" name="mobile" value="<?=old('mobile', $generalInfo['cell'] ?? '')?>"
                      placeholder="e.g., 01XXXXXXXXX" pattern="[0-9]{11}" required>
                  </div>

                  <div class="col-md-6">
                    <label for="residenceTel" class="form-label">Tel (Res)</label>
                    <input type="tel" class="form-control" id="residenceTel" name="residenceTel"
                      value="<?=esc($generalInfo['contact_res'])?>" placeholder="Optional landline number">
                  </div>

                  <div class="col-md-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control <?=$validation->hasError('email') ? 'border-danger' : ''?>"
                      id="email" name="email" value="<?=esc($generalInfo['email'])?>" placeholder="you@example.com"
                      required>
                  </div>

                  <div class="col-md-6">
                    <label for="communicationAddress" class="form-label">Address of Communication</label>
                    <textarea class="form-control" id="communicationAddress" name="communicationAddress" rows="3"
                      required><?=esc($generalInfo['mailing_address'])?></textarea>
                  </div>

                  <div class="col-md-6">
                    <label for="permanentAddress" class="form-label">Permanent Address</label>
                    <textarea class="form-control" id="permanentAddress" name="permanentAddress"
                      rows="3"><?=esc($generalInfo['permanent_address'])?></textarea>
                  </div>

                </div>
                <div class="d-flex justify-content-end mt-4">
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 2: FCPS Part-I Examination Data -->
              <div class="tab-pane fade" id="tab-step-2" role="tabpanel" aria-labelledby="pills-step-2-tab">
                <h4 class="section-header text-primary text-center">FCPS Part-I Examination Data</h4>
                <div class="row g-3 mb-4">

                  <div class="col-md-6">
                    <label for="fcpsSpecialty" class="form-label">Specialty</label>
                    <select id="fcpsSpecialty" class="form-select" disabled>
                      <option selected disabled value="">Select a Subject...</option>
                      <?php foreach ($specialities as $subject): ?>
                      <option value="<?=esc($subject['speciality_id'])?>"
                        <?=($subject['speciality_id'] === $generalInfo['subject_id']) ? 'selected' : ''?>>
                        <?=esc($subject['name'])?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="fcpsPassYear" class="form-label">Year of Passing</label>
                    <select id="fcpsPassYear" name="fcpsPassYear" class="form-select" disabled>
                      <option value="" selected disabled>
                        Select Year
                      </option>
                      <?php
                          $current_year = date('Y');
                      for ($year = 1990; $year <= $current_year; $year++) {?>
                      <option value="<?=esc($year)?>"
                        <?=($year == $generalInfo['fcps_part_one_year']) ? 'selected' : ''?>>
                        <?=esc($year)?>
                      </option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="fcpsSession" class="form-label">Session</label>
                    <select id="fcpsSession" class="form-select" disabled>
                      <option value="" disabled selected>Select Session</option>
                      <option value="January"
                        <?=('January' === $generalInfo['fcps_part_one_session']) ? 'selected' : ''?>>January
                      </option>
                      <option value="July" <?=('July' === $generalInfo['fcps_part_one_session']) ? 'selected' : ''?>>
                        July</option>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="fcpsRollNo" class="form-label">Roll No.</label>
                    <input type="text" class="form-control" id="fcpsRollNo" name="fcpsRollNo"
                      placeholder="e.g., 123456">
                  </div>

                  <div class="col-md-12 border-top pt-3 mt-3">
                    <label class="form-label mb-2 fw-bold">Are you selected or continuing the residency training/diploma
                      course/ Govt. service/Private service?</label>
                    <div class="d-flex align-items-center">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="residencyStatus" id="residencyYes" value="1"
                          onclick="toggleResidencyDates(true)" required>
                        <label class="form-check-label" for="residencyYes">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="residencyStatus" id="residencyNo" value="0"
                          onclick="toggleResidencyDates(false)" checked required>
                        <label class="form-check-label" for="residencyNo">No</label>
                      </div>
                    </div>
                  </div>

                  <!-- Conditional Dates Container -->
                  <div id="residencyDatesContainer" class="col-md-12 row mx-3 p-3 border rounded"
                    style="display: none;">
                    <div class="col-md-6">
                      <label for="residencyStartDate" class="form-label">Start Date</label>
                      <input type="text" class="form-control" name="residencyStartDate" id="residencyStartDate"
                        required>
                    </div>
                    <div class="col-md-6">
                      <label for="residencyEndDate" class="form-label">End Date</label>
                      <input type="text" class="form-control" name="residencyEndDate" id="residencyEndDate" required>
                    </div>
                  </div>

                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 3: MBBS/BDS Data (Shifted from old Step 2) -->
              <div class="tab-pane fade" id="tab-step-3" role="tabpanel" aria-labelledby="pills-step-3-tab">
                <h4 class="section-header text-primary text-center">MBBS/BDS Data (Qualification)</h4>
                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label for="qualificationYear" class="form-label">Year of Qualification</label>
                    <select id="qualificationYear" name="qualificationYear" class="form-select" required>
                      <option value="" disabled selected>Select Year</option>
                      <?php
                          $current_year = date('Y');
                      for ($year = 1990; $year <= $current_year; $year++) {?>
                      <option value="<?=esc($year)?>" <?=($year == $generalInfo['mbbs_year']) ? 'selected' : ''?>>
                        <?=esc($year)?>
                      </option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="qualificationInstitute" class="form-label">Institute of Qualification</label>
                    <select id="qualificationInstitute" name="qualificationInstitute" class="form-select" required>
                      <option value="" disabled selected>Select Institute</option>
                      <?php foreach ($mbbsInstitutes as $institute): ?>
                      <option value="<?=esc($institute['institute_id'])?>"
                        <?=($institute['institute_id'] === $generalInfo['mbbs_institute_id']) ? 'selected' : ''?>>
                        <?=esc($institute['name'])?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="bmdcType" class="form-label">BMDC Registration Type</label>
                    <select id="bmdcType" name="bmdcType" class="form-select">
                      <option value="" disabled selected>Select Session</option>
                      <option value="MBBS" <?=old('bmdcType') == 'MBBS' ? 'selected' : ''?>>
                        MBBS
                      </option>
                      <option value="BDS" <?=old('bmdcType') == 'BDS' ? 'selected' : ''?>>
                        BDS</option>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="bmdcRegNo" class="form-label">BMDC Registration Number (Number Only)</label>
                    <input type="number" class="form-control" id="bmdcRegNo" name="bmdcRegNo"
                      value="<?=old('bmdcRegNo')?>" placeholder="e.g., 12345">
                  </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 4: Current Training (Shifted from old Step 3) -->
              <div class="tab-pane fade" id="tab-step-4" role="tabpanel" aria-labelledby="pills-step-4-tab">
                <h4 class="section-header text-primary text-center">Current Training Details</h4>
                <div class="row g-3 mb-4">
                  <div class="col-md-12 mt-3 d-flex justify-content-center align-items-center">
                    <label class="form-label mb-2 fw-bold">Are you continuing the FCPS training?</label>
                    <div class="d-flex align-items-center">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="currentFCPSTrainingStatus"
                          id="currentFCPSTrainingStatusYes" value="1" onclick="toggleCurrentTraining(true)" required>
                        <label class="form-check-label" for="currentFCPSTrainingStatusYes">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="currentFCPSTrainingStatus"
                          id="currentFCPSTrainingStatusNo" value="0" onclick="toggleCurrentTraining(false)" checked
                          required>
                        <label class="form-check-label" for="currentFCPSTrainingStatusNo">No</label>
                      </div>
                    </div>
                  </div>
                  <!-- Conditional FCPS Training Container -->
                  <div id="currentFCPSTrainingContainer" class="col-md-12 row mx-3 p-3 border rounded g-3"
                    style="display: none;">
                    <div class="col-md-6">
                      <label for="currentInstitute" class="form-label">Name of the Current Institute</label>
                      <select id="currentInstitute" name="currentInstitute" class="form-select">
                        <option value="" disabled selected>Select Institute</option>
                        <?php foreach ($trainingInstitutes as $institute): ?>
                        <option value="<?=esc($institute['name'])?>">
                          <?=esc($institute['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label for="currentDepartment" class="form-label">Name of the Department</label>
                      <select id="currentDepartment" name="currentDepartment" class="form-select">
                        <option selected disabled value="">Select a Department...</option>
                        <?php foreach ($departments as $department): ?>
                        <option value="<?=esc($department['name'])?>">
                          <?=esc($department['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label for="supervisorName" class="form-label">Name of the Supervisor</label>
                      <input type="text" class="form-control" name="supervisorName" id="supervisorName"
                        placeholder="Dr. John Doe">
                    </div>

                    <div class="col-md-6">
                      <label for="supervisorDesignation" class="form-label">Supervisor's Designation</label>
                      <select id="supervisorDesignation" name="supervisorDesignation" class="form-select">
                        <option selected disabled value="">Select Designation</option>
                        <?php foreach ($designations as $designation): ?>
                        <option value="<?=esc($designation['designation'])?>">
                          <?=esc($designation['designation'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="startDate" class="form-label">Training Start Date</label>
                      <input type="text" class="form-control" name="startDate" id="startDate">
                    </div>

                    <div class="col-md-6">
                      <label for="endDate" class="form-label">Training End Date</label>
                      <input type="text" class="form-control" name="endDate" id="endDate">
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 5: Previous FCPS Training (Shifted from old Step 4) -->
              <div class="tab-pane fade" id="tab-step-5" role="tabpanel" aria-labelledby="pills-step-5-tab">
                <h4 class="section-header text-primary text-center">Previous FCPS Training Records</h4>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="hasPreviousTraining" id="hasPreviousTraining"
                    role="switch">
                  <label class="form-check-label fw-bold" for="hasPreviousTraining">
                    Have you obtained FCPS training before?
                  </label>
                </div>

                <!-- Container for dynamically added training records -->
                <div id="previousTrainingContainer" style="display: none;">
                  <p class="text-muted small mb-3">Please mention here previous completed training of every six month
                    duration (Date Format: YYYY-MM-DD).</p>

                  <button type="button" class="btn btn-outline-success btn-sm mb-4" id="addTrainingRowBtn">
                    <i class="fas fa-plus-circle me-2"></i>Add Training Record
                  </button>
                  <!-- Dynamic rows are added here by JS -->
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>

              </div>

              <!-- NEW STEP 6: Future Training Choices (Shifted from old Step 5) -->
              <div class="tab-pane fade" id="tab-step-6" role="tabpanel" aria-labelledby="pills-step-6-tab">
                <h4 class="section-header text-primary text-center">Future Fellowship Training Choices</h4>
                <p class="text-muted small mb-4 text-center">[Mention the name of the institutes with department
                  recognized by BCPS according to your choice where you want to obtain the fellowship training: (Please
                  schedule the rest of training Including FCPS course and excluding current duration)]</p>

                <!-- Choice 1 -->
                <div class="p-3 mb-4 border border-info rounded-3 bg-light">
                  <h6 class="mb-4 text-info">Choice #1 (Highest Priority)</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="futureInstitute1" class="form-label small">Name of the Institutes</label>
                      <select id="futureInstitute1" name="futureInstitute[]" class="form-select" required>
                        <option value="" disabled selected>Select Institute</option>
                        <?php foreach ($trainingInstitutes as $institute): ?>
                        <option value="<?=esc($institute['name'])?>">
                          <?=esc($institute['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="futureDepartment1" class="form-label small">Name of the Department</label>
                      <select id="futureDepartment1" name="futureDepartment[]" class="form-select" required>
                        <option selected disabled value="">Select a Department</option>
                        <?php foreach ($departments as $department): ?>
                        <option value="<?=esc($department['name'])?>">
                          <?=esc($department['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="futureStartDate1" class="form-label small">Start Date</label>
                      <input type="text" id="futureStartDate1" name="futureStartDate[]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                      <label for="futureEndDate1" class="form-label small">End Date</label>
                      <input type="text" id="futureEndDate1" name="futureEndDate[]" class="form-control" required>
                    </div>
                  </div>
                </div>

                <!-- Choice 2 -->
                <div class="p-3 mb-4 border border-secondary rounded-3 bg-light">
                  <h6 class="mb-4 text-secondary">Choice #2 (Medium Priority)</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="futureInstitute2" class="form-label small">Name of the Institutes</label>
                      <select id="futureInstitute2" name="futureInstitute[]" class="form-select" required>
                        <option value="" disabled selected>Select Institute</option>
                        <?php foreach ($trainingInstitutes as $institute): ?>
                        <option value="<?=esc($institute['name'])?>">
                          <?=esc($institute['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="futureDepartment2" class="form-label small">Name of the Department</label>
                      <select id="futureDepartment2" name="futureDepartment[]" class="form-select" required>
                        <option selected disabled value="">Select a Department</option>
                        <?php foreach ($departments as $department): ?>
                        <option value="<?=esc($department['name'])?>">
                          <?=esc($department['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="futureStartDate2" class="form-label small">Start Date</label>
                      <input type="text" id="futureStartDate2" name="futureStartDate[]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                      <label for="futureEndDate2" class="form-label small">End Date</label>
                      <input type="text" id="futureEndDate2" name="futureEndDate[]" class="form-control" required>
                    </div>
                  </div>
                </div>

                <!-- Choice 3 -->
                <div class="p-3 mb-4 border border-secondary rounded-3 bg-light">
                  <h6 class="mb-4 text-secondary">Choice #3 (Lowest Priority)</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="futureInstitute3" class="form-label small">Name of the Institutes</label>
                      <select id="futureInstitute3" name="futureInstitute[]" class="form-select" required>
                        <option value="" disabled selected>Select Institute</option>
                        <?php foreach ($trainingInstitutes as $institute): ?>
                        <option value="<?=esc($institute['name'])?>">
                          <?=esc($institute['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="futureDepartment3" class="form-label small">Name of the Department</label>
                      <select id="futureDepartment3" name="futureDepartment[]" class="form-select" required>
                        <option selected disabled value="">Select a Department</option>
                        <?php foreach ($departments as $department): ?>
                        <option value="<?=esc($department['name'])?>">
                          <?=esc($department['name'])?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="futureStartDate3" class="form-label small">Start Date</label>
                      <input type="text" id="futureStartDate3" name="futureStartDate[]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                      <label for="futureEndDate3" class="form-label small">End Date</label>
                      <input type="text" id="futureEndDate3" name="futureEndDate[]" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 7: Personal Bank Information (Shifted from old Step 6) -->
              <div class="tab-pane fade" id="tab-step-7" role="tabpanel" aria-labelledby="pills-step-7-tab">
                <h4 class="section-header text-primary text-center">Applicant's Personal Bank Information</h4>
                <p class="text-muted small mb-4 text-center">Provide your bank details for official transactions (e.g.,
                  honorarium, refunds).</p>
                <div class="row g-3 mb-4">

                  <div class="col-md-6">
                    <label for="bankName" class="form-label">Name of the Bank</label>
                    <select id="bankName" name="bankName" class="form-select" required>
                      <option value="" disabled selected>Select Bank</option>
                      <?php foreach ($banks as $bank): ?>
                      <option value="<?=esc($bank['id'])?>">
                        <?=esc($bank['bank_name'])?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="bankBranch" class="form-label">Name of the Branch</label>
                    <input type="text" class="form-control" id="bankBranch" name="bankBranch"
                      placeholder="e.g., Dhaka Central Branch" required>
                  </div>

                  <div class="col-md-6">
                    <label for="accountNumber" class="form-label">Account Number (13 digits or above)</label>
                    <input type="text" pattern="[0-9]{13,}" class="form-control" id="accountNumber" name="accountNumber"
                      placeholder="Minimum 13 digits, numbers only" required>
                  </div>

                  <div class="col-md-6">
                    <label for="routingNumber" class="form-label">Routing Number</label>
                    <input type="text" class="form-control" id="routingNumber" name="routingNumber"
                      placeholder="e.g., 090261019" required>
                  </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 8: Required Document Attachments (Shifted from old Step 7) -->
              <div class="tab-pane fade" id="tab-step-8" role="tabpanel" aria-labelledby="pills-step-8-tab">
                <h4 class="section-header text-primary text-center">Required Document Attachments</h4>
                <p class="text-muted small mb-4 text-center">(Please upload copies of the required documents. File size
                  must be below 300 kb for all image files.)</p>
                <div class="row g-4">
                  <div class="col-md-6">
                    <label for="signatureFile" class="form-label">1. Applicant’s Signature with Date (File)</label>
                    <input type="file" class="form-control" id="signatureFile" name="signatureFile" accept="image/*"
                      required>
                    <div class="file-constraint">Resolution: **300x80 pixels**, Size: **&lt;300 kb** (Image file)</div>
                  </div>

                  <div class="col-md-6">
                    <label for="photoFile" class="form-label">2. Recent Passport Size Color Photograph</label>
                    <input type="file" class="form-control" id="photoFile" name="photoFile" accept="image/*" required>
                    <div class="file-constraint">Resolution: **300x300 pixels**, Size: **&lt;300 kb** (Image file)</div>
                  </div>

                  <div class="col-md-6">
                    <label for="fcpsPartIFile" class="form-label">3. Congratulation letter of FCPS Part-I/ FCPS Part-I
                      passed document:</label>
                    <input type="file" class="form-control" id="fcpsPartIFile" name="fcpsPartIFile"
                      accept=".pdf,image/*" required>
                  </div>

                  <div class="col-md-6">
                    <label for="mbbsCertFile" class="form-label">4. Certificate of MBBS/BDS</label>
                    <input type="file" class="form-control" id="mbbsCertFile" name="mbbsCertFile" accept=".pdf,image/*"
                      required>
                  </div>

                  <div class="col-md-6">
                    <label for="bmdcRegCertFile" class="form-label">5. Permanent registration certificate of
                      BMDC</label>
                    <input type="file" class="form-control" id="bmdcRegCertFile" name="bmdcRegCertFile"
                      accept=".pdf,image/*" required>
                  </div>

                  <div class="col-md-6">
                    <label for="trainingCertFile" class="form-label">6. Training Certificates (if applicable)</label>
                    <input type="file" class="form-control" id="trainingCertFile" name="trainingCertFile"
                      accept=".pdf,image/*">
                  </div>

                  <div class="col-md-6">
                    <label for="chequeBookFile" class="form-label">7. A page of the Bank Cheque book of the
                      applicant</label>
                    <input type="file" class="form-control" id="chequeBookFile" name="chequeBookFile"
                      accept=".pdf,image/*" required>
                  </div>

                  <div class="col-md-6">
                    <label for="nidFile" class="form-label">8. National ID Card</label>
                    <input type="file" class="form-control" id="nidFile" name="nidFile" accept=".pdf,image/*" required>
                  </div>

                  <div class="col-md-6">
                    <label for="joiningLetterFile" class="form-label">9. Joining Letter/Testimonial</label>
                    <input type="file" class="form-control" id="joiningLetterFile" name="joiningLetterFile"
                      accept=".pdf,image/*" required>
                  </div>

                  <div class="col-md-6">
                    <label for="otherDocsFile" class="form-label">10. Other Necessary Documents</label>
                    <input type="file" class="form-control" id="otherDocsFile" name="otherDocsFile"
                      accept=".pdf,image/*" multiple>
                    <div class="file-constraint">You may upload multiple other documents.</div>
                  </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="button" class="btn btn-primary next-tab">Next Step <i
                      class="fas fa-arrow-right ms-2"></i></button>
                </div>
              </div>

              <!-- NEW STEP 9: Applicant's Declaration (Undertaking) (Shifted from old Step 8) -->
              <div class="tab-pane fade" id="tab-step-9" role="tabpanel" aria-labelledby="pills-step-9-tab">
                <h4 class="section-header text-primary text-center">Applicant's Declaration (Undertaking)</h4>

                <div class="declaration-box mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="undertakingCheckbox" required>
                    <label class="form-check-label text-dark fw-semibold" for="undertakingCheckbox">
                      Agree
                    </label>
                  </div>
                  <div>** I <span class="text-decoration-underline"><?=esc($generalInfo['applicant_name'])?></span>
                    declared that the
                    information given by
                    me
                    in this form is entirely true and authentic. The application may be cancelled if any information
                    mentioned above is found to be false or incomplete.**</div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between mt-5">
                  <button type="button" class="btn btn-outline-secondary prev-tab"><i
                      class="fas fa-arrow-left me-2"></i> Previous Step</button>
                  <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check-circle me-2"></i> Submit
                    Registration</button>
                </div>
              </div>

            </div> <!-- End Tab Content -->

          </form>
        </div>
      </div>
    </div>
    <?php endif; ?>
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

  $('#residencyStartDate').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#residencyEndDate').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#startDate').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#endDate').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#futureStartDate1').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#futureEndDate1').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#futureStartDate2').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#futureEndDate2').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#futureStartDate3').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });

  $('#futureEndDate3').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
  });
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

document.addEventListener('DOMContentLoaded', () => {
  const registrationForm = document.getElementById('registrationForm');
  // Select all tab panes, now 9
  const tabs = document.querySelectorAll('.tab-pane');
  const navPills = document.querySelectorAll('#pills-tab button');
  let currentStep = 0; // Starts at 0 (Tab 1)

  // Dynamic elements for Step 5 (Previous FCPS)
  const hasPreviousTrainingSwitch = document.getElementById('hasPreviousTraining');
  const trainingContainer = document.getElementById('previousTrainingContainer');
  const addTrainingRowBtn = document.getElementById('addTrainingRowBtn');
  let rowCounter = 0;

  // General elements
  //const qualificationYearSelect = document.getElementById('qualificationYear');
  //const fcpsPassYearSelect = document.getElementById('fcpsPassYear');
  // The Applicant Name input from Step 1
  const applicantNameStep1 = document.getElementById('applicantName');
  // The span element in the Declaration tab
  const displayedApplicantName = document.getElementById('displayedApplicantName');

  // Conditional date elements for Step 2 (FCPS Part-I)
  const residencyDatesContainer = document.getElementById('residencyDatesContainer');
  const residencyStartDate = document.getElementById('residencyStartDate');
  const residencyEndDate = document.getElementById('residencyEndDate');

  // --- Utility Functions ---
  // Toggle visibility and required status of residency dates (Step 2)
  window.toggleResidencyDates = function(isVisible) {
    if (isVisible) {
      residencyDatesContainer.style.display = 'flex';
      residencyStartDate.required = true;
      residencyEndDate.required = true;
    } else {
      residencyDatesContainer.style.display = 'none';
      residencyStartDate.required = false;
      residencyEndDate.required = false;
      // Clear values when hiding
      residencyStartDate.value = '';
      residencyEndDate.value = '';
    }
  }

  const currentFCPSTrainingContainer = document.getElementById('currentFCPSTrainingContainer');
  // Toggle visibility and required status of residency dates (Step 2)
  window.toggleCurrentTraining = function(isVisible) {
    if (isVisible) {
      currentFCPSTrainingContainer.style.display = 'flex';
      document.getElementById('currentInstitute').required = true;
      document.getElementById('currentDepartment').required = true;
      document.getElementById('supervisorName').required = true;
      document.getElementById('supervisorDesignation').required = true;
      document.getElementById('startDate').required = true;
      document.getElementById('endDate').required = true;
    } else {
      currentFCPSTrainingContainer.style.display = 'none';
      document.getElementById('currentInstitute').required = false;
      document.getElementById('currentDepartment').required = false;
      document.getElementById('supervisorName').required = false;
      document.getElementById('supervisorDesignation').required = false;
      document.getElementById('startDate').required = false;
      document.getElementById('endDate').required = false;
      // Clear values when hiding
      document.getElementById('currentInstitute').value = '';
      document.getElementById('currentDepartment').value = '';
      document.getElementById('supervisorName').value = '';
      document.getElementById('supervisorDesignation').value = '';
      document.getElementById('startDate').value = '';
      document.getElementById('endDate').value = '';
    }
  }


  function generateYearOptions(selectElement) {
    const currentYear = new Date().getFullYear();
    let options = '<option value="" disabled selected>Select Year</option>';
    for (let i = 0; i < 20; i++) {
      const year = currentYear - i;
      options += `<option value="${year}">${year}</option>`;
    }
    selectElement.innerHTML = options;
  }

  function populateFixedDropdowns(elementId, options) {
    const element = document.getElementById(elementId);
    if (element) {
      element.innerHTML = options;
    }
  }

  // Function to generate the HTML for a single training record (Step 5)
  function createTrainingRow(id) {
    return `
                <div class="training-row" data-row-id="${id}">
                    <button type="button" class="btn-close remove-btn" aria-label="Close" onclick="removeTrainingRow('${id}')"></button>
                    <h6 class="mb-4 text-secondary">Training Record #${id}</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small">Name of the Institutes</label>
                            <select name="prevInstitute[]" class="form-select" required>
                              <option value="" disabled selected>Select Institute</option>
                              <?php foreach ($trainingInstitutes as $institute): ?>
                              <option value="<?=esc($institute['name'])?>">
                                <?=esc($institute['name'])?>
                              </option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Name of the Department</label>
                            <select name="prevDepartment[]" class="form-select" required>
                              <option selected disabled value="">Select a Department</option>
                              <?php foreach ($departments as $department): ?>
                              <option value="<?=esc($department['name'])?>">
                                <?=esc($department['name'])?>
                              </option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Name of the Supervisor</label>
                            <input type="text" name="prevSupervisorName[]" class="form-control" placeholder="Dr. Supervisor Name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Designation</label>
                            <select name="prevDesignation[]" class="form-select" required>
                              <option selected disabled value="">Select Designation</option>
                              <?php foreach ($designations as $designation): ?>
                              <option value="<?=esc($designation['designation'])?>">
                                <?=esc($designation['designation'])?>
                              </option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Start Date</label>
                            <input type="text" name="prevStartDate[]" class="form-control datepicker" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">End Date</label>
                            <input type="text" name="prevEndDate[]" class="form-control datepicker" required>
                        </div>
                    </div>
                </div>
            `;
  }

  // Global function to be called by the remove button (Step 5)
  window.removeTrainingRow = function(id) {
    const rowToRemove = document.querySelector(`.training-row[data-row-id="${id}"]`);
    if (rowToRemove) {
      rowToRemove.remove();
    }
    // If the last row is removed, and the switch is on, hide the container.
    const remainingRows = trainingContainer.querySelectorAll('.training-row').length;
    if (remainingRows === 0 && hasPreviousTrainingSwitch.checked) {
      hasPreviousTrainingSwitch.checked = false;
      trainingContainer.style.display = 'none';
    }
  };

  // Function to add a new row (Step 5)
  function addTrainingRow() {
    rowCounter++;
    trainingContainer.insertAdjacentHTML('beforeend', createTrainingRow(rowCounter));
  }

  // Function to update the applicant's name in the declaration text (Step 9)
  function updateDeclarationName() {
    // Get value from the Applicant Name in Step 1
    const name = applicantNameStep1.value.trim().toUpperCase();
    displayedApplicantName.textContent = name || '.......';
  }

  // --- Tab Navigation Logic ---

  function showTab(step) {
    // Deactivate all content and pills
    tabs.forEach(tab => tab.classList.remove('show', 'active'));
    navPills.forEach(pill => pill.classList.remove('active', 'complete'));

    // Activate current tab and pill
    tabs[step].classList.add('show', 'active');
    navPills[step].classList.add('active');

    // Mark previous pills as 'complete' (green)
    for (let i = 0; i < step; i++) {
      navPills[i].classList.add('complete');
    }
    currentStep = step;

    // Special handling for the declaration tab
    if (currentStep === 8) {
      updateDeclarationName();
    }
  }

  function validateCurrentTab() {
    const currentTabPane = tabs[currentStep];

    let allValid = true;

    currentTabPane.querySelectorAll('[required]').forEach(field => {
      // Check if the field is visible (i.e., not inside a hidden container)
      const isFieldVisible = field.closest('#residencyDatesContainer') ? residencyDatesContainer.style
        .display !== 'none' : true;

      if (isFieldVisible && !field.checkValidity()) {
        allValid = false;
        field.focus();
        registrationForm.reportValidity();
        return;
      }
    });

    // Special check for dynamic Section V (Step 5/index 4): if the switch is on, check dynamic fields
    if (currentStep === 4 && hasPreviousTrainingSwitch.checked) {
      const trainingRows = trainingContainer.querySelectorAll('.training-row').length;
      if (trainingRows === 0) {
        console.error("Validation Error: Please add at least one training record or switch off the toggle.");
        if (addTrainingRowBtn) addTrainingRowBtn.scrollIntoView({
          behavior: 'smooth'
        });
        allValid = false;
      }

      const requiredTrainingFields = trainingContainer.querySelectorAll('.training-row [required]');
      requiredTrainingFields.forEach(field => {
        if (!field.checkValidity()) {
          allValid = false;
          field.focus();
          registrationForm.reportValidity();
          return;
        }
      });
    }

    // Special check for Step 9 (index 8): must check the checkbox
    if (currentStep === 8) {
      const checkbox = document.getElementById('undertakingCheckbox');
      if (!checkbox.checked) {
        allValid = false;
        checkbox.focus();
      }
    }

    return allValid;
  }

  // Global listener for NEXT buttons
  document.querySelectorAll('.next-tab').forEach(button => {
    button.addEventListener('click', () => {
      if (validateCurrentTab()) {
        if (currentStep < tabs.length - 1) {
          showTab(currentStep + 1);
        }
      }
    });
  });

  // Global listener for PREVIOUS buttons
  document.querySelectorAll('.prev-tab').forEach(button => {
    button.addEventListener('click', () => {
      if (currentStep > 0) {
        showTab(currentStep - 1);
      }
    });
  });

  // Prevent tab links from directly navigating without validation
  navPills.forEach((pill, index) => {
    pill.addEventListener('click', (e) => {
      e.preventDefault();
      // Allow direct navigation backward
      if (index < currentStep) {
        showTab(index);
      }
      // Allow navigation to next tab only if current is valid
      else if (index === currentStep + 1) {
        if (validateCurrentTab()) {
          showTab(index);
        }
      }
    });
  });

  // --- Event Listeners and Initialization ---

  // Initial generation of years (Step 2 and Step 3)
  //generateYearOptions(qualificationYearSelect);
  //generateYearOptions(fcpsPassYearSelect);

  // Populate fixed dropdowns
  //populateFixedDropdowns('religion', religionOptions); // Step 1 - General Info
  //populateFixedDropdowns('currentInstitute', instituteOptions); // Step 4 - Current Training
  //populateFixedDropdowns('currentDepartment', departmentOptions);
  //populateFixedDropdowns('supervisorDesignation', designationOptions);

  // Step 6 - Future Choices
  /*for (let i = 1; i <= 3; i++) {
    populateFixedDropdowns(`futureInstitute${i}`, instituteOptions);
    populateFixedDropdowns(`futureDepartment${i}`, departmentOptions);
  }*/

  // Step 7 - Bank Info
  //populateFixedDropdowns('bankName', bankOptions);


  // Live update for the declaration name from Step 1's input
  applicantNameStep1.addEventListener('input', updateDeclarationName);


  // Toggle visibility of the dynamic section (Step 5 - Previous FCPS)
  hasPreviousTrainingSwitch.addEventListener('change', function() {
    if (this.checked) {
      trainingContainer.style.display = 'block';
      // Only add a row if there are no dynamic rows (excluding P and Button)
      if (trainingContainer.querySelectorAll('.training-row').length === 0) {
        addTrainingRow();
      }
    } else {
      // Clear all dynamic content when the switch is turned off
      trainingContainer.querySelectorAll('.training-row').forEach(row => row.remove());
      trainingContainer.style.display = 'none';
      rowCounter = trainingContainer.querySelectorAll('.training-row').length; // Reset to 0
    }
  });

  // Add row button listener (Step 5)
  if (addTrainingRowBtn) {
    addTrainingRowBtn.addEventListener('click', addTrainingRow);
  }

  // --- Final Form Submission ---
  registrationForm.addEventListener('submit', function(e) {
    e.preventDefault();
    // Final check on the last step (index 8)
    if (currentStep === 8 && validateCurrentTab()) {
      console.log("Form is valid and submitted! All required data and files are being processed.");

      registrationForm.submit();

      // Show a simple success message
      /*const submitButton = this.querySelector('button[type="submit"]');
      submitButton.textContent = 'Submission Complete!';
      submitButton.classList.remove('btn-success');
      submitButton.classList.add('btn-primary');

      setTimeout(() => {
        submitButton.innerHTML = '<i class="fas fa-check-circle me-2"></i> Submit Registration';
        submitButton.classList.add('btn-success');
        submitButton.classList.remove('btn-primary');
      }, 3000);*/
    } else if (currentStep !== 8) {
      // If submit is hit before the last step, navigate to the next incomplete step
      for (let i = 0; i < tabs.length; i++) {
        showTab(i);
        if (!validateCurrentTab()) {
          // The user will see the validation error on this tab and can fix it
          return;
        }
      }
      // If all previous steps are valid, force navigate to the last step for declaration
      showTab(8);
    } else {
      // Prevent submission if validation fails on the last step
      registrationForm.reportValidity();
    }
  });

});
</script>
<?php $this->endSection()?>
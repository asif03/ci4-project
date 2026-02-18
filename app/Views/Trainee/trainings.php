<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info<?php $this->endSection()?>
<?php $this->section('main')?>
<?php $validation = \Config\Services::validation(); ?>
<!-- New Add Training Page -->
<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h5 class="fw-bold text-dark mb-2">Add New Training Record</h5>
    <p class="text-muted mb-2">
      Please fill out the form below to add a new academic record.
    </p>
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

    <?=$validation->listErrors('my_list')?>
    <form action="<?=base_url('trainings/progress-reports')?>" method="post">
      <?=csrf_field()?>
      <!-- Training Details Section -->
      <div class="card">
        <div class="card-header bg-light">
          Training Details
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="institute" class="form-label fw-semibold text-dark">Training Institute:</label>
            <select class="form-select <?=$validation->hasError('instituteName') ? 'border-danger' : ''?>"
              name="instituteName" id="institute" onchange="fetchSupervisor(this.value);">
              <option value="" <?=set_select('instituteName', '', old('instituteName') ? true : false)?>>Select
                Institute...</option>
              <?php foreach ($trainingInstitutes as $institute): ?>
              <option value="<?=esc($institute['institute_id'])?>"
                <?=set_select('instituteName', $institute['institute_id'], old('instituteName') ? true : false)?>>
                <?=esc($institute['name'])?>
              </option>
              <?php endforeach; ?>
            </select>
            <?=$validation->hasError('instituteName') ? '<div class="text-danger mt-1">' . $validation->getError('instituteName') . '</div>' : ''?>
          </div>
          <div class="mb-3 row">
            <div class="col-md-6">
              <label for="department" class="form-label fw-semibold text-dark">Department</label>
              <select class="form-select <?=$validation->hasError('departmentName') ? 'border-danger' : ''?>"
                name="departmentName" id="department">
                <option value="" <?=set_select('departmentName', '', old('departmentName') ? true : false)?>>Select
                  Department...</option>
                <?php foreach ($departments as $department) {?>
                <option value="<?=esc($department['speciality_id'])?>"
                  <?=set_select('departmentName', $department['speciality_id'], old('departmentName') ? true : false)?>>
                  <?=esc($department['name'])?>
                </option>
                <?php }?>
              </select>
              <?=$validation->hasError('departmentName') ? '<div class="text-danger mt-1">' . $validation->getError('departmentName') . '</div>' : ''?>
            </div>
            <div class="col-md-6">
              <label for="beds" class="form-label fw-semibold text-dark">Number of beds in the unit</label>
              <input type="number"
                class="form-control rounded-lg <?=$validation->hasError('beds') ? 'border-danger' : ''?>" id="beds"
                name="beds" value="<?=set_value('beds')?>">
              <?=$validation->hasError('beds') ? '<div class="text-danger mt-1">' . $validation->getError('beds') . '</div>' : ''?>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-md-6">
              <label for="trainees" class="form-label fw-semibold text-dark">Number of trainees</label>
              <input type="number" class="form-control rounded-lg" id="trainees" name="trainees"
                value="<?=set_value('trainees')?>">
            </div>
            <div class="col-md-6">
              <label for="facultyMembers" class="form-label fw-semibold text-dark">Number of faculty members (Assistant
                Professor
                and above)</label>
              <input type="number" class="form-control rounded-lg" name="facultyMembers" id="facultyMembers"
                value="<?=set_value('facultyMembers')?>">
            </div>
          </div>
          <div class="mb-3 row">
            <h6 class="fw-bold text-dark mb-3">Training Duration</h6>
            <div class="col-md-4 mb-3">
              <label for="fromDate" class="form-label fw-semibold text-dark">From Date</label>
              <input type="text" class="form-control rounded-lg" name="fromDate" id="fromDate" placeholder="YYYY-mm-dd"
                value="<?=set_value('fromDate')?>">
            </div>
            <div class="col-md-4 mb-3">
              <label for="toDate" class="form-label fw-semibold text-dark">To Date</label>
              <input type="text" class="form-control rounded-lg" name="toDate" id="toDate" placeholder="YYYY-mm-dd"
                value="<?=set_value('toDate')?>">
            </div>
            <div class="col-md-4 mb-3">
              <label for="duration" class="form-label fw-semibold text-dark">Duration (in months)</label>
              <input type="number" class="form-control rounded-lg" id="duration" name="duration" placeholder="e.g., 6"
                value="<?=set_value('duration')?>">
            </div>
          </div>
        </div>
      </div>

      <!-- Performance Section -->
      <div class="card p-4 rounded-3 shadow-sm mb-4">
        <h6 class="fw-bold text-dark mb-3">Performance</h6>
        <div class="row g-3">
          <div class="col-md-6 mb-3">
            <label for="attendance" class="form-label fw-semibold text-dark">Attendance</label>
            <select class="form-select rounded-lg" id="attendance" name="attendance">
              <option selected disabled value="">Select a performance</option>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="knowledge" class="form-label fw-semibold text-dark">Knowledge</label>
            <select class="form-select rounded-lg" id="knowledge" name="knowledge">
              <option selected disabled value="">Select a performance</option>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="skill" class="form-label fw-semibold text-dark">Skill</label>
            <select class="form-select rounded-lg" id="skill" name="skill">
              <option selected disabled value="">Select a performance</option>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="attitude" class="form-label fw-semibold text-dark">Attitude</label>
            <select class="form-select rounded-lg" id="attitude" name="attitude">
              <option selected disabled value="">Select a performance</option>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
        </div>
      </div>
      <!-- Supervisor Details Section -->
      <div class="card p-4 rounded-3 shadow-sm mb-4">
        <h6 class="fw-bold text-dark mb-3">Supervisor Details:</h6>
        <div class="mb-1 row">
          <div class="col-md-6 mb-3">
            <label for="supervisor" class="form-label fw-semibold text-dark">Select Supervisor</label>
            <!-- Supervisor Dropdown -->
            <select class="form-select mt-2" name="supervisor" id="supervisor" onchange="selectSupervisor(this.value)">
              <option selected disabled value="">Select a supervisor</option>
            </select>
            <!-- Optional loading indicator -->
            <div id="supervisor-loading" class="text-muted mt-1" style="display:none;">Loading supervisors...</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="supervisorName" class="form-label fw-semibold text-dark">Name</label>
            <input type="text" class="form-control rounded-lg" id="supervisorName" name="supervisorName"
              value="<?=set_value('supervisorName')?>" placeholder="e.g., Dr. A. Rahman">
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6 mb-3">
            <label for="supervisorDesignation" class="form-label fw-semibold text-dark">Designation</label>
            <select class="form-select rounded-lg" name="supervisorDesignation" id="supervisorDesignation">
              <option selected disabled value="">Select a Designation...</option>
              <?php foreach ($designations as $designation) {?>
              <option value="<?=esc($designation['id'])?>"><?=esc($designation['designation'])?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="supervisorSubject" class="form-label fw-semibold text-dark">Subject</label>
            <select class="form-select rounded-lg" name="supervisorSubject" id="supervisorSubject">
              <option selected disabled value="">Select a Subject...</option>
              <?php foreach ($specialities as $subject) {?>
              <option value="<?=esc($subject['speciality_id'])?>"><?=esc($subject['name'])?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6 mb-3">
            <label for="supervisorEmail" class="form-label fw-semibold text-dark">Email Address</label>
            <input type="text" class="form-control rounded-lg" id="supervisorEmail" name="supervisorEmail"
              value="<?=set_value('supervisorEmail')?>" placeholder="e.g., example@gmail.com">
          </div>
          <div class="col-md-6 mb-3">
            <label for="supervisorMobile" class="form-label fw-semibold text-dark">Mobile Number</label>
            <input type="text" class="form-control rounded-lg" id="supervisorMobile" name="supervisorMobile"
              value="<?=set_value('supervisorMobile')?>" placeholder="e.g., 017....">
          </div>
        </div>
        <div class="mb-3">
          <label for="supervisorAddress" class="form-label fw-semibold text-dark">Mailing Address</label>
          <textarea class="form-control rounded-lg" id="supervisorAddress" rows="3" name="supervisorAddress">
            <?=set_value('supervisorAddress')?>
          </textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary fw-bold rounded-lg px-4">Add Record</button>
    </form>
  </div>
</div>
<?php $this->endSection()?>
<?php $this->section('pageScripts')?>
<script>
$('#fromDate').datepicker({
  format: "yyyy-mm-dd", // <-- Set the format here
  autoclose: true,
  todayHighlight: true
});
$('#toDate').datepicker({
  format: "yyyy-mm-dd", // <-- Set the format here
  autoclose: true,
  todayHighlight: true
});

function fetchSupervisor(instituteId) {

  if (!instituteId) {
    // Clear the supervisor fields if no institute is selected
    $('#supervisorName').val('');
    $('#supervisorMobile').val('');
    $('#supervisorDesignation').val('');
    $('#supervisorSubject').val('');
    $('#supervisorEmail').val('');
    $('#supervisorAddress').val('');
    return;
  }

  const supervisorSelect = document.getElementById('supervisor');
  const loadingText = document.getElementById('supervisor-loading');

  // 🔹 Step 1: Clear existing options
  supervisorSelect.innerHTML = '<option value="">Select Supervisor...</option>';

  // 🔹 Step 2: Stop if no institute selected
  if (!instituteId) return;

  // 🔹 Step 3: Show loading text
  loadingText.style.display = 'block';

  // 🔹 Step 4: Fetch supervisors via AJAX
  fetch("<?=base_url('trainings/get-supervisors')?>/" + instituteId)
    .then(response => response.json())
    .then(data => {
      // Hide loading text
      loadingText.style.display = 'none';

      // If no supervisors found
      if (data.length === 0) {
        supervisorSelect.innerHTML = '<option value="99999999">Others</option>';
        return;
      }

      // Populate new list
      data.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.id;
        opt.textContent = item.supervisor_name;
        supervisorSelect.appendChild(opt);
      });

      const otherOpt = document.createElement('option');
      otherOpt.value = '99999999';
      otherOpt.textContent = 'Others';
      supervisorSelect.appendChild(otherOpt);

    })
    .catch(err => {
      console.error('Error loading supervisors:', err);
      loadingText.style.display = 'none';
      supervisorSelect.innerHTML = '<option value="">Error loading supervisors</option>';
    });
}

function selectSupervisor(supervisorId) {
  if (supervisorId === '99999999') {
    // Clear fields for "Others"
    $('#supervisorName').val('');
    $('#supervisorName').prop('disabled', false);
    $('#supervisorMobile').val('');
    $('#supervisorMobile').prop('disabled', false);
    $('#supervisorDesignation').val('');
    $('#supervisorSubject').val('');
    $('#supervisorSubject').prop('disabled', false);
    $('#supervisorEmail').val('');
    $('#supervisorEmail').prop('disabled', false);
    $('#supervisorAddress').val('');
    $('#supervisorAddress').prop('disabled', false);
  } else if (supervisorId) {
    // Fetch supervisor details via AJAX
    fetch("<?=base_url('trainings/get-supervisor-details')?>/" + supervisorId)
      .then(response => response.json())
      .then(data => {
        $('#supervisorName').val(data.supervisor_name);
        $('#supervisorName').prop('disabled', true);
        $('#supervisorMobile').val(data.mobile);
        $('#supervisorMobile').prop('disabled', true);
        $('#supervisorDesignation').val(data.designation_id);
        $('#supervisorSubject').val(data.subject_id);
        $('#supervisorSubject').prop('disabled', true);
        $('#supervisorEmail').val(data.email);
        $('#supervisorEmail').prop('disabled', true);
        $('#supervisorAddress').val(data.mailing_address);
        $('#supervisorAddress').prop('disabled', true);
      })
      .catch(err => {
        console.error('Error loading supervisor details:', err);
        alert('Error loading supervisor details. Please try again.');
      });
  } else {
    // Clear fields if no supervisor selected
    $('#supervisorName').val('');
    $('#supervisorName').prop('disabled', false);
    $('#supervisorMobile').val('');
    $('#supervisorMobile').prop('disabled', false);
    $('#supervisorDesignation').val('');
    $('#supervisorSubject').val('');
    $('#supervisorSubject').prop('disabled', false);
    $('#supervisorEmail').val('');
    $('#supervisorEmail').prop('disabled', false);
    $('#supervisorAddress').val('');
    $('#supervisorAddress').prop('disabled', false);
  }
}
</script>
<?php $this->endSection()?>
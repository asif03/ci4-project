<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info<?php $this->endSection()?>

<?php $this->section('main')?>
<!-- New Add Training Page -->
<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h5 class="fw-bold text-dark mb-2">Add New Training Record</h5>
    <p class="text-muted mb-2">
      Please fill out the form below to add a new academic record.
    </p>
    <?=session()->getFlashdata('error')?>
    <?=validation_list_errors()?>
    <form action="<?=base_url('trainings/progress-reports')?>" method="post">
      <?=csrf_field()?>
      <!-- Training Details Section -->
      <div class="card p-4 rounded-3 shadow-sm mb-4">
        <h6 class="fw-bold text-dark mb-3">Training Details</h6>
        <div class="mb-3">
          <label for="institute" class="form-label fw-semibold text-dark">Training Institute:</label>
          <select class="form-select rounded-lg" name="instituteName" id="institute">
            <option selected disabled value="">Select Institute...</option>
            <?php foreach ($trainingInstitutes as $institute) {?>
            <option value="<?=esc($institute['institute_id'])?>"><?=esc($institute['name'])?></option>
            <?php }?>
          </select>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6">
            <label for="department" class="form-label fw-semibold text-dark">Department</label>
            <select class="form-select rounded-lg" name="departmentName" id="department">
              <option selected disabled value="">Select Department...</option>
              <?php foreach ($departments as $department) {?>
              <option value="<?=esc($department['speciality_id'])?>"><?=esc($department['name'])?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="beds" class="form-label fw-semibold text-dark">Number of beds in the unit</label>
            <input type="number" class="form-control rounded-lg" id="beds" required>
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6">
            <label for="trainees" class="form-label fw-semibold text-dark">Number of trainees</label>
            <input type="number" class="form-control rounded-lg" id="trainees" required>
          </div>
          <div class="col-md-6">
            <label for="faculty" class="form-label fw-semibold text-dark">Number of faculty members (Assistant Professor
              and above)</label>
            <input type="number" class="form-control rounded-lg" id="faculty" required>
          </div>
        </div>
        <div class="mb-3 row">
          <h6 class="fw-bold text-dark mb-3">Training Duration</h6>
          <div class="col-md-4 mb-3">
            <label for="fromDate" class="form-label fw-semibold text-dark">From Date</label>
            <input type="date" class="form-control rounded-lg" id="fromDate" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="toDate" class="form-label fw-semibold text-dark">To Date</label>
            <input type="date" class="form-control rounded-lg" id="toDate" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="duration" class="form-label fw-semibold text-dark">Duration</label>
            <input type="text" class="form-control rounded-lg" id="duration" placeholder="e.g., 3 months" required>
          </div>
        </div>
      </div>

      <!-- Performance Section -->
      <div class="card p-4 rounded-3 shadow-sm mb-4">
        <h6 class="fw-bold text-dark mb-3">Performance</h6>
        <div class="row g-3">
          <div class="col-md-6 mb-3">
            <label for="attendance" class="form-label fw-semibold text-dark">Attendance</label>
            <select class="form-select rounded-lg" id="attendance" required>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="knowledge" class="form-label fw-semibold text-dark">Knowledge</label>
            <select class="form-select rounded-lg" id="knowledge" required>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="skill" class="form-label fw-semibold text-dark">Skill</label>
            <select class="form-select rounded-lg" id="skill" required>
              <option value="Poor">Poor</option>
              <option value="Average">Average</option>
              <option value="Satisfactory">Satisfactory</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="attitude" class="form-label fw-semibold text-dark">Attitude</label>
            <select class="form-select rounded-lg" id="attitude" required>
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
        <div class="mb-3">
          <label for="supervisorName" class="form-label fw-semibold text-dark">Name</label>
          <input type="text" class="form-control rounded-lg" id="supervisorName" placeholder="e.g., Dr. A. Rahman"
            required>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6 mb-3">
            <label for="supervisorDesignation" class="form-label fw-semibold text-dark">Designation</label>
            <input type="text" class="form-control rounded-lg" id="supervisorDesignation" placeholder="e.g., Professor"
              required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="supervisorSubject" class="form-label fw-semibold text-dark">Subject</label>
            <input type="text" class="form-control rounded-lg" id="supervisorSubject" placeholder="e.g., Neurosurgery"
              required>
          </div>
        </div>
        <div class="mb-3">
          <label for="supervisorAddress" class="form-label fw-semibold text-dark">Mailing Address</label>
          <textarea class="form-control rounded-lg" id="supervisorAddress" rows="3" required></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-success fw-bold rounded-lg px-4">Add Record</button>
    </form>
  </div>
</div>


<?php $this->endSection()?>
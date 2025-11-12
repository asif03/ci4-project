<?php $this->extend('layout')?>
<?php $this->section('title')?>Trainee Profile<?php $this->endSection()?>
<?php $this->section('pageStyles')?>
<style>
/* Profile page specific styles */
.profile-header {
  background: linear-gradient(to right, #28a745, #16a34a);
  color: white;
  padding: 3rem;
  border-radius: 1rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.profile-avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  border: 4px solid white;
  object-fit: cover;
}

.info-card {
  border: none;
  border-radius: 1rem;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.info-list .list-group-item {
  border-left: none;
  border-right: none;
  padding: 1rem;
}

.info-list .list-group-item:first-child {
  border-top: none;
}
</style>
<?php $this->endSection()?>
<?php $this->section('main')?>
<!-- Profile Page -->
<div id="profile-page" class="page-content">
  <header class="profile-header mb-4 d-flex flex-column flex-md-row align-items-center justify-content-start">
    <img
      src="https://placehold.co/120x120/22c55e/ffffff?text=<?=esc(implode('', array_map(fn($w) => strtoupper($w[0]), explode(' ', $basicInfo['applicant_name']))))?>"
      alt="User Profile" class="profile-avatar mb-4 mb-md-0 me-md-4">
    <div>
      <h1 class="h2 fw-bold mb-1"><?=esc($basicInfo['applicant_name'])?></h1>
      <p class="lead mb-0">Trainee</p>
    </div>
  </header>
  <div class="row g-4">
    <div class="col-lg-6">
      <div class="card info-card p-4">
        <h5 class="fw-bold text-dark mb-4">Personal Information</h5>
        <ul class="list-group list-group-flush info-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Full Name</div>
            <div class="text-dark">
              <?=esc($basicInfo['applicant_name'])?>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Father's Name</div>
            <div class="text-dark"><?=esc($basicInfo['father_name'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Mother's Name</div>
            <div class="text-dark"><?=esc($basicInfo['mother_name'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Date of Birth</div>
            <div class="text-dark">
              <?php echo $basicInfo['date_of_birth'] == '' ? $basicInfo['old_date_of_birth'] : $basicInfo['date_of_birth']; ?>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Phone Number</div>
            <div class="text-dark"><?=esc($basicInfo['cell'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Email</div>
            <div class="text-dark text-end"><?=esc($basicInfo['email'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Mailing Address</div>
            <div class="text-dark"><?=esc($basicInfo['mailing_address'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Present Address</div>
            <div class="text-dark"><?=esc($basicInfo['present_address'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Permanent Address</div>
            <div class="text-dark text-end"><?=esc($basicInfo['permanent_address'])?></div>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card info-card p-4">
        <h5 class="fw-bold text-dark mb-4">FCPS Part-I Details</h5>
        <ul class="list-group list-group-flush info-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">FCPS Pass Session</div>
            <div class="text-dark">
              <?=esc($basicInfo['fcps_part_one_session'])?>,
              <?=esc($basicInfo['fcps_part_one_year'])?>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Specialty</div>
            <div class="text-dark"><?=esc($basicInfo['subject_name'])?></div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Online Reg. No./Reg. No. (after passing FCPS Part-I)</div>
            <div class="text-dark"><?=esc($basicInfo['reg_no'])?></div>
          </li>
        </ul>
      </div>
    </div>


    <div class="col-lg-6">
      <div class="card info-card p-4 h-100">
        <h5 class="fw-bold text-dark mb-4">Academic Details (MBBS)</h5>
        <ul class="list-group list-group-flush info-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Program</div>
            <div class="text-dark">Medical Trainee Program</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Specialty</div>
            <div class="text-dark">Cardiology</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Enrollment Date</div>
            <div class="text-dark">Sep 1, 2022</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Total Courses Completed</div>
            <div class="text-dark">15</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Current GPA</div>
            <div class="text-dark">3.85</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Training Status</div>
            <div class="badge bg-success py-2 px-3">Active</div>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card info-card p-4">
        <h5 class="fw-bold text-dark mb-4">Academic Details</h5>
        <ul class="list-group list-group-flush info-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Program</div>
            <div class="text-dark">Medical Trainee Program</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Specialty</div>
            <div class="text-dark">Cardiology</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Enrollment Date</div>
            <div class="text-dark">Sep 1, 2022</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Total Courses Completed</div>
            <div class="text-dark">15</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Current GPA</div>
            <div class="text-dark">3.85</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Training Status</div>
            <div class="badge bg-success py-2 px-3">Active</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php $this->endSection()?>
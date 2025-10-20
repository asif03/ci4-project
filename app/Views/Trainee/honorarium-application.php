<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info<?php $this->endSection()?>
<?php $this->section('main')?>
<?php $validation = \Config\Services::validation(); ?>

<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h5 class="fw-bold text-dark mb-2">Apply for Honorarium</h5>
    <p class="text-muted mb-2">
      Please fill out the form below for apply honorarium.
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

    <?php if (!$applicationExists): ?>
    <div class="alert alert-danger fw-bold" role="alert">
      <span class="text-danger"> Training application not found! Please apply before submit the bill form. For apply
      </span><a class="text-success" href="<?=base_url('trainings/training-application')?>">Click Here</a>
    </div>
    <?php else: ?>
    <form action="<?=base_url('trainings/honorarium-bill-application')?>" method="post">
      <?=csrf_field()?>
      <!-- Training Details Section -->
      <div class="card">
        <div class="card-header bg-light">
          General Information
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="institute" class="form-label fw-semibold text-dark">Name of the Trainee (In capital letters as
              per NID card):</label>
            <input type="text" class="form-control rounded-lg" id="applicantName" name="applicantName"
              value="<?=set_value('beds')?>" disabled>
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
      <button type="submit" class="btn btn-primary fw-bold rounded-lg px-4">Apply</button>
    </form>
    <?php endif; ?>
  </div>
</div>
<?php $this->endSection()?>
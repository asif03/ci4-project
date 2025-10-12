<div>
  <p class="fw-bold text-info">Training Institute Details:</p>
  <div class="row g-1">
    <div class="col-md-12">
      <strong>Institute Name:</strong>
      <span>
        <?php if ($progressReport['training_institute_id'] != null): ?>
        <?=esc($progressReport['training_institute_name'])?>
        <?php else: ?>
        <?=esc($progressReport['institute_p2_training'])?>
        <?php endif; ?>
      </span>
    </div>
    <div class="col-md-12">
      <strong>Department:</strong>
      <span>
        <?php if ($progressReport['department_id'] != null): ?>
        <?=esc($progressReport['department_name'])?>
        <?php else: ?>
        <?=esc($progressReport['supervisor_department'])?>
        <?php endif; ?>
      </span>
    </div>
    <div class="col-md-12">
      <strong class="text-danger-emphasis">Unit Details:</strong>
    </div>
    <div class="col-md-12">
      <strong>Number of Beds:</strong>
      <span><?=esc($progressReport['no_of_beds'])?></span>
    </div>
    <div class="col-md-12">
      <strong>Number of Trainees:</strong>
      <span><?=esc($progressReport['no_of_trainees'])?></span>
    </div>
    <div class="col-md-12">
      <strong>Number of faculty members (Associate Professor and above):</strong>
      <span><?=esc($progressReport['no_of_faculty_mem'])?></span>
    </div>
  </div>
</div>
<div class="mt-4 pt-2 border-top">
  <p class="fw-bold text-info">Training Details:</p>
  <div class="row g-1">
    <div class="col-md-6">
      <div class="col"><strong>From Date:</strong> <span><?=esc($progressReport['training_start_date'])?></span></div>
      <div class="col"><strong>To Date:</strong> <span><?=esc($progressReport['training_end_date'])?></span></div>
      <div class="col"><strong>Duration:</strong> <span><?=esc($progressReport['countable_duration_month'])?>
          Months</span></div>
    </div>
    <div class="col-md-6">
      <p class="fw-bold mb-2 text-danger-emphasis">Performance:</p>
      <div class="col"><strong>Attendance:</strong> <span><?=esc($progressReport['attendance'])?></span></div>
      <div class="col" p><strong>Knowledge:</strong> <span><?=esc($progressReport['knowledge'])?></span></div>
      <div class="col"><strong>Skill:</strong> <span><?=esc($progressReport['skill'])?></span></div>
      <div class="col"><strong>Attitude:</strong> <span><?=esc($progressReport['attitude'])?></span></div>
    </div>
  </div>
</div>
<div class="mt-2 pt-2 border-top">
  <span class="fw-bold mb-2 text-info">Supervisor Details:</span>
  <div class="col">
    <strong>Name:</strong>
    <span>
      <?php if ($progressReport['supervisor_id'] != null): ?>
      <?=esc($progressReport['new_supervisor_name'])?>
      <?php else: ?>
      <?=esc($progressReport['supervisor_name'])?>
      <?php endif; ?>
    </span>
  </div>
  <div class="col">
    <strong>Designation:</strong>
    <span>
      <?php if ($progressReport['supervisor_id'] != null): ?>
      <?=esc($progressReport['new_designation'])?>
      <?php else: ?>
      <?=esc($progressReport['supervisor_designation'])?>
      <?php endif; ?>
    </span>
  </div>
  <div class="col">
    <strong>Subject:</strong>
    <span>
      <?php if ($progressReport['supervisor_id'] != null): ?>
      <?=esc($progressReport['new_supervisor_subject_name'])?>
      <?php else: ?>
      <?=esc($progressReport['supervisor_subject'])?>
      <?php endif; ?>
    </span>
  </div>
  <div class="col">
    <strong>Mailing Address:</strong>
    <span>
      <?php if ($progressReport['supervisor_id'] != null): ?>
      <?=esc($progressReport['mailing_address'])?>
      <?php else: ?>
      <?=esc($progressReport['supervisor_mailing_address'])?>
      <?php endif; ?>
    </span>
  </div>
  <div class="col">
    <strong>Mobile:</strong>
    <span>
      <?php if ($progressReport['supervisor_id'] != null): ?>
      <?=esc($progressReport['mobile'])?>
      <?php else: ?>
      <?=esc($progressReport['supervisor_mobile_no'])?>
      <?php endif; ?>
    </span>
  </div>
</div>
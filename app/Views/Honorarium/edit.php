<form action="<?=base_url('bills/update-honorarium/' . $honorarium['id'])?>" method="post"
  enctype="multipart/form-data">
  <div class="modal-header">
    <h5 class="modal-title" id="viewHonorariumEditLabel">Edit Applicant's Bill Information</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <?=csrf_field()?>
    <input type="hidden" name="_method" value="PUT"> <!-- simulate PUT -->
    <input type="hidden" name="applicantId" value="<?php echo $honorarium['applicant_id']; ?>" />
    <input type="hidden" name="honorariumId" value="<?php echo $honorarium['id']; ?>" />
    <div class="row">
      <div class="col">
        <label for="bmdcRegNo" class="form-label">BMDC Reg. No.</label>
        <input type="number" class="form-control" name="bmdc_reg_no" id="bmdcRegNo"
          value="<?php echo $honorarium['bmdc_reg_no']; ?>" placeholder="BMDC Reg. No." disabled />
      </div>
      <div class="col">
        <label for="bmdcRegValidity" class="form-label">BMDC Reg. Validity:</label>
        <div class="input-group mb-1">
          <input type="text" class="form-control" name="bmdcRegValidity" id="bmdcRegValidity"
            aria-label="BMDC Reg. Validity" aria-describedby="calendar-addon2"
            value="<?php echo $honorarium['bmdc_validity']; ?>" placeholder="YYYY-MM-DD" disabled />
          <span class="input-group-text" id="calendar-addon2"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
    </div>
    <div class="row mb-1 p-2">
      <div class="border border-secondary text-center fs-4 rounded-pill mb-1">General Information</div>
      <div class="mb-1 row">
        <label for="name" class="col-sm-6 col-form-label">Name of the Trainee (In capital letters as per NID
          card):</label>
        <div class="col-sm-6">
          <label for="name" class="col-sm-6 col-form-label"><?=esc($honorarium['name'])?></label>
        </div>
      </div>
      <div class="mb-1 row">
        <label for="fcpsSpeciallity" class="col-sm-6 col-form-label">Specialty:</label>
        <div class="col-sm-6">
          <label for="fcpsSpeciallity" class="col-sm-6 col-form-label"><?=esc($honorarium['fcps_speciallity'])?></label>
        </div>
      </div>
      <div class="row mb-1">
        <label for="fcpsSession" class="col-sm-6 col-form-label">FCPS Part-I Passed Session/Year:</label>
        <div class="col-sm-3">
          <label for="fcpsSession" class="col-sm-6 col-form-label"><?=$honorarium['fcps_month']?></label>
        </div>
        <div class="col-sm-3">
          <label for="fcpsYear" class="col-sm-6 col-form-label"><?=$honorarium['fcps_year']?></label>
        </div>
      </div>
      <div class="row mb-1">
        <label for="fcpsRegNo" class="col-sm-6 col-form-label">BCPS Reg. No. (10 Digit after passing FCPS Part-I):
        </label>
        <div class="col-sm-6">
          <label for="fcpsRegNo" class="col-sm-6 col-form-label"><?php echo $honorarium['fcps_reg_no']; ?></label>
        </div>
      </div>
    </div>
    <div class="row mb-1 p-2">
      <div class="border border-secondary text-center fs-4 rounded-pill mb-3">Applicant's Training Information</div>
      <div class="row mb-1">
        <label for="trainingInstitute" class="col-sm-6 col-form-label">Institute Name:</label>
        <div class="col-sm-6">
          <select name="trainingInstitute" class="form-select" required>
            <option value="">Select Please</option>
            <?php foreach ($institute as $value) {?>
            <option value="<?php echo $value['institute_id']; ?>"<?php if ($honorarium['training_institute_id'] == $value['institute_id']) {
        echo 'selected';
}
    ?>>
              <?php echo $value['name']; ?></option>
            <?php }?>
          </select>
        </div>
      </div>
      <div class="row mb-1">
        <label for="department" class="col-sm-6 col-form-label">Department:</label>
        <div class="col-sm-6">
          <select name="department" id="department" class="form-select" required>
            <option value="">Select Please</option>
            <?php foreach ($speciality as $value) {?>
            <option value="<?php echo $value['name']; ?>"<?php if ($honorarium['department_name'] == $value['name']) {
        echo 'selected';
}
    ?>>
              <?php echo $value['name']; ?></option>
            <?php }?>
          </select>
        </div>
      </div>
      <div class="row mb-1">
        <label for="honorariumPeriod" class="col-sm-6 col-form-label">Period of Training: </label>
        <div class="col-sm-3">
          <select name="honorariumPeriod" id="honorariumPeriod" class="form-select" disabled>
            <option value="">Select Please</option>
            <?php foreach ($slots as $slot) {?>
            <option value="<?php echo $slot['id']; ?>"
              <?php if ($slot['id'] == $honorarium['honorarium_slot_id']) {echo 'selected';}?>>
              <?php echo $slot['slot_name']; ?></option>
            <?php }?>
          </select>
        </div>
        <div class="col-sm-3">
          <select name="honorariumYear" id="honorariumYear" class="form-select" disabled>
            <option value="<?=esc($honorarium['honorarium_year'])?>"><?=esc($honorarium['honorarium_year'])?>
            </option>
          </select>
        </div>
      </div>
      <div class="row mb-1">
        <label for="previousTrainingPeriod" class="col-sm-6 col-form-label">Total Previous Training with Course (In
          Month):
        </label>
        <div class="col-sm-3">
          <select name="previousTrainingPeriod" id="previousTrainingPeriod" class="form-select" required>
            <option value="" disabled selected>Select</option>
            <?php for ($cnt = 0; $cnt <= 54; $cnt = $cnt + 6) {?>
            <option value="<?php echo $cnt; ?>"<?php if ($honorarium['previous_training_inmonth'] == $cnt) {
        echo 'selected';
}
    ?>>
              <?php echo $cnt; ?></option>
            <?php
                }
            ?>
          </select>

          <!--
          <input type="text" class="form-control" name="previousTrainingPeriod" id="previousTrainingPeriod"
            value="<?php //echo $honorarium['previous_training_inmonth']; ?>" placeholder="Total number of months"
            required /> -->
        </div>
      </div>
      <div class="row mb-1">
        <label for="honorariumPosition" class="col-sm-6 col-form-label">Applying for honorarium: </label>
        <div class="col-sm-6">
          <select name="honorariumPosition" id="honorariumPosition" class="form-select" disabled>
            <option value="">Select Please</option>
            <?php for ($cnt = 1; $cnt <= 10; $cnt++) {?>
            <option value="<?php echo $cnt; ?>"
              <?php if ($honorarium['honorarium_position'] == $cnt) {echo 'selected';}?>>
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
      </div>
    </div>
    <div class="row mb-1 p-2">
      <div class="border border-secondary text-center fs-4 rounded-pill mb-3">Enclosures: (The applicants have to scan
        and
        upload the following documents)</div>
      <div class="row mb-1">
        <label for="honorariumPosition" class="col-sm-6 col-form-label">Provisional training certificate Signature and
          seal of Supervisor and Director (Hospital)/Superintendent (Hospital)/ Principal for Basic Subject:</label>
        <div class="col-sm-6">
          <input type="file" name="certificate" class="form-control" />
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer d-flex justify-content-between">
    <button type="submit" class="btn btn-primary">Update</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  </div>
</form>
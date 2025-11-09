<style>
.table>tbody>tr>td {
  padding: 2px 2px !important;
}
</style>
<form action="<?=base_url('bills/update-honorarium-training/' . $honorarium['id'])?>" method="post"
  enctype="multipart/form-data">
  <div class="modal-header">
    <h5 class="modal-title" id="viewHonorariumEditLabel">Edit Applicant's Previous Training Information</h5>
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
      <div class="border border-secondary text-center fs-4 rounded-pill mb-3">Applicant's Previous Training Information
      </div>
      <div class="row mb-1">
        <label for="previousTrainingPeriod" class="col-sm-6 col-form-label">Total Previous Training with Course (In
          Month):
        </label>
        <div class="col-sm-3">
          <select name="previousTrainingPeriod" id="previousTrainingPeriod" class="form-select" required>
            <option value="">Select Please</option>
            <?php for ($cnt = 1; $cnt <= 10; $cnt++) {?>
            <option value="<?php echo $cnt; ?>"
              <?php if ($honorarium['previous_training_inmonth'] == $cnt) {echo 'selected';}?>>
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
      <!-- DYNAMIC TABLE SECTION (Field 13 Details) -->
      <div class="col-md-12 rounded" id="previousTrainingDetails">
        <p class="text-mutated">Provide details in Ascending Order for previous training periods.</p>
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="table-warning">
              <tr>
                <th class="text-nowrap">Tr. Slot</th>
                <th class="text-nowrap">From Date</th>
                <th class="text-nowrap">To Date</th>
                <th class="text-nowrap">Name of Department</th>
                <th class="text-nowrap">Name of Institute</th>
                <th class="text-nowrap">Training Category</th>
                <th class="text-center">Honorarium Taken?</th>
                <th class="text-center text-nowrap">Action</th>
              </tr>
            </thead>
            <tbody id="dynamicTrainingRows">
              <?php foreach ($previousTrainings as $key => $training) {?>
              <tr data-row-id="<?=esc($key + 1)?>">
                <td>
                  <input type="hidden" name="prevTrainingRecordId[]" value="<?=esc($training['id'])?>" />
                  <select name="prevTrainingSlot[]" class="form-select" required>
                    <option value="" disabled selected>Select Slot</option>
                    <?php for ($cnt = 1; $cnt <= 10; $cnt++) {?>
                    <option value="<?php echo $cnt; ?>"
                      <?php if ($training['training_slot_sl'] == $cnt) {echo 'selected';}?>>
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
                <td>
                  <input type="text" name="prevTrainingFromDt[]" class="form-control datepicker"
                    value="<?=esc($training['training_from'])?>" required />
                </td>
                <td>
                  <input type="text" name="prevTrainingToDt[]" class="form-control datepicker"
                    value="<?=esc($training['training_to'])?>" required />
                </td>
                <td>
                  <select name="prevTrainingDepartment[]" class="form-select" required>
                    <option value="" disabled selected>Select Department</option>
                    <?php foreach ($specialities as $speciality) {?>
                    <option value="<?php echo $speciality['speciality_id']; ?>"
                      <?php if ($training['speciality_id'] == $speciality['speciality_id']) {echo 'selected';}?>>
                      <?php echo $speciality['name']; ?></option>
                    <?php }?>
                  </select>
                </td>
                <td>
                  <select name="prevTrainingInstitute[]" class="form-select" required>
                    <option value="" disabled selected>Select Institute</option>
                    <?php foreach ($institutes as $institute) {?>
                    <option value="<?php echo $institute['institute_id']; ?>"
                      <?php if ($training['training_institute_id'] == $institute['institute_id']) {echo 'selected';}?>>
                      <?php echo $institute['name']; ?></option>
                    <?php }?>
                  </select>
                </td>
                <td>
                  <select name="prevTrainingCategory[]" class="form-select" required>
                    <option value="" disabled selected>Select Training Category</option>
                    <?php foreach ($categories as $category) {?>
                    <option value="<?php echo $category['id']; ?>"
                      <?php if ($training['training_category_id'] == $category['id']) {echo 'selected';}?>>
                      <?php echo $category['training_category_title']; ?>
                    </option>
                    <?php }?>
                  </select>
                </td>
                <td>
                  <div class="form-check form-check-inline">
                    <select name="prevTrainingHonorariumTaken[]" class="form-select" required>
                      <option value="" disabled selected>Select Slot</option>
                      <option value="0" <?php if ($training['honorarium_taken'] == 0) {echo 'selected';}?>>No</option>
                      <option value="1" <?php if ($training['honorarium_taken'] == 1) {echo 'selected';}?>>
                        Yes
                      </option>
                    </select>
                  </div>
                </td>
                <td class="text-center">
                  <button type="button" onclick="removeTrainingRow(<?=esc($key + 1)?>)"
                    class="btn btn-sm btn-danger p-1">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              <?php }?>
              <!-- Dynamic rows will be inserted here -->
            </tbody>
          </table>
        </div>
        <button type="button" onclick="addTrainingRow()" class="btn btn-sm btn-success mt-2">
          <i class="fas fa-plus me-1"></i> Add Record
        </button>
      </div>
    </div>
    <div class="modal-footer d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Update</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</form>
<style>
#previousTrainingDetails {
  border: 1px solid #ffc107;
  background-color: #fffbe6;
  padding: 10px;
  margin-top: 5px;
  margin-bottom: 5px;
}
</style>
<script type="text/javascript">
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

function changeTrainigPeriod(value) {
  //var period = (parseInt(value) - 1) * 6;
  //$('#coursePeriod').val(period);

  var style = value >= 5 ? 'block' : 'none';
  document.getElementById('midTermExam').style.display = style;

  if (value >= 5) {
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

  return `
            <tr data-row-id="${id}">
                <td>
                    <input type="hidden" name="prevTrainingRecordId[]" value="" />
                    <select name="prevTrainingSlot[]" class="form-select" required>
                        <option value="" disabled selected>Select Slot</option>
                        <?php for ($cnt = 1; $cnt <= 10; $cnt++) {?>
                        <option value="<?php echo $cnt; ?>">
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
                <td>
                    <input type="text" name="prevTrainingFromDt[]" class="form-control datepicker" required />
                </td>
                <td>
                    <input type="text" name="prevTrainingToDt[]" class="form-control datepicker" required />
                </td>
                <td>
                    <select name="prevTrainingDepartment[]" class="form-select" required>
                        <option value="" disabled selected>Select Department</option>
                        <?php foreach ($specialities as $speciality) {?>
                        <option value="<?php echo $speciality['speciality_id']; ?>">
                          <?php echo $speciality['name']; ?></option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <select name="prevTrainingInstitute[]" class="form-select" required>
                        <option value="" disabled selected>Select Institute</option>
                        <?php foreach ($institutes as $institute) {?>
                        <option value="<?php echo $institute['institute_id']; ?>"><?php echo $institute['name']; ?></option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <select name="prevTrainingCategory[]" class="form-select" required>
                        <option value="" disabled selected>Select Training Category</option>
                        <?php foreach ($categories as $category) {?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['training_category_title']; ?></option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <select name="prevTrainingHonorariumTaken[]" class="form-control" required>
                        <option value="" disabled selected>Select Training Category</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" onclick="removeTrainingRow(${id})" class="btn btn-sm btn-danger p-1">
                        <i class="fas fa-trash-alt"></i>
                    </button>
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
</script>
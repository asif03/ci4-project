<form action="<?=base_url('bills/update-honorarium/' . $honorarium['id'])?>" method="post"
  enctype="multipart/form-data">
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
      <label for="name" class="col-sm-6 col-form-label">1) Name of the Trainee (In capital letters as per NID
        card):</label>
      <div class="col-sm-6">
        <label for="name" class="col-sm-6 col-form-label"><?=esc($honorarium['name'])?></label>
      </div>
    </div>
    <div class="mb-1 row">
      <label for="fcpsSpeciallity" class="col-sm-6 col-form-label">2) Specialty:</label>
      <div class="col-sm-6">
        <label for="fcpsSpeciallity" class="col-sm-6 col-form-label"><?=esc($honorarium['fcps_speciallity'])?></label>
      </div>
    </div>
    <div class="row mb-1">
      <label for="fcpsSession" class="col-sm-6 col-form-label">3) FCPS Part-I Passed Session/Year:</label>
      <div class="col-sm-3">
        <label for="fcpsSession" class="col-sm-6 col-form-label"><?=$honorarium['fcps_month']?></label>
      </div>
      <div class="col-sm-3">
        <label for="fcpsYear" class="col-sm-6 col-form-label"><?=$honorarium['fcps_year']?></label>
      </div>
    </div>
    <div class="row mb-1">
      <label for="fcpsRegNo" class="col-sm-6 col-form-label">4) BCPS Reg. No. (10 Digit after passing FCPS Part-I):
      </label>
      <div class="col-sm-6">
        <label for="fcpsRegNo" class="col-sm-6 col-form-label"><?php echo $honorarium['fcps_reg_no']; ?></label>
      </div>
    </div>
    <div class="row mb-1">
      <label for="nidNo" class="col-sm-6 col-form-label">5) National Identity Card No.: </label>
      <div class="col-sm-6">
        <label for="nidNo" class="col-sm-6 col-form-label"><?php echo $honorarium['nid']; ?></label>
      </div>
    </div>
    <div class="row mb-1">
      <label for="dob" class="col-sm-6 col-form-label">6) Date of Birth:</label>
      <div class="col-sm-6">
        <label for="dob" class="col-sm-6 col-form-label"><?php echo $honorarium['date_of_birth']; ?></label>
      </div>
    </div>
    <div class="row mb-1">
      <label for="gender" class="col-sm-6 col-form-label">7) Gender:</label>
      <div class="col-sm-6">
        <label for="gender" class="col-sm-6 col-form-label"><?=$honorarium['gander']?></label>
      </div>
    </div>
    <div class="row mb-1">
      <label for="gender" class="col-sm-6 col-form-label">8) Mobile Number (Personal): </label>
      <div class="col-sm-6">
        <label for="gender" class="col-sm-6 col-form-label"><?php echo $honorarium['mobile']; ?></label>
      </div>
    </div>
    <div class="row">
      <label for="email" class="col-sm-6 col-form-label">9) Email: </label>
      <div class="col-sm-5">
        <label for="email" class="col-sm-6 col-form-label"><?php echo $honorarium['email']; ?></label>
      </div>
    </div>
  </div>
  <div class="row mb-1 p-2">
    <div class="border border-secondary text-center fs-4 rounded-pill mb-1">Applicant's Training Information</div>
    <div class="row mb-1">
      <label for="trainingInstitute" class="col-sm-6 col-form-label">10) Institute Name:</label>
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
      <label for="department" class="col-sm-6 col-form-label">11) Department:</label>
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
      <label for="honorariumPeriod" class="col-sm-6 col-form-label">12) Period of Training: </label>
      <div class="col-sm-3">
        <select name="honorariumPeriod" id="honorariumPeriod" class="form-select" required>
          <option value="">Select Please</option>
          <?php foreach ($slots as $slot) {?>
          <option value="<?php echo $slot['id']; ?>"
            <?php if ($slot['id'] == $honorarium['honorarium_slot_id']) {echo 'selected';}?>>
            <?php echo $slot['slot_name']; ?></option>
          <?php }?>
        </select>
      </div>
      <div class="col-sm-3">
        <select name="honorariumYear" id="honorariumYear" class="form-select" required>
          <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
        </select>
      </div>
    </div>
    <div class="row mb-1">
      <label for="coursePeriod" class="col-sm-6 col-form-label">13) Total Previous Training with Course (In Month):
      </label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="coursePeriod"
          value="<?php echo $honorarium['previous_training_inmonth']; ?>" placeholder="Total number of months"
          required />
      </div>
    </div>
    <div class="row mb-1">
      <label for="honorariumPosition" class="col-sm-6 col-form-label">14) Applying for honorarium: </label>
      <div class="col-sm-6">
        <select name="honorariumPosition" id="honorariumPosition" class="form-select" required>
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
    <div class="border border-secondary text-center fs-4 rounded-pill mb-1">Applicant's Personal Bank Information
    </div>
    <div class="row mb-1">
      <label for="accountName" class="col-sm-6 col-form-label">15) Name in block letters (Online &
        Personal):</label>
      <div class="col-sm-6">
        <input type="text" name="accountName" class="form-control" placeholder="Name in block letters"
          style="text-transform:uppercase" value="<?php echo $honorarium['name']; ?>" required />
      </div>
    </div>
    <div class="row mb-1">
      <label for="bankName" class="col-sm-6 col-form-label">16) Name of the Bank: </label>
      <div class="col-sm-6">
        <select name="bankName" class="form-select" required>
          <option value="">Select Please</option>
          <?php foreach ($banks as $bank) {?>
          <option value="<?php echo $bank['id']; ?>"<?php if ($bank['id'] == $honorarium['bank_id']) {
    echo 'selected';
}?>>
            <?php echo $bank['bank_name']; ?>
          </option>
          <?php }?>
        </select>
      </div>
    </div>
    <div class="row mb-1">
      <label for="branchName" class="col-sm-6 col-form-label">17) Name of the Branch: </label>
      <div class="col-sm-6">
        <input type="text" name="branchName" value="<?php echo $honorarium['branch_name']; ?>" class="form-control" />
      </div>
    </div>
    <div class="row mb-1">
      <label for="accountNo" class="col-sm-6 col-form-label">18) Account Number (Online & Personal): </label>
      <div class="col-sm-6">
        <input type="text" name="accountNo" value="<?php echo $honorarium['account_no']; ?>" class="form-control"
          placeholder="Account Number (13 digits or above)" />
      </div>
    </div>
    <div class="row mb-1">
      <label for="accountName" class="col-sm-6 col-form-label">19) Routing Number: </label>
      <div class="col-sm-6">
        <input type="text" name="routingNumber" value="<?php echo $honorarium['routing_number']; ?>"
          class="form-control" placeholder="Routing Number" />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <label for="accountName" class="col-sm-6 col-form-label">20) A page of the Bank Cheque book of the applicant:
      </label>
      <div class="col-sm-4">
        <input type="file" name="cheque" class="form-control" />
      </div>
    </div>
  </div>
  <fieldset style="border:1px solid #000;  border-radius:5px; margin-top:10px;  padding:10px">
    <legend style="border:1px solid #000; padding:5px; font-weight:bold; border-radius:5px; font-size:20px">
      Enclosures: (The applicants have to scan and upload the following documents)</legend>
    <div class="row">
      <p class="col-sm-4">1) Recent Passport size color Photograph: </p>
      <div class="col-sm-4">
        <input type="file" name="photograph" class="form-control" /> <strong color="#FF0000"> &nbsp; <font
            color="#FF0000">
            (Resolution: 300x300 pixels, Size: below 300 kb, picture)</font></strong>
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-4">2) Applicant’s Signature: </p>
      <div class="col-sm-4">
        <input type="file" name="signature" class="form-control" /> <strong> &nbsp; <font color="#FF0000">
            (Resolution: 300x80
            pixels, Size: below
            300 kb, signature)</font></strong>
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-4">3) Provisional training certificate Signature and seal of Supervisor and Director
        (Hospital)/
        Superintendent (Hospital)/ Principal for Basic Subject: </p>
      <div class="col-sm-4">
        <input type="file" name="certificate" class="form-control" />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-4">4) National Identity Card (NID/Smart Card): </p>
      <div class="col-sm-4">
        <input type="file" name="nid_card" class="form-control" />
      </div>
    </div>
  </fieldset>
  <div class="btn-block" style="padding-top: 10px;">
    <button type="submit" class="btn btn-success">Update</button>
  </div>
</form>
<script>
$(function() {
  $('#bmdcRegValidity').datepicker({
    uiLibrary: 'bootstrap5',
    format: 'yyyy-mm-dd',
    iconsLibrary: 'fontawesome',
    icons: {
      rightIcon: '<i class="fa fa-calendar"></i>'
    },
    todayHighlight: true,
    autoclose: true,
  });

  $('#dob').datepicker({
    uiLibrary: 'bootstrap5',
    format: 'yyyy-mm-dd',
    iconsLibrary: 'fontawesome',
    icons: {
      rightIcon: '<i class="fa fa-calendar"></i>'
    },
    todayHighlight: true,
    autoclose: true,
  });
});
</script>
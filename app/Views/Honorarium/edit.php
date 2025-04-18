<form action="<?php echo base_url('staff/update_honorarium'); ?>" method="POST" enctype="multipart/form-data">
  <!-- <h2 style="text-align:center"><?php echo $title; ?></h2>
  <p style="text-align:center; font-size: 20px;">Bill of Non-Governmental Trainees Allowances (Honorarium)</p>
  <hr /> -->
  <div class="row mb-3">
    <div class="col">
      <label for="bmdcRegNo" class="form-label">BMDC Reg. No.</label>
      <input type="number" class="form-control" name="bmdc_reg_no" id="bmdcRegNo"
        value="<?php echo $honorarium['bmdc_reg_no']; ?>" placeholder="BMDC Reg. No." required />
    </div>
    <div class="col">
      <label for="bmdcRegValidity" class="form-label">BMDC Reg. Validity:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="bmdcRegValidity" id="bmdcRegValidity"
          aria-label="BMDC Reg. Validity" aria-describedby="calendar-addon2"
          value="<?php echo $honorarium['bmdc_validity']; ?>" placeholder="YYYY-MM-DD" required />
        <span class="input-group-text" id="calendar-addon2"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3">
    </div>
  </div>
  <fieldset style="border:1px solid #000;  border-radius:5px; padding:10px">
    <legend style="padding:5px; font-weight:bold; border-radius:5px; font-size:20px">General
      Information</legend>
    <div class="row">
      <p class="col-sm-4">1) Name of the Trainee (In capital letters as per NID card):</p>
      <span class="col-sm-4">
        <input type="hidden" name="applicantId" value="<?php echo $honorarium['applicant_id']; ?>" />
        <input type="hidden" name="honorariumId" value="<?php echo $honorarium['id']; ?>" />
        <input type="text" class="form-control" name="name" placeholder="Name"
          value="<?php echo $honorarium['name']; ?>" style="text-transform:uppercase" required />
      </span>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-4">2) Specialty:</p>
      <div class="col-sm-4">
        <select name="fcpsSpeciallity" class="form-control" required>
          <option value="">Select Please</option>
          <?php foreach ($speciality as $value) {?>
          <option value="<?php echo $value['name']; ?>"<?php if ($honorarium['fcps_speciallity'] == $value['name']) {
        echo 'selected';
}
    ?>>
            <?php echo $value['name']; ?></option>
          <?php }?>
        </select>
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-4">3) FCPS Part-I Passed Session/Year:</p>
      <div class="col-sm-2">
        <select name="fcpsSession" class="form-control" required>
          <option value="">Select</option>
          <option value="January"                                  <?php if ($honorarium['fcps_month'] == 'January') {
                                          echo 'selected';
                                  }
                                  ?>>January</option>
          <option value="July"                               <?php if ($honorarium['fcps_month'] == 'July') {
                                       echo 'selected';
                               }
                               ?>>July</option>
        </select>
      </div>
      <div class="col-sm-2">
        <select name="fcpsYear" class="form-control" required>
          <option value="">Select Please</option>
          <?php
              $current_year = date('Y');
              for ($year = 1990; $year <= $current_year; $year++) {
              ?>
          <option value="<?php echo $year; ?>"<?php if ($honorarium['fcps_year'] == $year) {
            echo 'selected';
    }
    ?>>
            <?php echo $year ?></option>
          <?php
              }
          ?>
        </select>
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">4) BCPS Reg. No. (10 Digit after passing FCPS Part-I): </p>
      <div class="col-sm-4">
        <input type="text" name="fcpsRegNo" value="<?php echo $honorarium['fcps_reg_no']; ?>"
          placeholder="10 Digit affer passing FCPS Part-I" class="form-control" required />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">5) National Identity Card No.: </p>
      <div class="col-sm-4">
        <input type="text" name="nidNo" placeholder="NID-17 Digits / Smart Card 10 Digits"
          value="<?php echo $honorarium['nid']; ?>" class="form-control" />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">6) Date of Birth:</p>
      <div class="col-sm-2">
        <input type="text" name="dob" id="dob" placeholder="YYYY-MM-DD"
          value="<?php echo $honorarium['date_of_birth']; ?>" class="form-control" />
      </div>
      <p class="col-sm-1">7) Gender:</p>
      <div class="col-sm-2 btn-group">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
            <?php if ($honorarium['gander'] == "Male") {echo 'checked';}?> />
          <label class="form-check-label" for="male">
            Male
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
            <?php if ($honorarium['gander'] == "Female") {echo 'checked';}?> />
          <label class="form-check-label" for="female">
            Female
          </label>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">8) Mobile Number (Personal): </p>
      <div class="col-sm-4">
        <input type="text" name="mobile" placeholder="11 Digit Mobile No." value="<?php echo $honorarium['mobile']; ?>"
          class="form-control" required />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">9) Email: </p>
      <div class="col-sm-4">
        <input type="text" name="email" placeholder="example@domainname.com" value="<?php echo $honorarium['email']; ?>"
          class="form-control" required />
      </div>
    </div>
  </fieldset>
  <div class="row g-1 border border-primary">
    <h2>Applicant's Training Information:</h2>
    <div class="row">
      <p class="col-sm-6">10) Institute Name:</p>
      <div class="col-sm-6">
        <select name="trainingInstitute" class="form-control" required>
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
    <div class="row g-3 align-items-center">
      <div class="col-5">
        <label for="department" class="col-form-label">11) Department:</label>
      </div>
      <div class="col-7">
        <input type="text" name="department" id="department" class="form-control"
          value="<?php echo $honorarium['department_name']; ?>" placeholder="Department Name" required />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">12) Period of Training: </p>
      <div class="col-sm-2">
        <select name="honorariumPeriod" id="honorariumPeriod" class="form-control" required>
          <option value="">Select Please</option>
          <?php foreach ($slots as $slot) {?>
          <option value="<?php echo $slot['id']; ?>"
            <?php if ($slot['id'] == $honorarium['honorarium_slot_id']) {echo 'selected';}?>>
            <?php echo $slot['slot_name']; ?></option>
          <?php }?>
        </select>
      </div>
      <div class="col-sm-2">

        <select name="honorariumYear" id="honorariumYear" class="form-control" required>
          <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
        </select>
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">13) Total Previous Training with Course (In Month): </p>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="coursePeriod"
          value="<?php echo $honorarium['previous_training_inmonth']; ?>" placeholder="Total number of months"
          required />
      </div>
    </div>
    <div class="row" style="margin-top: 10px">
      <p class="col-sm-5">14) Applying for honorarium: </p>
      <div class="col-sm-4">
        <select name="honorariumPosition" id="honorariumPosition" class="form-control" required>
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
    <fieldset style="border:1px solid #000;  border-radius:5px; margin-top:10px; padding:10px">
      <legend style="border:1px solid #000; padding:5px; font-weight:bold; border-radius:5px; font-size:20px">
        Applicant's Personal Bank Information:</legend>
      <div class="row">
        <p class="col-sm-4">15) Name in block letters (Online & Personal):</p>
        <div class="col-sm-4">
          <input type="text" name="accountName" class="form-control" placeholder="Name in block letters"
            style="text-transform:uppercase" value="<?php echo $honorarium['account_name']; ?>" required />
        </div>
      </div>
      <div class="row" style="margin-top: 10px">
        <p class="col-sm-4">16) Name of the Bank: </p>
        <div class="col-sm-4">
          <select name="bankName" class="form-control" required>
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
      <div class="row" style="margin-top: 10px">
        <p class="col-sm-4">17) Name of the Branch: </p>
        <div class="col-sm-4">
          <input type="text" name="branchName" value="<?php echo $honorarium['branch_name']; ?>" class="form-control" />
        </div>
      </div>
      <div class="row" style="margin-top: 10px">
        <p class="col-sm-4">18) Account Number (Online & Personal): </p>
        <div class="col-sm-4">
          <input type="text" name="accountNo" value="<?php echo $honorarium['account_no']; ?>" class="form-control"
            placeholder="Account Number (13 digits or above)" />
        </div>
      </div>
      <div class="row" style="margin-top: 10px">
        <p class="col-sm-4">19) Routing Number: </p>
        <div class="col-sm-4">
          <input type="text" name="routingNumber" value="<?php echo $honorarium['routing_number']; ?>"
            class="form-control" placeholder="Routing Number" />
        </div>
      </div>
      <div class="row" style="margin-top: 10px">
        <p class="col-sm-4">20) A page of the Bank Cheque book of the applicant: </p>
        <div class="col-sm-4">
          <input type="file" name="cheque" class="form-control" />
        </div>
      </div>
    </fieldset>
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
});
</script>
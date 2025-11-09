<?php $this->extend('layout')?>

<?php $this->section('title')?>Application<?php $this->endSection()?>

<?php $this->section('pageheader')?>
<h4 class="page-title"><?=$pageTitle?></h4>
<ul class="breadcrumbs">
  <li class="nav-home">
    <a href="dashboard">
      <i class="fas fa-home"></i>
    </a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Application</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Edit Applicant Info</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div>
  <h5 class="mb-3 fw-bold text-primary"><?=$applicant['name']?>(BMDC: <?=$applicant['bmdc_reg_no']?>/BCPS Reg.
    NO.# <?=$applicant['fcps_reg_no']?>)</h5>
  <?php if (session()->getFlashdata('error')) {?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?=session()->getFlashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php } elseif (session()->getFlashdata('success')) {?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?=session()->getFlashdata('success')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php }?>
  <?=view('_errors_list', ['errors' => session()->getFlashdata('errors')])?>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button"
        role="tab" aria-controls="home" aria-selected="true">Basic Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="fcps-tab" data-bs-toggle="tab" data-bs-target="#fcps-info" type="button" role="tab"
        aria-controls="profile" aria-selected="false">FCPS PART-I Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="mbbs-tab" data-bs-toggle="tab" data-bs-target="#mbbs-info" type="button" role="tab"
        aria-controls="contact" aria-selected="false">MBBS/BDS Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank-info" type="button" role="tab"
        aria-controls="contact" aria-selected="false">Bank Info</button>
    </li>
  </ul>

  <div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab border">
      <h6 class="text-left mb-3 fw-bold">General Information</h6>

      <form action="<?=base_url('applications/update-basic')?>" method="post">
        <?=csrf_field()?>
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="applicantId" value="<?=esc($applicant['applicant_id'])?>" />
        <div class="mb-3 row">
          <label for="name" class="col-sm-6 col-form-label">Applicant’s Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="name" id="name" placeholder="Name"
              value="<?=esc($applicant['name'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="fatherName" class="col-sm-6 col-form-label">Father’s/Spouse Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="fatherName" id="fatherName"
              placeholder="Father's Name" value="<?=esc($applicant['father_spouse_name'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="motherName" class="col-sm-6 col-form-label">Mother’s Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="motherName" id="motherName" placeholder="Name"
              value="<?=esc($applicant['mother_name'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="dob" class="col-sm-6 col-form-label">Date of birth:</label>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="text" class="form-control" name="dob" id="dob" placeholder="Select date" aria-label="Date"
                aria-describedby="calendar-addon" value="<?=esc($applicant['date_of_birth'])?>" required />
              <span class="input-group-text" id="calendar-addon">
                <i class="fa fa-calendar"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="nationality" class="col-sm-6 col-form-label">Nationality:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Nationality"
              value="<?=esc($applicant['nataionality'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="religion" class="col-sm-6 col-form-label">Religion:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="religion" id="religion" placeholder="Religion"
              value="<?=esc($applicant['religion'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="nid" class="col-sm-6 col-form-label">National ID No:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="nid" id="nid" placeholder="12345678901234"
              value="<?=esc($applicant['nid'])?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="addressOfCommunication" class="col-sm-6 col-form-label">Address of communication:</label>
          <div class="col-sm-6">
            <textarea name="addressOfCommunication" id="addressOfCommunication" class="form-control" rows="2"
              required><?=esc($applicant['address'])?></textarea>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="mobile" class="col-sm-6 col-form-label">Mobile:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="01234567890"
              value="<?=esc($applicant['mobile'])?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="telephone" class="col-sm-6 col-form-label">Tel (Res):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="01234567890"
              value="<?=esc($applicant['telephone'])?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="email" class="col-sm-6 col-form-label">E-mail:</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" name="email" id="email" placeholder="01234567890"
              value="<?=esc($applicant['email'])?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="permanentAddress" class="col-sm-6 col-form-label">Permanent Address:</label>
          <div class="col-sm-6">
            <textarea name="permanentAddress" id="permanentAddress" class="form-control" rows="2"
              required><?=esc($applicant['permanent_address'])?></textarea>
          </div>
        </div>
        <?php if (auth()->user() && auth()->user()->can('applications.basic.update')): ?>
        <button type="submit" class="btn btn-primary text-light">Update</button>
        <?php endif; ?>
      </form>
    </div>

    <div class="tab-pane fade" id="fcps-info" role="tabpanel" aria-labelledby="fcps-tab">
      <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab border">
        <h6 class="text-left mb-3 fw-bold">FCPS Part-I Information</h6>
        <form action="<?=base_url('applications/update-fcps')?>" method="post">
          <?=csrf_field()?>
          <input type="hidden" name="_method" value="PUT" />
          <input type="hidden" name="applicantId" value="<?=esc($applicant['applicant_id'])?>" />
          <div class="mb-3 row">
            <label for="fcpsYear" class="col-sm-6 col-form-label">Year of Passing:</label>
            <div class="col-sm-6">
              <select class="form-select" aria-label="Default select example" name="fcpsYear" id="fcpsYear" disabled>
                <?php for ($iLoop = date('Y'); $iLoop >= 2008; $iLoop--) {?>
                <option value="<?=$iLoop?>" <?php if ($iLoop == $applicant['fcps_year']) {echo 'selected';}?>>
                  <?=$iLoop?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="fcpsSession" class="col-sm-6 col-form-label">Session:</label>
            <div class="col-sm-6">
              <select class="form-select" aria-label="Default select example" name="fcpsSession" id="fcpsSession"
                disabled>
                <option value="January" <?php if ('January' == $applicant['fcps_month']) {echo 'selected';}?>>
                  January</option>
                <option value="July" <?php if ('July' == $applicant['fcps_month']) {echo 'selected';}?>>
                  July</option>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="specialty" class="col-sm-6 col-form-label">Specialty:</label>
            <div class="col-sm-6">
              <select class="form-select" aria-label="Default select example" name="specialty" id="specialty" disabled>
                <?php foreach ($specialities as $speciality) {?>
                <option value="<?=$speciality['name']?>"
                  <?php if ($speciality['name'] == $applicant['fcps_speciallity']) {echo 'selected';}?>>
                  <?=$speciality['name']?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="fcpcRollNo" class="col-sm-6 col-form-label">Roll No.:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="fcpcRollNo" id="fcpcRollNo" placeholder="12345678"
                value="<?=esc($applicant['fcps_roll'])?>" required />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="bcpsRegNo" class="col-sm-6 col-form-label">Online Reg. No./Reg. No. (after passing FCPS
              Part-I):</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="bcpsRegNo" id="bcpsRegNo" placeholder="10 digit reg. no."
                value="<?=esc($applicant['fcps_reg_no'])?>" />
            </div>
          </div>
          <?php if (auth()->user() && auth()->user()->can('applications.fcps.update')): ?>
          <button type="submit" class="btn btn-primary text-light">Update</button>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <div class="tab-pane fade" id="mbbs-info" role="tabpanel" aria-labelledby="mbbs-tab">
      <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab border">
        <h6 class="text-left mb-3 fw-bold">MBBS/BDS Info Update</h6>
        <form action="<?=base_url('applications/update-mbbs')?>" method="post">
          <?=csrf_field()?>
          <input type="hidden" name="_method" value="PUT" />
          <input type="hidden" name="applicantId" value="<?=esc($applicant['applicant_id'])?>" />
          <div class="mb-3 row">
            <label for="mbbsBdsYear" class="col-sm-6 col-form-label">Year of Qualification:</label>
            <div class="col-sm-6">
              <select class="form-select" aria-label="Default select example" name="mbbsBdsYear" id="mbbsBdsYear">
                <?php for ($iLoop = date('Y'); $iLoop >= 2008; $iLoop--) {?>
                <option value="<?=$iLoop?>" <?php if ($iLoop == $applicant['mbbs_bds_year']) {echo 'selected';}?>>
                  <?=$iLoop?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="specialty" class="col-sm-6 col-form-label">Institute:</label>
            <div class="col-sm-6">
              <select class="form-select" aria-label="Default select example" name="mbbsInstitute" id="mbbsInstitute"
                onchange="">
                <?php foreach ($mbbsInstitutes as $institute) {?>
                <option value="<?=$institute['institute_id']?>"
                  <?php if ($institute['institute_id'] == $applicant['mbbs_institute_id']) {echo 'selected';}?>>
                  <?=$institute['name']?></option>
                <?php }?>
              </select>

            </div>
          </div>
          <div class="mb-3 row">
            <label for="bmdcRegNo" class="col-sm-6 col-form-label">BMDC Reg. No:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="bmdcRegNo" id="bmdcRegNo" placeholder="01234567890"
                value="<?=esc($applicant['bmdc_reg_no'])?>" disabled />
            </div>
          </div>
          <?php if (auth()->user() && auth()->user()->can('applications.mbbs.update')): ?>
          <button type="submit" class="btn btn-primary text-light">Update</button>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="bank-tab">
      <div class="tab-pane fade show active" id="bank-info" role="tabpanel" aria-labelledby="basic-tab border">
        <h6 class="text-left mb-3 fw-bold">Bank Info Update</h6>
        <form action="<?=base_url('applications/update-bank')?>" method="post">
          <?=csrf_field()?>
          <input type="hidden" name="_method" value="PUT" />
          <input type="hidden" name="applicantId" value="<?=esc($applicant['applicant_id'])?>" />
          <div class="mb-3 row">
            <label for="bankName" class="col-sm-6 col-form-label">Name of the Bank:</label>
            <div class="col-sm-6">
              <select class="form-select" aria-label="Default select example" name="bankName" id="bankName" required>
                <option value="">Select Bank</option>
                <?php foreach ($banks as $bank) {?>
                <option value="<?=$bank['id']?>" <?php if ($bank['id'] == $applicant['bank_id']) {echo 'selected';}?>>
                  <?=$bank['bank_name']?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="branchName" class="col-sm-6 col-form-label">Name of the Branch:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control text-uppercase" name="branchName" id="branchName"
                placeholder="Branch Name" value="<?=esc($applicant['branch_name'])?>" required />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="acno" class="col-sm-6 col-form-label">Account Number (13 digits or above):</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="acno" id="acno" placeholder="1234563258952"
                value="<?=esc($applicant['account_no'])?>" required />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="routingNumber" class="col-sm-6 col-form-label">Name of the Branch:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="routingNumber" id="routingNumber" placeholder="012345678912"
                value="<?=esc($applicant['routing_number'])?>" required />
            </div>
          </div>
          <?php if (auth()->user() && auth()->user()->can('applications.bank.update')): ?>
          <button type="submit" class="btn btn-primary text-light">Update</button>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$(document).ready(function() {
  $('#dob').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
  });
});
</script>
<?php $this->endSection()?>
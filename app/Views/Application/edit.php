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
  <h5 class="mb-3 fw-bold"><span>Name:</span> <?=$applicant['name']?>(BMDC: <?=$applicant['bmdc_reg_no']?>/BCPS Reg.
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
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button"
        role="tab" aria-controls="home" aria-selected="true">Basic Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
        aria-controls="profile" aria-selected="false">FCPS PART-I Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab"
        aria-controls="contact" aria-selected="false">MBBS/BDS</button>
    </li>
  </ul>

  <div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="home-tab border">
      <h6 class="text-left mb-3 fw-bold">General Information</h6>
      <form action="<?=base_url('applications/update-basic')?>" method="post">
        <?=csrf_field()?>
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="applicantId" value="<?php echo $applicant['applicant_id']; ?>" />
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
              placeholder="Father's Name" value="<?php echo $applicant['father_spouse_name']; ?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="motherName" class="col-sm-6 col-form-label">Mother’s Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="motherName" id="motherName" placeholder="Name"
              value="<?php echo $applicant['mother_name']; ?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="dob" class="col-sm-6 col-form-label">Date of birth:</label>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="text" class="form-control" name="dob" id="dob" placeholder="Select date" aria-label="Date"
                aria-describedby="calendar-addon" value="<?php echo $applicant['date_of_birth']; ?>" required />
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
              value="<?php echo $applicant['nataionality']; ?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="religion" class="col-sm-6 col-form-label">Religion:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="religion" id="religion" placeholder="Religion"
              value="<?php echo $applicant['religion']; ?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="nid" class="col-sm-6 col-form-label">National ID No:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="nid" id="nid" placeholder="12345678901234"
              value="<?php echo $applicant['nid']; ?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="addressOfCommunication" class="col-sm-6 col-form-label">Address of communication:</label>
          <div class="col-sm-6">
            <textarea name="addressOfCommunication" id="addressOfCommunication" class="form-control" rows="2"
              required><?=$applicant['address']?></textarea>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="mobile" class="col-sm-6 col-form-label">Mobile:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="01234567890"
              value="<?=$applicant['mobile']?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="telephone" class="col-sm-6 col-form-label">Tel (Res):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="01234567890"
              value="<?=$applicant['telephone']?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="email" class="col-sm-6 col-form-label">E-mail:</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" name="email" id="email" placeholder="01234567890"
              value="<?=$applicant['email']?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="permanentAddress" class="col-sm-6 col-form-label">Permanent Address:</label>
          <div class="col-sm-6">
            <textarea name="permanentAddress" id="permanentAddress" class="form-control" rows="2"
              required><?=$applicant['permanent_address']?></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-primary text-light">Update</button>
      </form>
    </div>

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <h2 class="mb-3">Profile</h2>
      <p class="lead">This is the profile tab content.</p>
    </div>

    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <h2 class="mb-3">Contact</h2>
      <p class="lead">This is the contact tab content.</p>
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
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
    <a href="#">Part-I Passed Candidates</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Edit Info</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div>
  <h5 class="mb-3 fw-bold text-primary"><?=$candidate['applicant_name']?> (Pen No.:
    <?=$candidate['pen_number']?>/BCPS Reg. NO.# <?=$candidate['reg_no']?>)</h5>
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
      <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button"
        role="tab" aria-controls="home" aria-selected="true">Basic Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="fcps-tab" data-bs-toggle="tab" data-bs-target="#fcps-info" type="button" role="tab"
        aria-controls="profile" aria-selected="false">FCPS PART-I Info</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="mbbs-tab" data-bs-toggle="tab" data-bs-target="#mbbs-info" type="button" role="tab"
        aria-controls="contact" aria-selected="false">Subject Change</button>
    </li>
  </ul>
  <div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab border">
      <h6 class="text-left mb-3 fw-bold">General Information</h6>
      <form action="<?=base_url('applications/update-basic')?>" method="post">
        <?=csrf_field()?>
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="regNo" value="<?=esc($candidate['reg_no'])?>" />
        <div class="mb-3 row">
          <label for="name" class="col-sm-6 col-form-label">Applicant’s Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="name" id="name" placeholder="Name"
              value="<?=esc($candidate['applicant_name'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="fatherName" class="col-sm-6 col-form-label">Father’s Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="fatherName" id="fatherName"
              placeholder="Father's Name" value="<?=esc($candidate['father_name'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="motherName" class="col-sm-6 col-form-label">Mother’s Name (Block Letters):</label>
          <div class="col-sm-6">
            <input type="text" class="form-control text-uppercase" name="motherName" id="motherName" placeholder="Name"
              value="<?=esc($candidate['mother_name'])?>" required />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="dob" class="col-sm-6 col-form-label">Date of birth:</label>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="text" class="form-control" name="dob" id="dob" placeholder="Select date" aria-label="Date"
                aria-describedby="calendar-addon" value="<?=esc($candidate['date_of_birth'])?>" required />
              <span class="input-group-text" id="calendar-addon">
                <i class="fa fa-calendar"></i>
              </span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->endSection()?>
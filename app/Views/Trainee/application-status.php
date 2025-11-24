<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info Status<?php $this->endSection()?>
<?php $this->section('main')?>
<?php $this->section('pageStyles')?>
<style>
.main-title {
  color: #004c99;
  font-weight: 700;
  margin-bottom: 5px;
}

.sub-title {
  color: #6c757d;
  font-weight: 400;
  font-size: 1rem;
  margin-bottom: 25px;
  border-bottom: 1px solid #dee2e6;
  padding-bottom: 15px;
}

.section-header {
  color: #007bff;
  font-weight: 600;
  margin-top: 10px;
  margin-bottom: 20px;
  background-color: #f8f9fa;
  padding: 10px 15px;
  border-left: 5px solid #007bff;
  border-radius: 0.5rem;
}
</style>
<?php $this->endSection()?>
<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h3 class="main-title text-center">APPLICATION FOR TRAINING</h3>
    <p class="sub-title text-center">(Training allowances for the FCPS Part-II honorary trainees)</p>
    <div class="alert alert-danger text-center text-danger" role="alert">
      <h5><?=$message?></h5>
    </div>

    <div class="col-md-12 mt-3 rounded">
      <p class="text-warning-emphasis fw-bold mb-3">
        Training Application Information:
      </p>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-warning">
            <tr>
              <th class="text-nowrap">BMDC Reg. No.</th>
              <th class="text-nowrap">BMDC Validity</th>
              <th class="text-nowrap">BCPS Online Reg. No.</th>
              <th class="text-nowrap">Part-I Passed Session</th>
              <th class="text-nowrap">Speciality</th>
              <th class="text-center text-nowrap">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                if (isset($application) && count($application) > 0) {
                foreach ($application as $value) {?>
            <tr>
              <td class="p-2">

              </td>
              <td class="p-2">

              </td>
              <td class="p-2">

              </td>
              <td class="p-2">

              </td>
              <td class="p-2 text-center">

              </td>
              <td class="p-2 text-center">

              </td>
            </tr>
            <?php }
            } else {?>
            <tr>
              <td class="p-2 text-center" colspan="7">No Record Found.</td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
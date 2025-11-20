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
    <h3 class="main-title text-center">HONORARIUM APPLICATION</h3>
    <p class="sub-title text-center">(Bill of Non-Governmental Trainees Allowances)</p>
    <div class="alert alert-danger text-center text-danger" role="alert">
      <h5><?=$message?></h5>
    </div>

    <div class="col-md-12 mt-3 rounded">
      <p class="text-warning-emphasis fw-bold mb-3">
        Honorarium Bill Information:
      </p>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-warning">
            <tr>
              <th class="text-nowrap">Honorarium Session</th>
              <th class="text-nowrap">Taining Type</th>
              <th class="text-nowrap">Training Institute</th>
              <th class="text-nowrap">Department</th>
              <th class="text-nowrap">Previous Training (In Months)</th>
              <th class="text-nowrap">Honorarium Position</th>
              <th class="text-center text-nowrap">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($honorarium as $value) {?>
            <tr>
              <td class="p-2">
                <?=esc($value['slot_name'] . ', ' . $value['honorarium_year'])?>
              </td>
              <td class="p-2">
                <?=esc($value['training_type'])?>
              </td>
              <td class="p-2">
                <?=esc($value['training_institute_name'])?>
              </td>
              <td class="p-2">
                <?=esc($value['department_name_new'] == '' ? $value['department_name'] : $value['department_name_new'])?>
              </td>
              <td class="p-2">
                <?=esc($value['previous_training_inmonth'])?>
              </td>
              <td class="p-2">
                <?=esc($value['honorarium_position'])?>
              </td>
              <td class="p-2 d-flex justify-content-center">
                <a class="btn btn-primary btn-sm"
                  href="<?=base_url('bills/download-honorarium-form')?>/<?=esc($value['id'])?>" target="_blank"><i
                    class="fas fa-download"></i> Download</a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php $this->endSection()?>
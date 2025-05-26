<?php $this->extend('layout')?>

<?php $this->section('title')?>Honorarium<?php $this->endSection()?>

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
    <a href="#">Reports</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Bill Reports</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">Select Reporting Criteria</h4>
        <form method="post" action="<?=base_url('reports/export-bill-to-excel')?>" id="exportExcelForm">
          <?=csrf_field()?>
          <div class="mt-2 row d-flex g-2 justify-content-center align-items-center">
            <div class="form-floating col-3">
              <select class="form-select" id="honorariumYear" name="honorariumYear"
                aria-label="Floating label select example">
                <?php for ($year = date("Y"); $year >= 2024; $year--): ?>
                <option value="<?=$year?>"><?=$year?></option>
                <?php endfor?>
              </select>
              <label for="honorariumYear">Honorarium Year</label>
            </div>
            <div class="form-floating col-3">
              <select class="form-select" id="honorariumSession" name="honorariumSession"
                aria-label="Floating label select example">
                <?php foreach ($slots as $slot): ?>
                <option value="<?=$slot['id']?>"><?=$slot['slot_name']?></option>
                <?php endforeach?>
              </select>
              <label for="honorariumSession">Honorarium Slot</label>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md d-flex justify-content-center align-items-center gap-3">
              <button class="btn btn-primary" id="generateReport" onclick="generateReport()">
                <i class="fas fa-file-alt"></i> View Report
              </button>
              <button class="btn btn-primary" id="generateReport" onclick="generateReport()">
                <i class="fas fa-file-alt"></i> Generate Report
              </button>
              <button class="btn btn-success" type="submit"">
                <i class=" fas fa-file-excel"></i> Export to Excel
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
<?php $this->section('pageScripts')?>
<script>
function exportExcel() {
  var honorariumYear = $('#honorariumYear').val();
  var honorariumSession = $('#honorariumSession').val();


}
</script>
<?php $this->endSection()?>
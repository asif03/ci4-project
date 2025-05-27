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
            <div class="form-floating col-3">
              <select class="form-select" id="trainingInstitute" name="trainingInstitute"
                aria-label="Floating label select example">
                <option value="">Select a institute</option>
                <?php foreach ($institutes as $institute): ?>
                <option value="<?=$institute['institute_id']?>"><?=$institute['name']?></option>
                <?php endforeach?>
              </select>
              <label for="trainingInstitute">Training Institute Name</label>
            </div>
            <div class="form-floating col-3">
              <select class="form-select" id="eligibleStatus" name="eligibleStatus"
                aria-label="Floating label select example">
                <option value="">Select a value</option>
                <option value="P">Pending</option>
                <option value="Y">Eligible</option>
                <option value="N">Rejected</option>
              </select>
              <label for="eligibleStatus">Status</label>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md d-flex justify-content-center align-items-center gap-3">
              <!-- <button class="btn btn-primary" id="generateReport" onclick="generateReport()">
                <i class="fas fa-file-pdf"></i> View pdf Report
              </button> -->
              <button type="button" class="btn btn-primary" id="generateReport" onclick="getReportData()">
                <i class="fa fa-list" aria-hidden="true"></i> View Report Data
              </button>
              <button class="btn btn-success" type="submit"">
                <i class=" fas fa-file-excel"></i> Export to Excel
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body">
        <table id="billList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>BMDC Reg. No.</th>
              <th>Online Reg. No.</th>
              <th>Institute Name</th>
              <th>Department Name</th>
              <th>Honorarium Position</th>
              <th>Bill Sl. No.</th>
              <th>Bill Session</th>
              <th>Bill Year</th>
              <th>Eligible Status</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>BMDC Reg. No.</th>
              <th>Online Reg. No.</th>
              <th>Institute Name</th>
              <th>Department Name</th>
              <th>Honorarium Position</th>
              <th>Bill Sl. No.</th>
              <th>Bill Session</th>
              <th>Bill Year</th>
              <th>Eligible Status</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
<?php $this->section('pageScripts')?>
<script>
getReportData();

function getReportData() {

  if ($.fn.DataTable.isDataTable('#billList')) {
    $('#billList').DataTable().clear().destroy();
  }

  $('#billList').DataTable({
    "ajax": {
      "url": "<?=base_url('reports/get-bills')?>",
      "type": "POST",
      "data": function(data) {
        data.honorariumYear = $('#honorariumYear').val();
        data.honorariumSession = $('#honorariumSession').val();
        data.trainingInstitute = $('#trainingInstitute').val();
        data.eligibleStatus = $('#eligibleStatus').val();
      },
    },
    "columns": [{
        "data": "id"
      },
      {
        "data": "name"
      },
      {
        "data": "bmdc_reg_no"
      },
      {
        "data": "fcps_reg_no"
      },
      {
        "data": "training_institute_name"
      },
      {
        "data": "department_name"
      },
      {
        "data": "honorarium_position"
      },
      {
        "data": "bill_sl_no"
      },
      {
        "data": "slot_name"
      },
      {
        "data": "honorarium_year"
      },
      {
        "data": "eligible_status",
        "render": function(data, type, row) {
          if (data == 'P') {
            return `<span class="badge rounded-pill badge-warning">Pending</span>`;
          } else if (data == 'Y') {
            return `<span class="badge rounded-pill badge-success">Eligible</span>`;
          } else if (data == 'N') {
            return `<span class="badge rounded-pill badge-danger">Not Eligible</span>`;
          }
        }
      },
    ],
    "columnDefs": [{
        "target": 0,
        "visible": false,
        "searchable": false
      },
      {
        "targets": [1, 4, 5],
        "className": "dt-left"
      },
      {
        "targets": [2, 3, 6, 7, 9, 10],
        "className": "dt-center"
      },
      {
        "target": 6,
        "orderable": false,
        "searchable": false
      },
      {
        "target": 10,
        "orderable": false,
        "searchable": false
      }
    ]
  });

}
</script>
<?php $this->endSection()?>
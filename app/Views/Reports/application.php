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
    <a href="#">Application Reports</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">Select Reporting Criteria</h4>
        <form method="post" action="<?=base_url('reports/export-application-to-excel')?>" id="exportExcelForm">
          <?=csrf_field()?>
          <div class="mt-2 row d-flex g-2 justify-content-center align-items-center">
            <div class="form-floating col-3">
              <select class="form-select" id="fcpsYear" name="fcpsYear" aria-label="Floating label select example">
                <option value="">Select a value</option>
                <?php for ($year = date("Y"); $year >= 2008; $year--): ?>
                <option value="<?=$year?>"><?=$year?></option>
                <?php endfor?>
              </select>
              <label for="honorariumYear">Part-I Passed Year</label>
            </div>
            <div class="form-floating col-3">
              <select class="form-select" id="fcpsSession" name="fcpsSession"
                aria-label="Floating label select example">
                <option value="">Select a value</option>
                <option value="January">January</option>
                <option value="July">July</option>
              </select>
              <label for="eligibleStatus">Session</label>
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
        <table id="applicationList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>BMDC Reg. No.</th>
              <th>BMDC Validity</th>
              <th>Online Reg. No.</th>
              <th>Part-I Pass Year</th>
              <th>Part-I Pass Session</th>
              <th>Speciality</th>
              <th>NID</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Application Date</th>
              <th>Eligible Status</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>BMDC Reg. No.</th>
              <th>BMDC Validity</th>
              <th>Online Reg. No.</th>
              <th>Part-I Pass Year</th>
              <th>Part-I Pass Session</th>
              <th>Speciality</th>
              <th>NID</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Application Date</th>
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

  if ($.fn.DataTable.isDataTable('#applicationList')) {
    $('#applicationList').DataTable().clear().destroy();
  }

  $('#applicationList').DataTable({
    "ajax": {
      "url": "<?=base_url('reports/get-applications')?>",
      "type": "POST",
      "data": function(data) {
        data.fcpsYear = $('#fcpsYear').val();
        data.fcpsSession = $('#fcpsSession').val();
        data.eligibleStatus = $('#eligibleStatus').val();
      },
    },
    "columns": [{
        "data": "name"
      },
      {
        "data": "bmdc_reg_no"
      },
      {
        "data": "bmdc_validity"
      },
      {
        "data": "fcps_reg_no"
      },
      {
        "data": "fcps_year"
      },
      {
        "data": "fcps_month"
      },
      {
        "data": "fcps_speciallity"
      },
      {
        "data": "nid"
      },
      {
        "data": "mobile"
      },
      {
        "data": "email"
      },

      {
        "data": "created",
        "render": function(data, type, row) {
          if (data) {
            return new Date(data).toLocaleDateString('en-GB', {
              year: 'numeric',
              month: '2-digit',
              day: '2-digit'
            });
          }
        }
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
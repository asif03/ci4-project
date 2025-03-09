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
    <a href="#">Applicant Info</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">List of Applicants</h4>
      </div>
      <div class="card-body">
        <table id="applicantList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>Mother Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>Mother Name</th>
              <th>Status</th>
              <th>Action</th>
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
$('#applicantList').DataTable({
  "processing": true,
  "serverSide": true,
  "ajax": {
    "url": "<?=base_url('applications/fetch-applicants')?>",
    "type": "POST"
  },
  "columns": [{
      "data": "applicant_id"
    },
    {
      "data": "name"
    },
    {
      "data": "father_spouse_name"
    },
    {
      "data": "bank_name"
    },
    {
      "data": "eligible_status",
      "render": function(data, type, row) {
        if (data == '1') {
          return '<span class="badge badge-success">Eligible</span>';
        } else {
          return '<span class="badge badge-danger">Not Eligible</span>';
        }

        //return `<button class="btn btn-primary btn-view" data-id="${row.applicant_id}">${data}</button>`;
      }
    },
    {
      "data": null,
      "render": function(data, type, row) {
        return `<button class="btn btn-primary btn-view" data-id="${row.applicant_id}">View</button>`;
      }
    }
  ],
  "columnDefs": [{
      "target": 0,
      "visible": false,
      "searchable": false
    },
    {
      "target": 4,
      "orderable": false,
      "searchable": false
    },
    {
      "target": 5,
      "orderable": false
    }
  ]
});

// Handle click event on View button
$('#applicantList tbody').on('click', '.btn-view', function() {
  var applicantId = $(this).data('id'); // Get applicant_id from button
  alert("Applicant ID: " + applicantId);

  // Example: Redirect to applicant details page
  // window.location.href = "<?=base_url('applications/details/')?>" + applicantId;
});
</script>
<?php $this->endSection()?>
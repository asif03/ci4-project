<?php $this->extend('layout')?>

<?php $this->section('title')?><?=$title;?><?php $this->endSection()?>

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
    <a href="#">Trainee Database</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Current Trainee Database</a>
  </li>
</ul>
<?php $this->endSection()?>
<?php $this->section('main')?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">Current Trainee Database</h4>
      </div>
      <div class="card-body">
        <table id="partOneList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Session</th>
              <th>Online Reg. No.</th>
              <th>PEN No.</th>
              <th>Name</th>
              <th>Father's Name</th>
              <th>Mobile No.</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Session</th>
              <th>Online Reg. No.</th>
              <th>PEN No.</th>
              <th>Name</th>
              <th>Father's Name</th>
              <th>Mobile No.</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal For Edit Applicant -->
<div class="modal fade" id="viewApplicantModal" tabindex="-1" aria-labelledby="applicantModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="applicantModalLabel">Applicant Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewApplicantContents"></div>
    </div>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$('#partOneList').DataTable({
  "processing": true,
  "serverSide": true,
  "responsive": true,
  "ajax": {
    "url": "<?=base_url('trainings/fetch-trainees')?>",
    "dataType": "json",
    "type": "POST"
  },
  "columns": [{
      "data": "id"
    },
    {
      "data": function(data, type, row) {
        return data.fcps_part_one_session + '-' + data.fcps_part_one_year;
      }
    },
    {
      "data": "reg_no"
    },

    {
      "data": "pen_number"
    },
    {
      "data": "name"
    },
    {
      "data": "father_name"
    },
    {
      "data": "cell"
    },
    {
      "data": "email"
    },
    {
      "data": null,
      "render": function(data, type, row) {
        return `<button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewApplicantModal" onclick="loadApplicationView(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
      }
    }
  ],
  "columnDefs": [{
      "target": 0,
      "visible": false,
      "searchable": false
    },
    {
      "target": 1,
      "orderable": false,
      "searchable": false,
      "className": "dt-left"
    },
    {
      "target": 2,
      "orderable": false,
      "searchable": false,
      "className": "dt-center"
    },
    {
      "target": 6,
      "orderable": false,
      "className": "dt-center"
    },
    {
      "target": 8,
      "orderable": false,
      "className": "dt-center"
    },
  ]
});
</script>
<?php $this->endSection()?>
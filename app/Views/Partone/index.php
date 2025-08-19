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
    <a href="#">Part-I Passed Doctor's List</a>
  </li>
</ul>
<?php $this->endSection()?>
<?php $this->section('main')?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">Part-I Passed Doctors</h4>
      </div>
      <div class="card-body">
        <table id="partOneList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father</th>
              <th>Mother Name</th>
              <th>BCPS Reg. No.</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father</th>
              <th>Mother Name</th>
              <th>BCPS Reg. No.</th>
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
$('#partOneList').DataTable({
  "processing": true,
  "serverSide": true,
  "responsive": true,
  "ajax": {
    "url": "<?=base_url('fcps-part-one/fetch-candidates')?>",
    "dataType": "json",
    "type": "POST"
  },
  "columns": [{
      "data": "id"
    },
    {
      "data": "name"
    },
    {
      "data": "father_name"
    },
    {
      "data": "mother_name"
    },
    {
      "data": "reg_no"
    }
  ],
  "columnDefs": [{
      "target": 0,
      "visible": false,
      "searchable": false
    },

    {
      "target": 2,
      "orderable": false,
      "searchable": false
    },
    {
      "target": 3,
      "orderable": false,
      "searchable": false
    },
    {
      "target": 4,
      "orderable": false
    },
  ]
});
</script>
<?php $this->endSection()?>
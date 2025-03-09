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
    <a href="#">Bills</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Hohorarium Info</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">List of Applicants applied for honorarium</h4>
        <!-- <div class="d-flex gap-3">
          <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <label for="floatingSelect">Works with selects</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <label for="floatingSelect">Works with selects</label>
          </div>
        </div> -->
      </div>
      <div class="card-body">

        <table id="billList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>BMDC Reg. No.</th>
              <th>Application Session</th>
              <th>Application Year</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>BMDC Reg. No.</th>
              <th>Application Session</th>
              <th>Application Year</th>
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
$('#billList').DataTable({
  ajax: '<?php echo base_url('bills/fetch-honorariums') ?>',
  processing: true,
  serverSide: true
});
</script>
<?php $this->endSection()?>
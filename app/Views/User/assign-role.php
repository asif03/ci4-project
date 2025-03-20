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
    <a href="#">User Management</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Role Assignment</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="card-title">Set Role to a User</div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Select a User</label>
            <select class="form-select" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-action">
      <button class="btn btn-success">Submit</button>
      <button class="btn btn-danger">Cancel</button>
    </div>
  </div>
</div>
<?php $this->endSection()?>
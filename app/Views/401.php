<?php $this->extend('layout')?>
<?php $this->section('title')?>Unauthorized<?php $this->endSection()?>
<?php $this->section('main')?>
<div class="container-fluid px-4">
  <?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger fs-6 fw-bold">
    <?=session()->getFlashdata('error')?>
  </div>
  <?php endif; ?>
</div>
<?php $this->endSection()?>
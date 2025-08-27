<?php $current = current_url(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm rounded-bottom-4 mb-5 sticky-top">
  <div class="container">
    <!-- Brand/Logo -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <!-- BCPS-like logo (using SVG for simplicity), now green -->
      <img src="<?php echo base_url(); ?>public/logo.png" alt="BCPS Logo" width="50" height="50">
      <span class="ms-2 fs-3 fw-bold" style="color: #2a6135;">Bangladesh College of Physicians & Surgeons</span>
    </a>
    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navigation links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item <?=($current == base_url('/') ? 'active' : 'text-muted')?>">
          <a class="nav-link" href="<?=base_url()?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <!-- Login button -->
        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
          <a href="<?=base_url('login')?>" class="btn btn-primary btn-lg fw-bold rounded-pill shadow-sm">
            Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php $this->extend('layout')?>
<?php $this->section('title')?>Unauthorized Access<?php $this->endSection()?>
<?php $this->section('pageStyles')?>
<style>
.error-container {
  max-width: 550px;
  margin-top: 5rem;
}

.error-code {
  font-size: 8rem;
  font-weight: 900;
  color: #dc3545;
  /* Bootstrap danger red */
}

.icon-wrapper {
  background-color: #f8d7da;
  /* Light red background */
  padding: 1.5rem;
  display: inline-block;
  border-radius: 50%;
  margin-bottom: 1.5rem;
}

.main-btn {
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  border-radius: 0.5rem;
}
</style>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="container-fluid px-4 d-flex align-items-center justify-content-center">
  <!-- Error Container -->
  <div class="card shadow-lg border-0 rounded-4 error-container">
    <div class="card-body p-4 p-sm-5 text-center">

      <!-- Header Icon -->
      <div class="icon-wrapper mx-auto">
        <i class="fas fa-lock text-danger fs-1"></i>
      </div>

      <!-- 403 Code -->
      <h1 class="error-code mb-2">
        403
      </h1>

      <!-- Title and Message -->
      <h2 class="h3 fw-bold text-dark mb-3">
        Access Denied!
      </h2>
      <?php if (session()->getFlashdata('error')): ?>
      <p class="text-danger fw-bold mb-5">
        <?=session()->getFlashdata('error')?>
      </p>
      <?php else: ?>
      <p class="text-mutate mb-5">
        We're sorry, but you do not have the necessary permissions to view this resource. Your account is restricted
        from accessing this area of the dashboard.
      </p>
      <?php endif; ?>
      <!-- Action Links -->
      <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">

        <!-- Updated button to btn-success (green) -->
        <a href="<?=base_url('dashboard')?>" class="btn btn-success main-btn shadow-sm">
          <i class="fas fa-home me-2"></i>
          Go to Dashboard
        </a>

        <!-- Button to trigger the Bootstrap Modal -->
        <button type="button" class="btn btn-outline-secondary main-btn shadow-sm" data-bs-toggle="modal"
          data-bs-target="#contactModal">
          <i class="fas fa-headset me-2"></i>
          Contact Support
        </button>
      </div>
    </div>
  </div>

  <!-- Bootstrap Modal for Contact Support -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary" id="contactModalLabel">Need Assistance?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-dark">Please reach out to your system administrator or the IT team for permission issues. </p>
          <p class="fw-bold bg-light p-2 rounded text-center">Reference Code: 403-RESTRICTED</p>
        </div>
        <div class="modal-footer justify-content-center border-top-0">
          <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
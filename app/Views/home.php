<?php $this->extend('guest_layout')?>

<?php $this->section('main')?>
<!-- Hero Section -->
<section class="hero-section text-center text-md-start rounded-5 shadow-lg mx-3 mx-lg-auto mb-5 p-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <!-- Reverted title and subtitle -->
        <h1 class="display-4 fw-bold mb-3 drop-shadow">
          Empower Your Training Management.
        </h1>
        <p class="lead mb-4 opacity-75">
          A centralized platform for BCPS trainees to manage records, track progress, and collaborate seamlessly.
        </p>
        <a href="<?=base_url('login')?>" class="btn btn-light btn-lg fw-bold rounded-pill shadow-sm">
          Get Started
        </a>
      </div>
      <div class="col-lg-5 text-center mt-4 mt-lg-0">
        <!-- Placeholder Image of a progress report -->
        <img src="<?php echo base_url(); ?>public/assets/images/home-progress-report.jpg"
          class="img-fluid rounded-4 border-5 border-white shadow-custom"
          alt="A visual representation of a progress report chart">
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold text-dark">Key Features</h2>
      <p class="lead text-muted mt-3">Designed to streamline and simplify the trainee management process.</p>
    </div>
    <div class="row g-4 justify-content-center">
      <!-- Feature 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card card-feature border-0 rounded-4 shadow-sm p-4 text-center h-100">
          <div class="card-body">
            <!-- Icon, updated to green -->
            <svg xmlns="http://www.w3.org/2000/svg" class="text-green mb-3" width="64" height="64" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="card-title h5 fw-bold text-dark mb-2">Centralized Records</h3>
            <p class="card-text text-muted">Manage all trainee profiles, academic records, and professional details in
              one secure location.</p>
          </div>
        </div>
      </div>
      <!-- Feature 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card card-feature border-0 rounded-4 shadow-sm p-4 text-center h-100">
          <div class="card-body">
            <!-- Icon, updated to green -->
            <svg xmlns="http://www.w3.org/2000/svg" class="text-green mb-3" width="64" height="64" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 8v8m-4-8v8m-4-8v8M4 16h-.01M7 16h.01M10 16h.01M13 16h.01M16 16h.01M19 16h.01M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6z" />
            </svg>
            <h3 class="card-title h5 fw-bold text-dark mb-2">Progress Tracking</h3>
            <p class="card-text text-muted">Monitor training milestones, exam results, and professional development
              with ease.</p>
          </div>
        </div>
      </div>
      <!-- Feature 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card card-feature border-0 rounded-4 shadow-sm p-4 text-center h-100">
          <div class="card-body">
            <!-- Icon, updated to green -->
            <svg xmlns="http://www.w3.org/2000/svg" class="text-green mb-3" width="64" height="64" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-4m0 0a2 2 0 110-4m0 4a2 2 0 100-4m0 4a2 2 0 11-4 0m4 0a2 2 0 10-4 0m0-4a2 2 0 110-4m0 4a2 2 0 100-4M5 21V9a2 2 0 012-2h10a2 2 0 012 2v12m-7-5a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <h3 class="card-title h5 fw-bold text-dark mb-2">Advanced Reporting</h3>
            <p class="card-text text-muted">Generate powerful, data-driven reports to gain insights and make informed
              decisions.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section class="py-5">
  <div class="container text-center">
    <div class="bg-white p-5 rounded-4 shadow-sm">
      <h2 class="display-6 fw-bold text-dark mb-3">Ready to get started?</h2>
      <p class="lead text-muted mb-4">Collect your Registration No. & Password to access the platform and streamline
        your training management today.</p>
      <a href="<?=base_url('registration-no-sms')?>" class="btn btn-primary btn-lg fw-bold rounded-pill shadow-sm">
        Go ->
      </a>
    </div>
  </div>
</section>
<?php $this->endSection()?>
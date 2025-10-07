<?php $this->extend('layout')?>
<?php $this->section('title')?>Trainee Profile<?php $this->endSection()?>
<?php $this->section('pageStyles')?>
<style>
/* Profile page specific styles */
.profile-header {
  background: linear-gradient(to right, #28a745, #16a34a);
  color: white;
  padding: 3rem;
  border-radius: 1rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.profile-avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  border: 4px solid white;
  object-fit: cover;
}

.info-card {
  border: none;
  border-radius: 1rem;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.info-list .list-group-item {
  border-left: none;
  border-right: none;
  padding: 1rem;
}

.info-list .list-group-item:first-child {
  border-top: none;
}
</style>
<?php $this->endSection()?>
<?php $this->section('main')?>
<!-- Profile Page -->
<div id="profile-page" class="page-content">
  <header class="profile-header mb-4 d-flex flex-column flex-md-row align-items-center justify-content-start">
    <img src="https://placehold.co/120x120/22c55e/ffffff?text=JD" alt="User Profile"
      class="profile-avatar mb-4 mb-md-0 me-md-4">
    <div>
      <h1 class="h2 fw-bold mb-1">Asif</h1>
      <p class="lead mb-0">Trainee</p>
    </div>
  </header>

  <div class="row g-4">
    <div class="col-lg-6">
      <div class="card info-card p-4">
        <h5 class="fw-bold text-dark mb-4">Personal Information</h5>
        <ul class="list-group list-group-flush info-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Full Name</div>
            <div class="text-dark">Jane Doe</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Trainee ID</div>
            <div class="text-dark">TR-12345</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Email</div>
            <div class="text-dark">jane.doe@example.com</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Date of Birth</div>
            <div class="text-dark">Jan 1, 1995</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Phone Number</div>
            <div class="text-dark">(555) 123-4567</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Address</div>
            <div class="text-dark text-end">123 Main St, Anytown, USA 12345</div>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card info-card p-4 h-100">
        <h5 class="fw-bold text-dark mb-4">Academic Details</h5>
        <ul class="list-group list-group-flush info-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Program</div>
            <div class="text-dark">Medical Trainee Program</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Specialty</div>
            <div class="text-dark">Cardiology</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Enrollment Date</div>
            <div class="text-dark">Sep 1, 2022</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Total Courses Completed</div>
            <div class="text-dark">15</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Current GPA</div>
            <div class="text-dark">3.85</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-muted">Training Status</div>
            <div class="badge bg-success py-2 px-3">Active</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
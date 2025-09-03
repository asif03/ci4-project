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
    <a href="#">Progress Report</a>
  </li>
</ul>
<?php $this->endSection()?>
<?php $this->section('main')?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">Trainee's Progress Report</h4>
      </div>
      <div class="card-body">
        <div class="row g-4">
          <div class="col-lg-3">
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
          <div class="col-lg-9">
            <div class="card p-4 rounded-3 shadow-sm">
              <h5 class="fw-bold text-dark mb-4">Training Records</h5>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead class="bg-light rounded-top-2">
                    <tr>
                      <th scope="col" class="py-3 px-4 rounded-start">Course ID</th>
                      <th scope="col" class="py-3 px-4">Course Name</th>
                      <th scope="col" class="py-3 px-4">Institute</th>
                      <th scope="col" class="py-3 px-4">Department</th>
                      <th scope="col" class="py-3 px-4">Performance</th>
                      <th scope="col" class="py-3 px-4">Grade</th>
                      <th scope="col" class="py-3 px-4 rounded-end">Status</th>
                    </tr>
                  </thead>
                  <tbody id="portfolioTableBody">
                    <tr class="bg-white border-bottom">
                      <th scope="row" class="py-4 px-4 fw-normal text-dark">CS-101</th>
                      <td class="py-4 px-4">Cardiology Foundations</td>
                      <td class="py-4 px-4">BCPS</td>
                      <td class="py-4 px-4">Cardiology</td>
                      <td class="py-4 px-4">Att: Excellent, Knw: Excellent, Skl: Excellent, Att: Excellent</td>
                      <td class="py-4 px-4 fw-bold">A</td>
                      <td class="py-4 px-4"><span class="badge rounded-pill text-bg-success py-1 px-2">Completed</span>
                      </td>
                    </tr>
                    <tr class="bg-white border-bottom">
                      <th scope="row" class="py-4 px-4 fw-normal text-dark">NR-205</th>
                      <td class="py-4 px-4">Neurology Practices</td>
                      <td class="py-4 px-4">BCPS</td>
                      <td class="py-4 px-4">Neurology</td>
                      <td class="py-4 px-4">Att: Average, Knw: Good, Skl: Good, Att: Excellent</td>
                      <td class="py-4 px-4 fw-bold">B+</td>
                      <td class="py-4 px-4"><span class="badge rounded-pill text-bg-success py-1 px-2">Completed</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection()?>
<?php $this->extend('layout')?>
<?php $this->section('pageStyles')?>
<style>
.card-icon {
  font-size: 3.5rem;
  color: #28a745;
  transition: transform 0.3s ease;
}

.summary-card:hover .card-icon {
  transform: scale(1.1);
}

.progress-bar-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 8px;
  height: 150px;
  /* Fixed height for the chart area */
}

.progress-bar-stack {
  width: 20%;
  background-color: #d1d5db;
  /* A custom light gray */
  border-radius: 4px;
  transition: all 0.5s ease-in-out;
  display: flex;
  flex-direction: column-reverse;
  position: relative;
}

.progress-bar-fill {
  background-color: #22c55e;
  /* A custom green for the bar fill */
  width: 100%;
  transition: height 0.5s ease-in-out;
  border-radius: 4px;
}

.progress-bar-label {
  position: absolute;
  top: -24px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 0.875rem;
  color: #4b5563;
  /* A custom dark gray */
}
</style>
<?php $this->endSection()?>

<?php $this->section('title')?>Dashboard<?php $this->endSection()?>

<?php $this->section('main')?>
<!-- Dashboard Header -->
<header class="d-flex align-items-center justify-content-between p-4 bg-white rounded-3 shadow-sm mb-4">
  <div>
    <h1 class="h3 fw-bold text-dark">Dashboard</h1>
    <p class="text-muted mt-1 mb-0">Welcome back, Jane Doe!</p>
  </div>
  <div class="d-flex align-items-center">
    <div class="text-end me-3">
      <div class="fw-semibold text-dark">Jane Doe</div>
      <div class="text-muted small">Trainee</div>
    </div>
    <img src="https://placehold.co/40x40/22c55e/ffffff?text=J" alt="User Profile" class="rounded-circle">
  </div>
</header>
<!-- Summary Cards Section -->
<section class="row g-4 mb-4">
  <div class="col-12 col-md-6 col-lg-3">
    <div class="card p-4 rounded-3 shadow-sm summary-card h-80">
      <div class="card-body p-0">
        <div class="d-flex align-items-center">
          <div class="p-3 rounded-circle bg-success-subtle text-success me-3">
            <i class="fas fa-book-reader card-icon"></i>
          </div>
          <div>
            <div class="text-muted small fw-semibold">Progress Report Submitted</div>
            <div class="fs-2 fw-bold text-dark">4</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="row g-4 mb-4">
  <!-- Progress Chart Panel -->
  <div class="col-lg-12">
    <div class="card p-4 rounded-3 shadow-sm h-100">
      <h5 class="fw-bold text-dark mb-4">My Progress</h5>
      <!-- Flex container for the graph and scale -->
      <div class="d-flex align-items-start">
        <!-- Progress Bars -->
        <div class="progress-bar-container w-75">
          <div class="progress-bar-stack" style="height: 65%;">
            <div class="progress-bar-fill" style="height: 100%;"></div>
            <span class="progress-bar-label">65%</span>
          </div>
          <div class="progress-bar-stack" style="height: 80%;">
            <div class="progress-bar-fill" style="height: 100%;"></div>
            <span class="progress-bar-label">80%</span>
          </div>
          <div class="progress-bar-stack" style="height: 50%;">
            <div class="progress-bar-fill" style="height: 100%;"></div>
            <span class="progress-bar-label">50%</span>
          </div>
          <div class="progress-bar-stack" style="height: 90%;">
            <div class="progress-bar-fill" style="height: 100%;"></div>
            <span class="progress-bar-label">90%</span>
          </div>
          <div class="progress-bar-stack" style="height: 75%;">
            <div class="progress-bar-fill" style="height: 100%;"></div>
            <span class="progress-bar-label">75%</span>
          </div>
        </div>
        <!-- Progress Scale Legend -->
        <div class="ms-4">
          <h6 class="fw-semibold text-dark mb-2">Progress Scale:</h6>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex align-items-center py-2 px-0 border-0">
              <div class="me-2" style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 4px;"></div>
              <div class="fw-normal text-muted">Attendance</div>
            </li>
            <li class="list-group-item d-flex align-items-center py-2 px-0 border-0">
              <div class="me-2" style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 4px;"></div>
              <div class="fw-normal text-muted">Class Participation</div>
            </li>
            <li class="list-group-item d-flex align-items-center py-2 px-0 border-0">
              <div class="me-2" style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 4px;"></div>
              <div class="fw-normal text-muted">Assignment Completion</div>
            </li>
            <li class="list-group-item d-flex align-items-center py-2 px-0 border-0">
              <div class="me-2" style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 4px;"></div>
              <div class="fw-normal text-muted">Project Performance</div>
            </li>
            <li class="list-group-item d-flex align-items-center py-2 px-0 border-0">
              <div class="me-2" style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 4px;"></div>
              <div class="fw-normal text-muted">Clinical Behavior</div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Personal Records Table Panel -->
<section class="mb-4">
  <div class="card p-4 rounded-3 shadow-sm">
    <h5 class="fw-bold text-dark mb-4">Academic Records</h5>
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="bg-light rounded-top-2">
          <tr>
            <th scope="col" class="py-3 px-4 rounded-start">Course ID</th>
            <th scope="col" class="py-3 px-4">Course Name</th>
            <th scope="col" class="py-3 px-4">Instructor</th>
            <th scope="col" class="py-3 px-4">Grade</th>
            <th scope="col" class="py-3 px-4 rounded-end">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-bottom">
            <th scope="row" class="py-4 px-4 fw-normal text-dark">CS-101</th>
            <td class="py-4 px-4">Cardiology Foundations</td>
            <td class="py-4 px-4">Dr. P. Khan</td>
            <td class="py-4 px-4 fw-bold">A</td>
            <td class="py-4 px-4"><span class="badge rounded-pill text-bg-success py-1 px-2">Completed</span></td>
          </tr>
          <tr class="bg-white border-bottom">
            <th scope="row" class="py-4 px-4 fw-normal text-dark">NR-205</th>
            <td class="py-4 px-4">Neurology Practices</td>
            <td class="py-4 px-4">Dr. A. Chowdhury</td>
            <td class="py-4 px-4 fw-bold">B+</td>
            <td class="py-4 px-4"><span class="badge rounded-pill text-bg-success py-1 px-2">Completed</span></td>
          </tr>
          <tr class="bg-white border-bottom">
            <th scope="row" class="py-4 px-4 fw-normal text-dark">PD-310</th>
            <td class="py-4 px-4">Pediatric Care</td>
            <td class="py-4 px-4">Dr. M. Akter</td>
            <td class="py-4 px-4 fw-bold">A-</td>
            <td class="py-4 px-4"><span class="badge rounded-pill text-bg-success py-1 px-2">Completed</span></td>
          </tr>
          <tr class="bg-white border-bottom">
            <th scope="row" class="py-4 px-4 fw-normal text-dark">SR-401</th>
            <td class="py-4 px-4">Advanced Surgical Techniques</td>
            <td class="py-4 px-4">Dr. R. Hussain</td>
            <td class="py-4 px-4 fw-bold">N/A</td>
            <td class="py-4 px-4"><span class="badge rounded-pill text-bg-info py-1 px-2">In Progress</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php $this->endSection()?>
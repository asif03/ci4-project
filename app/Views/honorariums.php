<?php $this->extend('guest_layout')?>
<?php $this->section('pageStyles')?>
<style>
:root {
  --primary-color: #2a6135;
  /* Deep blue for BCPS branding */
  --secondary-color: #007bff;
  --success-color: #198754;
  --light-bg: #f8f9fa;
}

/* Adjust DataTables elements */
.dataTables_wrapper .row:first-child,
.dataTables_wrapper .row:last-child {
  padding: 1rem 0.5rem;
}

.table thead th {
  background-color: var(--primary-color) !important;
  color: white;
  border-bottom: 2px solid #0056b3;
  cursor: pointer;
  /* Indicate sortable column */
}

.table-responsive {
  border-radius: 10px;
}

/* Custom styles for the instruction section */
.instruction-card {
  background-color: #e9f7ff;
  border-left: 5px solid var(--primary-color);
}

.instruction-card h5 {
  color: var(--primary-color);
  font-weight: 700;
}

.instruction-step {
  display: flex;
  align-items: flex-start;
  margin-bottom: 15px;
}

.step-icon {
  flex-shrink: 0;
  width: 30px;
  height: 30px;
  background-color: var(--success-color);
  color: white;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  margin-right: 15px;
}

.status-badge {
  font-size: 0.85em;
  padding: 0.5em 0.8em;
  border-radius: 8px;
  font-weight: 600;
}

.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
  border-radius: 8px;
  transition: transform 0.2s;
}

.btn-primary:hover {
  transform: translateY(-1px);
}

/* Custom Link Hover Effect */
.link-item {
  transition: background-color 0.2s, transform 0.2s;
}

.link-item:hover {
  transform: translateX(3px);
  background-color: var(--bs-light);
}

/* Mobile adjustments */
@media (max-width: 991.98px) {
  .instruction-card {
    margin-top: 20px;
  }
}
</style>
<?php $this->endSection()?>
<?php $this->section('main')?>
<div class="container">
  <div class="row">
    <!-- APPLICATION LIST VIEW (Main Content) -->
    <div class="col-lg-8">
      <div class="card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title mb-0">List of Honorarium Bill Submitted</h4>
          <a href="<?=base_url('login')?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-2"></i> Apply for Bill
          </a>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle" id="honorariumTable">
            <thead>
              <tr>
                <th>Sl.</th>
                <th>BMDC Reg. NO.</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th>Department</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bills as $key => $bill) {?>
              <tr>
                <th><?=esc(++$key)?>.</th>
                <td><?php echo $bill['bmdc_reg_no']; ?></td>
                <td><?php echo $bill['name']; ?></td>
                <td><?php echo strtoupper($bill['father_spouse_name']); ?></td>
                <td><?php echo $bill['department_name']; ?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- INSTRUCTIONS & GUIDELINES -->
    <div class="col-lg-4">
      <div class="row g-2">
        <div class="card p-4 instruction-card">


          <div class="d-flex align-items-center mb-4">
            <!-- Lucide Icon for Links -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="me-3 text-primary">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.74 1.74" />
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
            </svg>
            <h2 class="h6 card-title fw-bold mb-0">Important Links & Docs</h2>
          </div>

          <div class="d-grid gap-2">
            <a href="#link-hr-policy"
              class="link-item d-flex justify-content-between align-items-center p-2 rounded-3 text-decoration-none border">
              <span class="text-primary fw-medium small">HR Policy Manual (PDF)</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-primary">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>

            <a href="#link-travel-form"
              class="link-item d-flex justify-content-between align-items-center p-2 rounded-3 text-decoration-none border">
              <span class="text-primary fw-medium small">Travel Reimbursement Form</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-primary">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>

            <a href="#link-expense-guide"
              class="link-item d-flex justify-content-between align-items-center p-2 rounded-3 text-decoration-none border">
              <span class="text-primary fw-medium small">Monthly Expense Guide</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-primary">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>



        </div>
        <div class="card p-4 instruction-card">
          <h5 class="mb-3"><i class="fas fa-clipboard-list me-2"></i> Honorarium Bill Form Submission Guide</h5>
          <p class="text-muted small">Follow these steps to ensure your application is processed without delay.</p>

          <div class="instruction-step">
            <div class="step-icon">1</div>
            <div>
              <strong>Login to the portal</strong>
              <p class="mb-0 small text-muted">Use your 10-digit Registration Number & Password to log in.
                <a href="<?=base_url('login')?>">Click here</a> for login. If forgot Registration Number & Password,
                <a href="<?=base_url('registration-no-sms')?>">Click here</a> for recovery. After successful login,
                follow
                the remaining steps.
              </p>
            </div>
          </div>

          <div class="instruction-step">
            <div class="step-icon">2</div>
            <div>
              <strong>Honorarium Details</strong>
              <p class="mb-0 small text-muted">Select the correct <strong>Training Type</strong> (Core/Advance),
                <strong>Honorarium Period</strong>, <strong>Institute</strong> and <strong>Department</strong> relevant
                to
                the claim.
              </p>
            </div>
          </div>

          <div class="instruction-step">
            <div class="step-icon">3</div>
            <div>
              <strong>Banking Information</strong>
              <p class="mb-0 small text-muted">Enter the <strong>Bank Name</strong>, <strong>Branch Name</strong>,
                <strong>Account Number</strong>, and <strong>Routing Number</strong> accurately. Errors here will cause
                payment failure.
              </p>
            </div>
          </div>

          <div class="instruction-step">
            <div class="step-icon">4</div>
            <div>
              <strong>Upload Required Enclosures</strong>
              <p class="mb-0 small text-muted">Upload all files (e.g., Provisional training certificate, NID, Bank
                Cheque
                book). Ensure files are clear and under the maximum size limit.</p>
              <ul>
                <li class="small text-muted">Enclosure 1: Provisional training certificate (Max 300KB, PDF/JPG)</li>
                <li class="small text-muted">Enclosure 2: Bank Cheque book/Bank Statement (Max 300KB, PDF/JPG)</li>
                <li class="small text-muted">Enclosure 3: National Identity Card (Max 300KB, PDF/JPG)</li>
              </ul>
            </div>
          </div>

          <div class="instruction-step">
            <div class="step-icon">5</div>
            <div>
              <strong>Final Submission</strong>
              <p class="mb-0 small text-muted">Review the generated preview document thoroughly before clicking the
                final
                **Confirm Submission** button.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php $this->endSection()?>

  <?php $this->section('pageScripts')?>
  <script>
  $(document).ready(function() {
    // DataTables Initialization
    $('#honorariumTable').DataTable({
      // Configuration options
      paging: true, // Enable pagination
      lengthChange: true, // Allow changing number of rows per page
      searching: true, // Enable search box
      ordering: true, // Enable column ordering (sorting)
      info: true, // Show table information (e.g., Showing 1 to 10 of 20 entries)
      responsive: true, // Make table responsive (if needed, though Bootstrap handles much of this)
      language: {
        paginate: {
          next: 'Next &raquo;',
          previous: '&laquo; Previous'
        },
        search: "Filter Records:",
        lengthMenu: "Show _MENU_ entries"
      },
      // Initial sort by Date Submitted (column index 1) in descending order
      order: [
        [0, 'asc']
      ]
    });
  });
  </script>
  <?php $this->endSection()?>
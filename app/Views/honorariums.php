<?php $this->extend('guest_layout')?>
<?php $this->section('pageStyles')?>
<style>
/* Adjust DataTables elements */
.dataTables_wrapper .row:first-child,
.dataTables_wrapper .row:last-child {
  padding: 1rem 0.5rem;
}

.table thead th {
  background-color: var(--primary-color);
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
  <h3 class="text-center">Honorarium Application</h3>
  <div class="row">
    <!-- APPLICATION LIST VIEW (Main Content) -->
    <div class="col-lg-8">
      <div class="card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title mb-0">My Honorarium Claims</h4>
          <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#applicationModal">
            <i class="fas fa-plus-circle me-2"></i> New Application
          </button>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle" id="honorariumTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Date Submitted</th>
                <th>Training Type</th>
                <th>Period/Year</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Mock Data Rows for Pagination/Search Testing -->
              <tr>
                <td>HBL-00124</td>
                <td>2024-10-15</td>
                <td>Core</td>
                <td>2025/Period 2</td>
                <td><span class="badge bg-success status-badge">Approved</span></td>
                <td><button class="btn btn-sm btn-outline-primary" disabled><i class="fas fa-eye"></i> View</button>
                </td>
              </tr>
              <tr>
                <td>HBL-00125</td>
                <td>2024-11-01</td>
                <td>Non-Core</td>
                <td>2024/Period 1</td>
                <td><span class="badge bg-warning text-dark status-badge">Pending Review</span></td>
                <td><button class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i> Edit</button></td>
              </tr>
              <tr>
                <td>HBL-00126</td>
                <td>2024-11-20</td>
                <td>Core</td>
                <td>2025/Period 1</td>
                <td><span class="badge bg-danger status-badge">Rejected</span></td>
                <td><button class="btn btn-sm btn-outline-danger"><i class="fas fa-redo-alt"></i> Re-submit</button>
                </td>
              </tr>
              <tr>
                <td>HBL-00127</td>
                <td>2024-11-25</td>
                <td>Core</td>
                <td>2025/Period 2</td>
                <td><span class="badge bg-info text-dark status-badge">Submitted</span></td>
                <td><button class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i> Edit</button></td>
              </tr>
              <tr>
                <td>HBL-00128</td>
                <td>2024-09-10</td>
                <td>Non-Core</td>
                <td>2024/Period 2</td>
                <td><span class="badge bg-success status-badge">Approved</span></td>
                <td><button class="btn btn-sm btn-outline-primary" disabled><i class="fas fa-eye"></i> View</button>
                </td>
              </tr>
              <tr>
                <td>HBL-00129</td>
                <td>2024-08-05</td>
                <td>Core</td>
                <td>2024/Period 1</td>
                <td><span class="badge bg-warning text-dark status-badge">Pending Review</span></td>
                <td><button class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i> Edit</button></td>
              </tr>
              <tr>
                <td>HBL-00130</td>
                <td>2024-07-28</td>
                <td>Core</td>
                <td>2024/Period 1</td>
                <td><span class="badge bg-success status-badge">Approved</span></td>
                <td><button class="btn btn-sm btn-outline-primary" disabled><i class="fas fa-eye"></i> View</button>
                </td>
              </tr>
              <tr>
                <td>HBL-00131</td>
                <td>2024-06-12</td>
                <td>Non-Core</td>
                <td>2023/Period 4</td>
                <td><span class="badge bg-danger status-badge">Rejected</span></td>
                <td><button class="btn btn-sm btn-outline-danger"><i class="fas fa-redo-alt"></i> Re-submit</button>
                </td>
              </tr>
              <tr>
                <td>HBL-00132</td>
                <td>2024-05-01</td>
                <td>Core</td>
                <td>2023/Period 4</td>
                <td><span class="badge bg-info text-dark status-badge">Submitted</span></td>
                <td><button class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i> Edit</button></td>
              </tr>
              <tr>
                <td>HBL-00133</td>
                <td>2024-04-22</td>
                <td>Non-Core</td>
                <td>2023/Period 3</td>
                <td><span class="badge bg-success status-badge">Approved</span></td>
                <td><button class="btn btn-sm btn-outline-primary" disabled><i class="fas fa-eye"></i> View</button>
                </td>
              </tr>
              <tr>
                <td>HBL-00134</td>
                <td>2024-03-18</td>
                <td>Core</td>
                <td>2023/Period 3</td>
                <td><span class="badge bg-warning text-dark status-badge">Pending Review</span></td>
                <td><button class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i> Edit</button></td>
              </tr>
              <tr>
                <td>HBL-00135</td>
                <td>2024-02-05</td>
                <td>Core</td>
                <td>2023/Period 2</td>
                <td><span class="badge bg-success status-badge">Approved</span></td>
                <td><button class="btn btn-sm btn-outline-primary" disabled><i class="fas fa-eye"></i> View</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>


      </div>
    </div>
    <!-- INSTRUCTIONS & GUIDELINES -->
    <div class="col-lg-4">
      <div class="card p-4 instruction-card">
        <h5 class="mb-3"><i class="fas fa-clipboard-list me-2"></i> Honorarium Form Submission Guide</h5>
        <p class="text-muted small">Follow these steps to ensure your application is processed without delay.</p>

        <div class="instruction-step">
          <div class="step-icon">1</div>
          <div>
            <strong>Personal & Training Data</strong>
            <p class="mb-0 small text-muted">Verify your NID, BMDC Validity Date (must be current), and contact details
              (Mobile/Email).</p>
          </div>
        </div>

        <div class="instruction-step">
          <div class="step-icon">2</div>
          <div>
            <strong>Honorarium Details</strong>
            <p class="mb-0 small text-muted">Select the correct <strong>Training Type</strong> (Core/Non-Core),
              <strong>Honorarium Period</strong>, and <strong>Department</strong> relevant to the claim.
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
            <p class="mb-0 small text-muted">Upload all files (e.g., Joining Letter, Completion Certificate, Bank
              Statement). Ensure files are clear and under the maximum size limit.</p>
            <ul>
              <li class="small text-muted">Enclosure 1: NID/Passport (Max 2MB, PDF/JPG)</li>
              <li class="small text-muted">Enclosure 2: BMDC Certificate (Max 2MB, PDF/JPG)</li>
              <li class="small text-muted">Enclosure 3: Training Completion Proof (Max 5MB, PDF)</li>
            </ul>
          </div>
        </div>

        <div class="instruction-step">
          <div class="step-icon">5</div>
          <div>
            <strong>Final Submission</strong>
            <p class="mb-0 small text-muted">Review the generated preview document thoroughly before clicking the final
              **Confirm Submission** button.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php $this->endSection()?>

  <?php $this->section('pageScripts')?>
  <script>
  $(document).ready(function() {
    alert('This is a demo version of the Honorarium Application system. Submissions will not be processed.');
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
        [1, 'desc']
      ]
    });
    console.log('Honorarium Dashboard and DataTables Initialized.');
  });
  </script>
  <?php $this->endSection()?>
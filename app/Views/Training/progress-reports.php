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
    <a href="<?php echo base_url('trainings/trainee-list'); ?>">Progress Reports</a>
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
                  <div class="text-dark"><?=esc($traineeDetails['applicant_name'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Reg. No.:</div>
                  <div class="text-dark"><?=esc($traineeDetails['reg_no'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Father's Name:</div>
                  <div class="text-dark"><?=esc($traineeDetails['father_name'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Mother's Name:</div>
                  <div class="text-dark"><?=esc($traineeDetails['mother_name'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Date of Birth</div>
                  <div class="text-dark"><?=esc($traineeDetails['date_of_birth'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Email</div>
                  <div class="text-dark"><?=esc($traineeDetails['email'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Phone Number</div>
                  <div class="text-dark"><?=esc($traineeDetails['cell'])?></div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="fw-semibold text-muted">Present Address</div>
                  <div class="text-dark text-end"><?=esc($traineeDetails['present_address'])?></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="card p-4 rounded-3 shadow-sm">
              <h5 class="fw-bold text-dark mb-4">Training Records</h5>
              <div class="table-responsive">
                <table class="table table-hover mb-0" id="tblProgressReport">
                  <thead class="bg-light rounded-top-2">
                    <tr>
                      <th scope="col" class="py-2 px-2 rounded-start">SL</th>
                      <th scope="col" class="py-2 px-2">Training Institute</th>
                      <th scope="col" class="py-2 px-2">Department</th>
                      <th scope="col" class="py-2 px-2">Training Period</th>
                      <th scope="col" class="py-2 px-2 text-center">Duration (in months)</th>
                      <th scope="col" class="py-2 px-2 text-center">Status</th>
                      <th scope="col" class="py-2 px-2 text-center">Report Submitted?</th>
                      <th scope="col" class="py-2 px-2 rounded-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($progressReports !== []): ?>
                    <?php foreach ($progressReports as $index => $progressReport): ?>
                    <tr class="bg-white border-bottom">
                      <th scope="row" class="py-4 px-4 fw-normal text-dark"><?=esc($index + 1)?></th>
                      <td class="py-4 px-4">
                        <?php if ($progressReport['training_institute_id'] != null): ?>
                        <?=esc($progressReport['training_institute_name'])?>
                        <?php else: ?>
                        <?=esc($progressReport['institute_p2_training'])?>
                        <?php endif; ?></td>
                      <td class="py-4 px-4">
                        <?php if ($progressReport['department_id'] != null): ?>
                        <?=esc($progressReport['department_name'])?>
                        <?php else: ?>
                        <?=esc($progressReport['supervisor_department'])?>
                        <?php endif; ?>
                      </td>
                      <td class="py-4 px-4"><?=esc($progressReport['training_start_date'])?> to
                        <?=esc($progressReport['training_end_date'])?></td>
                      <td class="py-4 px-4 text-center"><?=esc($progressReport['countable_duration_month'])?></td>
                      <td class="py-4 px-4 text-center">
                        <?php if ($progressReport['training_accepted'] == true): ?>
                        <span class="badge rounded-pill bg-success text-white py-1 px-2">Accepted</span>
                        <?php else: ?>
                        <span class="badge rounded-pill bg-warning text-white py-1 px-2">Pending</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if ($progressReport['progress_report_received'] == true): ?>
                        <span class="badge rounded-pill bg-success text-white py-1 px-2">Yes</span>
                        <?php else: ?>
                        <span class="badge rounded-pill bg-danger text-white py-1 px-2">No</span>
                        <?php endif; ?>
                      </td>
                      <td class="py-2 px-2">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewTrainingModal"
                            onclick="loadReporDetailsView(<?=esc($progressReport['id'])?>)"><i class="fa fa-eye"
                              aria-hidden="true"></i></button>
                          <?php if ($progressReport['training_accepted'] != true): ?>
                          <button class="btn btn-success font-weight-bold btn-approve btn-sm"
                            data-id="<?=esc($progressReport['id'])?>"><i class="fas fa-check-circle"></i>
                            Approve</button>
                          <?php endif; ?>
                          <?php if ($progressReport['progress_report_received'] != true): ?>
                          <button class="btn btn-success font-weight-bold btn-report-submit btn-sm"
                            data-id="<?=esc($progressReport['id'])?>"><i class="fas fa-check-circle"></i>
                            Report Received</button>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach?>
                    <?php else: ?>
                    <tr class="bg-white border-bottom">
                      <th scope="row" class="py-4 px-4 fw-normal text-dark text-center" colspan="8">No record found!
                      </th>
                    </tr>
                    <?php endif?>
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
<!-- Details Modal -->
<div class="modal fade" id="viewTrainingModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-3">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="detailsModalLabel">Training Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4" id="viewProgressReportContents"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
<?php $this->section('pageScripts')?>
<script>
function loadReporDetailsView(reportId) {
  $.ajax({
    type: 'GET',
    url: '<?php echo base_url(); ?>trainings/fetch-progress-report/' + reportId,
    success: function(response) {
      $('#viewProgressReportContents').html(response);
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
}

// Handle click event on View button
$('#tblProgressReport tbody').on('click', '.btn-approve', function() {
  var reportId = $(this).data('id');

  Swal.fire({
    title: "Are you sure to Approve?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes"
  }).then((result) => {
    if (result.isConfirmed) {

      // AJAX request
      $.ajax({
        url: '<?=base_url('trainings/approve-progress-report')?>',
        type: 'POST',
        data: {
          reportId: reportId
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == 'success') {
            Swal.fire({
              title: "Approved!",
              text: response.message,
              icon: "success"
            });
            setTimeout(function() {
              window.location.reload(true);
            }, 1000);
          } else {
            Swal.fire({
              title: "Error!",
              text: response.message,
              icon: "error"
            });
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    }
  });
});

// Handle click event on View button
$('#tblProgressReport tbody').on('click', '.btn-report-submit', function() {
  var reportId = $(this).data('id');

  Swal.fire({
    title: "Are you sure to Receive Report?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes"
  }).then((result) => {
    if (result.isConfirmed) {

      // AJAX request
      $.ajax({
        url: '<?=base_url('trainings/receive-progress-report')?>',
        type: 'POST',
        data: {
          reportId: reportId
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == 'success') {
            Swal.fire({
              title: "Received!",
              text: response.message,
              icon: "success"
            });
            setTimeout(function() {
              window.location.reload(true);
            }, 1000);
          } else {
            Swal.fire({
              title: "Error!",
              text: response.message,
              icon: "error"
            });
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    }
  });
});
</script>
<?php $this->endSection()?>
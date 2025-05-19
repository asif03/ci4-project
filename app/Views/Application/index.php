<?php $this->extend('layout')?>

<?php $this->section('title')?>Application<?php $this->endSection()?>

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
    <a href="#">Application</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Applicant Info</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="row row-card-no-pd">
  <div class="col-12 col-sm-6 col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6><b>Total Application</b></h6>
            <p class="text-muted">Applied applicants</p>
          </div>
          <h4 class="text-info fw-bold"><?=$statistics['totalApplications'];?></h4>
        </div>
        <div class="progress progress-sm">
          <div class="progress-bar bg-info w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <p class="text-muted mb-0">Change</p>
          <p class="text-muted mb-0">100%</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6><b>Total Pending Applications</b></h6>
            <p class="text-muted">Pending verification</p>
          </div>
          <h4 class="text-warning fw-bold"><?=$statistics['totalPendingApplications'];?></h4>
        </div>
        <div class="progress progress-sm">
          <div class="progress-bar bg-warning"
            style="width: <?=round($statistics['totalPendingApplications'] / $statistics['totalApplications'] * 100);?>%"
            role="progressbar"
            aria-valuenow="<?=round($statistics['totalPendingApplications'] / $statistics['totalApplications'] * 100);?>"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <p class="text-muted mb-0">Change</p>
          <p class="text-muted mb-0">
            <?=round($statistics['totalPendingApplications'] / $statistics['totalApplications'] * 100);?>%</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6><b>Total Eligible Applications</b></h6>
            <p class="text-muted">Verified Applicants</p>
          </div>
          <h4 class="text-success fw-bold"><?=$statistics['totalVerifiedApplications'];?></h4>
        </div>
        <div class="progress progress-sm">
          <div class="progress-bar bg-success"
            style="width: <?=round($statistics['totalVerifiedApplications'] / $statistics['totalApplications'] * 100);?>%"
            role="progressbar"
            aria-valuenow="<?=round($statistics['totalVerifiedApplications'] / $statistics['totalApplications'] * 100);?>"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <p class="text-muted mb-0">Change</p>
          <p class="text-muted mb-0">
            <?=round($statistics['totalVerifiedApplications'] / $statistics['totalApplications'] * 100);?>%</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6><b>Total Rejected Applications</b></h6>
            <p class="text-muted">Varification failed applicants</p>
          </div>
          <h4 class="text-danger fw-bold"><?=$statistics['totalRejectedApplications'];?></h4>
        </div>
        <div class="progress progress-sm">
          <div class="progress-bar bg-danger"
            style="width: <?=round($statistics['totalRejectedApplications'] / $statistics['totalApplications'] * 100);?>%"
            role="progressbar"
            aria-valuenow="<?=round($statistics['totalRejectedApplications'] / $statistics['totalApplications'] * 100);?>"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <p class="text-muted mb-0">Change</p>
          <p class="text-muted mb-0">
            <?=round($statistics['totalRejectedApplications'] / $statistics['totalApplications'] * 100);?>%</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">List of Applicants</h4>
      </div>
      <div class="card-body">
        <table id="applicantList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>Mother Name</th>
              <th>BMDC Reg. No.</th>
              <th>Continuing Training?</th>
              <th>Files</th>
              <th>Eligible Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>Mother Name</th>
              <th>BMDC Reg. No.</th>
              <th>Continuing Training?</th>
              <th>Files</th>
              <th>Eligible Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalContents"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal For Edit Applicant -->
<div class="modal fade" id="editApplicationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Applicant Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewApplicantEditContents"></div>
    </div>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$('#applicantList').DataTable({
  "processing": true,
  "serverSide": true,
  "responsive": true,
  "ajax": {
    "url": "<?=base_url('applications/fetch-applicants')?>",
    "dataType": "json",
    "type": "POST"
  },
  "columns": [{
      "data": "applicant_id"
    },
    {
      "data": "name"
    },
    {
      "data": "father_spouse_name"
    },
    {
      "data": "mother_name"
    },
    {
      "data": "bmdc_reg_no"
    },
    {
      "data": "continuing_fcps_traning",
      "render": function(data, type, row) {
        if (data == 0) {
          return `<span class="badge rounded-pill badge-warning">No</span> <button class="btn btn-success rounded-pill btn-sm"><i class="fa fa fa-play-circle"></i></button>`;
        } else if (data == 1) {
          return `<span class="badge rounded-pill badge-success">Yes</span> <button class="btn btn-warning rounded-pill btn-sm"><i class="fa fa-pause"></i></button>`;
        } else {
          return `<span class="badge rounded-pill badge-danger">Unknown</span>`;
        }
      }
    },
    {
      "data": null,
      "render": function(data, type, row) {
        // return `<button class="btn btn-primary btn-view" data-id="${row.applicant_id}">View</button>`;
        return `<button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#applicationModal" onclick="getFilesInfo(${row.applicant_id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
      }
    },
    {
      "data": "eligible_status",
      "render": function(data, type, row) {
        if (data == 'P') {
          return `<span class="badge rounded-pill badge-warning">Pending</span>`;
        } else if (data == 'Y') {
          return `<span class="badge rounded-pill badge-success">Eligible</span>`;
        } else if (data == 'N') {
          return `<span class="badge rounded-pill badge-danger">Not Eligible</span>`;
        } else {
          return `<span class="badge rounded-pill badge-danger">Rejected</span>`;
        }
      }
    },

    {
      "data": null,
      "render": function(data, type, row) {
        $action = '';
        if (row.eligible_status == 'P') {
          $action +=
            `<button class="btn btn-success font-weight-bold btn-approve btn-sm" data-id="${row.applicant_id}"><i class="fas fa-check-circle"></i> Approve</button> `;
          $action +=
            `<button class="btn btn-danger btn-reject btn-sm" data-id="${row.applicant_id}"><i class="fas fa-times-circle"></i> Reject</button> `;
        }
        $action +=
          `<button class="btn btn-outline-info btn-sm btn-view" data-id="${row.applicant_id}"><i class="fa fa-eye" aria-hidden="true"></i></button> `;
        $action +=
          `<button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editApplicationModal" onclick="loadEditView(${row.applicant_id})"><i class="fas fa-edit"></i></button>`;

        return $action;
      }
    }
  ],
  "columnDefs": [{
      "target": 0,
      "visible": false,
      "searchable": false
    },

    {
      "target": 6,
      "orderable": false,
      "searchable": false
    },
    {
      "target": 7,
      "orderable": false,
      "searchable": false
    },
    {
      "target": 8,
      "orderable": false
    },
    {
      "targets": [4],
      "className": "dt-left"
    },
    {
      "targets": [5],
      "className": "dt-center"
    },
  ]
});

// Handle click event on View button
$('#applicantList tbody').on('click', '.btn-approve', function() {
  var applicantId = $(this).data('id'); // Get applicant_id from button
  //alert("Applicant ID: " + applicantId);

  Swal.fire({
    title: "Are you sure to make Eligible?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Make Eligible!"
  }).then((result) => {
    if (result.isConfirmed) {

      // AJAX request
      $.ajax({
        url: '<?=base_url('applications/approve-applicant')?>',
        type: 'POST',
        data: {
          applicantId: applicantId
        },
        dataType: 'json',
        success: function(response) {

          // Show notification
          if (response.status == 'success') {
            Swal.fire({
              title: "Approved!",
              text: response.message,
              icon: "success"
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: response.message,
              icon: "error"
            });
          }
          // Reload DataTable
          $('#applicantList').DataTable().ajax.reload();


        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    }
  });
});

// Handle click event on View button
$('#applicantList tbody').on('click', '.btn-reject', function() {
  var applicantId = $(this).data('id');

  Swal.fire({
    title: "Are you sure to Reject?",
    icon: "warning",
    input: "textarea",
    inputLabel: "Reject Reason",
    inputPlaceholder: "Enter reason for rejection",
    inputAttributes: {
      autocapitalize: "off"
    },
    inputValidator: (value) => {
      if (!value) {
        return "You need to write something!";
      }
    },
    showCancelButton: true,
    confirmButtonText: "Reject it",
    showLoaderOnConfirm: true,
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      // AJAX request
      $.ajax({
        url: '<?=base_url('applications/reject-applicant')?>',
        type: 'POST',
        data: {
          applicantId: applicantId,
          rejectReason: result.value
        },
        dataType: 'json',
        success: function(response) {
          // Show notification
          if (response.status == 'success') {
            Swal.fire({
              title: "Rejected!",
              text: response.message,
              icon: "success"
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: response.message,
              icon: "error"
            });
          }
          // Reload DataTable
          $('#applicantList').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });

      Swal.fire({
        title: `${result.value.login}'s avatar`,
        imageUrl: result.value.avatar_url
      });
    }
  });
});

function getFilesInfo(applicationId) {

  $.ajax({
    url: '<?=base_url('applications/fetch-files')?>',
    type: 'POST',
    data: {
      applicationId: applicationId
    },
    dataType: 'html',
    success: function(response) {
      $('#modalContents').html(response);
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
}

function loadEditView(applicantId) {
  alert(applicantId);
  $.ajax({
    type: 'GET',
    url: '<?php echo base_url(); ?>applications/fetch-applicant/' + applicantId,
    success: function(response) {
      $('#viewApplicantEditContents').html(response);
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
}
</script>
<?php $this->endSection()?>
<?php $this->extend('layout')?>

<?php $this->section('title')?>Honorarium<?php $this->endSection()?>

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
    <a href="#">Bills</a>
  </li>
  <li class="separator">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </li>
  <li class="nav-item">
    <a href="#">Hohorarium Info</a>
  </li>
</ul>
<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header flex justify-between">
        <h4 class="card-title">List of Applicants applied for honorarium</h4>
        <div class="mt-2 d-flex gap-3 justify-content-center align-items-center">
          <h6 class="fw-bold">Select Year & Session:</h6>
          <div class="form-floating col-3">
            <select class="form-select" id="honorariumYear" aria-label="Floating label select example"
              onchange="$('#billList').DataTable().ajax.reload();">
              <?php for ($year = date("Y"); $year >= 2024; $year--): ?>
              <option value="<?=$year?>"><?=$year?></option>
              <?php endfor?>
            </select>
            <label for="honorariumYear">Honorarium Year</label>
          </div>
          <div class="form-floating col-3">
            <select class="form-select" id="honorariumSession" aria-label="Floating label select example"
              onchange="$('#billList').DataTable().ajax.reload();">
              <?php foreach ($slots as $slot): ?>
              <option value="<?=$slot['id']?>"><?=$slot['slot_name']?></option>
              <?php endforeach?>
            </select>
            <label for="honorariumSession">Honorarium Slot</label>
          </div>
        </div>

      </div>
      <div class="card-body">
        <table id="billList" class="display" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Father/Spouse Name</th>
              <th>BMDC Reg. No.</th>
              <th>Application Session</th>
              <th>Application Year</th>
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
              <th>BMDC Reg. No.</th>
              <th>Application Session</th>
              <th>Application Year</th>
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
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$('#billList').DataTable({
  "processing": true,
  "serverSide": true,
  "responsive": true,
  "ajax": {
    "url": "<?=base_url('bills/fetch-honorariums')?>",
    "type": "POST",
    "data": function(data) {
      data.honorariumYear = $('#honorariumYear').val();
      data.honorariumSession = $('#honorariumSession').val();
    }
  },
  "columns": [{
      "data": "id"
    },
    {
      "data": "name"
    },
    {
      "data": "father_spouse_name"
    },
    {
      "data": "bmdc_reg_no"
    },
    {
      "data": "slot_name"
    },
    {
      "data": "honorarium_year"
    },
    {
      "data": null,
      "render": function(data, type, row) {
        // return `<button class="btn btn-primary btn-view" data-id="${row.applicant_id}">View</button>`;
        return `<button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#applicationModal" onclick="getFilesInfo(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
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
            `<button class="btn btn-success font-weight-bold btn-approve btn-sm" data-id="${row.id}"><i class="fas fa-check-circle"></i> Approve</button> `;
          $action +=
            `<button class="btn btn-danger btn-reject btn-sm" data-id="${row.id}"><i class="fas fa-times-circle"></i> Reject</button> `;
        }
        $action +=
          `<button class="btn btn-outline-info btn-sm btn-view" data-id="${row.id}"><i class="fa fa-eye" aria-hidden="true"></i></button> `;
        $action +=
          `<button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#applicationModal" onclick="getFilesInfo(${row.id})"><i class="fas fa-edit"></i></button>`;

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
      "targets": [4],
      "className": "dt-left"
    },
    {
      "targets": [3, 5],
      "className": "dt-center"
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

  ]
});

// Handle click event on View button
$('#billList tbody').on('click', '.btn-approve', function() {
  var honorariumId = $(this).data('id');

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
        url: '<?=base_url('bills/approve-honorarium')?>',
        type: 'POST',
        data: {
          honorariumId: honorariumId
        },
        dataType: 'json',
        success: function(response) {
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
          $('#billList').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    }
  });
});

// Handle click event on View button
$('#billList tbody').on('click', '.btn-reject', function() {
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
</script>
<?php $this->endSection()?>
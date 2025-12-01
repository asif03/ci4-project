<?php $this->extend('layout')?>
<?php $this->section('title')?>Training Info Status<?php $this->endSection()?>
<?php $this->section('main')?>
<?php $this->section('pageStyles')?>
<style>
.main-title {
  color: #004c99;
  font-weight: 700;
  margin-bottom: 5px;
}

.sub-title {
  color: #6c757d;
  font-weight: 400;
  font-size: 1rem;
  margin-bottom: 25px;
  border-bottom: 1px solid #dee2e6;
  padding-bottom: 15px;
}

.section-header {
  color: #007bff;
  font-weight: 600;
  margin-top: 10px;
  margin-bottom: 20px;
  background-color: #f8f9fa;
  padding: 10px 15px;
  border-left: 5px solid #007bff;
  border-radius: 0.5rem;
}
</style>
<?php $this->endSection()?>
<div class="page-content">
  <div class="card p-4 rounded-3 shadow-sm">
    <h3 class="main-title text-center">APPLICATION FOR TRAINING</h3>
    <p class="sub-title text-center">(Training allowances for the FCPS Part-II honorary trainees)</p>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
      <?=session()->getFlashdata('success')?>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
      <?=session()->getFlashdata('error')?>
    </div>
    <?php endif; ?>

    <div class="alert alert-danger text-center text-danger" role="alert">
      <h5><?=$message?></h5>
    </div>

    <div class="col-md-12 mt-3 rounded">
      <p class="text-warning-emphasis fw-bold mb-3">
        Training Application Information:
      </p>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-warning">
            <tr>
              <th>BMDC Reg. No.</th>
              <th class="text-nowrap">BMDC Validity</th>
              <th class="text-nowrap">BCPS Online Reg. No.</th>
              <th class="text-nowrap">Part-I Passed Session</th>
              <th class="text-nowrap">Speciality</th>
              <th class="text-center text-nowrap">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($application) && count($application) > 0) {?>
            <tr>
              <td><?=esc($application['bmdc_reg_no'])?></td>
              <td><?=esc($application['bmdc_validity'])?></td>
              <td class="p-2"><?=esc($application['fcps_reg_no'])?></td>
              <td class="p-2"><?=esc($application['fcps_month'])?>, <?=esc($application['fcps_year'])?></td>
              <td class="p-2"><?=esc($application['fcps_specility_name'])?></td>
              <td class="p-2 d-flex gap-2 justify-content-center">
                <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                  data-bs-target="#viewApplicationModal"
                  onclick="loadApplicationView(<?=esc($application['applicant_id'])?>)"><i class="fa fa-eye"
                    aria-hidden="true"></i></button>
                <a class="btn btn-outline-info btn-sm"
                  href="<?=base_url('applications/download-application-form')?>/<?=esc($application['applicant_id'])?>"
                  target="_blank"><i class="fas fa-download"></i></a>
              </td>
            </tr>
            <?php } else {?>
            <tr>
              <td class="p-2 text-center" colspan="7">No Record Found.</td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal For View Applicant -->
<div class="modal fade" id="viewApplicationModal" tabindex="-1" aria-labelledby="applicationModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="applicationModalLabel">Applicant Info</h5> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewApplicantContents"></div>
    </div>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
function loadApplicationView(applicantId) {
  $.ajax({
    type: 'GET',
    url: '<?php echo base_url(); ?>applications/fetch-application/' + applicantId,
    success: function(response) {
      $('#viewApplicantContents').html(response);
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
}
</script>
<?php $this->endSection()?>
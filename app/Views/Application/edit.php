<form action="<?=base_url('bills/update/' . $applicant['applicant_id'])?>" method="post">
  <?=csrf_field()?>
  <input type="hidden" name="_method" value="PUT"> <!-- simulate PUT -->
  <div class="row mb-3 p-2">
    <div class="border border-secondary text-center fs-4 rounded-pill mb-3">General Information</div>
    <div class="mb-3 row">
      <label for="name" class="col-sm-6 col-form-label">Applicant’s Name (Block Letters):</label>
      <div class="col-sm-6">
        <input type="hidden" name="applicantId" value="<?php echo $applicant['applicant_id']; ?>" />
        <input type="text" class="form-control text-uppercase" name="name" id="name" placeholder="Name"
          value="<?php echo $applicant['name']; ?>" required />
      </div>
    </div>
    <div class="mb-3 row">
      <label for="fatherName" class="col-sm-6 col-form-label">Father’s/Spouse Name (Block Letters):</label>
      <div class="col-sm-6">
        <input type="text" class="form-control text-uppercase" name="fatherName" id="fatherName"
          placeholder="Father's Name" value="<?php echo $applicant['father_spouse_name']; ?>" required />
      </div>
    </div>
    <div class="mb-3 row">
      <label for="motherName" class="col-sm-6 col-form-label">Mother’s Name (Block Letters):</label>
      <div class="col-sm-6">
        <input type="text" class="form-control text-uppercase" name="motherName" id="motherName" placeholder="Name"
          value="<?php echo $applicant['name']; ?>" required />
      </div>
    </div>
  </div>
</form>
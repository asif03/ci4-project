<table width="100%" border="0">
  <tr>
    <td width="500px">
      <h2 style="text-align:center">Honorarium Training Information</h2>
      <p style="text-align:center; font-size: 16px;">(Non-Governmental Trainees Allowances)</p>
    </td>
  </tr>
</table>
<hr />
<table class="table table-striped table-bordered">
  <tbody>
    <tr style="background:#B3D1A3">
      <th colspan="2">
        <h5>General information</h5>
      </th>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Applicant’s Name (Block Letters):</td>
      <td><?php echo $honorarium['name']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Father’s/Spouse Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?php echo $honorarium['father_spouse_name']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">BMDC Reg. No.: </td>
      <td><?php echo $honorarium['bmdc_reg_no']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">FCPS PART-I Examination:</td>
      <td>
        <?php echo $honorarium['fcps_speciallity']; ?>
        (<?php echo $honorarium['fcps_month']; ?>,<?php echo $honorarium['fcps_year']; ?>)
      </td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Online Reg. No./
        Reg. No. (after passing FCPS Part-I): </td>
      <td><?php echo $honorarium['fcps_reg_no']; ?></td>
    </tr>
  <tbody>
</table>
<table class="table table-bordered table-striped">
  <thead style="background:#CDE7C0">
    <tr style="background:#B3D1A3">
      <th colspan="7">
        <h5>Current Training Information:</h5>
      </th>
    </tr>
    <tr>
      <th>Name of the Institutes</th>
      <th>Name of the Department</th>
      <th>Current Period of Training</th>
      <th>Total Previous Training</th>
      <th>Applying for honorarium</th>
      <th>Status</th>
      <th>Bill Sl. No.</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $honorarium['training_institute_name']; ?></td>
      <td><?php echo $honorarium['department_name']; ?></td>
      <td><?php echo $honorarium['slot_name'] . ' ' . $honorarium['honorarium_year']; ?></td>
      <td><?php echo $honorarium['previous_training_inmonth'] . ' months'; ?></td>
      <td>
        <?php
            if ($honorarium['honorarium_position'] == 1) {
                echo $honorarium['honorarium_position'] . 'st';
            } elseif ($honorarium['honorarium_position'] == 2) {
                echo $honorarium['honorarium_position'] . 'nd';
            } elseif ($honorarium['honorarium_position'] == 3) {
                echo $honorarium['honorarium_position'] . 'rd';
            } else {
                echo $honorarium['honorarium_position'] . 'th';
        }?>
      </td>
      <td>
        <?php
            if ($honorarium['bill_eligible_status'] == 'P') {
                echo 'Pending';
            } elseif ($honorarium['bill_eligible_status'] == 'Y') {
                echo 'Elibigle';
            } elseif ($honorarium['bill_eligible_status'] == 'N') {
                echo 'Not Eligible';
        }?>
      </td>
      <td><?php echo $honorarium['bill_sl_no']; ?></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered table-striped">
  <thead style="background:#CDE7C0">
    <tr>
      <th colspan="7">
        <h5>Previous Training Information:</h5>
      </th>
    </tr>
    <tr>
      <th>Training Slot</th>
      <th>Training From</th>
      <th>Training To</th>
      <th>Name of Department</th>
      <th>Name of Institute</th>
      <th>Training Category</th>
      <th>Honorarium Taken</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if (count($honorariumTrainings) > 0) {
        foreach ($honorariumTrainings as $training) {?>
    <tr>
      <td class="text-center">
        <?php
            if ($training['training_slot_sl'] == 1) {
                    echo $training['training_slot_sl'] . 'st';
                } elseif ($training['training_slot_sl'] == 2) {
                    echo $training['training_slot_sl'] . 'nd';
                } elseif ($training['training_slot_sl'] == 3) {
                    echo $training['training_slot_sl'] . 'rd';
                } else {
                    echo $training['training_slot_sl'] . 'th';
            }?>
      </td>
      <td><?php echo $training['training_from']; ?></td>
      <td><?php echo $training['training_to']; ?></td>
      <td><?php echo $training['department_name']; ?></td>
      <td><?php echo $training['training_institute_name']; ?></td>
      <td><?php echo $training['training_category_title']; ?></td>
      <td class="text-center">
        <?php if ($training['honorarium_taken']): ?>
        <i class="fa fa-check-circle text-success" style="font-size:24px"></i>
        <?php else: ?>
        <i class="fa fa-times-circle text-danger" style="font-size:24px"></i>
        <?php endif; ?>
      </td>
    </tr>
    <?php }
        } else {
            echo '<tr><td colspan="7" class="text-center">No previous training found.</td></tr>';
    }?>

  </tbody>
</table>
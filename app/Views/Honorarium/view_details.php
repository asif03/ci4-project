<?php
    /*echo '<pre>';
    print_r($honorarium);
    echo '</pre>';*/
?>
<table width="100%" border="0">
  <tr>
    <td width="500px">
      <h2 style="text-align:center">Honorarium Form View</h2>
      <p style="text-align:center; font-size: 20px;">(Bill of Non-Governmental Trainees Allowances)</p>
    </td>
  </tr>
</table>
<hr />
<table width="700px" class="table table-striped table-bordered">
  <tbody>
    <tr style="background:#B3D1A3">
      <th colspan="2">
        <h3>General information</h3>
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
      <td style="background:#CDE7C0">Mother’s Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?php echo $honorarium['mother_name']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Date of Births:</td>
      <td><?php echo $honorarium['date_of_birth']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Nationality: </td>
      <td><?php echo $honorarium['nataionality']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Religion: </td>
      <td><?php echo $honorarium['religion']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">National ID No: </td>
      <td><?php echo $honorarium['nid']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Address of communication: </td>
      <td>
        <?php echo $honorarium['address']; ?>
        <hr />
        <table>
          <tr>
            <td><b>Mobile:</b><?php echo $honorarium['mobile']; ?></td>
            <td><b>Tel (Res):</b><?php echo $honorarium['telephone']; ?></td>
          </tr>
          <tr>
            <td colspan="2"><b>E-mail:</b><?php echo $honorarium['email']; ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Permanent Address: </td>
      <td><?php echo $honorarium['permanent_address']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">MBBS/BDS Data: </td>
      <td>
        <table>
          <tr>
            <td>Year of Qualification:</td>
            <td><?php echo $honorarium['mbbs_bds_year']; ?></td>
          </tr>
          <tr>
            <td>Institute: </td>
            <td><?php echo $honorarium['mbbs_bds_institute']; ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">BMDC Reg. No.: </td>
      <td><?php echo $honorarium['bmdc_reg_no']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">FCPS PART-I Examination Data: </td>
      <td>
        <b>Specialty:</b>                          <?php echo $honorarium['fcps_speciallity']; ?>, <br />
        <b>Roll No:</b>                        <?php echo $honorarium['fcps_roll']; ?><br />
        <b>Year of Passing:</b>                                <?php echo $honorarium['fcps_year']; ?>,
        <?php echo $honorarium['fcps_month']; ?>,
      </td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Online Reg. No./
        Reg. No. (after passing FCPS Part-I): </td>
      <td><?php echo $honorarium['fcps_reg_no']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Are you selected or continuing the residency <br /> training/diploma course/ Govt.
        service/Private service? </td>
      <td>
        <?php
            if ($honorarium['continuing'] == 1) {
                echo "Starting date: " . $honorarium['continuing_start_date'] . ", Ending date: " . $honorarium['continuing_end_date'];
            } else {
                echo 'No';
            }
        ?>
      </td>
    </tr>
  <tbody>
</table>
<table class="table table-bordered table-striped">
  <thead style="background:#CDE7C0">
    <tr>
      <th colspan="4">
        <h3>Applicant's Personal Bank Information:</h3>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2" style="background:#CDE7C0">Name in block letters (as per Bank Account): </td>
      <td colspan="2"><?php echo $honorarium['account_name']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Name of the bank: </td>
      <td>
        <?php if ($honorarium['bank_id'] != '') {
                echo $honorarium['new_bank_name'];
            } else {
                echo $honorarium['bank_name'];
        }?>

      </td>
      <td style="background:#CDE7C0">Name of the branch: </td>
      <td><?php echo $honorarium['branch_name']; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Account Number (13 digits or above): </td>
      <td><?php echo $honorarium['account_no']; ?></td>
      <td style="background:#CDE7C0">Routing Number: </td>
      <td><?php echo $honorarium['routing_number']; ?></td>
    </tr>
  </tbody>
</table>
<table class="table table-bordered table-striped">
  <thead style="background:#CDE7C0">
    <tr>
      <th colspan="7">
        <h3>Billing Information:</h3>
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
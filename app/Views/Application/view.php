<table width="100%" border="0">
  <tr>
    <td width="500px">
      <h2 style="text-align:center">Application Form </h2>
      <p style="text-align:center; font-size: 20px;">(Training allowances for the FCPS Part-II honorary trainees)</p>
    </td>
    <td width="100px" align="center"><?php if ($applicationAttachments != null) {?> <img
        src="<?php echo base_url('upload/' . $photograph->file_name); ?>" width="100px" /><?php }?></td>
  </tr>
</table>
<hr />
<table width="700px" class="table table-striped table-bordered">
  <tbody>
    <tr style="background:#B3D1A3">
      <th>
        <h3>General information</h3>
      </th>
      <th>
      </th>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Applicant’s Name (Block Letters):</td>
      <td><?php echo $info->name; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Father’s/Spouse Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?php echo $info->father_spouse_name; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Mother’s Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?php echo $info->mother_name; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Date of Births:</td>
      <td><?php echo $info->date_of_birth; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Nationality: </td>
      <td><?php echo $info->nataionality; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Religion: </td>
      <td><?php echo $info->religion; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">National ID No: </td>
      <td><?php echo $info->nid; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Address of communication: </td>
      <td>
        <?php echo $info->address; ?>
        <hr />
        <table>
          <tr>
            <td><b>Mobile:</b><?php echo $info->mobile; ?></td>
            <td><b>Tel (Res):</b><?php echo $info->telephone; ?></td>
          </tr>
          <tr>
            <td colspan="2"><b>E-mail:</b><?php echo $info->email; ?></td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td style="background:#CDE7C0">Permanent Address: </td>
      <td><?php echo $info->permanent_address; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">MBBS/BDS Data: </td>
      <td>
        <table>
          <tr>
            <td>Year of Qualification:</td>
            <td><?php echo $info->mbbs_bds_year; ?></td>
          </tr>
          <tr>
            <td>Institute: </td>
            <td><?php echo $info->mbbs_bds_institute; ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">BMDC Reg. No.: </td>
      <td><?php echo $info->bmdc_reg_no; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">FCPS PART-I Examination Data: </td>
      <td>
        <b>Specialty:</b>                          <?php echo $info->fcps_speciallity; ?>, <br />
        <b>Roll No:</b>                        <?php echo $info->fcps_roll; ?><br />
        <b>Year of Passing:</b>                                <?php echo $info->fcps_year; ?>,
        <?php echo $info->fcps_month; ?>,
      </td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Online Reg. No./
        Reg. No. (after passing FCPS Part-I): </td>
      <td><?php echo $info->fcps_reg_no; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Are you selected or continuing the residency training/diploma course/ Govt.
        service/Private service? </td>
      <td>
        <?php
            if ($info->continuing == 1) {
                echo "Starting date:  $info->continuing_start_date , Ending date: $info->continuing_end_date ";
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
      <th colspan="5">
        <h3>Current training database (Please mention here current six month training duration only, if you have):</h3>
      </th>
    </tr>
    <tr>
      <th colspan="5">Are you continuing the FCPS training?:</th>
    </tr>

    <tr>
      <th rowspan="2">Name of the Institutes</th>
      <th rowspan="2">Name of the Department</th>
      <th rowspan="2">Name of the Supervisor, Designation </th>
      <th colspan="2">Duration of training</th>
    </tr>

    <tr>
      <th>Starting Date</th>
      <th>Ending Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach ($fcps_traning as $fcps_traning_value) {
            if (!empty($fcps_traning_value->institute_name)) {
            ?>
    <tr>
      <td><?php echo $fcps_traning_value->institute_name; ?></td>
      <td><?php echo $fcps_traning_value->department; ?></td>
      <td><?php echo $fcps_traning_value->supervisor_name . '<br/>' . $fcps_traning_value->designation; ?></td>
      <td><?php echo $fcps_traning_value->start_date; ?></td>
      <td><?php echo $fcps_traning_value->end_date; ?></td>
    </tr>
    <?php }
    }?>
  </tbody>
</table>



<table class="table table-bordered table-striped">
  <thead style="background:#CDE7C0">
    <tr>
      <th colspan="5">
        <h3>Have you obtained FCPS training before (Please mention here previous completed training of every six month
          duration)</h3>
      </th>
    </tr>

    <tr>
      <th rowspan="2">Name of the Institutes</th>
      <th rowspan="2">Name of the Department</th>
      <th rowspan="2">Name of the Supervisor, Designation </th>
      <th colspan="2">Duration of training</th>
    </tr>

    <tr>
      <th>Starting Date</th>
      <th>Ending Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach ($fcps_training_before as $fcps_training_before_value) {
            if (!empty($fcps_training_before_value->inistitute_name)) {
            ?>
    <tr>
      <td><?php echo $fcps_training_before_value->inistitute_name; ?></td>
      <td><?php echo $fcps_training_before_value->department; ?></td>
      <td>
        <?php echo $fcps_training_before_value->supervisor_name . '<br/>' . $fcps_training_before_value->designation; ?>
      </td>
      <td><?php echo $fcps_training_before_value->start_date; ?></td>
      <td><?php echo $fcps_training_before_value->end_date; ?></td>
    </tr>
    <?php }
    }?>
  </tbody>
</table>

<table class="table table-bordered table-striped">
  <thead style="background:#CDE7C0">
    <tr>
      <th colspan="4">
        <h3>Mention the name of the institutes with department recognized by BCPS according to your choice where you
          want to obtain the fellowship training: (Please schedule the rest of training excluding current duration):
        </h3>
      </th>
    </tr>

    <tr>
      <th rowspan="2">Name of the Institutes</th>
      <th rowspan="2">Name of the Department</th>
      <th colspan="2">Duration of training</th>
    </tr>

    <tr>
      <th>Starting Date</th>
      <th>Ending Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach ($choice_institute as $value_choice_institute) {
            if (!empty($value_choice_institute->institute_name)) {
            ?>
    <tr>
      <td><?php echo $value_choice_institute->institute_name; ?></td>
      <td><?php echo $value_choice_institute->department; ?></td>
      <td><?php echo $value_choice_institute->start_date; ?></td>
      <td><?php echo $value_choice_institute->end_date; ?></td>
    </tr>
    <?php }
    }?>
  </tbody>
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
      <td colspan="2"><?php echo $info->account_name; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Name of the bank: </td>
      <td><?php echo $info->bank_name; ?></td>
      <td style="background:#CDE7C0">Name of the branch: </td>
      <td><?php echo $info->branch_name; ?></td>
    </tr>
    <tr>
      <td style="background:#CDE7C0">Account Number (13 digits or above): </td>
      <td><?php echo $info->account_no; ?></td>
      <td style="background:#CDE7C0">Routing Number: </td>
      <td><?php echo $info->routing_number; ?></td>
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
    <?php
        foreach ($honorariums as $honorarium) {
            if (!empty($honorarium->institute_name)) {
            ?>
    <tr>
      <td><?php echo $honorarium->institute_name; ?></td>
      <td><?php echo $honorarium->department_name; ?></td>
      <td><?php echo $honorarium->slot_name . ' ' . $honorarium->honorarium_year; ?></td>
      <td><?php echo $honorarium->previous_training_inmonth . ' months'; ?></td>
      <td>
        <?php
            if ($honorarium->honorarium_position == 1) {
                        echo $honorarium->honorarium_position . 'st';
                    } elseif ($honorarium->honorarium_position == 2) {
                        echo $honorarium->honorarium_position . 'nd';
                    } elseif ($honorarium->honorarium_position == 3) {
                        echo $honorarium->honorarium_position . 'rd';
                    } else {
                        echo $honorarium->honorarium_position . 'th';
                }?>
      </td>
      <td>
        <?php
            if ($honorarium->eligible_status == 'P') {
                        echo 'Pending';
                    } elseif ($honorarium->eligible_status == 'Y') {
                        echo 'Elibigle';
                    } elseif ($honorarium->eligible_status == 'Y') {
                        echo 'Not Eligible';
                }?>
      </td>
      <td><?php echo $honorarium->bill_sl_no; ?></td>
    </tr>
    <?php }
    }?>

    <tr>
      <td colspan="7"><?php if ($signature != null) {?> <img
          src="<?php echo base_url('upload/' . $signature->file_name); ?>" width="100px" /><?php }?>
      </td>
    </tr>
  </tbody>
</table>
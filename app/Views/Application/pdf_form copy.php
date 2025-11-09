<?php print_r($application);die; ?>

<!DOCTYPE html>
<html>

<head>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta charset="utf-8">
  <title>Application form </title>

  <style type="text/css">
  table,
  td,
  th {
    border: 1px solid black;
    padding: 5px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }
  </style>
</head>

<body>
  <div style="float:left; width:100%; text-align:center">
    <img src="<?php echo base_url(); ?>public/assets/images/banner.png" alt="Banner"
      style="width:100%; background-color: #009641;" />
    <!-- <img src="<?php //echo base_url(); ?>assets/img/bcps.png" style="width:8%" /> -->
    <!-- <img src="http://application.bcps.edu.bd/assets/img/bcps.png" style="width:8%"/> -->
  </div>
  <h2 style="text-align:center;">BANGLADESH COLLEGE OF PHYSICIANS AND SURGEONS (BCPS)</h2>
  <hr />
  <table width="100%" border="0">
    <tr>
      <td width="500px">
        <h2 style="text-align:center">Application Form</h2>
        <p style="text-align:center; font-size: 20px;">(Training allowances for the FCPS Part-II honorary trainees)</p>
      </td>
      <!-- <td width="100px" align="center"><?php //if (!empty($photo)) { ?> <img src="<?php //echo base_url('upload/' . $photo); ?>" width="100px" /><?php //}  ?></td> -->

    </tr>
  </table>
  <hr />
  <table class="table table-striped table-hover" style="width:100%">
    <tbody>

      </tr>
      <tr style="background:#B3D1A3">
        <th colspan="2">
          <b>General information</b>
        </th>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Applicant’s Name (Block Letters):</td>
        <td><?=esc(strtoupper($application['name']))?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Father’s/Spouse Name (Block Letters):</td>
        <td style="text-transform:uppercase"><?php echo $father_spouse_name; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Mother’s Name (Block Letters):</td>
        <td style="text-transform:uppercase"><?php echo $mother_name; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Date of Birth:</td>
        <td><?php echo $date_of_birth; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Gander:</td>
        <td><?php echo $gander; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Nationality: </td>
        <td><?php echo $nataionality; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Religion: </td>
        <td><?php echo $religion; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">National ID No: </td>
        <td><?php echo $nid; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Address of communication: </td>
        <td>
          <?php echo $address; ?>
          <hr />
          <table>
            <tr>
              <td><b>Mobile:</b><?php echo $mobile; ?></td>
              <td><b>Tel (Res):</b><?php echo $telephone; ?></td>
            </tr>
            <tr>
              <td colspan="2"><b>E-mail:</b><?php echo $email; ?></td>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td style="background:#CDE7C0">Permanent Address: </td>
        <td><?php echo $permanent_address; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">MBBS/BDS Data: </td>
        <td>
          <table>
            <tr>
              <td>Year of Qualification:</td>
              <td><?php echo $mbbs_bds_year; ?></td>
            </tr>
            <tr>
              <td>Institute: </td>
              <td><?php echo $mbbs_bds_institute; ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">BMDC Reg. No.: </td>
        <td><?php echo $bmdc_reg_no; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">FCPS PART-I Examination Data: </td>
        <td>
          <b>Specialty:</b> <?php echo $fcps_speciallity; ?>,
          <b>Roll No:</b> <?php echo $fcps_roll; ?>
          <br />
          <b>Year of Passing:</b> <?php echo $fcps_year; ?>,
          <?php echo $fcps_month; ?>,
        </td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Online Reg. No./
          Reg. No. (after passing FCPS Part-I): </td>
        <td><?php echo $fcps_reg_no; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Are you selected or continuing the residency training/diploma course/ Govt.
          service/Private service? </td>
        <td>
          <?php
              if ($continuing == 1) {
                  echo "Starting date:  $continuing_start_date , Ending date: $continuing_end_date ";
              } else {
                  echo 'No';
              }
          ?>
        </td>
      </tr>
    <tbody>
  </table>


  <table style="width:100%">
    <thead style="background:#CDE7C0">
      <tr>
        <th colspan="5">Current training database (Please mention here current six month training duration only, if you
          have)</th>
      </tr>
      <tr>
        <th colspan="5">Are you continuing the FCPS training?</th>
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
          for ($i = 0; $i < count((array) $institute_name); $i++) {
              if (!empty($institute_name[$i])) {
              ?>
      <tr>
        <td><?php echo $institute_name[$i]; ?></td>
        <td><?php echo $department[$i]; ?></td>
        <td><?php echo $supervisor_name[$i] . '<br/>' . $designation[$i]; ?></td>
        <td><?php echo $start_date[$i]; ?></td>
        <td><?php echo $end_date[$i]; ?></td>
      </tr>
      <?php }
      }?>
    </tbody>
  </table>



  <table style="width:100%">
    <thead style="background:#CDE7C0">
      <tr>
        <th colspan="5">Have you obtained FCPS training before (Please mention here previous completed training of every
          six month duration)</th>
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
          for ($i = 0; $i < count($before_institute_name); $i++) {
              if (!empty($before_institute_name[$i])) {
              ?>
      <tr>
        <td><?php echo $before_institute_name[$i]; ?></td>
        <td><?php echo $before_department[$i]; ?></td>
        <td><?php echo $before_supervisor_name[$i] . '<br/>' . $before_designation[$i]; ?></td>
        <td><?php echo $before_start_date[$i]; ?></td>
        <td><?php echo $before_end_date[$i]; ?></td>
      </tr>
      <?php }
      }?>
    </tbody>
  </table>

  <table style="width:100%">
    <thead style="background:#CDE7C0">
      <tr>
        <th colspan="4">Mention the name of the institutes with department recognized by BCPS according to your choice
          where you want to obtain the fellowship training: (Please schedule the rest of training Including FCPS course
          and excluding current duration)</th>
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
          for ($i = 0; $i < count($choice_institute_name); $i++) {
              if (!empty($choice_institute_name[$i])) {
              ?>
      <tr>
        <td><?php echo $choice_institute_name[$i]; ?></td>
        <td><?php echo $choice_department[$i]; ?></td>
        <td><?php echo $choice_start_date[$i]; ?></td>
        <td><?php echo $choice_end_date[$i]; ?></td>
      </tr>
      <?php }
      }?>
    </tbody>
  </table>

  <table style="width:100%">
    <thead style="background:#CDE7C0">
      <tr>
        <th colspan="4">Applicant's Personal Bank Information: </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2" style="background:#CDE7C0">Name in block letters (as per Bank Account): </td>
        <td colspan="2"><?php echo strtoupper($account_name); ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Name of the bank: </td>
        <td><?php echo $bank_name; ?></td>
        <td style="background:#CDE7C0">Name of the branch: </td>
        <td><?php echo $branch_name; ?></td>
      </tr>
      <tr>
        <td style="background:#CDE7C0">Account Number (13 digits or above): </td>
        <td><?php echo $account_no; ?></td>
        <td style="background:#CDE7C0">Routing Number: </td>
        <td><?php echo $routing_number; ?></td>
      </tr>
    </tbody>
  </table>

  <table style="width:100%">
    <tbody>
      <tr>
        <th colspan="4">Undertaking</th>
      </tr>

      <tr>
        <td colspan="4">
          <p>
            I Dr. &nbsp;&nbsp; <b><?php echo strtoupper($name); ?></b> &nbsp;&nbsp; declared that the information given
            by me in this form is entirely true and authentic. The application may be cancelled if any information
            mentioned above is found to be false or incomplete.
          </p>
        </td>
      </tr>

      <tr>
        <!-- <td colspan="4">
          <?php //if (!empty($signature)) {?> <img src="<?php //echo base_url('upload/' . $signature); ?>" width="100px" />
          <?php //}?>
        </td> -->
      </tr>
    </tbody>
  </table>
  <table style="width:100%" border="1">
    <tbody>
      <tr style="background:#CDE7C0">

        <th colspan="5">
          <h2>For Official use only</h2>
          Applicant’s will be scrutinized by the department of Research and Training Monitoring (RTM) of BCPS
        </th>
      </tr>
      <tr>
        <th colspan="5">The applicant is:
          eligible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          not eligible</th>
      </tr>
      <tr>
        <th>
          <div style="width:100%; border-top:1px solid #000; margin-top:50px">Principal Research Officer</div>
        </th>
        <th>
          <div style="width:100%; border-top:1px solid #000; margin-top:50px">Honorary Director (RTM)</div>
        </th>
        <th>
          <div style="width:100%; border-top:1px solid #000; margin-top:50px">Deputy Director Admin </div>
        </th>
        <th>
          <div style="width:100%; border-top:1px solid #000; margin-top:50px">Director Admin </div>
        </th>
        <th>
          <div style="width:100%; border-top:1px solid #000; margin-top:50px">Honorary Secretary</div>
        </th>
      </tr>
    </tbody>
  </table>


</body>

</html>
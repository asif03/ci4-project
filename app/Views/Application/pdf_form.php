<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <title>Application form </title>
  <style type="text/css">
  @page {
    margin: 100px 25px 50px 25px;

  }

  body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Roboto, Arial, sans-serif;
  }

  header {
    position: fixed;
    top: -100px;
    left: 0;
    right: 0;
    height: 100px;
  }

  footer {
    position: fixed;
    bottom: -50px;
    left: -25px;
    right: -25px;
    height: 50px;
    font-size: 10px;
    text-align: center;
  }
  </style>
</head>

<body>
  <header style="width: 100%;">
    <!-- <img src="<?php echo base_url(); ?>public/assets/images/banner.png" alt="Banner"
      style="width:100%; background-color: #009641;" /> -->
  </header>
  <footer>
    <table width="100%" border="0">
      <tr>
        <td style="text-align: center;">
          67, Shaheed Tajuddin Ahmed Sarani, Mohakhali, Dhaka-1212, Bangladesh.
        </td>
      </tr>
      <tr>
        <td style="text-align: center;">
          Tel: 02- 222295006, 02- 222284189, 02- 222291865 (PABX) EXT- 0/ 222/ 100, Fax : 02- 222288928 Web :
          www.bcps.edu.bd, Email : bcps@bcps.edu.bd</td>
      </tr>
    </table>
  </footer>
  <main style="width: 100%; box-sizing: border-box;">
    <table style="width:100%;">
      <thead>
        <tr>
          <th style="text-align: center;">
            <div style="width: 100%; font-size: 20px; text-align:center;">Application Form</div>
            <div style="width: 100%; font-size: 15px;">(Training allowances for the FCPS Part-II honorary trainees)
            </div>
          </th>
          <th>
            <?php if (!empty($applicationAttachments)) {?> <img
              src="<?php echo base_url('writable/uploads/applications/' . $applicationAttachments['photograph']); ?>"
              width="100px" />
            <?php }?>
          </th>
        </tr>
      </thead>
    </table>

    <table class="table table-striped table-hover" style="width:100%">
      <thead>
        <tr style="background:#B3D1A3">
          <th colspan="2" style="text-align: left;">
            <b>General information</b>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="background:#CDE7C0">Applicant’s Name (Block Letters):</td>
          <td><?=esc($application['name'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Father’s/Spouse Name (Block Letters):</td>
          <td style="text-transform:uppercase"><?=esc($application['father_spouse_name'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Mother’s Name (Block Letters):</td>
          <td style="text-transform:uppercase"><?=esc($application['mother_name'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Date of Birth:</td>
          <td><?=esc($application['date_of_birth'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Gander:</td>
          <td><?=esc($application['gander'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Nationality: </td>
          <td><?=esc($application['nataionality'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Religion: </td>
          <td><?=esc($application['religion'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">National ID No: </td>
          <td><?=esc($application['nid'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Address of communication: </td>
          <td>
            <?=esc($application['address'])?>
            <hr />
            <table>
              <tr>
                <td><b>Mobile:</b><?=esc($application['mobile'])?></td>
                <td><b>Tel (Res):</b><?=esc($application['telephone'])?></td>
              </tr>
              <tr>
                <td colspan="2"><b>E-mail:</b><?=esc($application['email'])?></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Permanent Address: </td>
          <td><?=esc($application['permanent_address'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">MBBS/BDS Data: </td>
          <td>
            <table>
              <tr>
                <td>Year of Qualification:</td>
                <td><?=esc($application['mbbs_bds_year'])?></td>
              </tr>
              <tr>
                <td>Institute: </td>
                <td>
                  <?php if ($application['mbbs_institute_id'] != ''): ?>
                  <?=esc($application['mbbs_institute_name_new'])?>
                  <?php else: ?>
                  <?=esc($application['mbbs_bds_institute'])?>
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">BMDC Reg. No.: </td>
          <td><?=esc($application['bmdc_reg_no'])?>(<?=esc($application['bmdc_reg_type'])?>)</td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">FCPS PART-I Examination Data: </td>
          <td>
            <b>Specialty:</b>
            <?php if ($application['speciality_id'] != ''): ?>
            <?=esc($application['fcps_specility_name'])?>
            <?php else: ?>
            <?=esc($application['fcps_speciallity'])?>
            <?php endif; ?>
            <b>Roll No:</b><?=esc($application['fcps_roll'])?>
            <br />
            <b>Year of Passing:</b><?=esc($application['fcps_year'])?>, <?=esc($application['fcps_month'])?>
          </td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Online Reg. No./Reg. No. (after passing FCPS Part-I): </td>
          <td><?=esc($application['fcps_reg_no'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Are you selected or continuing the residency training/diploma course/ Govt.
            service/Private service? </td>
          <td>
            <?php if ($application['continuing'] == 1): ?>
            Starting date: <?=esc($application['continuing_start_date'])?>, Ending date:
            <?=esc($application['continuing_end_date'])?>
            <?php else: ?>
            <?php echo 'No'; ?>
            <?php endif; ?>
          </td>
        </tr>
      <tbody>
    </table>

    <table style="width:100%">
      <thead style="background:#CDE7C0">
        <tr>
          <th colspan="5">Current training database (Please mention here current six month training duration only, if
            you
            have)</th>
        </tr>
        <tr>
          <th colspan="5">Are you continuing the FCPS training?
            <?php if ($application['continuing_fcps_traning'] == 1): ?>
            Yes
            <?php else: ?>
            No
            <?php endif; ?>
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
        <?php if (!empty($currentTraininngInfo)): ?>
        <?php foreach ($currentTraininngInfo as $currentTraining): ?>
        <tr>
          <td><?=esc($currentTraining['institute_name'])?></td>
          <td><?=esc($currentTraining['department'])?></td>
          <td><?=esc($currentTraining['supervisor_name'])?></td>
          <td><?=esc($currentTraining['designation'])?></td>
          <td><?=esc($currentTraining['start_date'])?></td>
          <td><?=esc($currentTraining['end_date'])?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
          <td colspan="5" style="text-align: center;">No current training information found.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <table style="width:100%">
      <thead style="background:#CDE7C0">
        <tr>
          <th colspan="5">Have you obtained FCPS training before (Please mention here previous completed training of
            every six month duration)</th>
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
        <?php if (!empty($beforeTraininngInfo)): ?>
        <?php foreach ($beforeTraininngInfo as $beforeTraining): ?>
        <tr>
          <td><?=esc($beforeTraining['inistitute_name'])?></td>
          <td><?=esc($beforeTraining['department'])?></td>
          <td><?=esc($beforeTraining['supervisor_name'])?>, <?=esc($beforeTraining['designation'])?></td>
          <td><?=esc($beforeTraining['start_date'])?></td>
          <td><?=esc($beforeTraining['end_date'])?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
          <td colspan="5" class="text-center">No training information found.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <table style="width:100%">
      <thead style="background:#CDE7C0">
        <tr>
          <th colspan="4">Mention the name of the institutes with department recognized by BCPS according to your choice
            where you want to obtain the fellowship training: (Please schedule the rest of training Including FCPS
            course and excluding current duration)</th>
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
        <?php if (!empty($choiceTraininngInfo)): ?>
        <?php foreach ($choiceTraininngInfo as $choiceTraining): ?>
        <tr>
          <td><?=esc($choiceTraining['institute_name'])?></td>
          <td><?=esc($choiceTraining['department'])?></td>
          <td><?=esc($choiceTraining['start_date'])?></td>
          <td><?=esc($choiceTraining['end_date'])?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
          <td colspan="5" class="text-center">No training information found.</td>
        </tr>
        <?php endif; ?>
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
          <td colspan="2"><?=esc(strtoupper($application['account_name']))?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Name of the bank: </td>
          <td><?=esc($application['bank_name'])?></td>
          <td style="background:#CDE7C0">Name of the branch: </td>
          <td><?=esc($application['branch_name'])?></td>
        </tr>
        <tr>
          <td style="background:#CDE7C0">Account Number (13 digits or above): </td>
          <td><?=esc($application['account_no'])?></td>
          <td style="background:#CDE7C0">Routing Number: </td>
          <td><?=esc($application['routing_number'])?></td>
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
              I Dr.&nbsp;<b><?=esc(strtoupper($application['name']))?></b>&nbsp;declared that the
              information
              given by me in this form is entirely true and authentic. The application may be cancelled if any
              information mentioned above is found to be false or incomplete.
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

    <table style="width:100%; border: 1px solid #000;">
      <tbody>
        <tr style="background:#CDE7C0">
          <th colspan="5">
            <h2>For Official use only</h2>
            Applicant’s will be scrutinized by the department of Research and Training Monitoring (RTM) of BCPS
          </th>
        </tr>
        <tr>
          <th colspan="5">The applicant is: Eligible/Not Eligible</th>
        </tr>
        <tr>
          <td>
            <div style="width:100%; border-top:1px solid #000; margin-top:50px;">Principal Research Officer</div>
          </td>
          <td>
            <div style="width:100%; border-top:1px solid #000; margin-top:50px;">Honorary Director (RTM)</div>
          </td>
          <td>
            <div style="width:100%; border-top:1px solid #000; margin-top:50px;">Deputy Director Admin </div>
          </td>
          <td>
            <div style="width:100%; border-top:1px solid #000; margin-top:50px;">Director Admin</div>
          </td>
          <td>
            <div style="width:100%; border-top:1px solid #000; margin-top:50px;">Honorary Secretary</div>
          </td>
        </tr>
      </tbody>
    </table>

  </main>

</body>

</html>
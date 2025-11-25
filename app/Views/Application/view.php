<?php print_r($data['applicationInfo']); ?>
<table width="100%" border="0">
  <tr>
    <td width="500px">
      <h2 style="text-align:center">Application Form </h2>
      <p style="text-align:center; font-size: 20px;">(Training allowances for the FCPS Part-II honorary trainees)</p>
    </td>
    <!-- <td width="100px" align="center"><?php //if ($applicationAttachments != null) {?><img
        src="<?php //echo base_url('upload/' . $photograph->file_name); ?>" width="100px" /><?php //}?></td> -->
  </tr>
</table>
<table class="table table-striped-columns table-bordered">
  <thead>
    <tr class="table-light">
      <th colspan="2">
        <h5 class="text-center">General information</h5>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Applicant’s Name (Block Letters):</td>
      <td><?=esc($data['applicationInfo']['name'])?></td>
    </tr>
    <tr>
      <td>Father’s/Spouse Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?=esc($data['applicationInfo']['father_spouse_name'])?></td>
    </tr>
    <tr>
      <td>Mother’s Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?=esc($data['applicationInfo']['mother_name'])?></td>
    </tr>
    <tr>
      <td>Date of Births:</td>
      <td><?=esc($data['applicationInfo']['date_of_birth'])?></td>
    </tr>
    <tr>
      <td>Nationality: </td>
      <td><?=esc($data['applicationInfo']['nataionality'])?></td>
    </tr>
    <tr>
      <td>Religion: </td>
      <td><?=esc($data['applicationInfo']['religion'])?></td>
    </tr>
    <tr>
      <td>National ID No: </td>
      <td><?=esc($data['applicationInfo']['nid'])?></td>
    </tr>
    <tr>
      <td>Address of communication: </td>
      <td>
        <?=esc($data['applicationInfo']['address'])?>
        <hr />
        <table>
          <tr>
            <td><b>Mobile: </b><?=esc($data['applicationInfo']['mobile'])?></td>
            <td><b>Tel (Res): </b><?=esc($data['applicationInfo']['telephone'])?></td>
          </tr>
          <tr>
            <td colspan="2"><b>E-mail: </b><?=esc($data['applicationInfo']['email'])?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>Permanent Address: </td>
      <td><?=esc($data['applicationInfo']['permanent_address'])?></td>
    </tr>
  </tbody>
</table>

<table class="table table-striped-columns table-bordered">
  <thead>
    <tr class="table-light">
      <th colspan="2">
        <h5 class="text-center">MBBS/BDS Information</h5>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="50%">BMDC Reg. No: </td>
      <td width="50%"><?=esc($data['applicationInfo']['bmdc_reg_no'])?></td>
    </tr>
    <tr>
      <td>BMDC Reg. Validity: </td>
      <td><?=esc($data['applicationInfo']['bmdc_validity'])?></td>
    </tr>
    <tr>
      <td>Year of Qualification: </td>
      <td><?=esc($data['applicationInfo']['mbbs_bds_year'])?></td>
    </tr>
    <tr>
      <td>Institute: </td>
      <td>
        <?php if ($data['applicationInfo']['mbbs_institute_id'] != '') {
                echo $data['applicationInfo']['mbbs_institute_name_new'];
            } else {
                echo $data['applicationInfo']['mbbs_bds_institute'];
            }
        ?>
      </td>
    </tr>
  <tbody>
</table>

<table class="table table-striped-columns table-bordered">
  <thead>
    <tr class="table-light">
      <th colspan="2">
        <h5 class="text-center">FCPS PART-I Examination</h5>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="50%">FCPS PART-I Passed Session: </td>
      <td width="50%">
        <?=esc($data['applicationInfo']['fcps_month'])?>, <?=esc($data['applicationInfo']['fcps_year'])?>
      </td>
    </tr>
    <tr>
      <td>Specility:</td>
      <td>
        <?php if ($data['applicationInfo']['speciality_id'] != '') {
                echo $data['applicationInfo']['fcps_specility_name'];
            } else {
                echo $data['applicationInfo']['fcps_speciallity'];
            }
        ?>
      </td>
    </tr>
    <tr>
      <td>Roll: </td>
      <td><?=esc($data['applicationInfo']['fcps_roll'])?></td>
    </tr>
    <tr>
      <td>Online Reg. No./Reg. No. (after passing FCPS Part-I): </td>
      <td><?=esc($data['applicationInfo']['fcps_reg_no'])?></td>
    </tr>
    <tr>
      <td>Pen No.: </td>
      <td><?=esc($data['applicationInfo']['pen_no'])?></td>
    </tr>
  <tbody>
</table>


<table class="table table-striped-columns table-bordered">
  <thead>
    <tr class="table-light">
      <th colspan="2">
        <h5 class="text-center">Bank Information</h5>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="50%">Name in block letters (as per Bank Account):</td>
      <td width="50%"><?=esc($data['applicationInfo']['name'])?></td>
    </tr>
    <tr>
      <td>Name of the bank:</td>
      <td><?=esc($data['applicationInfo']['bank_name'])?></td>
    </tr>
    <tr>
      <td>Name of the branch:</td>
      <td><?=esc($data['applicationInfo']['branch_name'])?></td>
    </tr>
    <tr>
      <td>Account Number (13 digits or above):</td>
      <td><?=esc($data['applicationInfo']['account_no'])?></td>
    </tr>
    <tr>
      <td>Routing Number:</td>
      <td><?=esc($data['applicationInfo']['routing_number'])?></td>
    </tr>
  <tbody>
</table>
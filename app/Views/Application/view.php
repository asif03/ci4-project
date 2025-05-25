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
      <td>BMDC Reg. No: </td>
      <td><?=esc($data['applicationInfo']['bmdc_reg_no'])?></td>
    </tr>
    <tr>
      <td>Year of Qualification: </td>
      <td><?=esc($data['applicationInfo']['mbbs_bds_year'])?></td>
    </tr>
    <tr>
      <td>Institute: </td>
      <td><?=esc($data['applicationInfo']['mbbs_bds_institute'])?></td>
    </tr>
  <tbody>
</table>
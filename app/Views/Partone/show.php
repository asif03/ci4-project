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
      <td style="text-transform:uppercase"><?=esc($applicant_name)?></td>
    </tr>
    <tr>
      <td>Father’s Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?=esc($father_name)?></td>
    </tr>
    <tr>
      <td>Mother’s Name (Block Letters):</td>
      <td style="text-transform:uppercase"><?=esc($mother_name)?></td>
    </tr>
    <tr>
      <td>Date of Birth:</td>
      <td><?=esc($date_of_birth)?></td>
    </tr>
    <tr>
      <td>Mobile:</td>
      <td><?=esc($cell)?></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><?=esc($email)?></td>
    </tr>
    <tr>
      <td>Address of Communication: </td>
      <td>
        <?=esc($mailing_address)?>
      </td>
    </tr>
    <tr>
      <td>Present Address: </td>
      <td><?=esc($present_address)?></td>
    </tr>
    <tr>
      <td>Permanent Address: </td>
      <td><?=esc($permanent_address)?></td>
    </tr>
  </tbody>
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
        <?=esc($fcps_part_one_session)?>, <?=esc($fcps_part_one_year)?>
      </td>
    </tr>
    <tr>
      <td>Specility:</td>
      <td>
        <?php if ($subject_id != '') {
                echo $subject_name;
            } else {
                echo $subject;
            }
        ?>
      </td>
    </tr>
    <tr>
      <td>Roll / BMDC Reg. No.: </td>
      <td><?=esc($roll)?></td>
    </tr>
    <tr>
      <td>Online Reg. No./Reg. No. (after passing FCPS Part-I): </td>
      <td><?=esc($reg_no)?></td>
    </tr>
    <tr>
      <td>Pen No.: </td>
      <td><?=esc($pen_number)?></td>
    </tr>
  <tbody>
</table>

<table class="table table-striped-columns table-bordered">
  <thead>
    <tr class="table-light">
      <th colspan="2">
        <h5 class="text-center">Money Receipt Information</h5>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="50%">Money Receipt No.: </td>
      <td width="50%">
        <?=esc($money_receipt_no)?>
      </td>
    </tr>
    <tr>
      <td>Date:</td>
      <td><?=esc($money_receipt_date)?></td>
    </tr>
  <tbody>
</table>
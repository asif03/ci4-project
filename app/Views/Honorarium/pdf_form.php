<?php
    /*echo '<pre>';
    print_r($honorarium);
    echo '</pre>';*/
    //die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <title>BCPS::Honorarium</title>
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
    height: 125px;
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

  table {
    width: 100%;
    border-collapse: collapse;
  }
  </style>
</head>

<body>
  <header style="width: 100%;">
    <img src="<?php echo base_url(); ?>public/assets/images/banner.png" alt="Banner"
      style="width:100%; background-color: #009641;" />
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
  <main style="width: 100%; height: auto; border: 1px solid #000000;">
    <table width="100%" border="0" style="border-collapse: collapse;">
      <tr>
        <td style="width: 80%;">
          <h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Bill of Non-Governmental Trainees
            Allowances (Honorarium)
          </h4>
        </td>
        <td style="width: 20%; font-size: 12px; border: 1px solid #000000;">SL:
          <?php echo $honorarium['bill_sl_no']; ?>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" style="margin-top: 0px; padding: 5px; font-size: 12px;">
      <tr>
        <td colspan="2">Name of the Trainee (In capital letters as per NID card):                                                                                  <?php echo $honorarium['name']; ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">BCPS Registration No. (10 Digit after passing FCPS Part-I):
          <?php echo $honorarium['fcps_reg_no']; ?>
        </td>
      </tr>
      <tr>
        <td>BMDC Registration No:                                  <?php echo $honorarium['bmdc_reg_no']; ?></td>
        <td>Date of Birth:                           <?php echo $honorarium['date_of_birth']; ?></td>
      </tr>
      <tr>
        <td colspan="2">National Identity Card No. (NID-17 Digits / Smart Card 10 Digits):
          <?php echo $honorarium['nid']; ?></td>
      </tr>
      <tr>
        <td>Mobile Number (Personal):                                      <?php echo $honorarium['mobile']; ?>
        </td>
        <td>Gender:                    <?php echo $honorarium['gander']; ?></td>
      </tr>
      <tr>
        <td colspan="2">Institute Name:                                        <?php echo $honorarium['training_institute_name']; ?></td>
      </tr>
      <tr>
        <td colspan="2">Department:                                    <?php echo $honorarium['department_name']; ?></td>
      </tr>
      <tr>
        <td>Current Training Session:<?php echo $honorarium['slot_name'] . ', ' . $honorarium['honorarium_year']; ?>,
          Current Training Slot:                                 <?php if ($honorarium['current_training_slot'] == 1) {
                                         echo $honorarium['current_training_slot'] . 'st';
                                     } elseif ($honorarium['current_training_slot'] == 2) {
                                         echo $honorarium['current_training_slot'] . 'nd';
                                     } elseif ($honorarium['current_training_slot'] == 3) {
                                         echo $honorarium['current_training_slot'] . 'rd';
                                     } else {
                                         echo $honorarium['current_training_slot'] . 'th';
                                 }?>
        </td>
        <td>Applying for Honorarium:                                     <?php if ($honorarium['honorarium_position'] == 1) {
                                             echo $honorarium['honorarium_position'] . 'st';
                                         } elseif ($honorarium['honorarium_position'] == 2) {
                                             echo $honorarium['honorarium_position'] . 'nd';
                                         } elseif ($honorarium['honorarium_position'] == 3) {
                                             echo $honorarium['honorarium_position'] . 'rd';
                                         } else {
                                         echo $honorarium['honorarium_position'] . 'th';
                                     }?> Time</td>
      </tr>
      <tr>
        <td style="font-weight: bold;">Name of the Bank:                                                         <?php echo $honorarium['new_bank_name']; ?></td>
        <td>Branch Name:                         <?php echo $honorarium['branch_name']; ?></td>
      </tr>
      <tr>
        <td>Bank Account Number (Personal-Online):                                                   <?php echo $honorarium['account_no']; ?></td>
        <td>Routing Number:                            <?php echo $honorarium['routing_number']; ?></td>
      </tr>
      <tr>
        <td colspan="2" style="background-color: #000000; color: #FFFFFF; padding: 5px; text-align: center;">NB: 1.
          Attested Training Certificate/ Provisional Training Certificate, 2. Copy of FCPS Part-1 Congratulations Letter
          3. Copy of FCPS Midterm Congratulations Letter (if applicable) 4. Copy of any page of the Personal bank MICR
          cheque / Bank Statement with printed Name & Routing Number and 5. Copy of NID/ Smart Card of the trainee must
          be attached herewith</td>
      </tr>
      <tr>
        <td colspan="2">I have received 35,000x6=2,10,000/- (In words: Two lakh and ten thousand) as training
          allowance (Honorarium) for last 6 month period
          <?php echo $honorarium['slot_name'] . ', ' . $honorarium['honorarium_year']; ?>.
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p style="text-align: justify;">
            <span
              style="width: 100%; text-decoration: underline; font-weight: bold; text-align: center; padding-left: 320px;">Declaration</span>
            <br />
            I am Dr. <span style="text-decoration: underline;"><?php echo $honorarium['name']; ?></span> declaring that
            all the information given by me are true. I have completed my last Six(6) months training in the
            <?php echo $honorarium['department_name']; ?>
            department of<?php echo $honorarium['training_institute_name']; ?>. Apart from this training, I was not
            involved in any
            other job/duty/practice and also
            have not received salary/allowances from any other source.
            <br />
            If the above information is proved false (even in partly), BCPS can take any legal action and I will be
            liable to refund the money.
          </p>
          <!-- <p style="text-align: justify;">
            If the above information is proved false (even in partly), BCPS can take any legal action and I will be
            liable to refund the money.
          </p> -->
        </td>
      </tr>
    </table>
    <table width="100%" border="0" style="margin-top: 0px; padding: 5px; font-size: 12px; border-collapse: collapse;">
      <tr>
        <td width="40%"></td>
        <td width="10%" style="border: 1px solid #000; font-size: 10px; text-align: center;">
          Attach revenue stamp worth Tk 10
        </td>
        <td width="50%" style="padding: 5px; text-align: right; font-weight: bold;">
          ___________________________________________<br>
          Trainee's Full Name & Signature and Date
        </td>
      </tr>
      <tr>
        <td style="padding-top: 20px; font-weight: bold;">
          ______________________________________________ <br>
          Signature and seal of Supervisor
        </td>
        <td colspan="2" style="text-align: right; padding-top: 20px; font-weight: bold;">
          ________________________________________________________ <br>
          Signature and seal of Director (Hospital)/Superintendent
        </td>
      </tr>
    </table>

    <table width="100%" border="0" style="border-top: 1px solid #000000; margin-top: 5px;">
      <tr>
        <td colspan="3" style="text-align: center;">
          <h5 style="text-decoration: underline; margin: 0px; text-align: center;">For Use of RTM Department</h5>
        </td>
      </tr>
      <tr>
        <td colspan="3" style="font-size: 12px; text-align: justify; padding: 5px;">
          A provisional training certificate and relevant documents duly submitted by the trainee to RTM
          department and training allowances may be disbursed to the trainees Bank Account on the basis of submitted
          documents therefor.
        </td>
      </tr>
      <tr>
        <td style="font-size: 12px; padding: 5px; font-weight: bold;">
          __________________ <br>
          Checked by
        </td>
        <td style="font-size: 12px; text-align: center; padding: 5px; font-weight: bold;">
          ________________________ <br>
          Principal Research Officer
        </td>
        <td style="font-size: 12px; text-align: right; padding: 5px; font-weight: bold;">
          _______________________ <br>
          Honorary Director (RTM)
        </td>
      </tr>
    </table>
    <table width="100%" border="0" style="border-top: 1px solid #000000; margin-top: 5px;">
      <tr>
        <td colspan="12">
          <h5 style="text-decoration: underline; margin: 0px; text-align: center;">
            For Use of Accounts and Administration Department
          </h5>
        </td>
      </tr>
      <tr>
        <td colspan="12" style="font-size: 12px; text-align: justify; padding: 5px;">
          Bills submitted for the remuneration of FCPS non-government trainees are payable under the Government
          Allowances Assistance Sector (Code No. 3631102). Accordingly, based on the report from the training institute
          and RTMD of BCPS, a total of six (6) months of allowances, amounting to Tk. 35,000 per month, total Tk.
          2,10,000/- (In words: Two lakh and ten thousand), has been sanctioned and disbursed for the period from
          <?php if ($honorarium['honorarium_slot_id'] == 1) {
                  echo 'January to June ' . date('Y');
              } elseif ($honorarium['honorarium_slot_id'] == 2) {
              echo 'July to December ' . date('Y');
          }?>.
        </td>
      </tr>
      <tr>
        <td colspan="3" style="font-size: 12px; padding: 5px; font-weight: bold;">
          ________________ <br>
          Accounts Officer
        </td>
        <td colspan="3" style="font-size: 12px; text-align: center; padding: 5px; font-weight: bold;">
          _______________________ <br>
          Deputy Director (Admin)
        </td>
        <td colspan="3" style="font-size: 12px; text-align: center; padding: 5px; font-weight: bold;">
          ____________________________ <br>
          Additional Director (Admin)
        </td>
        <td colspan="3" style="font-size: 12px; text-align: right; padding: 5px; font-weight: bold;">
          ___________________________ <br>
          Additional Director (Finance)
        </td>
      </tr>
      <tr>
        <td colspan="4" style="font-size: 12px; text-align: center; padding: 30px 5px 5px 5px; font-weight: bold;">
          _________________<br>
          Director (Admin)
        </td>
        <td colspan="4" style="font-size: 12px; text-align: center; padding: 30px 5px 5px 5px; font-weight: bold;">
          _________________<br>
          Secretary
        </td>
        <td colspan="4" style="font-size: 12px; text-align: center; padding: 30px 5px 5px 5px; font-weight: bold;">
          _________________<br>
          Treasurer
        </td>
      </tr>
    </table>
  </main>
</body>

</html>
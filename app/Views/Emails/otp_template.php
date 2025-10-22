<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>BCPS Verification Request</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333333;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-top: 5px solid #0056b3;
    /* BCPS primary color */
  }

  .header {
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid #eeeeee;
  }

  .header h1 {
    color: #0056b3;
    font-size: 24px;
  }

  .content {
    padding: 20px 0;
  }

  .otp-box {
    background-color: #f9f9f9;
    border: 1px solid #cccccc;
    padding: 15px;
    text-align: center;
    margin: 20px 0;
    border-radius: 4px;
  }

  .otp-code {
    font-size: 32px;
    font-weight: bold;
    color: #d9534f;
    /* Danger/Alert color for OTP */
    letter-spacing: 3px;
    display: block;
    margin-top: 10px;
  }

  .footer {
    padding-top: 10px;
    border-top: 1px solid #eeeeee;
    font-size: 12px;
    text-align: center;
    color: #777777;
  }

  .footer a {
    color: #0056b3;
    text-decoration: none;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Bangladesh College of Physicians & Surgeons (BCPS)</h2>
    </div>
    <div class="content">
      <p>Dear <?=esc($recipient_name)?>, </p>
      <p>Thank you for initiating a verification request with the Bangladesh College of Physicians & Surgeons (BCPS).
      </p>

      <p>Your One-Time Password (OTP) is:</p>

      <div class="otp-box">
        <span style="font-size: 20px;">🔐</span>
        <span class="otp-code">[<?=esc($otp)?>]</span>
      </div>

      <p>This **OTP is valid for 10 minutes** and can only be used once. Please enter it on the verification page to
        proceed.</p>
      <p>If you did not request this OTP, please ignore this email. For any assistance, feel free to contact our support
        team.</p>
      <p>Warm regards,</p>
      <p>
        **BCPS ICT Department**<br>
        Bangladesh College of Physicians & Surgeons (BCPS)
      </p>
    </div>
    <div class="footer">
      <p>
        <a href="https://bcps.edu.bd/">Bangladesh College of Physicians and Surgeons (BCPS)</a> |
        <a href="mailto:it@bcps.edu.bd">it@bcps.edu.bd</a> |
        +880 1721 881 962
      </p>
    </div>
  </div>
</body>

</html>
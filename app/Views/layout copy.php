<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <meta name="description" content="">
  <meta name="author" content="Md. Asif Iqbal, Programmer, Bangladesh College of Physicians & Surgeons (BCPS)">
  <title>BCPS :: <?php $this->renderSection('title') ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>public/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .poppins-regular {
      font-family: "Poppins", serif;
      font-weight: 400;
      font-style: normal;
    }

    .poppins-medium {
      font-family: "Poppins", serif;
      font-weight: 500;
      font-style: normal;
    }

    .poppins-semibold {
      font-family: "Poppins", serif;
      font-weight: 600;
      font-style: normal;
    }

    .poppins-bold {
      font-family: "Poppins", serif;
      font-weight: 700;
      font-style: normal;
    }
  </style>

  <?php $this->renderSection('pageStyles') ?>
</head>

<body class="poppins-regular">
  <main role="main"><?php $this->renderSection('main') ?></main>
  <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script><?php $this->renderSection('pageScripts') ?>
</body>

</html>
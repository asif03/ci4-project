<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

  <title><?php $this->renderSection('title')?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>public/assets/css/global.min.css" rel="stylesheet">

  <?php $this->renderSection('pageStyles')?>

  </style>
</head>

<body>

  <?php $this->renderSection('main')?>

  <!--   Core JS Files   -->
  <script src="<?php echo base_url(); ?>public/assets/libs/jquery/jquery-3.7.1.min.js"></script>
  <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php $this->renderSection('pageScripts')?>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>public/favicon.ico" />

  <title><?php $this->renderSection('title')?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>public/assets/css/global.min.css" rel="stylesheet">

  <?php $this->renderSection('pageStyles')?>

  <style>
  .radial-gradient {
    position: relative;
  }

  .radial-gradient:before {
    content: "";
    position: absolute;
    height: 100%;
    width: 100%;
    opacity: 0.3;
    background: radial-gradient(rgb(210, 241, 223),
        rgb(211, 215, 250),
        rgb(186, 216, 244)) 0% 0%/400% 400%;
    -webkit-animation: 15s ease 0s infinite normal none running gradient;
    animation: 15s ease 0s infinite normal none running gradient;
  }
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
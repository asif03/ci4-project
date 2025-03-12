<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <meta name="description" content="">
  <meta name="author" content="Md. Asif Iqbal, Programmer, Bangladesh College of Physicians & Surgeons (BCPS)">
  <title>BCPS :: <?php $this->renderSection('title')?></title>

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>public/favicon.ico">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>public/assets/css/global.min.css" rel="stylesheet">

  <!-- Custom CSS Files -->
  <link href="<?php echo base_url(); ?>public/assets/css/styles.min.css" rel="stylesheet">

  <!-- Font Awesome 5 -->
  <link href="<?php echo base_url(); ?>public/assets/libs/fontawesome/css/all.min.css" rel="stylesheet">
  <!-- DataTables -->
  <link href="<?php echo base_url(); ?>public/assets/libs/datatables/css/datatables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css" rel="stylesheet">

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

  <?php $this->renderSection('pageStyles')?>
</head>

<body class="poppins-regular">
  <div class="wrapper">
    <aside class="sidebar" data-background-color="bg-primary">
      <?=$this->include('templates/sidebar')?>
    </aside>
    <div class="main-panel">
      <header class="main-header"><?=$this->include('templates/header')?></header>
      <main role="main" class="container">
        <div class="page-inner">
          <div class="page-header">
            <?php $this->renderSection('pageheader')?>
          </div>
          <div class="page-category"><?php $this->renderSection('main')?></div>
        </div>
      </main>
      <footer class="footer"><?=$this->include('templates/footer')?></footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="<?php echo base_url(); ?>public/assets/libs/jquery/jquery-3.7.1.min.js"></script>
  <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="<?php echo base_url(); ?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- DataTables -->
  <script src="<?php echo base_url(); ?>public/assets/libs/datatables/js/datatables.min.js"></script>

  <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>

  <!-- Kaiadmin JS -->
  <script src="<?php echo base_url(); ?>public/assets/js/kaiadmin.min.js"></script>

  <?php $this->renderSection('pageScripts')?>
</body>

</html>
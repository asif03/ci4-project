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
  <style>
  #main-wrapper[data-layout="vertical"] .app-header.fixed-header {
    -webkit-transition: 0.2s ease-in;
    transition: 0.2s ease-in;
  }

  #main-wrapper[data-layout="vertical"] .app-header.fixed-header .notification {
    top: 20px;
  }

  #main-wrapper[data-layout="vertical"] .app-header.fixed-header .navbar {
    background: #fff;
    padding: 0 15px;
    border-radius: 15px;
    -webkit-box-shadow: 1px 0px 20px 0px rgba(0, 0, 0, 0.12);
    box-shadow: 1px 0px 20px 0px rgba(0, 0, 0, 0.12);
    margin-top: 15px;
  }

  #main-wrapper[data-layout="vertical"][data-sidebar-position="fixed"] .left-sidebar {
    position: fixed;
    top: 0;
  }

  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .app-header {
    position: fixed;
    z-index: 10;
  }

  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .body-wrapper>.container-fluid,
  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .body-wrapper>.container-lg,
  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .body-wrapper>.container-md,
  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .body-wrapper>.container-sm,
  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .body-wrapper>.container-xl,
  #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .body-wrapper>.container-xxl {
    padding-top: calc(70px + 15px);
  }

  @media (min-width: 1200px) {
    #main-wrapper[data-layout="vertical"][data-header-position="fixed"][data-sidebartype="mini-sidebar"] .app-header {
      width: 100%;
    }

    #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .app-header {
      width: calc(100% - 270px);
    }

    #main-wrapper[data-layout="vertical"][data-sidebartype="full"] .body-wrapper {
      margin-left: 270px;
    }
  }

  @media (max-width: 1199px) {

    #main-wrapper[data-layout="vertical"][data-sidebartype="full"] .left-sidebar,
    #main-wrapper[data-layout="vertical"][data-sidebartype="mini-sidebar"] .left-sidebar {
      left: -270px;
    }

    #main-wrapper[data-layout="vertical"][data-sidebartype="full"].show-sidebar .left-sidebar,
    #main-wrapper[data-layout="vertical"][data-sidebartype="mini-sidebar"].show-sidebar .left-sidebar {
      left: 0;
    }
  }

  .page-wrapper {
    position: relative;
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
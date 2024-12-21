<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

    <title><?php $this->renderSection('title') ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/libs/bootstrap/dist/css/bootstrap.min.css" />

    <?php $this->renderSection('pageStyles') ?>
</head>

<body>

    <main role="main" class="container">
        <?php $this->renderSection('main') ?>
    </main>

    <script src="<?php echo base_url(); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <?php $this->renderSection('pageScripts') ?>
</body>

</html>
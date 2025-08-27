<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BCPS FCPS Part-II Trainee Database</title>
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/favicon.ico">
  <meta name="description"
    content="A centralized platform for BCPS trainees to manage records, track progress, and collaborate seamlessly.">
  <meta name="keywords" content="BCPS, Trainee Database, Medical Training, Progress Tracking, Centralized Records">
  <meta name="author" content="BCPS IT Team">
  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts for a clean, professional look -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome for a wide range of icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
  body {
    font-family: 'Inter', sans-serif;
    color: #212529;
    /* A deep charcoal grey for better readability */
    background-color: #f8f9fa;
  }

  .active a {
    font-weight: 600;
    color: #2a6135 !important;
  }

  .hero-section {
    /* Updated to a green gradient */
    background: linear-gradient(to right, #2a6135, #22532c, #1a4521);
    color: white;
    padding: 8rem 0;
  }

  .shadow-custom {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  }

  .btn-primary {
    /* Updated to a vibrant green */
    background-color: #28a745;
    border-color: #28a745;
    transition: transform 0.2s ease-in-out;
  }

  .btn-primary:hover {
    background-color: #218838;
    border-color: #1e7e34;
    transform: translateY(-2px);
  }

  .btn-light {
    /* Updated to match the new primary color */
    color: #28a745;
    transition: transform 0.2s ease-in-out;
  }

  .btn-light:hover {
    color: #218838;
    transform: translateY(-2px);
  }

  .card-feature {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
  }

  .card-feature:hover {
    transform: scale(1.03);
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
  }

  .text-green {
    /* Custom class for green accents */
    color: #28a745;
  }

  .footer-light {
    background-color: #5cb85c;
  }
  </style>
  <?php $this->renderSection('pageStyles')?>
</head>

<body class="antialiased">
  <!-- Header -->
  <?=$this->include('templates/guest_header')?>

  <!-- Main Content -->
  <main>
    <?php $this->renderSection('main')?>
  </main>

  <!-- Footer -->
  <?=$this->include('templates/guest_footer')?>

  <!-- Bootstrap 5 JS and Popper.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <?php $this->renderSection('pageScripts')?>
</body>

</html>
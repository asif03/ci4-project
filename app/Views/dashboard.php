<?php $this->extend('layout')?>
<?php $this->section('pageStyles')?>
<style>
.card-icon {
  font-size: 3.5rem;
  color: #28a745;
  transition: transform 0.3s ease;
}

.summary-card:hover .card-icon {
  transform: scale(1.1);
}

.progress-bar-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 8px;
  height: 150px;
  /* Fixed height for the chart area */
}

.progress-bar-stack {
  width: 20%;
  background-color: #d1d5db;
  /* A custom light gray */
  border-radius: 4px;
  transition: all 0.5s ease-in-out;
  display: flex;
  flex-direction: column-reverse;
  position: relative;
}

.progress-bar-fill {
  background-color: #22c55e;
  /* A custom green for the bar fill */
  width: 100%;
  transition: height 0.5s ease-in-out;
  border-radius: 4px;
}

.progress-bar-label {
  position: absolute;
  top: -24px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 0.875rem;
  color: #4b5563;
  /* A custom dark gray */
}
</style>
<?php $this->endSection()?>

<?php $this->section('title')?>Dashboard<?php $this->endSection()?>

<?php $this->section('main')?>
<div class="container-fluid px-4">
  <h1 class="mt-4">Dashboard</h1>
</div>
<?php $this->endSection()?>
<?php $this->extend('layout')?>

<?php $this->section('title')?>Honorarium<?php $this->endSection()?>

<?php $this->section('main')?>
<h1>Main Content</h1>
<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Department name</th>
  </thead>
  <tfoot>
    <tr>
      <th>Department name</th>
    </tr>
  </tfoot>
</table>
<div></div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
$('#example').DataTable({
  ajax: '<?php echo base_url('fetch-honorariums') ?>',
  processing: true,
  serverSide: true
});
</script>
<?php $this->endSection()?>
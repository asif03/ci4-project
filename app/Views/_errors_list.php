<?php if (!empty($errors)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul class="mb-0">
    <?php foreach ($errors as $error): ?>
    <li><?=esc($error)?></li>
    <?php endforeach?>
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif?>
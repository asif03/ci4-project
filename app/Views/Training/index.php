<?php $this->extend('layout')?>

<?php print_r($name); ?>
<!-- Only show the Edit button if the user is an admin or editor -->
<?php if (auth()->user()->inGroup('superadmin')): ?>
<a href="/posts/edit/<?=$post['id']?>">Edit Post</a>
<?php endif; ?>

<!-- Only show the Delete button if the user is an admin -->
<?php if (auth()->user()->inGroup('admin')): ?>
<a href="/posts/delete/<?=$post['id']?>" onclick="return confirm('Are you sure?')">Delete Post</a>
<?php endif; ?>
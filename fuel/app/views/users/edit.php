<h2>Editing users</h2>

<?php echo render('users/_form'); ?>

<?php echo Html::anchor('users/view/'.$users->id, 'View'); ?> |
<?php echo Html::anchor('users', 'Back'); ?>
<!-- <?php //if (isset($permissions['payment_view']) && $permissions['payment_view']): ?> -->
<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2' || $_SESSION['user_level']=='3' || $_SESSION['user_level']=='4' )): ?>
<!-- Display Assigned Functions -->

<?php else:?>
<div class="alert alert-info row">
 The signed in user is not assigned to a role for the application.
</div>
<?php endif ?>  
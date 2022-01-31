<?php include_once '../../../private/initialize.php'; ?>

<?php $page_title = 'Show User'; ?>

<?php include SHARED_PATH.'/admin_header.php'; ?>

<h2>Show User</h2>

<nav aria-label="secondary navigation">
  <ul>
    <li><a href="<?php echo url_for('/admin/users/index.php') ?>">Show all users</a></li>

    <li><a href="<?php echo url_for('/admin/users/new.php') ?>">Create user</a></li>

    <li><a href="<?php echo url_for('/admin/users/delete.php') ?>">Delete user</a></li>

    <li><a href="<?php echo url_for('/admin/users/edit.php') ?>">Edit user</a></li>

    <li><a href="<?php echo url_for('/admin/users/show.php') ?>">Show user</a></li>
    </ul>
</nav>
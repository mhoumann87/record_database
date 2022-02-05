<?php include_once '../../../private/initialize.php'; ?>

<?php $page_title = 'New User'; ?>

<?php 

if (is_post_request()) {

  $args = $_POST['user'];
  $user = new User($args);


} else {
// Display the form
$user = new User;
}
?>


<?php include SHARED_PATH.'/admin_header.php'; ?>

<h2>New User</h2>

<aside>

<nav aria-label="secondary navigation">
  <ul>
    <li><a href="<?php echo url_for('/admin/users/index.php') ?>">Show all users</a></li>

    <li><a href="<?php echo url_for('/admin/users/new.php') ?>">Create user</a></li>

    <li><a href="<?php echo url_for('/admin/users/delete.php') ?>">Delete user</a></li>

    <li><a href="<?php echo url_for('/admin/users/edit.php') ?>">Edit user</a></li>

    <li><a href="<?php echo url_for('/admin/users/show.php') ?>">Show user</a></li>
    </ul>
</nav>

</aside>

<main>

  <a href="<?php echo url_for('/admin/users/index.php') ?>">Back to list</a>

  <?php echo display_errors($user->errors); ?>

  <form action="<?php echo url_for('/admin/users/new.php'); ?>" method="post">

    <?php include './form_fields.php'; ?>
    
    <input class="btn" type="submit" value="Create User" />

  </form>

</main>
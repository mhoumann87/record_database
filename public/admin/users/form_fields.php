<?php
/*
 * Prevents this code from being loaded in the browser
 * without first setting the correct object½
*/
  if (!isset($user)) {
    redirect_to(url_for('/admin/users/index.php'));
  }
?>


<label for="user[username]">Username (Min. 4 characters):
  <input 
      type="text" 
      name="user[username]"
      value="<?php echo h($user->username); ?>"
      autofocus
      />
</label>

<label for="user[first_name]">First Name:
  <input 
    type="text"
    name="user[first_name]"
    value="<?php echo h($user->first_name); ?>"
  />
</label>

<label for="user[last_name]">Last Name:
  <input 
    type="text"
    name="user[last_name]"
    value="<?php echo h($user->last_name); ?>"
    />
</label>

<label for="user[email]">Email:
  <input 
    type="text"
    name="user[email]"
    value="<?php echo h($user->email); ?>"
  />
</label>

<label for="user[password]">Password (min. 8 characters, 1 uppercase letter, 1lowercase letter and 1 number): 
  <input 
    type="password"
    name="user[password]"
  />
</label>

<label for="user[confirm_password]">Confirm Password:
  <input 
    type="password"
    name="user[confirm_password]"
  />
</label>

<!-- TODO! This check box is only for admins to check -->
<?php

if ($user->is_admin == 1) {
  
?>

<label for="user[is_admin]">Administrator:
  <input 
    type="radio"
    name="user[is_admin]"
    value="0"
    <?php echo ($user->is_admin == 0) ? 'checked="checked"' : ''; ?>
  />
  No&nbsp;

  <input
    type="radio"
    value="1"
    <?php echo ($user->is_admin == 1) ? 'checked="checked"' : ''; ?>
    />Yes
</label>

<?php
}
?>
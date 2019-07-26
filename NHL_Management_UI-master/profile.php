<?php
session_start();

// Defaults
$page = 'Account';

$profile = [
  'email' => '',
  'password' => '',
  'id' => ''
 ];

if (!isset($_SESSION['userId'])) {
  header('Location: login.php');
} else {
  require('db.php');
}

if (isset($_POST['email'])) {
  updateProfile($_POST['email'], $_POST['password'], $_SESSION['userId']);
  $profile = getUserById($_SESSION['userId']);
}

require('header.php');
require('navbar.php');
?>

<div class="banner"></div>
<div class="button1">
  <a href="index.php">Back to Home</a>
</div>

  <form action="profile.php" method="post" class="loginForm">
    <h2>Update Profile</h2>
    <hr>
    <label class="space" for="email"><b>Email: </b></label>
    <input type="email" name="email" value="<?php echo $profile['email'] ?>">
    <br>
    <br>
    <label for="password"><b>Password: </b></label>
    <input type="password" name="password" value="">
    <br>
    <button class="button6">Update</button>
    <div class="button4" style="background-color:red; margin-bottom: 16px; margin-top: 8px">
      <a style="color: white;" href="delete-me.php?id=<?php echo $_SESSION['userId'] ?>">Delete</a>
    </div>
  </form>
  <?php require('footer.php'); ?>
